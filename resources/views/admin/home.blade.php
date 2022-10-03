@extends('layouts.backoffice')

@section('content')
    <h1>Benvenuto {{$user->name}}</h1>

    <h2>Il tuo ristorante: {{$user->restaurant_name}}</h2>  
    
    
@endsection