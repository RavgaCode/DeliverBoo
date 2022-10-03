@extends('layouts.backoffice')

@section('content')
    <h1>Aggiungi un nuovo piatto</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.plates.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="name" class="form-control" id="name" name="name" required >
        </div>

        {{-- <h5>Tags</h5>
        <div class="mb-3">
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" name="tags[]" {{ in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                    <label class="form-check-label" for="tag-{{$tag->id}}">
                    {{$tag->name}}
                    </label>
                </div>
            @endforeach
        </div> --}}

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione *</label>
            <textarea class="form-control" id="description" name="description" rows="5"  required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo *</label>
            <input type="number" id="price" name="price" step='.01' required>
        </div>

        <div class="mb-3b form-check form-switch">
            <input class="form-check-input" type="checkbox" name="visibility" id="visibility">
            <label class="form-check-label" for="visibility">
                Visibile?
            </label>
        </div>
        
        <div class="mb-3">
            <label for="cover" class="form-label">Immagine di presentazione *</label>
            <input class="form-control" type="file" id="cover" name="cover"  required>
        </div>

        <input type="submit" value="Salva" class="btn btn-primary" onclick="setPop()">
    </form>

    <script src="{{ asset('js/showmodal.js') }}" defer></script>
@endsection