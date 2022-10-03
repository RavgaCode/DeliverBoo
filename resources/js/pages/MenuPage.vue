<template>
    <div class="container">
        <h1>Lista dei Piatti</h1>
        <Plates />
    </div>
</template>

<script>

import Plates from "../components/Plates.vue";
export default {
    name: 'MenuPage',
    components:{
        Plates
    }
}
</script>