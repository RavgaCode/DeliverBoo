<template>
    <div>
        <div class="row row-cols-3">
            <div class="col mt-3" v-for="singlePlate in plates" :key="singlePlate.id">
                <!-- Single-Plate -->
                <div class="card" v-if="singlePlate.visibility === 1">
                    <!-- Cover -->
                    <img :src="singlePlate.cover" class="card-img-top" :alt="singlePlate.name">
                    <!-- Plate-Info -->
                    <div class="card-body">
                        <h5 class="card-title"><strong>Nome:</strong> {{ singlePlate.name }}</h5>
                        <div><strong>Prezzo:</strong> {{ singlePlate.price }}&euro;</div>
                        <p class="card-text"><strong>Descrizione:</strong> {{ singlePlate.description }}</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>

            </div>

        </div>
        
    </div>
</template>

<script>
export default {
    name: 'Plates',
    components: {

    },

    data(){
        return{
            plates: [],
        }
    },

    methods:{
        getPlates(){
            axios.get('/api/plates/')
            .then((response) => {
                this.plates = response.data.results.data;
            })
        }
    },

    mounted(){
        this.getPlates();
    },

    
}
</script>