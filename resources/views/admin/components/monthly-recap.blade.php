<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">Monthly Recap Report</h5>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <p class="text-center"><strong>Sales: 1 Jan - 30 Jul</strong></p>
                <div id="sales-chart"></div>
            </div>
            <div class="col-md-4">
                <p class="text-center"><strong>Goal Completion</strong></p>
                @foreach($goals as $goal)
                    <div class="progress-group">
                        {{ $goal['label'] }}
                        <span class="float-end"><b>{{ $goal['current'] }}</b>/{{ $goal['total'] }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar text-bg-{{ $goal['color'] }}" style="width: {{ round($goal['current'] / $goal['total'] * 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row text-center">
            @foreach($summary as $item)
                <div class="col-md-3 col-6 {{ !$loop->last ? 'border-end' : '' }}">
                    <span class="text-{{ $item['trend'] }}">
                        <i class="bi {{ $item['icon'] }}"></i> {{ $item['change'] }}
                    </span>
                    <h5 class="fw-bold mb-0">{{ $item['value'] }}&#8363;</h5>
                    <span class="text-uppercase">{{ $item['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
