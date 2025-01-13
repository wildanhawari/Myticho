<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .btn-quantity {
            width: 30px;
            height: 30px;
            line-height: 0.5;
            padding: 0;
            font-size: 1rem;
        }
        .special-instructions textarea {
            height: 100px;
        }
        .checkout-btn {
            border-radius: 0;
        }
        .table th, .table td {
            vertical-align: middle;
        }

    </style>
</head>
<body>
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
                    <tr class="text-muted">
                        <th scope="col" colspan="2">Product</th>
                        {{-- <th scope="col" class="text-center">QUANTITY</th> --}}
                        <th scope="col" class="text-end">Total</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cart-item__media">
                            <a href="/products/adalynn-round-bangle" class="cart-item__link">
                                <img src="https://via.placeholder.com/100" alt="Product Image" class="img-fluid rounded">
                            </a>
                        </td>
                        <td>
                            <h5 class="fw-semibold mb-1">Adalynn Round Bangle</h5>
                            <p class="text-muted mb-0">Rp 4.252.000,00</p>
                            <div class="d-inline-flex align-items-center">
                                <button class="btn btn-outline-secondary btn-quantity" type="button">-</button>
                                <input type="text" class="form-control quantity-input mx-1" value="1">
                                <button class="btn btn-outline-secondary btn-quantity" type="button">+</button>
                            </div>
                        </td>
                        <td class="text-end">
                            <p class="mb-0 fw-bold">Rp 4.252.000,00</p>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-link text-dark p-0" title="Remove item">
                                <i class="bi bi-trash fs-5"></i>
                            </button>
                        </td>
                    </tr>
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
            {{-- <p class="text-muted mb-0">Taxes, discounts, and <a href="#" class="text-decoration-none">shipping</a> calculated at checkout.</p> --}}
            <div>
                <p class="fw-bold">Estimated total:</p>
                <h5 class="fw-bold">Rp 4.252.000,00 IDR</h5>
                <button class="btn btn-dark checkout-btn px-5 py-2 mt-5">Check out</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
