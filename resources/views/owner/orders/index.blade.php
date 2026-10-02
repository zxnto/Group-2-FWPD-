@extends('layouts.owner')

@section('title', 'ការគ្រប់គ្រងការកុម្ម៉ង់ - Order Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-khmer">ការគ្រប់គ្រងការកុម្ម៉ង់ <span class="font-classic text-muted fs-6">(Live Order Management)</span></h4>
        <p class="text-muted small mb-0 font-khmer">តាមដានការកុម្ម៉ង់ពីអតិថិជន ទទួល/បដិសេធ និងផ្លាស់ប្តូរស្ថានភាពការកុម្ម៉ង់</p>
    </div>
</div>

<!-- Status Filter Pills -->
<div class="d-flex gap-2 overflow-x-auto pb-3 mb-4 scrollbar-none">
    <a href="{{ route('owner.orders.index') }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ empty($status) ? 'btn-gold text-dark fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        ទាំងអស់ (All) <span class="badge bg-secondary rounded-pill ms-1">{{ $counts['all'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Pending']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ $status === 'Pending' ? 'btn-warning text-dark fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        រង់ចាំ (Pending) <span class="badge bg-warning text-dark rounded-pill ms-1">{{ $counts['Pending'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Confirmed']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ $status === 'Confirmed' ? 'btn-info text-dark fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        បានទទួល (Confirmed) <span class="badge bg-info text-dark rounded-pill ms-1">{{ $counts['Confirmed'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Preparing']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ $status === 'Preparing' ? 'btn-primary text-white fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        កំពុងចម្អិន (Preparing) <span class="badge bg-primary text-white rounded-pill ms-1">{{ $counts['Preparing'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Out for Delivery']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ $status === 'Out for Delivery' ? 'btn-secondary text-white fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        កំពុងដឹកជញ្ជូន (Delivery) <span class="badge bg-secondary text-white rounded-pill ms-1">{{ $counts['Out for Delivery'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Delivered']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ $status === 'Delivered' ? 'btn-success text-white fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        រួចរាល់ (Delivered) <span class="badge bg-success text-white rounded-pill ms-1">{{ $counts['Delivered'] }}</span>
    </a>
    <a href="{{ route('owner.orders.index', ['status' => 'Cancelled']) }}"
       class="btn rounded-pill px-3 py-2 text-nowrap d-flex align-items-center gap-2 font-khmer {{ $status === 'Cancelled' ? 'btn-danger text-white fw-bold shadow-sm' : 'btn-white border text-secondary' }}">
        បានលុបចោល (Cancelled) <span class="badge bg-danger text-white rounded-pill ms-1">{{ $counts['Cancelled'] }}</span>
    </a>
</div>

<!-- Orders Table -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4">លេខកុម្ម៉ង់ (Order #)</th>
                        <th>អតិថិជន & អាសយដ្ឋាន</th>
                        <th>សេចក្តីសង្ខេបមុខម្ហូប</th>
                        <th>តម្លៃសរុប</th>
                        <th>ការទូទាត់</th>
                        <th>ស្ថានភាព</th>
                        <th class="pe-4 text-end">ធ្វើបច្ចុប្បន្នភាព</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.86rem;">
                    @forelse($orders as $order)
                        <tr>
                            <td class="ps-4 py-3">
                                <a href="{{ route('owner.orders.show', $order->id) }}" class="fw-bold text-dark text-decoration-none font-monospace">
                                    {{ $order->order_number }}
                                </a>
                                <div class="text-muted small" style="font-size: 0.74rem;">{{ $order->created_at->format('M d, h:i A') }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                                <div class="text-muted small" style="font-size: 0.74rem;"><i class="bi bi-telephone text-success me-1"></i>{{ $order->customer_phone }}</div>
                                <small class="text-muted text-truncate d-block" style="max-width: 220px; font-size: 0.74rem;" title="{{ $order->delivery_address }}">
                                    <i class="bi bi-geo-alt text-danger me-1"></i>{{ $order->delivery_address }}
                                </small>
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark font-khmer">
                                    {{ $order->items->sum('quantity') }} មុខម្ហូប
                                </div>
                                <div class="text-muted small text-truncate" style="max-width: 200px; font-size: 0.74rem;">
                                    {{ $order->items->pluck('food_name')->implode(', ') }}
                                </div>
                            </td>
                            <td class="fw-bold text-dark font-classic">${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border text-uppercase" style="font-size:0.72rem;">
                                    {{ $order->payment_method }}
                                </span>
                                <small class="d-block {{ $order->payment_status === 'paid' ? 'text-success fw-bold' : 'text-warning' }}" style="font-size: 0.72rem;">
                                    {{ strtoupper($order->payment_status) }}
                                </small>
                            </td>
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
                                <div class="d-inline-flex gap-1">
                                    @if($order->status === 'Pending')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Confirmed">
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1 font-khmer" style="font-size: 0.75rem;">
                                                <i class="bi bi-check2 me-1"></i>ទទួល
                                            </button>
                                        </form>
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('បដិសេធការកុម្ម៉ង់នេះ?')">
                                            @csrf
                                            <input type="hidden" name="status" value="Cancelled">
                                            <input type="hidden" name="reason" value="Rejected by restaurant">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1 font-khmer" style="font-size: 0.75rem;">
                                                <i class="bi bi-x me-1"></i>បដិសេធ
                                            </button>
                                        </form>
                                    @elseif($order->status === 'Confirmed')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Preparing">
                                            <button type="submit" class="btn btn-sm btn-gold rounded-pill px-3 py-1 font-khmer" style="font-size: 0.75rem;">
                                                <i class="bi bi-fire me-1"></i>ចាប់ផ្តើមចម្អិន
                                            </button>
                                        </form>
                                    @elseif($order->status === 'Preparing')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Out for Delivery">
                                            <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 py-1 font-khmer" style="font-size: 0.75rem;">
                                                <i class="bi bi-bicycle me-1"></i>បញ្ជូនដឹក
                                            </button>
                                        </form>
                                    @elseif($order->status === 'Out for Delivery')
                                        <form action="{{ route('owner.orders.status.update', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Delivered">
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 py-1 font-khmer" style="font-size: 0.75rem;">
                                                <i class="bi bi-check2-all me-1"></i>រួចរាល់
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('owner.orders.show', $order->id) }}" class="btn btn-sm btn-light border rounded-pill px-3 py-1 font-khmer" style="font-size: 0.75rem;">
                                            មើលលម្អិត
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted font-khmer">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                មិនទាន់មានការកុម្ម៉ង់ក្នុងផ្នែកនេះទេ។
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

