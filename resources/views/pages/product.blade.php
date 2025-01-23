@extends('layouts.home')
@section('content')
<div class="d-flex justify-content-between">
    <h3>ข้อมูลสินค้า</h3>
    <a href="{{route('product.create')}}" class="btn btn-success text-white shadow-sm animate__animated animate__fadeInRight">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
            <path
                d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
        </svg>
        เพิ่มข้อมูลสินค้า
    </a>
</div>
<p>รายการสินค้าทั้งหมด</p>
<div class="row bg-white py-2 rounded-1 shadow-sm">
    <p>จัดการข้อมูลสินค้า</p>
    <table class="table" id="table-product-main">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อหมวดหมู่</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>จำนวนคงเหลือ</th>
                <th>ดำเนินการ</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ลำดับ</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อหมวดหมู่</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>จำนวนคงเหลือ</th>
                <th>ดำเนินการ</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$product->pro_bacode}}</td>
                    <td>
                        @if ($product->bands)
                            {{ $product->bands->band_name }}
                        @else
                            ไม่มีแบรนด์
                        @endif
                    </td>
                    <td>{{$product->pro_name}}</td>
                    <td>{{$product->pro_price}}</td>
                    <td>
                        {{$product->pro_stock}}
                    </td>
                    <td>
                        <a class="text-bg-warning p-1 rounded-1 text-white"
                            href="{{route('product.edit', $product->pro_bacode)}}">แก้ไขที่นี่</a>
                    </td>
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