@extends('layouts.owner')

@section('title', 'ប្រភេទមុខម្ហូប - Food Categories')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h4 class="fw-bold mb-1 font-khmer">ប្រភេទមុខម្ហូប <span class="font-classic text-muted fs-6">(Food Categories)</span></h4>
        <p class="text-muted small mb-0 font-khmer">រៀបចំប្រភេទមុខម្ហូប និងមុខម្ហូបតាមក្រុមសម្រាប់ភោជនីយដ្ឋាន</p>
    </div>
    <button type="button" class="btn btn-gold rounded-pill px-4 shadow-sm font-khmer d-inline-flex align-items-center gap-1.5" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
        <i class="bi bi-plus-lg"></i> បន្ថែមប្រភេទថ្មី
    </button>
</div>

<div class="row g-4">
    @foreach($categories as $category)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="position-relative" style="height: 140px; background: rgba(0,0,0,0.06);">
                    @if($category->image)
                        <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-100 h-100 object-fit-cover">
                    @endif
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-body text-dark shadow-sm rounded-pill px-3 py-2 fw-semibold border">
                            <i class="bi {{ $category->icon ?? 'bi-tag' }} text-warning me-1"></i> {{ $category->name }}
                        </span>
                    </div>
                </div>

                <div class="p-3 d-flex flex-column flex-grow-1">
                    <p class="text-muted small mb-3 flex-grow-1 font-khmer">
                        {{ $category->description ?? 'មុខម្ហូបឆ្ងាញ់ៗដែលបានជ្រើសរើសយ៉ាងពិសេស។' }}
                    </p>

                    <div class="d-flex align-items-center justify-content-between pt-2 border-top mt-auto">
                        <span class="badge bg-secondary-subtle text-secondary rounded-pill font-khmer">
                            {{ $category->foods_count }} មុខម្ហូប
                        </span>

                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#editCategoryModal-{{ $category->id }}" title="កែប្រែ">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('owner.categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('លុបប្រភេទមុខម្ហូប \'{{ addslashes($category->name) }}\' នេះ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light border text-danger" title="លុប">
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
                    <form action="{{ route('owner.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0">
                            <h5 class="fw-bold font-khmer">កែប្រែប្រភេទ៖ {{ $category->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold font-khmer">ឈ្មោះប្រភេទ</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold font-khmer">Icon Class (Bootstrap Icons)</label>
                                <input type="text" name="icon" class="form-control" value="{{ $category->icon }}" placeholder="bi-fire">
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold font-khmer">ជ្រើសរើសរូបភាពពីម៉ាស៊ីន (Upload File)</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*">
                                <small class="text-muted" style="font-size: 0.72rem;">ទ្រង់ទ្រាយ PNG, JPG, WEBP ទំហំអតិបរមា 2MB</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold font-khmer">ឬ URL រូបភាព (Or Image URL)</label>
                                <input type="text" name="image" class="form-control" value="{{ $category->image }}" placeholder="https://images.unsplash.com/...">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-semibold font-khmer">ការពិពណ៌នា</label>
                                <textarea name="description" class="form-control" rows="2">{{ $category->description }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-3 font-khmer" data-bs-dismiss="modal">បោះបង់</button>
                            <button type="submit" class="btn btn-gold rounded-pill px-4 font-khmer">រក្សាទុក</button>
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
            <form action="{{ route('owner.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold font-khmer">បន្ថែមប្រភេទមុខម្ហូបថ្មី</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold font-khmer">ឈ្មោះប្រភេទ</label>
                        <input type="text" name="name" class="form-control" placeholder="ឧទាហរណ៍៖ ស៊ុប & ឆា" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold font-khmer">Icon Class (Bootstrap Icons)</label>
                        <input type="text" name="icon" class="form-control" placeholder="ឧទាហរណ៍៖ bi-egg-fried, bi-cup-straw, bi-fire" value="bi-tag">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold font-khmer">ជ្រើសរើសរូបភាពពីម៉ាស៊ីន (Upload File from folder)</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                        <small class="text-muted" style="font-size: 0.72rem;">ទ្រង់ទ្រាយ PNG, JPG, WEBP ទំហំអតិបរមា 2MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold font-khmer">ឬ URL រូបភាព (Or Image URL)</label>
                        <input type="text" name="image" class="form-control" placeholder="https://images.unsplash.com/..." value="https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400&fit=crop">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold font-khmer">ការពិពណ៌នា</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="មុខម្ហូបឈ្ងុយឆ្ងាញ់..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-3 font-khmer" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-gold rounded-pill px-4 font-khmer">បង្កើតប្រភេទ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

