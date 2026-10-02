@if ($paginator->hasPages())
    <nav class="d-flex flex-wrap align-items-center justify-content-between p-3 pagination-container rounded-4 shadow-sm border mt-4"
         style="gap: 1rem;">
        
        {{-- Mobile compact pagination --}}
        <div class="d-flex justify-content-between align-items-center w-100 d-sm-none">
            @if ($paginator->onFirstPage())
                <span class="btn btn-sm btn-light border disabled rounded-pill px-3 opacity-50">
                    <i class="bi bi-chevron-left me-1"></i> {{ __('messages.filter') === 'តម្រង' ? 'មុន' : 'Prev' }}
                </span>
            @else
                <a class="btn btn-sm btn-outline-gold rounded-pill px-3" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="bi bi-chevron-left me-1"></i> {{ __('messages.filter') === 'តម្រង' ? 'មុន' : 'Prev' }}
                </a>
            @endif

            <span class="small fw-bold text-body font-classic">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a class="btn btn-sm btn-gold rounded-pill px-3" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    {{ __('messages.filter') === 'តម្រង' ? 'បន្ទាប់' : 'Next' }} <i class="bi bi-chevron-right ms-1"></i>
                </a>
            @else
                <span class="btn btn-sm btn-light border disabled rounded-pill px-3 opacity-50">
                    {{ __('messages.filter') === 'តម្រង' ? 'បន្ទាប់' : 'Next' }} <i class="bi bi-chevron-right ms-1"></i>
                </span>
            @endif
        </div>

        {{-- Desktop / Tablet full classic Khmer gold pagination --}}
        <div class="d-none d-sm-flex align-items-center justify-content-between w-100">
            <div class="small text-muted d-flex align-items-center gap-2">
                <span class="badge badge-gold px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                    <i class="bi bi-flower1 me-1"></i> {{ __('messages.filter') === 'តម្រង' ? 'ទំព័រ (Page)' : 'Page' }} {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                </span>
                <span>
                    @if(app()->getLocale() === 'km')
                        បង្ហាញ <strong class="text-gold font-classic">{{ $paginator->firstItem() }}</strong> ដល់
                        <strong class="text-gold font-classic">{{ $paginator->lastItem() }}</strong> នៃ
                        <strong class="text-gold font-classic">{{ $paginator->total() }}</strong> មុខម្ហូប
                    @else
                        Showing <strong class="text-gold font-classic">{{ $paginator->firstItem() }}</strong> to
                        <strong class="text-gold font-classic">{{ $paginator->lastItem() }}</strong> of
                        <strong class="text-gold font-classic">{{ $paginator->total() }}</strong> dishes
                    @endif
                </span>
            </div>

            <div>
                <ul class="pagination pagination-khmer mb-0 gap-1 d-flex align-items-center">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link page-link-disabled rounded-3 px-3 py-1 border-0">
                                <i class="bi bi-chevron-left"></i> {{ app()->getLocale() === 'km' ? 'មុន' : 'Prev' }}
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link page-link-custom rounded-3 px-3 py-1 fw-semibold" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                                <i class="bi bi-chevron-left"></i> {{ app()->getLocale() === 'km' ? 'មុន' : 'Prev' }}
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link rounded-3 px-2 py-1 text-gold fw-bold border-0 bg-transparent">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link page-link-active rounded-3 px-3 py-1 font-classic fw-bold shadow-sm">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link page-link-custom rounded-3 px-3 py-1 font-classic fw-semibold" href="{{ $url }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link page-link-next rounded-3 px-3 py-1 fw-bold shadow-sm" href="{{ $paginator->nextPageUrl() }}" rel="next">
                                {{ app()->getLocale() === 'km' ? 'បន្ទាប់ (Next)' : 'Next' }} <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link page-link-disabled rounded-3 px-3 py-1 border-0">
                                {{ app()->getLocale() === 'km' ? 'បន្ទាប់' : 'Next' }} <i class="bi bi-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
