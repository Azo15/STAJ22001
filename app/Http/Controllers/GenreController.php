<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Books;

class GenreController extends Controller
{
    /**
     * Kaynak listesini görüntüle.
     */
    public function index()
    {
        $genres = Genre::all();

        return view('genres.list', [
            "genres" => $genres,
        ]);
    }

    /**
     * Yeni bir kaynak oluşturma formunu göster.
     */
    public function create()
    {
        $this->authorize('create', Genre::class);

        return view('genres.create');
    }

    /**
     * Yeni oluşturulan kaynağı veritabanına kaydet.
     */
    public function store(StoreGenreRequest $request)
    {
        $this->authorize('create', Genre::class);
        
        Genre::create($request->validated());

        return redirect()->route('genres.index');
    }

    /**
     * Belirtilen kaynağı görüntüle.
     */
    public function show(Genre $genre)
    {
        $books = $genre->books;

        return view('genres.show', [
            "genre" => $genre,
        ]);
    }

    /**
     * Belirtilen kaynağı düzenleme formunu göster.
     */
    public function edit(Genre $genre)
    {
        $this->authorize('update', $genre);
        
        return view('genres.edit', [
            "genre" => $genre,
        ]);
    }

    /**
     * Belirtilen kaynağı güncelle.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $this->authorize('update', $genre);
        
        $genre->update($request->validated());

        return redirect()->route('genres.index');
    }

    /**
     * Belirtilen kaynağı sil.
     */
    public function destroy(Genre $genre)
    {
        $this->authorize('delete', $genre);
        
        $genre->delete();

        return redirect()->route('genres.index');
    }

    /**
     * Bir kitabı türden ayır.
     */
    public function detachBook(Genre $genre, Books $book)
    {
        $this->authorize('delete', $genre);
        
        $books = $genre->books;
        $genre->books()->detach($book->id);

        return redirect()->route('genres.show', $genre->id);
    }
}
