@extends('layouts.shopping')

@section('content')
<div class="container py-4">
    <div id="details" class="row">
        <!-- Product Details Section -->
        <div class="col-6 text-end">
            <img src="data:image/*;base64,{{ base64_encode($product->pro_image) }}" alt="ชื่อสินค้า"
                class="img-fluid rounded object-fit-cover">
        </div>
        <div class="col-6">
            <h3 class="display-5">ชื่อสินค้า : {{ $product->pro_name }}</h3>
            <p class="text-muted">รหัสสินค้า: {{ $product->pro_bacode }}</p>
            <p class="lead">รายละเอียดสินค้าอย่างละเอียด {{ $product->pro_details }}</p>
            <h3 class="text-primary">฿{{ number_format($product->pro_price, 2) }}</h3>
            <p class="{{ $product->pro_stock > 0 ? 'text-success' : 'text-danger' }}">
                {{ $product->pro_stock > 0 ? 'มีสินค้าในสต็อก' : 'หมดสต็อก' }}
            </p>

            <!-- Add to Cart & Back buttons -->
            <div class="d-flex gap-2">
                <form action="{{route('shop.cart.add', $product->pro_bacode)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">จำนวน</label>
                        <input type="number" id="quantity" class="form-control" value="1" min="1" name="list_quentity"
                            id="quantity">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg text-white">
                        <i class="bi bi-cart"></i> เพิ่มลงตะกร้า
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Review Section -->
    <div class="container py-5">
        <h3 class="mb-4">แสดงความคิดเห็นและให้คะแนนสินค้า</h3>

        <!-- Review Form -->
        <form action="{{route('shop.rating.store')}}" method="POST">
            @csrf
            <input type="hidden" name="pro_bacode" value="{{ $product->pro_bacode }}" />
            <div class="mb-4">
                <h4>ให้คะแนนสินค้า</h4>
                <div class="rating">
                    @for ($star = 1; $star <= 5; $star++)
                        <label title="{{ $star }}" for="rating{{ $star }}">
                            <i class="fas fa-star fs-4 {{ old('rating') >= $star ? 'text-warning' : '' }}"></i>
                            <input type="radio" name="rating_point" id="rating{{ $star }}" value="{{ $star }}"
                                class="d-none" {{ old('rating') == $star ? 'checked' : '' }} />
                        </label>
                    @endfor
                </div>
            </div>

            <div class="mb-4">
                <h5>แสดงความคิดเห็น</h5>
                <textarea name="comment" class="form-control" rows="5"
                    placeholder="เขียนความคิดเห็นของคุณที่นี่...">{{ old('comment') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary text-white">ส่งความคิดเห็น</button>
        </form>

        <!-- Displaying Reviews -->
        <div class="mt-5">
            <h4>ความคิดเห็นล่าสุด</h4>
            <div id="comments-section" class="border rounded p-3">
                @forelse ($ratings as $review)
                    <div class="border-bottom mb-3">
                        @for ($star = 1; $star <= 5; $star++)
                            <label title="{{ $star }}" for="rating{{ $star }}">
                                <i class="fas fa-star fs-6 {{ $review->rating_point >= $star ? 'text-warning' : '' }}"></i>
                            </label>
                        @endfor
                        <p>
                            <img src="data:image/png;base64,{{ base64_encode($review->user->profile_image) }}" alt=""
                                width="25px" height="25px" class="rounded-circle">
                            {{$review->user->name}} : {{ $review->comment }}
                        </p>
                        <p>แสดงความคิดเห็นเมื่อ : {{$review->created_at}}</p>
                    </div>
                @empty
                    <p class="text-muted">ยังไม่มีความคิดเห็น</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.rating input[type="radio"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            const rating = this.value;
            document.querySelectorAll('.rating i').forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                }
            });
        });
    });
</script>
@endsection