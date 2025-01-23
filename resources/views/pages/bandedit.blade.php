@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h2>แก้ไขข้อมูลประเภทสินค้า</h2>
    <form method="POST" id="updateBand" action="{{route('band.update', $band->band_id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group mt-3">
                    <label for="band_id">รหัสหมวดหมู่</label>
                    <input type="text" class="form-control @error('band_id') is-invalid @enderror" id="band_id"
                        name="band_id" value="{{ old('band_id', $band->band_id) }}" disabled>
                    @error('band_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="band_name">ชื่อหมวดหมู่</label>
                    <input type="text" class="form-control @error('band_name') is-invalid @enderror" id="band_name"
                        name="band_name" value="{{ old('band_name', $band->band_name) }}">
                    @error('band_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-between col-3">
            <div class="">
                <div onclick="comfirmUpdateBand()" class="btn btn-primary text-white">อัพเดตสินค้า</div>
                <a href="{{route('band')}}" class="btn btn-warning text-white">ยกเลิก</a>
            </div>
            <a class="btn btn-danger text-white" onclick="comfirmDeleteBand('{{route('band.delete', $band->band_id)}}')">
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
        const comfirmDeleteBand = (url) => {
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

        const comfirmUpdateBand = () => {
            Swal.fire({
                title: "ยืนยันการบันทึก?",
                text: "คุณต้องการบันทึกรายการนี้หรือไม่",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    document.getElementById('updateBand').submit()
                }
            });
        }
    </script>
@endpush