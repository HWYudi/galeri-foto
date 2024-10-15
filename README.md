# Website Galeri Foto Laravel

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
   ```
   ```
   cd website-galeri-foto
   ```
   

2. Salin file .env.example menjadi .env:
   ```
   cp .env.example .env
   ```
   

3. Konfigurasikan file .env dengan pengaturan database Anda:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=galeri
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    ```
    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    ```
    

4. Instal dependensi PHP:
   ```
   composer install
   ```
   

5. Generate kunci aplikasi:
   ```
   php artisan key:generate
   ```
   

6. Jalankan migrasi database:
   ```
   php artisan migrate
   ```
   

7. Instal dependensi JavaScript:
   ```
   npm install
   ```
   

8. Kompilasi aset:
   ```
   npm run dev
   ```
   

9. Hapus izin penyimpanan agar fitur unggah foto berjalan lancar:
   ```
   rmdir public\storage
   ```
   
   Lalu tekan Enter

10. Buat symbloic link untuk penyimpanan:
    ```
    php artisan storage:link
    ```
    

## Menjalankan Aplikasi

1. Mulai server pengembangan Laravel:
   ```
   php artisan serve
   ```
   

2. Di terminal terpisah, pantau perubahan aset:

   ```
   npm run watch
   ```
   

3. Buka browser Anda dan kunjungi http://localhost:8000 untuk melihat aplikasi.

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
