@extends('layouts.backoffice')

@section('content')
    <h1>Modifica piatto</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.plates.update', ['plate' => $plate->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $plate->name) }}"  required>
        </div>


        <div class="mb-3">
            <label for="description" class="form-label">Descrizione *</label>
            <textarea class="form-control" id="description" name="description" rows="5"  required>{{ old('description') ? old('description') : $plate->description  }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo *</label>
            <input type="number" id="price" name="price" value="{{ old('description') ? old('price') : $plate->price  }}" step='.01'  required>
        </div>

        <div class="mb-3b form-check form-switch">
            <input class="form-check-input" type="checkbox" name="visibility" id="visibility" @if($plate->visibility === 1) checked @endif>
            <label class="form-check-label" for="visibility">
                Visibile?
            </label>
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Anteprima immagine esistente *</label>
            <input class="form-control" type="file" id="cover" name="cover">

            <img src="{{asset('storage/' . $plate->cover)}}" alt="{{$plate->name}}" class="w-50">
        </div>

        <input type="submit" value="Save" class="btn btn-primary" onclick="setPop()" >
    </form>

   

@endsection