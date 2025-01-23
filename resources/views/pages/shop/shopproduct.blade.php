@extends('layouts.shopping')
@section('content')
<div class="container py-3">
    <div class="row text-center justify-content-center py-3">
        <h3>รายการสินค้า</h3>
        <h5>สามารถดูรายละเอียด แล้วเพิ่มลงตะกร้าได้เลย</h5>
        <form method="post" action="{{route('shop.product.search')}}" class="input-group w-75 my-3">
            @csrf
            <input type="text" name="textkeyword" class="form-control" placeholder="ค้นหาชื่อสินค้า" aria-label="ค้นหาชื่อสินค้า"
                aria-describedby="button-addon2">
            <button class="btn btn-primary text-white" type="submit" id="button-addon2">ค้นหา</button>
        </form>
    </div>

    <div class="row justify-content-center gap-3">
        @foreach ($products as $product)
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
    <br>
    <div class="row mt-4">
        <div class="pagination justify-content-center fs-5">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<style>
    .truncate {
        overflow: hidden;
        white-space: wrap;
        text-overflow: ellipsis;
        height: 100px;
    }
</style>
@endsection