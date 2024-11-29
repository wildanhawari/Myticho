@extends('components.layouts.app')
@section('title')
    Mythico Jewelry | Cart
@endsection

@section('content')
    <!-- Cart Page -->
    <div class="container py-5">
        <h1 class="text-center mb-4">Your Shopping Cart</h1>
        <div class="row">
            <div class="col-12">
                <!-- Cart Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Cart items will be inserted here dynamically -->
                    </tbody>
                </table>

                <!-- Cart Summary -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="/" class="btn btn-back">Back</a>
                    </div>
                    <div class="col-md-6 text-end">
                        <h3>Total: Rp <span id="total-price">0</span></h3>
                        <a href="/checkout" class="btn btn-checkout">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

<script>
    // Function to load cart from sessionStorage and display it
    function loadCart() {
        let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
        let cartItemsContainer = document.getElementById('cart-items');
        let total = 0;

        cartItemsContainer.innerHTML = ''; // Clear the cart table

        cart.forEach(item => {
            // Calculate subtotal
            let subtotal = item.price * item.quantity;
            total += subtotal;

            // Add product row to the cart table
            cartItemsContainer.innerHTML += `
                <tr>
                    <td class="cart-item">
                        <img src="${item.imageURL}" alt="${item.name}" class="img-fluid">
                        <p>${item.name}</p>
                    </td>
                    <td>Rp ${item.price.toLocaleString()}</td>
                    <td>
                        <input type="number" class="form-control quantity" value="${item.quantity}" min="1" data-product="${item.name}">
                    </td>
                    <td class="subtotal">Rp ${subtotal.toLocaleString()}</td>
                    <td>
                        <button class="btn remove-item btn-sm" data-product="${item.name}">Remove</button>
                    </td>
                </tr>
            `;
        });

        // Update total price
        document.getElementById('total-price').textContent = total.toLocaleString();
    }

    // Event listener for quantity change
    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('quantity')) {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            let productName = event.target.getAttribute('data-product');
            let quantity = event.target.value;

            // Update product quantity in cart
            let product = cart.find(item => item.name === productName);
            if (product) {
                product.quantity = parseInt(quantity);
                sessionStorage.setItem('cart', JSON.stringify(cart));
                loadCart(); // Reload cart
            }
        }
    });

    // Event listener for removing item
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-item')) {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            let productName = event.target.getAttribute('data-product');

            // Remove product from cart
            cart = cart.filter(item => item.name !== productName);
            sessionStorage.setItem('cart', JSON.stringify(cart));
            loadCart(); // Reload cart
        }
    });

    // Load cart on page load
    loadCart();

    
</script>


    @endpush
@endsection
