<template>
    <div>
        <nav class="navbar navbar-expand-lg fixed-top navbar-transparent" color-on-scroll="300">
            <div class="container">
                <div class="navbar-translate">
                    <router-link :to="{ name: 'home' }" class="navbar-brand">Aurora Christian School</router-link>
                    <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                             <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'hi' }" class="nav-link">Get in touch</router-link>
                        </li>
                          <li class="nav-item">
                            <router-link :to="{ name: 'who' }" class="nav-link">Who we are</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
                                <i class="fa fa-twitter"></i>
                                <p class="d-lg-none">Twitter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/AuroraChristianSchool/" target="_blank">
                                <i class="fa fa-facebook-square"></i>
                                <p class="d-lg-none">Facebook</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
                                <i class="fad fa-instagram"></i>
                                <p class="d-lg-none">Instagram</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="">
            <router-view></router-view>
        </div>

        <footer>
            asdfasdf
        </footer>
    </div>
</template>
<script>
    export default {}
</script>
