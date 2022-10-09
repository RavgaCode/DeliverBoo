<template>
    <section class="menu-section">
        <!-- Page-top -->
        <div class="page-top">
            <!-- ----------------------------------------------------- -->
            <!-- Left-col - CART -->

            <div class="left-col">
                <div class="cart w-200">
                    <div
                        class="cart-container d-flex flex-column align-items-center"
                    >
                        <h2 class="cart-title">Il tuo Carrello</h2>
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
                                    <div
                                        @click="deleteItem(item)"
                                        class="minus-button quantity-btn"
                                    >
                                        -
                                    </div>
                                    <button
                                        @click="removeItemTotally(item)"
                                        class="remove-button btn-primary btn-danger rounded-pill"
                                    >
                                        remove
                                    </button>
                                    <div
                                        @click="newItem(item)"
                                        class="plus-button quantity-btn"
                                    >
                                        +
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- BOTTOM CART -->
                        <div class="bottom-cart">
                            <h5
                                class="total-price text-center"
                                v-show="cart.length > 0"
                            >
                                Totale: {{ totalSum }}&euro;
                            </h5>
                            <a
                                tag="button"
                                @click="payment()"
                                class="payment-button"
                                role="button"
                                href="/payment"
                                v-show="cart.length > 0"
                            >
                                Pay
                            </a>
                            <span
                                @click="discardCart()"
                                class="discard-cart-button"
                                v-show="cart.length > 0"
                            >
                                Cancel
                            </span>
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
                <p>Indirizzo: {{ plates[0].user.restaurant_address }}</p>
                <hr />
                <!-- HOVERED PLATE INFO -->
                <div
                    class="hovered-plate-info"
                    v-for="singlePlate in plates"
                    :key="singlePlate.id"
                >
                    <h4>{{ singlePlate.name }}</h4>
                    <p>{{ singlePlate.description }}</p>
                </div>
            </div>
        </div>

        <!-- -------------------------------------------- -->
        <!-- PAGE BOTTOM-->
        <div class="page_bottom">
            <!-- PLATE COLUMNS -->
            <div class="plate-columns d-flex flex-wrap my-2">
                <!-- PLATE COL -->
                <div
                    class="plate-col col-4 my-2"
                    v-for="singlePlate in plates"
                    :key="singlePlate.id"
                >
                    <!-- PLATE CARD -->
                    <div class="plate-card" v-if="singlePlate.visibility === 1">
                        <!-- Cover -->
                        <img
                            :src="singlePlate.cover"
                            class="plate-img"
                            :alt="singlePlate.name"
                        />
                        <!-- INFO PLATE CONTAINER -->
                        <div class="info-plate">
                            <div class="plate-name-price">
                                <span
                                    >{{ singlePlate.name }} |
                                    {{ singlePlate.price }}&euro;</span
                                >
                            </div>
                            <!-- Info-plate-btn -->
                            <div
                                @click="newItem(singlePlate)"
                                class="info-plate-btn"
                                :key="singlePlate.id"
                            >
                                <i
                                    class="fa fa-plus-circle"
                                    aria-hidden="true"
                                ></i>
                            </div>
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
    min-height: calc(100vh - 80px);
    width: 100%;
    position: relative;
}
.cart-container {
    width: 400px;
    color: white;
    border: 2px solid white;
    border-radius: 15px;
    background-image: url("http://www.zingerbugimages.com/backgrounds/black_abstract_stone_pattern_tileable.jpg");
    box-shadow: 3px 3px 3px 5px black;
    .cart-title {
        font-style: italic;
        padding-block: 1rem;
    }

    .top-cart {
        height: 35vh;
        overflow-y: auto;
        padding-inline: 10px;

        .product-row {
            width: 100%;
        }
        .quantity-btn {
            color: white;
            border: 2px solid white;
            border-radius: 50%;
            background-color: none;

            font-size: large;
            font-weight: 800;

            &:hover {
                background-color: #ffcc00;
                color: black;
                cursor: pointer;
                border: 2px solid black;
            }
        }
        .minus-button {
            padding: 2px 14px;
        }
        .plus-button {
            padding: 3px 12px;
        }
    }
    .bottom-cart {
        padding-block: 0.3rem;
        height: 10vh;

        .payment-button {
            display: inline-block;
            text-decoration: none;
            background-color: #ffcc00;
            color: black;
            padding: 7px 18px;
            border-radius: 5px;
        }
        .discard-cart-button {
            display: inline-block;
            cursor: pointer;
            background-color: #cc5500;
            color: black;
            padding: 7px 18px;
            border-radius: 5px;
        }
    }
}
.page-top {
    display: flex;
    padding: 2rem;

    .left-col {
        width: 50%;
    }

    .right-col {
        width: 50%;
    }
}
.hovered-plate-info {
    display: none;
}
.plate-col:hover ~ .hovered-plate-info {
    display: block;
}
.page_bottom {
    width: 100%;
    border-top: 2px solid black;
}

.plate-card {
    border: 1px solid grey;
    position: relative;
    border-radius: 12px;
}
.plate-img {
    max-width: 100%;
    border-radius: 12px;
}
.info-plate {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
    display: flex;
    justify-content: space-between;
    padding-block: 2rem;
    padding-inline: 2rem;
    font-size: large;
    font-weight: 600;
}
.info-plate-btn {
    color: white;
    background-color: none;

    font-size: x-large;
    font-weight: 800;

    &:hover {
        color: #ffcc00;

        cursor: pointer;
    }
}
</style>
