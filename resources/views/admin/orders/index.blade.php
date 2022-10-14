@extends('layouts.backoffice')

@section('content')

   <h2 class="py-6">Ecco la lista dei tuoi ordini ricevuti</h2>

   <div class="order-list-container">
    @foreach($orders as $order)
    <div class="order-wrapper">
        {{-- Order info --}}
        <div class="top-order-flex d-flex justify-content-between py-2">
            <div class="top-order-content">
                <span>Ordine nr#{{$order->id}} | Importo: {{$order->total_price}} &euro;  | Data: {{$order->created_at->format('d/m/Y')}} </span>
            </div>
            <div>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample-{{$order->id}}" aria-expanded="false" aria-controls="collapseExample">
                    Dettagli
                  </button>
            </div>
        </div>
        {{-- Additional Customer info --}}
        <div class="collapse" id="collapseExample-{{$order->id}}">
          <div class="card card-body">
            <span>Nome Cliente: {{$order->customer_name}}</span>
            <span>Indirizzo Cliente: {{$order->customer_address}}</span>
            <span>Email Cliente: {{$order->customer_email}}</span>
            <span>Telefono Cliente: {{$order->customer_telephone}}</span>
            <span>{{$order->cart}}</span>
          </div>
        </div>
    </div>
   @endforeach
   </div>
   

   <script src="{{ asset('js/showmodal.js') }}" defer></script>
  
   
@endsection