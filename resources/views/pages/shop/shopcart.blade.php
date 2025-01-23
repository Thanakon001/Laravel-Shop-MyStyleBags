@extends('layouts.shopping')

@section('content')
<div class="container-md py-5">
    <h3 class="mb-4">ตะกร้าสินค้า</h3>

    @if(count($cart) === 0)
        <div class="text-center">
            <p>ยังไม่มีสินค้าในตะกร้า</p>
            <hr>
            <a href="/" class="btn btn-primary text-white">ไปเลือกซื้อสินค้า</a>
        </div>
    @else
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>สินค้า</th>
                        <th>ราคา</th>
                        <th width="20%">จำนวน</th>
                        <th>รวม</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>{{ $item['pro_name'] }}</td>
                            <td>฿{{ number_format($item['pro_price'], 2) }}</td>
                            <td>
                                <form action="{{ route('shop.cart.add', $id) }}" method="POST" class="input-group">
                                    @csrf
                                    <input type="number" name="quantity" class="form-control" value="{{ $item['list_quentity'] }}" min="1" />
                                    <button type="submit" class="btn btn-primary btn-sm text-white">อัปเดต</button>
                                </form>
                            </td>
                            <td>฿{{ number_format($item['pro_price'] * $item['list_quentity'], 2) }}</td>
                            <td>
                                <form action="{{ route('shop.cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-end mt-4">
                <h4>ราคารวม: ฿{{ number_format(array_sum(array_map(function ($item) {
                    return $item['pro_price'] * $item['list_quentity'];
                }, $cart)), 2) }}</h4>
                <a href="{{ route('shop.payments') }}" class="btn btn-success text-white">ดำเนินการชำระเงิน</a>
            </div>
        </div>
    @endif
</div>
@endsection
