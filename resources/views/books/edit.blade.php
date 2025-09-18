@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/books/create.css">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Kitabı Düzenle - {{ $book->title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Sol Sütun -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Başlık</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="author" class="form-label">Yazar</label>
                                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                                    @error('author')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Açıklama</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $book->description) }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cover" class="form-label">Kapak Görseli URL</label>
                                    <input type="text" name="cover" id="cover" class="form-control" value="{{ old('cover', $book->cover) }}" required>
                                    @error('cover')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Sağ Sütun -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="release_date" class="form-label">Yayın Tarihi</label>
                                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $book->release_date) }}" required>
                                    @error('release_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="genre" class="form-label">Tür</label>
                                    <select name="genres[]" id="genres" class="form-control" multiple>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}"
                                                {{ in_array($genre->id, old('genres', $book->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $genre->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('genres')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="language" class="form-label">Dil</label>
                                    <input type="text" name="language" id="language" class="form-control" value="{{ old('language', $book->language) }}" placeholder="Eng" required>
                                    @error('language')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pages" class="form-label">Sayfa Sayısı</label>
                                    <input type="number" name="pages" id="pages" class="form-control" value="{{ old('pages', $book->pages) }}" required>
                                    @error('pages')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}" required>
                                    @error('isbn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="in_stock" class="form-label">Stok Adedi</label>
                                    <input type="number" name="in_stock" id="in_stock" class="form-control" value="{{ old('in_stock', $book->in_stock) }}" required>
                                    @error('in_stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
