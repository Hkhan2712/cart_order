<section class="py-5">
  <div class="container-lg">
    <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
      @foreach ($benefits ?? [] as $benefit)
        <div class="col">
          <div class="card mb-3 border border-dark-subtle p-3">
            <div class="text-dark mb-3">
              <svg width="32" height="32"><use xlink:href="#{{ $benefit['icon'] }}"></use></svg>
            </div>
            <div class="card-body p-0">
              <h5>{{ $benefit['title'] }}</h5>
              <p class="card-text">{{ $benefit['description'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
