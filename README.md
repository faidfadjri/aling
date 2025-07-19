![Aling Ayam Keliling Logo](/public/assets/images/logo.png)

# Aling Ayam Keliling

Website pemesanan dan manajemen distribusi daging ayam untuk kebutuhan rumahan maupun restoran secara profesional.

---

## 🚀 Fitur Utama

- Pemesanan daging ayam secara online
- Manajemen outlet dan pengiriman
- Sistem dashboard admin berbasis Livewire
- Desain responsif dan ringan

---

## ⚙️ Instalasi dan Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek secara lokal:

### 1. Clone repository

```bash
git clone https://github.com/username/aling-ayam-keliling.git
cd aling-ayam-keliling
```

### 2. Salin file environment

```bash
cp .env.example .env
```

### 3. Generate application key

```bash
php artisan key:generate
```

### 4. Jalankan migrasi database

Pastikan koneksi database sudah disesuaikan di file `.env`, lalu jalankan:

```bash
php artisan migrate
```

### 5. Jalankan server Laravel

```bash
php artisan serve
```

### 6. Jalankan Vite (untuk assets frontend)

Buka terminal baru:

```bash
npm install
npm run dev
```

---

## 🧰 Teknologi yang Digunakan

- Laravel 10+
- Livewire
- Tailwind CSS
- Vite
- Alpine.js
- MySQL / MariaDB
- Filament

---

## 📁 Struktur Folder Penting

| Path                      | Keterangan                                |
|--------------------------|--------------------------------------------|
| `app/`                   | Backend logic (Controllers, Models)        |
| `resources/views/`       | Blade templates dan UI components          |
| `public/assets/images/`  | Gambar logo dan aset publik lainnya        |
| `.env`                   | File konfigurasi environment               |

---

## 📞 Kontak

**Email:** faidfadjri@gmail.com
---

Made with ❤️ by Faid Fadjri
