@extends('layouts.owner')

@section('title', 'របាយការណ៍ និងស្ថិតិ - Sales & Customer Reports')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1 font-khmer">របាយការណ៍ និងស្ថិតិ <span class="font-classic text-muted fs-6">(Sales & Customer Intelligence)</span></h4>
        <p class="text-muted small mb-0 font-khmer">ទិដ្ឋភាពទូទៅនៃចំណូលតាមច្រកទូទាត់ ស្ថិតិមុខម្ហូបតាមប្រភេទ និងបញ្ជីឈ្មោះអតិថិជន</p>
    </div>
</div>

<!-- 1. Revenue Analytics Cards -->
<div class="row g-4 mb-4">
    <!-- Payment Method Distribution -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2 text-dark font-khmer">
                <i class="bi bi-wallet2 text-warning"></i> ចំណូលតាមច្រកទូទាត់ (Payment Gateway)
            </h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-header-custom">
                        <tr>
                            <th>ច្រកទូទាត់</th>
                            <th class="text-center">ចំនួនការកុម្ម៉ង់</th>
                            <th class="text-end">ចំណូលសរុប</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.86rem;">
                        @forelse($paymentBreakdown as $pay)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($pay->payment_method === 'cod')
                                            <i class="bi bi-cash-stack text-success fs-5"></i>
                                            <span class="fw-bold text-dark font-khmer">ប្រាក់សុទ្ធ (Cash on Delivery)</span>
                                        @elseif($pay->payment_method === 'abapay')
                                            <i class="bi bi-qr-code-scan text-primary fs-5"></i>
                                            <span class="fw-bold text-dark font-khmer">ABA Pay / KHQR</span>
                                        @else
                                            <i class="bi bi-credit-card-2-front-fill text-warning fs-5"></i>
                                            <span class="fw-bold text-dark font-khmer">កាតធនាគារ (Credit/Debit Card)</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center fw-semibold text-muted font-khmer">{{ $pay->total_orders }} កុម្ម៉ង់</td>
                                <td class="text-end fw-extrabold text-dark font-classic fs-6">${{ number_format($pay->total_revenue, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted font-khmer py-3">មិនទាន់មានប្រតិបត្តិការនៅឡើយទេ។</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category Performance -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-3 d-flex align-items-center gap-2 text-dark font-khmer">
                <i class="bi bi-pie-chart-fill text-danger"></i> ការលក់តាមប្រភេទមុខម្ហូប (Sales by Category)
            </h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-header-custom">
                        <tr>
                            <th>ប្រភេទ</th>
                            <th class="text-center">ចំនួនលក់ដាច់</th>
                            <th class="text-end">ចំណូលសរុប</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.86rem;">
                        @foreach($categoriesWithSales as $catSale)
                            <tr>
                                <td class="fw-semibold text-dark font-khmer">{{ $catSale['name'] }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary-subtle text-secondary border font-khmer">{{ $catSale['items_sold'] }} មុខ</span>
                                </td>
                                <td class="text-end fw-bold text-dark font-classic">${{ number_format($catSale['revenue'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 2. Customer Information Roster -->
<div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
    <div class="card-header bg-transparent py-3 px-4 border-bottom">
        <h5 class="fw-bold mb-0 text-dark font-khmer"><i class="bi bi-people-fill text-info me-2"></i> បញ្ជីឈ្មោះអតិថិជន (Registered Customers)</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4">អតិថិជន</th>
                        <th>លេខទូរស័ព្ទ</th>
                        <th>អាសយដ្ឋានដើម</th>
                        <th class="text-center">ការកុម្ម៉ង់សរុប</th>
                        <th class="text-end">ចំណាយសរុប</th>
                        <th class="pe-4 text-end">ថ្ងៃចូលរួម</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.86rem;">
                    @forelse($customers as $customer)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark font-khmer">{{ $customer['name'] }}</div>
                                <small class="text-muted" style="font-size: 0.74rem;">{{ $customer['email'] }}</small>
                            </td>
                            <td>
                                <span class="text-dark small"><i class="bi bi-telephone text-success me-1"></i> {{ $customer['phone'] ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <small class="text-muted text-truncate d-block" style="max-width: 250px; font-size: 0.74rem;">
                                    {{ $customer['address'] ?? 'មិនទាន់មានអាសយដ្ឋាន' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary fw-bold font-khmer">{{ $customer['orders_count'] }} កុម្ម៉ង់</span>
                            </td>
                            <td class="text-end fw-extrabold text-success font-classic fs-6">
                                ${{ number_format($customer['total_spent'], 2) }}
                            </td>
                            <td class="pe-4 text-end text-muted small" style="font-size: 0.74rem;">
                                {{ $customer['joined_at'] }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted font-khmer">មិនទាន់មានអតិថិជនចុះឈ្មោះនៅឡើយទេ។</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 3. All Customer Reviews -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-transparent py-3 px-4 border-bottom">
        <h5 class="fw-bold mb-0 text-dark font-khmer"><i class="bi bi-chat-quote-fill text-warning me-2"></i> ការវាយតម្លៃពីអតិថិជន (Customer Feedback)</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4">មុខម្ហូប</th>
                        <th>អតិថិជន</th>
                        <th>ពិន្ទុ</th>
                        <th>មតិយោបល់</th>
                        <th class="pe-4 text-end">កាលបរិច្ឆេទ</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.86rem;">
                    @forelse($reviews as $rev)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark font-khmer">{{ $rev->food ? $rev->food->name : 'General' }}</div>
                            </td>
                            <td>
                                <span class="text-dark small">{{ $rev->user ? $rev->user->name : 'Anonymous' }}</span>
                            </td>
                            <td>
                                <span class="text-warning fs-6" style="letter-spacing: 2px;">{{ str_repeat('★', $rev->rating) }}</span>
                                <small class="text-muted">({{ $rev->rating }}/5)</small>
                            </td>
                            <td>
                                <div class="text-muted small fst-italic">"{{ $rev->comment }}"</div>
                            </td>
                            <td class="pe-4 text-end text-muted small" style="font-size: 0.74rem;">
                                {{ $rev->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted font-khmer">មិនទាន់មានការវាយតម្លៃនៅឡើយទេ។</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

