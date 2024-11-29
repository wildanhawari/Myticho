@extends('components.layouts.app')
@section('title')
    Mythico Jewelry | Jewelry
@endsection

@section('content')
    <div class="container py-5 mt-lg-3 w-50">
        <h4 class="text-center mb-2">Bracelets</h4>
        <p class="text-center mb-lg-1">
            Worn on their own, as a pair or around the wrist, the bracelets designed by Victoire de Castellane are delicate,
            feminine collectible treasures.
        </p>
    </div>

    {{-- Product --}}
    <section class="py-lg-5 py-0">
        <div class="container">
            {{-- <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5">Products</h2>
            <select class="form-select w-auto">
                <option selected>Sort by latest</option>
                <option value="1">Price: Low to High</option>
                <option value="2">Price: High to Low</option>
            </select>
        </div> --}}
            <div class="row g-3 g-md-4">
                <!-- Product 5 -->
                <div class="col">
                    <div class="card">
                        <img src="../assets/bracelet/gelang5.jpg" class="card-img-top" alt="Gold Earrings">
                        <div class="card-body">
                            <h5 class="card-title">Lock n Love Bracelet</h5>
                            <p class="card-text">Rp 700.000,00 IDR</p>
                            <button class="btn btn-custom-grey add-to-cart"
                                onclick="addToCart('Lock n Love Bracelet', 700000)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                @forelse ($jewelries as $jewelry)
                    <!-- Product Item -->
                    <div class="col-6 col-md-4">
                        <div class="text-center">
                            <img src="{{ Storage::url($jewelry->thumbnail) }}" alt="Haru White Navy" class="img-fluid mb-3"
                                style="max-height: 250px; object-fit: contain;">
                            <p class="mb-1 fw-bolder">{{ $jewelry->name }}</p>
                            <p class="mb-1 text-muted">Rp {{ number_format($jewelry->price, 2, ',', '.') }}</p>
                            <button class="btn btn-custom-grey add-to-cart"
                                onclick="addToCart('{{ $jewelry->name }}', {{ $jewelry->price }})">Add to Cart</button>
                        </div>
                    </div>
                @empty
                    <p>Upsss is Empty</p>
                @endforelse
            </div>
        </div>
    </section>


    @push('after-scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script>
            // Function to add product to cart
            function addToCart(productName, price) {
                // Get existing cart from sessionStorage or initialize an empty array
                let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

                // Check if product already exists in cart
                let productIndex = cart.findIndex(item => item.name === productName);
                if (productIndex >= 0) {
                    // If the product already exists, increase quantity
                    cart[productIndex].quantity += 1;
                } else {
                    // If the product is not in the cart, add it
                    cart.push({
                        name: productName,
                        price: price,
                        quantity: 1
                    });
                }

                // Save updated cart back to sessionStorage
                sessionStorage.setItem('cart', JSON.stringify(cart));

            }
    @endpush
@endsection
