@extends('layouts.main')

@section('content')

@include('flashmsg')

<link rel="stylesheet" href="/css/tables.css">

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<div class="container">
    <h2>Ödünç Almalarım</h2>
    <table id="table1" class="table">
        <thead>
            <tr>
                <th>Ödünç Alma ID</th>
                <th>Kitap Başlığı</th>
                <th>Kitap Yazarı</th>
                <th>Durum</th>
                <th>Talep Tarihi</th>
                <th>Başlangıç Tarihi</th>
                <th>Teslim Tarihi</th>
                <th>İade Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @if ($rentals->isEmpty())
            <tr>
                <td colspan="8">Ödünç Alma bulunamadı.</td>
            </tr>
            @endif

            @foreach ($rentals as $rental)
            <tr>
                <td>{{ $rental->id }}</td>
                <td>{{ $rental->book->title }}</td>
                <td>{{ $rental->book->author }}</td>
                <td>{{ $rental->status }}</td>
                <td>{{ $rental->rental_requested_at }}</td>
                <td>{{ $rental->rental_start_at }}</td>
                <td>{{ $rental->rental_due_at }}</td>
                <td>{{ $rental->returned_at }}</td>
                <td>
                    @if ((is_null($rental->returned_at)) && ($rental->status != 'Pending Review') && ($rental->status != 'Cancelled'))
                        <form action="{{ route('rentals.return', $rental->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-warning btn-sm">Kitabı İade Et</button>
                        </form>
                    @elseif ($rental->status == 'Pending Review')
                        <form action="{{ route('rentals.cancelrequest', $rental->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn-danger btn-sm">Talebi İptal Et</button>
                        </form>
                    @elseif ((is_null($rental->returned_at)) && ($rental->status == 'Cancelled'))
                        Talep İptal Edildi/Reddedildi
                    @else
                        İade Edildi
                    @endif
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
