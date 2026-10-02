@extends('layouts.owner')

@section('title', 'Food Categories - Owner Panel')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold mb-1">Food Categories</h3>
        <p class="text-muted small mb-0">Organize your menu into appetizing cuisine types and categories</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        <i class="bi bi-plus-lg me-1"></i> Add Category
    </button>
</div>

<div class="row g-4">
    @foreach($categories as $category)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden">
                <div class="position-relative" style="height: 140px; background: #ECEFF1;">
                    @if($category->image)
                        <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-100 h-100 object-fit-cover">
                    @endif
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-white text-dark shadow-sm rounded-pill px-3 py-2 fw-semibold">
                            <i class="bi {{ $category->icon ?? 'bi-tag' }} text-danger me-1"></i> {{ $category->name }}
                        </span>
                    </div>
                </div>

                <div class="p-3 d-flex flex-column flex-grow-1">
                    <p class="text-muted small mb-3 flex-grow-1">
                        {{ $category->description ?? 'Delicious curated dishes.' }}
                    </p>

                    <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill">
                            {{ $category->foods_count }} Dishes Listed
                        </span>

                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#editCategoryModal-{{ $category->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('owner.categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete category \'{{ addslashes($category->name) }}\'? Dishes will be set to uncategorized.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light border text-danger">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <form action="{{ route('owner.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0">
                            <h5 class="fw-bold">Edit Category: {{ $category->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Category Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Icon Class (Bootstrap Icons)</label>
                                <input type="text" name="icon" class="form-control" value="{{ $category->icon }}" placeholder="bi-fire">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Cover Image URL</label>
                                <input type="url" name="image" class="form-control" value="{{ $category->image }}" placeholder="https://images.unsplash.com/...">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="2">{{ $category->description }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 text-white">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <form action="{{ route('owner.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Add New Food Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Salads & Bowls" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Icon Class (Bootstrap Icons)</label>
                        <input type="text" name="icon" class="form-control" placeholder="e.g. bi-egg-fried, bi-cup-straw, bi-fire" value="bi-tag">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Cover Image URL</label>
                        <input type="url" name="image" class="form-control" placeholder="https://images.unsplash.com/..." value="https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400&fit=crop">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Fresh vibrant culinary delights..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 text-white">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
