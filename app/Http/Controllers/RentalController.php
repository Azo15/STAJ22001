<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;
use App\Notifications\RentalStatusUpdated;

class RentalController extends Controller
{
    /**
     * Kaynak listesini görüntüle.
     */
    public function index()
    {
        //
    }

    /**
     * Yeni bir kaynak oluşturma formunu göster.
     */
    public function create()
    {
        //
    }

    /**
     * Yeni oluşturulan kaynağı veritabanına kaydet.
     */
    public function store(StoreRentalRequest $request, Books $book)
    {
        $this->authorize('create', Rental::class);
        
        if ($book->in_stock <= 0) {
            return back()->with('error', 'Bu kitap şu anda Ödünç Alınabilir durumda değil.');
        }
    
        if ($book->rentals()->where('user_id', Auth::id())->whereNull('returned_at')->exists()) {

            if ($book->rentals()->where('user_id', Auth::id())->where('status', 'Pending Review')->exists()) {
                return back()->with('error', 'Bu kitabı zaten talep ettiniz.');
            }
            else if ($book->rentals()->where('user_id', Auth::id())->where('status', 'Approved')->exists()) {
                return back()->with('error', 'Bu kitabı zaten Ödünç Aldınız.');
            }
            else if ($book->rentals()->where('user_id', Auth::id())->where('status', 'Overdue')->exists()) {
                return back()->with('error', 'Bu kitap için gecikmiş bir Ödünç Almanız var.');
            }
        }
        
        Rental::create($request->validated());

        return back()->with('success', 'Ödünç Alma talebi başarıyla gönderildi. Onay bekleniyor.');
    }

    /**
     * Belirtilen kaynağı görüntüle.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Belirtilen kaynağı düzenleme formunu göster.
     */
    public function edit(Books $book, Rental $rental)
    {
        $this->authorize('update', $rental);

        $rental = Rental::findOrFail($rental->id);
        $books = Books::all();
        $users = User::all();

        return view('rentals.edit', compact('rental', 'books', 'users'));
    }

    /**
     * Belirtilen kaynağı güncelle.
     */
    public function update(UpdateRentalRequest $request, Books $book, Rental $rental, User $user)
    {
        $this->authorize('update', $rental);

        $rental->update($request->validated());

        return back()->with('success', 'Ödünç Alma başarıyla güncellendi.');
    }

    /**
     * Belirtilen kaynağı sil.
     */
    public function destroy(Rental $rental)
    {
        //
    }

    public function approve($id)
    {
        // $this->authorize('manage');
        $rental = Rental::findOrFail($id);

        try {
            $rental->approve();
            
            $book = Books::findOrFail($rental->books_id);
            $book->decrement('in_stock');
            
            // Notification
            $rental->user->notify(new RentalStatusUpdated($rental, 'approved'));
            
            return redirect()->route('rentals.pendinglist')->with('success', 'Ödünç Alma başarıyla onaylandı.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject($id)
    {
        // $this->authorize('manage');
        $rental = Rental::findOrFail($id);
        
        try {
            $rental->reject();
            
            // Notification
            $rental->user->notify(new RentalStatusUpdated($rental, 'rejected'));

            return redirect()->route('rentals.pendinglist')->with('success', 'Ödünç Alma reddedildi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function returnBook(Request $request, $id)
    {
        $this->authorize('create', Rental::class);
        
        $rental = Rental::findOrFail($id);

        try {
            $rental->returnBook();
            
            $book = Books::findOrFail($rental->books_id);
            $book->increment('in_stock');

            return back()->with('success', 'Kitap başarıyla iade edildi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancelRentalRequest(Request $request, $id)
    {
        $this->authorize('create', Rental::class);
        
        $rental = Rental::findOrFail($id);

        try {
            $rental->cancel();
            return back()->with('success', 'Ödünç Alma talebi iptal edildi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function markOverdue(Request $request)
    {
        // $this->authorize('manage');
        
        // Sadece 'Approved' durumundaki ve süresi geçmiş kayıtları alıyoruz.
        // Logic zaten ApprovedState içinde kontrol edilecek ama veritabanı sorgusuyla filtrelemek performans için iyi.
        $rentals = Rental::where('status', 'Approved')->where('rental_due_at', '<', now())->whereNull('returned_at')->get();

        $updatedCount = 0;
        foreach ($rentals as $rental) {
            try {
                $rental->markOverdue();
                $rental->user->notify(new RentalStatusUpdated($rental, 'overdue'));
                $updatedCount++;
            } catch (\Exception $e) {
                // Toplu işlemde tekil hataları yoksay veya logla
                continue; 
            }
        }

        if ($updatedCount > 0) {
            return back()->with('success', $updatedCount . ' adet gecikmiş Ödünç Alma güncellendi.');
        }
        
        return back()->with('info', 'Gecikmiş Ödünç Alma bulunamadı.');
    }

    public function showRejected()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Cancelled')->get();
        return view('rentals.rejected', compact('rentals'));
    }

    public function showPending()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Pending Review')->get();
        return view('rentals.pending', compact('rentals'));
    }

    public function showApproved()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Approved')->get();
        return view('rentals.approved', compact('rentals'));
    }

    public function showReturned()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Returned')->get();
        return view('rentals.returned', compact('rentals'));
    }

    public function showOverdue()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')->where('status', 'Overdue')->get();
        return view('rentals.overdue', compact('rentals'));
    }

    public function showOngoing()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')
            ->where('status', 'Approved')
            ->whereNull('returned_at')
            ->where('rental_due_at', '>', now())
            ->get();

        return view('rentals.ongoing', compact('rentals'));
    }

    public function showAll()
    {
        // $this->authorize('manage');
        $rentals = Rental::with('book', 'user')
            ->whereNotNull('rental_start_at')
            ->get();

        return view('rentals.all', compact('rentals'));
    }

    public function myRentals()
    {
        $user = Auth::user();
        $rentals = $user->rentals()->with('book')->get();

        return view('rentals.myrentals', compact('rentals'));
    }

    public function showReaderRentals(User $user)
    {
        $rentals = $user->rentals()->with('book')->get();

        return view('profile.reader', compact('rentals', 'user'));
    }
}
