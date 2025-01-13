@extends('components.layouts.app')
@section('title')
    Mythico Jewelry | Cart
@endsection

@section('content')
    <!-- Cart Page -->
    <div class="container my-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Your cart</h1>
            <a href="#" class="text-decoration-none text-primary">Continue shopping</a>
        </div>

        <!-- Cart Table -->
        <div class="table-responsive">
            <table class="table align-middle cart-items">
                <caption class="visually-hidden">
                    Your cart
                </caption>
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Product</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-end">Total</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cartItems as $cart)
                    <tr data-cart-id="{{ $cart->id }}">
                        <td class="cart-item__media">
                            <a href="" class="cart-item__link">
                                <img src="{{ Storage::url($cart->jewelry->thumbnail) }}" alt="Product Image" class="img-fluid rounded" height="100" width="100">
                            </a>
                        </td>
                        <td>
                            <h5 class="fw-semibold mb-1">{{ $cart->jewelry->name }}</h5>
                            <p class="text-muted mb-0">Rp {{ number_format($cart->jewelry->price, 0, ',', '.') }}</p>
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center mt-3">
                                <button class="btn btn-outline-secondary btn-quantity remove-quantity" data-cart-id="{{ $cart->id }}" type="button">-</button>
                                <span id="quantity-{{ $cart->id }}" class="mx-2">{{ $cart->quantity }}</span>
                                <button class="btn btn-outline-secondary btn-quantity add-quantity" data-cart-id="{{ $cart->id }}" type="button">+</button>
                                <input type="hidden" id="quantity_input-{{ $cart->id }}" value="{{ $cart->quantity }}">
                                <input type="hidden" id="jewelryPrice-{{ $cart->id }}" value="{{ $cart->jewelry->price }}">
                            </div>
                        </td>
                        <td class="text-end">
                            <p id="subtotal-{{ $cart->id }}" class="mb-0 fw-bold">Rp {{ number_format($cart->total_price, 0, ',', '.') }}</p>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-link text-dark p-0 remove-item" data-cart-id="{{ $cart->id }}" title="Remove item">
                                <i class="bi bi-trash fs-5"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Your cart is empty</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Special Instructions -->
        <div class="special-instructions mt-4">
            <label for="specialInstructions" class="form-label fw-semibold">Order special instructions</label>
            <textarea class="form-control" id="specialInstructions" placeholder="Add your notes here..."></textarea>
        </div>

        <!-- Total and Checkout -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <p class="fw-bold">Estimated total:</p>
                <h5 id="grandtotal" class="fw-bold">
                    Rp {{ number_format($cartItems->sum('total_price'), 0, ',', '.') }} IDR
                </h5>
                <button class="btn btn-dark checkout-btn px-5 py-2 mt-5">Check out</button>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cartItems = document.querySelectorAll('[data-cart-id]');

                cartItems.forEach(item => {
                    const cartId = item.getAttribute('data-cart-id');
                    const addBtn = item.querySelector(`.add-quantity[data-cart-id="${cartId}"]`);
                    const removeBtn = item.querySelector(`.remove-quantity[data-cart-id="${cartId}"]`);

                    addBtn.addEventListener('click', function() {
                        let quantityElement = document.getElementById(`quantity-${cartId}`);
                        let quantityInput = document.getElementById(`quantity_input-${cartId}`);
                        let jewelryPrice = parseInt(document.getElementById(`jewelryPrice-${cartId}`).value);

                        let quantity = parseInt(quantityElement.textContent);
                        quantity++;
                        quantityInput.value = quantity;
                        quantityElement.textContent = quantity;

                        let subtotal = jewelryPrice * quantity;
                        document.getElementById(`subtotal-${cartId}`).textContent = 'Rp ' + subtotal.toLocaleString('id');
                        updateGrandTotal();
                    });

                    removeBtn.addEventListener('click', function() {
                        let quantityElement = document.getElementById(`quantity-${cartId}`);
                        let quantityInput = document.getElementById(`quantity_input-${cartId}`);
                        let jewelryPrice = parseInt(document.getElementById(`jewelryPrice-${cartId}`).value);

                        let quantity = parseInt(quantityElement.textContent);
                        if (quantity > 1) {
                            quantity--;
                            quantityInput.value = quantity;
                            quantityElement.textContent = quantity;

                            let subtotal = jewelryPrice * quantity;
                            document.getElementById(`subtotal-${cartId}`).textContent = 'Rp ' + subtotal.toLocaleString('id');
                            updateGrandTotal();
                        }
                    });
                });

                function updateGrandTotal() {
                    let grandTotal = 0;
                    cartItems.forEach(item => {
                        const cartId = item.getAttribute('data-cart-id');
                        let subtotalElement = document.getElementById(`subtotal-${cartId}`);
                        if (subtotalElement) {
                            let subtotal = parseInt(subtotalElement.textContent.replace(/[^0-9]/g, ''));
                            grandTotal += subtotal;
                        }
                    });
                    document.getElementById('grandtotal').textContent = 'Rp ' + grandTotal.toLocaleString('id');
                }
            });
        </script>
    @endpush
@endsection
