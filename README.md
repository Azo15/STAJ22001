# STAJ22001

**STAJ22001**, Laravel ile geliştirilmiş bir kütüphane yönetim sistemi uygulamasıdır. Uygulama, kitapları, türleri ve Kitap Ödünç almalarını yönetmek için kullanıcı dostu bir arayüz sunar.

## Özellikler

* **Kitap Yönetimi:** Kitap ekleme, listeleme, düzenleme ve silme.
* **Tür Yönetimi:** Kitap türlerini ekleme, listeleme, düzenleme ve silme.
* **Kitap Ödünç alma Yönetimi:** Ödünç alma isteklerini görüntüleme, onaylama, reddetme; devam eden ve tamamlanan Ödünç almaları takip etme.
* **Kullanıcı Yönetimi:** Admin, kütüphaneci ve okuyucu rolleri ile kullanıcı işlemleri.
* **Yetkilendirme:** Kullanıcı rolleri ile belirli işlemleri sınırlama.
* **Frontend:** CSS , Bootstrap ve JS  ile modern ve kullanıcı dostu tasarım.
* **Authentication:** Login, register, şifre sıfırlama ve e-posta doğrulama işlemleri.

## Kurulum

1. Projeyi klonlayın:

```bash
git clone https://github.com/Azo15/STAJ22001.git
```

2. Proje dizinine girin:

```bash
cd STAJ22001
```

3. Gerekli paketleri yükleyin:

```bash
composer install
npm install
npm run dev
```

4. Ortam dosyasını oluşturun:

```bash
cp .env.example .env
php artisan key:generate
```

5. Veritabanını ayarlayın ve migrationları çalıştırın:

```bash
php artisan migrate --seed
```

6. Uygulamayı çalıştırın:

```bash
php artisan serve
```

## Kullanım

* Tarayıcıdan `http://127.0.0.1:8000` adresine gidin.
* Admin veya kütüphaneci rolleri ile giriş yaparak kitap ve Ödünç alma işlemlerini yönetin.
* Okuyucu rolü ile kitapları görüntüleyin ve Kitap Ödünç alma istekleri oluşturun.

# Book-Rental-System (BRS)
Made with Laravel v11

# Clone the Repo and Run the Following Commands
composer install
npm install
npm run prod
php artisan migrate:fresh
php artisan db:seed
php artisan serve

# Use the Rentals-Optimized-Samples.csv under database\Rentals-Optimized-Samples.csv folder to perform proper testing

In this system, there are functions accessible to anonymous users. They can search for books by author or title, list books by genre, and view the datasheet of a selected book.

There are two types of users in this BRS: readers and librarians. As a registered and authenticated (logged in) reader, I can borrow a book, view my active book rentals, and view the details of a selected book rental. As a librarian, I have the ability to add, edit, or delete a book, add, edit, or delete a genre, list book rentals, view the details of a book rental, and change some status on a book rental, like status, deadline, note.

The home project is implemented as a Laravel application using a local SQLite database.

For models, the User table is already created. Extended ones include fields for id, name, email (unique), email_verified_at (timestamp, nullable), password, is_librarian (boolean, default: false), remember_token, and timestamps (created_at, updated_at).

The Book model includes fields for id, title, authors, description (text, nullable), released_at (date), cover image (nullable), pages, language_code (default: hu), isbn (unique), in_stock, and timestamps.

The Genre model has fields for id, name, and style (an enum of various UI colors), along with timestamps.

The Borrow model includes fields for id, reader_id (with foreign key constraints), book_id (with foreign key constraints), status (an enum of PENDING, ACCEPTED, REJECTED, RETURNED), request_processed_at (datetime, nullable), request_managed_by (with foreign key constraints), deadline (datetime, nullable), returned_at (datetime, nullable), return_managed_by (with foreign key constraints), and timestamps.

A book may have many genres, and a genre may belong to many books. A book may have many rentals, but a rental belongs to only one book. A reader may have many book rentals, but a rental belongs to only one user. A librarian may manage many rental requests and returns, but each request or return can only be managed by one librarian.

Public functions include a navigation bar common layout, a main page displaying counts of users, genres, books, and active rentals, a list of genres each linking to a genre-specific page, and a book search function. The book detail page shows comprehensive information about the book, and registration and login functions are available for users.

Reader-specific functions are accessible only after logging in, including borrowing a book, viewing ongoing and past rentals, and specific rental details.

Librarian-specific functions, also requiring login, include managing books and genres, handling rental requests and returns, and editing details on the rental status and deadlines.

Finally, there's a common profile page accessible from the navigation bar showing user details such as name, email, and role.

--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
