@extends('layouts.backoffice')

@section('content')

    <h1>{{$plate->name}}</h1>
    <br>

    @if ($plate->cover)
        <div class="img">
            <img src="{{asset('storage/' . $plate->cover)}}" alt="{{$plate->name}}"  class="w-50">
        </div>
    @endif

    <ul class="list-unstyled">
        <li>
            <b>Creato il:</b> {{$plate->created_at->toFormattedDateString()}}
        </li>
        <li>
            <b>Modificato il:</b> {{$plate->updated_at->toFormattedDateString()}}
        </li>

        {{-- <li>
            <b>Tag:</b>
            @if (!$post->tags->isEmpty())
                @foreach ($post->tags as $tag)
                    {{$tag->name}}{{!$loop->last ? ',' : ''}}
                @endforeach
            @else
                Nothing
            @endif
        </li> --}}
    </ul>

    <div class="mt-2">
        <b>Prezzo:</b><p>{{$plate->price}}€</p>
    </div>

    <div class="mt-2">
        <b>Descrizione Prodotto</b>
        <p>{{$plate->description}}.</p>
    </div>

    <div class="mt-2">
        @if($plate->visibility === 1)
        <b>Piatto visibile al cliente</b>
        @else
        <b>Piatto non visibile al cliente</b>
        @endif
    </div>

    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id])}}" class="btn btn-primary">Modifica</a>

    {{-- Delete --}}
    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}" method="post">
        @csrf
        @method('DELETE')
    
        <input type="submit" value="Cancella" onClick="return confirm('Sei sicuro di voler cancellare questo piatto?');" class="btn btn-danger mt-2">
    </form>
    
@endsection