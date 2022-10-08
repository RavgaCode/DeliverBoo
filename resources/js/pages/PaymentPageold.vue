<template>
    <div class="container">
        <!-- Orders -->
        <div class="orders">
            <h2>Riepilogo ordine</h2>
            <h3>Nome :</h3>
            <div v-for="(item, index) in order" :key="index" class="card-item">
                <span>Quantità:{{ item.quantity }}</span
                ><span>Articolo:{{ item.name }}</span
                ><span>Prezzo unitario:{{ item.price }}&euro;</span>
            </div>
            <hr />
            <div>TOTALE:{{ totalCost }}&euro;</div>
        </div>

        <!-- User-info -->
        <div class="user-info">
            <h2>Inserisci i tuoi dati per concludere l'ordine</h2>

            <!-- User-Name -->
            <div>
                <label for="name">Nome</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Inserisci il tuo nome"
                />
            </div>
            <!-- User-Lastname -->
            <div>
                <label for="lastname">Cognome</label>
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    placeholder="Inserisci il tuo cognome"
                />
            </div>
            <!-- User-Adress -->
            <div>
                <label for="adress">Indirizzo</label>
                <input
                    type="text"
                    id="adress"
                    name="adress"
                    placeholder="Inserisci il tuo indirizzo"
                />
            </div>
            <!-- User-Email -->
            <div>
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Inserisci la tua email"
                />
            </div>
        </div>

        <!-- Payment -->
        <div class="payment">
            <div class="wrapper">
                <div
                    class="user-payment d-flex justify-content-between p-2 align-items-center"
                >
                    <div>Pay with card</div>
                    <div class="avaible-card">
                        <img src="../images/visa-card.png" alt="visa-card" />
                        <img
                            src="../images/master-card.png"
                            alt="master-card"
                        />
                        <img
                            src="../images/maestro-card.png"
                            alt="maestro-card"
                        />
                        <img
                            src="../images/american-express-card.png"
                            alt="amirican-express-card"
                        />
                    </div>
                </div>
                <hr />

                <!-- CODICE VECCHIO -->
                <!-- Card carta di credito -->
                <div class="col-8 offset-2">
                    <div class="card bg-light">
                        <div class="card-header">Payment Information</div>
                        <div class="card-body">
                            <div
                                class="alert alert-success"
                                v-if="nonce && success"
                            >
                                Successfully generated nonce.
                            </div>
                            <div class="alert alert-danger" v-if="error">
                                {{ error }}
                            </div>
                            <form>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                >€</span
                                            >
                                        </div>
                                        <div id="amount" class="form-control">
                                            <!-- {{ totale }} -->
                                            {{ totalCost }}
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group">
                                    <label>Credit Card Number</label>
                                    <div
                                        id="creditCardNumber"
                                        class="form-control"
                                    ></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label>Expire Date</label>
                                            <div
                                                id="expireDate"
                                                class="form-control"
                                            ></div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label>CVV</label>
                                            <div
                                                id="cvv"
                                                class="form-control"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    class="btn btn-primary btn-block"
                                    @click.prevent="payWithCreditCard"
                                >
                                    Pay with Credit Card
                                </button>
                                <hr />
                                <div id="paypalButton"></div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------------- -->
                <!-- <div class="form-payment-card"> -->
                <!-- Credit-card-number -->
                <!-- <div class="credit-card-number">
                        <label for="credit-card-number">Card number</label>
                        <input type="tel" id="credit-card-number" name="credit-card-number" inputmode="numeric" pattern="[0-9\s]{13,16}" autocomplete="cc-number" autocorrect="off" autocapitalize="none" maxlength="16" placeholder="•••• •••• •••• ••••">
                    </div> -->
                <!-- Expiration-date -->
                <!-- <div class="Expiration">
                        <label for="expiration-date">Expiration date</label>
                        <input type="tel" id="expiration-date" name="credit-card-number" maxlength="9" autocomplete="cc-number" autocorrect="off" autocapitalize="none" placeholder="MM/YY">
                    </div>
                </div> -->

                <!-- INIZIO CODICE BRAINTREE -->

                <div class="col-6 offset-3">
                    <div class="card bg-light">
                        <div class="card-header">Payment Information</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                >$</span
                                            >
                                        </div>
                                        <input
                                            type="number"
                                            id="amount"
                                            class="form-control"
                                            placeholder="Enter Amount"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Btn -->
            <div class="pay-btn">
                <button>
                    <a style="color: white" href="/payment-successful">Paga</a>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import braintree from "braintree-web";
export default {
    name: "PaymentPage",
    component: {},
    data() {
        return {
            order: null,
            finalCart: null,
            totalCost: null,
        };
    },
    methods: {
        getOrder() {
            if (typeof Storage !== "undefined") {
                console.log("ordine carico");

                let getCart = localStorage.getItem("cart");
                let cart = JSON.parse(getCart);
                this.order = cart;
                this.finalCart = JSON.stringify(this.order);
                let getTotal = localStorage.getItem("totalSum");
                let total = JSON.parse(getTotal);
                this.totalCost = total;
            }
        },
        payWithCreditCard() {
            if (this.hostedFieldInstance) {
                this.error = "";
                this.nonce = "";
                this.hostedFieldInstance
                    .tokenize()
                    .then((payload) => {
                        console.log(payload);
                        this.nonce = payload.nonce;
                        if (this.nonce == payload.nonce) {
                            this.handleSubmit();
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                        this.error = err.message;
                    });
            }
        },

        // handleSubmit() {
        //     this.sendingInProgress = true;
        //     axios
        //         .post("/api/orders", {
        //             customer_name: this.name,
        //             customer_address: this.address,
        //             customer_telephone: this.tel,
        //             customer_email: this.email,
        //             user_id: this.order[0].user_id,
        //             cart: this.finalCart,
        //             total_price: this.totalCost,
        //         })
        //         .then((response) => {
        //             this.sendingInProgress = true;
        //             if (response.data.errors) {
        //                 this.errors = response.data.errors;

        //                 this.success = false;
        //             } else {
        //                 this.success = true;
        //                 this.unsuccess = false;
        //                 this.name = "";
        //                 (this.tel = ""), (this.email = "");
        //                 (this.address = ""), (this.errors = {});
        //                 // let cart = JSON.stringify(this.emptyCart);
        //                 // localStorage.setItem("cart", this.finalCart);
        //             }
        //         });
        // },
    },
    mounted() {
        braintree.dropin.create(
            {
                authorization: "sandbox_g42y39zw_348pk9cgf3bgyw2b",
                selector: "#dropin-container",
            },
            function (err, instance) {
                button.addEventListener("click", function () {
                    instance.requestPaymentMethod(function (err, payload) {
                        // Submit payload.nonce to your server
                    });
                });
            }
        );
    },
    created() {
        this.getOrder();
    },
};
</script>

<style lang="scss" scoped>
ul {
    list-style-type: none;
}

label {
    display: block;
}

hr {
    height: 3px;
}

.orders {
    background-color: pink;
    border-radius: 10px;
    padding: 1rem;
}

.user-info {
    background-color: coral;
    border-radius: 10px;
    padding: 1rem;
    margin-top: 2rem;

    input {
        margin-bottom: 1rem;
        width: 100%;
    }
}

.payment {
    background-color: lightgreen;
    border-radius: 10px;
    padding: 2rem;
    margin-top: 2rem;
    .wrapper {
        background-color: lightskyblue;
        padding: 1rem;
    }
    .avaible-card {
        img {
            width: 50px;
        }
    }

    .pay-btn {
        text-align: center;
        padding-top: 2rem;
        button {
            padding: 10px 200px;
            background-color: #38c172;
            color: white;
            border-radius: 20px;
        }
    }
}
</style>
