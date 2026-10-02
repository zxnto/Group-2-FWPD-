@extends('layouts.owner')

@section('title', 'Edit Dish - ' . $food->name)

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <a href="{{ route('owner.foods.index') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1 mb-1">
            <i class="bi bi-arrow-left"></i> Back to Menu
        </a>
        <h3 class="fw-bold mb-0">Edit Dish: {{ $food->name }}</h3>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
            <form action="{{ route('owner.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label for="name" class="form-label small fw-semibold">Dish Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $food->name) }}" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="category_id" class="form-label small fw-semibold">Category</label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $food->category_id) == $category->id ? 'selected' : '' }}>
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
                                   id="price" name="price" value="{{ old('price', $food->price) }}" required>
                        </div>
                        @error('price') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="preparation_time" class="form-label small fw-semibold">Prep Time (Minutes)</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('preparation_time') is-invalid @enderror"
                                   id="preparation_time" name="preparation_time" value="{{ old('preparation_time', $food->preparation_time) }}" required>
                            <span class="input-group-text bg-white">mins</span>
                        </div>
                        @error('preparation_time') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label small fw-semibold">Description & Ingredients</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3">{{ old('description', $food->description) }}</textarea>
                    @error('description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Current image preview -->
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-3 border">
                    <img src="{{ $food->image }}" alt="{{ $food->name }}" class="rounded-3 object-fit-cover shadow-sm" width="70" height="70">
                    <div>
                        <div class="fw-bold small text-dark">Current Image</div>
                        <small class="text-muted text-break">{{ $food->image }}</small>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="image_url" class="form-label small fw-semibold">Replace with Image URL</label>
                        <input type="url" class="form-control" id="image_url" name="image_url" value="{{ old('image_url', $food->image) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label small fw-semibold">Or Upload New Image File</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_available" name="is_available" value="1" {{ $food->is_available ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold text-dark" for="is_available">
                        Available for Orders
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('owner.foods.index') }}" class="btn btn-light border rounded-pill px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 text-white fw-bold shadow-sm">
                        Update Dish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
