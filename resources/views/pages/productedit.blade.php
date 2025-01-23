@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h2>แก้ไขข้อมูลสินค้า</h2>
    <form method="POST" id="updateProduct" action="{{route('product.update', $product->pro_bacode)}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="form-group mt-3">
                    <label for="pro_name">ชื่อสินค้า</label>
                    <input type="text" class="form-control @error('pro_name') is-invalid @enderror" id="pro_name"
                        name="pro_name" value="{{ old('pro_name', $product->pro_name) }}">
                    @error('pro_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="band_id">หมวดหมู่สินค้า</label>
                    <select name="band_id" id="band_id" class="form-control">
                        @foreach ($bands as $band)
                            @if ($product->band_id == $band->band_id)
                                <option value="{{$band->band_id}}" selected>{{$band->band_name}}</option>
                            @else
                                <option value="{{$band->band_id}}">{{$band->band_name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('band_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_details">รายละเอียดสินค้า</label>
                    <textarea class="form-control @error('pro_details') is-invalid @enderror" id="pro_details"
                        name="pro_details" rows="4">{{ old('pro_details', $product->pro_details) }}</textarea>
                    @error('pro_details')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_price">ราคา (บาท)</label>
                    <input type="text" class="form-control @error('pro_price') is-invalid @enderror" id="pro_price"
                        name="pro_price" value="{{ old('pro_price', $product->pro_price) }}">
                    @error('pro_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_stock">จำนวนในสต็อก</label>
                    <input type="number" class="form-control @error('pro_stock') is-invalid @enderror" id="pro_stock"
                        name="pro_stock" value="{{ old('pro_stock', $product->pro_stock) }}">
                    @error('pro_stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- คอลัมน์ขวา: ฟอร์มอัปโหลดรูปภาพ -->
            <div class="col-md-4 mt-3">
                <div class="form-group">
                    @if ($product->pro_image)
                        <div class="mt-3">
                            <img src="data:image/*;base64,{{ base64_encode($product->pro_image) }}" alt="Product Image"
                                class=" object-fit-cover rounded" width="250px" height="250px">
                        </div>
                    @endif
                    <br>
                    <label for="pro_image">รูปภาพสินค้า</label>
                    <input type="file" class="form-control @error('pro_image') is-invalid @enderror" id="pro_image"
                        name="pro_image" value="{{ old('pro_stock', $product->pro_image) }}">
                    @error('pro_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-between col-8">
            <div class="">
                <div onclick="comfirmUpdateProduct()" class="btn btn-primary text-white">อัพเดตสินค้า</div>
                <a href="{{route('product')}}" class="btn btn-warning text-white">ยกเลิก</a>
            </div>
            <a class="btn btn-danger text-white"
                onclick="comfirmDeleteProduct('{{route('product.delete', $product->pro_bacode)}}')">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#ffffff">
                    <path
                        d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                </svg>
                ลบรายการนี้
            </a>
        </div>
    </form>
</div>
@endsection
@push('script')
    <script>
        const comfirmDeleteProduct = (url) => {
            Swal.fire({
                title: "ยืนยันการลบ",
                text: "คุณต้องการลบรายการนี้หรือไม่?",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    window.location.href = url
                }
            });
        }

        const comfirmUpdateProduct = () => {
            Swal.fire({
                title: "ยืนยันการบันทึก?",
                text: "คุณต้องการบันทึกรายการนี้หรือไม่",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    document.getElementById('updateProduct').submit()
                }
            });
        }
    </script>
@endpush