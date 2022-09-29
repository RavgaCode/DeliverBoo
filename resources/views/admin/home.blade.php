@extends('layouts.backoffice')

@section('content')
    <h1>Benvenuto {{$user->name}}</h1>

    <h2>Il tuo ristorante: {{$user->restaurant_name}}</h2>

    @if (asset('storage/' . $user->restaurant_cover)) 
        <img src="{{$user->restaurant_cover}}" alt="{{($user->restaurant_name)}}">
        
    @else 
        <img src="{{asset('storage/' . $user->restaurant_cover)}}" alt="{{$user->restaurant_name}}">
    @endif
   
    
@endsection