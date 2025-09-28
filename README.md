# registrasi_by_sopia
Aplikasi web untuk pendaftaran kelas bagi siswa dengan kuota real-time, sistem manajemen kelas oleh admin, dan konfirmasi otomatis.

## Fitur Utama
- Siswa dapat melihat daftar kelas & sisa kuota terbaru
- Siswa dapat mendaftar secara online dan menerima konfirmasi otomatis
- Admin dapat menambah, mengedit, menghapus kelas dan kuota
- Statistik dan daftar peserta tampil di dashboard admin
- Validasi dan keamanan dasar (session login, logout, timeout, validasi input)

## Struktur Folder
registrasi_by_sopia/
│   README.md 
│   index.php 
│   daftar.php 
│ 
├── backend/
│   ├── koneksi.php
│   ├── login.php 
│   ├── daftar.php 
│   ├── kelas.php 
│   ├── daftar.php
│   ├── dashboard_admin.php
│   ├── edit_kelas.php
│   ├── edit_pendaftaran.php
│   ├── hapus_kelas.php
│   ├── hapus_pendaftaran.php
│   ├── hash_password.php
│   ├── kelas_siswa.php
│   ├── list_pendaftaran.php
│   ├── login_process.php
│   ├── logout.php
│   ├── tambah_kelas.php
│   ├── update_pendaftaran.php
├── css/ 
├── js/

## Cara Install & Menjalankan (Panduan Deploy)
1. Clone proyek ke folder `htdocs` XAMPP/MAMP/Laragon.
2. Buat database MySQL, misal: `registrasi_sopia`.
3. Import file SQL (jika tersedia), atau buat tabel `kelas`, `pendaftaran`, dan `admin` sesuai ERD di bawah.
4. Edit `backend/koneksi.php` agar cocok dengan user/pass database lokal.
5. Jalankan `localhost/registrasi_by_sopia/`.
6. Login admin: akses `backend/login.php` (default: username `admin` / password sesuai hash).
7. Siswa mendaftar melalui `daftar.php`.

---

### 2. API Spec (bila ada endpoint API—opsional untuk PHP procedural)

Jika aplikasi sepenuhnya berbasis form submission, cukup dokumentasikan alur form:
- **POST** `/backend/daftar.php`  
  - Parameter: `nama`, `kelas_id`  
  - Response: HTML/alert sukses/gagal  
- **GET** `/index.php`  
  - Output: Daftar kelas dan sisa kuota

---

### 3. Arsitektur Sistem (deskripsi singkat + diagram)

#### Arsitektur Sederhana
- **Frontend:** HTML, CSS, sedikit JS, request via form ke backend
- **Backend:** PHP procedural (koneksi database, validasi input, session management)
- **Database:** MySQL (tabel: kelas, pendaftaran, admin)
- **Diagram:**

Browser (User/Admin) 
| 
v 
PHP Frontend/Form ––> PHP Backend Logic ––> MySQL Database 
^  | 
Session/Cookie    |  | Query 
|  v 
Dashboard/Daftar

- (Bisa menggunakan aplikasi draw.io/digram.net untuk versi gambar.)

---

### 4. ERD (Entity Relationship Diagram)

+———————+        +–––––––––––+ 
|       kelas         |        |     pendaftaran      | 
+———————+        +–––––––––––+ 
| id (int, PK)        | <––> | id (int, PK)         | 
| nama (varchar)      |        | nama_siswa (varchar) | 
| kuota (int)         |        | kelas_id (int, FK)   | 
+———————+        +–––––––––––+ 
^ 
|
+—————+ 
|   admin       | 
+—————+ | id (int, PK)  | 
| username      | 
| password_hash | 
+—————+

## Persyaratan Sistem
- XAMPP (Apache, MySQL) terbaru
- Browser modern (Chrome, Firefox, dll)
- Git untuk version kontrol (opsional)

## Instalasi dan Setup
1. Jalankan XAMPP, aktifkan Apache dan MySQL.
2. Import file database `registrasi_by_sopia.sql` lewat phpMyAdmin.
3. Salin folder proyek ke direktori web server XAMPP:
/Applications/XAMPP/xamppfiles/htdocs/registrasi_by_sopia/
4. Sesuaikan konfigurasi koneksi database di:
backend/koneksi.php
dengan username, password, dan nama database yang sesuai.
5. Akses form pendaftaran:
http://localhost/registrasi_by_sopia/daftar.html
6. Akses admin untuk lihat dan edit data pendaftar:
http://localhost/registrasi_by_sopia/backend/list_pendaftaran.php

## Cara Penggunaan
- Isi form pendaftaran dan submit.
- Admin dapat mengelola data pendaftaran lewat halaman admin.
- Tersedia fitur edit dan hapus data pendaftar.

## Testing
- Pastikan fitur pendaftaran, edit, hapus, dan pengelolaan berjalan lancar.
- Lakukan uji coba dengan beberapa data dummy.

## Dokumentasi Kode
- Backend: PHP dengan MySQLi, terstruktur modular.
- Frontend: HTML sederhana, mendukung validasi dasar.
- Sistem menggunakan query parametrik sederhana dan escape string.

## Catatan Tambahan
- Gunakan Personal Access Token untuk autentikasi GitHub saat push ke remote repository.
- Pastikan commit teratur dan pesan commit jelas di GitHub.

## Kontak
Jika ada pertanyaan atau butuh bantuan, silakan hubungi sopiameliala@gmail.com
