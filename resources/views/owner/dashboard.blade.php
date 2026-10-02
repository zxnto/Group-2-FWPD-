@extends('layouts.owner')

@section('title', __('messages.business_dashboard') . ' - Golden Apsara')

@section('content')
<!-- Header & Quick Actions -->
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark font-classic" style="letter-spacing: -0.3px;">
            {{ __('messages.business_dashboard') }}
        </h4>
        <p class="text-muted small mb-0">{{ __('messages.dashboard_overview') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('owner.foods.create') }}" class="btn btn-gold btn-sm rounded-pill px-3.5 py-2 shadow-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i>
            <span>{{ __('messages.add_new_dish') }}</span>
        </a>
        <a href="{{ route('owner.orders.index') }}" class="btn btn-white border btn-sm rounded-pill px-3.5 py-2 shadow-sm text-dark d-inline-flex align-items-center gap-2">
            <i class="bi bi-receipt-cutoff text-warning"></i>
            <span>{{ __('messages.view_all_orders') }}</span>
        </a>
    </div>
</div>

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <!-- Today Revenue -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-semibold d-block text-uppercase" style="font-size: 0.76rem; letter-spacing: 0.5px;">{{ __('messages.today_revenue') }}</span>
                    <h3 class="fw-bold text-dark my-1 font-classic" style="font-size: 1.75rem;">${{ number_format($todayRevenue, 2) }}</h3>
                </div>
                <div class="stat-icon-box stat-icon-gold rounded-4">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1.5 text-success small fw-medium" style="font-size: 0.78rem;">
                <i class="bi bi-graph-up-arrow"></i>
                <span>{{ __('messages.today_revenue') }}</span>
            </div>
        </div>
    </div>

    <!-- Active Orders -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-semibold d-block text-uppercase" style="font-size: 0.76rem; letter-spacing: 0.5px;">{{ __('messages.active_orders') }}</span>
                    <h3 class="fw-bold text-dark my-1 font-classic" style="font-size: 1.75rem;">{{ $activeOrders }}</h3>
                </div>
                <div class="stat-icon-box stat-icon-blue rounded-4">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1.5 text-primary small fw-medium" style="font-size: 0.78rem;">
                <i class="bi bi-clock-history"></i>
                <span>{{ __('messages.in_progress') }}</span>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-semibold d-block text-uppercase" style="font-size: 0.76rem; letter-spacing: 0.5px;">{{ __('messages.total_orders_stat') }}</span>
                    <h3 class="fw-bold text-dark my-1 font-classic" style="font-size: 1.75rem;">{{ $totalOrders }}</h3>
                </div>
                <div class="stat-icon-box stat-icon-green rounded-4">
                    <i class="bi bi-bag-check-fill"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1.5 text-success small fw-medium" style="font-size: 0.78rem;">
                <i class="bi bi-check-all"></i>
                <span>{{ __('messages.total_orders_stat') }}</span>
            </div>
        </div>
    </div>

    <!-- Menu Items -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-semibold d-block text-uppercase" style="font-size: 0.76rem; letter-spacing: 0.5px;">{{ __('messages.menu_dishes') }}</span>
                    <h3 class="fw-bold text-dark my-1 font-classic" style="font-size: 1.75rem;">{{ $totalFoods }}</h3>
                </div>
                <div class="stat-icon-box stat-icon-orange rounded-4">
                    <i class="bi bi-egg-fried"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1.5 text-warning small fw-medium" style="font-size: 0.78rem;">
                <i class="bi bi-check2-circle"></i>
                <span>{{ __('messages.available_status') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Live Orders Pipeline Table -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="card-header bg-transparent py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2.5">
                    <span class="stat-icon-box stat-icon-gold rounded-circle" style="width: 34px; height: 34px; font-size: 0.95rem;">
                        <i class="bi bi-receipt-cutoff"></i>
                    </span>
                    <h6 class="fw-bold mb-0 text-dark font-classic">{{ __('messages.recent_orders') }}</h6>
                </div>
                <a href="{{ route('owner.orders.index') }}" class="btn btn-sm btn-link text-warning text-decoration-none p-0 small fw-bold d-inline-flex align-items-center gap-1">
                    <span>{{ __('messages.view_all_dishes') }}</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-header-custom">
                            <tr>
                                <th class="ps-4 py-3">{{ __('messages.order_no') }}</th>
                                <th>{{ __('messages.customer') }}</th>
                                <th>{{ __('messages.dishes') }}</th>
                                <th>{{ __('messages.total_price') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th class="pe-4 text-end">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.88rem;">
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <a href="{{ route('owner.orders.show', $order->id) }}" class="fw-bold text-dark text-decoration-none font-monospace">
                                            {{ $order->order_number }}
                                        </a>
                                        <div class="text-muted" style="font-size: 0.74rem;">
                                            <i class="bi bi-clock me-1"></i>{{ $order->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $order->customer_phone }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2.5 py-1" style="font-size: 0.75rem;">
                                            {{ $order->items->sum('quantity') }} {{ __('messages.items_count') }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark font-classic">${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        @php
                                            $statusBadgeMap = [
                                                'Pending' => 'badge-pending',
                                                'Confirmed' => 'badge-confirmed',
                                                'Preparing' => 'badge-preparing',
                                                'Out for Delivery' => 'badge-delivery',
                                                'Delivered' => 'badge-delivered',
                                                'Cancelled' => 'badge-cancelled',
                                            ];
                                            $badgeClass = $statusBadgeMap[$order->status] ?? 'badge-pending';
                                        @endphp
                                        <span class="badge-status {{ $badgeClass }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        @if($order->status === 'Pending')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Confirmed">
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-2.5 py-1 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.76rem;">
                                                    <i class="bi bi-check-lg"></i> {{ __('messages.accept') }}
                                                </button>
                                            </form>
                                        @elseif($order->status === 'Confirmed')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Preparing">
                                                <button type="submit" class="btn btn-sm btn-gold rounded-pill px-2.5 py-1 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.76rem;">
                                                    <i class="bi bi-fire"></i> {{ __('messages.cook') }}
                                                </button>
                                            </form>
                                        @elseif($order->status === 'Preparing')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Out for Delivery">
                                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-2.5 py-1 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.76rem;">
                                                    <i class="bi bi-bicycle"></i> {{ __('messages.dispatch') }}
                                                </button>
                                            </form>
                                        @elseif($order->status === 'Out for Delivery')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Delivered">
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-2.5 py-1 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.76rem;">
                                                    <i class="bi bi-check-all"></i> {{ __('messages.complete') }}
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('owner.orders.show', $order->id) }}" class="btn btn-sm btn-light border rounded-pill px-2.5 py-1" style="font-size:0.76rem;">
                                                {{ __('messages.view') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">{{ __('messages.no_orders_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Top Selling & Reviews -->
    <div class="col-lg-4">
        <!-- Top Selling Dishes Widget -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="card-header bg-transparent py-3 px-4 border-bottom d-flex align-items-center gap-2.5">
                <span class="stat-icon-box stat-icon-gold rounded-circle" style="width: 34px; height: 34px; font-size: 0.95rem;">
                    <i class="bi bi-trophy-fill"></i>
                </span>
                <h6 class="fw-bold mb-0 text-dark font-classic">{{ __('messages.top_selling') }}</h6>
            </div>
            <div class="card-body p-3">
                @foreach($topFoods as $food)
                    <div class="d-flex align-items-center justify-content-between py-2.5 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex align-items-center gap-3 overflow-hidden">
                            <img src="{{ $food->image }}" class="rounded-3 object-fit-cover border shadow-sm" width="46" height="46" alt="{{ $food->name }}">
                            <div class="text-truncate">
                                <div class="fw-semibold text-dark text-truncate" style="max-width: 140px; font-size: 0.86rem;">{{ $food->name }}</div>
                                <small class="text-muted font-classic" style="font-size: 0.78rem;">${{ number_format($food->price, 2) }}</small>
                            </div>
                        </div>
                        <span class="badge rounded-pill px-2.5 py-1.5 stat-icon-gold" style="font-size: 0.74rem; font-weight: 600;">
                            {{ $food->order_items_count }} {{ __('messages.orders_count') }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Customer Feedback Widget -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-transparent py-3 px-4 border-bottom d-flex align-items-center gap-2.5">
                <span class="stat-icon-box stat-icon-red rounded-circle" style="width: 34px; height: 34px; font-size: 0.95rem;">
                    <i class="bi bi-chat-heart-fill"></i>
                </span>
                <h6 class="fw-bold mb-0 text-dark font-classic">{{ __('messages.recent_reviews') }}</h6>
            </div>
            <div class="card-body p-3">
                @forelse($recentReviews as $rev)
                    <div class="mb-3 pb-2.5 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-semibold text-dark small">{{ $rev->user ? $rev->user->name : 'Customer' }}</span>
                            <span class="text-warning small" style="letter-spacing: 2px;">{{ str_repeat('★', $rev->rating) }}</span>
                        </div>
                        <div class="text-muted small fst-italic" style="font-size: 0.81rem; line-height: 1.45;">"{{ Str::limit($rev->comment, 80) }}"</div>
                        <div class="text-gold mt-1" style="font-size: 0.72rem; font-weight: 600;">
                            <i class="bi bi-tag-fill me-1"></i>{{ $rev->food ? $rev->food->name : 'Dish' }}
                        </div>
                    </div>
                @empty
                    <div class="text-muted small text-center py-3">{{ __('messages.no_reviews') }}</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
