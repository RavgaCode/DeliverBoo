@extends('layouts.backoffice')

@section('content')

   @if (!$plates->isEmpty())
    <div class="row row-cols-4">
        @foreach ($plates as $plate)
        {{-- Single Card --}}
            <div class="col">
                <div class="card mt-2 mh-100">
                    <img src="{{asset('storage/' . $plate->cover)}}" class="card-img-top" alt="{{$plate->name}}"  class="w-50">
                        <div class="card-body">
                                <h5 class="card-title">{{$plate->name}}</h5>

                                {{-- Operation buttons list --}}
                                <a href="{{ route('admin.plates.show', ['plate' => $plate->id])}}" class="btn btn-primary">Dettagli</a>
                                <a href="{{ route('admin.plates.edit', ['plate' => $plate->id])}}" class="btn btn-primary">Modifica</a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                            
                                <input type="submit" value="Cancella" onClick="return confirm('Sei sicuro di voler cancellare questo piatto?');" class="btn btn-danger mt-2">
                            </form>
                        </div>
                </div> 
            </div>
        {{-- End card --}}
        @endforeach
    </div>
   @else
       <h2>Non hai ancora aggiunto un piatto al tuo menù!</h2>
   @endif     
  
   
@endsection