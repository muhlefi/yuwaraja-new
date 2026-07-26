<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SpvAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ambil kelompok yang dibimbing SPV ini
        $kelompokDibimbing = $user->kelompokDibimbing;
        $kelompokIds = $kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');

        // Filter parameters
        $search = $request->get('search', '');
        $statusFilter = $request->get('status', 'all');
        $kelompokFilter = $request->get('kelompok', '');
        $tanggalDari = $request->get('tanggal_dari', '');
        $tanggalSampai = $request->get('tanggal_sampai', '');

        // Query semua absensi mahasiswa dari kelompok yang dibimbing
        $query = AbsensiMahasiswa::with(['absensi', 'mahasiswa', 'mahasiswa.kelompok', 'approvedBy'])
            ->whereIn('user_id', $mahasiswaIds);

        // Filter berdasarkan status
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        // Filter berdasarkan pencarian nama
        if ($search) {
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kelompok
        if ($kelompokFilter) {
            $query->whereHas('mahasiswa', function ($q) use ($kelompokFilter) {
                $q->where('kelompok_id', $kelompokFilter);
            });
        }

        // Filter berdasarkan rentang tanggal
        if ($tanggalDari) {
            $query->where('created_at', '>=', $tanggalDari);
        }
        if ($tanggalSampai) {
            $query->where('created_at', '<=', $tanggalSampai . ' 23:59:59');
        }

        // Ambil semua data dengan filter
        $allRequests = $query->orderBy('created_at', 'desc')->get();

        // Pisahkan berdasarkan status
        $pendingRequests = $allRequests->where('status', 'pending');
        $approvedRequests = $allRequests->where('status', 'approved')->take(20);

        // Ambil semua absensi aktif
        $absensiList = Absensi::where('status', 'aktif')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

        // Data untuk filter dropdown
        $kelompokList = $kelompokDibimbing;

        return view('spv.absensi.index', compact(
            'absensiList', 
            'pendingRequests', 
            'approvedRequests', 
            'kelompokList',
            'search', 
            'statusFilter', 
            'kelompokFilter', 
            'tanggalDari', 
            'tanggalSampai'
        ));
    }

    public function approve(Request $request, AbsensiMahasiswa $absensiMahasiswa)
    {
        // Pastikan mahasiswa ini dibimbing oleh SPV yang sedang login
        $user = Auth::user();
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        if (!$mahasiswaIds->contains($absensiMahasiswa->user_id)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menyetujui absensi mahasiswa ini.');
        }

        $absensiMahasiswa->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Absensi mahasiswa berhasil disetujui.');
    }

    public function reject(Request $request, AbsensiMahasiswa $absensiMahasiswa)
    {
        // Pastikan mahasiswa ini dibimbing oleh SPV yang sedang login
        $user = Auth::user();
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        if (!$mahasiswaIds->contains($absensiMahasiswa->user_id)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menolak absensi mahasiswa ini.');
        }

        $absensiMahasiswa->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Absensi mahasiswa berhasil ditolak.');
    }

    public function show(Request $request, Absensi $absensi)
    {
        $user = Auth::user();
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        // Filter berdasarkan status
        $statusFilter = $request->get('status', 'all');
        
        $query = AbsensiMahasiswa::with(['mahasiswa', 'mahasiswa.kelompok', 'approvedBy'])
            ->where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds);
            
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Statistik
        $totalRequests = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->count();
            
        $approvedCount = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'approved')
            ->count();
            
        $pendingCount = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'pending')
            ->count();
            
        $rejectedCount = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'rejected')
            ->count();

        return view('spv.absensi.show', compact(
            'absensi', 
            'requests', 
            'totalRequests', 
            'approvedCount', 
            'pendingCount', 
            'rejectedCount'
        ));
    }

    public function updateLinkDrive(Request $request, $kelompokId)
    {
        $user = Auth::user();
        
        // Pastikan kelompok ini dibimbing oleh SPV yang sedang login
        $kelompok = \App\Models\Kelompok::where('spv_id', $user->id)->findOrFail($kelompokId);
        
        $validated = $request->validate([
            'link_drive' => 'nullable|url|max:500',
        ]);
        
        $kelompok->update([
            'link_drive' => $validated['link_drive'] ?: null,
        ]);
        
        return redirect()->back()->with('success', 'Link drive absensi berhasil diperbarui.');
    }
}