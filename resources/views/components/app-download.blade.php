<section class="pb-4 my-4">
<div class="container-lg">
    <div class="bg-warning pt-5 rounded-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
        <div class="col-md-4">
            <h2 class="mt-5">{{ $title ?? 'Download Organic App' }}</h2>
            <p>{{ $subtitle ?? 'Online Orders made easy, fast and reliable' }}</p>
            <div class="d-flex gap-2 flex-wrap mb-5">
            <a href="{{ $appStoreUrl ?? '#' }}" title="App store">
                <img src="{{ asset('images/online-apps/img-app-store.png') }}" alt="app-store">
            </a>
            <a href="{{ $googlePlayUrl ?? '#' }}" title="Google Play">
                <img src="{{ asset('images/online-apps/img-google-play.png') }}" alt="google-play">
            </a>
            </div>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('images/online-apps/banner-onlineapp.png') }}" alt="phone" class="img-fluid">
        </div>
        </div>
    </div>
    </div>
</div>
</section>
