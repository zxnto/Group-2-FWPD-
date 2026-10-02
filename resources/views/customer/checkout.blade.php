@extends('layouts.app')

@section('title', 'ទូទាត់ប្រាក់ - Checkout - Foodie Express')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold mb-1 font-classic text-dark">ការទូទាត់ប្រាក់ & ទីតាំងដឹកជញ្ជូន (Checkout)</h2>
        <p class="text-muted small">បំពេញព័ត៌មានទីតាំងដឹកជញ្ជូន និងជ្រើសរើសវិធីសាស្ត្រទូទាត់ប្រាក់ &bull; Delivery details & payment</p>
    </div>

    <form action="{{ route('checkout.place') }}" method="POST" id="checkout-form">
        @csrf

        <div class="row g-4">
            <!-- Left Column: Delivery Details & Payment -->
            <div class="col-lg-8">
                <!-- 1. Customer Details & Delivery Address -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
                    <h5 class="fw-bold mb-3 d-flex align-items-center gap-2 font-classic text-dark">
                        <span class="d-inline-flex align-items-center justify-content-center text-dark rounded-circle"
                              style="width:30px; height:30px; font-size:0.9rem; background: var(--khmer-gold-gradient);">1</span>
                        <span>ព័ត៌មានអ្នកទទួល & ទីតាំង (Delivery Details)</span>
                    </h5>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">ឈ្មោះអ្នកទទួល (Recipient Name)</label>
                            <input type="text" class="form-control" name="customer_name"
                                   value="{{ old('customer_name', Auth::user()->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">លេខទូរស័ព្ទ (Contact Phone)</label>
                            <input type="text" class="form-control" name="customer_phone"
                                   value="{{ old('customer_phone', Auth::user()->phone ?? '+855 98 765 432') }}" required>
                        </div>
                    </div>

                    <!-- Saved Addresses vs New Address -->
                    @if($addresses->isNotEmpty())
                        <label class="form-label small fw-semibold mb-2">ជ្រើសរើសទីតាំង (Saved Address)</label>
                        <div class="row g-2 mb-3">
                            @foreach($addresses as $addr)
                                <div class="col-md-6">
                                    <label class="card h-100 p-3 rounded-3 cursor-pointer address-choice-card {{ $loop->first ? 'border-warning bg-warning bg-opacity-10' : 'border' }}" style="cursor: pointer;">
                                        <div class="d-flex align-items-start gap-2">
                                            <input type="radio" name="address_id" value="{{ $addr->id }}" class="form-check-input mt-1"
                                                   {{ $loop->first ? 'checked' : '' }} onchange="toggleAddressSelection(this, '{{ addslashes($addr->address . ', ' . $addr->city) }}')">
                                            <div>
                                                <div class="fw-bold small text-dark d-flex align-items-center gap-1 font-classic">
                                                    <i class="bi {{ $addr->label === 'Home (ផ្ទះ)' ? 'bi-house-door-fill' : 'bi-building-fill' }} text-gold"></i>
                                                    {{ $addr->label }}
                                                    @if($addr->is_default) <span class="badge bg-secondary" style="font-size:0.65rem;">Default</span> @endif
                                                </div>
                                                <div class="text-muted small mt-1">{{ $addr->address }}, {{ $addr->city }}</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                            <div class="col-md-6">
                                <label class="card h-100 p-3 border rounded-3 cursor-pointer address-choice-card" style="cursor: pointer;">
                                    <div class="d-flex align-items-start gap-2">
                                        <input type="radio" name="address_id" value="" class="form-check-input mt-1"
                                               id="use-new-address-radio" onchange="toggleAddressSelection(this, '')">
                                        <div>
                                            <div class="fw-bold small text-dark font-classic">
                                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> ទីតាំងផ្សេងទៀត (New Address)
                                            </div>
                                            <div class="text-muted small mt-1">បញ្ចូលអាសយដ្ឋានដឹកជញ្ជូនថ្មីខាងក្រោម</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    @endif

                    <!-- Delivery Address Text Area -->
                    <div class="mb-3">
                        <label for="delivery_address" class="form-label small fw-semibold">អាសយដ្ឋានដឹកជញ្ជូន (Delivery Address)</label>
                        <textarea class="form-control @error('delivery_address') is-invalid @enderror"
                                  id="delivery_address" name="delivery_address" rows="2" required placeholder="ផ្ទះលេខ, ផ្លូវ, សង្កាត់, រាជធានីភ្នំពេញ">{{ old('delivery_address', $defaultAddress ? $defaultAddress->address . ', ' . $defaultAddress->city : Auth::user()->address ?? '#45, Street 240, Daun Penh, Phnom Penh') }}</textarea>
                        @error('delivery_address')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rider instructions / notes -->
                    <div class="mb-2">
                        <label for="notes" class="form-label small fw-semibold">ចំណាំសម្រាប់អ្នកដឹកជញ្ជូន (Driver Instructions - Optional)</label>
                        <input type="text" class="form-control form-control-sm" id="notes" name="notes"
                               placeholder="ឧ. ដល់ហើយសូមខលមកខ្ញុំ, ដាក់នៅមុខផ្ទះ...">
                    </div>
                </div>

                <!-- 2. Payment Method -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
                    <h5 class="fw-bold mb-3 d-flex align-items-center gap-2 font-classic text-dark">
                        <span class="d-inline-flex align-items-center justify-content-center text-dark rounded-circle"
                              style="width:30px; height:30px; font-size:0.9rem; background: var(--khmer-gold-gradient);">2</span>
                        <span>វិធីសាស្ត្រទូទាត់ប្រាក់ (Payment Method)</span>
                    </h5>

                    <div class="row g-3 mb-4">
                        <!-- ABA Pay / KHQR Sandbox (Recommended for Cambodia) -->
                        <div class="col-md-4">
                            <label class="card h-100 p-3 rounded-4 cursor-pointer payment-option-card border-warning bg-warning bg-opacity-10" style="cursor: pointer; border-width: 2px !important;">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <input type="radio" name="payment_method" value="abapay" class="form-check-input mb-2" checked onchange="switchPaymentView('abapay')">
                                    <i class="bi bi-qr-code-scan text-primary fs-2 mb-2"></i>
                                    <span class="fw-bold small text-dark font-classic">ABA Pay &bull; KHQR</span>
                                    <small class="text-muted mt-1" style="font-size:0.75rem;">ស្កេនទូទាត់រហ័ស (Instant Scan)</small>
                                </div>
                            </label>
                        </div>

                        <!-- Cash on Delivery -->
                        <div class="col-md-4">
                            <label class="card h-100 p-3 rounded-4 cursor-pointer payment-option-card border" style="cursor: pointer;">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <input type="radio" name="payment_method" value="cod" class="form-check-input mb-2" onchange="switchPaymentView('cod')">
                                    <i class="bi bi-cash-stack text-success fs-2 mb-2"></i>
                                    <span class="fw-bold small text-dark font-classic">ទូទាត់ពេលដឹកដល់ (COD)</span>
                                    <small class="text-muted mt-1" style="font-size:0.75rem;">បង់ប្រាក់សុទ្ធពេលទទួលម្ហូប</small>
                                </div>
                            </label>
                        </div>

                        <!-- Credit Card Sandbox -->
                        <div class="col-md-4">
                            <label class="card h-100 p-3 rounded-4 cursor-pointer payment-option-card border" style="cursor: pointer;">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <input type="radio" name="payment_method" value="card" class="form-check-input mb-2" onchange="switchPaymentView('card')">
                                    <i class="bi bi-credit-card-2-front-fill text-warning fs-2 mb-2"></i>
                                    <span class="fw-bold small text-dark font-classic">កាតធនាគារ (Visa/Master)</span>
                                    <small class="text-muted mt-1" style="font-size:0.75rem;">Stripe Sandbox Simulation</small>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Dynamic Payment Sandbox Views -->
                    <!-- ABA Pay / KHQR Authentic Cambodian QR -->
                    <div id="payment-view-abapay" class="p-4 bg-light rounded-4 border" style="border-color: var(--khmer-cream-border) !important;">
                        <div class="row align-items-center">
                            <div class="col-md-5 text-center">
                                <div class="bg-white p-3 rounded-4 shadow-sm d-inline-block border position-relative" style="border: 2px solid var(--khmer-gold) !important;">
                                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                        <span class="badge bg-danger fw-bold">KHQR</span>
                                        <span class="badge bg-primary fw-bold">ABA PAY</span>
                                        <span class="badge bg-dark fw-bold">BAKONG</span>
                                    </div>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=165x165&data=KHQR_GOLDEN_APSARA_USD_{{ $totals['total'] }}"
                                         alt="ABA Pay KHQR" class="img-fluid rounded" width="165" height="165">
                                    <div class="mt-2 fw-bold fs-5 font-classic" style="color: #A67C1E;">${{ $totals['total'] }} USD</div>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">មាសអប្សរា &bull; The Golden Apsara</small>
                                </div>
                            </div>
                            <div class="col-md-7 mt-3 mt-md-0">
                                <h6 class="fw-bold text-dark font-classic"><i class="bi bi-phone me-1 text-primary"></i> ស្កេនទូទាត់ជាមួយកម្មវិធីធនាគារ (Scan with Banking App)</h6>
                                <p class="text-muted small mb-3">
                                    គាំទ្រការស្កេនតាម <strong>ABA Mobile, Bakong, Wing, ACLEDA</strong> និងកម្មវិធីធនាគារដៃគូនានាក្នុងប្រទេសកម្ពុជា។
                                </p>
                                <div class="alert alert-warning py-2 small mb-3 border-0" style="background: rgba(212,175,55,0.18); color: #6C4C07;">
                                    <i class="bi bi-check2-circle me-1"></i> Sandbox Test Mode: ការទូទាត់នឹងត្រូវអនុម័តភ្លាមៗពេលចុចបញ្ជាទិញ។
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                    <i class="bi bi-shield-lock-fill"></i> ប្រព័ន្ធសុវត្ថិភាព KHQR សកម្ម
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- COD info -->
                    <div id="payment-view-cod" class="p-3 bg-light rounded-4 border d-none">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-info-circle-fill text-gold fs-5"></i>
                            <div class="small">
                                <strong>ជ្រើសរើសទូទាត់ពេលដឹកជញ្ជូនដល់កន្លែង (COD):</strong> លោកអ្នកត្រូវបង់ប្រាក់សុទ្ធចំនួន <strong class="text-dark font-classic">${{ $totals['total'] }}</strong> ទៅកាន់អ្នកដឹកជញ្ជូនពេលទទួលម្ហូប។
                            </div>
                        </div>
                    </div>

                    <!-- Credit Card Simulator -->
                    <div id="payment-view-card" class="p-4 bg-light rounded-4 border d-none">
                        <h6 class="fw-bold mb-3 d-flex align-items-center gap-2 font-classic">
                            <i class="bi bi-credit-card-2-back text-primary"></i> Credit / Debit Card Sandbox (Stripe Simulation)
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small fw-semibold">លេខកាត (Card Number)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white"><i class="bi bi-credit-card"></i></span>
                                    <input type="text" class="form-control" value="4242 •••• •••• 4242" readonly>
                                    <span class="input-group-text bg-white text-primary fw-bold">VISA TEST</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold">ផុតកំណត់</label>
                                <input type="text" class="form-control form-control-sm" value="12/28" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-semibold">CVC</label>
                                <input type="text" class="form-control form-control-sm" value="999" readonly>
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block">
                            <i class="bi bi-shield-check text-success"></i> កាតតេស្តសាកល្បងត្រូវបានផ្ទៀងផ្ទាត់ដោយស្វ័យប្រវត្តិ។
                        </small>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Items Summary & Submit -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 80px; border: 1.5px solid var(--khmer-gold) !important;">
                    <h5 class="fw-bold mb-3 font-classic text-dark">ម្ហូបដែលកុម្ម៉ង់ ({{ count($cart) }})</h5>

                    <div class="overflow-y-auto mb-3 scrollbar-none" style="max-height: 240px;">
                        @foreach($cart as $item)
                            <div class="d-flex align-items-center justify-content-between py-2 border-bottom" style="border-bottom-color: var(--khmer-cream-border) !important;">
                                <div class="d-flex align-items-center gap-2 overflow-hidden">
                                    <img src="{{ $item['image'] }}" class="rounded-2 object-fit-cover border border-warning" width="40" height="40" alt="{{ $item['name'] }}">
                                    <div class="text-truncate">
                                        <div class="fw-semibold text-dark small text-truncate font-classic" style="max-width: 140px;">{{ $item['name'] }}</div>
                                        <small class="text-muted">{{ $item['quantity'] }} &times; ${{ number_format($item['price'], 2) }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-dark small font-classic">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>តម្លៃមុខម្ហូប (Subtotal)</span>
                        <span class="fw-semibold text-dark font-classic">${{ $totals['subtotal'] }}</span>
                    </div>

                    <div class="d-flex justify-content-between text-muted small mb-2">
                        <span>ថ្លៃដឹកជញ្ជូន (Delivery)</span>
                        @if($totals['delivery_fee'] == 0)
                            <span class="text-success fw-bold">ឥតគិតថ្លៃ (FREE)</span>
                        @else
                            <span class="fw-semibold text-dark font-classic">${{ $totals['delivery_fee'] }}</span>
                        @endif
                    </div>

                    <hr class="my-3" style="border-color: var(--khmer-cream-border);">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold text-dark fs-5">ទឹកប្រាក់សរុប (Total)</span>
                        <span class="fw-extrabold fs-4 font-classic" style="color: #A67C1E;">${{ $totals['total'] }}</span>
                    </div>

                    <button type="submit" class="btn btn-gold w-100 py-3 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2">
                        <i class="bi bi-bag-check-fill"></i>
                        <span>បញ្ជាក់ការកុម្ម៉ង់ (Place Order)</span>
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="bi bi-clock-history text-warning"></i> រយៈពេលដឹកជញ្ជូនប្រហែល: 20-30 នាទី</small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function toggleAddressSelection(radio, addressText) {
        document.querySelectorAll('.address-choice-card').forEach(c => {
            c.classList.remove('border-warning', 'bg-warning', 'bg-opacity-10');
            c.classList.add('border');
        });
        const parentCard = radio.closest('.address-choice-card');
        parentCard.classList.remove('border');
        parentCard.classList.add('border-warning', 'bg-warning', 'bg-opacity-10');

        if (addressText) {
            document.getElementById('delivery_address').value = addressText;
        } else {
            document.getElementById('delivery_address').value = '';
            document.getElementById('delivery_address').focus();
        }
    }

    function switchPaymentView(method) {
        document.getElementById('payment-view-cod').classList.add('d-none');
        document.getElementById('payment-view-abapay').classList.add('d-none');
        document.getElementById('payment-view-card').classList.add('d-none');

        document.querySelectorAll('.payment-option-card').forEach(c => {
            c.classList.remove('border-warning', 'bg-warning', 'bg-opacity-10');
            c.classList.add('border');
            c.style.borderWidth = '1px';
        });

        const activeRadio = document.querySelector(`input[name="payment_method"][value="${method}"]`);
        if (activeRadio) {
            const activeCard = activeRadio.closest('.payment-option-card');
            activeCard.classList.remove('border');
            activeCard.classList.add('border-warning', 'bg-warning', 'bg-opacity-10');
            activeCard.style.borderWidth = '2px';
        }

        if (method === 'cod') {
            document.getElementById('payment-view-cod').classList.remove('d-none');
        } else if (method === 'abapay') {
            document.getElementById('payment-view-abapay').classList.remove('d-none');
        } else if (method === 'card') {
            document.getElementById('payment-view-card').classList.remove('d-none');
        }
    }
</script>
@endpush
