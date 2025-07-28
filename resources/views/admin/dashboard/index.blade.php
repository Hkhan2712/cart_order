@extends('admin.layouts.master')

@section('title', 'AquaTerra - Dashboard')

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <!--begin::Small Boxes-->
            <div class="row">
                @include('admin.components.small-box', [
                    'value' => count($latestOrders),
                    'label' => 'New Orders',
                    'color' => 'primary',
                    'iconSvg' => view('admin.components.icons.orders'),
                    'link' => route('admin.orders.index'),
                    'linkColor' => 'light',
                ])

                @include('admin.components.small-box', [
                    'value' => number_format($revenue) . '&#8363',
                    'label' => 'Total Revenue',
                    'color' => 'success',
                    'iconSvg' => view('admin.components.icons.revenue'),
                    'link' => '#',
                    'linkColor' => 'light',
                ])

                @include('admin.components.small-box', [
                    'value' => $newUsers,
                    'label' => 'User Registrations',
                    'color' => 'warning',
                    'iconSvg' => view('admin.components.icons.users'),
                    'link' => route('admin.users.index'),
                    'linkColor' => 'dark',
                ])

                @include('admin.components.small-box', [
                    'value' => $smallBox['inventory'],
                    'label' => 'Inventory Warning',
                    'color' => 'danger',
                    'iconSvg' => view('admin.components.icons.inventory'),
                    'link' => '#',
                    'linkColor' => 'light',
                ])
            </div>
            <!--end::Small Boxes-->

            <!--begin::Monthly Recap Report-->
            @include('admin.components.monthly-recap', [
                'goals' => [
                    ['label' => 'Add to cart', 'current' => 160, 'total' => 200, 'color' => 'primary'],
                    ['label' => 'Complete purchase', 'current' => 310, 'total' => 400, 'color' => 'danger'],
                    ['label' => 'Visit premium', 'current' => 480, 'total' => 800, 'color' => 'success'],
                    ['label' => 'Send inquiries', 'current' => 250, 'total' => 500, 'color' => 'warning'],
                ],
                'summary' => $summary,
            ])
            <!--end::Monthly Recap Report-->

            <!--begin::Latest Orders and Recent Products-->
            <div class="row">
                <div class="col-lg-6">
                    @include('admin.components.latest-orders', ['orders' => $latestOrders])
                </div>
                <div class="col-lg-6">
                    @include('admin.components.recent-products', ['products' => $recentProducts])
                </div>
            </div>
            <!--end::Latest Orders and Recent Products-->

        </div>
    </div>
    <!--end::App Content-->
</main>
@endsection