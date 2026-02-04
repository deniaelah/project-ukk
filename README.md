# Aplikasi Peminjaman Alat

## 📌 Judul Tugas
Pengembangan Aplikasi Peminjaman Alat

## 📝 Deskripsi Singkat
Aplikasi Peminjaman Alat adalah aplikasi berbasis web yang digunakan untuk mengelola proses peminjaman dan pengembalian alat.  
Aplikasi ini memiliki **3 level pengguna**, yaitu **Admin**, **Petugas**, dan **Peminjam**, dengan hak akses dan fitur yang berbeda.

---

## 👥 Level Pengguna
1. **Admin**
2. **Petugas**
3. **Peminjam**

---

## ⚙️ Fitur Aplikasi

### Admin
- Login & Logout
- CRUD User
- CRUD Data Alat
- CRUD Kategori
- CRUD Data Peminjaman
- CRUD Data Pengembalian
- Melihat Log Aktivitas

### Petugas
- Login & Logout
- Menyetujui Peminjaman
- Memantau Pengembalian
- Mencetak Laporan

### Peminjam
- Login & Logout
- Melihat Daftar Alat
- Mengajukan Peminjaman
- Mengembalikan Alat

---

## 🔄 Alur Aplikasi Peminjaman Alat

### 1️⃣ Alur Login
1. Pengguna membuka halaman login
2. Pengguna memasukkan email dan password
3. Sistem memverifikasi akun
4. Sistem mengarahkan pengguna ke dashboard sesuai role

---

### 2️⃣ Alur Admin
1. Admin login ke sistem
2. Admin mengelola:
   - Data user
   - Data alat
   - Data kategori
3. Admin mengelola data peminjaman dan pengembalian
4. Admin memantau log aktivitas sistem
5. Admin logout

---

### 3️⃣ Alur Petugas
1. Petugas login
2. Petugas melihat daftar peminjaman
3. Petugas menyetujui atau menolak peminjaman
4. Petugas memantau pengembalian alat
5. Petugas mencetak laporan peminjaman
6. Petugas logout

---

### 4️⃣ Alur Peminjam
1. Peminjam login
2. Peminjam melihat daftar alat yang tersedia
3. Peminjam mengajukan peminjaman alat
4. Sistem menyimpan status peminjaman (menunggu persetujuan)
5. Setelah disetujui, peminjam mengambil alat
6. Peminjam mengembalikan alat
7. Sistem mencatat pengembalian
8. Peminjam logout

---

## 🛠️ Langkah-Langkah Pembuatan Aplikasi

### 1️⃣ Analisis Kebutuhan
- Menentukan fitur berdasarkan level pengguna
- Menentukan alur peminjaman dan pengembalian
- Menentukan struktur database

---

### 2️⃣ Perancangan Sistem
- Perancangan database (users, alat, kategori, peminjaman, pengembalian, log aktivitas)
- Perancangan use case dan alur aplikasi
- Perancangan tampilan (UI)

---

### 3️⃣ Implementasi
- Membuat autentikasi login & logout
- Membuat sistem role (Admin, Petugas, Peminjam)
- Mengimplementasikan CRUD data
- Mengimplementasikan proses peminjaman & pengembalian
- Membuat fitur laporan

---

### 4️⃣ Pengujian
- Pengujian login setiap role
- Pengujian peminjaman dan pengembalian
- Pengujian hak akses fitur
- Pengujian cetak laporan

---

### 5️⃣ Deployment
- Konfigurasi environment
- Migrasi database
- Aplikasi siap digunakan

---

## 🧑‍💻 Teknologi yang Digunakan
- Laravel
- PHP
- MySQL
- Bootstrap
- HTML, CSS, JavaScript

---

## ✅ Kesimpulan
Aplikasi Peminjaman Alat memudahkan pengelolaan peminjaman dan pengembalian alat secara terstruktur, aman, dan sesuai dengan hak akses masing-masing pengguna.
