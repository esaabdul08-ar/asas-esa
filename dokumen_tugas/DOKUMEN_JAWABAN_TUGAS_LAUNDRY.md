# DOKUMEN LAPORAN & JAWABAN TUGAS PROYEK
## SISTEM INFORMASI MANAJEMEN LAUNDRY BERBASIS WEB (CLEANWASH LAUNDRY)
**Peserta Ujian / Siswa:** Esa Abdul  
**Repositori GitHub:** https://github.com/esaabdul08-ar/asas-esa  
**Waktu Penyusunan:** November 2026  

---

## 📁 DAFTAR ISI JAWABAN TUGAS GOOGLE FORM:
1. [Jawaban Nomor 1: Penjelasan Database & Migration](#1-jawaban-nomor-1-penjelasan-database--migration)
2. [Jawaban Nomor 2: Screenshot Login & Register (Desktop, Tab, HP) & Perbedaan Role](#2-jawaban-nomor-2-screenshot-login--register-dan-perbedaan-role-admin-vs-kasir)
3. [Jawaban Nomor 3: Screenshot CRUD Layanan (Desktop, Tab, HP) & Penjelasannya](#3-jawaban-nomor-3-screenshot-crud-layanan-desktop-tab-hp--penjelasannya)
4. [Jawaban Nomor 4: Screenshot Order & Rekap Order (Desktop, Tab, HP) & Penjelasannya](#4-jawaban-nomor-4-screenshot-order--rekap-order-desktop-tab-hp--penjelasannya)
5. [Jawaban Nomor 5: Log Penggunaan AI (AI Prompting)](#5-jawaban-nomor-5-log-penggunaan-ai-ai-prompting)

---

### 1. JAWABAN NOMOR 1: PENJELASAN DATABASE & MIGRATION

#### A. Deskripsi Singkat:
Migration pada Laravel berfungsi sebagai *version control* untuk database, memungkinkan pendefinisian struktur dan tipe data tabel secara terprogram tanpa perlu membuat tabel manual di phpMyAdmin.

Pada aplikasi **Sistem Informasi Manajemen Laundry**, terdapat 4 tabel utama yang saling berelasi:
1. **Tabel `users`:**
   - Menyimpan akun pengguna sistem.
   - Kolom utama: `id`, `name`, `email`, `password`, dan kolom pembeda hak akses **`role`** (`enum: 'admin', 'kasir', 'pengguna'`).
2. **Tabel `packages` (Master Layanan Laundry):**
   - Menyimpan katalog layanan cucian yang disediakan.
   - Kolom utama: `id`, `name` (Reguler, Ekspres, Superkilat), `price` (tarif per kg), `stock` (kapasitas/kuota harian mesin), `estimate` (waktu pengerjaan), `description`.
3. **Tabel `orders` (Header Transaksi Laundry):**
   - Menyimpan data transaksi cucian masuk dari pelanggan.
   - Kolom utama: `id`, `user_id` (foreign key ke tabel users), `customer_name` (nama pelanggan), `customer_phone` (nomor WhatsApp aktif), `order_code` (kode nota transaksi unik, contoh: `LND-20261124-XXXX`), `total_price` (total biaya tagihan), `status` (status cucian: `Pending`, `Proses`, `Selesai`, `Batal`).
4. **Tabel `order_details` (Rincian Item Transaksi):**
   - Menghubungkan transaksi dengan jenis layanan yang dipilih (*Relasi Many-to-One*).
   - Kolom utama: `id`, `order_id` (foreign key ke orders), `package_id` (foreign key ke packages), `quantity` (berat cucian dalam kg atau jumlah potong), `price` (tarif per kg saat transaksi dibuat), `subtotal` (hasil kali `quantity * price`).

#### B. Skema Relasi Database:
- **`users` ➔ `orders`:** *One-to-Many* (1 Kasir/Admin dapat mencatat banyak transaksi nota).
- **`orders` ➔ `order_details`:** *One-to-Many* (1 Nota transaksi dapat memuat banyak rincian cucian).
- **`packages` ➔ `order_details`:** *One-to-Many* (1 Jenis layanan dapat dipesan di berbagai rincian transaksi).

#### C. File Tangkapan Layar (Screenshot) Tersedia:
- 📸 File: `screenshots/00_migration_status.png` *(Status eksekusi seluruh migrasi tabel sukses Ran Batch 1)*.

---

### 2. JAWABAN NOMOR 2: SCREENSHOT LOGIN & REGISTER DAN PERBEDAAN ROLE ADMIN VS KASIR

#### A. Perbedaan Hak Akses Role Admin dan Kasir:
| Fitur / Hak Akses | Role Administrator (Admin) | Role Kasir (Operator) |
| :--- | :---: | :---: |
| **Login ke Sistem** | ✅ Ya | ✅ Ya |
| **Lihat Dashboard Rekap Transaksi** | ✅ Ya (Seluruh data) | ✅ Ya (Data operasional) |
| **Input Transaksi Cucian Baru** | ✅ Ya | ✅ Ya (Fokus utama kasir) |
| **Ubah Status Pengerjaan (Proses ➔ Selesai)** | ✅ Ya | ✅ Ya |
| **Kirim Notifikasi Otomatis via WhatsApp** | ✅ Ya | ✅ Ya |
| **Tambah, Ubah, & Hapus Data Layanan (CRUD)** | ✅ Ya (Akses Penuh) | ❌ Tidak Memiliki Akses |
| **Lihat Akumulasi Laporan Keuangan Omset** | ✅ Ya | ❌ Terbatas |

**Kesimpulan:**  
- **Admin:** Bertindak sebagai pemilik usaha/manajer yang berwenang mengatur harga layanan, kuota kapasitas mesin cuci, serta memantau omset pendapatan.
- **Kasir:** Bertindak sebagai staf operasional di garda depan yang bertugas menerima pakaian kotor, menimbang berat, mencatat nama & nomor HP pelanggan, menerbitkan nota, dan memperbarui status pengerjaan pakaian saat sudah selesai dicuci.

#### B. File Tangkapan Layar (Screenshot) Responsif:
- **Halaman Login:**
  - 🖥️ Desktop (1280x800): `screenshots/01_login_desktop.png`
  - 📱 Tablet (768x1024): `screenshots/01_login_tablet.png`
  - 📱 Layar HP (375x812): `screenshots/01_login_hp.png`
- **Halaman Register:**
  - 🖥️ Desktop (1280x800): `screenshots/02_register_desktop.png`
  - 📱 Tablet (768x1024): `screenshots/02_register_tablet.png`
  - 📱 Layar HP (375x812): `screenshots/02_register_hp.png`

---

### 3. JAWABAN NOMOR 3: SCREENSHOT CRUD LAYANAN (DESKTOP, TAB, HP) & PENJELASANNYA

#### A. Penjelasan Fitur CRUD Layanan:
Fitur ini digunakan oleh Admin untuk mengelola jenis layanan cuci yang ditawarkan:
1. **Create (Tambah):** Admin dapat menambahkan jenis layanan baru dengan menginput nama layanan, tarif harga per kg, kuota kapasitas harian mesin, estimasi pengerjaan, dan spesifikasi fasilitas cuci.
2. **Read (Tampil):** Menampilkan daftar seluruh paket (*Reguler Rp 7.000/kg, Ekspres Rp 12.000/kg, Superkilat Rp 25.000/kg*) dalam tabel modern lengkap dengan indikator badge durasi dan stok.
3. **Update (Ubah):** Admin dapat memperbarui tarif harga per kg, mengubah durasi estimasi pengerjaan, atau menambah kuota mesin jika terjadi perubahan operasional.
4. **Delete (Hapus):** Menghapus layanan yang sudah tidak aktif disertai kotak dialog konfirmasi pengaman agar data tidak sengaja terhapus.

#### B. File Tangkapan Layar (Screenshot) Responsif:
- **Tabel Daftar Layanan (Read & Action):**
  - 🖥️ Desktop (1280x800): `screenshots/05_crud_layanan_desktop.png`
  - 📱 Tablet (768x1024): `screenshots/05_crud_layanan_tablet.png`
  - 📱 Layar HP (375x812): `screenshots/05_crud_layanan_hp.png`
- **Form Tambah Layanan (Create):**
  - 🖥️ Desktop (1280x800): `screenshots/06_tambah_layanan_desktop.png`
  - 📱 Tablet (768x1024): `screenshots/06_tambah_layanan_tablet.png`
  - 📱 Layar HP (375x812): `screenshots/06_tambah_layanan_hp.png`

---

### 4. JAWABAN NOMOR 4: SCREENSHOT ORDER & REKAP ORDER (DESKTOP, TAB, HP) & PENJELASANNYA

#### A. Penjelasan Alur Transaksi Order & Rekap:
1. **Sisi Order (Terminal Kasir / Pelanggan):**
   - Kasir/pelanggan memasukkan identitas nama pemilik cucian dan nomor WhatsApp aktif.
   - Memilih jenis layanan yang diinginkan (*Reguler, Ekspres, atau Superkilat*).
   - Menentukan takaran berat cucian (kg) menggunakan tombol plus/minus interaktif.
   - Sistem secara otomatis menghitung subtotal dan total biaya tagihan secara *real-time* via JavaScript.
   - Menampilkan modal pratinjau **E-Nota Digital** terenkripsi sebelum transaksi disimpan ke database.
2. **Sisi Rekap Order (Command Center / Dashboard):**
   - Menampilkan 5 kartu KPI telemetri: Total Nota, Antrean (Pending), Sedang Dicuci (Proses), Siap Diambil (Selesai), dan Total Omset Pendapatan.
   - Fitur pencarian instan (*Live Search*) berdasarkan nama pelanggan atau kode nota transaksi.
   - Tab filter status (*Semua, Pending, Proses, Selesai*).
   - Tombol **`💬 TRANSMIT WA`**: Mengirim pesan notifikasi otomatis yang terhubung langsung ke aplikasi WhatsApp pelanggan beserta nomor nota dan status cuciannya.
   - Dropdown pengubah status pengerjaan dari **Proses** menjadi **Selesai**.

#### B. File Tangkapan Layar (Screenshot) Responsif:
- **Halaman Form Order Cucian:**
  - 🖥️ Desktop (1280x800): `screenshots/03_order_cucian_desktop.png`
  - 📱 Tablet (768x1024): `screenshots/03_order_cucian_tablet.png`
  - 📱 Layar HP (375x812): `screenshots/03_order_cucian_hp.png`
- **Halaman Rekap Transaksi (Dashboard):**
  - 🖥️ Desktop (1280x800): `screenshots/04_rekap_order_desktop.png`
  - 📱 Tablet (768x1024): `screenshots/04_rekap_order_tablet.png`
  - 📱 Layar HP (375x812): `screenshots/04_rekap_order_hp.png`

---

### 5. JAWABAN NOMOR 5: LOG PENGGUNAAN AI (AI PROMPTING)

Tabel berikut adalah bukti dokumentasi proses kolaborasi peserta didik bersama AI dalam merancang dan mengembangkan sistem laundry:

| No | Tahap Pengembangan | Tujuan / Masalah yang Diselesaikan | Ringkasan Prompt ke AI | Penyesuaian Manual yang Dilakukan Siswa |
| :---: | :--- | :--- | :--- | :--- |
| **1** | **Perancangan Database & Migrasi** | Membuat skema database Laravel untuk pengguna multi-role (Admin dan Kasir), master layanan cucian, serta transaksi order yang berelasi. | *"Buatkan kode migration Laravel untuk sistem informasi laundry dengan tabel users (role admin dan kasir), packages (Reguler, Ekspres, Superkilat), dan orders yang saling berelasi."* | Menambahkan kolom `customer_phone` untuk integrasi kontak WhatsApp dan menyetel nilai default status cucian menjadi `'Pending'` / `'Proses'`. |
| **2** | **Konfigurasi Autentikasi & Model Relasi** | Mengatur relasi antar tabel Eloquent ORM serta fungsi pengecekan hak akses role pada model User. | *"Tuliskan kode Eloquent Model untuk Package, Order, OrderDetail, dan User dengan relasi hasMany dan belongsTo serta method cek role."* | Menambahkan method `isAdmin()` dan `isKasir()` pada model User untuk memvalidasi hak akses navigasi dan tombol aksi. |
| **3** | **Implementasi CRUD Master Layanan** | Membangun fitur tambah, edit, hapus, dan tampilkan data jenis layanan cuci khusus role Admin. | *"Buatkan PackageController bertipe resource dan view Blade dengan tampilan futuristik untuk mengelola master data layanan laundry."* | Menyesuaikan nama tarif dan estimasi pengerjaan sesuai soal ujian: Reguler (Rp 7.000/kg, 3-4 hari), Ekspres (Rp 12.000/kg, 1-2 hari), Superkilat (Rp 25.000/kg, 5 jam). |
| **4** | **Logika Transaksi Kasir & Hitung Otomatis** | Membuat antarmuka pemesanan cucian dengan kalkulasi harga otomatis saat berat/kuantitas dimasukkan. | *"Buatkan form kasir laundry dengan pilihan paket dan input berat (kg) menggunakan JavaScript agar total harga terhitung secara otomatis dan muncul modal konfirmasi nota."* | Menambahkan tombol plus/minus interaktif, validasi form nama dan nomor telepon, serta format mata uang Rupiah (`toLocaleString('id-ID')`). |
| **5** | **Update Status Pengerjaan & Integrasi WhatsApp** | Memungkinkan kasir memperbarui status cucian dari Proses ke Selesai serta mengirim pesan WhatsApp instan ke pelanggan. | *"Bagaimana cara membuat dropdown update status cucian serta tombol kirim pesan otomatis ke WhatsApp pelanggan via URL wa.me?"* | Menambahkan format pembersihan nomor telepon (`08xx ➔ 628xx`) dan URL-encode template pesan konfirmasi status cucian. |
| **6** | **Dashboard Telemetri & Desain UI Futuristik** | Mendesain antarmuka dashboard monitoring dengan kartu statistik omset dan tampilan responsif (Desktop, Tablet, HP). | *"Ubah tema antarmuka web laundry menjadi bertema sci-fi futuristik cyber-clean dengan kartu KPI statistik pendapatan dan tabel pencarian instan."* | Menambahkan filter tab status transaksi realtime (*Semua, Pending, Proses, Selesai*) dan live search bar tanpa reload halaman. |

---
*Semua berkas screenshot tersimpan di folder:*  
📁 `c:\Users\LAB RPL 11\esaasas\dokumen_tugas\screenshots`
