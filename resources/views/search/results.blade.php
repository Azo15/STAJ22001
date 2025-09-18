@extends('layouts.main')

@section('content')

<div class="container mt-4">
    <h2>Arama Sonuçları</h2>
    @if($books->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Yazar</th>
                    <th>Türler</th>
                    <th>Yayın Tarihi</th>
                    <th>Açıklama</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @foreach($book->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $book->release_date }}</td>
                        <td>{{ $book->description }}</td>
                        <td><a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Kitabı Görüntüle</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>'{{ request('query') }}' için sonuç bulunamadı.</p>
    @endif
</div>

@endsection
