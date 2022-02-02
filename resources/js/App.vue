<template>
    <div >
 
        <nav class="navbar navbar-expand-md navbar-static-top navbar-dark bg-dark" role="navigation">
            <a class="navbar-brand w-75 " href="#">Navbar</a>
            <button class="navbar-toggler mx-auto divBtn justify-content-end" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- for logged-in user-->
                <div class="navbar-nav container" v-if="isLoggedIn">
                    <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
                    <router-link to="/countries" class="nav-item nav-link">Countries</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav container" v-else>
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Register</router-link>
                    <router-link to="/about" class="nav-item nav-link">About</router-link>

                </div>                
            </div>
        </nav>
        <div class="container">
            <router-view/>
        </div>
        
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>