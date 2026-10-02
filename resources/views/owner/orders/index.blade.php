@extends('layouts.owner')

@section('title', 'Manage Orders - Owner Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Live Order Management</h3>
        <p class="text-muted small mb-0">Track incoming customer orders, accept/reject, and transition order stages</p>
    </div>
</div>

<!-- Status Filter Pills -->
<div class="d-flex gap-2 overflow-x-auto pb-3 mb-4 scrollbar-none">
    <a href="{{ route('owner.orders.index') }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ empty($status) ? 'btn-dark text-white fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        All Orders <span class="badge bg-secondary rounded-pill ms-1">{{ $counts['all'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Pending']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ $status === 'Pending' ? 'btn-warning text-dark fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        Pending <span class="badge bg-warning text-dark rounded-pill ms-1">{{ $counts['Pending'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Confirmed']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ $status === 'Confirmed' ? 'btn-info text-dark fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        Confirmed <span class="badge bg-info text-dark rounded-pill ms-1">{{ $counts['Confirmed'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Preparing']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ $status === 'Preparing' ? 'btn-primary text-white fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        Preparing <span class="badge bg-primary text-white rounded-pill ms-1">{{ $counts['Preparing'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Out for Delivery']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ $status === 'Out for Delivery' ? 'btn-secondary text-white fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        Out for Delivery <span class="badge bg-secondary text-white rounded-pill ms-1">{{ $counts['Out for Delivery'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Delivered']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ $status === 'Delivered' ? 'btn-success text-white fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        Delivered <span class="badge bg-success text-white rounded-pill ms-1">{{ $counts['Delivered'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Cancelled']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 {{ $status === 'Cancelled' ? 'btn-danger text-white fw-bold shadow-sm' : 'btn-white bg-white border text-secondary' }}">
        Cancelled <span class="badge bg-danger text-white rounded-pill ms-1">{{ $counts['Cancelled'] }}</span>
    </a>
</div>

<!-- Orders Table -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Order #</th>
                        <th>Customer & Address</th>
                        <th>Items Summary</th>
                        <th>Total Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="ps-4 py-3">
                                <a href="{{ route('owner.orders.show', $order->id) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $order->order_number }}
                                </a>
                                <div class="text-muted small">{{ $order->created_at->format('M d, h:i A') }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                                <div class="text-muted small"><i class="bi bi-telephone"></i> {{ $order->customer_phone }}</div>
                                <small class="text-muted text-truncate d-block" style="max-width: 220px;" title="{{ $order->delivery_address }}">
                                    <i class="bi bi-geo-alt text-danger"></i> {{ $order->delivery_address }}
                                </small>
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark">
                                    {{ $order->items->sum('quantity') }} items
                                </div>
                                <div class="text-muted small text-truncate" style="max-width: 200px;">
                                    {{ $order->items->pluck('food_name')->implode(', ') }}
                                </div>
                            </td>
                            <td class="fw-bold text-dark fs-6">${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-light text-dark border text-uppercase" style="font-size:0.75rem;">
                                    {{ $order->payment_method }}
                                </span>
                                <small class="d-block {{ $order->payment_status === 'paid' ? 'text-success fw-bold' : 'text-warning' }}">
                                    {{ $order->payment_status }}
                                </small>
                            </td>
                            <td>
                                <span class="badge {{ $order->getStatusBadgeClass() }} px-3 py-2 rounded-pill">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-1">
                                    @if($order->status === 'Pending')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Confirmed">
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1">
                                                <i class="bi bi-check2"></i> Accept
                                            </button>
                                        </form>
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Reject this order?')">
                                            @csrf
                                            <input type="hidden" name="status" value="Cancelled">
                                            <input type="hidden" name="reason" value="Rejected by restaurant">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1">
                                                <i class="bi bi-x"></i> Reject
                                            </button>
                                        </form>
                                    @elseif($order->status === 'Confirmed')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Preparing">
                                            <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 py-1">
                                                <i class="bi bi-fire"></i> Start Cooking
                                            </button>
                                        </form>
                                    @elseif($order->status === 'Preparing')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Out for Delivery">
                                            <button type="submit" class="btn btn-sm btn-secondary rounded-pill px-3 py-1">
                                                <i class="bi bi-bicycle"></i> Send Delivery
                                            </button>
                                        </form>
                                    @elseif($order->status === 'Out for Delivery')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Delivered">
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1">
                                                <i class="bi bi-check2-all"></i> Mark Delivered
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('owner.orders.show', $order->id) }}" class="btn btn-sm btn-light border rounded-pill px-3 py-1">
                                            Details
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No orders found in this category.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $orders->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection
