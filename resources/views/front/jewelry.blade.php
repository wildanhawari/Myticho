@extends('components.layouts.app')
@section('title')
    Mythico Jewelry | Jewelry
@endsection

@section('content')
    <div class="container py-5 mt-lg-3 w-50">
        <h4 class="text-center mb-2">{{ $category->name }}</h4>
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
                @forelse ($category->jewelries as $jewelry)
                    <!-- Product Item -->
                    <div class="col-6 col-md-4">
                        <div class="text-center">
                            <a href="{{ route('front.detail', ['category' => $category->slug, 'jewelry' => $jewelry->slug]) }}">
                                <img src="{{ Storage::url($jewelry->thumbnail) }}" alt="{{ $jewelry->name }}" class="img-fluid mb-3"
                                     style="max-height: 250px; object-fit: contain;">
                                <p class="mb-1 fw-bolder">{{ $jewelry->name }}</p>
                                <p class="mb-1 text-muted">Rp {{ number_format($jewelry->price, 2, ',', '.') }}</p>
                            </a>
                            {{-- <button class="btn btn-primary add-to-cart"
                                onclick="addToCart('{{ $jewelry->name }}', {{ $jewelry->price }})">Add to Cart</button> --}}
                                {{-- <form action="{{ route('cart.add', $jewelry->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="jewelry_id" value="{{ $jewelry->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary add-to-cart">Add to cart</button>
                                </form> --}}
                        </div>
                    </div>
                @empty
                    <p class="text-center">Upsss is Empty</p>
                @endforelse
            </div>
        </div>
    </section>


    @push('after-scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    @endpush
@endsection
