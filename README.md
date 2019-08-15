# BarangKu

BarangKu adalah aplikasi pengelolaan data barang berbasis web. Aplikasi BarangKu dibuat menggunakan framework Laravel, PHP 7.2, MariaDB 10.

- Owner dapat daftar dan login.
- Owner dapat menambah, melihat, memperbarui, dan menghapus data admin dan staff.
- Owner dapat melihat data barang.
- Owner dapat memperbarui data tempat usahanya.
- Admin dapat melihat data pengguna (owner, admin, staff) pada tempat usahanya.
- Admin dapat menambah, melihat, memperbarui, dan menghapus data barang.
- Staff dapat melihat data pengguna.
- Staff dapat melihat data barang.

## Penggunaan

Membuat database baru dengan nama db_barangku, kemudian import data yang berada di file :

```bash
db_barangku.sql
```
Buka Terminal atau Command Prompt dan arahkan ke folder yang digunakan untuk menyimpan aplikasinya dengan perintah :
```bash
cd /d C:\xampp\htdocs\BARANGKU
```
Kemudian, jalankan aplikasinya melalui Terminal atau Command Prompt dengan perintah :
```bash
php artisan serve
```
Buka Web Browser dan masukkan alamat URL localhost dengan port 8000 :
```bash
http://localhost:8000
```
