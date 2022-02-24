<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg" href="https://i.imgur.com/UyXqJLi.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 font-roboto">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-red-600 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-4">
                <div class="flex items-center">
                    {{-- <svg class="h-12 w-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                            fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                            fill="white" />
                    </svg> --}}
                    <span class="text-white text-2xl mx-2 mb-3 font-semibold">Ry Furniture</span>
                </div>
            </div>


            <nav class="mt-5">
                <a class="flex items-center mt-4 py-2 px-6 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/dashboard*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.dashboard.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>

                    <span class="mx-3">Dashboard</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/category*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.category.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                        <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                    </svg>
                    <span class="mx-3">Category</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/product*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.product.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z"
                            clip-rule="evenodd" />
                        <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z" />
                    </svg>
                    <span class="mx-3">Product</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/customer*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.customer.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="mx-3">Customer</span>
                </a>
                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/laporan*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.laporan.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                      </svg>
                    <span class="mx-3">Laporan</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/bank*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.bank.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                        <path fill-rule="evenodd"
                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="mx-3">Metode Pembayaran</span>
                </a>
                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/service*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.service.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="mx-3">Customer Service</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/voucher*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.voucher.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="mx-3">Iklan Produk</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/slide*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.slide.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                    <span class="mx-3">Slide</span>
                </a>

                <a class="flex items-center mt-1 py-2 px-6 hover:bg-green-700 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/transaction*') ? ' bg-green-700 bg-opacity-25 text-gray-100' : 'text-white' }}"
                    href="{{ route('admin.transaction.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="mx-3">Transaction</span>
                </a>

            </nav>
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 bg-white">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-600 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">

                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen"
                            class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                            <img class="h-full w-full object-cover" src="{{ auth()->user()->avatar }}">
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                            class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="dropdownOpen"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-sm z-10">
                            <div class="block px-4 py-2 text-sm text-gray-700">
                                {{ auth()->user()->name }}
                            </div>
                            <hr>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')

        </div>
    </div>

    <script>
        @if (session()->has('success'))

            Swal.fire({
            icon: 'success',
            title: 'BERHASIL!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
            })

        @elseif(session()->has('error'))

            Swal.fire({
            icon: 'error',
            text: 'GAGAL!',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000
            })

        @endif
    </script>
</body>

</html>
