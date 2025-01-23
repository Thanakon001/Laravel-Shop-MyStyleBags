@extends('layouts.shopping')
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">ติดต่อเรา</h1>
    <form action="/submit-form" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อของคุณ</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="กรอกชื่อของคุณ" required />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required />
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">ข้อความ</label>
            <textarea id="message" name="message" class="form-control" rows="5" placeholder="กรอกข้อความของคุณ"
                required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">ส่งข้อความ</button>
    </form>
</div>
<style>
    .container {
        max-width: 800px;
    }
</style>
@endsection