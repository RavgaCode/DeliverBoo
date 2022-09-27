@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Restaurant Name--}}
                        <div class="form-group row">
                            <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">Nome Ristorante</label>

                            <div class="col-md-6">
                                <input id="restaurant_name" type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name" autofocus>

                                @error('restaurant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Restaurant Address--}}
                        <div class="form-group row">
                            <label for="restaurant_address" class="col-md-4 col-form-label text-md-right">Indirizzo Ristorante</label>

                            <div class="col-md-6">
                                <input id="restaurant_address" type="text" class="form-control @error('restaurant_address') is-invalid @enderror" name="restaurant_address" value="{{ old('restaurant_address') }}" required autocomplete="restaurant_address" autofocus>

                                @error('restaurant_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Restaurant VAT--}}
                        <div class="form-group row">
                            <label for="restaurant_vat" class="col-md-4 col-form-label text-md-right">Partita Iva</label>

                            <div class="col-md-6">
                                <input id="restaurant_vat" type="text" class="form-control @error('name') is-invalid @enderror" name="restaurant_vat" value="{{ old('restaurant_vat') }}" required autocomplete="restaurant_vat" autofocus>

                                @error('restaurant_vat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Restaurant Cover Img--}}
                        <div class="form-group row">
                            <label for="restaurant_cover" class="col-md-4 col-form-label text-md-right">Immagine di copertina</label>

                            <div class="col-md-6">
                                <input id="restaurant_cover" type="file" class="form-control @error('restaurant_cover') is-invalid @enderror" name="restaurant_cover" value="{{ old('restaurant_cover') }}" required autocomplete="restaurant_cover" autofocus>

                                @error('restaurant_cover')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        {{-- Category Check-Box --}}
                        <div class="mb-3">
                            <h5>Categories:</h5>
                            {{-- @foreach ($categories as $category)
                                
                            @endforeach --}}

                            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                 value="{{ $category->id }}"
                                 id="category-{{ $category->id }}"
                                 name="categories[]"
                                 {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                 >
                                <label class="form-check-label" for="category-{{ $category->id }}">
                                {{$category->name}}
                                </label>
                            </div> --}}
                
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
