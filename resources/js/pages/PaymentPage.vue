<template>
    <div class="order-box">
        <div
            focus
            v-if="success"
            class="text-center alert alert-success confirmPayment pt-5"
        >
            Il tuo ordine é avvenuto con successo! <br />
            Il tuo ordine è già in preparazione!
            <br />
            Clicca il link per tornare alla<router-link
                class="home-link mb-1 mx-1"
                :to="{ name: 'home' }"
                >Home</router-link
            >
        </div>
        <!-- Credenziali  -->
        <div class="container">
            <div
                v-if="unsuccess"
                class="row row-cols-1 row-cols-lg-2 d-block d-flex"
            >
                <!-- Riepilogo ordine -->
                <div class="col container">
                    <div class="row">
                        <div class="col-12 col-lg-10">
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4>Riepilogo ordine:</h4>
                                </div>

                                <div
                                    class="card-body"
                                    v-for="(item, index) in order"
                                    :key="index"
                                >
                                    <div>
                                        <strong
                                            >Articolo: {{ item.name }}</strong
                                        >
                                    </div>
                                    <div>
                                        <strong
                                            >Totale piatti:
                                            {{ item.quantity }}</strong
                                        >
                                    </div>
                                    <div>
                                        <strong>Prezzo unitario: </strong
                                        >{{ item.price }}€
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="total-sum" :v-bind="totalCost">
                                        Totale: {{ totalCost }}€
                                    </h5>
                                </div>
                                <!-- -------------------- -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PAYMENT FORM -->
                <div class="col container">
                    <form method="POST" @submit.prevent="submit()">
                        <div class="row">
                            <div class="col-12 col-lg-10">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h3>Compila i campi</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <!-- Inserisci il tuo nome -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="customer_name"
                                                            >Nome e
                                                            Cognome*</label
                                                        >
                                                        <input
                                                            v-model="name"
                                                            class="form-control"
                                                            :class="{
                                                                'is-invalid':
                                                                    errors.customer_name,
                                                            }"
                                                            id="customer_name"
                                                            type="text"
                                                            placeholder="Inserire nome e cognome"
                                                            required
                                                        />
                                                        <p
                                                            v-for="(
                                                                error, index
                                                            ) in errors.customer_name"
                                                            :key="index"
                                                            class="invalid-feedback"
                                                        >
                                                            {{ error }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Inserisci il tuo indirizzo -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="customer_address"
                                                            >Inserire
                                                            indirizzo*</label
                                                        >
                                                        <input
                                                            v-model="address"
                                                            class="form-control"
                                                            :class="{
                                                                'is-invalid':
                                                                    errors.customer_address,
                                                            }"
                                                            id="customer_address"
                                                            type="text"
                                                            placeholder="es. via Dei Mille, 42"
                                                            required
                                                        />
                                                        <p
                                                            v-for="(
                                                                error, index
                                                            ) in errors.customer_address"
                                                            :key="index"
                                                            class="invalid-feedback"
                                                        >
                                                            {{ error }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Inserisci il tuo contatto telefonico -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="customer_telephone"
                                                            >Inserire numero di
                                                            telefono*</label
                                                        >
                                                        <input
                                                            v-model="tel"
                                                            :class="{
                                                                'is-invalid':
                                                                    errors.customer_telephone,
                                                            }"
                                                            class="form-control"
                                                            id="customer_telephone"
                                                            type="tel"
                                                            pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
                                                            placeholder="123-456-7890"
                                                            required
                                                        />
                                                        <p
                                                            v-for="(
                                                                error, index
                                                            ) in errors.customer_telephone"
                                                            :key="index"
                                                            class="invalid-feedback"
                                                        >
                                                            {{ error }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Inserisci la tua email -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="customer_email"
                                                            >Inserire
                                                            email*</label
                                                        >
                                                        <input
                                                            v-model="email"
                                                            :class="{
                                                                'is-invalid':
                                                                    errors.customer_email,
                                                            }"
                                                            class="form-control"
                                                            id="customer_email"
                                                            type="email"
                                                            placeholder="es. alessandro@gmail.com"
                                                            required
                                                        />
                                                        <p
                                                            v-for="(
                                                                error, index
                                                            ) in errors.customer_email"
                                                            :key="index"
                                                            class="invalid-feedback"
                                                        >
                                                            {{ error }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div
                                                    id="dropin-container"
                                                ></div>
                                                <button
                                                    id="submit-button"
                                                    class="button button--small button--green"
                                                    @click="payment()"
                                                >
                                                    Purchase
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ------ -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal confirm -->
    </div>
</template>

<script>
export default {
    name: "PaymentPage",
    data() {
        return {
            order: null,
            finalCart: null,
            totalCost: null,
            name: "",
            address: "",
            tel: "",
            email: "",
            message: "",
            tokenApi: "",
            form: {
                amount: "",
                token: "",
            },

            sendingInProgress: false,
            errors: {},
            success: false,
            unsuccess: true,
            hostedFieldInstance: false,
            nonce: "",
            error: "",

            emptyCart: [],
        };
    },
    methods: {
        submit() {
            console.log("form submitted");
        },
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
        getToken() {
            axios.get("/api/orders/generate").then((response) => {
                this.tokenApi = response.data.token;
                console.log("Client Token Preso!");
                this.form.token = this.tokenApi;
                this.form.amount = this.totalCost;
            });
        },
        storeOrder() {
            axios
                .post("/api/orders/store/order", {
                    customer_name: this.name,
                    customer_address: this.address,
                    customer_telephone: this.tel,
                    customer_email: this.email,
                    user_id: this.order[0].user_id,
                    cart: this.finalCart,
                    total_price: this.totalCost,
                })
                .then((response) => {
                    if (response.data.success) {
                        this.success = true;
                        this.unsuccess = false;
                        // svuoto i campi
                        this.name = "";
                        this.tel = "";
                        this.email = "";
                        this.address = "";
                        this.errors = {};
                        let cart = JSON.stringify(this.emptyCart);
                        localStorage.setItem("cart", cart);
                        console.log("ordine inviato");
                    } else {
                        // this.errors = response.data.errors;
                        this.success = true;
                        this.unsuccess = false;
                        // svuoto i campi
                        this.name = "";
                        this.tel = "";
                        this.email = "";
                        this.address = "";
                        this.errors = {};
                        let cart = JSON.stringify(this.emptyCart);
                        localStorage.setItem("cart", cart);
                        console.log("ordine inviato");
                    }
                });
        },

        payment() {
            this.sendingInProgress = false;
            try {
                axios.post("/api/orders/make/payment", {
                    ...this.form,
                });
                this.sendingInProgress = true;
                this.storeOrder();
                console.log("transazione avvenuta");
            } catch (error) {
                this.sendingInProgress = true;
                this.storeOrder();
                console.log("transazione non riuscita");
            }
        },
    },
    mounted() {
        braintree.dropin.create({
            authorization: "sandbox_24vpd3x8_nygdb38w72q7j389",
            selector: "#dropin-container",
        });
    },
    created() {
        this.getOrder(), this.getToken();
    },
};
</script>

<style lang="scss" scoped>
.order-box {
    min-height: calc(100vh - 80px);
}
.confirmPayment {
    transform: translateY(120%);
    height: 150px;
    opacity: 0.9;
}
.total-sum {
    background-color: #ffcc00;
    color: black;
    padding: 10px 32px;
    border-radius: 20px;
    display: inline-block;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    margin-bottom: 1.5rem;
    min-width: 0;
    word-wrap: break-word;
    background-color: #5a3421;
    background-clip: border-box;
    border: none;
    border-radius: 0.25rem;
    color: white;
}
.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #cc5500;
    border-bottom: 1px solid white;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
}
.form-control:focus {
    color: #5c6873;
    background-color: white;
    border-color: white;
    outline: 0;
    box-shadow: 0 0 0 #f44336;
}
.button {
    cursor: pointer;
    font-weight: 500;
    left: 3px;
    line-height: inherit;
    position: relative;
    text-decoration: none;
    text-align: center;
    border-style: solid;
    border-width: 1px;
    border-radius: 3px;
    -webkit-appearance: none;
    -moz-appearance: none;
    display: inline-block;
}

.button--small {
    padding: 10px 20px;
    font-size: 0.875rem;
}

.button--green {
    outline: none;
    background-color: #64d18a;
    border-color: #64d18a;
    color: white;
    transition: all 200ms ease;
}

.button--green:hover {
    background-color: #8bdda8;
    color: white;
}
.home-link {
    color: #cc5500;
}
</style>
