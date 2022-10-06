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
            <!-- Restaurants Card Wrapper -->
            <div class="restaurant-wrapper d-flex justify-content-start flex-wrap" v-if="unchecked">
                <!-- card -->
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

                <!-- prova -->
                <div class="restaurant-card">
                    <img
                        src="https://via.placeholder.com/150C/O https://placeholder.com/"
                        alt=""
                    />
                    <div class="restaurant-info">
                        <h5>Ai-Sushi</h5>
                    </div>
                </div>
            </div>
            <!-- else -->
            <div class="restaurant-wrapper d-flex justify-content-start flex-wrap" v-else>
                <!-- card -->
                <div
                    class="restaurant-card col-4"
                    v-for="restaurant in filteredRestaurant"
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

                <!-- prova -->
                <div class="restaurant-card">
                    <img
                        src="https://via.placeholder.com/150C/O https://placeholder.com/"
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
            unchecked: true,
            filteredRestaurant: []
            
        };
    },

    methods: {
        getCategories() {
            axios.get("/api/categories/",).then((response) => {
                this.categories = response.data.results;
                
            });
        },
        getRestaurants() {
            axios.get("/api/restaurants/").then((response) => {
                this.restaurants = response.data.results;
            });
        },
        changeRestaurants() {
             
            this.filteredRestaurant = this.restaurants.filter((el)=> {
                return el.category[0].id === this.selectedCategories[0]
            })
           
            
            if(this.selectedCategories.length > 0) {
                this.unchecked = false
            } else {
                this.unchecked = true
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
    background-color: lightcoral;
    height: 800px;
}
</style>
