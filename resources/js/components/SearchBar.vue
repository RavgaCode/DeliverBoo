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
                        @change="changeRestaurants()"
                        type="checkbox"
                        v-model="selectedCategories"
                        :id="category.id"
                        :name="category.id"
                        :value="category.id"
                        checked
                    />
                </div>
            </div>
            <div class="cards">
                <!-- Restaurants Card Wrapper -->
                <div
                    class="restaurant-wrapper row row-cols-1 row-cols-lg-4 row-cols-sm-1 g-2"
                    v-if="unchecked"
                >
                    <!-- card -->
                    <div
                        class="restaurant-card col-1 card"
                        v-for="restaurant in restaurants"
                        :key="restaurant.id"
                    >
                        <img
                            class="cover"
                            :src="restaurant.restaurant_cover"
                            :alt="restaurant.restaurant_name"
                        />
                        <div class="restaurant-info">
                            <h5>{{ restaurant.restaurant_name }}</h5>
                            <router-link
                                class="nav-link btn"
                                :to="{
                                    name: 'restaurant',
                                    params: { slug: restaurant.slug },
                                }"
                                >Vedi piatti</router-link
                            >
                        </div>
                    </div>
                </div>
                <!-- else -->
                <div
                    class="restaurant-wrapper row row-cols-1 row-cols-lg-4 row-cols-sm-1 g-2"
                    v-else
                >
                    <!-- card -->
                    <div
                        class="restaurant-card col-1 card"
                        v-for="restaurant in filteredRestaurant"
                        :key="restaurant.id"
                    >
                        <img
                            class="cover"
                            :src="restaurant.restaurant_cover"
                            :alt="restaurant.restaurant_name"
                        />
                        <div class="restaurant-info">
                            <h5>{{ restaurant.restaurant_name }}</h5>
                            <router-link
                                class="nav-link btn"
                                :to="{
                                    name: 'restaurant',
                                    params: { slug: restaurant.slug },
                                }"
                                >Vedi piatti</router-link
                            >
                        </div>
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
            unchecked: true,
            filteredRestaurant: [],
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
            this.filteredRestaurant = this.restaurants.filter((el) => {
                return el.category[0].id === this.selectedCategories[0];
            });

            if (this.selectedCategories.length > 0) {
                this.unchecked = false;
            } else {
                this.unchecked = true;
            }
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
    padding-top: 40px;
    background-color: rgb(255, 204, 0);
    height: 800px;
    margin-bottom: 20px;
    overflow-y: auto;

    .card {
        background-color: transparent;
        border: none;
        padding: 20px;
        width: 80%;
        position: relative;
        h5 {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: 600;
        }
    }

    .cover {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        margin-bottom: 20px;
        -webkit-filter: brightness(40%);
    }

    img {
        transition: transform 1.5s, filter 1s ease-in;
    }
    img:hover {
        transform: scale(1.1);
    }

    .btn {
        background-color: black;
        color: white;
        border-bottom-left-radius: 20px;
        border-top-right-radius: 20px;
    }
}

.filter-box {
    input {
        margin-top: 20px;
        margin-right: 15px;
    }
}
</style>
