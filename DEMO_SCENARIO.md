# Skenario Demo PPKMB YUWARAJA

## Persiapan Sebelum Demo

### 1. Setup Database
```bash
php artisan migrate:fresh --force
php artisan db:seed --force
```

### 2. Jalankan Server
```bash
php artisan serve
```

### 3. Siapkan Browser
Buka 3 tab browser terpisah untuk setiap role:
- Tab 1: Admin (http://localhost:8000/admin)
- Tab 2: SPV (http://localhost:8000/spv/dashboard)
- Tab 3: Mahasiswa (http://localhost:8000/mahasiswa/dashboard)

---

## Akun yang Tersedia

| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `password` |
| SPV Alpha | `rina` | `password` |
| SPV Bravo | `dimas` | `password` |
| SPV Charlie | `sari` | `password` |
| Mahasiswa | `ahmad` | `password` |
| Mahasiswa | `putri` | `password` |
| Mahasiswa | `bayu` | `password` |

---

## Skenario Demo

### Bagian 1: Admin Panel (Filament)

**Tujuan:** Menunjukkan kemampuan admin dalam mengelola seluruh data.

#### Langkah 1: Login Admin
1. Buka http://localhost:8000/admin
2. Login dengan `admin` / `password`
3. **Tampilkan:** Dashboard admin dengan statistik (Total Mahasiswa, Cluster, Tugas, Pengumuman)

#### Langkah 2: Manajemen User
1. Klik menu "Users" atau "Mahasiswa"
2. **Tampilkan:** Daftar seluruh mahasiswa (12 mahasiswa + 3 SPV + 1 admin)
3. **Demo filter:** Filter berdasarkan role (mahasiswa), program studi, angkatan
4. **Tampilkan detail:** Klik salah satu mahasiswa untuk lihat profil lengkap

#### Langkah 3: Manajemen Kelompok
1. Klik menu "Kelompoks"
2. **Tampilkan:** 3 cluster (Alpha, Bravo, Charlie) dengan jumlah anggota
3. **Tampilkan:** Kode unik setiap cluster (ALPHA, BRAVO, CHARL)
4. Klik cluster tertentu untuk lihat daftar anggota

#### Langkah 4: Manajemen Tugas
1. Klik menu "Tugas"
2. **Tampilkan:** 4 tugas dengan status aktif/nonaktif
3. **Tampilkan:** Tipe tugas (individual/kelompok) dan deadline
4. Klik tugas untuk lihat detail dan pengumpulan

#### Langkah 5: Manajemen Absensi
1. Klik menu "Absensi"
2. **Tampilkan:** 3 sesi absensi (hari ini, besok, lusa)
3. Klik sesi absensi hari ini untuk lihat:
   - 2 mahasiswa approved
   - 1 mahasiswa pending
   - 1 mahasiswa rejected

#### Langkah 6: Manajemen Survey
1. Klik menu "Master Survey"
2. **Tampilkan:** Survey "Kepuasan PPKMB YUWARAJA 2025" dengan 5 pertanyaan
3. Klik survey untuk lihat detail pertanyaan
4. Klik "Hasil Survey" untuk lihat jawaban responden

#### Langkah 7: Manajemen Pengumuman
1. Klik menu "Pengumuman"
2. **Tampilkan:** 5 pengumuman (umum + penting)
3. **Demo:** Buat pengumuman baru atau edit yang sudah ada

---

### Bagian 2: SPV Dashboard

**Tujuan:** Menunjukkan workflow supervisor dalam membimbing mahasiswa.

#### Langkah 1: Login SPV
1. Buka http://localhost:8000
2. Login dengan `rina` / `password` (SPV Cluster Alpha)
3. **Tampilkan:** Dashboard SPV dengan statistik cluster

#### Langkah 2: Kelola Cluster
1. Klik menu "Cluster"
2. **Tampilkan:** Daftar mahasiswa di Cluster Alpha (Ahmad, Putri, Fajar, Lestari)
3. **Tampilkan:** Profil lengkap salah satu mahasiswa

#### Langkah 3: Review Tugas
1. Klik menu "Tugas"
2. **Tampilkan:** Daftar tugas yang dikumpulkan mahasiswa cluster
3. Klik tugas "Essay Pengalaman PKKMB"
4. **Demo workflow:**
   - Lihat submission Ahmad (status: approved, nilai: 85)
   - Lihat submission Putri (status: reviewed, nilai: 90)
   - Lihat submission Bayu dari Cluster Bravo (status: submitted)

#### Langkah 4: Approve Absensi
1. Klik menu "Absensi"
2. **Tampilkan:** Sesi absensi yang aktif
3. Klik sesi "Absensi Upacara Pembukaan"
4. **Demo workflow:**
   - Lihat 2 mahasiswa sudah approved
   - Lihat 1 mahasiswa pending (Bayu) - approve atau reject
   - Lihat 1 mahasiswa rejected (Gilang)

#### Langkah 5: Lihat Pengumuman & Jadwal
1. Klik menu "Pengumuman"
2. **Tampilkan:** Daftar pengumuman yang dipublish
3. Klik menu "Jadwal"
4. **Tampilkan:** Daftar jadwal acara

---

### Bagian 3: Mahasiswa Dashboard

**Tujuan:** Menunjukkan pengalaman mahasiswa dari awal PKKMB.

#### Langkah 1: Login Mahasiswa
1. Buka http://localhost:8000
2. Login dengan `ahmad` / `password` (Mahasiswa Cluster Alpha)
3. **Tampilkan:** Dashboard mahasiswa dengan info cluster, tugas, pengumuman

#### Langkah 2: Lihat Cluster
1. Klik menu "Cluster"
2. **Tampilkan:** Informasi cluster (Alpha), kode, daftar anggota
3. **Tampilkan:** Profil supervisor (Rina)

#### Langkah 3: Kerjakan Tugas
1. Klik menu "Tugas"
2. **Tampilkan:** Daftar tugas yang tersedia
3. Klik tugas "Essay Pengalaman PKKMB"
4. **Tampilkan:** Detail tugas, deskripsi, deadline
5. **Demo submit:** Klik "Kerjakan" dan upload file (atau skip jika tidak ada file)

#### Langkah 4: Absen
1. Klik menu "Absensi"
2. **Tampilkan:** Sesi absensi yang aktif (hari ini)
3. **Demo submit:** Klik "Ajukan Absensi" pada sesi yang belum diisi

#### Langkah 5: Isi Survey
1. Klik menu "Survey"
2. **Tampilkan:** Survey "Kepuasan PPKMB" dengan pertanyaan-pertanyaan
3. **Demo submit:** Jawab beberapa pertanyaan lalu submit

#### Langkah 6: Lihat Pengumuman & Jadwal
1. Klik menu "Pengumuman"
2. **Tampilkan:** Daftar pengumuman yang dipublish
3. Klik salah satu untuk lihat detail
4. Klik menu "Jadwal"
5. **Tampilkan:** Daftar jadwal acara

#### Langkah 7: Friendship
1. Klik menu "Cluster" atau "Friends"
2. **Tampilkan:** Daftar teman yang sudah accepted
3. **Tampilkan:** Request yang pending (dari Fajar)

---

### Bagian 4: Fitur Profil

**Tujuan:** Menunjukkan fitur edit profil dan upload foto.

#### Langkah 1: Edit Profil (Mahasiswa)
1. Login sebagai `ahmad`
2. Klik menu "Profile"
3. **Tampilkan:** Form edit profil dengan data yang sudah terisi
4. **Demo:** Edit deskripsi atau nomor telepon

#### Langkah 2: Upload Foto Profil
1. Di halaman profil, klik area foto
2. **Demo:** Upload foto profil (jika ada file gambar)
3. **Demo:** Crop foto (jika fitur tersedia)

---

## Checklist Demo

- [ ] Login Admin - tampilkan dashboard statistik
- [ ] Manajemen User via Filament - filter & CRUD
- [ ] Manajemen Kelompok - lihat anggota & kode
- [ ] Manajemen Tugas - lihat submission & status
- [ ] Manajemen Absensi - approve/reject
- [ ] Manajemen Survey - lihat pertanyaan & hasil
- [ ] Login SPV - tampilkan dashboard cluster
- [ ] Review tugas mahasiswa - approve/grade
- [ ] Approve absensi mahasiswa
- [ ] Login Mahasiswa - tampilkan dashboard
- [ ] Submit tugas
- [ ] Ajukan absensi
- [ ] Isi survey
- [ ] Lihat pengumuman & jadwal
- [ ] Edit profil
- [ ] Friendship system

---

## Tips Demo

1. **Gunakan split screen** atau tab berbeda untuk menunjukkan perbedaan role
2. **Jelaskan alur data** dari admin -> SPV -> mahasiswa
3. **Tampilkan error handling** jika ada (misal: deadline tugas sudah lewat)
4. **Gunakan data yang sudah ada** untuk mempercepat demo
5. **Siapkan file dummy** untuk demo upload tugas (PDF/DOC kosong)
6. **Perhatikan waktu** - absensi hanya bisa diakses dalam rentang waktu tertentu
7. **Tampilkan responsive design** jika demo di layar besar

---

## Durasi Demo yang Disarankan

| Bagian | Durasi |
|--------|--------|
| Admin Panel | 10-15 menit |
| SPV Dashboard | 8-10 menit |
| Mahasiswa Dashboard | 10-15 menit |
| Fitur Profil | 3-5 menit |
| Q&A | 5-10 menit |
| **Total** | **35-55 menit** |
