<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/1.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title> Mythico </title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            font-style: normal;
            font-size: 12px;
        }

        .btn-custom-grey {
            background-color: #6c757d; /* Warna abu-abu */
            color: white; /* Teks berwarna putih */
        }
        .btn-custom-grey:hover {
            background-color: #5a6268; /* Warna lebih gelap saat hover */
        }

        .brand,
        .brand:hover {
            font-family: "Philosopher", sans-serif;
            font-weight: 600;
            font-style: normal;
            color: #34393d;
        }

        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .navbar-toggler,
        .navbar-toggler:focus,
        .navbar-toggler:active,
        .btn-close:focus {
            border: none;
            outline: none;
            box-shadow: none;
        }

        .offcanvas-body {
            padding: 1.5rem;
        }

        .offcanvas .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 0;
            font-size: 1rem;
        }

        .menu-item:hover {
            opacity: 1;
        }

        .menu-item:not(:hover) {
            opacity: 0.4;
        }

        .offcanvas .menu-footer {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .offcanvas .menu-footer .btn {
            flex: 1;
            text-align: center;
        }

    </style>

</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-light bg-light sticky-top py-3">
        <div class="container-fluid">
            <button class="navbar-toggler position-absolute start-0 ps-4" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand Title -->
            <h2 class="m-0 text-center w-100">
                <a href="/" class="text-decoration-none brand">MYTHICO</a>
            </h2>

            <!-- Icons for Profile and Cart -->
        <div class="d-flex position-absolute end-0 pe-4 align-items-center">
            <!-- Profile Icon -->
            <a href="/profile" class="text-dark me-3">
                <i class="bi bi-person fs-4"></i>
            </a>

            <!-- Cart Icon -->
            <a href="/cart" class="text-dark position-relative">
                <i class="bi bi-cart fs-4"></i>
                <!-- Cart Item Count Badge -->
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3 <!-- Example count -->
                </span>
            </a>
        </div>
        </div>
    </nav>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title brand" id="offcanvasMenuLabel">Mythico</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Menu Items -->
            <a href="{{ route('jewelry') }}" class="menu-item text-decoration-none text-dark">
                <span>Bracelets</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="menu-item text-decoration-none text-dark">
                <span>Earrings</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="menu-item text-decoration-none text-dark">
                <span>Necklaces</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="menu-item text-decoration-none text-dark">
                <span>Rings</span>
                <i class="bi bi-chevron-right"></i>
            </a>

            <!-- Footer Buttons -->
            <div class="menu-footer">
                @guest
                    <button class="btn btn-dark">Login</button>
                    <button class="btn btn-outline-dark">Registration</button>
                @endguest
                @auth
                    <form action="{{ route('filament.customer.auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @endauth

            </div>
        </div>
    </div>

    <div class="container py-5 mt-lg-3 w-50">
        <h4 class="text-center mb-2">Bracelets</h4>
        <p class="text-center mb-lg-1">
            Worn on their own, as a pair or around the wrist, the bracelets designed by Victoire de Castellane are delicate, feminine collectible treasures.
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
            <div class="row g-4">
                <!-- Product Item -->
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/bracelets/gelang1.jpg') }}" alt="Haru Full White" class="img-fluid mb-3" style="max-height: 250px; object-fit: contain;">
                        <p class="mb-1 fw-bolder">Haru Full White</p>
                        <p class="mb-1 text-muted">Rp299.000,00</p>
                    </div>
                </div>
                <!-- Product Item -->
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/bracelets/gelang2.jpg') }}" alt="Haru White Navy" class="img-fluid mb-3" style="max-height: 250px; object-fit: contain;">
                        <p class="mb-1 fw-bolder">Haru White Navy</p>
                        <p class="mb-1 text-muted">Rp299.000,00</p>
                    </div>
                </div>
                <!-- Product Item -->
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/bracelets/gelang3.jpg') }}" alt="Haru White Grey" class="img-fluid mb-3" style="max-height: 250px; object-fit: contain;">
                        <p class="mb-1 fw-bolder">Haru White Grey</p>
                        <p class="mb-1 text-muted">Rp299.000,00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
