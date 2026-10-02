@extends('layouts.owner')

@section('title', 'Order Details - #' . $order->order_number)

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <a href="{{ route('owner.orders.index') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1 mb-1">
            <i class="bi bi-arrow-left"></i> Back to Orders List
        </a>
        <h3 class="fw-bold mb-0">Order #{{ $order->order_number }}</h3>
        <small class="text-muted">Placed on {{ $order->created_at->format('M d, Y &bull; h:i A') }}</small>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="badge {{ $order->getStatusBadgeClass() }} px-3 py-2 rounded-pill fs-6">
            {{ $order->status }}
        </span>
    </div>
</div>

<div class="row g-4">
    <!-- Order items and status control -->
    <div class="col-lg-8">
        <!-- Status Transition Card -->
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-sliders text-primary me-2"></i> Update Order Status</h5>
            <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-6">
                    <label class="form-label small fw-semibold">Current State: <span class="badge {{ $order->getStatusBadgeClass() }}">{{ $order->status }}</span></label>
                    <select name="status" class="form-select">
                        <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $order->status === 'Confirmed' ? 'selected' : '' }}>Confirmed (Accept)</option>
                        <option value="Preparing" {{ $order->status === 'Preparing' ? 'selected' : '' }}>Preparing (In Kitchen)</option>
                        <option value="Out for Delivery" {{ $order->status === 'Out for Delivery' ? 'selected' : '' }}>Out for Delivery (Rider Dispatched)</option>
                        <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered (Complete)</option>
                        <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Reason (if cancelling)</label>
                    <input type="text" name="reason" class="form-control" placeholder="Optional notes" value="{{ $order->cancelled_reason }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill text-white fw-semibold">
                        Update
                    </button>
                </div>
            </form>
        </div>

        <!-- Ordered Food Items -->
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="fw-bold mb-3">Kitchen Order Ticket</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light text-muted small text-uppercase">
                        <tr>
                            <th>Food Item</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($item->food && $item->food->image)
                                            <img src="{{ $item->food->image }}" class="rounded-3 object-fit-cover" width="50" height="50" alt="{{ $item->food_name }}">
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ $item->food_name }}</div>
                                            @if($item->instructions)
                                                <span class="badge bg-warning-subtle text-dark border"><i class="bi bi-chat-left-dots"></i> Special note: {{ $item->instructions }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold text-dark fs-6">&times; {{ $item->quantity }}</td>
                                <td class="text-end text-muted">${{ number_format($item->price, 2) }}</td>
                                <td class="text-end fw-bold text-dark">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pt-3 border-top mt-3">
                <div class="d-flex justify-content-between text-muted small mb-1">
                    <span>Food Subtotal</span>
                    <span class="fw-semibold text-dark">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between text-muted small mb-2">
                    <span>Delivery Charge</span>
                    <span class="fw-semibold text-dark">${{ number_format($order->delivery_fee, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                    <span class="fw-bold text-dark fs-5">Total Order Value</span>
                    <span class="fw-extrabold text-primary fs-4">${{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Information & Delivery Address -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
            <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-person-badge text-primary me-2"></i> Customer Details</h6>
            <div class="mb-2">
                <div class="text-muted small">Customer Name</div>
                <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
            </div>
            <div class="mb-2">
                <div class="text-muted small">Contact Phone</div>
                <div class="fw-semibold text-dark">
                    <a href="tel:{{ $order->customer_phone }}" class="text-decoration-none text-dark">
                        <i class="bi bi-telephone text-success me-1"></i> {{ $order->customer_phone }}
                    </a>
                </div>
            </div>
            <div class="mb-3">
                <div class="text-muted small">Delivery Address</div>
                <div class="fw-semibold text-dark">{{ $order->delivery_address }}</div>
            </div>
            @if($order->notes)
                <div class="p-2 bg-light rounded-2 text-muted small border">
                    <strong>Customer Instructions:</strong> {{ $order->notes }}
                </div>
            @endif
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-credit-card text-success me-2"></i> Payment Details</h6>
            <div class="d-flex justify-content-between mb-2 small">
                <span class="text-muted">Method</span>
                <span class="fw-bold text-uppercase">{{ $order->payment_method }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2 small">
                <span class="text-muted">Payment Status</span>
                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }} text-capitalize">
                    {{ $order->payment_status }}
                </span>
            </div>
            @if($order->payments->isNotEmpty())
                <div class="d-flex justify-content-between small text-muted">
                    <span>Reference</span>
                    <code class="text-truncate" style="max-width: 140px;">{{ $order->payments->first()->transaction_id }}</code>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
