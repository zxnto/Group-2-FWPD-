@extends('layouts.app')

@section('title', 'ចូលប្រើប្រាស់គណនី - Sign In - Golden Apsara Royal Bistro')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white" style="border: 2px solid var(--khmer-gold) !important; box-shadow: 0 20px 50px rgba(0,0,0,0.12) !important;">
                <div class="row g-0">
                    <!-- Left Column: Royal Khmer Showcase Banner -->
                    <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-between p-4 p-xl-5 text-white position-relative"
                         style="background: linear-gradient(135deg, #1C1714 0%, #2A1F17 50%, #15110E 100%); border-right: 2px solid var(--khmer-gold);">
                        
                        <!-- Decorative Background Pattern -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10 pointer-events-none"
                             style="background-image: radial-gradient(var(--khmer-gold) 1px, transparent 0); background-size: 20px 20px;"></div>

                        <div class="position-relative" style="z-index: 2;">
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3"
                                 style="background: rgba(212, 175, 55, 0.18); border: 1.5px solid #E5C365; color: #FFE699; font-size: 0.82rem; font-weight: 600;">
                                <i class="bi bi-gem text-warning"></i>
                                <span>មរតកម្ហូបខ្មែរបុរាណ &bull; Royal Heritage</span>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="brand-emblem" style="width: 52px; height: 52px; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.45); border: 1.5px solid #FFE28A;">
                                    <i class="bi bi-flower1 fs-2"></i>
                                </span>
                                <div>
                                    <h4 class="fw-bold mb-0 font-classic text-white" style="letter-spacing: 1.5px; text-shadow: 0 2px 4px rgba(0,0,0,0.6);">GOLDEN APSARA</h4>
                                    <small style="color: #FFDF73; font-size: 0.85rem; font-weight: 500;">ភោជនីយដ្ឋាន មាសអប្សរា</small>
                                </div>
                            </div>

                            <div class="khmer-divider justify-content-start my-3" style="color: #F5D061;">
                                <span style="color: #F5D061;">❖</span>
                                <span style="font-size: 0.85rem; font-weight: 600; color: #FFE28A; white-space: nowrap;">រសជាតិវិមានស្តេច &bull; Royal Dining</span>
                                <span style="color: #F5D061;">❖</span>
                            </div>

                            <p class="mb-4" style="color: #F3EBDD; line-height: 1.85; font-size: 0.92rem; text-shadow: 0 1px 2px rgba(0,0,0,0.4);">
                                សូមស្វាគមន៍មកកាន់ប្រព័ន្ធបញ្ជាទិញ និងដឹកជញ្ជូនម្ហូបប្រណិត។ បទពិសោធន៍នៃការទទួលទានអាហារដ៏មានឱជារស ចម្អិនពីគ្រឿងផ្សំធម្មជាតិខ្មែរពិតៗ និងដឹកជញ្ជូនយ៉ាងរហ័សទាន់ចិត្ត។
                            </p>

                            <!-- Highlights -->
                            <div class="d-flex flex-column gap-3 mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                         style="width: 40px; height: 40px; background: rgba(212,175,55,0.22); border: 1.5px solid #E5C365; color: #FFE699; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <i class="bi bi-award-fill fs-6"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold font-classic" style="color: #FFFFFF; font-size: 0.95rem;">ម្ហូបខ្មែររសជាតិដើមពិតៗ</div>
                                        <small style="color: #D6CCC2; font-size: 0.82rem; font-weight: 500;">Authentic Royal Recipes & Fresh Kroeung</small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                         style="width: 40px; height: 40px; background: rgba(212,175,55,0.22); border: 1.5px solid #E5C365; color: #FFE699; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <i class="bi bi-lightning-charge-fill fs-6"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold font-classic" style="color: #FFFFFF; font-size: 0.95rem;">ដឹកជញ្ជូនរហ័ស ២០-៣០ នាទី</div>
                                        <small style="color: #D6CCC2; font-size: 0.82rem; font-weight: 500;">Fast Express Delivery in Phnom Penh</small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                                         style="width: 40px; height: 40px; background: rgba(212,175,55,0.22); border: 1.5px solid #E5C365; color: #FFE699; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                        <i class="bi bi-qr-code-scan fs-6"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold font-classic" style="color: #FFFFFF; font-size: 0.95rem;">ទូទាត់រហ័សតាម ABA KHQR</div>
                                        <small style="color: #D6CCC2; font-size: 0.82rem; font-weight: 500;">Instant Bakong / ABA Pay Integration</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer note in sidebar -->
                        <div class="position-relative pt-3 border-top border-warning border-opacity-25" style="z-index: 2;">
                            <small style="color: #E2D9CF; font-size: 0.82rem; font-weight: 500;">
                                <i class="bi bi-shield-check text-warning me-1"></i> ប្រព័ន្ធដំណើរការប្រកបដោយសុវត្ថិភាពខ្ពស់ &bull; 100% Secure System
                            </small>
                        </div>
                    </div>

                    <!-- Right Column: Royal Sign-In Form -->
                    <div class="col-lg-7 p-4 p-md-5 d-flex flex-column justify-content-between bg-white">
                        <div>
                            <!-- Header for mobile & desktop -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h3 class="fw-bold mb-1 font-classic text-dark">ចូលប្រើប្រាស់ (Sign In)</h3>
                                    <p class="small mb-0" style="color: #5C5248; font-weight: 500;">បញ្ចូលគណនីរបស់អ្នកដើម្បីបន្ត &bull; Access your dining account</p>
                                </div>
                                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-size: 0.78rem;">
                                    <i class="bi bi-house-door me-1"></i> ហាង (Store)
                                </a>
                            </div>

                            <!-- 1-Click Demo Login Box (For University Presentation) -->
                            <div class="p-3 mb-4 rounded-4 border bg-light" style="border: 1.5px solid var(--khmer-cream-border) !important;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold small text-dark font-classic d-flex align-items-center gap-1">
                                        <i class="bi bi-magic text-warning fs-5"></i> ចូលប្រើរហ័សសម្រាប់ Demo (Quick Sign-in):
                                    </span>
                                    <span class="badge badge-gold" style="font-size: 0.68rem;">1-Click</span>
                                </div>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <a href="{{ route('demo.login', 'customer') }}"
                                           class="card p-2 text-decoration-none border h-100 rounded-3 demo-role-card transition-all"
                                           style="border-color: rgba(212,175,55,0.4) !important;">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop"
                                                     class="rounded-circle border border-warning" width="36" height="36" alt="Alex">
                                                <div class="overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.82rem;">អតិថិជន (Customer)</div>
                                                    <small class="text-truncate d-block" style="color: #63584E; font-size: 0.74rem;">Sokha Alex</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{ route('demo.login', 'owner') }}"
                                           class="card p-2 text-decoration-none border h-100 rounded-3 demo-role-card transition-all"
                                           style="border-color: rgba(212,175,55,0.4) !important; background: rgba(212,175,55,0.06);">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=100&h=100&fit=crop"
                                                     class="rounded-circle border border-warning" width="36" height="36" alt="Marco">
                                                <div class="overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate" style="font-size: 0.82rem;">ម្ចាស់ហាង (Owner)</div>
                                                    <small class="text-truncate d-block" style="color: #63584E; font-size: 0.74rem;">Lokru Marco</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center small mb-4 position-relative">
                                <span class="bg-white px-3 position-relative fw-semibold" style="z-index: 1; font-size: 0.8rem; color: #6D6257;">
                                    ឬចូលដោយប្រើអ៊ីមែលផ្ទាល់ខ្លួន
                                </span>
                                <hr class="position-absolute top-50 start-0 w-100 my-0" style="z-index: 0; border-color: var(--khmer-cream-border);">
                            </div>

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold small text-dark">អាសយដ្ឋានអ៊ីមែល (Email Address)</label>
                                    <div class="input-group input-group-lg" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                        <span class="input-group-text bg-white border-0 text-muted ps-3">
                                            <i class="bi bi-envelope text-gold fs-5"></i>
                                        </span>
                                        <input type="email" class="form-control border-0 px-2 fs-6 @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}" required autofocus
                                               placeholder="name@example.com"
                                               style="box-shadow: none;">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="password" class="form-label fw-semibold small text-dark mb-0">ពាក្យសម្ងាត់ (Password)</label>
                                        <small style="color: #63584E; font-size: 0.78rem;">ពាក្យសម្ងាត់គំរូ: <code class="text-dark bg-warning-subtle px-1 py-0.5 rounded border border-warning-subtle">password123</code></small>
                                    </div>
                                    <div class="input-group input-group-lg" style="border-radius: 12px; overflow: hidden; border: 1.5px solid rgba(212,175,55,0.35);">
                                        <span class="input-group-text bg-white border-0 text-muted ps-3">
                                            <i class="bi bi-lock text-gold fs-5"></i>
                                        </span>
                                        <input type="password" class="form-control border-0 px-2 fs-6 @error('password') is-invalid @enderror"
                                               id="password" name="password" required placeholder="••••••••"
                                               style="box-shadow: none;">
                                        <button class="btn btn-white bg-white border-0 text-muted pe-3" type="button" onclick="togglePasswordVisibility()">
                                            <i class="bi bi-eye" id="password-toggle-icon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked style="border-color: var(--khmer-gold);">
                                        <label class="form-check-label small" for="remember" style="color: #4A3E37; font-weight: 500;">
                                            ចងចាំខ្ញុំ (Remember me)
                                        </label>
                                    </div>
                                    <span class="text-gold small fw-semibold">សុវត្ថិភាពខ្ពស់</span>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 py-3 rounded-pill fw-bold shadow-sm font-classic fs-6 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                                    <span>ចូលប្រើប្រាស់ (Sign In)</span>
                                </button>
                            </form>
                        </div>

                        <!-- Bottom signup link -->
                        <div class="text-center mt-4 pt-3 border-top" style="border-top-color: var(--khmer-cream-border) !important;">
                            <p class="small mb-0" style="color: #5C5248;">
                                មិនទាន់មានគណនីមែនទេ? (Don't have an account?)
                                <a href="{{ route('register') }}" class="text-gold fw-bold text-decoration-none ms-1 font-classic">
                                    ចុះឈ្មោះឥឡូវនេះ (Sign Up) &rarr;
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

@push('styles')
<style>
    .demo-role-card:hover {
        background: rgba(212,175,55,0.12) !important;
        border-color: var(--khmer-gold) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(212,175,55,0.2);
    }
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px #FFFBF0 inset !important;
        -webkit-text-fill-color: #2D2723 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('password-toggle-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endpush
