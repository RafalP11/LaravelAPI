<template>
    <div>
        <h4 class="text-center">Add Country</h4>
         <span class="w-full text-danger text-center" v-if="errors == 1">{{"You are not administrator!"}}</span>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCountry">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="country.name">
                    </div>
                    <div class="form-group">
                        <label>Landmass</label>
                        <input type="text" class="form-control" v-model="country.landmass">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Country</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            country: {},
            errors:[]
        }
    },
    methods: {
        addCountry() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/countries/add', this.country)
                    .then(response => {
                        this.$router.push({name: 'countries'})
                    })
                    .catch((error) =>{
                        this.errors = 1;
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>