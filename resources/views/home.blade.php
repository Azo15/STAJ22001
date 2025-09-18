@extends('layouts.main')

@section('content')

@include('flashmsg')

<div class="container py-5">

    <div class="row g-4">
        <!-- Okuyucu Sayısı Kartı -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Okuyucu Sayısı</div>
                            <div class="text-lg fw-bold">{{ $numberOfReaders }}</div>
                        </div>
                        <i class="fas fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tür Sayısı Kartı -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-dark-75 small">Tür Sayısı</div>
                            <div class="text-lg fw-bold">{{ $numberOfGenres }}</div>
                        </div>
                        <i class="fas fa-bookmark fa-2x text-dark-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kitap Sayısı Kartı -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Kitap Sayısı</div>
                            <div class="text-lg fw-bold">{{ $numberOfBooks }}</div>
                        </div>
                        <i class="fas fa-book fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktif Ödünç Alma Sayısı Kartı -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Aktif Kitap Ödünç Almaları</div>
                            <div class="text-lg fw-bold">{{ $numberOfActiveRentals }}</div>
                        </div>
                        <i class="fas fa-book-reader fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- En Popüler Kitap Kartı -->
        <div class="col-12">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">En Popüler Kitap</h5>
                    <div class="d-flex align-items-center">
                        <img src="{{ $popularBookCover }}" alt="kapak" class="img-fluid rounded me-4" style="width: 100px; height: auto;">
                        <div>
                            <div class="text-muted small">Başlık: {{ $popularBookTitle }}</div>
                            <div class="text-muted small">Yazar: {{ $popularBookAuthor }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
