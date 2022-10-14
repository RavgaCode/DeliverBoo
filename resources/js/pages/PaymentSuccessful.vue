<template>
    <section class="d-flex flex-column align-items-center">
        <div class="message">
            <h3>Pagamento avvenuto con successo</h3>
            <h2>Grazie per averci scelto. Torna alla <a href="/">Home</a></h2>
        </div>
    </section>
</template>

<script>
export default {
    name: "PaymentSuccessful",
    data() {
        return {};
    },
    methods: {},
};
</script>

<style lang="scss" scoped>
section {
    min-height: calc(100vh - 80px);
}
.message {
    margin: auto;
    text-align: center;
}
</style>
