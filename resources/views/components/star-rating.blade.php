@php
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
@endphp

<div class="d-flex align-items-center">
    @for ($i = 0; $i < $fullStars; $i++)
        <svg width="18" height="18" class="text-warning me-1">
            <use xlink:href="#star-full"></use>
        </svg>
    @endfor

    @if ($halfStar)
        <svg width="18" height="18" class="text-warning me-1">
            <use xlink:href="#star-half"></use>
        </svg>
    @endif

    @for ($i = 0; $i < $emptyStars; $i++)
        <svg width="18" height="18" class="me-1" fill="#e3e3e3">
            <use xlink:href="#star-empty"></use>
        </svg>
    @endfor

    @if ($reviewCount !== null)
        <span class="text-muted">({{ $reviewCount }} reviews)</span>
    @endif
</div>
