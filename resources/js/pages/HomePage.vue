<template>
    
    <div>
        <Jumbotron/>
        <SearchBar />
        <InfoSection/>
        <GoogleMap />
    </div>
    
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import Jumbotron from "../components/Jumbotron.vue";
import InfoSection from "../components/InfoSection.vue";
import GoogleMap from "../components/GoogleMap.vue";

export default {
    name: "HomePage",
    components: {
        SearchBar,
        Jumbotron,
        InfoSection,
        GoogleMap
    },
};
</script>
