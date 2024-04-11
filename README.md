## Dokumentasi Master

- clone project ini terlebih dahulu
- buat database baru
- jalankan perintah composer update
- copy .env.example dengan nama file .env
- generate key dengan cara <b>php artisan key:generate</b>
- jalankan perintah php artisan serve untuk menjalankan aplikasi dengan IP Address local http://127.0.0.1:8000


## Penting
- silahkan buat data user terlebih dahulu (buat user admin dan public)
- silahkan buka folder <b>database->factories</b> untuk membuat data user, kemudian jalankan <b>php artisan db:seed</b> untuk generate data user yang sudah ada di <b>database->factories</b>


## Penggunaan Aplikasi
- Akses Halaman http://127.0.0.1:8000/admin untuk login admin
- Akses Halaman http://127.0.0.1:8000 untuk login user public