@extends('layouts.shopping')
@section('content')
<section class="position-relative" style="height: 480px;">
    <div class="bandner position-absolute"></div>
    <div
        class="position-absolute w-50 top-50 start-50 translate-middle rounded-1 p-3 py-5 text-dark bg-white bg-opacity-75 text-center shadow-lg">
        <h3>ยินดีต้อนรับ</h3>
        <span class="fs-4">เลือกกระเป๋าที่ใช่ในแบบที่คุณต้องการ สวยและทันสมัยไปกับเรา!</span><br>
        <span class="fs-4">ดีไซน์สวยในราคาที่คุณจับต้องได้</span><br>
        <a href="{{route('shop.product')}}" class="btn btn-info mt-3 text-white">เริ่มช็อปปิ้ง</a>
    </div>
</section>

<section class="p-3">
    <h3 class="text-center">สินค้าขายดี</h3>
    <h5 class="text-center">ยอดสั่งซื้อมากกว่า 100 คำสั่งซื้อ!!</h5>
    <div class="container py-3">
        <div class="row justify-content-center gap-3">
            @foreach ($topProduct as $product)
                <div class="card shadow" style="width: 18rem;">
                    <img src="data:image/*;base64,{{ base64_encode($product->pro_image) }}" class="card-img-top"
                        alt="Product Image">
                    <div class="card-body">
                        <p class="card-text">{{$product->pro_name}}</p>
                        <p class="card-text truncate">{{$product->pro_details}}</p>
                        <a href="{{route('shop.details', $product->pro_bacode)}}" class="btn btn-info text-white">รายละเอียด</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="p-3">
    <h3 class="text-center">สินค้าแนะนำ</h3>
    <h5 class="text-center">สินค้านำเข้าใหม่ล่าสุด!!</h5>
    <div class="container py-3">
        <div class="row justify-content-center gap-3">
            @foreach ($newProduct as $product)
                <div class="card shadow" style="width: 18rem;">
                    <img src="data:image/*;base64,{{ base64_encode($product->pro_image) }}" class="card-img-top"
                        alt="Product Image">
                    <div class="card-body">
                        <p class="card-text">{{$product->pro_name}}</p>
                        <p class="card-text truncate">{{$product->pro_details}}</p>
                        <a href="{{route('shop.details', $product->pro_bacode)}}" class="btn btn-info text-white">รายละเอียด</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<style>
    .bandner {
        filter: blur(1px);
        background-image: url("https://t4.ftcdn.net/jpg/08/26/30/61/360_F_826306135_cwBErfAS9C1VfSa2n9rvxegGiluXBSLB.jpg");
        background-size: cover;
        background-position: center;
        position: absolute;
        inset: 0;
    }

    .truncate {
        white-space: wrap;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 100px;
    }

    .card-img-top {
        background-size: cover;
        background-position: center;
        inset: 0;
    }
</style>
@endsection