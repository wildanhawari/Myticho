@extends('components.layouts.app')
@section('title')
    Mythico Jewelry | The Essence of Elegant Luxury
@endsection

@section('content')
    {{-- Carousel --}}
    <section id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 500px;">
                <img src="{{ asset('assets/background/bg1.jpg') }}" class="d-block w-100" alt="mythico">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Timeless Elegance</h5>
                    <p>Discover timeless beauty with our exclusive jewelry collection. Each design is carefully selected
                        to radiate elegance and charm, perfect for adding a touch of sparkle to every special moment.
                    </p>
                </div>
            </div>
            <div class="carousel-item" style="height: 500px;">
                <img src="{{ asset('assets/background/bg2.jpg') }}" class="d-block w-100" alt="mythico">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Luxury Redefined</h5>
                    <p>Elevate your style with our handcrafted jewelry, where luxury meets artistry. Every piece is a
                        statement of sophistication and grace</p>
                </div>
            </div>
            <div class="carousel-item" style="height: 500px;">
                <img src="{{ asset('assets/background/bg3.jpg') }}" class="d-block w-100" alt="mythico">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Brilliance in Every Detail</h5>
                    <p>Indulge in the brilliance of our stunning jewelry pieces, designed to shine with every occasion.
                        Crafted to perfection, they’re the ultimate expression of elegance.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>

    {{-- Discover --}}
    <section id="discover" class="container my-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-white">
                    <div class="position-relative">
                        <img src="{{ asset('assets/background/bg1.jpg') }}" class="card-img-top"
                            alt="Little Luxuries for Her" style="height: 250px; object-fit: cover;">
                        <!-- Gradient Effect at Bottom -->
                        <div class="position-absolute bottom-0 start-0 w-100 h-50"
                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));"></div>
                        <!-- Text Overlay -->
                        <div class="position-absolute bottom-0 start-0 w-100 text-center p-3">
                            <h5 class="m-0">Little Luxuries for Her</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-white">
                    <div class="position-relative">
                        <img src="{{ asset('assets/background/bg2.jpg') }}" class="card-img-top" alt="Gifts for Him"
                            style="height: 250px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 h-50"
                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 text-center p-3">
                            <h5 class="m-0">Gifts for Him</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card text-white">
                    <div class="position-relative">
                        <img src="{{ asset('assets/background/bg3.jpg') }}" class="card-img-top" alt="Jewelry & Timepieces"
                            style="height: 250px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 h-50"
                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));"></div>
                        <div class="position-absolute bottom-0 start-0 w-100 text-center p-3">
                            <h5 class="m-0">Jewelry & Timepieces</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('after-scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    @endpush
@endsection
