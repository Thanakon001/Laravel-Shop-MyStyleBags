<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MyStyle Bags')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/simpleTables.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        * {
            text-decoration: none;
        }

        .truncate {
            white-space: nowrap;
            /* ไม่ให้ข้อความพับบรรทัด */
            overflow: hidden;
            /* ซ่อนข้อความที่เกิน */
            text-overflow: ellipsis;
            /* แสดง ... เมื่อข้อความยาวเกิน */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="d-flex flex-grow-1">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink- p-3 text-dark bg-white border-end shadow-sm" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 text-info animate__animated animate__pulse animate__infinite">MyStyle <span
                        class="text-warning">Bags</span></span>
            </a>
            <hr>
            <!-- manu -->
            <ul class="nav nav-pills flex-column mb-auto fs-6">
                <li>
                    <a href="{{route('home')}}" class="nav-link text-dark ms-1 {{ is_active('home') }} ">
                        <i class="fa-solid fa-house-user"></i>
                        หน้าหลัก
                    </a>
                </li>
                <li>
                    <a href="{{route('cutomer')}}" class="nav-link text-dark ms-1 {{ is_active('cutomer*') }}">
                        <i class="fa-solid fa-users"></i>
                        ข้อมูลผู้ใช้งาน
                    </a>
                </li>
                <hr>
                <li>
                    <span class="nav-link text-dark">
                        รายการสั่งซื้อ
                    </span>
                    <a href="{{route('order')}}" class="nav-link text-dark ms-1 {{ is_active('order') }}">
                        <i class="fa-solid fa-stopwatch"></i>
                        รอส่งสินค้า
                    </a>
                    <a href="{{route('order.success')}}" class="nav-link text-dark ms-1 {{ is_active('order.success') }}">
                        <i class="fa-solid fa-circle-check"></i>
                        จัดส่งสินค้าแล้ว
                    </a>
                    <a href="{{route('order.cancel')}}" class="nav-link text-dark ms-1 {{ is_active('order.cancel') }}">
                        <i class="fa-solid fa-ban"></i>
                        ยกเลิกแล้ว
                    </a>
                </li>
                <hr>
                <li>
                    <span class="nav-link text-dark">
                        ข้อมูลสินค้า
                    </span>
                    <a href="{{route('product')}}" class="nav-link text-dark ms-1 {{ is_active('product*') }}">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        สินค้า
                    </a>
                    <a href="{{route('band')}}" class="nav-link text-dark ms-1 {{ is_active('band*') }}">
                        <i class="fa-solid fa-list-ul"></i>
                        หมวดหมู่สินค้า
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="data:image/png;base64,{{ base64_encode(Auth::user()->profile_image) }}" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{Auth::user()->name}}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{route('profile')}}">โปรไฟล์</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <div class="dropdown-item" onclick="comfirmLogout('{{route('logout.admin')}}')">ออกจากระบบ</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4 overflow-auto bg-white" style="max-height: 100vh;">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('js/simpleTables.js')}}"></script>
    @stack('script')
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const comfirmLogout = (url) => {
            Swal.fire({
                title: "ยืนยัน?",
                text: "คุณต้องการออกจากระบบหรือไม่",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    window.location.href = url
                }
            });
        }
    </script>
</body>

</html>