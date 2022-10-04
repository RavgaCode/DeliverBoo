<template>
    <div>
        <!-- Page-top -->
        <div class="page-top">
            <!-- Left-col -->
            <div class="left-col">
                img

            </div>
            <!-- Right-col -->
            <div class="right-col">
                <h2>titolo</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ut quibusdam rem. Eligendi delectus in nulla molestias eius cumque consectetur libero, velit, eos architecto facilis obcaecati culpa ullam, laborum earum.
                </p>

            </div>

        </div>

        <!-- Page-bottom -->
        <div class="page-bottom">
            <div class="d-flex">
                <!-- Cart -->
                <div class="plates-cart">
                    carrello

                </div>
                <!-- plate-descrption  -->
                <div class="plate-description">
                    descrizione

                </div>

            </div>

            <!-- Plates -->
                <div>
                    <div class="row row-cols-4">
                        <div class="col mt-3" v-for="singlePlate in plates" :key="singlePlate.id">
                            <!-- Plate img -->
                            <div v-if="singlePlate.visibility === 1">
                                <!-- Cover -->
                                <img :src="singlePlate.cover" class="card-img-top" :alt="singlePlate.name">
                                <!-- Plate-Info -->
                                <!-- <div class="card-body"> -->
                                    <!-- <h5 class="card-title"><strong>Nome:</strong> {{ singlePlate.name }}</h5>
                                    <div><strong>Prezzo:</strong> {{ singlePlate.price }}&euro;</div>
                                    <p class="card-text"><strong>Descrizione:</strong> {{ singlePlate.description }}</p> -->
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                <!-- </div> -->
                            </div>

                        </div>

                    </div>
                </div>
            

        </div>

        
    </div>
    
</template>

<script>
export default {
    name: 'RestaurantPage',
    components:{
        
    },

    data(){
        return{
            plates: [],
        }
    },

    methods:{
        getPlates(){
            axios.get('/api/plates/' + this.$route.params.slug)
            .then((response) => {
                this.plates = response.data.results;

                // if (response.data.success) {
                //     this.plates = response.data.results;
                // }else{
                //     this.$router.push({name: 'error'});
                // };
            })
        }
    },

    mounted(){
        this.getPlates();
    },
    
}
</script>

<style lang="scss" scoped>
.page-top{
    display: flex;
    .left-col{
        width: 50%;
    }

    .right-col{
        width: 50%;
    }
}

.page-bottom{
    
    .plates-cart{
        width: 30%;
    }

    .plate-descrption{
        width: 70%;
    }

    img{
        width: 200px;
    }
}


</style>