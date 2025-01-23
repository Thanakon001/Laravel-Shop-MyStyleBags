@extends('layouts.shopping')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">ชำระเงิน</h1>

    <form action="{{route('shop.order.store')}}" method="POST">
        @csrf
        <h4>ข้อมูลผู้ซื้อ</h4>
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" id="name" name="order_name" class="form-control" placeholder="กรอกชื่อ-นามสกุล" required />
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">ที่อยู่จัดส่ง</label>
            <textarea id="address" name="order_address" class="form-control" rows="3" placeholder="กรอกที่อยู่" required></textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
            <input type="tel" id="phone" name="order_phone" class="form-control" placeholder="กรอกเบอร์โทรศัพท์" required />
        </div>

        <h4>วิธีการชำระเงิน</h4>
        <div class="mb-3">
            <select id="paymentMethod" name="order_payment" class="form-select" required>
                <option disabled value="">เลือกวิธีการชำระเงิน</option>
                <option value="bank_transfer">โอนผ่านธนาคาร</option>
                <option value="cash_on_delivery">เก็บเงินปลายทาง</option>
            </select>
        </div>

        <br>
        <h4>รายการสินค้า</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td>{{ $item['pro_name'] }}</td>
                    <td>{{ $item['list_quentity'] }}</td>
                    <td>{{ number_format($item['pro_price'] * $item['list_quentity'], 2) }} ฿</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-end"><strong>รวมทั้งหมด:</strong></td>
                    <td>{{ number_format($totalPrice, 2) }} ฿</td>
                </tr>
            </tfoot>
        </table>

        <button type="submit" class="btn btn-primary w-100 text-white">ยืนยันการสั่งซื้อ</button>
    </form>
</div>
<style>
    .container {
        max-width: 800px;
    }
</style>
@endsection
