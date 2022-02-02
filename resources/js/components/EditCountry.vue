<template>
    <div>
        <h4 class="text-center">Edit Country</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateCountry">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="country.name">
                    </div>
                    <div class="form-group">
                        <label>Landmass</label>
                        <input type="text" class="form-control" v-model="country.landmass">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Country</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            country: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/countries/edit/${this.$route.params.id}`)
                .then(response => {
                    this.country = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateCountry() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/countries/update/${this.$route.params.id}`, this.country)
                    .then(response => {
                        this.$router.push({name: 'countries'});
                    })
                    .catch(function (error) {
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