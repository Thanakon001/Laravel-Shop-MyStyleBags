@extends('layouts.home')
@section('content')
<h3>รายการออเดอร์สั่งสินค้า</h3>
<p>รายการออเดอร์สั่งสินค้าทั้งหมด</p>
<div class="row bg-white py-2 rounded-1 shadow-sm">
    <p class="fs-5">จัดการข้อมูลออเดอร์สั่งสินค้า <span class="badge bg-danger">ยกเลิกแล้ว</span></p>
    <table class="table" id="table-cancel-main">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>เลขที่คำสั่งซื้อ</th>
                <th>วันที่/เวลา สั่งซื้อ</th>
                <th>ชื่อผู้สั่งซื้อ</th>
                <th>ยอดรวม</th>
                <th>สินค้า(รายการ)</th>
                <th>สถานะออเดอร์</th>
                <th>ดำเนินการ</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ลำดับ</th>
                <th>เลขที่คำสั่งซื้อ</th>
                <th>วันที่/เวลา สั่งซื้อ</th>
                <th>ชื่อผู้สั่งซื้อ</th>
                <th>ยอดรวม</th>
                <th>สินค้า(รายการ)</th>
                <th>สถานะออเดอร์</th>
                <th>ดำเนินการ</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->order_id}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>{{$order->order_name}}</td>
                    <td>{{$order->order_total}} บาท</td>
                    <td>{{count($order->orderList)}} รายการ</td>
                    <td><span class="badge bg-danger text-white fs-6">{{$order->order_status}}</span></td>
                    <td><a href="{{route('order.perpare', $order->order_id)}}" class="text-dark">รายละเอียด</a></td>
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

            const orderSimple = document.getElementById("table-order-main");
            if (orderSimple) {
                new simpleDatatables.DataTable(orderSimple);
            }

            const CancelSimple = document.getElementById("table-cancel-main");
            if (CancelSimple) {
                new simpleDatatables.DataTable(CancelSimple);
            }
        });
    </script>
@endpush