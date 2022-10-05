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
                    <label :for="category.name">{{ category.name }}</label>
                    <input
                        @click="changeRestaurants()"
                        type="checkbox"
                        v-model="selectedCategories"
                        :id="category.name"
                        :name="category.name"
                        :value="category.name"
                    />
                </div>
            </div>
            <!-- Restaurants Card Wrapper -->
            <div
                class="restaurant-wrapper d-flex justify-content-start flex-wrap"
            >
                <div
                    class="restaurant-card col-4"
                    v-for="restaurant in restaurants"
                    :key="restaurant.id"
                >
                    <img
                        class="w-50"
                        :src="restaurant.restaurant_cover"
                        :alt="restaurant.restaurant_name"
                    />
                    <div class="restaurant-info">
                        <h5>{{ restaurant.restaurant_name }}</h5>
                        <router-link
                            class="nav-link btn btn-success"
                            :to="{
                                name: 'restaurant',
                                params: { slug: restaurant.slug },
                            }"
                            >Vedi piatti</router-link
                        >
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
            restaurants: [],
            categoryId: [1, 2, 3, 4, 5, 6, 7],
            selectedCategories: [],
        };
    },
    methods: {
        getCategories() {
            axios.get("/api/categories/").then((response) => {
                this.categories = response.data.results;
            });
        },
        getRestaurants() {
            axios.get("/api/restaurants/").then((response) => {
                this.restaurants = response.data.results;
            });
        },
        changeRestaurants() {
            this.restaurants.filter((item) =>
                item.category.includes(this.selectedCategories)
            );
        },
    },
    mounted() {
        this.getCategories();
        this.getRestaurants();
    },
};
</script>

<style lang="scss" scoped>
.search-bar {
    background-color: lightcoral;
    height: 800px;
}
</style>
