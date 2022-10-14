<template>
    <div>
        <Jumbotron />
        <SearchBar />
        <FoodCarusel />
        <InfoSection />
        <Map />
        <Footer />
    </div>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import Jumbotron from "../components/Jumbotron.vue";
import InfoSection from "../components/InfoSection.vue";
import Map from "../components/Map.vue";
import FoodCarusel from "../components/FoodCarusel.vue";
import Footer from "../components/Footer.vue";

export default {
    name: "HomePage",
    components: {
        SearchBar,
        Jumbotron,
        InfoSection,
        Map,
        FoodCarusel,
        Footer,
    },
};
</script>
<style lang="scss" scoped>
main {
    scroll-behavior: smooth;
}
</style>
