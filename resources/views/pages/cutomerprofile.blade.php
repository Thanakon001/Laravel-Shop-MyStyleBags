@extends('layouts.home')

@section('content')
<div class="container">
    <h2>จัดการข้อมูลผู้ใช้งาน</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{route('cutomer.profile.ban',$user->email)}}" id="createProduct" method="POST" enctype="multipart/form-data" class="row">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}" readonly>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email', $user->email) }}" readonly>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">บทบาท</label>
                <select class="form-select" id="role" name="role">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>ผู้ใช้งาน</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ผู้ดูแลระบบ</option>
                    <option value="ban" {{ $user->role == 'ban' ? 'selected' : '' }}>ระงับการใช้งาน</option>
                </select>
            </div>
        </div>

        <!-- สำหรับแสดงภาพโปรไฟล์อยู่ด้านขวา -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="row">
                <img src="https://png.pngtree.com/png-clipart/20190520/original/pngtree-vector-users-icon-png-image_4144740.jpg"
                    alt="Profile Image" class="img-fluid object-fit-cover rounded-1 shadow-sm p-2"
                    style="max-width: 250px;">
            </div>
        </div>

        <div class="col-12">
            <div onclick="comfirmCreateProduct()" class="btn btn-primary mt-3 text-white">บันทึกการเปลี่ยนแปลง</div>
            <a href="{{route('cutomer')}}" class="btn btn-warning mt-3 text-white">ยกเลิก</a>
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
</script>
@endpush