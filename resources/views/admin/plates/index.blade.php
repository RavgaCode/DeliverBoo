@extends('layouts.app')

@section('content')

   @if (!$plates->isEmpty())
    <div class="row row-cols-4">
        @foreach ($plates as $plate)
        {{-- Single Card --}}
            <div class="col">
                <div class="card mt-2" style="width: 18rem;">
                    <img src="{{asset('/storage/' . $plate->cover)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$plate->name}}</h5>
                        <a href="{{ route('admin.plates.show', ['plate' => $plate->id])}}" class="btn btn-primary">Check Post</a>
                        <a href="{{ route('admin.plates.edit', ['plate' => $plate->id])}}" class="btn btn-primary">Edit Post</a>
                    {{-- <a href="{{ route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-primary">Check Post</a> --}}

                    {{-- Delete --}}
                    {{-- <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        
                        <input type="submit" value="Delete" onClick="return confirm('Do you want to delete this post?');" class="btn btn-danger mt-2">
                    </form> --}}
                    </div>
                </div> 
                </div>
        {{-- End card --}}
        @endforeach
    </div>
   @else
       <h2>Aggiungi Piatto</h2>
   @endif     
  
   
@endsection