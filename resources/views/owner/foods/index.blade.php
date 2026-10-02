@extends('layouts.owner')

@section('title', 'គ្រប់គ្រងមុខម្ហូប - Food Menu Management')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h4 class="fw-bold mb-1 font-khmer">គ្រប់គ្រងមុខម្ហូប <span class="font-classic text-muted fs-6">(Food Menu Management)</span></h4>
        <p class="text-muted small mb-0 font-khmer">បន្ថែម កែប្រែ បើក/បិទ ភាពអាចកុម្ម៉ង់បាន និងកំណត់តម្លៃមុខម្ហូប</p>
    </div>
    <a href="{{ route('owner.foods.create') }}" class="btn btn-gold rounded-pill px-4 shadow-sm d-inline-flex align-items-center gap-1.5 font-khmer">
        <i class="bi bi-plus-lg"></i> បន្ថែមមុខម្ហូបថ្មី
    </a>
</div>

<!-- Filters bar -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <form action="{{ route('owner.foods.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <span class="input-group-text border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="ស្វែងរកឈ្មោះមុខម្ហូប..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">ប្រភេទមុខម្ហូបទាំងអស់ (All Categories)</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-sm btn-gold w-100 rounded-pill font-khmer">ស្វែងរក</button>
            @if(request('search') || request('category_id'))
                <a href="{{ route('owner.foods.index') }}" class="btn btn-sm btn-light border rounded-pill font-khmer">កំណត់ឡើងវិញ</a>
            @endif
        </div>
    </form>
</div>

<!-- Foods Table -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-header-custom">
                    <tr>
                        <th class="ps-4">មុខម្ហូប (Dish Details)</th>
                        <th>ប្រភេទ</th>
                        <th>តម្លៃ</th>
                        <th>រយះពេលចម្អិន</th>
                        <th>ការវាយតម្លៃ</th>
                        <th>ស្ថានភាពលក់</th>
                        <th class="pe-4 text-end">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.86rem;">
                    @forelse($foods as $food)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $food->image }}" alt="{{ $food->name }}"
                                         class="rounded-3 object-fit-cover shadow-sm border" width="56" height="56">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark font-khmer">{{ $food->name }}</h6>
                                        <small class="text-muted text-truncate d-block" style="max-width: 250px; font-size: 0.74rem;">
                                            {{ $food->description }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary-subtle text-secondary border">
                                    {{ $food->category ? $food->category->name : 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="fw-bold text-dark font-classic fs-6">${{ number_format($food->price, 2) }}</td>
                            <td>
                                <span class="text-muted small"><i class="bi bi-clock me-1 text-warning"></i> {{ $food->preparation_time }} នាទី</span>
                            </td>
                            <td>
                                <span class="badge stat-icon-gold border">
                                    <i class="bi bi-star-fill text-warning me-1"></i> {{ $food->average_rating }} ({{ $food->reviews_count }})
                                </span>
                            </td>
                            <td>
                                <!-- Quick Toggle Availability Form -->
                                <form action="{{ route('owner.foods.toggle', $food->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm rounded-pill px-3 py-1 fw-semibold font-khmer {{ $food->is_available ? 'badge-delivered' : 'badge-cancelled' }}"
                                            title="ចុចដើម្បីផ្លាស់ប្តូរភាពអាចកុម្ម៉ង់បាន">
                                        <i class="bi {{ $food->is_available ? 'bi-check-circle-fill' : 'bi-dash-circle-fill' }}"></i>
                                        {{ $food->is_available ? 'មានលក់' : 'អស់ស្តុក' }}
                                    </button>
                                </form>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('owner.foods.edit', $food->id) }}" class="btn btn-light border" title="កែប្រែ">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('owner.foods.destroy', $food->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('តើអ្នកពិតជាចង់លុបមុខម្ហូប \'{{ addslashes($food->name) }}\' នេះមែនទេ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger" title="លុប">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted font-khmer">
                                មិនទាន់មានមុខម្ហូបនៅឡើយទេ។ <a href="{{ route('owner.foods.create') }}">បន្ថែមមុខម្ហូបដំបូងរបស់អ្នក!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    {{ $foods->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection

