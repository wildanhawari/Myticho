<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jewelry Detail Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styling for Size Options */
        .size-option {
            cursor: pointer;
            text-align: center;
            font-weight: bold;
            transition: all 0.3s ease;
            border: 2px solid #ced4da;
            color: #495057;
        }

        .size-option.active {
            border-color: #000;
            background-color: #000;
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .size-option.active:hover {
            color: white;
        }

        .size-option:hover {
            border-color: #000;
            color: #000;
        }

        .border-blue {
            border: 2px solid #007bff !important;
        }

        .opacity-50 {
            opacity: 0.5;
        }
    </style>
</head>

<body>
    @forelse ($jewelry as $jewelry)
        <div class="container my-5">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="card border-0">
                        <img src="{{ Storage::url($jewelry->thumbnail) }}" id="main-image" alt="Main Product"
                            class="img-fluid">

                        <!-- Thumbnail Images -->
                        <div class="mt-2 d-flex">
                            <img src="{{ Storage::url($jewelry->thumbnail) }}"
                                data-src="{{ Storage::url($jewelry->thumbnail) }}"
                                class="thumbnail p-1 rounded me-2 active" alt="Thumbnail" width="120" height="120">
                            @forelse ($jewelry->jewelryPhotos as $photo)
                                <img src="{{ Storage::url($photo->photo) }}"
                                    data-src="{{ Storage::url($photo->photo) }}" class="thumbnail p-1 rounded me-2"
                                    alt="Thumbnail" width="120" height="120">
                                {{-- <img src="https://via.placeholder.com/100/00ff00" data-src="https://via.placeholder.com/500/00ff00" class="thumbnail p-1 rounded opacity-50 me-2" alt="Thumbnail 2">
                    <img src="https://via.placeholder.com/100/0000ff" data-src="https://via.placeholder.com/500/0000ff" class="thumbnail p-1 rounded opacity-50" alt="Thumbnail 3"> --}}
                            @empty
                            @endforelse


                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <h1 class="fw-bold">{{ $jewelry->name }}</h1>
                    <p class="text-muted">Rp {{ number_format($jewelry->price, 2, ',', '.') }} IDR</p>
                    <p class="text-secondary"><small>Shipping calculated at checkout.</small></p>

                    <form method="POST" action="{{ route('cart.add', $jewelry->id) }}">
                        @csrf <!-- Token CSRF untuk keamanan -->
                        <input type="hidden" name="jewelry_id" value="{{ $jewelry->id }}">
                        <!-- Quantity Selector -->
                        <div class="d-flex align-items-center mb-3">
                            <label for="quantity" class="me-2">Quantity:</label>
                            <div class="input-group" style="width: 120px;">
                                <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                                <input type="number" class="form-control text-center" name="quantity" id="quantity"
                                    value="1" min="1" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="increment">+</button>
                            </div>
                        </div>

                        <!-- Size Selector -->
                        <h5 class="fw-semibold">Choose Size</h5>
                        <div class="d-flex gap-2 mt-2">
                            @forelse ($jewelry->jewelrySizes as $size)
                            <div class="form-check">
                                <input class="form-check-input size-option" type="radio" name="size" id="{{ $size->size }}"
                                    value="{{ $size->size }}" required>
                                <label class="form-check-label px-3 py-2 rounded border" for="{{ $size->size }}">
                                    {{ $size->size.' cm'}}
                                </label>
                            </div>
                            @empty
                            <p>no size</p>
                            @endforelse
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 mt-4 mb-3">
                            @if ($jewelry->is_sold)
                            <a class="btn btn-dark py-2">Jewelry Is Sold</a>
                            @else
                                <!-- Button Buy Now -->
                            <button class="btn btn-dark" type="submit" formaction="{{ route('checkout.add') }}">Buy
                                Now</button>

                            <!-- Button Add to Cart -->
                            <button class="btn btn-outline-dark" type="submit" formaction="{{ route('cart.add', $jewelry->id) }}">Add
                                to
                                Cart</button>
                            @endif
                        </div>

                    </form>


                    <!-- Product Details -->
                    <ul class="list-unstyled mt-4">
                        <li><strong>Color:</strong> Rose Gold</li>
                        <li><strong>Purity:</strong> 16K (70%)</li>
                        <li><strong>Length:</strong> 15.5 - 16.5 Centimeter</li>
                    </ul>
                </div>
            </div>
        </div>
    @empty

    @endforelse

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Quantity Increment/Decrement Logic
        document.getElementById('increment').addEventListener('click', () => {
            const qty = document.getElementById('quantity');
            qty.value = parseInt(qty.value) + 1;
        });

        document.getElementById('decrement').addEventListener('click', () => {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        });

        // Jalankan setelah halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', () => {
            // Klik otomatis thumbnail pertama
            const firstThumbnail = document.querySelector('.thumbnail');
            if (firstThumbnail) {
                firstThumbnail.click();
            }
        });

        // Thumbnail Click Logic
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Change main image
                const mainImage = document.getElementById('main-image');
                mainImage.src = this.dataset.src;

                // Update styles for active thumbnail
                document.querySelectorAll('.thumbnail').forEach(tn => {
                    tn.classList.remove('border-blue', 'opacity-100');
                    tn.classList.add('opacity-50');
                });
                this.classList.remove('opacity-50');
                this.classList.add('border-blue');
            });
        });

        // Size Selection Logic
        document.querySelectorAll('.size-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.size-option').forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                console.log(`Selected Size: ${this.dataset.size}`);
            });
        });
    </script>
</body>

</html>
