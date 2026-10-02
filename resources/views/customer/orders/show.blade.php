@extends('layouts.app')

@section('title', 'តាមដានការកុម្ម៉ង់ #' . $order->order_number . ' - Tracking')

@section('content')
<div class="container py-4">
    <!-- Back button & Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('orders.index') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1 mb-1">
                <i class="bi bi-arrow-left"></i> ត្រឡប់ទៅបញ្ជីកុម្ម៉ង់ (Back to Orders)
            </a>
            <h2 class="fw-bold mb-0 font-classic text-dark">ការកុម្ម៉ង់លេខ #{{ $order->order_number }}</h2>
            <small class="text-muted">បានកុម្ម៉ង់នៅថ្ងៃទី {{ $order->created_at->format('d M, Y &bull; h:i A') }}</small>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span id="order-status-badge" class="badge {{ $order->getStatusBadgeClass() }} px-3 py-2 rounded-pill fs-6 fw-semibold">
                {{ $order->status }}
            </span>
        </div>
    </div>

    <!-- Live Status Stepper Card with Royal Gold Progression -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 bg-white" style="border: 1.5px solid var(--khmer-gold) !important;">
        @if($order->status === 'Cancelled')
            <div class="text-center py-3">
                <i class="bi bi-x-circle-fill text-danger" style="font-size: 3.5rem;"></i>
                <h4 class="fw-bold mt-2 text-danger font-classic">ការកុម្ម៉ង់ត្រូវបានបោះបង់ (Order Cancelled)</h4>
                <p class="text-muted mb-0">មូលហេតុ: {{ $order->cancelled_reason ?? 'Cancelled by request.' }}</p>
            </div>
        @else
            <div class="text-center mb-4">
                <h5 class="fw-bold mb-1 font-classic text-dark" id="status-title">
                    @if($order->status === 'Pending')
                        កំពុងរង់ចាំការយល់ព្រមពីភោជនីយដ្ឋាន... (Waiting for Confirmation)
                    @elseif($order->status === 'Confirmed')
                        ភោជនីយដ្ឋានបានទទួលការកុម្ម៉ង់រួចរាល់! (Order Confirmed)
                    @elseif($order->status === 'Preparing')
                        មេចុងភៅកំពុងចម្អិនម្ហូបយ៉ាងយកចិត្តទុកដាក់! (Chef is Cooking)
                    @elseif($order->status === 'Out for Delivery')
                        អ្នកដឹកជញ្ជូនកំពុងធ្វើដំណើរទៅកាន់លោកអ្នក! (Rider on the Way)
                    @elseif($order->status === 'Delivered')
                        សូមពិសាដោយរីករាយ! ដឹកជញ្ជូនបានជោគជ័យ (Delivered Successfully)
                    @endif
                </h5>
                <div class="khmer-divider my-2">
                    <span>❖</span>
                    <span style="font-size: 0.75rem;">ដំណើរការដឹកជញ្ជូន &bull; Live Delivery Status</span>
                    <span>❖</span>
                </div>
            </div>

            <!-- Progress Stepper Component -->
            <div class="position-relative my-4">
                <!-- Background Line -->
                <div class="progress" style="height: 6px; background-color: #E8E2D8;">
                    <div id="stepper-progress-bar" class="progress-bar" role="progressbar"
                         style="width: {{ $order->getProgressPercentage() }}%; background: var(--khmer-gold-gradient); transition: width 0.6s ease;"></div>
                </div>

                <!-- 5 Steps -->
                @php
                    $steps = [
                        ['key' => 'Pending', 'label_kh' => 'បានកុម្ម៉ង់', 'label' => 'Order Placed', 'icon' => 'bi-clipboard-check', 'pct' => 15],
                        ['key' => 'Confirmed', 'label_kh' => 'បានទទួល', 'label' => 'Confirmed', 'icon' => 'bi-check2-circle', 'pct' => 35],
                        ['key' => 'Preparing', 'label_kh' => 'កំពុងចម្អិន', 'label' => 'Preparing', 'icon' => 'bi-fire', 'pct' => 60],
                        ['key' => 'Out for Delivery', 'label_kh' => 'កំពុងដឹក', 'label' => 'On the Way', 'icon' => 'bi-bicycle', 'pct' => 85],
                        ['key' => 'Delivered', 'label_kh' => 'បានដឹកដល់', 'label' => 'Delivered', 'icon' => 'bi-house-check-fill', 'pct' => 100],
                    ];
                    $currentPct = $order->getProgressPercentage();
                @endphp

                <div class="d-flex justify-content-between mt-3 text-center">
                    @foreach($steps as $step)
                        @php
                            $isCompleted = $currentPct >= $step['pct'];
                            $isActive = $order->status === $step['key'];
                        @endphp
                        <div class="stepper-step {{ $isCompleted ? 'completed' : '' }} {{ $isActive ? 'active' : '' }}" id="step-node-{{ Str::slug($step['key']) }}">
                            <div class="step-icon">
                                <i class="bi {{ $step['icon'] }}"></i>
                            </div>
                            <div class="fw-bold small text-dark font-classic">{{ $step['label_kh'] }}</div>
                            <small class="text-muted d-block" style="font-size: 0.68rem;">{{ $step['label'] }}</small>
                            <small class="text-gold fw-semibold" style="font-size: 0.7rem;">
                                @if($step['key'] === 'Pending')
                                    {{ $order->created_at->format('h:i A') }}
                                @elseif($step['key'] === 'Confirmed' && $order->confirmed_at)
                                    {{ $order->confirmed_at->format('h:i A') }}
                                @elseif($step['key'] === 'Preparing' && $order->preparing_at)
                                    {{ $order->preparing_at->format('h:i A') }}
                                @elseif($step['key'] === 'Out for Delivery' && $order->out_for_delivery_at)
                                    {{ $order->out_for_delivery_at->format('h:i A') }}
                                @elseif($step['key'] === 'Delivered' && $order->delivered_at)
                                    {{ $order->delivered_at->format('h:i A') }}
                                @endif
                            </small>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Order Items & Receipt Details -->
    <div class="row g-4">
        <!-- Items itemization -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4" style="border: 1px solid var(--khmer-cream-border) !important;">
                <h5 class="fw-bold mb-3 font-classic text-dark">បញ្ជីមុខម្ហូប (Ordered Items)</h5>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light text-muted small text-uppercase">
                            <tr>
                                <th>មុខម្ហូប (Dish)</th>
                                <th class="text-center">ចំនួន (Qty)</th>
                                <th class="text-end">តម្លៃរាយ</th>
                                <th class="text-end">សរុប</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->food && $item->food->image)
                                                <img src="{{ $item->food->image }}" class="rounded-3 object-fit-cover border border-warning" width="50" height="50" alt="{{ $item->food_name }}">
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark font-classic">{{ $item->food_name }}</div>
                                                @if($item->instructions)
                                                    <small class="text-muted"><i class="bi bi-info-circle text-gold"></i> {{ $item->instructions }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center fw-semibold text-muted">&times; {{ $item->quantity }}</td>
                                    <td class="text-end text-muted font-classic">${{ number_format($item->price, 2) }}</td>
                                    <td class="text-end fw-bold text-dark font-classic">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pt-3 border-top mt-3" style="border-top-color: var(--khmer-cream-border) !important;">
                    <div class="d-flex justify-content-between text-muted small mb-1">
                        <span>តម្លៃមុខម្ហូបសរុប (Subtotal)</span>
                        <span class="fw-semibold text-dark font-classic">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>ថ្លៃដឹកជញ្ជូន (Delivery Fee)</span>
                        <span class="fw-semibold text-dark font-classic">${{ number_format($order->delivery_fee, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-top-color: var(--khmer-cream-border) !important;">
                        <span class="fw-bold text-dark fs-5 font-classic">ទឹកប្រាក់សរុប (Total)</span>
                        <span class="fw-extrabold fs-4 font-classic" style="color: #A67C1E;">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Action buttons: Cancel & Review -->
            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                @if($order->canCancel())
                    <button type="button" class="btn btn-outline-danger rounded-pill px-4 btn-sm" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                        <i class="bi bi-x-circle me-1"></i> បោះបង់ការកុម្ម៉ង់ (Cancel Order)
                    </button>
                @endif

                @if($order->status === 'Delivered')
                    <button type="button" class="btn btn-gold rounded-pill px-4 btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        <i class="bi bi-star-fill text-dark me-1"></i> វាយតម្លៃមុខម្ហូប (Rate & Review)
                    </button>
                @endif

                <a href="{{ route('home') }}" class="btn btn-outline-dark rounded-pill px-4 btn-sm ms-auto">
                    <i class="bi bi-cart-plus me-1"></i> កុម្ម៉ង់ម្ដងទៀត (Order Again)
                </a>
            </div>
        </div>

        <!-- Right Column: Delivery Information & Payment -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4" style="border: 1px solid var(--khmer-cream-border) !important;">
                <h6 class="fw-bold mb-3 text-dark font-classic"><i class="bi bi-geo-alt-fill text-danger me-1"></i> ទីតាំងដឹកជញ្ជូន (Delivery)</h6>
                <div class="mb-2">
                    <div class="text-muted small">ឈ្មោះអ្នកទទួល</div>
                    <div class="fw-semibold text-dark">{{ $order->customer_name }}</div>
                </div>
                <div class="mb-2">
                    <div class="text-muted small">លេខទូរស័ព្ទ</div>
                    <div class="fw-semibold text-dark">{{ $order->customer_phone }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">អាសយដ្ឋាន</div>
                    <div class="fw-semibold text-dark">{{ $order->delivery_address }}</div>
                </div>
                @if($order->notes)
                    <div class="p-2 bg-light rounded-3 text-muted small border">
                        <strong>ចំណាំ:</strong> {{ $order->notes }}
                    </div>
                @endif
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
                <h6 class="fw-bold mb-3 text-dark font-classic"><i class="bi bi-credit-card-fill text-gold me-1"></i> ព័ត៌មានទូទាត់ (Payment)</h6>
                <div class="d-flex justify-content-between mb-2 small">
                    <span class="text-muted">វិធីសាស្ត្រ</span>
                    <span class="fw-bold text-uppercase">{{ $order->payment_method }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2 small">
                    <span class="text-muted">ស្ថានភាពទូទាត់</span>
                    <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }} text-capitalize">
                        {{ $order->payment_status }}
                    </span>
                </div>
                @if($order->payments->isNotEmpty())
                    <div class="d-flex justify-content-between small text-muted">
                        <span>លេខកូដប្រតិបត្តិការ</span>
                        <code class="text-truncate" style="max-width: 140px;">{{ $order->payments->first()->transaction_id }}</code>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Cancel Order Modal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <form action="{{ route('orders.cancel', $order->order_number) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold text-danger font-classic">បោះបង់ការកុម្ម៉ង់ #{{ $order->order_number }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3">តើអ្នកពិតជាចង់បោះបង់ការកុម្ម៉ង់នេះមែនទេ? (Are you sure you want to cancel?)</p>
                    <label class="form-label small fw-semibold">មូលហេតុនៃការបោះបង់</label>
                    <select class="form-select mb-3" name="reason">
                        <option value="Changed my mind">ប្តូរចិត្ត (Changed my mind)</option>
                        <option value="Wait time too long">រង់ចាំយូរពេក (Wait time too long)</option>
                        <option value="Ordered by mistake">កុម្ម៉ង់ច្រឡំ (Ordered by mistake)</option>
                        <option value="Other">ផ្សេងៗ (Other)</option>
                    </select>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">រក្សាទុក</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">បញ្ជាក់ការបោះបង់</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Submit Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg" style="border: 2px solid var(--khmer-gold) !important;">
            <form action="{{ route('orders.review', $order->order_number) }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold font-classic">វាយតម្លៃមុខម្ហូប (Rate & Review)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">ជ្រើសរើសមុខម្ហូប</label>
                        <select class="form-select" name="food_id" required>
                            @foreach($order->items as $item)
                                @if($item->food_id)
                                    <option value="{{ $item->food_id }}">{{ $item->food_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">កម្រិតផ្កាយ (Rating)</label>
                        <select class="form-select" name="rating" required>
                            <option value="5">⭐⭐⭐⭐⭐ ៥ ផ្កាយ - ឆ្ងាញ់អស្ចារ្យ! (Excellent!)</option>
                            <option value="4">⭐⭐⭐⭐ ៤ ផ្កាយ - ឆ្ងាញ់ណាស់ (Very Good)</option>
                            <option value="3">⭐⭐⭐ ៣ ផ្កាយ - ល្មមទទួលទានបាន (Average)</option>
                            <option value="2">⭐⭐ ២ ផ្កាយ - ក្រោមការរំពឹងទុក</option>
                            <option value="1">⭐ ១ ផ្កាយ - មិនសូវឆ្ងាញ់</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-semibold">មតិយោបល់ (Your Feedback)</label>
                        <textarea class="form-control" name="comment" rows="3" placeholder="ចែករំលែកពីរសជាតិ និងបទពិសោធន៍របស់អ្នក..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">បិទ</button>
                    <button type="submit" class="btn btn-gold rounded-pill px-4">ផ្ញើការវាយតម្លៃ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const currentOrderNumber = "{{ $order->order_number }}";
    let lastStatus = "{{ $order->status }}";

    if (lastStatus !== 'Delivered' && lastStatus !== 'Cancelled') {
        setInterval(() => {
            fetch(`/orders/${currentOrderNumber}/track-api`)
                .then(r => r.json())
                .then(data => {
                    if (data.status && data.status !== lastStatus) {
                        window.location.reload();
                    }
                })
                .catch(e => console.log('Polling status...', e));
        }, 5000);
    }
</script>
@endpush
