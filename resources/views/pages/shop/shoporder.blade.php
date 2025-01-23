@extends('layouts.shopping')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">สถานะคำสั่งซื้อ</h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="fs-5">
                คำสั่งซื้อ #{{ $order->order_id }}
            </div>
            <hr>
            <div class="mt-3">
                <h4>ข้อมูลผู้สั่งซื้อ</h4>
                <p><strong>ชื่อ:</strong> {{ $order->order_name }}</p>
                <p><strong>เบอร์โทรศัพท์:</strong> {{ $order->order_phone }}</p>
                <p><strong>ที่อยู่จัดส่ง:</strong> {{ $order->order_address }}</p>

                <h4 class="mt-4">สถานะการสั่งซื้อ</h4>
                <p><strong>สถานะ:</strong> {{ ucfirst($order->order_status) }}</p>

                @if($order->order_status == 'Pending')
                    <p class="text-warning">คำสั่งซื้อนี้ยังอยู่ในสถานะรอการชำระเงิน</p>
                @elseif($order->order_status == 'Sucess')
                    <p class="text-info">คำสั่งซื้อของท่านถูกจัดส่งแล้ว</p>
                @elseif($order->order_status == 'delivered')
                    <p class="text-success">คำสั่งซื้อของท่านได้รับการจัดส่งเรียบร้อยแล้ว</p>
                @else
                    <p class="text-danger">คำสังซื้อถูกยกเลิก</p>
                @endif
                <table class="table" id="product">
                    <thead>
                        <tr>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderList as $item)
                            <tr>
                                <td>{{ $item->product->pro_name }}</td>
                                <td>{{ $item->list_quentity }}</td>
                                <td>{{ number_format($item->pro_price, 2) }} บาท</td>
                                <td>{{ number_format($item->pro_price * $item->list_quentity, 2) }} บาท</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- รวมยอด -->
                <h4 class="mt-4 text-end">รวมทั้งหมด: {{ number_format($order->order_total, 2) }} บาท</h4>
            </div>
            <form action="{{route('shop.order.edit')}}" method="post" id="createProduct">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                @if ($order->order_status == 'Pending')
                    <input type="hidden" name="order_status" value="Cancel">
                    <div onclick="comfirmOrder()" class="btn btn-danger text-white">ยกเลิกคำสั่งซื้อ</div>
                @endif
                <a href="{{route('shop.order.history')}}" class="btn btn-warning text-white">ย้อนกลับ</a>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        const comfirmOrder = () => {
            Swal.fire({
                title: "ยืนยันการบันทึก?",
                text: "คุณต้องการยกเลิกรายการนี้หรือไม่",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    document.getElementById('createProduct').submit()
                }
            });
        }
        window.addEventListener("DOMContentLoaded", (event) => {
            const datatablesSimple = document.getElementById("product");
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });
    </script>
@endpush