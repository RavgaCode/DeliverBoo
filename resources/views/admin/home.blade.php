@extends('layouts.backoffice')

@section('content')
    <h1>Benvenuto {{$user->name}}</h1>

    <h2>Il tuo ristorante: {{$user->restaurant_name}}</h2>
    <hr>
    <h4>Totale ordini ricevuti: {{$orders_count}}</h4>
    <h4>Fatturato totale: {{$total_revenue}} &euro;</h4>
    <div class="w-50">
        <canvas id="canvas"></canvas>
    </div>
   
    
    
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>



    
    const orders = {!! json_encode($number_of_orders->toArray()) !!};
    
        // Riempo gli array delle coordinate da stampare, utilizzando i dati passati
        const totOrdersPerMonth = [];
        const months = [];
        orders.forEach(element => {
            months.push(`${element.month} - ${element.year}`);
            totOrdersPerMonth.push(element.orders);
        });
        

        // Funzione per caricare la tabella al caricamento della pagina
        window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: months,
            datasets: [{
                label: 'Numero Ordini per Mese',
                backgroundColor: '#6495ED',
                data: totOrdersPerMonth,
            }]
        } ,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Numero Ordini per Mese'
                }
            }
        });
    };
       
    
    
    </script>

@endsection