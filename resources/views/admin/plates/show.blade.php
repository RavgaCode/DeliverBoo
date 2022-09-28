@extends('layouts.app')

@section('content')

    <h1>{{$plate->name}}</h1>
    <br>

    @if ($plate->cover)
        <div class="img">
            <img src="{{asset('storage/' . $plate->cover)}}" alt="{{$plate->name}}">
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
        <p>{{$plate->description}}</p>
    </div>

    {{-- <div class="d-flex align-items-center">
        <a href="{{ route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-primary mr-2">Edit</a>
        Delete
        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit" value="Delete" onClick="return confirm('Do you want to delete this post?');" class="btn btn-danger">
        </form>
    </div> --}}
    
@endsection