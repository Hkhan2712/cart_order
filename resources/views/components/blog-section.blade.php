@props([
    'posts' => [],
    'title' => 'Our Recent Blog',
    'viewAllRoute' => '#',
])

<section id="latest-blog" class="pb-4">
    <div class="container-lg">
        <div class="row">
            <div class="section-header d-flex align-items-center justify-content-between my-4">
                <h2 class="section-title">{{ $title }}</h2>
                <a href="{{ $viewAllRoute }}" class="btn btn-primary">View All</a>
            </div>
        </div>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <x-blog-card :post="$post" />
                </div>
            @endforeach
        </div>
    </div>
</section>
