@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h2>เพิ่มข้อมูลสินค้า</h2>
    <form method="POST" id="createProduct" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="form-group mt-3">
                    <label for="pro_bacode">รหัสสินค้า</label>
                    <input type="text" class="form-control @error('pro_bacode') is-invalid @enderror" id="pro_bacode"
                        name="pro_bacode" value="{{ old('pro_bacode') }}">
                    @error('pro_bacode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_name">ชื่อสินค้า</label>
                    <input type="text" class="form-control @error('pro_name') is-invalid @enderror" id="pro_name"
                        name="pro_name" value="{{ old('pro_name') }}">
                    @error('pro_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="band_id">หมวดหมู่สินค้า</label>
                    <select name="band_id" id="band_id" class="form-control">
                        @foreach ($bands as $band)
                            <option value="{{ $band->band_id }}">{{ $band->band_name }}</option>
                        @endforeach
                    </select>
                    @error('band_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_details">รายละเอียดสินค้า</label>
                    <textarea class="form-control @error('pro_details') is-invalid @enderror" id="pro_details"
                        name="pro_details" rows="4">{{ old('pro_details') }}</textarea>
                    @error('pro_details')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_price">ราคา (บาท)</label>
                    <input type="text" class="form-control @error('pro_price') is-invalid @enderror" id="pro_price"
                        name="pro_price" value="{{ old('pro_price') }}">
                    @error('pro_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="pro_stock">จำนวนในสต็อก</label>
                    <input type="number" class="form-control @error('pro_stock') is-invalid @enderror" id="pro_stock"
                        name="pro_stock" value="{{ old('pro_stock') }}">
                    @error('pro_stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="pro_image">รูปภาพสินค้า</label>
                <input type="file" class="form-control @error('pro_image') is-invalid @enderror" id="pro_image"
                    name="pro_image">
                @error('pro_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <br>
        <div class="d-flex justify-content-between col-8">
            <div class="">
                <button type="button" class="btn btn-primary text-white" onclick="comfirmCreateProduct()">บันทึกสินค้า</button>
                <a href="{{ route('product') }}" class="btn btn-warning text-white">ยกเลิก</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    const comfirmCreateProduct = () => {
        Swal.fire({
            title: "ยืนยันการบันทึก?",
            text: "คุณต้องการบันทึกรายการนี้หรือไม่",
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

    const comfirmDeleteProduct = (url) => {
        Swal.fire({
            title: "ยืนยันการลบ",
            text: "คุณต้องการลบรายการนี้หรือไม่?",
            icon: "warning",
            confirmButtonText: 'ตกลง',
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก'
        }).then(comfirm => {
            if (comfirm.isConfirmed) {
                window.location.href = url
            }
        });
    }
</script>
@endpush
