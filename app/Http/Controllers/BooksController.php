<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Kaynak listesini görüntüle.
     */
    public function index()
    {
        $books = Books::all();
        $genres = Genre::all();  // Veritabanından tüm türleri al

        return view('books.list', [
            "books" => $books ,
        ]);
    }

    /**
     * Yeni bir kaynak oluşturma formunu göster.
     */
    public function create()
    {
        $this->authorize('create', Books::class);

        $genres = Genre::all();

        return view('books.create', compact('genres'));
    }

    /**
     * Yeni oluşturulan kaynağı veritabanına kaydet.
     */
    public function store(StoreBooksRequest $request)
    {
        $book = Books::create($request->validated());
        $book->genres()->sync($request->genres);  // Türleri kitaba iliştir

        return redirect()->route('books.index');
    }

    /**
     * Belirtilen kaynağı görüntüle.
     */
    public function show(Books $book)
    {
        $genres = Genre::all();

        return view('books.show', [
            "book" => $book,
        ]);
    }

    /**
     * Belirtilen kaynağı düzenleme formunu göster.
     */
    public function edit(Books $book)
    {
        $this->authorize('update', $book);

        $book = Books::findOrFail($book->id);
        $genres = Genre::all();
        
        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Belirtilen kaynağı güncelle.
     */
    public function update(UpdateBooksRequest $request, Books $book)
    {
        // $book->update($request->validated());
        $this->authorize('update', $book);

        $validatedData = $request->validated();
    
        // Kitabın temel bilgilerini güncelle.
        $book->update($validatedData);

        // Kitabın türlerini güncelle. 'genres' alanı tür ID'lerinden oluşan bir dizi olmalı.
        // Türler için input alanının adı 'genres' ve bu bir dizi.
        // `sync` metodu ilişkilendirme, ilişkiyi kaldırma ve güncelleme işlemlerini yapar.
        if (isset($validatedData['genres'])) {
            $book->genres()->sync($validatedData['genres']);
        }

        return redirect()->route('books.show', $book->id);
    }

    /**
     * Belirtilen kaynağı sil.
     */
    public function destroy(Books $book)
    {
        $this->authorize('delete', $book);

        $book = Books::find($book->id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
