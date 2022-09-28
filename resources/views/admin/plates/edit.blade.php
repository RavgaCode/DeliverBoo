@extends('layouts.app')

@section('content')
    <h1>Edit post</h1>

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
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $plate->name) }}">
        </div>

        {{-- <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">Nothing</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div> --}}

        {{-- <h5>Tags</h5>
        <div class="mb-3">
            @foreach ($tags as $tag)
                @if ($errors->any())
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                        value="{{$tag->id}}" 
                        id="tag-{{$tag->id}}" 
                        name="tags[]" 
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                        <label class="form-check-label" for="tag-{{$tag->id}}">
                        {{$tag->name}}
                        </label>
                    </div> 
                @else   
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                        value="{{$tag->id}}" 
                        id="tag-{{$tag->id}}" 
                        name="tags[]" 
                        {{ $post->tags->contains($tag) ? 'checked' : ''}}>
                        <label class="form-check-label" for="tag-{{$tag->id}}">
                        {{$tag->name}}
                        </label>
                    </div> 
                @endif
            @endforeach
        </div> --}}

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') ? old('description') : $plate->description  }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Default file input example</label>
            <input class="form-control" type="file" id="cover" name="cover">

            <img src="{{asset('/storage/' . $plate->cover)}}" alt="" class="w-50">
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection