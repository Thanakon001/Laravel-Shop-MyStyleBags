@extends('layouts.home')
@section('content')
<div class="d-flex justify-content-between">
    <h3>ข้อมูลผู้ใช้งาน</h3>
</div>
<p>ข้อมูลผู้ใช้งานทั้งหมด</p>
<div class="row bg-white py-2 rounded-1 shadow-sm">
    <p class="fs-6">จัดการข้อมูลผู้ใช้งาน</p>
    <table class="table" id="table-product-main">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อผู้ใช้</th>
                <th>อีเมล(email)</th>
                <th>สถานะการใช้งาน</th>
                <th>ดำเนินการ</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อผู้ใช้</th>
                <th>อีเมล(email)</th>
                <th>สถานะการใช้งาน</th>
                <th>ดำเนินการ</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role === 'user' ? 'ปกติ' : 'ระงับการใช้งาน'}}</td>
                    <td><a href="{{route('cutomer.profile', $user->email)}}"
                            class="text-bg-warning p-1 rounded-1 text-white text-decoration-none">จัดการ</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('script')
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            const datatablesSimple = document.getElementById("table-product-main");
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endpush