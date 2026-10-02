@extends('layouts.owner')

@section('title', 'Manage Menu Items - Owner Panel')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold mb-1">Food Menu Management</h3>
        <p class="text-muted small mb-0">Add, edit, toggle availability, and set pricing for dishes</p>
    </div>
    <a href="{{ route('owner.foods.create') }}" class="btn btn-primary rounded-pill px-4 text-white shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Add New Dish
    </a>
</div>

<!-- Filters bar -->
<div class="card border-0 shadow-sm rounded-4 p-3 bg-white mb-4">
    <form action="{{ route('owner.foods.index') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Search dish by name..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4">
            <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-sm btn-dark w-100 rounded-pill">Filter</button>
            @if(request('search') || request('category_id'))
                <a href="{{ route('owner.foods.index') }}" class="btn btn-sm btn-light border rounded-pill">Reset</a>
            @endif
        </div>
    </form>
</div>

<!-- Foods Table -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4">Dish Details</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Prep Time</th>
                        <th>Rating</th>
                        <th>Availability</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($foods as $food)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $food->image }}" alt="{{ $food->name }}"
                                         class="rounded-3 object-fit-cover shadow-sm" width="60" height="60">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $food->name }}</h6>
                                        <small class="text-muted text-truncate d-block" style="max-width: 250px;">
                                            {{ $food->description }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $food->category ? $food->category->name : 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="fw-bold text-dark fs-6">${{ number_format($food->price, 2) }}</td>
                            <td>
                                <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ $food->preparation_time }} mins</span>
                            </td>
                            <td>
                                <span class="badge bg-warning-subtle text-dark border">
                                    <i class="bi bi-star-fill text-warning"></i> {{ $food->average_rating }} ({{ $food->reviews_count }})
                                </span>
                            </td>
                            <td>
                                <!-- Quick Toggle Availability Form -->
                                <form action="{{ route('owner.foods.toggle', $food->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm rounded-pill px-3 py-1 fw-semibold {{ $food->is_available ? 'btn-success-subtle text-success border border-success-subtle' : 'btn-danger-subtle text-danger border border-danger-subtle' }}"
                                            title="Click to toggle availability">
                                        <i class="bi {{ $food->is_available ? 'bi-check-circle-fill' : 'bi-dash-circle-fill' }}"></i>
                                        {{ $food->is_available ? 'Available' : 'Out of Stock' }}
                                    </button>
                                </form>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('owner.foods.edit', $food->id) }}" class="btn btn-light border" title="Edit Item">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('owner.foods.destroy', $food->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($food->name) }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border text-danger" title="Delete Item">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                No food items found. <a href="{{ route('owner.foods.create') }}">Create your first dish!</a>
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
