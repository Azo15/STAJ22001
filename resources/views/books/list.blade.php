@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<link rel="stylesheet" href="/css/books/list.css">
<link rel="stylesheet" href="/css/tables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@php
    $user = auth()->user();
    $isAdmin = $user && ($user->role === 'admin');
    $isLibrarian = $user && ($user->role === 'librarian');
    $isReader = $user && ($user->role === 'reader');
@endphp

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header ">
                    <h4 class="mb-0">Kitap Listesi</h4>
                </div>
                <div class="card-body p-0">
                    <table id="table1" class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr style="text-align:center">
                                <th>Kapak</th>
                                <th>Başlık</th>
                                <th>Yazar</th>
                                <th>Dil</th>
                                <th>Tür</th>
                                <th>Sayfa</th>
                                <th>Yayın Tarihi</th>
                                <th>Stok</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr style="text-align:center">
                                <td><img src="{{ $book->cover }}" alt="Kapak" class="book-cover"></td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->language }}</td>
                                <td>
                                    @foreach($book->genres as $genre)
                                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $book->pages }}</td>
                                <td>{{ $book->release_date }}</td>
                                <td>{{ $book->in_stock }}</td>
                                <td>
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-custom-size btn-primary">Görüntüle</a>
                                    @auth
                                    @if($isReader)
                                        <form action="{{ route('books.rentals.store', ['book' => $book->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-custom-size btn-primary">Ödünç Al</button>
                                        </form>
                                    @endif

                                    @if($isAdmin || $isLibrarian)
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-custom-size btn-primary">Düzenle</a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-custom-size btn-danger delete-btn">Sil</button>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#table1').DataTable({
            "paging": false,
            "searching": true,
            "info": false
        });

        $('#table_search').keyup(function(){
            table.search($(this).val()).draw();
        });
    });
</script>

@endsection
