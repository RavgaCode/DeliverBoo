<template>
    
    <div>
        <Jumbotron/>
        <SearchBar />
    </div>
    
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import Jumbotron from "../components/Jumbotron.vue";
export default {
    name: "HomePage",
    components: {
        SearchBar,
        Jumbotron
    },
};
</script>
