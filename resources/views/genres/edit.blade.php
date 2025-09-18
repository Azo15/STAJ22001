@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/genres/create.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Türü Düzenle - {{ $genre->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Tür Adı</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $genre->name }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="style" class="form-label">Stil</label>
                            <select class="form-select" id="style" name="style">
                                <option value="primary" {{ $genre->style == 'primary' ? 'selected' : '' }}>Birincil</option>
                                <option value="secondary" {{ $genre->style == 'secondary' ? 'selected' : '' }}>İkincil</option>
                                <option value="success" {{ $genre->style == 'success' ? 'selected' : '' }}>Başarılı</option>
                                <option value="danger" {{ $genre->style == 'danger' ? 'selected' : '' }}>Tehlikeli</option>
                                <option value="warning" {{ $genre->style == 'warning' ? 'selected' : '' }}>Uyarı</option>
                                <option value="info" {{ $genre->style == 'info' ? 'selected' : '' }}>Bilgi</option>
                                <option value="light" {{ $genre->style == 'light' ? 'selected' : '' }}>Açık</option>
                                <option value="dark" {{ $genre->style == 'dark' ? 'selected' : '' }}>Koyu</option>
                            </select>
                            @error('style')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Türü Güncelle</button>
                        <a href="{{ route('genres.index') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
