@extends('admin.layouts.master')

@section('title', 'AquaTerra - Dashboard')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
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
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    @include('admin.components.small-box', [
                        'value' => '150',
                        'label' => 'New Orders',
                        'color' => 'primary',
                        'iconSvg' => view('admin.components.icons.orders'),
                        'link' => route('admin.orders.index'),
                        'linkColor' => 'light',
                    ])

                    @include('admin.components.small-box', [
                        'value' => "53<sup class='fs-5'>%</sup>",
                        'label' => 'Total Revenue',
                        'color' => 'success',
                        'iconSvg' => view('admin.components.icons.revenue'),
                        'link' => '#',
                        'linkColor' => 'light',
                    ])

                    @include('admin.components.small-box', [
                        'value' => '44',
                        'label' => 'User Registrations',
                        'color' => 'warning',
                        'iconSvg' => view('admin.components.icons.users'),
                        'link' => route('admin.users.index'),
                        'linkColor' => 'dark',
                    ])

                    @include('admin.components.small-box', [
                        'value' => '65',
                        'label' => 'Inventory',
                        'color' => 'danger',
                        'iconSvg' => view('admin.components.icons.inventory'),
                        'link' => '#',
                        'linkColor' => 'light',
                    ])

                </div>
                <!--end::Row-->
                <!--begin::Row-->
                @include('admin.components.monthly-recap', [
                    'goals' => [
                        ['label' => 'Add to cart', 'current' => 160, 'total' => 200, 'color' => 'primary'],
                        ['label' => 'Complete purchase', 'current' => 310, 'total' => 400, 'color' => 'danger'],
                        ['label' => 'Visit premium', 'current' => 480, 'total' => 800, 'color' => 'success'],
                        ['label' => 'Send inquiries', 'current' => 250, 'total' => 500, 'color' => 'warning'],
                    ],
                    'summary' => [
                        ['label' => 'Total Revenue', 'value' => '$35,210.43', 'trend' => 'success', 'icon' => 'bi-caret-up-fill', 'change' => '17%'],
                        ['label' => 'Total Cost', 'value' => '$10,390.90', 'trend' => 'info', 'icon' => 'bi-caret-left-fill', 'change' => '0%'],
                        ['label' => 'Total Profit', 'value' => '$24,813.53', 'trend' => 'success', 'icon' => 'bi-caret-up-fill', 'change' => '20%'],
                        ['label' => 'Goal Completions', 'value' => '1200', 'trend' => 'danger', 'icon' => 'bi-caret-down-fill', 'change' => '18%'],
                    ],
                ])

                <div class="row">
                    <div class="col-lg-6">
                        @include('admin.components.latest-orders')
                    </div>
                    <div class="col-lg-6">
                        @include('admin.components.recent-products', ['products' => $recentProducts])
                    </div>
                </div>


                <!--end::Row-->
              <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
            
            </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
@endsection
