@extends('backend.layouts.master')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Modifier les paramètres</h5>
        <div class="card-body">
            <form method="post" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf
                {{-- @method('PATCH') --}}
                {{-- {{dd($data)}} --}}
                <div class="form-group">
                    <label for="company_name" class="col-form-label">Nom de l'entreprise <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_name" required value="{{ $data->company_name }}">
                    @error('company_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="short_des" class="col-form-label">Courte Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="quote" name="short_des">{{ $data->short_des }}</textarea>
                    @error('short_des')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description">{{ $data->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <img src="{{asset('assets/images/setting/'.$data->logo)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
                    <div class="input-group">
                        {{-- <span class="input-group-btn">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                            </a>
                        </span> --}}
                        <input id="thumbnail1" class="form-control" type="file" name="logo">
                        <input type="text" name="old_logo" value="{{ $data->logo }}">
                    </div>
                    <div id="holder1" style="margin-top:15px;max-height:100px;"></div>

                    @error('logo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <img width="111" height="100" src="{{asset('assets/images/setting/'.$data->photo)}}" alt="">
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
                        <input type="text" name="old_photo" value="{{ $data->photo }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="address" required value="{{ $data->address }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required value="{{ $data->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" required value="{{ $data->phone }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="currency" class="col-form-label">Currency <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="currency" required value="{{ $data->currency }}">
                    @error('currency')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <img width="231" height="100" src="{{asset('assets/images/setting/'.$data->about_breadcrumb)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="about_breadcrumb" class="col-form-label">About page breadcrumb <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input id="thumbnail" class="form-control" type="file" name="about_breadcrumb">
                        <input type="text" name="old_about_breadcrumb" value="{{ $data->about_breadcrumb }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('about_breadcrumb')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <img width="231" height="100" src="{{asset('assets/images/setting/'.$data->product_breadcrumb)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="product_breadcrumb" class="col-form-label">Products page breadcrumb <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input id="thumbnail" class="form-control" type="file" name="product_breadcrumb">
                        <input type="text" name="old_product_breadcrumb" value="{{ $data->product_breadcrumb }}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('product_breadcrumb')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });

        $(document).ready(function() {
            $('#quote').summernote({
                placeholder: "Write short Quote.....",
                tabsize: 2,
                height: 100
            });
        });
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush
