@extends('layouts.owner')

@section('title', 'Add New Dish - Owner Panel')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <a href="{{ route('owner.foods.index') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1 mb-1">
            <i class="bi bi-arrow-left"></i> Back to Menu
        </a>
        <h3 class="fw-bold mb-0">Add New Dish</h3>
        <p class="text-muted small mb-0">Create a new item for your restaurant catalog</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <form action="{{ route('owner.foods.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label for="name" class="form-label small fw-semibold">Dish Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Signature Truffle Burger">
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="category_id" class="form-label small fw-semibold">Category</label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="price" class="form-label small fw-semibold">Price ($ USD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">$</span>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                   id="price" name="price" value="{{ old('price') }}" required placeholder="12.50">
                        </div>
                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="preparation_time" class="form-label small fw-semibold">Estimated Prep Time (Minutes)</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('preparation_time') is-invalid @enderror"
                                   id="preparation_time" name="preparation_time" value="{{ old('preparation_time', 15) }}" required placeholder="15">
                            <span class="input-group-text bg-white">mins</span>
                        </div>
                        @error('preparation_time') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label small fw-semibold">Description & Ingredients</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3" placeholder="Describe the ingredients, taste profile, and culinary flair...">{{ old('description') }}</textarea>
                    @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="image_url" class="form-label small fw-semibold">Image URL (Unsplash or Web)</label>
                        <input type="url" class="form-control @error('image_url') is-invalid @enderror"
                               id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/...">
                        <small class="text-muted">Direct image URL for high quality photography</small>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label small fw-semibold">Or Upload Image File</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               id="image" name="image" accept="image/*">
                        <small class="text-muted">PNG, JPG up to 2MB</small>
                    </div>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_available" name="is_available" value="1" checked>
                    <label class="form-check-label fw-semibold text-dark" for="is_available">
                        Immediately Available for Orders
                    </label>
                    <small class="text-muted d-block">Uncheck if dish is currently out of stock or seasonal</small>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('owner.foods.index') }}" class="btn btn-light border rounded-pill px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-white fw-bold shadow-sm">
                        Create Dish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
