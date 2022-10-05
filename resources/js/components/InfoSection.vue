<template>
    <div class="info">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-2 g-lg-3 d-flex justify-content-center">
                <div class="col">
                    <img src="../images/PngItem_2701331.png" alt="deliver" class="info-img">
                    <h3>Lavora con noi</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque velit cum, exercitationem amet nesciunt ipsam voluptates laborum culpa similique sequi veritatis magnam? Repellendus perspiciatis similique eveniet quia sapiente magni nostrum!</p>
                    <a href="#" class="btn info-btn">Info</a>
                </div>
                <div class="col">
                    <img src="../images/PngItem_2701331.png" alt="deliver" class="info-img">
                    <h3>Lavora con noi</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque velit cum, exercitationem amet nesciunt ipsam voluptates laborum culpa similique sequi veritatis magnam? Repellendus perspiciatis similique eveniet quia sapiente magni nostrum!</p>
                    <a href="#" class="btn info-btn">Info</a>
                </div>
                <div class="col">
                    <img src="../images/PngItem_2701331.png" alt="deliver" class="info-img">
                    <h3>Lavora con noi</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque velit cum, exercitationem amet nesciunt ipsam voluptates laborum culpa similique sequi veritatis magnam? Repellendus perspiciatis similique eveniet quia sapiente magni nostrum!</p>
                    <a href="#" class="btn info-btn">Info</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'InfoSection'
}
</script>

<style lang="scss" scoped>
    .info {
        background-color: black;
        padding: 100px 0;
        color: white;
        .col {
            text-align: center;
            .info-img {
                width: 30%;
            }
            h3 {
                margin: 35px 0;
                text-transform: uppercase;
                color: rgb(255, 204, 0);
            }
            .info-btn {
                border-radius: 20px;
                color: white;
                background-color: rgb(226, 181, 0);
                padding: 5px 25px;
            }
        }
    
        
    }
</style>