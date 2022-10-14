<template>
    <section class="menu-section">
        <!-- Page-top -->
        <div class="page-top row">
            <!-- ----------------------------------------------------- -->
            <!-- Left-col - CART -->

            <div class="left-col col-12 col-lg-6 order-2 order-lg-1">
                <div
                    class="cart d-flex justify-content-center justify-content-lg-start"
                >
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
                                    <div class="product-quantity d-flex">
                                        <div @click="deleteItem(item)">
                                            <a
                                                href="#"
                                                class="quantity-cart-btn"
                                                ><i
                                                    class="fa fa-minus-circle"
                                                    aria-hidden="true"
                                                ></i
                                            ></a>
                                        </div>

                                        <div class="quantity">
                                            X{{ item.quantity }}
                                        </div>
                                        <div @click="newItem(item)">
                                            <a
                                                href="#"
                                                class="quantity-cart-btn"
                                                ><i
                                                    class="fa fa-plus-circle"
                                                    aria-hidden="true"
                                                ></i
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="product-name">
                                        {{ item.name }}
                                    </div>
                                    <div class="product-cart-subtotal">
                                        {{ item.subTotal }}&euro;
                                    </div>
                                </div>
                                <!-- PRODUCT BUTTONS ROW -->
                                <div
                                    class="product-buttons-row d-flex justify-content-between w-100"
                                >
                                    <a
                                        href="#"
                                        @click="removeItemTotally(item)"
                                        class="remove-button"
                                    >
                                        <i
                                            class="fa fa-trash"
                                            aria-hidden="true"
                                        ></i>
                                    </a>
                                    <div
                                        v-if="item.quantity > 1"
                                        class="product-cart-price"
                                    >
                                        ({{ item.price }}
                                        &euro;)
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
                            <span
                                @click="discardCart()"
                                class="discard-cart-button"
                                v-show="cart.length > 0"
                            >
                                Cancel
                            </span>
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right-col -->
            <div class="right-col col-12 col-lg-6 order-1 order-lg-2">
                <h2>{{ plates[0].user.restaurant_name }}</h2>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Neque ut quibusdam rem. Eligendi delectus in nulla molestias
                    eius cumque consectetur libero, velit, eos architecto
                    facilis obcaecati culpa ullam, laborum earum.
                </p>
                <p>Indirizzo: {{ plates[0].user.restaurant_address }}</p>
                <p>Orari: 12-15, 18-23:30</p>
                <p>Giorni: Dal martedì alla domenica. Lunedì chiuso</p>
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
                    class="plate-col col-12 col-md-6 col-lg-4 my-2"
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
                            <!-- ADD-plate-btn-->
                            <div
                                @click="newItem(singlePlate)"
                                class="add-plate-btn"
                                :key="singlePlate.id"
                            >
                                <i
                                    class="fa fa-plus-circle"
                                    aria-hidden="true"
                                ></i>
                            </div>
                        </div>
                        <!-- Ingredient info btn PLUS-->
                        <button
                            v-if="!singlePlate.isVisible"
                            class="info-plate-ingredients-btn"
                            @click="
                                singlePlate.isVisible = !singlePlate.isVisible
                            "
                        >
                            Info
                            <span
                                ><i
                                    class="fa fa-plus-circle"
                                    aria-hidden="true"
                                ></i
                            ></span>
                        </button>
                        <!-- Ingredient info btn MINUS-->
                        <button
                            v-if="singlePlate.isVisible"
                            class="info-plate-ingredients-btn"
                            @click="
                                singlePlate.isVisible = !singlePlate.isVisible
                            "
                        >
                            Info
                            <span
                                ><i
                                    class="fa fa-minus-circle"
                                    aria-hidden="true"
                                ></i
                            ></span>
                        </button>
                        <!-- INFO PLATE INGREDIENTS -->
                        <div
                            v-if="singlePlate.isVisible"
                            class="info-plate-ingredients"
                            :key="singlePlate.id"
                        >
                            <p>
                                Ingredienti: <br />
                                {{ singlePlate.description }}
                            </p>
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
            savCart: null,
            totalSum: null,
        };
    },

    methods: {
        newItem(singlePlate) {
            let item = {
                id: singlePlate.id,
                name: singlePlate.name,
                price: singlePlate.price,
                subTotal: singlePlate.price,
                user_id: singlePlate.user_id,
                quantity: 1,
            };
            // Verifico se nel carrello esiste un oggetto appartenente ad un altro ristorante. Nel caso ci fosse, chiedo conferma all'utente se vuole continuare con l'operazione che cancellerebbe il carrello presistente
            if (this.cart.length > 0) {
                if (item.user_id != this.cart[0].user_id) {
                    if (
                        confirm(
                            "Questa azione cancellerebbe il tuo carrello. Sei sicuro di volere procedere?"
                        )
                    ) {
                        this.discardCart();
                    } else {
                        return;
                    }
                }
            }

            //creo un oggetto con i valori presi dal piatto e stabilisco una quantità iniziale di 1
            let checkItemId = this.cart.find(
                (product) => product.id == item.id
            );

            //controllo se è già presente un item nel carrello con lo stesso id di quello appena creato, in caso affermativo ne aumento la quantità, sennò aggiungo il nuovo item al cart
            if (checkItemId) {
                checkItemId.quantity++; //aggiorno il subtotale
                checkItemId.subTotal = parseFloat(
                    `${checkItemId.subTotal * 1 + checkItemId.price * 1}`
                ).toFixed(2);
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
                checkItemId.quantity--; //aggiorno il subtotale
                checkItemId.subTotal = parseFloat(
                    `${checkItemId.subTotal * 1 - checkItemId.price * 1}`
                ).toFixed(2);

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
            this.payment();
            console.log(localStorage);
        },

        getPlates() {
            axios
                .get("/api/restaurants/" + this.$route.params.slug)
                .then((response) => {
                    console.log(response.data.results);
                    this.plates = response.data.results.map((item) => ({
                        //uso map per aggiungere la variabile isVisible, che per mi servirà per lo show delle info ingredienti nelle card
                        ...item,
                        isVisible: false,
                    }));
                });
        },
        payment() {
            if (typeof Storage !== undefined) {
                let cart = JSON.stringify(this.cart); //rendo JSON il contenuto del cart
                localStorage.setItem("cart", cart); //lo inserisco in una variabile localStorage di nome 'cart'
                this.cart = JSON.parse(localStorage.getItem("cart"));

                let totalSum = JSON.stringify(this.totalSum); //rendo JSON il totale
                localStorage.setItem("totalSum", totalSum); //lo inserisco in una variabile localStorage di nome 'totalSum'
                this.totalSum = JSON.parse(localStorage.getItem("totalSum"));
                console.log("pagamento eseguito");
            }
        },
        savedCart() {
            if (localStorage.getItem("cart")) {
                try {
                    //Trasformalo in stringa
                    this.cart = JSON.parse(localStorage.getItem("cart"));
                    this.totalSum = JSON.parse(
                        localStorage.getItem("totalSum")
                    );
                } catch (e) {
                    //Altrimenti rimuovi cart da localStorage
                    localStorage.removeItem("cart");
                    localStorage.removeItem("totalSum");
                }
            }
        },
        // async mounted() {
        //     await this.savedCart();
        // },
    },

    created() {
        this.getPlates(), this.savedCart();
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
    border-radius: 15px;
    background-image: url("../images/back.png");
    background-size: cover;
    border: 2px solid black;
    // box-shadow: rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
    .cart-title {
        padding-block: 1rem;
    }

    .top-cart {
        height: 35vh;
        overflow-y: auto;
        padding-inline: 10px;

        .product-row {
            width: 100%;
        }
        .quantity {
            padding-inline: 0.5rem;
        }
        .quantity-cart-btn {
            color: white;
            font-size: larger;

            &:hover {
                color: #ffcc00;
            }
        }
        .remove-button {
            color: #cc5500;
        }
        .product-cart-price {
            font-size: smaller;
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
    box-shadow: 0px 15px 10px -15px rgba(0, 0, 0, 0.76);

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
    z-index: 3;
    bottom: 0;
    left: 0;
    max-height: 100%;
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
.add-plate-btn {
    color: white;
    background-color: none;

    font-size: x-large;
    font-weight: 800;

    &:hover {
        color: #ffcc00;

        cursor: pointer;
    }
}
.info-plate-ingredients {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 2;
    height: 100%;
    width: 100%;
    border-radius: 12px;
    color: white;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 2.5rem 2rem;
    overflow-y: auto;
}
.info-plate-ingredients-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 4;
    color: white;
    background: none;
    border: none;

    &:hover {
        color: #ffcc00;
    }
}
@media screen and (max-width: 991px) {
    .cart-container {
        width: 100%;
    }
}
@media screen and (min-width: 992px) {
    .cart-container {
        width: 70%;
        max-width: 410px;
    }
}
</style>
