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
        <div class="d-flex flex-column flex-shrink- p-3 text-white bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 text-info animate__animated animate__pulse animate__infinite">MyStyle <span
                        class="text-warning">Bags</span></span>
            </a>
            <hr>
            <!-- manu -->
            <ul class="nav nav-pills flex-column mb-auto fs-5">
                <li>
                    <a href="{{route('home')}}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#FFFFFF">
                            <path
                                d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                        </svg>
                        หน้าหลัก
                    </a>
                </li>
                <li>
                    <a href="{{route('cutomer')}}" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#FFFFFF">
                            <path
                                d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z" />
                        </svg>
                        ข้อมูลลูกค้า
                    </a>
                </li>
                <hr>
                <li>
                    <span class="nav-link text-white">
                        รายการสั่งซื้อ
                    </span>
                    <a href="{{route('order')}}" class="nav-link text-white ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#ffffff">
                            <path
                                d="M340-520q42 0 71-29t29-71v-100H240v100q0 42 29 71t71 29ZM240-240h200v-100q0-42-29-71t-71-29q-42 0-71 29t-29 71v100Zm-140 80v-80h60v-100q0-42 18-78t50-62q-32-26-50-62t-18-78v-100h-60v-80h480v80h-60v100q0 42-18 78t-50 62q32 26 50 62t18 78v100h60v80H100Zm680 0L640-300l57-56 43 43v-487h80v488l44-44 56 56-140 140ZM340-720Zm0 480Z" />
                        </svg>
                        รอส่งสินค้า
                    </a>
                    <a href="{{route('order.success')}}" class="nav-link text-white ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#FFFFFF">
                            <path
                                d="m429-336 238-237-51-51-187 186-85-84-51 51 136 135Zm51 240q-79 0-149-30t-122.5-82.5Q156-261 126-331T96-480q0-80 30-149.5t82.5-122Q261-804 331-834t149-30q80 0 149.5 30t122 82.5Q804-699 834-629.5T864-480q0 79-30 149t-82.5 122.5Q699-156 629.5-126T480-96Zm0-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm0-312Z" />
                        </svg>
                        จัดส่งสินค้าแล้ว
                    </a>
                    <a href="{{route('order.cancel')}}" class="nav-link text-white ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#FFFFFF">
                            <path
                                d="m768-90-72-72q-49 32-103.5 49T480-96q-79.38 0-149.19-30T208.5-208.5Q156-261 126-330.81T96-480q0-58 17-112.5T162-696l-72-72 51-51 678 678-51 51Zm-287.89-78Q524-168 565-181t79-34L476-383l-47 47-136-136 51-51 85 85-4 4-210-210q-21 38-34 79t-13 84.89q0 129.72 91.19 220.92Q350.39-168 480.11-168ZM798-264l-53-52q22-38 34.5-79t12.5-84.89q0-129.72-91.19-220.92Q609.61-792 479.89-792 436-792 395-779.5T316-745l-52-53q48-32 103-49t113.27-17q79.27 0 149 30t122.23 82.5Q804-699 834-629.27t30 149Q864-422 847-367q-17 55-49 103ZM577-484l-50-51 89-89 51 50-90 90Zm-50-51ZM420-420Z" />
                        </svg>
                        ยกเลิกแล้ว
                    </a>
                </li>
                <hr>
                <li>
                    <span class="nav-link text-white">
                        ข้อมูลสินค้า
                    </span>
                    <a href="{{route('product')}}" class="nav-link text-white ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#FFFFFF">
                            <path
                                d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z" />
                        </svg>
                        สินค้า
                    </a>
                    <a href="{{route('band')}}" class="nav-link text-white ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px"
                            fill="#FFFFFF">
                            <path
                                d="M120-80v-60h100v-30h-60v-60h60v-30H120v-60h120q17 0 28.5 11.5T280-280v40q0 17-11.5 28.5T240-200q17 0 28.5 11.5T280-160v40q0 17-11.5 28.5T240-80H120Zm0-280v-110q0-17 11.5-28.5T160-510h60v-30H120v-60h120q17 0 28.5 11.5T280-560v70q0 17-11.5 28.5T240-450h-60v30h100v60H120Zm60-280v-180h-60v-60h120v240h-60Zm180 440v-80h480v80H360Zm0-240v-80h480v80H360Zm0-240v-80h480v80H360Z" />
                        </svg>
                        หมวดหมู่สินค้า
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
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
        <div class="flex-grow-1 p-4 overflow-auto bg-secondary" style="max-height: 100vh;">
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