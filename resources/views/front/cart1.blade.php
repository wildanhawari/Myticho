<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Your Shopping Cart</title>
    <style>
        .cart-item img {
            max-width: 100px;
            height: auto;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .subtotal {
            font-weight: bold;
        }

        /* Custom style for remove button */
        .btn.remove-item {
            background-color: #6c757d; /* gray */
            color: white;
            border: none; /* Remove border */
        }

        .btn.remove-item:focus {
            outline: none; /* Remove focus outline */
        }

        .btn.remove-item:hover {
            background-color: #5a6268; /* dark gray on hover */
        }

        /* Custom style for Back and Checkout buttons */
        .btn-back, .btn-checkout {
            background-color: #000000; /* black background */
            color: white; /* white text */
            border: none; /* remove border */
        }

        .btn-back:hover, .btn-checkout:hover {
            background-color: #333333; /* dark grey on hover */
            color: white;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">
          <a href="/" class="text-decoration-none text-dark">MYTHICO</a>
        </h1>
      </div>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container justify-content-center">
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" href="/BRACELET">Bracelet</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/EARRINGS">Earrings</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/NECKLACE">Necklace</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/RING">Ring</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/CART">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                   <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                 </svg>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="/LOGIN">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                   <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                 </svg>
               </a>
             </li>
           </ul>
         </div>
       </div>
     </nav>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
