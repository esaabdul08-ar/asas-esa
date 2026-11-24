import os

html_content = """<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Jawaban Tugas Sistem Laundry Laravel - Esa Abdul</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap');
        
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --secondary: #0ea5e9;
            --dark: #0f172a;
            --gray: #64748b;
            --light-bg: #f8fafc;
            --border: #e2e8f0;
            --card-bg: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            color: #334155;
            line-height: 1.6;
            padding: 40px 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 50px 60px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .header-doc {
            border-bottom: 2px solid var(--border);
            padding-bottom: 25px;
            margin-bottom: 35px;
        }

        .badge-header {
            display: inline-block;
            background: #e0f2fe;
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 9999px;
            margin-bottom: 12px;
        }

        h1 {
            font-size: 26px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 14px;
            color: var(--gray);
            margin-top: 15px;
        }

        .meta-info span strong {
            color: var(--dark);
        }

        .toc-box {
            background: #f1f5f9;
            border-left: 4px solid var(--primary);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 40px;
        }

        .toc-box h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .toc-box ol {
            padding-left: 20px;
            font-size: 14px;
        }

        .toc-box li {
            margin-bottom: 6px;
        }

        .toc-box a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .toc-box a:hover {
            text-decoration: underline;
        }

        .section-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .section-number {
            width: 36px;
            height: 36px;
            background: var(--primary);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            flex-shrink: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark);
        }

        h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
            margin: 18px 0 8px 0;
        }

        p {
            font-size: 14px;
            color: #475569;
            margin-bottom: 14px;
        }

        ul, ol {
            padding-left: 22px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #475569;
        }

        li {
            margin-bottom: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 18px 0;
            font-size: 13.5px;
        }

        table th, table td {
            border: 1px solid var(--border);
            padding: 10px 14px;
            text-align: left;
        }

        table th {
            background: #f8fafc;
            color: var(--dark);
            font-weight: 700;
        }

        .img-grid-responsive {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .img-card {
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
        }

        .img-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: top;
            display: block;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .img-card img:hover {
            transform: scale(1.02);
        }

        .img-caption {
            padding: 8px 10px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--gray);
            text-align: center;
        }

        .single-img {
            max-width: 100%;
            border-radius: 10px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            margin: 15px 0;
            display: block;
        }

        .badge-check {
            color: #10b981;
            font-weight: 700;
        }

        .badge-cross {
            color: #ef4444;
            font-weight: 700;
        }

        .code-inline {
            font-family: 'JetBrains Mono', monospace;
            background: #f1f5f9;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 13px;
            color: #0f172a;
        }

        .footer-note {
            text-align: center;
            font-size: 13px;
            color: var(--gray);
            margin-top: 40px;
            border-top: 1px solid var(--border);
            padding-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 25px 20px;
            }
            .img-grid-responsive {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-doc">
        <div class="badge-header">Dokumen Jawaban Ujian Praktik SMK RPL</div>
        <h1>SISTEM INFORMASI MANAJEMEN LAUNDRY BERBASIS LARAVEL</h1>
        <div class="meta-info">
            <span><strong>Nama Siswa:</strong> Esa Abdul</span>
            <span><strong>Repositori GitHub:</strong> <a href="https://github.com/esaabdul08-ar/asas-esa" target="_blank" style="color:#0284c7;">https://github.com/esaabdul08-ar/asas-esa</a></span>
            <span><strong>Status Ujian:</strong> ASAS / Serkom Kejuruan RPL</span>
        </div>
    </div>

    <div class="toc-box">
        <h3>📋 Daftar Pertanyaan Google Form:</h3>
        <ol>
            <li><a href="#q1">Jelaskan Migration yang kalian buat (SS & Penjelasan)</a></li>
            <li><a href="#q2">SS Login & Register Desktop, Tab, HP & Perbedaan Role Admin vs Kasir</a></li>
            <li><a href="#q3">SS CRUD Layanan Desktop, Tab, HP & Penjelasannya</a></li>
            <li><a href="#q4">SS Order & Rekap Order Desktop, Tab, HP & Penjelasannya</a></li>
            <li><a href="#q5">Log Penggunaan AI (Prompting Log Table)</a></li>
        </ol>
    </div>

    <!-- SOAL 1 -->
    <div class="section-card" id="q1">
        <div class="section-header">
            <div class="section-number">1</div>
            <div class="section-title">Penjelasan Database & Migration</div>
        </div>

        <h4>A. Deskripsi Fungsi Migration Laravel</h4>
        <p>Migration pada Laravel berfungsi sebagai <em>version control</em> skema database, memungkinkan pendefinisian struktur tabel secara konsisten dan terprogram tanpa perlu manipulasi manual di phpMyAdmin.</p>
        
        <h4>B. Rincian 4 Tabel Utama Sistem:</h4>
        <ol>
            <li><strong>Tabel <span class="code-inline">users</span>:</strong> Menyimpan data pengguna aplikasi. Memiliki kolom hak akses <span class="code-inline">role</span> (<span class="code-inline">'admin'</span>, <span class="code-inline">'kasir'</span>, <span class="code-inline">'pengguna'</span>).</li>
            <li><strong>Tabel <span class="code-inline">packages</span>:</strong> Menyimpan master data layanan laundry (Reguler, Ekspres, Superkilat) lengkap dengan harga per kg, kuota stok mesin, estimasi pengerjaan, dan deskripsi.</li>
            <li><strong>Tabel <span class="code-inline">orders</span>:</strong> Menyimpan header transaksi pemesanan laundry oleh pelanggan, termasuk kode nota unik (<span class="code-inline">order_code</span>), nama pelanggan, nomor WhatsApp (<span class="code-inline">customer_phone</span>), total tagihan, dan status pencucian (<span class="code-inline">Pending</span>, <span class="code-inline">Proses</span>, <span class="code-inline">Selesai</span>).</li>
            <li><strong>Tabel <span class="code-inline">order_details</span>:</strong> Rincian item pesanan yang menghubungkan <span class="code-inline">orders</span> dengan <span class="code-inline">packages</span> (Many-to-One), mencatat berat (kg), tarif satuan, dan subtotal harga.</li>
        </ol>

        <h4>C. Tangkapan Layar Status Migration:</h4>
        <img src="screenshots/00_migration_status.png" class="single-img" alt="Status Migration">
    </div>

    <!-- SOAL 2 -->
    <div class="section-card" id="q2">
        <div class="section-header">
            <div class="section-number">2</div>
            <div class="section-title">Screenshot Login & Register & Perbedaan Role Admin vs Kasir</div>
        </div>

        <h4>A. Tabel Perbedaan Hak Akses Role Admin dan Kasir</h4>
        <table>
            <thead>
                <tr>
                    <th>Fitur / Akses Sistem</th>
                    <th>Role Administrator (Admin)</th>
                    <th>Role Kasir (Operator)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Login ke Sistem</strong></td>
                    <td class="badge-check">✅ Diizinkan</td>
                    <td class="badge-check">✅ Diizinkan</td>
                </tr>
                <tr>
                    <td><strong>Lihat Dashboard Rekap Transaksi</strong></td>
                    <td class="badge-check">✅ Semua Data Transaksi</td>
                    <td class="badge-check">✅ Transaksi Operasional</td>
                </tr>
                <tr>
                    <td><strong>Input Transaksi Order Baru</strong></td>
                    <td class="badge-check">✅ Ya</td>
                    <td class="badge-check">✅ Ya (Tugas Utama)</td>
                </tr>
                <tr>
                    <td><strong>Ubah Status Cucian (Proses ➔ Selesai)</strong></td>
                    <td class="badge-check">✅ Ya</td>
                    <td class="badge-check">✅ Ya</td>
                </tr>
                <tr>
                    <td><strong>Kirim Notifikasi Otomatis via WhatsApp</strong></td>
                    <td class="badge-check">✅ Ya</td>
                    <td class="badge-check">✅ Ya</td>
                </tr>
                <tr>
                    <td><strong>Kelola CRUD Master Layanan (Tarif/Paket)</strong></td>
                    <td class="badge-check">✅ Akses Penuh (Create, Read, Update, Delete)</td>
                    <td class="badge-cross">❌ Tidak Ada Akses</td>
                </tr>
                <tr>
                    <td><strong>Monitoring Laporan Omset Keuangan</strong></td>
                    <td class="badge-check">✅ Ya (Laporan Komprehensif)</td>
                    <td class="badge-cross">❌ Terbatas / Sembunyi</td>
                </tr>
            </tbody>
        </table>

        <h4>B. Tangkapan Layar Halaman Login (Desktop, Tablet, HP)</h4>
        <div class="img-grid-responsive">
            <div class="img-card">
                <img src="screenshots/01_login_desktop.png" alt="Login Desktop">
                <div class="img-caption">🖥️ Desktop (1280px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/01_login_tablet.png" alt="Login Tablet">
                <div class="img-caption">📱 Tablet (768px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/01_login_hp.png" alt="Login HP">
                <div class="img-caption">📱 Layar HP (375px)</div>
            </div>
        </div>

        <h4>C. Tangkapan Layar Halaman Register (Desktop, Tablet, HP)</h4>
        <div class="img-grid-responsive">
            <div class="img-card">
                <img src="screenshots/02_register_desktop.png" alt="Register Desktop">
                <div class="img-caption">🖥️ Desktop (1280px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/02_register_tablet.png" alt="Register Tablet">
                <div class="img-caption">📱 Tablet (768px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/02_register_hp.png" alt="Register HP">
                <div class="img-caption">📱 Layar HP (375px)</div>
            </div>
        </div>
    </div>

    <!-- SOAL 3 -->
    <div class="section-card" id="q3">
        <div class="section-header">
            <div class="section-number">3</div>
            <div class="section-title">Screenshot Bagian CRUD Layanan & Penjelasannya</div>
        </div>

        <h4>A. Penjelasan Fitur CRUD Layanan</h4>
        <ul>
            <li><strong>Create (Tambah):</strong> Admin dapat menambahkan jenis layanan baru dengan tarif per kg, kapasitas stok mesin, dan estimasi selesai pengerjaan.</li>
            <li><strong>Read (Tampil):</strong> Menampilkan katalog seluruh paket (Reguler, Ekspres, Superkilat) dalam format tabel modern dan kartu paket.</li>
            <li><strong>Update (Ubah):</strong> Memperbarui harga per kg, durasi pengerjaan, atau kuota mesin jika terjadi perubahan beban kerja.</li>
            <li><strong>Delete (Hapus):</strong> Menghapus paket lama yang sudah tidak aktif dengan konfirmasi keamanan.</li>
        </ul>

        <h4>B. Tangkapan Layar Master Layanan (Desktop, Tablet, HP)</h4>
        <div class="img-grid-responsive">
            <div class="img-card">
                <img src="screenshots/05_crud_layanan_desktop.png" alt="CRUD Layanan Desktop">
                <div class="img-caption">🖥️ Desktop (1280px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/05_crud_layanan_tablet.png" alt="CRUD Layanan Tablet">
                <div class="img-caption">📱 Tablet (768px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/05_crud_layanan_hp.png" alt="CRUD Layanan HP">
                <div class="img-caption">📱 Layar HP (375px)</div>
            </div>
        </div>

        <h4>C. Tangkapan Layar Form Tambah Layanan (Desktop, Tablet, HP)</h4>
        <div class="img-grid-responsive">
            <div class="img-card">
                <img src="screenshots/06_tambah_layanan_desktop.png" alt="Tambah Layanan Desktop">
                <div class="img-caption">🖥️ Desktop (1280px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/06_tambah_layanan_tablet.png" alt="Tambah Layanan Tablet">
                <div class="img-caption">📱 Tablet (768px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/06_tambah_layanan_hp.png" alt="Tambah Layanan HP">
                <div class="img-caption">📱 Layar HP (375px)</div>
            </div>
        </div>
    </div>

    <!-- SOAL 4 -->
    <div class="section-card" id="q4">
        <div class="section-header">
            <div class="section-number">4</div>
            <div class="section-title">Screenshot Order & Rekap Order & Penjelasannya</div>
        </div>

        <h4>A. Penjelasan Alur Order & Rekap Transaksi</h4>
        <ul>
            <li><strong>Form Order Cucian:</strong> Kasir/pelanggan memilih paket, menginput nama & WhatsApp, serta menentukan berat (kg). Total harga dihitung otomatis secara instan oleh JavaScript dengan pratinjau E-Nota.</li>
            <li><strong>Rekap Transaksi (Dashboard):</strong> Menampilkan statistik omset, antrean aktif, fitur Live Search instan berdasarkan nama/kode nota, filter status pengerjaan, tombol ganti status (Proses &rarr; Selesai), serta tombol kirim notifikasi otomatis ke WhatsApp pelanggan.</li>
        </ul>

        <h4>B. Tangkapan Layar Form Order Cucian (Desktop, Tablet, HP)</h4>
        <div class="img-grid-responsive">
            <div class="img-card">
                <img src="screenshots/03_order_cucian_desktop.png" alt="Order Cucian Desktop">
                <div class="img-caption">🖥️ Desktop (1280px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/03_order_cucian_tablet.png" alt="Order Cucian Tablet">
                <div class="img-caption">📱 Tablet (768px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/03_order_cucian_hp.png" alt="Order Cucian HP">
                <div class="img-caption">📱 Layar HP (375px)</div>
            </div>
        </div>

        <h4>C. Tangkapan Layar Rekap Transaksi / Dashboard (Desktop, Tablet, HP)</h4>
        <div class="img-grid-responsive">
            <div class="img-card">
                <img src="screenshots/04_rekap_order_desktop.png" alt="Rekap Order Desktop">
                <div class="img-caption">🖥️ Desktop (1280px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/04_rekap_order_tablet.png" alt="Rekap Order Tablet">
                <div class="img-caption">📱 Tablet (768px)</div>
            </div>
            <div class="img-card">
                <img src="screenshots/04_rekap_order_hp.png" alt="Rekap Order HP">
                <div class="img-caption">📱 Layar HP (375px)</div>
            </div>
        </div>
    </div>

    <!-- SOAL 5 -->
    <div class="section-card" id="q5">
        <div class="section-header">
            <div class="section-number">5</div>
            <div class="section-title">Log Penggunaan AI (Prompting Log Table)</div>
        </div>

        <p>Tabel dokumentasi tahapan perancangan sistem menggunakan AI sesuai ketentuan kurikulum vokasi RPL:</p>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Tahap Pengembangan</th>
                    <th style="width: 25%;">Tujuan / Masalah yang Diselesaikan</th>
                    <th style="width: 25%;">Ringkasan Prompt ke AI</th>
                    <th style="width: 25%;">Penyesuaian Manual Siswa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>1</strong></td>
                    <td><strong>Perancangan Database & Migrasi</strong></td>
                    <td>Membuat skema database multi-role (Admin dan Kasir), master layanan cucian, dan transaksi order berelasi.</td>
                    <td><em>"Buatkan kode migration Laravel untuk sistem informasi laundry dengan tabel users (role admin dan kasir), packages (Reguler, Ekspres, Superkilat), dan orders yang saling berelasi."</em></td>
                    <td>Menambahkan kolom <span class="code-inline">customer_phone</span> untuk WhatsApp dan set status awal ke <span class="code-inline">'Pending'</span>.</td>
                </tr>
                <tr>
                    <td><strong>2</strong></td>
                    <td><strong>Konfigurasi Autentikasi & Model</strong></td>
                    <td>Mengatur relasi Eloquent ORM (hasMany, belongsTo) serta validasi hak akses role.</td>
                    <td><em>"Tuliskan kode Eloquent Model untuk Package, Order, OrderDetail, dan User dengan relasi hasMany dan belongsTo serta method cek role."</em></td>
                    <td>Menambahkan method <span class="code-inline">isAdmin()</span> dan <span class="code-inline">isKasir()</span> pada model User.</td>
                </tr>
                <tr>
                    <td><strong>3</strong></td>
                    <td><strong>CRUD Master Layanan</strong></td>
                    <td>Membangun fitur kelola tarif dan jenis layanan cuci khusus role Admin.</td>
                    <td><em>"Buatkan PackageController bertipe resource dan view Blade dengan tampilan modern untuk mengelola master data layanan laundry."</em></td>
                    <td>Menyesuaikan tarif: Reguler (Rp 7.000/kg), Ekspres (Rp 12.000/kg), Superkilat (Rp 25.000/kg) sesuai lembar soal.</td>
                </tr>
                <tr>
                    <td><strong>4</strong></td>
                    <td><strong>Logika Form Order & Hitung Otomatis</strong></td>
                    <td>Kalkulasi harga instan berdasarkan berat pakaian (kg) serta pratinjau nota digital.</td>
                    <td><em>"Buatkan form kasir laundry dengan pilihan paket dan input berat (kg) menggunakan JavaScript agar total harga terhitung secara otomatis."</em></td>
                    <td>Menambahkan tombol interaktif stepper (+/-), validasi nomor WhatsApp, dan format mata uang Rupiah.</td>
                </tr>
                <tr>
                    <td><strong>5</strong></td>
                    <td><strong>Update Status & Notifikasi WhatsApp</strong></td>
                    <td>Mengubah status pengerjaan pakaian dan mengirim pesan WhatsApp instan ke nomor pelanggan.</td>
                    <td><em>"Bagaimana cara membuat dropdown update status cucian serta tombol kirim pesan otomatis ke WhatsApp pelanggan via URL wa.me?"</em></td>
                    <td>Menambahkan filter nomor <span class="code-inline">08xx ➔ 628xx</span> dan URL-encode template pesan konfirmasi nota.</td>
                </tr>
                <tr>
                    <td><strong>6</strong></td>
                    <td><strong>UI Futuristik & Responsif</strong></td>
                    <td>Mendesain antarmuka dashboard monitoring dengan kartu statistik omset dan tampilan responsif (Desktop, Tablet, HP).</td>
                    <td><em>"Ubah tema antarmuka web laundry menjadi bertema modern futuristik cyber-clean dengan kartu KPI statistik omset dan tabel pencarian instan."</em></td>
                    <td>Menambahkan live search bar dan tab filter status transaksi tanpa reload halaman.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer-note">
        Dokumen ini disusun untuk melengkapi berkas jawaban Google Form Ujian ASAS / Serkom Kejuruan RPL.<br>
        <strong>CleanWash Laundry &copy; 2026. Hak Cipta Dilindungi.</strong>
    </div>
</div>

</body>
</html>
"""

output_path = r"c:\Users\LAB RPL 11\esaasas\dokumen_tugas\DOKUMEN_JAWABAN_TUGAS_LAUNDRY.html"
with open(output_path, "w", encoding="utf-8") as f:
    f.write(html_content)

print(f"HTML Document successfully created at: {output_path}")
