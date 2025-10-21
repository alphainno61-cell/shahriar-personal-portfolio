@extends('layouts.app')

@section('title', 'Edit Travel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Edit Travel</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('travels.update', $travel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title</label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ $travel->title }}" required>
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">Content</label>
                            <textarea name="content" id="content" class="form-control form-control-lg" rows="5" required>{{ $travel->content }}</textarea>
                        </div>

                        <!-- Map Image -->
                        <div class="mb-4">
                            <label for="map_image" class="form-label fw-bold">Map Image</label>
                            <input type="file" name="map_image" id="map_image" class="form-control form-control-lg" accept="image/*">
                            @if($travel->getFirstMediaUrl('map_image'))
                                <img id="map_preview" src="{{ $travel->getFirstMediaUrl('map_image') }}" alt="Map Image" class="img-fluid rounded shadow-sm mt-2" style="max-height: 200px;">
                            @else
                                <img id="map_preview" src="#" alt="Map Preview" class="img-fluid rounded shadow-sm mt-2" style="display: none; max-height: 200px;">
                            @endif
                        </div>

                        <!-- Countries -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Countries</label>
                            <div id="countries-wrapper">
                                @foreach($travel->countries as $index => $countryName)
                                <div class="row g-2 align-items-center country-item mb-2">
                                    <div class="col-md-5">
                                        <input type="text" name="countries[{{ $index }}][name]" class="form-control form-control-lg" value="{{ $countryName }}" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="file" name="countries[{{ $index }}][flag]" class="form-control form-control-lg country-flag" accept="image/*">
                                        @php
                                            $flag = $travel->getMedia('country_flags')[$index] ?? null;
                                        @endphp
                                        <img class="img-fluid rounded mt-1 flag-preview" style="max-height: 60px;" @if($flag) src="{{ $flag->getUrl() }}" @else style="display:none;" @endif>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-danger remove-country w-100">&times;</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-country" class="btn btn-outline-primary btn-sm mt-2">Add Country</button>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('travels.index') }}" class="btn btn-secondary btn-lg">Back</a>
                            <button type="submit" class="btn btn-primary btn-lg">Update</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let countryIndex = {{ count($travel->countries) }};

    // Add Country
    document.getElementById('add-country').addEventListener('click', function() {
        const wrapper = document.getElementById('countries-wrapper');
        const countryItem = document.createElement('div');
        countryItem.classList.add('row', 'g-2', 'align-items-center', 'country-item', 'mb-2');
        countryItem.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="countries[${countryIndex}][name]" class="form-control form-control-lg" placeholder="Country Name" required>
            </div>
            <div class="col-md-5">
                <input type="file" name="countries[${countryIndex}][flag]" class="form-control form-control-lg country-flag" accept="image/*">
                <img class="img-fluid rounded mt-1 flag-preview" style="display: none; max-height: 60px;">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger remove-country w-100">&times;</button>
            </div>
        `;
        wrapper.appendChild(countryItem);
        countryIndex++;
    });

    // Remove Country
    document.getElementById('countries-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-country')) {
            e.target.closest('.country-item').remove();
        }
    });

    // Map Image Preview
    document.getElementById('map_image').addEventListener('change', function(e) {
        const preview = document.getElementById('map_preview');
        if (e.target.files && e.target.files[0]) {
            preview.src = URL.createObjectURL(e.target.files[0]);
            preview.style.display = 'block';
        }
    });

    // Country Flag Preview
    document.getElementById('countries-wrapper').addEventListener('change', function(e) {
        if (e.target.classList.contains('country-flag')) {
            const file = e.target.files[0];
            const img = e.target.closest('.col-md-5').querySelector('.flag-preview');
            if (file) {
                img.src = URL.createObjectURL(file);
                img.style.display = 'block';
            }
        }
    });
});
</script>
@endpush
