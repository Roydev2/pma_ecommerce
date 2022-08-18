@extends('backend.layouts.master')

@section('title', 'Testimonial Create')

@section('main-content')

    <div class="card">
        <h5 class="card-header">Ajouter témoignage</h5>
        <div class="card-body">
            <form method="post" action="{{ route('testimonial.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputName" class="col-form-label">Nom <span class="text-danger">*</span></label>
                    <input id="inputName" type="text" name="name" placeholder="Enter name"
                        value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputrank" class="col-form-label">Rang <span class="text-danger">*</span></label>
                    <input id="inputrank" type="text" name="rank" placeholder="Enter rank"
                        value="{{ old('rank') }}" class="form-control">
                    @error('rank')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputcomment" class="col-form-label">Commentaire</label>
                    <textarea class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                    <div class="input-group">
                        {{-- <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span> --}}
                        <input id="thumbnail" class="form-control" type="file" name="photo"
                            value="{{ old('photo') }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
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
