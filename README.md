# Sanberbook

## Tentang Sanberbook

Sanberbook adalah platform berbagi pengetahuan dan komunitas literasi yang dikembangkan menggunakan framework Laravel. Website ini dirancang untuk memungkinkan pengguna berbagi, menemukan, dan mendiskusikan buku-buku favorit mereka dalam berbagai genre.

## Tujuan

Tujuan utama Sanberbook adalah:

1. **Mendorong Budaya Literasi** - Memfasilitasi pertukaran pengetahuan dan pengalaman membaca di antara pengguna.
2. **Membangun Komunitas Pembaca** - Menciptakan ruang bagi pecinta buku untuk terhubung dan berinteraksi.
3. **Menyediakan Katalog Buku** - Menyediakan database buku yang terorganisir berdasarkan genre.
4. **Memfasilitasi Diskusi** - Memungkinkan pengguna untuk memberikan komentar dan ulasan pada buku-buku.

## Fitur Utama

- **Manajemen Buku** - Pengguna dapat menambahkan, mengedit, dan menghapus buku.
- **Kategori Genre** - Buku diorganisir berdasarkan genre untuk memudahkan pencarian.
- **Sistem Komentar** - Pengguna dapat memberikan komentar pada buku.
- **Autentikasi Pengguna** - Sistem login dan registrasi untuk pengguna.
- **Dashboard Admin** - Panel khusus untuk administrator mengelola konten.
- **Dark Mode** - Fitur tampilan gelap untuk kenyamanan membaca.

## Teknologi

Sanberbook dibangun menggunakan:

- **Laravel** - Framework PHP untuk pengembangan backend
- **Bootstrap** - Framework CSS untuk tampilan responsif
- **JavaScript** - Untuk interaktivitas pada sisi klien
- **MySQL** - Database untuk penyimpanan data

## Instalasi

1. Clone repositori ini
   ```
   git clone https://github.com/adhitamaw/sanberbook.git
   ```

2. Instal dependensi
   ```
   composer install
   npm install
   ```

3. Salin file .env.example menjadi .env dan konfigurasi database

4. Generate application key
   ```
   php artisan key:generate
   ```

5. Jalankan migrasi database
   ```
   php artisan migrate
   php artisan db:seed
   ```

6. Jalankan server
   ```
   php artisan serve
   ```

## Kontribusi

Kontribusi untuk pengembangan Sanberbook sangat diterima. Silakan buat pull request atau laporkan issue jika Anda menemukan bug atau memiliki saran untuk perbaikan.

## Lisensi

Sanberbook adalah proyek open-source yang dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
