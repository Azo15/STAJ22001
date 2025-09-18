@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/books/show.css">

@php
    $user = auth()->user();
    $isAdmin = $user && ($user->role === 'admin');
    $isLibrarian = $user && ($user->role === 'librarian');
    $isReader = $user && ($user->role === 'reader');
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- Resim URL’si tam URL olduğu için doğrudan kullanıyoruz -->
                <img src="{{ $book->cover }}" class="card-img-top book-cover" alt="Kitap Kapak Görseli">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><span class="detail-label">Yazar:</span> {{ $book->author }} </p>
                    <p class="card-text"><span class="detail-label">Tür:</span> 
                        @foreach($book->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                        @endforeach
                    </p>
                    <p class="card-text"><span class="detail-label">Yayın Tarihi:</span> {{ $book->release_date }} </p>
                    <p class="card-text"><span class="detail-label">Sayfa Sayısı:</span>  {{ $book->pages }}</p>
                    <p class="card-text"><span class="detail-label">Dil:</span> {{ $book->language }} </p>
                    <p class="card-text"><span class="detail-label">ISBN:</span> {{ $book->isbn }}</p>
                    <p class="card-text"><span class="detail-label">Toplam Kopya:</span> {{$book->in_stock }}</p>
                    <p class="card-text"><span class="detail-label">Mevcut Kopya:</span> 0 </p>
                    <p class="card-text"><span class="detail-label">Açıklama:</span> {{ $book->description }}</p>
                    @auth
                    @if($isAdmin || $isLibrarian)
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-custom-size btn-primary">Düzenle</a>
                    @endif
                    @endauth
                    @if($isReader)
                    <form action="{{ route('books.rentals.store', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-custom-size btn-primary">Ödünç Al</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
