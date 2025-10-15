@extends('layouts.app')

@section('title')
    Welcome Home
@endsection

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <p class="card-title">Create Main Page Content</p>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="table-container">
                    <div class="bg-white">
                        <form method="POST" action="{{ route('main.page.index') }}" enctype="multipart/form-data">
                            @csrf
                        
                            {{-- Banner Text --}}
                            <div class="mb-3">
                                <label for="banner_text" class="form-label text-uppercase text-muted small">Banner Text <span class="text-danger">*</span></label>
                                <textarea 
                                    class="form-control @error('banner_text') is-invalid @enderror" 
                                    name="banner_text" 
                                    id="banner_text" 
                                    cols="30" 
                                    rows="3"
                                    placeholder="Enter banner text" required>{{ old('banner_text') }}</textarea>
                                @error('banner_text')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        
                            {{-- Moto --}}
                            <div class="mb-3">
                                <label for="moto" class="form-label text-uppercase text-muted small">Moto <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    name="moto" 
                                    class="form-control @error('moto') is-invalid @enderror" 
                                    id="moto" 
                                    placeholder="Enter moto" 
                                    value="{{ old('moto') }}" required>
                                @error('moto')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        
                            {{-- Experience and Projects --}}
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="experience" class="form-label text-uppercase text-muted small">Experience</label>
                                        <input 
                                            type="number" 
                                            name="experience" 
                                            class="form-control @error('experience') is-invalid @enderror" 
                                            id="experience" 
                                            placeholder="Enter years of experience"
                                            value="{{ old('experience') }}">
                                        @error('experience')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                        
                                    <div class="col-md-6">
                                        <label for="projects" class="form-label text-uppercase text-muted small">Projects</label>
                                        <input 
                                            type="number" 
                                            name="projects" 
                                            class="form-control @error('projects') is-invalid @enderror" 
                                            id="projects" 
                                            placeholder="Total projects"
                                            value="{{ old('projects') }}">
                                        @error('projects')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            {{-- Certification and Books --}}
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="certification" class="form-label text-uppercase text-muted small">Certifications</label>
                                        <input 
                                            type="number" 
                                            name="certification" 
                                            class="form-control @error('certification') is-invalid @enderror" 
                                            id="certification" 
                                            placeholder="Total certifications"
                                            value="{{ old('certification') }}">
                                        @error('certification')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                        
                                    <div class="col-md-6">
                                        <label for="books" class="form-label text-uppercase text-muted small">Books</label>
                                        <input 
                                            type="number" 
                                            name="books" 
                                            class="form-control @error('books') is-invalid @enderror" 
                                            id="books" 
                                            placeholder="Books published"
                                            value="{{ old('books') }}">
                                        @error('books')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            {{-- Mentoring and Articles --}}
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="mentoring" class="form-label text-uppercase text-muted small">Mentoring</label>
                                        <input 
                                            type="number" 
                                            name="mentoring" 
                                            class="form-control @error('mentoring') is-invalid @enderror" 
                                            id="mentoring" 
                                            placeholder="Mentoring count"
                                            value="{{ old('mentoring') }}">
                                        @error('mentoring')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                        
                                    <div class="col-md-6">
                                        <label for="article" class="form-label text-uppercase text-muted small">Articles</label>
                                        <input 
                                            type="number" 
                                            name="article" 
                                            class="form-control @error('article') is-invalid @enderror" 
                                            id="article" 
                                            placeholder="Total articles"
                                            value="{{ old('article') }}">
                                        @error('article')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="banner_image" class="form-label text-muted">Banner Image</label>
                                <input type="file" name="banner_image" class="form-control @error('banner_image') is-invalid @enderror" accept="image/*">
                                @error('banner_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        
                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection