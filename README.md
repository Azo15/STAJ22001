# 📚 Kütüphane Yönetim Sistemi (Neon Horizon Theme)

> **STAJ22001** - Laravel 11, Tailwind CSS ve Alpine.js ile geliştirilmiş modern, kullanıcı dostu ve estetik bir kütüphane yönetim sistemi.

## 🌟 Proje Hakkında

Bu proje, geleneksel kütüphane yönetim sistemlerini modern web teknolojileri ve "Neon Horizon" tasarım dili ile yeniden yorumlamaktadır. Glassmorphism (buzlu cam) efektleri, canlı gradientler ve akıcı animasyonlar ile kullanıcı deneyimini en üst düzeye çıkarmayı hedefler.

Kullanıcılar kitapları keşfedebilir, ödünç alma talebinde bulunabilir ve geçmiş işlemlerini takip edebilir. Yöneticiler ve kütüphaneciler ise detaylı yönetim paneli üzerinden tüm süreci kontrol edebilir.

## 🚀 Özellikler

### 🎨 Arayüz ve Tasarım
- **Neon Horizon Teması:** Canlı renkler, gradient detaylar ve modern tipografi (Outfit font ailesi).
- **Glassmorphism UI:** Kartlar, tablolar ve modallar için buzlu cam efekti.
- **Responsive Tasarım:** Mobil, tablet ve masaüstü uyumlu akıcı arayüz.
- **İnteraktif Elementler:** Alpine.js ile güçlendirilmiş dinamik dropdownlar, arama önerileri ve bildirimler.

### 📚 Kitap ve Tür Yönetimi
- **Kitap İşlemleri:** Ekleme, düzenleme, silme, kapak resmi yükleme ve detaylı görüntüleme.
- **Kategorizasyon:** Tür (Genre) bazlı filtreleme ve yönetim.
- **Stok Takibi:** Kitapların stok durumunun (Mevcut/Tükendi) otomatik kontrolü.

### 🔄 Ödünç Alma ve İade Sistemi
- **Talep Süreci:** Okuyucular için kolay ödünç alma isteği oluşturma.
- **Onay Mekanizması:** Kütüphaneciler için bekleyen talepleri onaylama veya reddetme.
- **Takip:** Devam eden, geciken ve tamamlanan kiralamaların detaylı takibi.
- **Süre Yönetimi:** İade tarihi belirleme ve gecikme kontrolü.

### 👥 Kullanıcı ve Rol Yönetimi
- **Çoklu Rol Yapısı:** Admin, Kütüphaneci ve Okuyucu rolleri.
- **Profil Yönetimi:** Kullanıcı profili düzenleme ve şifre işlemleri.
- **Yönetim Paneli:** Kullanıcıları listeleme, rol atama (Terfi/Düşürme) ve yetkilendirme.

### 🔍 Arama ve Keşfetme
- **Gelişmiş Arama:** Kitap başlığı, yazar veya türe göre anlık arama önerileri (Live Search).
- **Detaylı Filtreleme:** Kütüphane kataloğunda hızlı gezinme.

## 🛠 Kullanılan Teknolojiler

- **Backend:** Laravel 11
- **Frontend:** Tailwind CSS, Alpine.js, Blade Şablon Motoru
- **Veritabanı:** MySQL / SQLite
- **Grafik ve İstatistik:** Chart.js

## ⚙️ Kurulum Talimatları

Projeyi yerel ortamınızda çalıştırmak için aşağıdaki adımları izleyin:

1.  **Projeyi Klonlayın:**
    ```bash
    git clone https://github.com/Azo15/STAJ22001.git
    cd STAJ22001
    ```

2.  **Bağımlılıkları Yükleyin:**
    ```bash
    composer install
    npm install
    ```

3.  **Çevresel Değişkenleri Ayarlayın:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *.env dosyasını açarak veritabanı ayarlarınızı (DB_DATABASE, vb.) yapılandırın.*

4.  **Veritabanını Hazırlayın:**
    ```bash
    php artisan migrate --seed
    ```
    *(Bu komut veritabanı tablolarını oluşturacak ve örnek verileri (Admin kullanıcısı, kitaplar vb.) yükleyecektir.)*

5.  **Uygulamayı Derleyin ve Çalıştırın:**
    ```bash
    npm run dev
    # Yeni bir terminalde:
    php artisan serve
    ```

6.  **Tarayıcıda Görüntüleyin:**
    `http://127.0.0.1:8000` adresine gidin.

## 🔑 Varsayılan Kullanıcılar (Seeder Kullanıldıysa)

*   **Admin:** `admin@kutuphane.com` / `password` (Varsayılan şifre genellikle 'password' veya kodu kontrol ediniz)

---
*Geliştirici:Azo İsmail (Azo15) - Staj Projesi 2024*
