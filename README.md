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

### 3. Install Composer Package

```bash
composer install
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Jalankan migrasi database

Pastikan koneksi database sudah disesuaikan di file `.env`, lalu jalankan:

```bash
php artisan migrate
```

### 6. Jalankan server Laravel

```bash
php artisan serve
```

### 7. Jalankan Vite (untuk assets frontend)

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

**Nama:** Faid Fadjri  
**Email:** [faidfadjri@gmail.com](mailto:faidfadjri@gmail.com)

### 🌐 Sosial & Portofolio

- 🔗 [Medium](https://medium.com/@faidfadjri) – `@faidfadjri`  
- 💼 [LinkedIn](https://linkedin.com/in/faidfadjri) – `@faidfadjri`  
- 🧰 [Portofolio](https://faidfadjri.github.io) – `faidfadjri.github.io`

Made with ❤️ by Faid Fadjri
