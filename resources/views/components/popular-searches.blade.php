<section class="py-4">
  <div class="container-lg">
    <h2 class="my-4">{{ $title ?? 'People are also looking for' }}</h2>
    
    @foreach ($searches ?? [] as $keyword)
      <a href="#" class="btn btn-warning me-2 mb-2">{{ $keyword }}</a>
    @endforeach

  </div>
</section>
