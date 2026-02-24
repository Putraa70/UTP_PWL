# 📌 HIMAKOM Manager – Laravel 11
Sistem Manajemen Kegiatan & Kepanitiaan  
UTP Pemrograman Web Lanjut (PWL) – Universitas Lampung

---

## ✨ Deskripsi Project

HIMAKOM Manager adalah aplikasi web berbasis **Laravel 10** untuk mengelola:

- Data kegiatan HIMAKOM  
- Kepanitiaan setiap kegiatan  
- Progress kerja panitia  
- Role-based access (Admin & Panitia)

Project ini dibuat sebagai bagian dari **UTP Pemrograman Web Lanjut (PWL)** dengan implementasi:

- MVC Laravel  
- Relasi Many-to-Many  
- Middleware & Policy  
- Blade + Bootstrap 5  
- Tema modern Rich-Black × Vivid-Yellow  

---

## 🛠 Fitur Utama

### 👑 Admin
- CRUD Kegiatan (nama, tanggal, lokasi, deskripsi)
- CRUD Panitia per kegiatan (tambah, ubah jabatan, hapus)
- Melihat semua progress kegiatan
- Dashboard admin modern & clean

### 👤 Panitia
- Melihat daftar kegiatan yang diikuti
- Melihat detail progja
- CRUD progress (hanya milik sendiri)
- Status: `PLANNED`, `ONGOING`, `BLOCKED`, `DONE`

### 📈 Progress Monitoring
- Persentase progress (0–100%)
- Deskripsi pekerjaan
- Akses dibatasi oleh Policy (keamanan terjaga)

---

## 📂 Struktur Folder Utama

```txt
app/
 ├── Http/
 │    ├── Controllers/
 │    ├── Middleware/
 │    └── Requests/
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
