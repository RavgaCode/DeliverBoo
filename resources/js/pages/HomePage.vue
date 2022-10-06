<template>
    <div>
        <Jumbotron />
        <SearchBar />
        <InfoSection />
    </div>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import Jumbotron from "../components/Jumbotron.vue";
import InfoSection from "../components/InfoSection.vue";

export default {
    name: "HomePage",
    components: {
        SearchBar,
        Jumbotron,
        InfoSection,
    },
};
</script>
