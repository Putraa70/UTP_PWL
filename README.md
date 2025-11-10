Siap Putra!
Berikut **README.md FULL, KOMPLIT, dan semuanya dalam satu code block**.
Tinggal **copy–paste** langsung ke GitHub tanpa tambahan apa pun.

# ✅ **README.md — SIAP PASTE**

```md
# 📌 HIMAKOM Manager – Laravel 10

Sistem Manajemen Kegiatan & Kepanitiaan  
UTP Pemrograman Web Lanjut (PWL) – Universitas Lampung

## ✨ Deskripsi Project

HIMAKOM Manager adalah aplikasi web berbasis **Laravel 10** untuk mengelola:

-   Data kegiatan HIMAKOM
-   Kepanitiaan setiap kegiatan
-   Progress kerja panitia
-   Role-based access (Admin & Panitia)

Project ini dibuat sebagai bagian dari **UTP Pemrograman Web Lanjut (PWL)** dengan implementasi:

-   MVC Laravel
-   Relasi Many-to-Many
-   Middleware & Policy
-   Blade + Bootstrap 5
-   Tema modern Rich-Black × Vivid-Yellow

## 🛠 Fitur Utama

### 👑 Admin

-   CRUD Kegiatan (nama, tanggal, lokasi, deskripsi)
-   CRUD Panitia per kegiatan (tambah, ubah jabatan, hapus)
-   Melihat semua progress kegiatan
-   Dashboard admin modern & clean

### 👤 Panitia

-   Melihat daftar kegiatan yang diikuti
-   Melihat detail progja (info kegiatan)
-   CRUD progress (hanya milik sendiri)
-   Status: `PLANNED`, `ONGOING`, `BLOCKED`, `DONE`

### 📈 Progress Monitoring

-   Persentase progress (0–100%)
-   Deskripsi pekerjaan
-   Akses dibatasi oleh Policy (keamanan terjaga)

## 📂 Struktur Folder Utama
```

app/
├── Http/
│ ├── Controllers/
│ ├── Middleware/
│ └── Requests/
├── Models/

resources/
└── views/
├── auth/
├── dashboard/
├── kegiatan/
├── panitia/
└── layouts/

public/
├── css/
└── assets/

database/
├── migrations/
└── seeders/

````



## 🚀 Instalasi & Menjalankan Project

### 1️⃣ Clone repository
```bash
git clone https://github.com/Putraa70/UTP_PWL.git
cd UTP_PWL
````

### 2️⃣ Install dependency Laravel

```bash
composer install
```

### 3️⃣ Install dependency frontend (opsional)

```bash
npm install
npm run build
```

### 4️⃣ Copy file environment

```bash
cp .env.example .env
```

### 5️⃣ Generate key Laravel

```bash
php artisan key:generate
```

### 6️⃣ Atur database di `.env`

Contoh PostgreSQL:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=himakom
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### 7️⃣ Migrasi database + seeder

```bash
php artisan migrate --seed
```

### 8️⃣ Jalankan server

```bash
php artisan serve
```

Akses di browser:

```
http://localhost:8000
```

## 🔐 Akun Login Default (Seeder)

```txt
Admin:
email: admin@example.com
password: password

Panitia:
email: panitia@example.com
password: password
```

## 🎨 Tema UI

Desain menggunakan:

-   **Rich Black Base**
-   **Vivid Yellow Accent**
-   Card modern & shadow elevation
-   Bootstrap Icons
-   Navbar blur aesthetic

## 👨‍💻 Developer

**Putra**
Ilmu Komputer – FMIPA Universitas Lampung
GitHub: [https://github.com/Putraa70](https://github.com/Putraa70)

## 📝 Lisensi

Project ini dibuat untuk keperluan akademik
**UTP Pemrograman Web Lanjut (PWL)**
Universitas Lampung.
