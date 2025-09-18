@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/genres/create.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Yeni Tür Oluştur</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('genres.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tür Adı</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="style" class="form-label">Stil</label>
                            <select class="form-select" id="style" name="style">
                                <option value="primary">Birincil</option>
                                <option value="secondary">İkincil</option>
                                <option value="success">Başarılı</option>
                                <option value="danger">Tehlikeli</option>
                                <option value="warning">Uyarı</option>
                                <option value="info">Bilgi</option>
                                <option value="light">Açık</option>
                                <option value="dark">Koyu</option>
                            </select>
                            @error('style')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Türü Oluştur</button>
                        <a href="{{ route('genres.create') }}" class="btn btn-secondary">İptal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
