@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/genres/show.css">

@php
    $user = auth()->user();
    $isAdmin = $user && ($user->role === 'admin');
    $isLibrarian = $user && ($user->role === 'librarian');
    $isReader = $user && ($user->role === 'reader');
@endphp

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5>Türdeki Kitaplar: {{ $genre->name }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Başlık</th>
                                <th>Yazar</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($genre->books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Kitabı Görüntüle</a>

                                    @auth
                                    @if($isAdmin || $isLibrarian)
                                    <form action="{{ route('genres.detachBook', ['genre' => $genre->id, 'book' => $book->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger btn-sm">Bağlantıyı Sil</button>
                                    </form>
                                    @endif
                                    @endauth
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
