# Sistem Informasi Persediaan Barang (Inventory Management System)

Aplikasi persediaan barang berbasis web yang dirancang untuk mempermudah pencatatan, pengelolaan stok, transaksi barang masuk & keluar, serta pembuatan laporan secara terintegrasi dan akurat.

---

## 🛠️ Fitur Utama

- **Dashboard**: Menampilkan ringkasan total stok, barang masuk, barang keluar, serta aktivitas terbaru.
- **Manajemen Master Data**:
  - Data Barang (Kode, Nama, Kategori, Satuan, Stok Minimal, Stok Saat Ini)
  - Data Kategori / Jenis Barang
  - Data Supplier / Vendor
- **Transaksi**:
  - **Barang Masuk**: Pencatatan riwayat barang yang diterima dari supplier.
  - **Barang Keluar**: Pencatatan riwayat barang yang keluar/dipakai/dijual.
- **Laporan & Export**:
  - Laporan stok barang (real-time)
  - Laporan rekapitulasi barang masuk & keluar per periode
- **Manajemen Pengguna (User Management)**: Autentikasi dan kontrol hak akses (Admin / User).

---

## 💻 Spesifikasi & Teknologi

- **Bahasa Pemrograman**: PHP
- **Database**: MySQL / MariaDB
- **Server**: Apache / Nginx (XAMPP)
- **Frontend**: HTML5, CSS3, JavaScript

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Prasyarat System
Pastikan server lokal Anda sudah terpasang:
- **PHP** (Minimal versi 7.4 / 8.x)
- **MySQL / MariaDB**
- **XAMPP**

### 2. Langkah-Langkah Instalasi

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/trigusf/persediaan-barang.git](https://github.com/trigusf/persediaan-barang.git)
   cd persediaan-barang
