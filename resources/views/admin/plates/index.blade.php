@extends('layouts.backoffice')

@section('content')

   @if (!$plates->isEmpty())
   
   @if($show_deleted_message === 'yes')
        <div class="alert alert-danger" role='alert'>
            Piatto cancellato correttamente
        </div>
    @endif

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
                            
                                
                                
                                <!-- Button trigger modal -->
                                
                                @section('delete')
                                    <form action="{{route('admin.plates.destroy', ['plate' => $plate->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <input type="submit" value="Cancella" class="btn btn-danger" onclick="closeModal()">
                                    </form>
                                @endsection
                                <div class="btn btn-danger" onclick="showModal()">Cancella</div>
                        </div>
                </div> 
            </div>
        {{-- End card --}}
        @endforeach
        
    </div>
   @else
       <h2>Non hai ancora aggiunto un piatto al tuo menù!</h2>
   @endif     

   <script src="{{ asset('js/showmodal.js') }}" defer></script>
  
   
@endsection