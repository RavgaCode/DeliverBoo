@extends('layouts.app')

@section('content')
    <h1>Create a new post</h1>

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
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="name" name="name" >
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
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price">
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="cover" name="cover">
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection