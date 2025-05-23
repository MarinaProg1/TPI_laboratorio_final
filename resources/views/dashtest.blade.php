@extends('layouts.app')

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/ropas.jpg') }}" class="d-block w-100 carousel-image" alt="Imagen 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carousel-title">20% de descuento</h5>
                    <p class="carousel-text">Descuentos exclusivos por tiempo limitado. ¡Aprovecha ahora!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/accesorios.jpg') }}" class="d-block w-100 carousel-image" alt="Imagen 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carousel-title">Todo lo mejor!!!</h5>
                    <p class="carousel-text">Tendencias, calidad y precios increíbles te esperan aquí.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/tecnologias.jpg') }}" class="d-block w-100 carousel-image" alt="Imagen 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="carousel-title">Todo lo que necesitas</h5>
                    <p class="carousel-text">Porque mereces lo mejor. Encuentra lo que amas.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
