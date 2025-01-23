@extends('layouts.shopping')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">ประวัติคำสั่งซื้อ</h1>
    <div class="row">
        <table class="table" id="product">
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
                        <td>
                            @if($order->order_status == 'Pending')
                                <span class="badge bg-warning text-white fs-6">{{$order->order_status}}</span>
                            @elseif($order->order_status == 'Sucess')
                                <span class="badge bg-success text-white fs-6">{{$order->order_status}}</span>
                            @elseif($order->order_status == 'delivered')
                                <span class="badge bg-primary text-white fs-6">{{$order->order_status}}</span>
                            @else
                                <span class="badge bg-danger text-white fs-6">{{$order->order_status}}</span>
                            @endif
                        </td>
                        <td><a href="{{route('shop.order.check', $order->order_id)}}" class="text-dark">รายละเอียด</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            const datatablesSimple = document.getElementById("product");
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endpush