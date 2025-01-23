@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h2>เพิ่มข้อมูลประเภทสินค้า</h2>
    <form method="POST" id="createBand" action="{{ route('band.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="band_name">ชื่อหมวดหมู่</label>
                    <input type="text" class="form-control @error('band_name') is-invalid @enderror" id="band_name"
                        name="band_name" value="{{ old('band_name') }}">
                    @error('band_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-between col-3">
            <div class="">
                <div onclick="comfirmCreateBand()" class="btn btn-primary text-white">บันทึกหมวดหมู่</div>
                <a href="{{ route('band') }}" class="btn btn-warning text-white">ยกเลิก</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    const comfirmCreateBand = () => {
        Swal.fire({
            title: "ยืนยันการบันทึก?",
            text: "คุณต้องการบันทึกรายการนี้หรือไม่",
            icon: "question",
            confirmButtonText: 'ตกลง',
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก'
        }).then(comfirm => {
            if (comfirm.isConfirmed) {
                document.getElementById('createBand').submit()
            }
        });
    }
</script>
@endpush
