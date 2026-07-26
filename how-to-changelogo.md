# Cara Ganti Logo YUWARAJA

Saat ini logo diganti placeholder `[logo]` di semua tampilan.
Ikuti langkah ini untuk pasang logo resmi.

---

## 1. Siapkan File Logo

Taruh file logo di `public/images/`:

| File | Fungsi |
|------|--------|
| `logo.svg` | Logo utama (sidebar, navbar, landing page) |
| `favicon.ico` | Icon browser tab |
| `logo-yuwarajaxvii.svg` | Apple touch icon & legacy references |

Format: **SVG** untuk logo utama, **ICO/PNG** untuk favicon.

---

## 2. Ganti di Semua File

### A. Layouts — favicon + apple touch icon

Cari di file berikut, ganti `data:image/svg+xml,...` jadi path file logo:

**File:**
- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/spv.blade.php`
- `resources/views/layouts/mahasiswa.blade.php`
- `resources/views/layouts/admin.blade.php`
- `resources/views/components/admin-layout.blade.php`
- `resources/views/components/spv-layout.blade.php`
- `resources/views/components/mahasiswa-layout.blade.php`

Cari baris:
```blade
<link rel="icon" href="data:image/svg+xml,...">
```
Ganti jadi:
```blade
<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-yuwarajaxvii.svg') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo-yuwarajaxvii.svg') }}">
```

---

### B. Sidebars — logo display

**File:**
- `resources/views/components/sidebar.blade.php`
- `resources/views/components/sidebar-spv.blade.php`

Cari:
```blade
<div class="h-16 mb-2 flex items-center justify-center text-cyan-400 font-bold text-2xl">[logo]</div>
```
Ganti:
```blade
<img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-16 mb-2">
```

---

### C. Guest layout — logo di login/register

**File:** `resources/views/layouts/guest.blade.php`

Cari:
```blade
<div class="mx-auto mb-4 w-24 h-24 flex items-center justify-center text-cyan-400 font-bold text-2xl">[logo]</div>
```
Ganti:
```blade
<img src="{{ asset('images/logo.svg') }}" alt="Logo Yuwaraaja" class="mx-auto mb-4 w-24 h-24">
```

---

### D. Landing page (welcome)

**File:** `resources/views/welcome.blade.php`

Cari:
```blade
<div class="text-2xl font-bold text-gray-400">[logo]</div>
```
Ganti:
```blade
<img src="/images/logo-yuwarajaxvii.svg" alt="logo yuwaraja"
```

---

### E. Error pages

**File:**
- `resources/views/errors/419.blade.php`
- `resources/views/errors/404.blade.php`

Cari:
```blade
<div class="text-2xl font-bold text-gray-400">[logo]</div>
```
Ganti:
```blade
<img src="{{ asset('images/logo-yuwarajaxvii.svg') }}"
```

---

### F. Navbar

**File:** `resources/views/layouts/navigation.blade.php`

Cari:
```blade
<div class="block h-14 flex items-center text-gray-400 font-bold text-lg">[logo]</div>
```
Ganti:
```blade
<img src="/images/logo.svg" alt="logo-yuwarajaxvii" class="block h-14 w-auto fill-current text-gray-800" />
```

---

### G. Admin Panel (Filament)

**File:** `app/Providers/Filament/AdminPanelProvider.php`

Cari:
```php
->brandName('[logo] - YUWARAJA XVII')
```
Ganti:
```php
->brandLogo(asset('images/logo-yuwarajaxvii.svg'))
->brandName('YUWARAJA XVII')
```

---

### H. Web Manifest

**File:** `public/site.webmanifest`

Ganti isi dengan konfigurasi yang sesuai (lihat contoh di file lama).

---

## 3. Bersihkan Cache

```bash
php artisan optimize:clear
```

---

## 4. Verifikasi

1. Buka landing page → logo muncul
2. Login sebagai admin → logo di sidebar & tab browser muncul
3. Login sebagai SPV → logo di sidebar SPV muncul
4. Login sebagai mahasiswa → logo di sidebar mahasiswa muncul
5. Cek halaman 404 → logo muncul
