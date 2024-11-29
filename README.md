## Langkah-langkah Menjalankan Aplikasi

Berikut adalah langkah-langkah untuk menjalankan aplikasi setelah Anda telah mengkloning repository:

1. **Instal Dependensi**
    ```
    composer install
    ```

2. **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` atau gunakan script dibawah ini dan sesuaikan konfigurasi dalam file `.env` sesuai dengan lingkungan Anda.
    ```
    cp .env.example .env
    ```

3. **Generate Key Aplikasi**
    ```
    php artisan key:generate
    ```

4. **Migrasi Basis Data (jika diperlukan)**
    Jika proyek Anda menggunakan migrasi database, jalankan migrasi untuk membuat atau memperbarui struktur database.
    ```
    php artisan migrate
    ```

5. **Pengisian Basis Data (jika diperlukan lagi)**
    Jika proyek Anda sudah menggunakan migrasi database, namun masih kosong datanya, jalankan seed ini untuk membuat user admin untuk login.
    ```
    php artisan db:seed
    ```

    - username : admin@mythico.com
    - password : mythico
  
6. **Buat hyperlink untuk storage ke public**
    agar file yang disimpan dari lokal ke server bisa diakses jalankan command berikut:
    ```
    php artisan storage:link
    ```
7. **Jalankan npm**
    melakukan kompilasi aset secara real-time selama proses pengembangan
    ```
    npm run dev
    ```

8. **Jalankan Server**
    Terakhir, jalankan server pengembangan bawaan Laravel menggunakan perintah:
    ```
    php artisan serve
    ```

Setelah itu, Anda dapat mengakses aplikasi Anda di `http://localhost:8000` atau `http://127.0.0.1:8000/` dalam browser web Anda.

## Library

SweetAlert
https://realrashid.github.io/sweet-alert/
