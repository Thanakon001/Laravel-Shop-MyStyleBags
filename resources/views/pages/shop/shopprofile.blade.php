@extends('layouts.shopping')

@section('content')
<div class="container mt-5">
    <h2>แก้ไขโปรไฟล์</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{route('profile.user.update')}}" method="POST" id="fromupdate" enctype="multipart/form-data"
        class="row">
        @csrf
        <div class="col-md-6">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
        </div>

        <!-- สำหรับแสดงภาพโปรไฟล์อยู่ด้านขวา -->
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="row">
                <img src="data:image/png;base64,{{ base64_encode($user->profile_image) }}" alt="Profile Image"
                    class=" object-fit-cover rounded-1 shadow-sm p-2" style="max-width: 250px;" width="250"
                    height="250">
                <!-- Profile Image -->
                <div class="mt-3">
                    <label for="profile_image" class="form-label">ภาพโปรไฟล์</label>
                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror"
                        id="profile_image" name="profile_image">
                    @error('profile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12">
            <div onclick="comfirmUpdate()" class="btn btn-primary mt-3 text-white">บันทึกการเปลี่ยนแปลง</div>
            <a href="{{route('home')}}" class="btn btn-warning mt-3 text-white">ยกเลิก</a>
        </div>
    </form>
</div>
@endsection
@push('script')
    <script>
        const comfirmUpdate = () => {
            Swal.fire({
                title: "ยืนยันการบันทึก?",
                text: "คุณต้องการบันทึกรายการนี้หรือไม่",
                icon: "question",
                confirmButtonText: 'ตกลง',
                showCancelButton: true,
                cancelButtonText: 'ยกเลิก'
            }).then(comfirm => {
                if (comfirm.isConfirmed) {
                    document.getElementById('fromupdate').submit()
                }
            });
        }
    </script>
@endpush