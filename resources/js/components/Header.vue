<template>
    <nav class="d-flex">
        <!-- logo -->
        <div class="logo">
            <a href="/#"
                ><img src="../images/Deliver-removebg-preview.png" alt="logo"
            /></a>
        </div>

        <!-- Buttons -->
        <div class="buttons d-lg-flex d-md-none d-sm-none d-none links">
            <a href="#" @click="login()" class="btn login">Login</a>
            <a href="#" @click="register()" class="btn signup">Registrati</a>
        </div>

        <!-- burger menu -->
        <div class="burger d-lg-none">
            <button
                class="btn"
                @click="toggle()"
                type="button"
                id="dropdownMenuButton"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <i class="fa-solid fa-bars white"></i>
            </button>
            <ul
                class="dropdown-menu"
                aria-labelledby="dropdownMenuButton"
                :class="{
                    toggle: this.isActive === false,
                    'd-block': this.isActive === true,
                }"
            >
                <!-- <li
                    v-for="(link, index) in menuLinks"
                    :key="index"
                    class="nav-item"
                >
                    <router-link class="nav-link" :to="link.routeName">{{
                        link.labelName
                    }}</router-link>
                </li> -->
                <li>
                    <a href="#" @click="login()" class="btn login">Login</a>
                </li>
                <li>
                    <a href="#" @click="register()" class="btn signup"
                        >Registrati</a
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header",

    data() {
        return {
            menuLinks: [
                {
                    routeName: "/",
                    labelName: "Home",
                },
                {
                    routeName: "/about",
                    labelName: "About",
                },
                {
                    routeName: "/plates",
                    labelName: "Plates",
                },
                {
                    routeName: "/contact",
                    labelName: "Contact us",
                },
                {
                    routeName: "/payment",
                    labelName: "Payment",
                },
            ],
            isActive: false,
        };
    },
    methods: {
        login() {
            window.location.href = "http://127.0.0.1:8000/login";
        },
        register() {
            window.location.href = "http://127.0.0.1:8000/register";
        },
        toggle() {
            if (this.isActive) {
                this.isActive = false;
            } else {
                this.isActive = true;
            }

            console.log(this.isActive);
        },
    },
};
</script>

<style lang="scss" scoped>
@import url("/resources/sass/app.scss");
nav {
    height: 80px;
    padding: 7px 20px;
    justify-content: space-between;
    align-items: center;
    background-color: black;
    position: relative;
    .links {
        justify-content: center;
        margin: 0;
    }
    .logo {
        img {
            width: 35%;
        }
    }
    a {
        color: white;
    }

    .buttons {
        a {
            margin: 0 10px;
            letter-spacing: 3px;
        }

        .login {
            border: 1.5px solid rgb(255, 204, 0);
            border-radius: 20px;
            color: white;
        }

        .signup {
            border-radius: 20px;
            background-color: rgb(226, 181, 0);
        }
    }
    .burger {
        .white {
            color: white;
        }
        .dropdown-menu {
            background-color: black;
            position: absolute;
            top: 60px;
            left: -2px;
            right: -1px;
        }
    }
}
</style>
