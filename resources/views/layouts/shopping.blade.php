<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MyStyle Bags')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/simpleTables.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body class="d-flex flex-column vh-100">

    <nav class="d-flex justify-content-between gap-2 bg-white px-4 py-3 shadow-sm sticky-top">
        <div class="logo col-4">
            <a class="d-flex align-items-center gap-2" href="{{route('shop.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#5f6368">
                    <path
                        d="M160-720v-80h640v80H160Zm0 560v-240h-40v-80l40-200h640l40 200v80h-40v240h-80v-240H560v240H160Zm80-80h240v-160H240v160Zm-38-240h556-556Zm0 0h556l-24-120H226l-24 120Z" />
                </svg>
                <span class="fs-4 text-info">MyStyle <span class="text-warning">Bags</span></span>
            </a>
        </div>

        <div class="d-flex justify-content-center align-items-center gap-3 col-4">
            <a href="{{route('shop.index')}}" class="text-dark">หน้าหลัก</a>
            <a href="{{route('shop.product')}}" class="text-dark">สินค้า</a>
            @if (Auth::user())
                <a href="{{route('shop.order.history')}}" class="text-dark">ประวัติคำสั่งซื้อ</a>
            @endif
            <a href="{{route('shop.about')}}" class="text-dark">เกี่ยวกับเรา</a>
            <!-- <a href="{{route('shop.contact')}}" class="text-dark">ติดต่อ</a> -->
        </div>

        <div class="justify-content-end d-flex align-items-center gap-3 col-4 px-4">
            @if (!Auth::user())
                <a href="{{route('register')}}" class="text-dark">สมัครสมาชิก</a>
                <a href="{{route('login')}}" class="text-dark">เข้าสู่ระบบ</a>
            @endif
            @if (Auth::user())
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="data:image/png;base64,{{ base64_encode(Auth::user()->profile_image) }}" alt="" width="32"
                            height="32" class="rounded-circle me-2 object-fit-cover">
                        <strong class="text-dark d-flex align-items-center gap-2">thanakon
                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                                fill="#000000">
                                <path d="M480-333 240-573l51-51 189 189 189-189 51 51-240 240Z" />
                            </svg>
                        </strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="{{route('shop.profile')}}">โปรไฟล์</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="comfirmLogout('{{route('logout.admin')}}')">ออกจากระบบ</a>
                        </li>
                    </ul>
                </div>
            @endif
            <a href="{{route('shop.cart')}}" class="text-dark position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#5f6368">
                    <path
                        d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                </svg>
                <span
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{count(Session::get('cart', []))}}</span>
            </a>
        </div>
    </nav>

    <div class="flex-grow-1 d-flex flex-column gap-2">
        @yield('content')
    </div>

    <footer class="bg-light">
        <div class="text-center p-3">
            © 2025 Company
        </div>
    </footer>

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