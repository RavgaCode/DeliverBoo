<template>
    <div>
        <header>
            <Header />
        </header>

        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import Header from "../components/Header.vue";

export default {
    name: "App",
    components: {
        Header,
    },
};
</script>

<style lang="scss" scoped>
main {
    background-color: rgb(255, 204, 0);
    scroll-behavior: smooth;
}
</style>
