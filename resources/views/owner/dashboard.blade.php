@extends('layouts.owner')

@section('title', 'ផ្ទាំងគ្រប់គ្រងអាជីវកម្ម - Business Dashboard')

@section('content')
<!-- Header & Quick Actions -->
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark font-classic" style="letter-spacing: -0.3px;">
            ផ្ទាំងគ្រប់គ្រងអាជីវកម្ម
        </h4>
        <p class="text-muted small mb-0">ទិដ្ឋភាពទូទៅនៃចំណូល ការកុម្ម៉ង់ និងស្ថិតិមុខម្ហូបប្រចាំថ្ងៃ</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('owner.foods.create') }}" class="btn btn-gold btn-sm rounded-pill px-3 py-1.5 shadow-sm d-inline-flex align-items-center gap-1.5">
            <i class="bi bi-plus-lg"></i>
            <span>បន្ថែមមុខម្ហូបថ្មី</span>
        </a>
        <a href="{{ route('owner.orders.index') }}" class="btn btn-white bg-white border btn-sm rounded-pill px-3 py-1.5 shadow-sm text-dark d-inline-flex align-items-center gap-1.5" style="border-color: #E2E8F0 !important;">
            <i class="bi bi-receipt text-warning"></i>
            <span>មើលការកុម្ម៉ង់ទាំងអស់</span>
        </a>
    </div>
</div>

<!-- KPI Summary Cards -->
<div class="row g-3 mb-4">
    <!-- Today Revenue -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-3.5 shadow-sm">
            <div class="d-flex align-items-start justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-medium" style="font-size: 0.82rem;">ចំណូលថ្ងៃនេះ</span>
                    <h3 class="fw-bold text-dark mt-1 mb-0 font-classic" style="font-size: 1.65rem;">${{ number_format($todayRevenue, 2) }}</h3>
                </div>
                <div class="stat-icon-box" style="background: #FEF3C7; color: #D97706;">
                    <i class="bi bi-cash-stack"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1 text-success small fw-medium" style="font-size: 0.76rem;">
                <i class="bi bi-graph-up-arrow"></i>
                <span>ចំណូលថ្ងៃនេះ</span>
            </div>
        </div>
    </div>

    <!-- Active Orders -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-3.5 shadow-sm">
            <div class="d-flex align-items-start justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-medium" style="font-size: 0.82rem;">ការកុម្ម៉ង់សកម្ម</span>
                    <h3 class="fw-bold text-dark mt-1 mb-0 font-classic" style="font-size: 1.65rem;">{{ $activeOrders }}</h3>
                </div>
                <div class="stat-icon-box" style="background: #EFF6FF; color: #2563EB;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1 text-primary small fw-medium" style="font-size: 0.76rem;">
                <i class="bi bi-clock-history"></i>
                <span>កំពុងដំណើរការ</span>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-3.5 shadow-sm">
            <div class="d-flex align-items-start justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-medium" style="font-size: 0.82rem;">ការកុម្ម៉ង់សរុប</span>
                    <h3 class="fw-bold text-dark mt-1 mb-0 font-classic" style="font-size: 1.65rem;">{{ $totalOrders }}</h3>
                </div>
                <div class="stat-icon-box" style="background: #ECFDF5; color: #059669;">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1 text-success small fw-medium" style="font-size: 0.76rem;">
                <i class="bi bi-bag-check"></i>
                <span>ចំនួនការកុម្ម៉ង់ទាំងអស់</span>
            </div>
        </div>
    </div>

    <!-- Menu Items -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card bg-white p-3.5 shadow-sm">
            <div class="d-flex align-items-start justify-content-between mb-2">
                <div>
                    <span class="text-muted small fw-medium" style="font-size: 0.82rem;">មុខម្ហូបក្នុងមីនុយ</span>
                    <h3 class="fw-bold text-dark mt-1 mb-0 font-classic" style="font-size: 1.65rem;">{{ $totalFoods }}</h3>
                </div>
                <div class="stat-icon-box" style="background: #FFF7ED; color: #EA580C;">
                    <i class="bi bi-egg-fried"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1 text-warning small fw-medium" style="font-size: 0.76rem;">
                <i class="bi bi-check2-circle text-warning"></i>
                <span>កំពុងដាក់លក់</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Live Orders Pipeline -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center" style="border-bottom-color: var(--card-border) !important;">
                <div class="d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: #FEF3C7; color: #D97706;">
                        <i class="bi bi-receipt fs-6"></i>
                    </span>
                    <h6 class="fw-bold mb-0 text-dark font-classic">ការកុម្ម៉ង់ថ្មីៗ (Recent Orders)</h6>
                </div>
                <a href="{{ route('owner.orders.index') }}" class="btn btn-sm btn-link text-warning text-decoration-none p-0 small fw-bold d-inline-flex align-items-center gap-1">
                    <span>មើលទាំងអស់</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead style="background: #F8FAFC; color: #64748B; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr>
                                <th class="ps-4 py-3">លេខកុម្ម៉ង់</th>
                                <th>អតិថិជន</th>
                                <th>មុខម្ហូប</th>
                                <th>តម្លៃសរុប</th>
                                <th>ស្ថានភាព</th>
                                <th class="pe-4 text-end">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.86rem;">
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
                                        <small class="text-muted" style="font-size: 0.74rem;">{{ $order->customer_phone }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-secondary border rounded-pill px-2.5 py-1" style="font-size: 0.74rem;">
                                            {{ $order->items->sum('quantity') }} មុខ
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
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-2.5 py-1 fw-medium shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.75rem;">
                                                    <i class="bi bi-check-lg"></i> ទទួល
                                                </button>
                                            </form>
                                        @elseif($order->status === 'Confirmed')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Preparing">
                                                <button type="submit" class="btn btn-sm btn-gold rounded-pill px-2.5 py-1 fw-medium shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.75rem;">
                                                    <i class="bi bi-fire"></i> ចម្អិន
                                                </button>
                                            </form>
                                        @elseif($order->status === 'Preparing')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Out for Delivery">
                                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-2.5 py-1 fw-medium shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.75rem;">
                                                    <i class="bi bi-bicycle"></i> បញ្ជូន
                                                </button>
                                            </form>
                                        @elseif($order->status === 'Out for Delivery')
                                            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="Delivered">
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-2.5 py-1 fw-medium shadow-sm d-inline-flex align-items-center gap-1" style="font-size:0.75rem;">
                                                    <i class="bi bi-check-all"></i> រួចរាល់
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('owner.orders.show', $order->id) }}" class="btn btn-sm btn-light border rounded-pill px-2.5 py-1" style="font-size:0.75rem;">
                                                មើល
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">មិនទាន់មានការកុម្ម៉ង់នៅឡើយទេ។</td>
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
        <!-- Top Selling Dishes -->
        <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2" style="border-bottom-color: var(--card-border) !important;">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: #FEF3C7; color: #D97706;">
                    <i class="bi bi-trophy-fill fs-6"></i>
                </span>
                <h6 class="fw-bold mb-0 text-dark font-classic">មុខម្ហូបលក់ដាច់បំផុត (Top Selling)</h6>
            </div>
            <div class="card-body p-3">
                @foreach($topFoods as $food)
                    <div class="d-flex align-items-center justify-content-between py-2.5 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-bottom-color: #F1F5F9 !important;">
                        <div class="d-flex align-items-center gap-2.5 overflow-hidden">
                            <img src="{{ $food->image }}" class="rounded-3 object-fit-cover border" width="44" height="44" alt="{{ $food->name }}" style="border-color: #E2E8F0 !important;">
                            <div class="text-truncate">
                                <div class="fw-semibold text-dark text-truncate" style="max-width: 140px; font-size: 0.85rem;">{{ $food->name }}</div>
                                <small class="text-muted font-classic" style="font-size: 0.78rem;">${{ number_format($food->price, 2) }}</small>
                            </div>
                        </div>
                        <span class="badge rounded-pill px-2.5 py-1" style="background: #FEF3C7; color: #92400E; font-size: 0.72rem; font-weight: 600;">
                            {{ $food->order_items_count }} កុម្ម៉ង់
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Customer Feedback -->
        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2" style="border-bottom-color: var(--card-border) !important;">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: #FEE2E2; color: #DC2626;">
                    <i class="bi bi-chat-heart-fill fs-6"></i>
                </span>
                <h6 class="fw-bold mb-0 text-dark font-classic">ការវាយតម្លៃថ្មីៗ (Reviews)</h6>
            </div>
            <div class="card-body p-3">
                @forelse($recentReviews as $rev)
                    <div class="mb-3 pb-2.5 {{ !$loop->last ? 'border-bottom' : '' }}" style="border-bottom-color: #F1F5F9 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-semibold text-dark small">{{ $rev->user ? $rev->user->name : 'Customer' }}</span>
                            <span class="text-warning small" style="letter-spacing: 2px;">{{ str_repeat('★', $rev->rating) }}</span>
                        </div>
                        <div class="text-muted small fst-italic" style="font-size: 0.8rem; line-height: 1.4;">"{{ Str::limit($rev->comment, 80) }}"</div>
                        <div class="text-gold mt-1" style="font-size: 0.7rem; font-weight: 500;">
                            <i class="bi bi-tag-fill me-1"></i>{{ $rev->food ? $rev->food->name : 'Dish' }}
                        </div>
                    </div>
                @empty
                    <div class="text-muted small text-center py-3">មិនទាន់មានការវាយតម្លៃនៅឡើយទេ។</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
