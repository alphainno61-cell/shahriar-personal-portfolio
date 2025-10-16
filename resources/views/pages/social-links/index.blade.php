@extends('layouts.app')

@section('title', 'Social Links')

@section('content')
<div class="row justify-content-center mt-2">
    <div class="col-md-10 col-lg-8 p-4 rounded shadow-sm bg-white">
        <div class="social-link-form">
            <h3 class="mb-4 text-center text-black">Store Your Social Media Links</h3>
            <p class="text-center text-muted mb-5">Provide the full URL for each of your profiles.</p>
            
            {{-- <form action="{{ route('social-links') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="twitter-url" class="form-label visually-hidden">Twitter/X URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="twitter-addon">
                            <i class="fab fa-x-twitter"></i> </span>
                        <input type="url" class="form-control" id="twitter-url" placeholder="https://x.com/your-username" aria-label="Twitter/X URL" aria-describedby="twitter-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="facebook-url" class="form-label visually-hidden">Facebook URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="facebook-addon">
                            <i class="fab fa-facebook"></i> </span>
                        <input type="url" class="form-control" id="facebook-url" placeholder="https://facebook.com/your-page" aria-label="Facebook URL" aria-describedby="facebook-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="instagram-url" class="form-label visually-hidden">Instagram URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="instagram-addon">
                            <i class="fab fa-instagram"></i> </span>
                        <input type="url" class="form-control" id="instagram-url" placeholder="https://instagram.com/your-username" aria-label="Instagram URL" aria-describedby="instagram-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="pinterest-url" class="form-label visually-hidden">Pinterest URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="pinterest-addon">
                            <i class="fab fa-pinterest"></i> </span>
                        <input type="url" class="form-control" id="pinterest-url" placeholder="https://pinterest.com/your-username" aria-label="Pinterest URL" aria-describedby="pinterest-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="dribbble-url" class="form-label visually-hidden">Dribbble URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="dribbble-addon">
                            <i class="fab fa-dribbble"></i> </span>
                        <input type="url" class="form-control" id="dribbble-url" placeholder="https://dribbble.com/your-username" aria-label="Dribbble URL" aria-describedby="dribbble-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="behance-url" class="form-label visually-hidden">Behance URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="behance-addon">
                            <i class="fab fa-behance"></i> </span>
                        <input type="url" class="form-control" id="behance-url" placeholder="https://behance.net/your-username" aria-label="Behance URL" aria-describedby="behance-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="linkedin-url" class="form-label visually-hidden">LinkedIn URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="linkedin-addon">
                            <i class="fab fa-linkedin-in"></i> </span>
                        <input type="url" class="form-control" id="linkedin-url" placeholder="https://linkedin.com/in/your-profile" aria-label="LinkedIn URL" aria-describedby="linkedin-addon">
                    </div>
                </div>
            
                <div class="mb-4">
                    <label for="youtube-url" class="form-label visually-hidden">YouTube URL</label>
                    <div class="input-group input-group-md"> <span class="input-group-text input-group-text-custom" id="youtube-addon">
                            <i class="fab fa-youtube"></i> </span>
                        <input type="url" class="form-control" id="youtube-url" placeholder="https://youtube.com/@yourchannel" aria-label="YouTube URL" aria-describedby="youtube-addon">
                    </div>
                </div>
            
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save me-2"></i> Save Links
                    </button>
                </div>
            </form> --}}

            <form action="{{ route('social-links') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="twitter-url" class="form-label visually-hidden">Twitter/X URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="twitter-addon">
                            <i class="fab fa-x-twitter"></i> 
                        </span>
                        <!-- ADDED name="twitter-url" -->
                        <input type="url" class="form-control" id="twitter-url" name="twitter-url" placeholder="https://x.com/your-username" aria-label="Twitter/X URL" aria-describedby="twitter-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="facebook-url" class="form-label visually-hidden">Facebook URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="facebook-addon">
                            <i class="fab fa-facebook"></i> 
                        </span>
                        <!-- ADDED name="facebook-url" -->
                        <input type="url" class="form-control" id="facebook-url" name="facebook-url" placeholder="https://facebook.com/your-page" aria-label="Facebook URL" aria-describedby="facebook-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="instagram-url" class="form-label visually-hidden">Instagram URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="instagram-addon">
                            <i class="fab fa-instagram"></i> 
                        </span>
                        <!-- ADDED name="instagram-url" -->
                        <input type="url" class="form-control" id="instagram-url" name="instagram-url" placeholder="https://instagram.com/your-username" aria-label="Instagram URL" aria-describedby="instagram-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="pinterest-url" class="form-label visually-hidden">Pinterest URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="pinterest-addon">
                            <i class="fab fa-pinterest"></i> 
                        </span>
                        <!-- ADDED name="pinterest-url" -->
                        <input type="url" class="form-control" id="pinterest-url" name="pinterest-url" placeholder="https://pinterest.com/your-username" aria-label="Pinterest URL" aria-describedby="pinterest-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="dribbble-url" class="form-label visually-hidden">Dribbble URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="dribbble-addon">
                            <i class="fab fa-dribbble"></i> 
                        </span>
                        <!-- ADDED name="dribbble-url" -->
                        <input type="url" class="form-control" id="dribbble-url" name="dribbble-url" placeholder="https://dribbble.com/your-username" aria-label="Dribbble URL" aria-describedby="dribbble-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="behance-url" class="form-label visually-hidden">Behance URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="behance-addon">
                            <i class="fab fa-behance"></i> 
                        </span>
                        <!-- ADDED name="behance-url" -->
                        <input type="url" class="form-control" id="behance-url" name="behance-url" placeholder="https://behance.net/your-username" aria-label="Behance URL" aria-describedby="behance-addon">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="linkedin-url" class="form-label visually-hidden">LinkedIn URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="linkedin-addon">
                            <i class="fab fa-linkedin-in"></i> 
                        </span>
                        <!-- ADDED name="linkedin-url" -->
                        <input type="url" class="form-control" id="linkedin-url" name="linkedin-url" placeholder="https://linkedin.com/in/your-profile" aria-label="LinkedIn URL" aria-describedby="linkedin-addon">
                    </div>
                </div>
            
                <div class="mb-4">
                    <label for="youtube-url" class="form-label visually-hidden">YouTube URL</label>
                    <div class="input-group input-group-md"> 
                        <span class="input-group-text input-group-text-custom" id="youtube-addon">
                            <i class="fab fa-youtube"></i> 
                        </span>
                        <!-- ADDED name="youtube-url" -->
                        <input type="url" class="form-control" id="youtube-url" name="youtube-url" placeholder="https://youtube.com/@yourchannel" aria-label="YouTube URL" aria-describedby="youtube-addon">
                    </div>
                </div>
            
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"> 
                        <i class="fas fa-save me-2"></i> Save Links
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection