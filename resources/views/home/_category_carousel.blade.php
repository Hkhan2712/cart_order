<section class="py-5 overflow-hidden">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Category</h2>
                    <div class="d-flex align-items-center">
                        <a href="{{ $link ?? '#' }}" class="btn btn-primary me-2">View All</a>
                        <div class="swiper-buttons">
                            <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                            <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="category-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" class="nav-link swiper-slide text-center">
                                <img src="{{ $category->thumbnail_url }}" class="rounded-circle" style="max-width: 160px; max-height: 160px" alt="{{ $category->name }}">
                                <h4 class="fs-6 mt-3 fw-normal category-title">{{ $category->name }}</h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
