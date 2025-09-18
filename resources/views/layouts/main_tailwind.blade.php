<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Kitap Ödünç Alma Sistemi</title>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Üst Menü -->
    <header class="bg-white shadow w-full">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Kütüphane Kitap Ödünç Alma Sistemi
            </h1>
        </div>
    </header>

    <div class="flex flex-1 min-h-screen overflow-hidden">
        <!-- Sol Kenar Menü -->
        <div class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 relative">
            <ul class="space-y-2">
                <!-- Kitap -->
                <li>
                    <button class="font-bold w-full text-left" onclick="toggleDropdown('book-menu')">Kitap</button>
                    <ul id="book-menu" class="hidden pl-4 space-y-1">
                        <li><a href="#" class="hover:text-gray-300">Yeni Kitap Ekle</a></li>
                        <li><a href="#" class="hover:text-gray-300">Kitap Listesi</a></li>
                    </ul>
                </li>

                <!-- Tür -->
                <li>
                    <button class="font-bold w-full text-left" onclick="toggleDropdown('genre-menu')">Tür</button>
                    <ul id="genre-menu" class="hidden pl-4 space-y-1">
                        <li><a href="#" class="hover:text-gray-300">Yeni Tür Ekle</a></li>
                        <li><a href="#" class="hover:text-gray-300">Tür Listesi</a></li>
                    </ul>
                </li>

                <!-- Ödünç Almalar -->
                <li>
                    <button class="font-bold w-full text-left" onclick="toggleDropdown('rentals-menu')">Ödünç Almalar</button>
                    <ul id="rentals-menu" class="hidden pl-4 space-y-1">
                        <li>
                            <button class="w-full text-left" onclick="toggleDropdown('rental-requests-menu')">Ödünç Alma Talepleri</button>
                            <ul id="rental-requests-menu" class="hidden pl-4 space-y-1">
                                <li><a href="#" class="hover:text-gray-300">Beklemede</a></li>
                                <li><a href="#" class="hover:text-gray-300">Onaylandı</a></li>
                                <li><a href="#" class="hover:text-gray-300">Reddedildi</a></li>
                            </ul>

                            <button class="w-full text-left" onclick="toggleDropdown('rentals-list-menu')">Ödünç Alma Listesi</button>
                            <ul id="rentals-list-menu" class="hidden pl-4 space-y-1">
                                <li><a href="#" class="hover:text-gray-300">Devam Eden Ödünç Almalar</a></li>
                                <li><a href="#" class="hover:text-gray-300">Tamamlanan Ödünç Almalar</a></li>
                                <li><a href="#" class="hover:text-gray-300">Geciken Ödünç Almalar</a></li>
                                <li><a href="#" class="hover:text-gray-300">Tüm Ödünç Almaları Görüntüle</a></li>
                            </ul>

                            <button class="w-full text-left" onclick="toggleDropdown('renter-requests-menu')">Ödünç Alıcı Talepleri</button>
                            <ul id="renter-requests-menu" class="hidden pl-4 space-y-1">
                                <li><a href="#" class="hover:text-gray-300">Beklemede</a></li>
                                <li><a href="#" class="hover:text-gray-300">Onaylandı</a></li>
                                <li><a href="#" class="hover:text-gray-300">Reddedildi</a></li>
                            </ul>

                            <button class="w-full text-left" onclick="toggleDropdown('renters-list-menu')">Ödünç Alıcı Listesi</button>
                            <ul id="renters-list-menu" class="hidden pl-4 space-y-1">
                                <li><a href="#" class="hover:text-gray-300">Devam Eden Ödünç Almalar</a></li>
                                <li><a href="#" class="hover:text-gray-300">Tamamlanan Ödünç Almalar</a></li>
                                <li><a href="#" class="hover:text-gray-300">Geciken Ödünç Almalar</a></li>
                                <li><a href="#" class="hover:text-gray-300">Tüm Ödünç Alıcıları Görüntüle</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Ana İçerik -->
        <div class="flex-1 overflow-auto">
            @yield('content')
        </div>
    </div>

    <!-- Alt Bilgi -->
    <footer class="bg-white shadow w-full">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-500">
                &copy; 2024 Kitap Ödünç Alma Sistemi. Tüm hakları saklıdır.
            </p>
        </div>
    </footer>

    <script>
        function toggleDropdown(menuId) {
            var element = document.getElementById(menuId);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
