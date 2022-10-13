<template>
    <section class="search-bar" id="search">
        <div class="container">
            <h2>I tuoi ristoranti preferiti</h2>
            <div class="search-section">
                <!-- Text Searchbar -->
                <div class="text-searchbar-container row">
                     <div class="input-group col-12 col-lg-4">
                        
                        <input type="search" id="text-searchbar" name="text-searchbar" class="form-control" @keyup="search()" v-model="searchValue"  placeholder="Cerca il tuo ristorante preferito"/>
                        <label class="form-label" for="text-searchbar"></label>
                    
                        <button type="button" class="btn-search btn-dark" @click="search()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- Category Filters -->
                <div class="filters-container d-flex justify-content-start flex-wrap">
                    <div
                        class="filter-box"
                        v-for="category in categories"
                        :key="category.id"
                    >   
                        <input
                            @change="getRestaurants()"
                            type="checkbox"
                            v-model="selectedCategories"
                            :id="category.id"
                            :name="category.id"
                            :value="category.id"
                            class = "filter"

                        />
                        <label :for="category.id">{{ category.name }}</label>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="cards container">
                <!-- Restaurants Card Wrapper -->
                <div
                    class="restaurant-wrapper row justify-content-center justify-content-lg-start g-2"
                >
                    <!-- card -->
                    <div
                        class="restaurant-card col-12 col-sm-12 col-md-6 col-lg-3 card"
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
            searchValue: '',
            // isActive: false,
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
        },

        // active(i) {
        //     // if(i === 1) {
        //     //     this.isActive = true
        //     // }

        //     selectedCategories
            
        // }
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
    height: 900px;
    margin-bottom: 20px;


    .btn-search {
        padding: 0 30px;
        background-color: rgb(0, 0, 0);
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        border: none;
        box-shadow: rgba(105, 84, 0, 0.15) 1.95px 1.95px 2.6px;;
    }

    .filter-box {
        padding: 0 5px;
        label {
            margin-right: 10px;
        }
    }

    .filter {
            display: none;
    }
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

label {
    padding: 5px 0;
    cursor: pointer;
}

.filter:checked + label {
    color: white;
    border-bottom: 2px solid white;
}


.search-section {
    margin: 5px;
    box-shadow: 0px 15px 10px -15px rgba(0, 0, 0, 0.76);    
}

.cards {
    height: 80%;
    overflow-y: auto;
}

::-webkit-scrollbar
{
    background-color: #f5f5f523;
    
}

::-webkit-scrollbar-thumb
{
    background-color: #000000bb;
    border-radius: 20px;
}

.input-group {
    margin: 20px 0;
}

</style>
