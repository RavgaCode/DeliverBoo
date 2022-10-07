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
                    v-model="searchValue"
                    @keyup="search()"
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
                        @change="getRestaurants()"
                        type="checkbox"
                        v-model="selectedCategories"
                        :id="category.id"
                        :name="category.id"
                        :value="category.id"
                    />
                </div>
            </div>
            <div class="cards">
                <!-- Restaurants Card Wrapper -->
                <div
                    class="restaurant-wrapper row row-cols-1 row-cols-lg-4 row-cols-sm-1 g-2"
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
            selectedCategories: [],
            searchValue: ''
        };
    },
    watch: {
        url() {
            this.filterTest();
        },
        params: {
            handler() {
                this.filterTest();
            },
            deep: true,
        },
    },
    methods: {
        getCategories() {
            axios.get("/api/categories/").then((response) => {
                this.categories = response.data.results;
            });
        },
        async getRestaurants() {
            this.isLoading = true;
            if (this.selectedCategories.length > 0) {
                let finalQuery = "";
                this.selectedCategories.forEach((el) => {
                    finalQuery += el + ",";
                });
                axios
                    .get(`/api/test/?category=${finalQuery}`)
                    .then((response) => {
                        this.restaurants = response.data.results;
                        console.log(response.data.results);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .get("/api/restaurants/")
                    .then((response) => {
                        this.restaurants = response.data.results;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },

        search() {
            
            axios.get(`/api/restaurants/`).then((response) => {
                    // this.restaurants = response.data.results;
                    if(this.searchValue) {
                        this.restaurants = response.data.results.filter(user => {
                            return user.restaurant_name.toLowerCase().includes(this.searchValue.toLowerCase())
                        })
                    } else {
                        this.restaurants = response.data.results;
                    }
                })
        }
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
