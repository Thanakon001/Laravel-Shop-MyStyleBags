@extends('layouts.home')
@section('content')
<h3>หน้าหลัก</h3>
<p>Welcome to the admin panel.</p>
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 border-0 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Total Users</h4>
                <h6 class="card-title">(ผู้ใช้ทั้งหมด)</h6>
                <p class="card-text">{{$userTotal}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 border-0 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Total Product</h4>
                <h6 class="card-title">(สินค้าทั้งหมด)</h6>
                <p class="card-text">{{$productTotal}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3 border-0 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Order Today</h4>
                <h6 class="card-title">(การสั้งซื้อวันนี้)</h6>
                <p class="card-text">{{$orderToDay}}</p>
            </div>
        </div>
    </div>
</div>
<div class="row bg-white py-3 px-0 rounded-1 shadow-sm">
    <p class="fs-6">รายการสินค้าสั่งซื้อล่าสุด</p>
    <table class="table table-hover" id="table-order-main">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>วันที่/เวลา สั่งซื้อ</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>ชื่อผู้สั่งซื้อ</th>
                <th>ราคารวม</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ลำดับ</th>
                <th>วันที่/เวลา สั่งซื้อ</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>ชื่อผู้สั่งซื้อ</th>
                <th>ราคารวม</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->product->pro_bacode}}</td>
                    <td>{{$order->product->pro_name}}</td>
                    <td>{{$order->list_quentity}}</td>
                    <td>{{$order->order->order_name}}</td>
                    <td>{{$order->order->order_total}} บาท</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('script')
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            const datatablesSimple = document.getElementById("table-order-main");
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endpush