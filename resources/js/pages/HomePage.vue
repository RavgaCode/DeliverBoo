<template>
    <div class="container">
        <h1>sono la homepage</h1>
        <SearchBar />
    </div>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
export default {
    name: "HomePage",
    components: {
        SearchBar,
    },
};
</script>
