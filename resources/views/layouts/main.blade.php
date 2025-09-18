<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Ödünç Alma Sistemi (BRS)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/searchbar.css" rel="stylesheet">

    <style>
        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #0d6efd, #6610f2);
            min-height: 100vh;
            padding-top: 20px;
            color: white;
        }

        .sidebar .nav-link {
            color: #f1f1f1;
            font-weight: 500;
            transition: all 0.3s;
            border-radius: 8px;
            margin: 4px 0;
            padding: 10px 15px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .sidebar-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 10px;
        }

        .company-name {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Search bar */
        .search-bar-container {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 30px;
            padding: 5px 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .search-bar-container input {
            border: none;
            outline: none;
            flex: 1;
            padding: 8px 12px;
            border-radius: 30px;
        }

        .search-bar-container button {
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .search-bar-container button img {
            width: 22px;
            height: 22px;
        }

        /* Profil ve bildirim */
        .btn-outline-secondary {
            border-radius: 50px !important;
            padding: 6px 10px;
            transition: 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        /* Dropdown menü */
        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            border-radius: 6px;
        }

        /* Genel boşluk */
        main {
            background: #f8f9fc;
            min-height: 100vh;
            padding: 20px;
        }
    </style>

    @php
        $user = auth()->user();
        $isAdmin = $user && ($user->role === 'admin');
        $isLibrarian = $user && ($user->role === 'librarian');
        $isReader = $user && ($user->role === 'reader');
    @endphp

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <!-- Logo -->
                        <div class="sidebar-logo">
                            <a href="/">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6TYJIJDHxuJMM0m2-DYwD_0LKUT6gdWb_A&usqp=CAU"
                                    alt="Dashboard Logo">
                            </a>
                            @auth
                                <h4 class="company-name">{{ Auth::user()->name }}</h4>
                                <h6 class="company-name" style="text-transform:uppercase;">{{ Auth::user()->role }}</h6>
                            @endauth
                        </div>

                        <!-- Kitaplar -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBooks" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                📚 Kitaplar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownBooks">
                                @auth
                                    @if($isAdmin || $isLibrarian)
                                        <li><a class="dropdown-item" href="/books/create">➕ Yeni Kitap Ekle</a></li>
                                    @endif
                                @endauth
                                <li><a class="dropdown-item" href="/books">📖 Kitap Listesi</a></li>
                            </ul>
                        </li>

                        <!-- Türler -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownGenre" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                🎭 Türler
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownGenre">
                                @auth
                                    @if($isAdmin || $isLibrarian)
                                        <li><a class="dropdown-item" href="/genres/create">➕ Yeni Tür Ekle</a></li>
                                    @endif
                                @endauth
                                <li><a class="dropdown-item" href="/genres">📂 Tür Listesi</a></li>
                            </ul>
                        </li>

                        <!-- Ödünç Alma Talepleri -->
                        @auth
                            @if($isAdmin || $isLibrarian)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentalRequests" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        📝 Ödünç Alma Talepleri
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentalRequests">
                                        <li><a class="dropdown-item" href="/rentals/pendinglist">⏳ Bekleyen</a></li>
                                        <li><a class="dropdown-item" href="/rentals/approvedlist">✅ Onaylanan</a></li>
                                        <li><a class="dropdown-item" href="/rentals/rejectedlist">❌ Reddedilen</a></li>
                                    </ul>
                                </li>

                                <!-- Ödünç Almalar -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRentalsList" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        📦 Ödünç Almalar
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownRentalsList">
                                        <li><a class="dropdown-item" href="/rentals/ongoinglist">🚚 Devam Eden Ödünç Almalar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="/rentals/returnedlist">📬 Tamamlanan Ödünç
                                                Almalar</a></li>
                                        <li><a class="dropdown-item" href="/rentals/overduelist">⏰ Geciken Ödünç Almalar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="/rentals/all">📋 Tüm Ödünç Almalar</a></li>
                                    </ul>
                                </li>

                                <!-- Okuyucular -->
                                <li class="nav-item">
                                    <a class="nav-link" href="/readers" id="navbarReadersList">
                                        👥 Okuyucu Listesi
                                    </a>
                                </li>
                            @endif
                        @endauth

                        <!-- Kütüphaneciler -->
                        @auth
                            @if($isAdmin)
                                <li class="nav-item">
                                    <a class="nav-link" href="/librarians" id="navbarLibrariansList">
                                        🧑‍🏫 Kütüphaneci Listesi
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </nav>

            <!-- Main -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <!-- Arama Çubuğu -->
                    <div class="search-bar-container w-50">
                        <form action="{{ route('search.results') }}" method="GET" class="w-100 d-flex">
                            <input type="text" id="search-input" name="query" placeholder=" Kitap, yazar, tür ara..."
                                autocomplete="off" class="w-100">
                            <button type="submit"><img src="https://cdn-icons-png.flaticon.com/512/3771/3771554.png"
                                    alt="search-button-icon"></button>
                            <ul id="suggestions-list"></ul>
                        </form>
                    </div>

                    <!-- Sağ Menü -->
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @auth
                            <!-- Bildirimler -->
                            <div class="btn-group me-2 position-relative">
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    <img src="https://cdn-icons-png.freepik.com/512/8184/8184279.png"
                                        alt="notification-icon" class="rounded-circle" style="width: 30px; height: 30px;">
                                    <span
                                        class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle p-1"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Bildirim 1</a></li>
                                    <li><a class="dropdown-item" href="#">Bildirim 2</a></li>
                                    <li><a class="dropdown-item" href="#">Bildirim 3</a></li>
                                </ul>
                            </div>
                            <!-- Kullanıcı -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE6TYJIJDHxuJMM0m2-DYwD_0LKUT6gdWb_A&usqp=CAU"
                                        alt="User" class="rounded-circle" style="width: 30px; height: 30px;">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item">{{ Auth::user()->name }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profilim</a></li>
                                    @auth
                                        @if($isReader)
                                            <li><a class="dropdown-item" href="/myrentals">Ödünç Aldıklarım</a></li>
                                        @endif
                                    @endauth
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                Çıkış Yap
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth


                        @if (Route::has('login'))
                            <nav>
                                @auth
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">Giriş Yap</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-success btn-sm">Kayıt Ol</a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </div>
                </div>

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search-input').on('input', function () {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('search.suggestions') }}",
                    data: { term: query },
                    success: function (data) {
                        var suggestionBox = $("#suggestions-list");
                        suggestionBox.empty();
                        $.each(data, function (index, suggestion) {
                            suggestionBox.append(
                                $("<li>").append(
                                    $("<a>").attr("href", suggestion.url).text(suggestion.label)
                                )
                            );
                        });
                    }
                });
            });
        });
    </script>
    @include('layouts.footer')

</body>

</html>