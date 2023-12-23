# pnm-exam-jti-fe
Aplikasi untuk project tes kemampuan teknis calon karyawan PT Jelajah Teknologi Indonesia.

## Tech
- Bahasa Pemgrograman: PHP 7.4
- Framewwork: Codeigniter 3
- JS Library: Vue

## Installasi dan Konfigurasi
- Pastikan webserver sudah tersintall dan web-service dengan address localhost dapat diakses melalui browser
- Pastikan webserver sudah terintegrasi dengan PHP 7.4
- Clone, silahkan clone dari repo dengan perintah: `git clone https://github.com/munaja/pnm-exam-jti-be`
- Konfigurasi webserver sehingga pointing root path localhost menuju direktori `pnm-exam-jti-be/public`
- Salin file `pnm-exam-jti-be/application/config/config_local.php.example` dan beri nama `config_local.php` di dalam direktori yang sama.
- Pada file `config_local.php`, atur value dari konstanta `BE_API_HOST` sehingga berisi domain dan port yang dibutuhkan untuk pointing ke Backend.

## Sekilas Penjelasan
Penjelasan struktur aplikasi secara umum dapat di lihat pada website CodeIgniter, untuk sekedar diketahui poin utama development berada pada beberapa file berikut:
- `application/controllers/*`
- `application/views/*`
- `application/config/routes.php`

### Catatan
Saya tidak menugganakan Laravel sesuai rekomendasi perusahaan karena fokus saya di backend yang menggunakan bahasa pemrograman Go. Untuk FE saya menyesuaikan project terakhir saya yang menggunakan Codeigniter dengan pertimbangan menghemat waktu, selain itu relatif lebih minim-configuration.
