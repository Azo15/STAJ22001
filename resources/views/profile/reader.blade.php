@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="container">
    <h2>{{ $user->name }} adlı kullanıcının Ödünç Almaları</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Ödünç Alma ID</th>
                <th>Kitap Başlığı</th>
                <th>Kitap Yazarı</th>
                <th>Durum</th>
                <th>Talep Tarihi</th>
                <th>Başlangıç Tarihi</th>
                <th>Son Teslim Tarihi</th>
                <th>İade Tarihi</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
