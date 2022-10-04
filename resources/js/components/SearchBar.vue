<template>
    <section class="search-bar">
        <div class="container">
            <!-- Text Searchbar -->
            <div class="text-searchbar-container">
                <label for="text-searchbar"></label>
                <input
                    type="text"
                    id="text-searchbar"
                    name="text-searchbar"
                    placeholder="Cerca il tuo ristorante preferito"
                />
            </div>
            <!-- Category Filters -->
            <div class="filters-container d-flex">
                <div
                    class="filter-box"
                    v-for="category in categories"
                    :key="category.id"
                >
                    <label :for="category.id">{{ category.name }}</label>
                    <input
                        type="checkbox"
                        :id="category.id"
                        :name="category.id"
                        :value="category.id"
                    />
                </div>
            </div>
            <!-- Restaurants Card Wrapper -->
            <div
                class="restaurant-wrapper d-flex justify-content-start flex-wrap"
            >
                <div class="restaurant-card col-4">
                    <img
                        src="https://via.placeholder.com/150

C/O https://placeholder.com/"
                        alt=""
                    />
                    <div class="restaurant-info">
                        <h5>Pizzeria Napoli</h5>
                    </div>
                </div>
                <div class="restaurant-card">
                    <img
                        src="https://via.placeholder.com/150

C/O https://placeholder.com/"
                        alt=""
                    />
                    <div class="restaurant-info">
                        <h5>Ai-Sushi</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "SearchBar",
    data() {
        return {
            categories: [],
            filteredCategories: [],
        };
    },
    methods: {
        getCategories() {
            axios.get("/api/categories/").then((response) => {
                this.categories = response.data.results;
            });
        },
    },

    mounted() {
        this.getCategories();
    },
};
</script>

<style lang="scss" scoped>
.search-bar {
    background-color: lightcoral;
    height: 800px;
}
</style>
