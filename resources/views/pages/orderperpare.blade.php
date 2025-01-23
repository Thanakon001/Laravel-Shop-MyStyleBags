@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h2>จัดการรายละเอียดออเดอร์</h2>
    <form method="POST" id="comfirmOrder" action="{{ route('order.perpare.store', $order->order_id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- เลขที่คำสั่งซื้อ -->
            <div class="col-md-6">
                <div class="form-group mt-3">
                    <label for="order_id">เลขที่คำสั่งซื้อ</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $order->order_id }}"
                        readonly>
                </div>
            </div>

            <!-- ชื่อผู้สั่งซื้อ -->
            <div class="col-md-6">
                <div class="form-group mt-3">
                    <label for="order_name">ชื่อผู้สั่งซื้อ</label>
                    <input type="text" class="form-control" id="order_name" name="order_name"
                        value="{{ $order->order_name }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- ที่อยู่ผู้สั่งซื้อ -->
            <div class="col-md-12">
                <div class="form-group mt-3">
                    <label for="order_address">ที่อยู่ผู้สั่งซื้อ</label>
                    <textarea class="form-control" id="order_address" name="order_address" rows="4"
                        readonly>{{ $order->order_address }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- สถานะการจัดเตรียมพัสดุ -->
            <div class="col-md-6">
                <div class="form-group mt-3">
                    <label for="order_status">สถานะการจัดเตรียมพัสดุ</label>
                    <select class="form-control" id="order_status" name="order_status">
                        <option value="Pending" @if($order->order_status === 'Pending') selected @endif>กำลังเตรียมพัสดุ
                        </option>
                        <option value="Success" @if($order->order_status === 'Success') selected @endif>จัดส่งแล้ว
                        </option>
                        <option value="Cancel" @if($order->order_status === 'Cancel') selected @endif>ยกเลิก</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6" id="order_tracking_container" style="display: none;">
                <div class="form-group mt-3">
                    <label for="order_tracking">หมายเลขการจัดส่ง</label>
                    <input type="text" class="form-control @error('order_tracking') is-invalid @enderror"
                        id="order_tracking" name="order_tracking" required>
                    @error('order_tracking')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- ที่อยู่ผู้สั่งซื้อ -->
            <div class="col-md-12">
                <div class="form-group mt-3">
                    <label for="order_details">รายละเอียดออเดอร์สินค้า(ข้อความในส่วนนี้จะส่งไปที่ผู้สั่งซื้อ)</label>
                    <textarea class="form-control" id="order_details" name="order_details" rows="4"></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between col-8 mt-3">
            <div>
                <div onclick="comfirmOrder()" class="btn btn-primary text-white">บันทึกการจัดเตรียมพัสดุ</div>
                <a href="{{ route('order') }}" class="btn btn-warning text-white">ยกเลิก</a>
            </div>
        </div>
    </form>

    <div class="row bg-white py-2 rounded-1 mt-4">
        <p class="fs-6">ข้อมูลรายละเอียดออเดอร์สินค้า</p>
        <table class="table" id="table-product-main">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคารวม</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($order->orderlist as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->pro_bacode}}</td>
                        <td>{{$item->product->pro_name}}</td>
                        <td>{{$item->list_quentity}}</td>
                        <td>{{$item->list_total}}</td>
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
            const orderStatus = document.getElementById('order_status');
            const orderTrackingContainer = document.getElementById('order_tracking_container');
            const orderTracking = document.getElementById('order_tracking');

            // ฟังก์ชันในการแสดง/ซ่อน input order_tracking
            function toggleOrderTrackingInput() {
                if (orderStatus.value === 'Success') {
                    orderTrackingContainer.style.display = 'block';
                    orderTracking.setAttribute('required', 'required');
                } else {
                    orderTrackingContainer.style.display = 'none';
                    orderTracking.removeAttribute('required');
                }
            }

            orderStatus.addEventListener('change', toggleOrderTrackingInput);

            toggleOrderTrackingInput();
            const datatablesSimple = document.getElementById("table-product-main");
            if (datatablesSimple) {
                new simpleDatatables.DataTable(datatablesSimple);
            }
        });

        const comfirmOrder = () => {
            Swal.fire({
                title: "ยืนยันการบันทึก?",
                text: "คุณต้องการบันทึกรายการนี้หรือไม่",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    document.getElementById('comfirmOrder').submit()
                }
            });
        }
    </script>
@endpush