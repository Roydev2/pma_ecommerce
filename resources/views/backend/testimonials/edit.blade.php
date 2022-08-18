@extends('backend.layouts.master')
@section('title', 'Testimonial Edit')
@section('main-content')

    <div class="card">
        <h5 class="card-header">Modifier témoignage</h5>
        <div class="card-body">
            <form method="post" action="{{ route('testimonial.update', $testimonial->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Nomm <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" placeholder="Enter name"
                        value="{{ $testimonial->name }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputRank" class="col-form-label">Rang <span class="text-danger">*</span></label>
                    <input id="inputRank" type="text" name="rank" placeholder="Enter rank"
                        value="{{ $testimonial->rank }}" class="form-control">
                    @error('rank')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputDesc" class="col-form-label">commentaire</label>
                    <textarea class="form-control" id="comment" name="comment">{{ $testimonial->comment }}</textarea>
                    @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <img width="150" height="150" src="{{asset('assets/images/testimonials/'.$testimonial->photo)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                    <div class="input-group">
                        {{-- <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span> --}}
                        <input id="thumbnail" class="form-control" type="file" name="photo">
                        <input type="hidden" name="image_hidden" value="{{ $testimonial->photo }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#comment').summernote({
                placeholder: "Write short text.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
