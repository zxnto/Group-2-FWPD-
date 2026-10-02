@extends('layouts.app')

@section('title', 'មាសអប្សរា - The Golden Apsara Royal Bistro')

@section('content')
<!-- Hero Restaurant Banner with Royal Khmer Gold Theme -->
<section class="py-4 py-md-5 position-relative overflow-hidden mb-4"
         style="background: linear-gradient(135deg, #1C1714 0%, #2A1F17 50%, #15110E 100%); border-bottom: 3px solid var(--khmer-gold); box-shadow: 0 10px 30px rgba(0,0,0,0.25);">
    <div class="container text-white py-3 position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3"
                     style="background: rgba(212, 175, 55, 0.15); border: 1px solid var(--khmer-gold); color: var(--khmer-gold-light); font-size: 0.85rem;">
                    <i class="bi bi-gem"></i>
                    <span>{{ __('messages.hero_badge') }}</span>
                </div>

                <h1 class="display-5 fw-bold mb-2 font-classic text-white">
                    {{ app()->getLocale() === 'km' ? ($restaurant->name ?? 'ភោជនីយដ្ឋាន មាសអប្សរា') : 'The Golden Apsara Royal Bistro' }}
                </h1>

                <div class="khmer-divider justify-content-start my-2" style="max-width: 320px;">
                    <span>❖</span>
                    <span style="font-size:0.8rem; letter-spacing: 2px;">{{ __('messages.hero_heritage') }}</span>
                    <span>❖</span>
                </div>

                <p class="lead opacity-85 mb-4" style="max-width: 580px; font-size: 1.05rem; line-height: 1.6;">
                    {{ __('messages.hero_desc') }}
                </p>
            </div>
            <div class="col-lg-5 text-center position-relative mt-4 mt-lg-0">
                <div class="p-2 rounded-4 royal-banner-frame position-relative"
                     style="background: var(--khmer-gold-gradient); box-shadow: 0 12px 35px rgba(212,175,55,0.35);">
                    <div id="heroBannerCarousel" class="carousel slide carousel-fade rounded-4 overflow-hidden position-relative"
                         data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="hover">

                        <!-- Top Floating Bar: Category Badge & Page Counter -->
                        <div class="position-absolute top-0 start-0 end-0 p-3 d-flex justify-content-between align-items-center z-3 pointer-events-none">
                            <span class="badge rounded-pill px-3 py-1 shadow-sm d-flex align-items-center gap-1 banner-glass-badge"
                                  style="background: rgba(18, 14, 11, 0.85); border: 1px solid var(--khmer-gold); color: var(--khmer-gold-light); font-size: 0.75rem; backdrop-filter: blur(6px);">
                                <span class="spinner-grow spinner-grow-sm text-warning" style="width: 0.45rem; height: 0.45rem;" role="status"></span>
                                <span id="banner-active-badge">{{ $banners[0]['badge'] ?? '👑 ភោជនីយដ្ឋាន មាសអប្សរា' }}</span>
                            </span>

                            <!-- Page Counter (e.g. 1 / 5) -->
                            <span class="badge rounded-pill px-2.5 py-1 shadow-sm d-flex align-items-center gap-1 banner-glass-badge"
                                  style="background: rgba(18, 14, 11, 0.85); border: 1px solid rgba(212,175,55,0.4); color: #fff; font-size: 0.75rem; backdrop-filter: blur(6px);">
                                <i class="bi bi-collection-play text-warning"></i>
                                <span id="banner-current-page">1</span>&nbsp;/&nbsp;<span id="banner-total-pages">{{ count($banners ?? [1]) }}</span>
                            </span>
                        </div>

                        <!-- Carousel Indicators (Pill Dots) -->
                        <div class="carousel-indicators mb-2 z-3">
                            @foreach($banners as $index => $banner)
                                <button type="button" data-bs-target="#heroBannerCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"
                                        style="width: {{ $index === 0 ? '24px' : '8px' }}; height: 8px; border-radius: 4px; background-color: var(--khmer-gold); border: none; opacity: {{ $index === 0 ? '1' : '0.45' }}; transition: all 0.3s ease;">
                                </button>
                            @endforeach
                        </div>

                        <!-- Carousel Slides -->
                        <div class="carousel-inner rounded-4" style="height: 295px;">
                            @foreach($banners as $index => $banner)
                                <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}"
                                     data-badge="{{ $banner['badge'] }}"
                                     data-slide-index="{{ $index + 1 }}">
                                    <div class="position-relative h-100 w-100 overflow-hidden">
                                        <img src="{{ $banner['image'] }}"
                                             alt="{{ $banner['title'] }}"
                                             class="d-block w-100 h-100"
                                             style="object-fit: cover; transition: transform 0.6s ease;">

                                        <!-- Gradient Dark Overlay for Khmer Royal Aesthetic & Readability -->
                                        <div class="position-absolute inset-0 w-100 h-100 top-0 start-0 d-flex flex-column justify-content-end p-3 text-start"
                                             style="background: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(20,15,12,0.3) 35%, rgba(18,13,10,0.88) 75%, rgba(15,10,8,0.98) 100%);">
                                            <div class="pe-4 mb-2">
                                                <h5 class="fw-bold text-white mb-1 font-classic text-truncate" style="font-size: 1.15rem; text-shadow: 0 2px 4px rgba(0,0,0,0.85);">
                                                    {{ $banner['title'] }}
                                                </h5>
                                                <p class="small mb-2 text-truncate" style="color: var(--khmer-gold-light) !important; font-size: 0.85rem; text-shadow: 0 1px 3px rgba(0,0,0,0.85);">
                                                    {!! $banner['subtitle'] !!}
                                                </p>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between pt-1">
                                                @if(!empty($banner['id']))
                                                    <button type="button" class="btn btn-sm btn-gold rounded-pill px-3 py-1 shadow-sm d-inline-flex align-items-center gap-1"
                                                            onclick="openFoodModal({{ $banner['id'] }})">
                                                        <i class="bi {{ $banner['btn_icon'] ?? 'bi-bag-plus' }}"></i>
                                                        <span>{{ $banner['btn_text'] }}</span>
                                                    </button>
                                                @else
                                                    <a href="#food-menu-section" class="btn btn-sm btn-gold rounded-pill px-3 py-1 shadow-sm d-inline-flex align-items-center gap-1">
                                                        <i class="bi {{ $banner['btn_icon'] ?? 'bi-arrow-down-circle' }}"></i>
                                                        <span>{{ $banner['btn_text'] }}</span>
                                                    </a>
                                                @endif

                                                <span class="text-white-50 small d-none d-sm-inline" style="font-size: 0.72rem;">
                                                    <i class="bi bi-arrow-repeat text-warning"></i> ស្វ័យប្រវត្តិ (Auto-switch)
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Previous / Next Controls -->
                        <button class="carousel-control-prev banner-nav-control" type="button" data-bs-target="#heroBannerCarousel" data-bs-slide="prev" aria-label="Previous">
                            <span class="banner-ctrl-circle">
                                <i class="bi bi-chevron-left"></i>
                            </span>
                        </button>
                        <button class="carousel-control-next banner-nav-control" type="button" data-bs-target="#heroBannerCarousel" data-bs-slide="next" aria-label="Next">
                            <span class="banner-ctrl-circle">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </button>

                        <!-- Auto-Switch Progress Bar -->
                        <div class="banner-progress-bar-track position-absolute bottom-0 start-0 w-100 z-3" style="height: 3px; background: rgba(255,255,255,0.25);">
                            <div id="banner-progress-bar" style="height: 100%; width: 0%; background: var(--khmer-gold); transition: width 4s linear;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5" id="food-menu-section">
    <!-- Category Filter Bar with Khmer Motif -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="fw-bold mb-0 font-classic text-dark">
                <i class="bi bi-flower1 text-gold me-1"></i> {{ __('messages.food_categories') }}
            </h4>
            <small class="text-muted">{{ __('messages.categories_subtitle') }}</small>
        </div>
        <span class="badge badge-gold px-3 py-2 rounded-pill">{{ $foods->total() }} {{ __('messages.dishes_count') }}</span>
    </div>

    <!-- Compact Search Form directly under Food Categories (Centered) -->
    <div class="d-flex justify-content-center mb-3">
        <div style="width: 100%; max-width: 340px;">
            <form action="{{ route('home') }}" method="GET">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="input-group shadow-sm" style="border: 1.5px solid var(--khmer-gold); border-radius: 50rem; overflow: hidden; background: #fff; height: 36px;">
                    <span class="input-group-text bg-white border-0 text-muted ps-3 py-0">
                        <i class="bi bi-search text-warning" style="font-size: 0.8rem;"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-0 px-2 py-0"
                           placeholder="{{ __('messages.search_placeholder') }}"
                           value="{{ request('search') }}"
                           style="font-size: 0.8rem; height: 36px;">
                    @if(request('search'))
                        <a href="{{ route('home', array_filter(['category' => request('category')])) }}" class="input-group-text bg-white border-0 text-muted px-2 py-0">
                            <i class="bi bi-x-circle-fill" style="font-size: 0.8rem;"></i>
                        </a>
                    @endif
                    <button class="btn btn-gold px-3 py-0 fw-bold d-flex align-items-center" type="submit" style="font-size: 0.78rem; height: 36px;">
                        {{ __('messages.search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex gap-2 overflow-x-auto pb-3 mb-4 scrollbar-none">
        <a href="{{ route('home', array_filter(['search' => request('search')])) }}"
           class="btn rounded-pill px-4 py-2 text-nowrap d-flex align-items-center gap-2 {{ !request('category') ? 'btn-gold shadow-sm' : 'btn-white bg-white border text-secondary' }}" style="border-color: var(--khmer-cream-border) !important;">
            <i class="bi bi-grid-fill"></i> {{ __('messages.all_dishes') }}
        </a>
        @foreach($categories as $category)
            <a href="{{ route('home', array_filter(['category' => $category->slug, 'search' => request('search')])) }}"
               class="btn rounded-pill px-4 py-2 text-nowrap d-flex align-items-center gap-2 {{ request('category') === $category->slug ? 'btn-gold shadow-sm' : 'btn-white bg-white border text-secondary' }}" style="border-color: var(--khmer-cream-border) !important;">
                <i class="bi {{ $category->icon ?? 'bi-tag' }}"></i> {{ $category->localized_name }}
                <span class="badge {{ request('category') === $category->slug ? 'bg-dark text-warning' : 'bg-light text-muted' }} rounded-pill ms-1" style="font-size: 0.72rem;">
                    {{ $category->foods_count }}
                </span>
            </a>
        @endforeach
    </div>

    <!-- Active Search/Filter indicators -->
    @if(request('search') || request('category'))
        <div class="d-flex align-items-center gap-2 mb-4 bg-white p-3 rounded-4 border" style="border-color: var(--khmer-cream-border) !important;">
            <span class="text-muted small">{{ __('messages.filter') }}:</span>
            @if(request('category'))
                <span class="badge badge-gold">
                    {{ __('messages.category') }}: {{ request('category') }}
                </span>
            @endif
            @if(request('search'))
                <span class="badge bg-light text-dark border">
                    {{ __('messages.keyword') }}: "{{ request('search') }}"
                </span>
            @endif
            <a href="{{ route('home') }}" class="btn btn-sm btn-link text-danger text-decoration-none ms-auto p-0 small">
                <i class="bi bi-x-circle"></i> {{ __('messages.clear_filter') }}
            </a>
        </div>
    @endif

    <!-- Foods Grid -->
    @if($foods->isEmpty())
        <div class="text-center py-5 bg-white rounded-4 border p-5" style="border-color: var(--khmer-cream-border) !important;">
            <i class="bi bi-emoji-neutral text-warning" style="font-size: 3.5rem;"></i>
            <h4 class="mt-3 fw-bold font-classic">{{ __('messages.no_dishes_found') }}</h4>
            <p class="text-muted">{{ __('messages.no_dishes_found_desc') }}</p>
            <a href="{{ route('home') }}" class="btn btn-gold rounded-pill px-4">{{ __('messages.view_all_dishes') }}</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($foods as $food)
                <div class="col">
                    <div class="food-card h-100 d-flex flex-column shadow-sm">
                        <div class="card-img-wrapper" style="cursor: pointer;" onclick="openFoodModal({{ $food->id }})">
                            <img src="{{ $food->image }}" alt="{{ $food->name }}" loading="lazy">
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge badge-gold d-flex align-items-center gap-1 shadow-sm">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span>{{ $food->average_rating }}</span>
                                    <small class="text-muted">({{ $food->reviews_count }})</small>
                                </span>
                            </div>
                            <div class="position-absolute bottom-0 start-0 p-2">
                                <span class="badge bg-dark bg-opacity-75 text-white rounded-pill px-2 py-1" style="font-size: 0.72rem; border: 1px solid rgba(212,175,55,0.4);">
                                    <i class="bi bi-clock me-1 text-warning"></i> {{ $food->preparation_time }} នាទី
                                </span>
                            </div>
                        </div>

                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <div class="text-gold small mb-1 fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                {{ $food->category ? $food->category->localized_name : 'Special' }}
                            </div>

                            <h6 class="fw-bold mb-1 text-dark text-truncate font-classic" style="cursor: pointer;" onclick="openFoodModal({{ $food->id }})">
                                {{ $food->localized_name }}
                            </h6>

                            <p class="text-muted small mb-3 flex-grow-1 line-clamp-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px; font-size: 0.82rem;">
                                {{ $food->localized_description }}
                            </p>

                            <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-auto" style="border-top-color: var(--khmer-cream-border) !important;">
                                <div>
                                    <span class="text-muted small" style="font-size: 0.72rem;">{{ __('messages.price') }}</span>
                                    <div class="fw-bold fs-5 text-dark font-classic">
                                        ${{ number_format($food->price, 2) }}
                                    </div>
                                </div>

                                <button type="button" class="btn btn-gold rounded-pill px-3 py-1 btn-sm d-flex align-items-center gap-1 shadow-sm"
                                        onclick="quickAddToCart({{ $food->id }}, '{{ addslashes($food->localized_name) }}')">
                                    <i class="bi bi-plus-lg"></i>
                                    <span>{{ __('messages.order') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $foods->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Interactive Food Detail & Customization Modal with Khmer Theme -->
<div class="modal fade" id="foodDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden" style="border: 2px solid var(--khmer-gold) !important;">
            <div class="modal-header border-0 pb-0 position-absolute end-0 top-0 p-3" style="z-index: 10;">
                <button type="button" class="btn-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-6 bg-dark position-relative" style="min-height: 290px;">
                        <img id="modal-food-img" src="" alt="Food" class="w-100 h-100 object-fit-cover">
                        <span id="modal-food-rating" class="position-absolute bottom-0 start-0 m-3 badge badge-gold shadow">
                            <i class="bi bi-star-fill text-warning"></i> 5.0
                        </span>
                    </div>
                    <div class="col-md-6 p-4 d-flex flex-column justify-content-between bg-white">
                        <div>
                            <span id="modal-food-category" class="badge badge-gold mb-2">Category</span>
                            <h4 id="modal-food-name" class="fw-bold mb-2 font-classic text-dark">{{ __('messages.dish_name') }}</h4>
                            <p id="modal-food-desc" class="text-muted small mb-3">Description</p>
                            <div class="d-flex align-items-center gap-3 text-muted small mb-3">
                                <div><i class="bi bi-stopwatch text-warning"></i> <span id="modal-food-time">20 {{ __('messages.mins') }}</span></div>
                                <div><i class="bi bi-shield-check text-success"></i> {{ __('messages.fresh_guarantee') }}</div>
                            </div>

                            <hr class="my-3" style="border-color: var(--khmer-cream-border);">

                            <!-- Quantity Selector -->
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-dark">{{ __('messages.quantity') }}</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="input-group" style="width: 130px;">
                                        <button class="btn btn-outline-secondary" type="button" onclick="decrementModalQty()">-</button>
                                        <input type="text" id="modal-qty" class="form-control text-center fw-bold" value="1" readonly>
                                        <button class="btn btn-outline-secondary" type="button" onclick="incrementModalQty()">+</button>
                                    </div>
                                    <div class="text-muted small">
                                        {{ __('messages.total') }}: <span id="modal-total-calc" class="fw-bold text-dark fs-6 font-classic">$0.00</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Special Instructions -->
                            <div class="mb-3">
                                <label for="modal-instructions" class="form-label fw-bold small text-dark">{{ __('messages.special_requests') }}</label>
                                <input type="text" id="modal-instructions" class="form-control form-control-sm" placeholder="{{ __('messages.special_requests_placeholder') }}">
                            </div>

                            <!-- Reviews Preview -->
                            <div id="modal-reviews-section" class="mb-3">
                                <label class="form-label fw-bold small text-dark mb-1">{{ __('messages.customer_reviews') }}</label>
                                <div id="modal-reviews-list" class="small text-muted" style="max-height: 100px; overflow-y: auto;">
                                    ...
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top mt-auto" style="border-top-color: var(--khmer-cream-border) !important;">
                            <input type="hidden" id="modal-food-id">
                            <input type="hidden" id="modal-raw-price">
                            <button type="button" id="modal-add-btn" class="btn btn-gold w-100 py-2 rounded-pill fw-bold shadow-sm d-flex justify-content-between align-items-center px-4"
                                    onclick="submitModalCart()">
                                <span><i class="bi bi-bag-plus me-1"></i> {{ __('messages.add_to_cart') }}</span>
                                <span id="modal-btn-price" class="font-classic">$0.00</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentFoodPrice = 0;
    const foodModal = new bootstrap.Modal(document.getElementById('foodDetailModal'));

    function openFoodModal(foodId) {
        fetch(`/food/${foodId}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('modal-food-id').value = data.id;
                document.getElementById('modal-food-name').innerText = data.name;
                document.getElementById('modal-food-desc').innerText = data.description || 'Delicious dish freshly prepared.';
                document.getElementById('modal-food-category').innerText = data.category;
                document.getElementById('modal-food-img').src = data.image;
                document.getElementById('modal-food-time').innerText = data.preparation_time + ' {{ __('messages.mins') }}';
                document.getElementById('modal-food-rating').innerHTML = `<i class="bi bi-star-fill text-warning"></i> ${data.average_rating} (${data.reviews_count})`;
                document.getElementById('modal-qty').value = 1;
                document.getElementById('modal-instructions').value = '';

                currentFoodPrice = parseFloat(data.price);
                document.getElementById('modal-raw-price').value = currentFoodPrice;
                updateModalTotal();

                // Reviews preview
                const reviewsDiv = document.getElementById('modal-reviews-list');
                if (data.reviews && data.reviews.length > 0) {
                    reviewsDiv.innerHTML = data.reviews.map(r => `
                        <div class="mb-2 pb-2 border-bottom">
                            <div class="d-flex justify-content-between">
                                <span class="fw-semibold text-dark">${r.user_name}</span>
                                <span class="text-warning">${'★'.repeat(r.rating)}${'☆'.repeat(5 - r.rating)}</span>
                            </div>
                            <div>${r.comment || 'Good food!'}</div>
                        </div>
                    `).join('');
                } else {
                    reviewsDiv.innerHTML = '<span class="text-muted fst-italic">{{ __('messages.no_reviews') }}</span>';
                }

                foodModal.show();
            })
            .catch(err => {
                console.error(err);
                alert('Could not load food details.');
            });
    }

    function incrementModalQty() {
        let qty = parseInt(document.getElementById('modal-qty').value) || 1;
        if (qty < 50) {
            document.getElementById('modal-qty').value = qty + 1;
            updateModalTotal();
        }
    }

    function decrementModalQty() {
        let qty = parseInt(document.getElementById('modal-qty').value) || 1;
        if (qty > 1) {
            document.getElementById('modal-qty').value = qty - 1;
            updateModalTotal();
        }
    }

    function updateModalTotal() {
        const qty = parseInt(document.getElementById('modal-qty').value) || 1;
        const total = (currentFoodPrice * qty).toFixed(2);
        document.getElementById('modal-total-calc').innerText = '$' + total;
        document.getElementById('modal-btn-price').innerText = '$' + total;
    }

    function quickAddToCart(foodId, foodName) {
        postCart(foodId, 1, '');
    }

    function submitModalCart() {
        const foodId = document.getElementById('modal-food-id').value;
        const qty = document.getElementById('modal-qty').value;
        const instructions = document.getElementById('modal-instructions').value;
        postCart(foodId, qty, instructions, true);
    }

    function postCart(foodId, quantity, instructions, hideModal = false) {
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                food_id: foodId,
                quantity: quantity,
                instructions: instructions
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                updateCartBadge(data.cart_count);
                if (hideModal) {
                    foodModal.hide();
                }
                showMiniToast(data.message);
            } else {
                alert(data.error || 'Could not add to cart.');
            }
        })
        .catch(err => console.error(err));
    }

    function showMiniToast(msg) {
        let toastEl = document.getElementById('dynamic-toast');
        if (!toastEl) {
            toastEl = document.createElement('div');
            toastEl.id = 'dynamic-toast';
            toastEl.className = 'position-fixed bottom-0 end-0 p-3';
            toastEl.style.zIndex = '9999';
            toastEl.innerHTML = `
                <div class="toast align-items-center text-dark border-0 show shadow-lg" role="alert" style="background: var(--khmer-gold-gradient); border: 1px solid #FFE799 !important;">
                    <div class="d-flex">
                        <div class="toast-body d-flex align-items-center gap-2 fw-semibold">
                            <i class="bi bi-check-circle-fill fs-5"></i> <span id="toast-text"></span>
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;
            document.body.appendChild(toastEl);
        }
        document.getElementById('toast-text').innerText = msg;
        setTimeout(() => {
            const t = toastEl.querySelector('.toast');
            if (t) t.classList.remove('show');
        }, 3000);
    }

    // Auto-Switch Banner Carousel Logic
    const bannerCarouselEl = document.getElementById('heroBannerCarousel');
    if (bannerCarouselEl) {
        const bannerCarousel = new bootstrap.Carousel(bannerCarouselEl, {
            interval: 4000,
            ride: 'carousel',
            pause: 'hover',
            wrap: true
        });

        const activeBadgeEl = document.getElementById('banner-active-badge');
        const currentPageEl = document.getElementById('banner-current-page');
        const progressBarEl = document.getElementById('banner-progress-bar');
        const indicatorBtns = bannerCarouselEl.querySelectorAll('.carousel-indicators button');

        function resetAndStartProgress() {
            if (!progressBarEl) return;
            progressBarEl.style.transition = 'none';
            progressBarEl.style.width = '0%';
            requestAnimationFrame(() => {
                setTimeout(() => {
                    progressBarEl.style.transition = 'width 4s linear';
                    progressBarEl.style.width = '100%';
                }, 40);
            });
        }

        // Start progress bar animation on page load
        resetAndStartProgress();

        // Listen for carousel slide event (triggered immediately when slide transition begins)
        bannerCarouselEl.addEventListener('slide.bs.carousel', function (e) {
            const nextSlide = e.relatedTarget;
            if (activeBadgeEl && nextSlide && nextSlide.dataset.badge) {
                activeBadgeEl.innerText = nextSlide.dataset.badge;
            }
            if (currentPageEl && nextSlide && nextSlide.dataset.slideIndex) {
                currentPageEl.innerText = nextSlide.dataset.slideIndex;
            }

            // Update pill indicator widths
            indicatorBtns.forEach((btn, idx) => {
                if (idx === e.to) {
                    btn.style.width = '24px';
                    btn.style.opacity = '1';
                } else {
                    btn.style.width = '8px';
                    btn.style.opacity = '0.45';
                }
            });

            resetAndStartProgress();
        });

        // Pause/resume progress animation when hovering
        bannerCarouselEl.addEventListener('mouseenter', function () {
            if (progressBarEl) {
                const computedWidth = window.getComputedStyle(progressBarEl).width;
                progressBarEl.style.width = computedWidth;
                progressBarEl.style.transition = 'none';
            }
        });

        bannerCarouselEl.addEventListener('mouseleave', function () {
            resetAndStartProgress();
        });
    }
</script>
@endpush

@push('styles')
<style>
    /* Hero Banner Auto-Switch Carousel Styles */
    .royal-banner-frame {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .royal-banner-frame:hover {
        box-shadow: 0 16px 40px rgba(212, 175, 55, 0.45) !important;
    }
    .banner-nav-control {
        width: 44px;
        opacity: 0.85;
        transition: opacity 0.2s ease;
        z-index: 4;
    }
    .banner-nav-control:hover {
        opacity: 1;
    }
    .banner-ctrl-circle {
        width: 32px;
        height: 32px;
        background: rgba(20, 15, 12, 0.75);
        border: 1px solid var(--khmer-gold);
        color: var(--khmer-gold-light);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);
        transition: all 0.2s ease;
        backdrop-filter: blur(4px);
    }
    .banner-nav-control:hover .banner-ctrl-circle {
        background: var(--khmer-gold);
        color: #1A1307;
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.6);
    }
    .carousel-indicators [data-bs-target] {
        transition: all 0.3s ease;
    }
    .carousel-indicators .active {
        width: 24px !important;
        opacity: 1 !important;
    }
    .pointer-events-none {
        pointer-events: none;
    }
    .pointer-events-none a,
    .pointer-events-none button,
    .pointer-events-none span {
        pointer-events: auto;
    }
</style>
@endpush
