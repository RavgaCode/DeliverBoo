@extends('layouts.backoffice')

@section('content')
    <h1>Modifica i tuoi dati utente</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.users.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"  required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"  required>
        </div>

        <div class="mb-3">
            <label for="restaurant_name" class="form-label">Nome Ristorante *</label>
            <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{ old('restaurant_name', $user->restaurant_name) }}"  required>
        </div>

        <div class="mb-3">
            <label for="restaurant_vat" class="form-label">Partita Iva *</label>
            <input type="number" class="form-control" id="restaurant_vat" name="restaurant_vat" value="{{ old('restaurant_vat', $user->restaurant_vat) }}"  required>
        </div>

        <div class="mb-3">
            <label for="restaurant_address" class="form-label">Indirizzo ristorante *</label>
            <input type="text" class="form-control" id="restaurant_address" name="restaurant_address" value="{{ old('restaurant_address', $user->restaurant_address) }}"  required>
        </div>

        <div class="mb-3">
            <label for="restaurant_cover" class="form-label">Anteprima immagine esistente *</label>
            <input class="form-control" type="file" id="restaurant_cover" name="restaurant_cover">

            <img src="{{asset('storage/' . $user->restaurant_cover)}}" alt="{{$user->restaurant_cover}}" class="w-50">
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection