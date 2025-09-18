@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/books/create.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Yeni Kitap Ekle</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Sol Sütun -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Başlık</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="author" class="form-label">Yazar</label>
                                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author') }}" required>
                                    @error('author')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Açıklama</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cover" class="form-label">Kapak Görseli URL</label>
                                    <input type="text" name="cover" id="cover" class="form-control" value="{{ old('cover') }}" placeholder="http://example.com/image.jpg" required>
                                    @error('cover')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Sağ Sütun -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="release_date" class="form-label">Yayın Tarihi</label>
                                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date') }}" required>
                                    @error('release_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="genre" class="form-label">Tür</label>
                                    <select name="genres[]" id="genres" class="form-control" multiple>
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}"
                                                {{ in_array($genre->id, old('genres', [])) ? 'selected' : '' }}>
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
                                    <input type="text" name="language" id="language" class="form-control" value="{{ old('language') }}" placeholder="Eng" required>
                                    @error('language')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pages" class="form-label">Sayfa Sayısı</label>
                                    <input type="number" name="pages" id="pages" class="form-control" value="{{ old('pages') }}" required>
                                    @error('pages')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}" required>
                                    @error('isbn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="in_stock" class="form-label">Stok Adedi</label>
                                    <input type="number" name="in_stock" id="in_stock" class="form-control" value="{{ old('in_stock') }}" required>
                                    @error('in_stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Oluştur</button>
                        <a href="{{ route('books.create') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#genres').select2({
        placeholder: "Türleri seçin",
        allowClear: true
    });
});
</script>

@endsection
