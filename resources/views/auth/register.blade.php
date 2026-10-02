@extends('layouts.app')

@section('title', __('messages.register_title') . ' - Golden Apsara')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white" style="border: 2px solid var(--khmer-gold) !important; box-shadow: 0 20px 50px rgba(0,0,0,0.12) !important;">
                <div class="row g-0">
                    <!-- Left Column: Royal Khmer Showcase Banner -->
                    <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-between p-4 p-xl-5 text-white position-relative"
                         style="background: linear-gradient(135deg, #1C1714 0%, #2A1F17 50%, #15110E 100%); border-right: 2px solid var(--khmer-gold);">
                        
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10 pointer-events-none"
                             style="background-image: radial-gradient(var(--khmer-gold) 1px, transparent 0); background-size: 20px 20px;"></div>

                        <div class="position-relative" style="z-index: 2;">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3"
                                 style="background: rgba(212, 175, 55, 0.18); border: 1.5px solid #E5C365; color: #FFE699; font-size: 0.82rem; font-weight: 600;">
                                <i class="bi bi-person-plus-fill text-warning"></i>
                                <span>{{ __('messages.register_title') }}</span>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="brand-emblem" style="width: 52px; height: 52px; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.45); border: 1.5px solid #FFE28A;">
                                    <i class="bi bi-flower1 fs-2"></i>
                                </span>
                                <div>
                                    <h4 class="fw-bold mb-0 font-classic text-white" style="letter-spacing: 1.5px; text-shadow: 0 2px 4px rgba(0,0,0,0.6);">GOLDEN APSARA</h4>
                                    <small style="color: #FFDF73; font-size: 0.85rem; font-weight: 500;">{{ __('messages.bistro_name') }}</small>
                                </div>
                            </div>

                            <div class="khmer-divider justify-content-start my-3" style="color: #F5D061;">
                                <span style="color: #F5D061;">❖</span>
                                <span style="font-size: 0.85rem; font-weight: 600; color: #FFE28A; white-space: nowrap;">{{ __('messages.member_benefits') }}</span>
                                <span style="color: #F5D061;">❖</span>
                            </div>

                            <p class="mb-4" style="color: #F3EBDD; line-height: 1.85; font-size: 0.92rem; text-shadow: 0 1px 2px rgba(0,0,0,0.4);">
                                {{ __('messages.welcome_register_desc') }}
                            </p>

                            <div class="d-flex flex-column gap-3 mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                         style="width: 40px; height: 40px; background: rgba(212,175,55,0.22); border: 1.5px solid #E5C365; color: #FFE699; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <i class="bi bi-bookmark-heart-fill fs-6"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold font-classic" style="color: #FFFFFF; font-size: 0.95rem;">{{ __('messages.save_address') }}</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                         style="width: 40px; height: 40px; background: rgba(212,175,55,0.22); border: 1.5px solid #E5C365; color: #FFE699; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <i class="bi bi-clock-history fs-6"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold font-classic" style="color: #FFFFFF; font-size: 0.95rem;">{{ __('messages.live_tracking') }}</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                         style="width: 40px; height: 40px; background: rgba(212,175,55,0.22); border: 1.5px solid #E5C365; color: #FFE699; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <i class="bi bi-stars fs-6"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold font-classic" style="color: #FFFFFF; font-size: 0.95rem;">{{ __('messages.review_feedback') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative pt-3 border-top border-warning border-opacity-25" style="z-index: 2;">
                            <small style="color: #E2D9CF; font-size: 0.82rem; font-weight: 500;">
                                <i class="bi bi-shield-check text-warning me-1"></i> {{ __('messages.secure_system') }}
                            </small>
                        </div>
                    </div>

                    <!-- Right Column: Registration Form -->
                    <div class="col-lg-7 p-4 p-md-5 d-flex flex-column justify-content-between bg-white">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h3 class="fw-bold mb-1 font-classic text-dark">{{ __('messages.register_title') }}</h3>
                                    <p class="small mb-0" style="color: #5C5248; font-weight: 500;">{{ __('messages.create_customer_acc') }}</p>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-gold rounded-pill px-3" style="font-size: 0.78rem;">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('messages.login') }}
                                </a>
                            </div>

                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold small text-dark">{{ __('messages.full_name') }}</label>
                                    <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                        <span class="input-group-text bg-white border-0 text-muted ps-3">
                                            <i class="bi bi-person text-gold fs-5"></i>
                                        </span>
                                        <input type="text" class="form-control border-0 px-2 @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name') }}" required
                                               placeholder="Sokha Alex" style="box-shadow: none;">
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-semibold small text-dark">{{ __('messages.email_address') }}</label>
                                        <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                            <span class="input-group-text bg-white border-0 text-muted ps-3">
                                                <i class="bi bi-envelope text-gold"></i>
                                            </span>
                                            <input type="email" class="form-control border-0 px-2 @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email') }}" required
                                                   placeholder="name@example.com" style="box-shadow: none;">
                                        </div>
                                        @error('email')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold small text-dark">{{ __('messages.phone_number') }}</label>
                                        <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                            <span class="input-group-text bg-white border-0 text-muted ps-3">
                                                <i class="bi bi-telephone text-gold"></i>
                                            </span>
                                            <input type="text" class="form-control border-0 px-2 @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone') }}" required
                                                   placeholder="+855 98 000 000" style="box-shadow: none;">
                                        </div>
                                        @error('phone')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label fw-semibold small text-dark">{{ __('messages.default_address') }}</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                              id="address" name="address" rows="2"
                                              placeholder="Street 271, Phnom Penh"
                                              style="border: 1.5px solid rgba(212,175,55,0.35); border-radius: 12px; box-shadow: none;">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label fw-semibold small text-dark">{{ __('messages.password') }}</label>
                                        <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                            <span class="input-group-text bg-white border-0 text-muted ps-3">
                                                <i class="bi bi-lock text-gold"></i>
                                            </span>
                                            <input type="password" class="form-control border-0 px-2 @error('password') is-invalid @enderror"
                                                   id="password" name="password" required placeholder="••••••••"
                                                   style="box-shadow: none;">
                                        </div>
                                        @error('password')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label fw-semibold small text-dark">{{ __('messages.confirm_password') }}</label>
                                        <div class="input-group" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                            <span class="input-group-text bg-white border-0 text-muted ps-3">
                                                <i class="bi bi-shield-lock text-gold"></i>
                                            </span>
                                            <input type="password" class="form-control border-0 px-2"
                                                   id="password_confirmation" name="password_confirmation" required placeholder="••••••••"
                                                   style="box-shadow: none;">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 py-3 rounded-pill fw-bold shadow-sm font-classic fs-6 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-person-check-fill fs-5"></i>
                                    <span>{{ __('messages.register_title') }}</span>
                                </button>
                            </form>
                        </div>

                        <div class="text-center mt-4 pt-3 border-top" style="border-top-color: var(--khmer-cream-border) !important;">
                            <p class="small mb-0" style="color: #5C5248;">
                                {{ __('messages.already_have_account') }}
                                <a href="{{ route('login') }}" class="text-gold fw-bold text-decoration-none ms-1 font-classic">
                                    {{ __('messages.sign_in_now') }} &rarr;
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
