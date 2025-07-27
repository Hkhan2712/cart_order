@props([
    'value',
    'label',
    'color' => 'primary',
    'iconSvg' => '',
    'link' => '#',
    'linkColor' => 'light'
])

<div class="col-lg-3 col-6">
    <div class="small-box text-bg-{{ $color }}">
        <div class="inner">
            <h3>{!! $value !!}</h3>
            <p>{{ $label }}</p>
        </div>
        {!! $iconSvg !!}
        <a href="{{ $link }}" class="small-box-footer link-{{ $linkColor }} link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
        </a>
    </div>
</div>
