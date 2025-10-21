@extends('layouts.app')

@push('styles')
<style>
    .gallery-container {
        background: #f9f8fa;
        min-height: 100vh;
        padding: 60px 0;
    }

    .gallery-header {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .gallery-header h1 {
        margin: 0;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 42px;
    }

    .gallery-header p {
        margin: 10px 0 0 0;
        color: #6b7280;
        font-size: 16px;
    }

    .btn-add-new {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add-new:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .stat-card .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: white;
        display: block;
    }

    .stat-card .stat-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin-top: 5px;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .gallery-item {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .gallery-item:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .gallery-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 75%; /* 4:3 Aspect Ratio */
        overflow: hidden;
        background: #f3f4f6;
    }

    .gallery-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
        cursor: pointer;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 20px;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-actions {
        display: flex;
        gap: 10px;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .gallery-item:hover .gallery-actions {
        transform: translateY(0);
    }

    .btn-action {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-view {
        background: #3b82f6;
        color: white;
    }

    .btn-view:hover {
        background: #2563eb;
        transform: scale(1.15);
    }

    .btn-download {
        background: #10b981;
        color: white;
    }

    .btn-download:hover {
        background: #059669;
        transform: scale(1.15);
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
        transform: scale(1.15);
    }

    .gallery-info {
        padding: 20px;
    }

    .gallery-title {
        font-weight: 600;
        font-size: 16px;
        color: #1f2937;
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #6b7280;
        font-size: 12px;
        gap: 10px;
    }

    .gallery-date {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .gallery-size {
        background: #f3f4f6;
        padding: 4px 10px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 11px;
    }

    .media-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        backdrop-filter: blur(10px);
        z-index: 10;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .empty-state-icon {
        font-size: 80px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .empty-state p {
        color: #6b7280;
        margin-bottom: 30px;
    }

    /* Lightbox Styles */
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        animation: fadeIn 0.3s ease;
    }

    .lightbox.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        animation: zoomIn 0.3s ease;
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .lightbox-content img {
        max-width: 100%;
        max-height: 90vh;
        border-radius: 10px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .lightbox-close {
        position: absolute;
        top: -50px;
        right: 0;
        background: white;
        color: #1f2937;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .lightbox-close:hover {
        background: #ef4444;
        color: white;
        transform: rotate(90deg);
    }

    .lightbox-info {
        position: absolute;
        bottom: -60px;
        left: 0;
        color: white;
        font-size: 14px;
    }

    .filter-section {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 45px 12px 20px;
        border: 2px solid #e5e7eb;
        border-radius: 25px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .search-box i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    @media (max-width: 768px) {
        .gallery-container {
            padding: 30px 0;
        }

        .gallery-header {
            padding: 25px;
        }

        .gallery-header h1 {
            font-size: 28px;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="gallery-container">
    <div class="container">
        <!-- Header Section -->
        <div class="gallery-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-images me-3"></i>Image Gallery</h1>
                    <p>Browse and manage your beautiful collection of images</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('image-galleries.create') }}" class="btn-add-new">
                        <i class="fas fa-plus me-2"></i>Add New Images
                    </a>
                </div>
            </div>

            {{-- <div class="stats-container">
                <div class="stat-card">
                    <span class="stat-number">{{ $media->total() }}</span>
                    <span class="stat-label">Total Images</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{{ number_format($totalSize / 1024 / 1024, 2) }} MB</span>
                    <span class="stat-label">Storage Used</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{{ $recentCount }}</span>
                    <span class="stat-label">Added This Week</span>
                </div>
            </div> --}}
        </div>

        <!-- Search Filter -->
        <div class="filter-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search images by filename...">
                <i class="fas fa-search"></i>
            </div>
        </div>

        <!-- Gallery Grid -->
        @if($media->count() > 0)
            <div class="gallery-grid" id="galleryGrid">
                @foreach($media as $image)
                    <div class="gallery-item" data-filename="{{ strtolower($image->file_name) }}">
                        <div class="gallery-image-wrapper">
                            <img src="{{ $image->getUrl() }}" 
                                 alt="{{ $image->file_name }}" 
                                 class="gallery-image"
                                 onclick="viewImage('{{ $image->getUrl() }}', '{{ $image->file_name }}', '{{ $image->human_readable_size }}')">
                            
                            <div class="gallery-overlay">
                                <div class="gallery-actions">
                                    <button class="btn-action btn-view" 
                                            onclick="viewImage('{{ $image->getUrl() }}', '{{ $image->file_name }}', '{{ $image->human_readable_size }}')" 
                                            title="View Image">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ $image->getUrl() }}" 
                                       download="{{ $image->file_name }}"
                                       class="btn-action btn-download" 
                                       title="Download Image">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn-action btn-delete" 
                                            onclick="confirmDelete({{ $image->id }})" 
                                            title="Delete Image">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-info">
                            <h3 class="gallery-title" title="{{ $image->file_name }}">{{ $image->file_name }}</h3>
                            <div class="gallery-meta">
                                <span class="gallery-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $image->created_at->format('M d, Y') }}
                                </span>
                                <span class="gallery-size">
                                    {{ $image->human_readable_size }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $media->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="far fa-images"></i>
                </div>
                <h3>No Images Yet</h3>
                <p>Start building your gallery by uploading your first images</p>
                <a href="{{ route('image-galleries.create') }}" class="btn-add-new">
                    <i class="fas fa-plus me-2"></i>Upload Images
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <img src="" alt="Gallery Image" id="lightboxImage">
        <div class="lightbox-info">
            <div id="lightboxFilename"></div>
            <div id="lightboxSize"></div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
    // Search Functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        galleryItems.forEach(item => {
            const filename = item.getAttribute('data-filename');
            if (filename.includes(searchTerm)) {
                item.style.display = 'block';
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 10);
            } else {
                item.style.opacity = '0';
                item.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        });
    });

    // View Image in Lightbox
    function viewImage(imageUrl, filename, size) {
        document.getElementById('lightboxImage').src = imageUrl;
        document.getElementById('lightboxFilename').textContent = filename;
        document.getElementById('lightboxSize').textContent = 'Size: ' + size;
        document.getElementById('lightbox').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close Lightbox
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close lightbox on background click
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });

    // Close lightbox on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });

    // Confirm Delete
    function confirmDelete(mediaId) {
        if (confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
            const form = document.getElementById('deleteForm');
            form.action = "{{ route('image-galleries.media.destroy', ':id') }}".replace(':id', mediaId);
            form.submit();
        }
    }

    // Auto-hide success message
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
</script>
@endpush