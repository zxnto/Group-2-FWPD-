@extends('layouts.app')

@section('title', 'កន្ត្រកទំនិញ - Your Cart - Foodie Express')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1 font-classic text-dark">កន្ត្រកទំនិញ (Shopping Cart)</h2>
            <p class="text-muted small mb-0">ពិនិត្យមើលមុខម្ហូបដែលអ្នកបានជ្រើសរើស &bull; Review your selected dishes</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-gold rounded-pill px-3 py-1 btn-sm">
            <i class="bi bi-arrow-left me-1"></i> បន្ថែមម្ហូប (Add More)
        </a>
    </div>

    @if(empty($cart))
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 p-4 bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
            <div class="py-4">
                <i class="bi bi-cart-x text-warning" style="font-size: 4rem;"></i>
                <h4 class="fw-bold mt-3 font-classic">មិនទាន់មានម្ហូបក្នុងកន្ត្រកទេ (Your cart is empty)</h4>
                <p class="text-muted mb-4">លោកអ្នកមិនទាន់បានជ្រើសរើសមុខម្ហូបណាមួយនៅឡើយទេ។ សូមចូលទៅកាន់បញ្ជីមុខម្ហូប!</p>
                <a href="{{ route('home') }}" class="btn btn-gold rounded-pill px-4 py-2 fw-bold shadow-sm">
                    <i class="bi bi-flower1 me-1"></i> មើលមុខម្ហូបថ្ងៃនេះ (Browse Menu)
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            <!-- Items Table -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white" style="border: 1px solid var(--khmer-cream-border) !important;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center" style="border-bottom-color: var(--khmer-cream-border) !important;">
                        <span class="fw-bold text-dark font-classic">មុខម្ហូបដែលបានជ្រើសរើស ({{ count($cart) }} Items)</span>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none p-0" onclick="return confirm('Clear all items from your cart?')">
                                <i class="bi bi-trash3 me-1"></i> សម្អាតកន្ត្រក (Clear Cart)
                            </button>
                        </form>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4">មុខម្ហូប (Item)</th>
                                        <th>តម្លៃ (Price)</th>
                                        <th class="text-center" style="width: 140px;">ចំនួន (Qty)</th>
                                        <th class="text-end">សរុប (Total)</th>
                                        <th class="pe-4 text-end">សកម្មភាព</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $item)
                                        <tr id="cart-row-{{ $item['id'] }}">
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                         class="rounded-3 object-fit-cover shadow-sm border border-warning border-opacity-25" width="60" height="60">
                                                    <div>
                                                        <h6 class="fw-bold mb-0 text-dark font-classic">{{ $item['name'] }}</h6>
                                                        @if(!empty($item['instructions']))
                                                            <small class="text-muted"><i class="bi bi-chat-left-text me-1"></i> កំណត់ចំណាំ: {{ $item['instructions'] }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-semibold text-muted font-classic">
                                                ${{ number_format($item['price'], 2) }}
                                            </td>
                                            <td class="text-center">
                                                <div class="input-group input-group-sm mx-auto" style="width: 105px;">
                                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="food_id" value="{{ $item['id'] }}">
                                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                                        <button class="btn btn-outline-secondary btn-sm" type="submit" style="border-radius: 6px 0 0 6px;">-</button>
                                                    </form>
                                                    <input type="text" class="form-control text-center fw-bold bg-light p-0" value="{{ $item['quantity'] }}" readonly>
                                                    <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="food_id" value="{{ $item['id'] }}">
                                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                                        <button class="btn btn-outline-secondary btn-sm" type="submit" style="border-radius: 0 6px 6px 0;">+</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-end fw-bold text-dark fs-6 font-classic">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </td>
                                            <td class="pe-4 text-end">
                                                <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="food_id" value="{{ $item['id'] }}">
                                                    <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle p-2" title="Remove Item">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 80px; border: 1.5px solid var(--khmer-gold) !important;">
                    <h5 class="fw-bold mb-3 font-classic text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-receipt text-gold"></i> សង្ខេបការបញ្ជាទិញ (Summary)
                    </h5>

                    <div class="d-flex justify-content-between text-muted mb-2">
                        <span>តម្លៃមុខម្ហូប (Subtotal)</span>
                        <span class="fw-semibold text-dark font-classic">${{ $totals['subtotal'] }}</span>
                    </div>

                    <div class="d-flex justify-content-between text-muted mb-2">
                        <span>ថ្លៃដឹកជញ្ជូន (Delivery Fee)</span>
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

                    @auth
                        <a href="{{ route('checkout.index') }}" class="btn btn-gold w-100 py-3 rounded-pill fw-bold shadow-sm d-flex justify-content-center align-items-center gap-2">
                            <span>បន្តទៅទូទាត់ប្រាក់ (Checkout)</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-gold w-100 py-3 rounded-pill fw-bold shadow-sm mb-2">
                            ចូលគណនីដើម្បីទូទាត់ (Sign In)
                        </a>
                        <small class="text-muted text-center d-block">ឬប្រើប្រាស់ Demo Login ខាងលើ</small>
                    @endauth

                    <div class="mt-4 p-3 bg-light rounded-4 text-muted small border" style="border-color: var(--khmer-cream-border) !important;">
                        <div class="d-flex align-items-center gap-2 mb-1 text-dark fw-bold">
                            <i class="bi bi-shield-check text-success fs-5"></i> សុវត្ថិភាពក្នុងការទូទាត់
                        </div>
                        គាំទ្រការទូទាត់តាម <strong>ABA Pay KHQR</strong>, កាតធនាគារ និងទូទាត់ពេលដឹកជញ្ជូនដល់កន្លែង (COD)។
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
