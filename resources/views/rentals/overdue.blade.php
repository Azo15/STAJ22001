@extends('layouts.main')

@section('content')

@include('flashmsg')

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="/css/rentals/custom.css">
<link rel="stylesheet" href="/css/tables.css">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<div class="container">
    <h2>Geciken Ödünç Almalar</h2>
    <form action="{{ route('rentals.markoverdue') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">Geciken Ödünç Almaları İşaretle</button>
    </form>

    <table id="table1" class="table">
        <thead>
            <tr>
                <th>Ödünç Alma ID</th>
                <th>Kitap Başlığı</th>
                <th>Kullanıcı</th>
                <th>Başlangıç Tarihi</th>
                <th>Teslim Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @if($rentals->isEmpty())
            <tr>
                <td colspan="5">Geciken Ödünç Alma bulunamadı.</td>
            </tr>
            @endif

            @foreach($rentals as $rental)
            <tr>
                <td>{{ $rental->id }}</td>
                <td>{{ $rental->book->title }}</td>
                <td>{{ $rental->user->name }}</td>
                <td>{{ $rental->rental_start_at }}</td>
                <td>{{ $rental->rental_due_at }}</td>
                <td>
                    <form action="{{ route('books.rentals.edit', ['book' => $rental->book->id, 'rental' => $rental->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn-warning btn-sm">Ödünç Almayı Düzenle</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#table1').DataTable({
            "paging": false,   // Sayfalama devre dışı
            "searching": true, // Arama kutusu aktif
            "info": false      // Bilgi metni devre dışı
        });

        // Arama kutusuna yazıldığında tabloyu filtrele
        $('#table_search').keyup(function(){
            table.search($(this).val()).draw();
        });
    });
</script>

@endsection
