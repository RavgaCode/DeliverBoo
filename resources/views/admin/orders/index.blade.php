@extends('layouts.backoffice')

@section('content')

   <h2>Ecco la lista dei tuoi ordini ricevuti</h2>
   @foreach($orders as $order)
    <div>
        <span>{{$order->customer_name}}</span>
        <span>{{$order->customer_address}}</span>
        <span>{{$order->total_price}} &euro;</span>
        <span>{{$order->customer_email}}</span>
        <span>tel: {{$order->customer_telephone}}</span>
        
    </div>
   @endforeach

   <script src="{{ asset('js/showmodal.js') }}" defer></script>
  
   
@endsection