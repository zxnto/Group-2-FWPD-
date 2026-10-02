@extends('layouts.owner')

@section('title', 'Sales & Customer Reports - Owner Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Sales & Customer Intelligence</h3>
        <p class="text-muted small mb-0">Financial revenue breakdown, sales by category, customer roster and feedback</p>
    </div>
</div>

<!-- 1. Revenue Analytics Cards -->
<div class="row g-4 mb-4">
    <!-- Payment Method Distribution -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-wallet2 text-primary"></i> Revenue by Payment Gateway
            </h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light small text-uppercase">
                        <tr>
                            <th>Payment Gateway</th>
                            <th class="text-center">Orders</th>
                            <th class="text-end">Revenue Generated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paymentBreakdown as $pay)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($pay->payment_method === 'cod')
                                            <i class="bi bi-cash-stack text-success fs-5"></i>
                                            <span class="fw-bold text-dark">Cash on Delivery</span>
                                        @elseif($pay->payment_method === 'abapay')
                                            <i class="bi bi-qr-code-scan text-primary fs-5"></i>
                                            <span class="fw-bold text-dark">ABA Pay / KHQR</span>
                                        @else
                                            <i class="bi bi-credit-card-2-front-fill text-warning fs-5"></i>
                                            <span class="fw-bold text-dark">Credit / Debit Card</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center fw-semibold text-muted">{{ $pay->total_orders }} orders</td>
                                <td class="text-end fw-extrabold text-dark fs-6">${{ number_format($pay->total_revenue, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted">No transactions recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category Performance -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-pie-chart-fill text-danger"></i> Sales Volume by Cuisine Category
            </h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light small text-uppercase">
                        <tr>
                            <th>Category</th>
                            <th class="text-center">Items Sold</th>
                            <th class="text-end">Total Gross</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoriesWithSales as $catSale)
                            <tr>
                                <td class="fw-semibold text-dark">{{ $catSale['name'] }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">{{ $catSale['items_sold'] }} items</span>
                                </td>
                                <td class="text-end fw-bold text-dark">${{ number_format($catSale['revenue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 2. Customer Information Roster -->
<div class="card border-0 shadow-sm rounded-4 bg-white mb-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-people-fill text-info me-2"></i> Registered Customers Directory</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Customer</th>
                        <th>Phone</th>
                        <th>Default Address</th>
                        <th class="text-center">Total Orders</th>
                        <th class="text-end">Lifetime Spend</th>
                        <th class="pe-4 text-end">Member Since</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark">{{ $customer['name'] }}</div>
                                <small class="text-muted">{{ $customer['email'] }}</small>
                            </td>
                            <td>
                                <span class="text-dark small"><i class="bi bi-telephone text-success me-1"></i> {{ $customer['phone'] ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <small class="text-muted text-truncate d-block" style="max-width: 250px;">
                                    {{ $customer['address'] ?? 'No saved address' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary fw-bold">{{ $customer['orders_count'] }} orders</span>
                            </td>
                            <td class="text-end fw-extrabold text-success fs-6">
                                ${{ number_format($customer['total_spent'], 2) }}
                            </td>
                            <td class="pe-4 text-end text-muted small">
                                {{ $customer['joined_at'] }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">No customer profiles available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 3. All Customer Reviews -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-chat-quote-fill text-warning me-2"></i> Customer Ratings & Testimonials</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Dish</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th class="pe-4 text-end">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $rev)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark">{{ $rev->food ? $rev->food->name : 'General' }}</div>
                            </td>
                            <td>
                                <span class="text-dark small">{{ $rev->user ? $rev->user->name : 'Anonymous' }}</span>
                            </td>
                            <td>
                                <span class="text-warning fs-6">{{ str_repeat('★', $rev->rating) }}</span>
                                <small class="text-muted">({{ $rev->rating }}/5)</small>
                            </td>
                            <td>
                                <div class="text-muted small fst-italic">"{{ $rev->comment }}"</div>
                            </td>
                            <td class="pe-4 text-end text-muted small">
                                {{ $rev->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">No reviews recorded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
