<template>
    <div class="carusel">
        <img src="../images/ai_sushi_food_example.jpg" alt="">
        <img src="../images/alce_nero_food_example.jpg" alt="">
        <img src="../images/dolce_peccato_food_example.jpg" alt="">
        <img src="../images/frittfood_food_example.jpg" alt="">
        <img src="../images/hamerica_food_example.jpg" alt="">
        <img src="../images/il_vegetariano_food_example.jpg" alt="">
        <img src="../images/Pinseria_food_example.jpg" alt="">
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
    .carusel {
        display: flex;
        overflow-x: overlay;
        img {
            width: 25%;
        }
    }

   

    ::-webkit-scrollbar
    {
        background-color: #f5f5f523;
    }

    ::-webkit-scrollbar-thumb
    {
        background-color: #000000bb;
        border-radius: 20px;
    }

</style>

