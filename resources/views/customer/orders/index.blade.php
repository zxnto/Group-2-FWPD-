@extends('layouts.app')

@section('title', 'ប្រវត្តិការកុម្ម៉ង់ - My Order History - Foodie Express')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1 font-classic text-dark">ប្រវត្តិការកុម្ម៉ង់ (My Order History)</h2>
            <p class="text-muted small mb-0">តាមដានស្ថានភាពការកុម្ម៉ង់បច្ចុប្បន្ន និងប្រវត្តិ &bull; Track active orders and past dining history</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-gold rounded-pill px-3 py-1 btn-sm">
            <i class="bi bi-plus-lg me-1"></i> កុម្ម៉ង់ម្ហូបថ្មី (Order Food)
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 p-4 bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
            <i class="bi bi-receipt-cutoff text-warning" style="font-size: 3.5rem;"></i>
            <h4 class="fw-bold mt-3 font-classic">មិនទាន់មានការកុម្ម៉ង់នៅឡើយទេ</h4>
            <p class="text-muted mb-4">លោកអ្នកមិនទាន់បានកុម្ម៉ង់មុខម្ហូបនៅឡើយទេ។ សូមពិនិត្យមើលមុខម្ហូបពិសេសៗរបស់យើង!</p>
            <div>
                <a href="{{ route('home') }}" class="btn btn-gold rounded-pill px-4 py-2 shadow-sm font-classic">
                    <i class="bi bi-flower1 me-1"></i> មើលមុខម្ហូប (Browse Menu)
                </a>
            </div>
        </div>
    @else
        <div class="row g-3">
            @foreach($orders as $order)
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
                        <div class="row align-items-center gy-3">
                            <div class="col-md-3">
                                <span class="badge {{ $order->getStatusBadgeClass() }} px-3 py-2 rounded-pill mb-2 fw-semibold">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>
                                    {{ $order->status }}
                                </span>
                                <h6 class="fw-bold mb-0 text-dark font-classic">{{ $order->order_number }}</h6>
                                <small class="text-muted">{{ $order->created_at->format('M d, Y &bull; h:i A') }}</small>
                            </div>

                            <div class="col-md-4">
                                <div class="small fw-semibold text-dark mb-1 font-classic">មុខម្ហូប (Dishes):</div>
                                <div class="text-muted small text-truncate">
                                    {{ $order->items->pluck('food_name')->implode(', ') }}
                                </div>
                                <small class="text-secondary">{{ $order->items->sum('quantity') }} មុខ &bull; វិធីទូទាត់: {{ strtoupper($order->payment_method) }}</small>
                            </div>

                            <div class="col-md-2 text-md-center">
                                <div class="text-muted small">ទឹកប្រាក់សរុប (Total)</div>
                                <div class="fw-extrabold fs-5 font-classic" style="color: #A67C1E;">${{ number_format($order->total_amount, 2) }}</div>
                            </div>

                            <div class="col-md-3 text-md-end">
                                <a href="{{ route('orders.show', $order->order_number) }}" class="btn btn-outline-gold rounded-pill px-3 py-2 btn-sm fw-semibold w-100 w-md-auto">
                                    <i class="bi bi-geo-alt-fill me-1"></i> តាមដាន & លម្អិត (Track)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $orders->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
