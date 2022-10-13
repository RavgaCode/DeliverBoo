<template>
    <div class="info">
        <div class="wrap">
        
            <h2>Lavora con noi</h2>
            <p>Diventa partner di Deliveroo e raggiungi sempre più clienti. Ci occupiamo noi della consegna, così che la tua unica preoccupazione sia continuare a preparare il miglior cibo.</p>
            
            <div class="buttons">
                <a href="#" @click="login()" class="btn login">Login</a>
                <a href="#" @click="register()" class="btn signup">Registrati</a>
            </div>
        </div>

        
    </div>
</template>

<script>
export default {
    name: 'InfoSection',
    methods: {
        login() {
            window.location.href = "http://127.0.0.1:8000/login";
        },
        register() {
            window.location.href = "http://127.0.0.1:8000/register";
        }
    },
}
</script>

<style lang="scss" scoped>
    
    .info {
        background-color: black;
        color: white;
        text-align: center;
        height: 300px;
        
        .wrap {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
          
        }

    }
</style>