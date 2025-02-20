<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การยืนยันการสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fulid vh-100 py-5  bg-warning">
        <div class="container shadow-lg p-2 bg-white rounded">
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
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>