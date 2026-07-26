# Full Flow PPKMB YUWARAJA

## Arsitektur Sistem

```
+-------------------+     +-------------------+     +-------------------+
|   Admin Panel     |     |   SPV Dashboard   |     |  Mahasiswa Portal |
|   (Filament)      |     |   (Blade/Livewire)|     |  (Blade/Livewire)|
+-------------------+     +-------------------+     +-------------------+
         |                         |                         |
         +-------------------------+-------------------------+
                                   |
                         +-------------------+
                         |    Laravel API    |
                         |  (Controllers)    |
                         +-------------------+
                                   |
                         +-------------------+
                         |    MySQL Database |
                         +-------------------+
```

## Data Flow Diagram

### 1. Alur Registrasi & Login

```
[User Baru] --> [Register] --> [Email Verification] --> [Login]
                                                           |
                                          +----------------+----------------+
                                          |                |                |
                                    [Admin Panel]    [SPV Dashboard]  [Mahasiswa Portal]
```

**Detail:**
1. Mahasiswa baru mengisi form registrasi (nama, NIM, email, password, data diri)
2. Sistem mengirim email verifikasi
3. Setelah verifikasi, user bisa login
4. Role-based redirect: admin -> `/admin`, spv -> `/spv/dashboard`, mahasiswa -> `/mahasiswa/dashboard`

### 2. Alur Kelompok (Cluster)

```
[Admin Buat Kelompok] --> [Generate Kode Unik]
                              |
[SPV/Mahasiswa] --> [Join dengan Kode] --> [Tergabung dalam Kelompok]
                              |
[Supervisor] --> [Membimbing Anggota]
```

**Detail:**
1. Admin membuat kelompok di Filament panel
2. Sistem otomatis generate kode 5 karakter (misal: ALPHA, BRAVO)
3. SPV join cluster menggunakan kode
4. Mahasiswa join cluster menggunakan kode yang sama
5. Setiap cluster memiliki 1 SPV dan 4-5 mahasiswa

### 3. Alur Tugas

```
[Admin/SPV Buat Tugas] --> [Mahasiswa Melihat Tugas]
                                    |
                           [Mahasiswa Kerjakan]
                                    |
                           [Upload File Jawaban]
                                    |
                           [SPV Review]
                                    |
                    +---------------+---------------+
                    |               |               |
              [Approved]      [Reviewed]      [Rejected]
              (nilai + feedback) (nilai)      (feedback perbaikan)
```

**Detail:**
1. Admin/SPV membuat tugas (judul, deskripsi, deadline, tipe)
2. Tipe tugas: `individual` atau `kelompok`
3. Mahasiswa melihat daftar tugas di dashboard
4. Mahasiswa upload file jawaban (PDF/DOC/DOCX/ZIP/RAR, max 10MB)
5. SPV review submission:
   - **Submitted**: Menunggu review
   - **Reviewed**: Sudah dinilai
   - **Approved**: Disetujui dengan nilai
   - **Rejected**: Ditolak dengan feedback
   - **Done**: Selesai

### 4. Alur Absensi

```
[Admin Buat Sesi Absensi] --> [Mahasiswa Ajukan Absensi]
                                      |
                              [SPV Review]
                                      |
                          +-----------+-----------+
                          |                       |
                    [Approved]              [Rejected]
```

**Detail:**
1. Admin membuat sesi absensi (judul, tanggal, jam mulai/selesai)
2. Mahasiswa mengajukan absensi saat sesi aktif
3. Sistem validasi:
   - Cek apakah sudah absen sebelumnya
   - Cek apakah dalam rentang waktu yang ditentukan
4. SPV approve/reject absensi mahasiswa
5. Status absensi: `pending`, `approved`, `rejected`

### 5. Alur Survey

```
[Admin Buat Survey] --> [Admin Buat Pertanyaan]
                              |
[Mahasiswa Isi Survey] --> [Submit Jawaban]
                              |
[Admin Lihat Hasil] --> [Export Data]
```

**Detail:**
1. Admin membuat master survey (judul, deskripsi, tanggal aktif)
2. Admin membuat pertanyaan:
   - **Text**: Input teks bebas
   - **Textarea**: Input teks panjang
   - **Radio**: Pilihan ganda (1 jawaban)
   - **Checkbox**: Pilihan ganda (beberapa jawaban)
   - **Select**: Dropdown pilihan
3. Mahasiswa mengisi survey dan submit
4. Admin melihat hasil survey dan export

### 6. Alur Pengumuman

```
[Admin Buat Pengumuman] --> [Publish]
                                    |
[SPV/Mahasiswa] --> [Melihat Pengumuman]
```

**Detail:**
1. Admin membuat pengumuman (judul, konten, tipe)
2. Tipe pengumuman: `umum` atau `penting`
3. Pengumuman dipublish dan bisa dilihat oleh semua role

### 7. Alur Jadwal

```
[Admin Buat Jadwal] --> [Status: Draft/Published]
                                    |
[SPV/Mahasiswa] --> [Melihat Jadwal Published]
```

**Detail:**
1. Admin membuat jadwal acara (nama, deskripsi, tanggal, lokasi, status)
2. Status jadwal: `draft` atau `published`
3. Hanya jadwal published yang terlihat oleh SPV dan mahasiswa

### 8. Alur Friendship

```
[Mahasiswa] --> [Kirim Request]
                      |
[Friend] --> [Accept/Reject]
                      |
[Accepted] --> [Bisa Lihat Profil Detail]
```

**Detail:**
1. Mahasiswa bisa mengirim friend request ke sesama anggota cluster
2. Friend bisa accept atau reject request
3. Jika accepted, bisa melihat profil detail satu sama lain
4. Hanya bisa berteman dengan anggota cluster yang sama

---

## Database Schema

### ER Diagram (Text)

```
users (1) ----< (N) kelompoks     [spv_id]
users (N) >---- (1) kelompoks     [kelompok_id]
users (1) ----< (N) friendships   [user_id]
users (1) ----< (N) friendships   [friend_id]
users (1) ----< (N) pengumpulan_tugas [user_id]
users (1) ----< (N) absensi_mahasiswa [user_id]
users (1) ----< (N) hasil_survey  [user_id]
users (1) ----< (N) master_survey [created_by]

kelompoks (1) ----< (N) users     [kelompok_id]
kelompoks (1) ----< (N) pengumpulan_tugas [kelompok_id]

tugas (1) ----< (N) pengumpulan_tugas [tugas_id]

absensi (1) ----< (N) absensi_mahasiswa [absensi_id]

master_survey (1) ----< (N) detil_survey [id_master_survey]
master_survey (1) ----< (N) hasil_survey [id_master_survey]
detil_survey (1) ----< (N) hasil_survey [id_detil_survey]
```

### Tabel Utama

| Tabel | Deskripsi | Relasi |
|-------|-----------|--------|
| `users` | Data pengguna (admin, SPV, mahasiswa) | -> kelompoks, friendships, tugas, absensi, survey |
| `kelompoks` | Cluster/ kelompok | -> users (SPV + anggota) |
| `tugas` | Tugas yang diberikan | -> pengumpulan_tugas |
| `pengumpulan_tugas` | Pengumpulan tugas oleh mahasiswa | -> users, kelompoks, tugas |
| `pengumuman` | Pengumuman | - |
| `jadwal_acara` | Jadwal kegiatan | - |
| `absensi` | Sesi absensi | -> absensi_mahasiswa |
| `absensi_mahasiswa` | Pengajuan absensi mahasiswa | -> users, absensi |
| `master_survey` | Survey | -> detil_survey, hasil_survey |
| `detil_survey` | Pertanyaan survey | -> master_survey, hasil_survey |
| `hasil_survey` | Jawaban survey | -> users, master_survey, detil_survey |
| `friendships` | Pertemanan | -> users (sender + receiver) |
| `faqs` | FAQ | - |

---

## Fitur Utama

### 1. Autentikasi & Otorisasi
- **Register**: Mahasiswa baru bisa mendaftar
- **Login**: Multi-role (admin, SPV, mahasiswa)
- **Email Verification**: Verifikasi email sebelum login
- **Role-based Access**: Setiap role punya akses berbeda
- **Profile Management**: Edit profil dan upload foto

### 2. Manajemen Kelompok
- **Buat Kelompok**: Admin membuat cluster baru
- **Kode Unik**: Sistem generate kode 5 karakter
- **Join Cluster**: SPV/Mahasiswa join dengan kode
- **Lihat Anggota**: Lihat daftar anggota cluster
- **Upload Foto Cluster**: SPV bisa upload foto cluster

### 3. Manajemen Tugas
- **Buat Tugas**: Admin/SPV membuat tugas baru
- **Tipe Tugas**: Individual atau kelompok
- **Deadline**: Batas waktu pengumpulan
- **Upload Jawaban**: Mahasiswa upload file
- **Review Tugas**: SPV review dan beri nilai
- **Status Tracking**: Submit -> Review -> Approved/Rejected

### 4. Manajemen Absensi
- **Buat Sesi Absensi**: Admin membuat sesi absensi
- **Waktu Aktif**: Hanya bisa diakses dalam rentang waktu
- **Ajukan Absensi**: Mahasiswa mengajukan absensi
- **Approve/Reject**: SPV approve atau reject
- **Cek Duplikat**: Sistem cek apakah sudah absen

### 5. Survey
- **Buat Survey**: Admin membuat survey baru
- **Jenis Pertanyaan**: Text, textarea, radio, checkbox, select
- **Isi Survey**: Mahasiswa mengisi survey
- **Lihat Hasil**: Admin melihat dan export hasil

### 6. Pengumuman & Jadwal
- **Buat Pengumuman**: Admin membuat pengumuman
- **Tipe Pengumuman**: Umum atau penting
- **Buat Jadwal**: Admin membuat jadwal acara
- **Status**: Draft atau published

### 7. Friendship
- **Kirim Request**: Mahasiswa mengirim friend request
- **Accept/Reject**: Friend accept atau reject
- **Lihat Profil**: Lihat profil detail teman
- **Filter Cluster**: Hanya bisa berteman satu cluster

---

## Technologi yang Digunakan

### Backend
- **Laravel 12**: Framework PHP
- **MySQL**: Database
- **Eloquent ORM**: Database abstraction

### Frontend
- **Blade**: Templating engine
- **Livewire**: Komponen interaktif
- **Tailwind CSS**: CSS framework
- **Alpine.js**: JavaScript framework ringan

### Admin Panel
- **Filament 3**: Admin panel builder
- **Filament Resources**: CRUD management
- **Filament Widgets**: Dashboard widgets

### Fitur Tambahan
- **Laravel Breeze**: Autentikasi
- **File Storage**: Upload foto, tugas, pengumpulan
- **Real-time Validation**: Cek username, email, NIM
- **Role-based Middleware**: Otorisasi per role

---

## Struktur File

```
yuwaraja-new/
├── app/
│   ├── Filament/           # Admin panel
│   │   ├── Panels/         # Panel provider
│   │   ├── Resources/      # CRUD resources
│   │   ├── Pages/          # Custom pages
│   │   └── Widgets/        # Dashboard widgets
│   ├── Http/
│   │   └── Controllers/    # Web controllers
│   └── Models/             # Eloquent models
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/
│       ├── components/     # Blade components
│       ├── layouts/        # Layout templates
│       ├── livewire/       # Livewire components
│       └── pages/          # Page templates
├── routes/
│   ├── web.php             # Web routes
│   └── auth.php            # Auth routes
└── public/
    └── storage/            # File uploads
        ├── profile-pictures/
        ├── cluster-photos/
        ├── tugas-files/
        └── pengumpulan/
```

---

## Data Seeder yang Tersedia

| Seeder | Data |
|--------|------|
| `AdminSeeder` | 1 admin |
| `SpvSeeder` | 3 SPV (Alpha, Bravo, Charlie) |
| `MahasiswaSeeder` | 12 mahasiswa (4 per cluster) |
| `KelompokSeeder` | 3 cluster |
| `TugasSeeder` | 4 tugas + 5 submission |
| `PengumumanSeeder` | 5 pengumuman |
| `JadwalSeeder` | 4 jadwal acara |
| `AbsensiSeeder` | 3 sesi absensi + 4 pengajuan |
| `SurveySeeder` | 1 survey + 5 pertanyaan + 12 jawaban |
| `FaqSeeder` | 5 FAQ |
| `FriendshipSeeder` | 9 pertemanan (6 accepted, 3 pending) |

---

## Akun Demo

| Role | Username | Password | Cluster |
|------|----------|----------|---------|
| Admin | `admin` | `password` | - |
| SPV | `rina` | `password` | Alpha |
| SPV | `dimas` | `password` | Bravo |
| SPV | `sari` | `password` | Charlie |
| Mahasiswa | `ahmad` | `password` | Alpha |
| Mahasiswa | `putri` | `password` | Alpha |
| Mahasiswa | `fajar` | `password` | Alpha |
| Mahasiswa | `lestari` | `password` | Alpha |
| Mahasiswa | `bayu` | `password` | Bravo |
| Mahasiswa | `citra` | `password` | Bravo |
| Mahasiswa | `dwi` | `password` | Bravo |
| Mahasiswa | `eka` | `password` | Bravo |
| Mahasiswa | `gilang` | `password` | Charlie |
| Mahasiswa | `hana` | `password` | Charlie |
| Mahasiswa | `irfan` | `password` | Charlie |
| Mahasiswa | `jingga` | `password` | Charlie |

---

## Flow Demo Lengkap

### Login sebagai Admin
1. Akses `/admin`
2. Login `admin` / `password`
3. Dashboard menampilkan statistik:
   - Total Mahasiswa: 12
   - Total Cluster: 3
   - Total Tugas: 4
   - Total Pengumuman: 5
4. Navigasi ke menu Users, Kelompoks, Tugas, Absensi, Survey
5. CRUD data (opsional)

### Login sebagai SPV
1. Akses `/`
2. Login `rina` / `password`
3. Dashboard menampilkan:
   - Cluster Alpha
   - 4 mahasiswa bimbingan
   - Tugas terbaru
4. Review tugas mahasiswa (approve/reject/grade)
5. Review absensi mahasiswa (approve/reject)
6. Lihat pengumuman dan jadwal

### Login sebagai Mahasiswa
1. Akses `/`
2. Login `ahmad` / `password`
3. Dashboard menampilkan:
   - Info cluster (Alpha)
   - Tugas aktif
   - Pengumuman terbaru
   - Jadwal acara
4. Kerjakan tugas (upload file)
5. Ajukan absensi
6. Isi survey
7. Lihat pengumuman dan jadwal
8. Edit profil

---

## Troubleshooting

### Database Error
```bash
php artisan migrate:fresh --force
php artisan db:seed --force
```

### File Upload Error
```bash
php artisan storage:link
```

### Cache Clear
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Permission Error
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## Referensi

- **Laravel 12**: https://laravel.com/docs/12.x
- **Filament 3**: https://filamentphp.com/docs/3.x
- **Livewire**: https://livewire.laravel.com
- **Tailwind CSS**: https://tailwindcss.com/docs
- **Alpine.js**: https://alpinejs.dev/essentials/installation
