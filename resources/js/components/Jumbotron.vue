<template>
  <div class="jumbo">
        <div class="wrap">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-md-1 g-2 g-lg-3 d-flex justify-content-center content">
                <!-- Textual Content -->
                <div class="col-6 slogan">
                    <h1>I piatti che ami, a domicilio.</h1>
                </div>


                <!-- Image -->
                <div class="col-6 col-md4 img d-none d-sm-none d-md-none d-lg-block">
                    <img src="../images/food-grass-fed-beef-foodservice-products-grass-run-farms-4.png" alt="jumbo image">
                </div>


                <!-- Arrows -->
         
                <a href="#search">

                    <div class=" col arrow-down d-sm-none d-none d-md-block d-lg-block">
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>

                </a>
                
            </div>
        </div>
  </div>
</template>

<script>
export default {
    name: 'Jumbotron',
}
</script>

<style lang="scss" scoped>
    .jumbo {
        width: 100%;
        height: 100vh;
        background-image:  url('../images/back.png');
        background-size: cover;
        background-repeat: no-repeat;
       .wrap {
            width: 90%;
            margin: 0 auto;
            height: 100%;
            display: flex;
            align-items: center;
            .slogan {
                /* margin: 100px 0; */
                color: white;
                h1 {
                    font-size: 65px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 5px;
                    margin-bottom: 50px;
                }
            }
            .content {
                align-items: center;
            }
        }
    }

    .arrow-down{
    width:60px;
    height:40px;
    margin:0 0 0 -30px;
    position:absolute;
    left:25%;
    bottom:0px;
    top: 93%;
    -webkit-animation: arrow 0.5s 1s infinite ease-out alternate;
    
    }

    .arrow-down:hover{
        -webkit-animation-play-state: paused;
    }

    .left{
    position:absolute;
    height:10px;
    width:40px;
    background:rgb(255, 204, 0);
    -webkit-transform:rotate(240deg);
    top:10px;
    left:10px;
    -webkit-border-radius:4px;
    -webkit-transform-origin:5px 50%;
    -webkit-animation: leftArrow 0.5s 1s infinite ease-out alternate;
    }

    .right{
    position:absolute;
    height:10px;
    width:40px;
    background:rgb(255, 204, 0);
    -webkit-transform:rotate(-60deg);
    top:10px;
    left:10px;
    -webkit-border-radius:4px;
    -webkit-transform-origin:5px 50%;
    -webkit-animation: rightArrow 0.5s 1s infinite ease-out alternate;
    }

    @-webkit-keyframes arrow{
    0% {
        bottom:0px;
    }
    100%{
        bottom:40px;
    }
    }

    @-webkit-keyframes leftArrow{
    0% {
    }
    100%{
        -webkit-transform:rotate(225deg);
    }
    }

    @-webkit-keyframes rightArrow{
    0% {
    }
    100%{
        -webkit-transform:rotate(-45deg);
    }
    }

</style>