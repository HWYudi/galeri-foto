# Proyek Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo Laravel"></a></p>

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal hal-hal berikut pada sistem Anda:

- PHP (>= 7.3)
- Composer
- Node.js dan npm
- MySQL atau sistem database lain yang didukung oleh Laravel

## Instalasi

Ikuti langkah-langkah berikut untuk mengatur dan menjalankan proyek:

1. Klon repositori:
   ```
   git clone https://github.com/HWYudi/website-galeri-foto.git
   cd website-galeri-foto
   ```

2. Instal dependensi PHP:
   ```
   composer install
   ```

3. Instal dependensi JavaScript:
   ```
   npm install
   ```

4. Ekspor database ke phpMyAdmin

5. Hapus izin penyimpanan agar fitur unggah foto berjalan lancar:
   ```
   rmdir public\storage
   ```
   Lalu tekan Enter

6. Kemudian masukkan perintah:
   ```
   php artisan storage:link
   ```

7. Jika aplikasi menampilkan error "No application encryption key has been specified", maka generate kunci aplikasi:
   ```
   php artisan key:generate
   ```

## Menjalankan Aplikasi

1. Mulai server pengembangan Laravel:
   ```
   php artisan serve
   ```

2. Di terminal terpisah, kompilasi dan pantau perubahan aset:
   ```
   npm run dev
   ```

3. Buka browser Anda dan kunjungi `http://localhost:8000` untuk melihat aplikasi.

## Informasi Tambahan

Untuk informasi lebih lanjut tentang Laravel, lihat sumber daya berikut:

- [Dokumentasi Laravel](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts](https://laracasts.com)

## Kontribusi

Harap tinjau dan patuhi [Kode Etik](https://laravel.com/docs/contributions#code-of-conduct) saat berkontribusi pada proyek ini.

## Kerentanan Keamanan

Jika Anda menemukan kerentanan keamanan, silakan kirim email ke Taylor Otwell melalui [taylor@laravel.com](mailto:taylor@laravel.com).

## Lisensi

Proyek ini adalah perangkat lunak open-source yang dilisensikan di bawah [lisensi MIT](https://opensource.org/licenses/MIT).
