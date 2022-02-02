<template>
    <div>
        
        <h4 class="text-center">All Countries</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Landmass</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="country in countries" :key="country.id">
                <td>{{ country.name }}</td>
                <td>{{ country.landmass }}</td>
                <td>
                    <div>
                        <router-link :to="{name: 'editcountry', params: { id: country.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger " @click="deleteCountry(country.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-info" @click="this.$router.push('/countries/add')">Add Country</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            countries: [],
            id_admin: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/countries')
                .then(response => {
                    this.countries = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteCountry(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/countries/delete/${id}`)
                    .then(response => {
                        let i = this.countries.map(item => item.id).indexOf(id); // find index of your object
                        this.countries.splice(i, 1)
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
