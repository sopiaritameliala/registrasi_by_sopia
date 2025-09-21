# registrasi_by_sopia
Sistem pendaftaran kelas berbasis web dengan fitur kuota real-time dan manajemen peserta

## Deskripsi Proyek
Aplikasi web sederhana untuk pendaftaran kelas dengan kuota real-time. Siswa dapat melihat daftar kelas, sisa kuota, mendaftar, dan menerima konfirmasi otomatis. Admin dapat mengelola kelas, kuota, dan melihat daftar peserta.

## Fitur Utama
- Melihat daftar kelas dan kuota tersisa
- Pendaftaran kelas oleh siswa
- Konfirmasi pendaftaran otomatis
- Admin mengelola kelas dan kuota
- Admin melihat dan mengedit data pendaftar
- Penghapusan data pendaftar

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
