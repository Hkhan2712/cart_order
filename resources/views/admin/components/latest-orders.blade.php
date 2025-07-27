<div class="card">
    <div class="card-header">
        <h3 class="card-title">Latest Orders</h3>
        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
        </button>
        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
            <i class="bi bi-x-lg"></i>
        </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table m-0">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
            </tr>
            </thead>
            <tbody>
            {{-- Đây là dữ liệu mẫu, bạn có thể truyền động sau --}}
            <tr>
                <td><a href="#" class="link-primary">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="badge text-bg-success">Shipped</span></td>
                <td><div id="table-sparkline-1"></div></td>
            </tr>
            <!-- Thêm các dòng khác nếu cần -->
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer clearfix">
        <a href="#" class="btn btn-sm btn-primary float-start">Place New Order</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary float-end">View All Orders</a>
    </div>
</div>
