@extends('layouts.app')

@section('content')
<div class="card shadow-lg animate__animated animate__backInDown">
    <div class="card-body fs-4 d-flex justify-content-center align-items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
            <path
                d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z" />
        </svg>
        <span>{{ __('สมัครสมาชิก') }}</span>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}"
            class="py-4 d-flex flex-column justify-content-center align-items-center">
            @csrf

            <div class="row col-8">
                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">อีเมล</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary text-white col-7">สมัคร</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection