<?php

namespace Database\Seeders;

use App\Models\DetilSurvey;
use App\Models\HasilSurvey;
use App\Models\MasterSurvey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    public function run(): void
    {
        // Survey 1: Kepuasan PKKMB
        $survey1 = MasterSurvey::create([
            'judul_survey' => 'Survey Kepuasan PPKMB YUWARAJA 2025',
            'deskripsi_survey' => 'Survey ini bertujuan untuk mengukur tingkat kepuasan peserta terhadap kegiatan PKKMB yang telah dilaksanakan. Hasil survey akan digunakan untuk perbaikan di tahun berikutnya.',
            'status' => 'aktif',
            'tanggal_mulai' => now()->subDays(2),
            'tanggal_selesai' => now()->addDays(7),
            'created_by' => 1, // Admin
        ]);

        // Pertanyaan-pertanyaan
        $q1 = DetilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'pertanyaan' => 'Bagaimana penilaian Anda terhadap keseluruhan kegiatan PPKMB YUWARAJA 2025?',
            'tipe_pertanyaan' => 'radio',
            'opsi_jawaban' => ['Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Kurang'],
            'wajib_diisi' => true,
            'urutan' => 1,
        ]);

        $q2 = DetilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'pertanyaan' => 'Aktivitas mana yang paling bermanfaat menurut Anda?',
            'tipe_pertanyaan' => 'checkbox',
            'opsi_jawaban' => ['Orientasi Kampus', 'Seminar Akademik', 'Team Building', 'Workshop Kreativitas', 'Pengenalan Prodi'],
            'wajib_diisi' => true,
            'urutan' => 2,
        ]);

        $q3 = DetilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'pertanyaan' => 'Bagaimana penilaian Anda terhadap fasilitas yang disediakan?',
            'tipe_pertanyaan' => 'select',
            'opsi_jawaban' => ['Sangat Puas', 'Puas', 'Cukup', 'Kurang Puas', 'Tidak Puas'],
            'wajib_diisi' => true,
            'urutan' => 3,
        ]);

        $q4 = DetilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'pertanyaan' => 'Saran dan masukan Anda untuk perbaikan PPKMB tahun depan?',
            'tipe_pertanyaan' => 'textarea',
            'opsi_jawaban' => null,
            'wajib_diisi' => false,
            'urutan' => 4,
        ]);

        $q5 = DetilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'pertanyaan' => 'Nama lengkap Anda',
            'tipe_pertanyaan' => 'text',
            'opsi_jawaban' => null,
            'wajib_diisi' => true,
            'urutan' => 5,
        ]);

        // Beberapa jawaban dari mahasiswa
        // Ahmad menjawab semua
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q1->id_detil_survey,
            'user_id' => 5,
            'jawaban' => 'Baik',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q2->id_detil_survey,
            'user_id' => 5,
            'jawaban' => 'Team Building,Pengenalan Prodi',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q3->id_detil_survey,
            'user_id' => 5,
            'jawaban' => 'Puas',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q4->id_detil_survey,
            'user_id' => 5,
            'jawaban' => 'Semoga next time bisa lebih banyak ice breaking di awal agar lebih fun.',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q5->id_detil_survey,
            'user_id' => 5,
            'jawaban' => 'Ahmad Rizky Pratama',
        ]);

        // Putri menjawab semua
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q1->id_detil_survey,
            'user_id' => 6,
            'jawaban' => 'Sangat Baik',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q2->id_detil_survey,
            'user_id' => 6,
            'jawaban' => 'Orientasi Kampus,Team Building,Workshop Kreativitas',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q3->id_detil_survey,
            'user_id' => 6,
            'jawaban' => 'Sangat Puas',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q5->id_detil_survey,
            'user_id' => 6,
            'jawaban' => 'Putri Anjani',
        ]);

        // Bayu menjawab sebagian
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q1->id_detil_survey,
            'user_id' => 9,
            'jawaban' => 'Baik',
        ]);
        HasilSurvey::create([
            'id_master_survey' => $survey1->id_master_survey,
            'id_detil_survey' => $q5->id_detil_survey,
            'user_id' => 9,
            'jawaban' => 'Bayu Saputra',
        ]);
    }
}
