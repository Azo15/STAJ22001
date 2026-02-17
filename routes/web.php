<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RentalController;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\UtilityController;



Route::get('/', [UtilityController::class, 'dashboard'])->name('dashboard');

Route::get('/forbidden', function () {
    return view('forbidden');
}); // Yetkisiz erişim sayfası

// Profil işlemleri (giriş yapmış kullanıcılar)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Kitap ve tür kaynakları
Route::resource("books", BooksController::class);
Route::resource("genres", GenreController::class);

// Arama işlemleri
Route::get('/search/suggestions', [UtilityController::class, 'searchSuggetions'])->name('search.suggestions');
Route::get('/search/results', [UtilityController::class, 'searchResults'])->name('search.results');

// Footer Pages
Route::get('/privacy', [UtilityController::class, 'privacy'])->name('privacy');
Route::get('/terms', [UtilityController::class, 'terms'])->name('terms');
Route::get('/contact', [UtilityController::class, 'contact'])->name('contact');
Route::post('/contact', [UtilityController::class, 'sendContactMessage'])->name('contact.send');
Route::post('/notifications/read', [UtilityController::class, 'markNotificationsRead'])->name('notifications.read')->middleware('auth');

// Ödünç Alma işlemleri (giriş ve doğrulama gerekli)
Route::middleware(['auth','verified'])->group(function () {
    Route::resource("books.rentals", RentalController::class);
    Route::post('/books/{book}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});

// Okuyucu rolleri için Ödünç Alma işlemleri
Route::middleware(['auth','verified', 'role:reader'])->group(function () {
    Route::get('/myrentals', [RentalController::class, 'myRentals'])->name('myrentals');
    Route::patch('/rentals/{rental}/return', [RentalController::class, 'returnBook'])->name('rentals.return');
    Route::patch('/rentals/{rental}/cancel', [RentalController::class, 'cancelRentalRequest'])->name('rentals.cancelrequest');
});

require __DIR__.'/auth.php'; // Kimlik doğrulama rotaları

// Admin ve kütüphaneci rolleri için yönetim rotaları
Route::middleware(['auth','verified', 'role:admin,librarian'])->group(function () {
    // Kitap-tür bağlantısını silme
    Route::delete('/genres/{genre}/books/{book}', [GenreController::class, 'detachBook'])->name('genres.detachBook');

    // Ödünç Alma yönetimi
    Route::get('/rentals/rejectedlist', [RentalController::class, 'showRejected'])->name('rentals.rejectedlist');
    Route::get('/rentals/approvedlist', [RentalController::class, 'showApproved'])->name('rentals.approvedlist');
    Route::get('/rentals/pendinglist', [RentalController::class, 'showPending'])->name('rentals.pendinglist');
    Route::post('/rentals/{rental}/approve', [RentalController::class, 'approve'])->name('rentals.approve');
    Route::post('/rentals/{rental}/reject', [RentalController::class, 'reject'])->name('rentals.reject');
    Route::get('/rentals/returnedlist', [RentalController::class, 'showReturned'])->name('rentals.returnedlist');
    Route::get('/rentals/overduelist', [RentalController::class, 'showOverdue'])->name('rentals.overduelist');
    Route::post('/rentals/markoverdue', [RentalController::class, 'markOverdue'])->name('rentals.markoverdue');
    Route::get('/rentals/ongoinglist', [RentalController::class, 'showOngoing'])->name('rentals.ongoinglist');
    Route::get('/rentals/all', [RentalController::class, 'showAll'])->name('rentals.all');

    // Okuyucu yönetimi
    Route::get('/readers', [ProfileController::class, 'showReaders'])->name('readers.showreaders');
    Route::get('/readers/{user}/rentals', [RentalController::class, 'showReaderRentals'])->name('readers.rentals');

    // İletişim Mesajları
    Route::get('/admin/contact-message/{id}', [UtilityController::class, 'showContactMessage'])->name('admin.contact.show');
});

// Sadece admin için kütüphaneci yönetimi
Route::middleware(['auth','verified', 'role:admin'])->group(function () {
    Route::get('/librarians', [ProfileController::class, 'showLibrarians'])->name('librarians.showlibrarians');
    Route::patch('/librarians/{user}/delete', [ProfileController::class, 'changeLibrarianToReader'])->name('librarians.deletelibrarian');
    Route::patch('/readers/{user}/promote', [ProfileController::class, 'changeReaderToLibrarian'])->name('readers.promotelibrarian');
});
