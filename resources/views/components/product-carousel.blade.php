<section id="{{ $id ?? 'product-carousel' }}" class="products-carousel">
  <div class="container-lg overflow-hidden py-5">
    <div class="row">
      <div class="col-md-12">
        <div class="section-header d-flex flex-wrap justify-content-between my-4">
          <h2 class="section-title">{{ $title }}</h2>
          <div class="d-flex align-items-center">
            <a href="{{ $link ?? '#' }}" class="btn btn-primary me-2">View All</a>
            <div class="swiper-buttons">
              <button class="swiper-prev {{ $id }}-prev btn btn-primary">❮</button>
              <button class="swiper-next {{ $id }}-next btn btn-primary">❯</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="swiper">
          <div class="swiper-wrapper">
           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>