	<section id="{{ $id ?? 'products-carousel' }}" class="products-carousel">
	<div class="container-lg overflow-hidden py-5">
		<div class="row">
		<div class="col-md-12">
			<div class="section-header d-flex flex-wrap justify-content-between my-4">
			<h2 class="section-title">{{ $title }}</h2>
			<div class="d-flex align-items-center">
				<a href="{{ $link ?? '#' }}" class="btn btn-primary me-2">View All</a>
				<div class="swiper-buttons">
					<button class="swiper-prev products-carousel-prev {{ $id }}-prev btn btn-primary">❮</button>
					<button class="swiper-next products-carousel-next {{ $id }}-next btn btn-primary">❯</button>
				</div>
			</div>
			</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-12">
			<div class="swiper">
			<div class="swiper-wrapper">
				@foreach ($products as $product)
				@include('components.product-card', ['product' => $product])
				@endforeach
			</div>
			</div>
		</div>
		</div>
	</div>
	</section>