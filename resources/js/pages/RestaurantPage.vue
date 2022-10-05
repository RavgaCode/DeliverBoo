<template>
    <section class="menu-section">
        <!-- Page-top -->
        <div class="page-top">
            <!-- Left-col - CART -->

            <div class="left-col">
                <div class="cart w-200">
                    <div
                        class="cart-container d-flex flex-column align-items-center"
                    >
                        <h2>Il tuo Carrello</h2>
                        <!-- TOP CART -->
                        <div class="top-cart w-100">
                            <div
                                v-for="(item, index) in cart"
                                :key="index"
                                class="item-wrapper w-100 py-2"
                            >
                                <!-- NEW ITEM/PRODUCT ROW -->
                                <div
                                    class="product-row d-flex justify-content-between"
                                >
                                    <div class="product-quantity">
                                        X{{ item.quantity }}
                                    </div>
                                    <div class="product-name">
                                        {{ item.name }}
                                    </div>
                                    <div class="product-price">
                                        {{ item.price }}&euro;
                                    </div>
                                </div>
                                <!-- PRODUCT BUTTONS ROW -->
                                <div
                                    class="product-buttons-row d-flex justify-content-between w-100"
                                >
                                    <button
                                        @click="deleteItem(item)"
                                        class="minus-button btn-primary rounded-pill p-2"
                                    >
                                        -
                                    </button>
                                    <button
                                        @click="removeItemTotally(item)"
                                        class="remove-button btn-primary btn-danger rounded-pill"
                                    >
                                        remove
                                    </button>
                                    <button
                                        @click="newItem(item)"
                                        class="plus-button btn-primary rounded-pill p-2"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- BOTTOM CART -->
                        <div class="bottom-cart">
                            <h5 class="total-price">
                                Totale: {{ totalSum }}&euro;
                            </h5>
                            <button
                                @click="payment()"
                                class="pay-button btn-primary btn-success"
                            >
                                Pay
                            </button>
                            <button
                                @click="discardCart()"
                                class="discard-cart-button btn-primary btn-danger"
                            >
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right-col -->
            <div class="right-col">
                <h2>{{ plates[0].user.restaurant_name }}</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Neque ut quibusdam rem. Eligendi delectus in nulla molestias
                    eius cumque consectetur libero, velit, eos architecto
                    facilis obcaecati culpa ullam, laborum earum.
                </p>
            </div>
        </div>

        <!-- Page-bottom -->
        <div class="page_bottom">
            <!-- Plates -->
            <div class="plate-slider">
                <!-- PLATE COLUMNS -->
                <div class="plate-columns">
                    <!-- PLATE COL -->
                    <div
                        class="plate-col"
                        v-for="singlePlate in plates"
                        :key="singlePlate.id"
                    >
                        <!-- PLATE CARD -->
                        <div
                            class="plate-card"
                            v-if="singlePlate.visibility === 1"
                        >
                            <!-- Cover -->
                            <img
                                :src="singlePlate.cover"
                                class="card-img-top"
                                :alt="singlePlate.name"
                            />
                            <!-- PLATE NAME -->
                            <h5>{{ singlePlate.name }}</h5>
                            <!-- ADD BUTTON -->
                            <h4>{{ singlePlate.price }}</h4>
                            <button
                                @click="newItem(singlePlate)"
                                class="btn-primary rounded-circle btn-success"
                            >
                                +
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "RestaurantPage",
    components: {},

    data() {
        return {
            plates: [],
            cart: [],
            totalSum: null,
        };
    },

    methods: {
        newItem(singlePlate) {
            let item = {
                id: singlePlate.id,
                name: singlePlate.name,
                price: singlePlate.price,
                user_id: singlePlate.user_id,
                quantity: 1,
            }; //creo un oggetto con i valori presi dal piatto e stabilisco una quantità iniziale di 1
            let checkItemId = this.cart.find(
                (product) => product.id == item.id
            ); //controllo se è già presente un item nel carrello con lo stesso id di quello appena creato, in caso affermativo ne aumento la quantità, sennò aggiungo il nuovo item al cart
            if (checkItemId) {
                checkItemId.quantity++;
            } else {
                this.cart.push(item);
            }
            this.updateTotalSum();
        },
        deleteItem(item) {
            // Trovo l'id dell'item e ne riduco la quantità. In caso la quantità sia ZERO, elimino l'item dall'array del cart
            let checkItemId = this.cart.find(
                (product) => product.id == item.id
            );
            if (checkItemId) {
                checkItemId.quantity--;

                if (checkItemId.quantity == 0) {
                    let itemIndex = this.cart.findIndex(
                        (element) => element.id == item.id
                    );
                    this.cart.splice(itemIndex, 1);
                }
                this.updateTotalSum();
            }
        },
        removeItemTotally(item) {
            let itemIndex = this.cart.findIndex(
                (element) => element.id == item.id
            );
            this.cart.splice(itemIndex, 1);

            this.updateTotalSum();
        },
        discardCart() {
            this.cart = [];
            this.updateTotalSum();
        },
        updateTotalSum() {
            this.totalSum = this.cart.reduce((previousValor, object) => {
                return parseFloat(
                    (previousValor + object.price * object.quantity).toFixed(2)
                );
            }, 0);
        },
        getPlates() {
            axios
                .get("/api/restaurants/" + this.$route.params.slug)
                .then((response) => {
                    this.plates = response.data.results;

                    // if (response.data.success) {
                    //     this.plates = response.data.results;
                    // }else{
                    //     this.$router.push({name: 'error'});
                    // };
                });
        },
        payment() {
            if (typeof Storage !== undefined) {
                let cart = JSON.stringify(this.cart); //rendo JSON il contenuto del cart
                localStorage.setItem("cart", cart); //lo inserisco in una variabile localStorage di nome 'cart'

                let totalSum = JSON.stringify(this.totalSum); //rendo JSON il totale
                localStorage.setItem("totalSum", totalSum); //lo inserisco in una variabile localStorage di nome 'totalSum'
                console.log("pagamento eseguito");
            } else {
                alert("Il browser non supporta web storage"); //mostro all'utente un messaggio di errore
            }
        },
    },
    mounted() {
        this.getPlates();
    },
};
</script>

<style lang="scss" scoped>
.menu-section {
    height: calc(100vh - 80px);
    width: 100%;
    position: relative;
}
.cart-container {
    width: 400px;
    border: 2px solid white;
    border-radius: 15px;
    background-color: lightgray;

    .top-cart {
        padding-inline: 10px;

        .product-row {
            width: 100%;
        }
    }
}
.page-top {
    display: flex;
    .left-col {
        width: 50%;
    }

    .right-col {
        width: 50%;
    }
}

.page_bottom {
    width: 100%;
    position: fixed;
    left: 0;
    bottom: 0;

    .plate-slider {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap;
        overflow-x: auto;
        width: 100%;

        .plate-columns {
            display: flex;
            justify-content: space-between;
            width: 100%;

            .plate-col {
                width: calc(100% / 3);
            }
        }
    }
    .plates-cart {
        width: 30%;
    }

    .plate-descrption {
        width: 70%;
    }

    img {
        width: 200px;
    }
}
</style>
