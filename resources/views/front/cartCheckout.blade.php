@extends('components.layouts.app')

@section('title', 'Mythico Jewelry | Checkout')

@section('content')
<!-- Checkout Page -->
<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>

    <form action="{{ route('front.cart.checkoutProcess') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Hidden fields for cart data -->
        <input type="hidden" name="quantity" value="{{ $cartItems->sum('quantity') }}"> <!-- total quantity -->

        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Shipping Address -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Alamat Pengiriman</h5>
                        <p class="mb-1"><strong>Rumah · {{ Auth::user()->name }}</strong></p>
                        <p class="text-muted">Jl. Beji No.99, Universitas Gunadarma, Depok, Jawa Barat</p>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Mythico Jewelry</h5>
                        @foreach ($cartItems as $item)
                        <div class="d-flex align-items-start mb-3">
                            <img src="{{ Storage::url($item->jewelry->thumbnail) }}" alt="Product Image"
                                class="img-fluid rounded me-3" width="80" height="80">
                            <div>
                                <p class="mb-1">{{ $item->jewelry->name }}</p>
                                <p class="text-muted mb-0">{{ $item->quantity }} x
                                    Rp{{ number_format($item->jewelry->price, 0, ',', '.') }}</p>
                                @if ($item->size != 0)
                                    <p class="text-muted">Size: {{ $item->size }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <textarea name="note" class="form-control" rows="2" placeholder="Kasih catatan (opsional)"></textarea>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-lg-4">
                <!-- Payment Method -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Metode Pembayaran</h5>
                        @forelse ($banks as $bank)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="bank_id" id="bank_{{ $bank->id }}" value="{{ $bank->id }}" {{ $loop->first ? 'checked' : '' }}>
                                <label class="form-check-label" for="bank_{{ $bank->id }}">
                                    {{ $bank->bank_name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted">Tidak ada metode pembayaran yang tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Transaction Summary -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Cek Ringkasan Transaksimu, Yuk</h5>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Harga ({{ $cartItems->sum('quantity') }} Jewelry)</span>
                                <span>Rp{{ number_format($cartItems->sum(function ($item) { return $item->jewelry->price * $item->quantity; }), 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total Tagihan</strong>
                            <strong>Rp{{ number_format($cartItems->sum(function ($item) { return $item->jewelry->price * $item->quantity; }), 0, ',', '.') }}</strong>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 py-3">Bayar Sekarang</button>
                        <p class="text-muted small text-center mt-2">Dengan melanjutkan pembayaran, kamu menyetujui S&K</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endpush

@endsection
