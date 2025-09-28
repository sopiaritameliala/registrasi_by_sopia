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
│   ├── style.css
├── images/

---

## Cara Install & Menjalankan (Panduan Deploy)
1. Clone proyek ke folder `htdocs` XAMPP/MAMP/Laragon.
2. Buat database MySQL, misal: `registrasi_sopia`.
3. Import file SQL (jika tersedia), atau buat tabel `kelas`, `pendaftaran`, dan `admin` sesuai ERD di bawah.
4. Edit `backend/koneksi.php` agar cocok dengan user/pass database lokal.
5. Jalankan `localhost/registrasi_by_sopia/`.
6. Login admin: akses `backend/login.php` (default: username `admin` / password sesuai hash).
7. Siswa mendaftar melalui `daftar.php`.

---

## API Spec 

Jika aplikasi sepenuhnya berbasis form submission, cukup dokumentasikan alur form:
- **POST** `/backend/daftar.php`  
  - Parameter: `nama`, `kelas_id`  
  - Response: HTML/alert sukses/gagal
    
- **GET** `/index.php`  
  - Output: Daftar kelas dan sisa kuota

---

## Arsitektur Sistem 

#### Arsitektur Sederhana
- **Frontend:** HTML, CSS, sedikit JS, request via form ke backend
- **Backend:** PHP procedural (koneksi database, validasi input, session management)
- **Database:** MySQL (tabel: kelas, pendaftaran, admin)

### Diagram Arsitektur

Browser (User/Admin) 
| 
v 
PHP Frontend/Form ––> PHP Backend Logic ––> MySQL Database 
^  | 
Session/Cookie    |  | Query 
|  v 
Dashboard/Daftar


---

## ERD (Entity Relationship Diagram)

+———————+        +–––––––––––+ 
| kelas |        | pendaftaran | 
+———————+        +–––––––––––+ 
|id (int, PK)| <––> |id (int, PK)| 
|nama (varchar)| | nama_siswa (varchar) | 
| kuota (int) |   | kelas_id (int, FK)   | 
+———————+        +–––––––––––+ 
^ 
|
+—————+ 
| admin | 
+—————+ | id (int, PK)  | 
| username      | 
| password_hash | 
+—————+

- "Pendafataran.kelas_id" adalah foreign key ke kelas.id

---

## Panduan Deploy 

- Pastikan XAMPP/MAMP sudah aktif, folder sudah ada di `htdocs`.
- Cek file koneksi, beri hak akses file/folder jika di server.
- Dokumentasi versi PHP/MySQL, minimal requirements tool (contoh: PHP 7.4+/MySQL 5.7+).
- Untuk online, gunakan hosting yang support PHP & MySQL, upload semua file, export-import database.
- Cek ulang URL base-path yang dipanggil di aplikasi.

---



