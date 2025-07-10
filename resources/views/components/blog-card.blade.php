@props(['post'])

<article class="post-item card border-0 shadow-sm p-3">
    <div class="image-holder zoom-effect">
        <a href="{{ $post->url ?? '#' }}">
            <img src="{{ asset($post->thumbnail ?? 'images/default-thumbnail.jpg') }}" alt="post" class="card-img-top">
        </a>
    </div>
    <div class="card-body">
        <div class="post-meta d-flex text-uppercase gap-3 my-2 align-items-center">
            <div class="meta-date">
                <svg width="16" height="16"><use xlink:href="#calendar"></use></svg>
                {{ \Carbon\Carbon::parse($post->date ?? now())->format('d M Y') }}
            </div>
            <div class="meta-categories">
                <svg width="16" height="16"><use xlink:href="#category"></use></svg>
                {{ $post->category ?? 'Uncategorized' }}
            </div>
        </div>
        <div class="post-header">
            <h3 class="post-title">
                <a href="{{ $post->url ?? '#' }}" class="text-decoration-none">{{ $post->title }}</a>
            </h3>
            <p>{{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120) }}</p>
        </div>
    </div>
</article>
