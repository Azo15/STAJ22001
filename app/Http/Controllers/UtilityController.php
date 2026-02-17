<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Genre;
use App\Models\Books;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactMessage;
use App\Notifications\NewContactMessage;
use Illuminate\Support\Facades\Notification;

class UtilityController extends Controller
{
    public function dashboard()
    {
        $numberOfReaders = User::where('role', 'reader')->count();
        $numberOfGenres = Genre::count();
        $numberOfBooks = Books::count();
        $numberOfActiveRentals = Rental::where('status', 'Approved')->count();

        // Ödünç Alma sayısına göre en popüler kitabı al
        $popularBook = Rental::select('books_id')
            ->groupBy('books_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        $bookDetails = null;
        if ($popularBook) {
            $bookDetails = Books::find($popularBook->books_id);
        }

        // Grafik Verileri: Türlere göre kitap sayıları
        $genreData = Genre::withCount('books')->get();
        $genreLabels = $genreData->pluck('name');
        $genreCounts = $genreData->pluck('books_count');

        // Grafik Verileri: Son 6 ayın kiralama istatistikleri
        $rentalData = Rental::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get()
            ->reverse();
        
        $rentalLabels = $rentalData->pluck('month');
        $rentalCounts = $rentalData->pluck('count');

        return view('home', [
            'numberOfReaders' => $numberOfReaders,
            'numberOfGenres' => $numberOfGenres,
            'numberOfBooks' => $numberOfBooks,
            'numberOfActiveRentals' => $numberOfActiveRentals,
            'popularBookTitle' => $bookDetails?->title ?? 'N/A',
            'popularBookAuthor' => $bookDetails?->author ?? 'N/A',
            'popularBookCover' => $bookDetails?->cover ?? 'https://easydrawingguides.com/wp-content/uploads/2020/10/how-to-draw-an-open-book-featured-image-1200.png',
            'popularBookId' => $bookDetails?->id,
            'chartGenreLabels' => $genreLabels,
            'chartGenreCounts' => $genreCounts,
            'chartRentalLabels' => $rentalLabels,
            'chartRentalCounts' => $rentalCounts,
        ]);
    }

    public function searchSuggestions(Request $request)
    {
        $term = $request->get('term');
        $suggestions = [];

        // Kitapları başlığa göre sorgula
        $books = Books::where('title', 'like', "%{$term}%")
                    ->take(5)
                    ->get(['id', 'title']);

        // Kitap önerilerini ekle
        foreach ($books as $book) {
            $suggestions[] = [
                'label' => 'Book: ' . $book->title,
                'value' => $book->title,
                'url' => route('books.show', $book->id)
            ];
        }

        // Türleri sorgula
        $genres = Genre::where('name', 'like', "%{$term}%")
                    ->take(5)
                    ->get(['id', 'name']);

        // Tür önerilerini ekle
        foreach ($genres as $genre) {
            $suggestions[] = [
                'label' => 'Genre: ' . $genre->name,
                'value' => $genre->name,
                'url' => route('genres.show', $genre->id)
            ];
        }

        // Yazarları sorgula ve ilişkili kitapları dahil et
        $authorSuggestions = Books::select('author')
                              ->distinct()
                              ->where('author', 'like', "%{$term}%")
                              ->take(5)
                              ->with('genres')
                              ->get();

        foreach ($authorSuggestions as $author) {
            $suggestions[] = [
                'label' => 'Author: ' . $author->author,
                'value' => $author->author,
                'url'   => route('books.index', ['author' => $author->author]) // Yazar filtreleme rotası oluşturulabilir
            ];
        }

        return response()->json($suggestions);
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('query');

        // Kitaplar tablosunda başlığa göre arama yapan sorguyla başla
        $bookQuery = Books::query();

        // Arama sorgusu boş değilse
        if (!empty($query)) {
            // Kitap başlığı veya yazar adına göre eşleşme ara
            $bookQuery->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%");
            });

            // Türlerle ilişki varsa sorguyu genişlet
            $bookQuery->orWhereHas('genres', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            });
        }

        // Sorguyu çalıştır ve sonuçları al
        $books = $bookQuery->get();

        // Kitap koleksiyonuyla birlikte görünümü döndür
        // Kitap koleksiyonuyla birlikte görünümü döndür
        return view('search.results', compact('books'));
    }

    public function markNotificationsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create($validated);

        // Notify Admins and Librarians
        $adminsAndLibrarians = User::whereIn('role', ['admin', 'librarian'])->get();
        if ($adminsAndLibrarians->count() > 0) {
            Notification::send($adminsAndLibrarians, new NewContactMessage($contactMessage));
        }

        return back()->with('success', 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
    }

    public function showContactMessage($id)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'librarian') {
            abort(403);
        }

        $message = ContactMessage::findOrFail($id);

        // Mark as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.contact_message', compact('message'));
    }
}
