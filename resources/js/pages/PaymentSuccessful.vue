<template>
    <div class="container">
        <div class="page-top">
            <h2>Pagamento avvenuto con successo</h2>
            <div>Grazie per averci scelto. Torna alla <a href="/">Home</a></div>
        </div>

        <div class="page-bottom">
            <h3>Riepilogo ordine</h3>
            <div v-for="(item, index) in order" :key="index" class="order">
                <ul>
                    <li>
                        Nome:{{ item.name }}
                    </li>
                    <li>
                        Quantità: {{ item.quantity }}

                    </li>
                    <li>
                        Prezzo Singolo:{{ item.price }}
                    </li>

                 </ul>

            </div>
            <h3>Totale: {{ totalCost }}&euro;</h3>
            

        </div>
        
        
    </div>
    
</template>

<script>
export default {
    name: 'PaymentSuccessful',
    data(){
        return{
            order: null,
            finalCart: null,
            totalCost: null,

        }
    },
    methods:{
        getOrder() {
            if (typeof Storage !== "undefined") {
                console.log("ordine carico");

                let getCart = localStorage.getItem("cart");
                let cart = JSON.parse(getCart);
                this.order = cart;
                this.finalCart = JSON.stringify(this.order);
                let getTotal = localStorage.getItem("totalSum");
                let total = JSON.parse(getTotal);
                this.totalCost = total;
            }
        },

    },
    created() {
        this.getOrder();
    },
}
</script>

<style lang="scss" scoped>
ul{
    list-style-type: none;
    margin: 0;
}

.page-bottom{
    padding-top: 2rem;
    h3{
        border: 1px solid rgba(0,0,0,.125);
        background-color: lightgreen;
        padding: 1rem;
        margin: 0;
    }

    .order{
        background-color: coral;
        padding: 1rem 0;
        padding-right: 1rem;
        li{
            background-color: pink;
            border: 1px solid rgba(0,0,0,.125);
            padding: 0.5rem;
            
        }
    }
    
}
</style>