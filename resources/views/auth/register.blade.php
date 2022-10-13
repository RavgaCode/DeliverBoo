@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    {{-- {{ __('Unisciti alla famiglia di Deliveboo') }}  --}}
                    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/ihyatngg.json"
                        trigger="loop"
                        delay="2000"
                        style="width:100px;height:80px">
                    </lord-icon>
                    <h1>Unisciti alla famiglia di Deliveboo</h1>
                    
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label">{{ __('Name') }}*</label>

                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label">{{ __('E-Mail Address') }}*</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" minlength="4" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}*</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm Password --}}

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Confirm Password') }}*</label>

                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        {{-- Restaurant Name--}}
                        <div class="form-group">
                            <label for="restaurant_name" class="col-md-4 col-form-label">Nome Ristorante*</label>

                            <div class="col">
                                <input id="restaurant_name" type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required>

                                @error('restaurant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Restaurant Address--}}
                        <div class="form-group">
                            <label for="restaurant_address" class="col-md-4 col-form-label">Indirizzo Ristorante*</label>

                            <div class="col">
                                <input id="restaurant_address" type="text" class="form-control @error('restaurant_address') is-invalid @enderror" name="restaurant_address" value="{{ old('restaurant_address') }}" required>

                                @error('restaurant_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Restaurant VAT--}}
                        <div class="form-group">
                            <label for="restaurant_vat" class="col-md-4 col-form-label">Partita Iva*</label>

                            <div class="col">
                                <input id="restaurant_vat" type="text" class="form-control @error('name') is-invalid @enderror" name="restaurant_vat" value="{{ old('restaurant_vat') }}" pattern="[0-9]{11}" title="VAT Number must be of 11 numbers" required autocomplete="restaurant_vat" autofocus>

                                @error('restaurant_vat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Restaurant Cover Img--}}
                        <div class="form-group">
                            <label for="restaurant_cover" class="col-md-4 col-form-label">Immagine di copertina*</label>

                            <div class="col-md-6">
                                <input id="restaurant_cover" type="file" class="form-control @error('restaurant_cover') is-invalid @enderror" name="restaurant_cover" value="{{ old('restaurant_cover') }}" required autocomplete="restaurant_cover" autofocus>

                                @error('restaurant_cover')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Category Check-Box --}}
                        <div class="mb-3">
                            <label for="category" class="col-md-4 col-form-label">Categories*</label>
                            <div class="form-group">
                                @foreach ($categories as $category)
                                <div class="form-check mx-3 pt-1">
                                    <input class="form-check-input @error('category-1') is-invalid @enderror" type="checkbox"
                                    value="{{ $category->id }}"
                                    id="category-{{ $category->id }}"
                                    name="categories[]"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label " for="category-{{ $category->id }}">
                                    {{$category->name}}
                                    </label>

                                    @error('category-1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Btn --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick='return validateCheckboxes()'>
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/registervalidations.js')}}"></script>
@endsection
