<template>
    <form action="" method="POST" class="form mt-5">
        <div class="form-group row">
            <label for="keywords" class="col-3 col-md-1 col-form-label">Keywords</label>
            <input type="text" class="form-control col-7 col-md-4" name="keywords" id="keywords" v-model="keywords" @keyup="clearErrors">
        </div>
        <span v-text="errors.keywords"  class="form-text text-danger"></span>

        <div class="form-group row">
            <label for="location" class="col-3 col-md-1 col-form-label">Location</label>
            <input type="text" class="form-control col-7 col-md-4" name="location" id="location" v-model="location" @keyup="clearErrors">
            <small class="text-muted mt-2 ml-2 ">Leave blank if you want to search the entirety of Croatia.</small>
        </div>
        <span v-text="errors.location"  class="form-text text-danger"></span>

        <button @click.prevent="fetchListings" class="btn btn-primary">Send</button>
        <br>
    </form>
</template>

<script>
    import { eventBus } from '../app.js';
    import { store } from '../app.js';

    export default {
        data() {
            return {
                listings: [],
                keywords: "",
                location: "",
                sharedState: store.state,
                errors: {
                    keywords: "",
                    location: ""
                }
            }
        },
        methods: {
            fetchListings() {
                this.sharedState.joobleListings = [];
                axios.post('/joobleAPI', {keywords: this.keywords, location: this.location})
                    .then((response) => {

                        this.listings = response.data.listings;
                        this.sharedState.joobleListings = this.listings;
                        this.keywords = "";
                        this.location = "";
                        console.log(response.data);
                    }).catch((error) => {
                    if (error.response.data.errors.keywords) {
                        this.errors.keywords = error.response.data.errors.keywords[0];
                    }
                    if (error.response.data.errors.location) {
                        this.errors.location = error.response.data.errors.location[0];
                    }
                    console.log(error);
                })
            },
            clearErrors() {
                this.errors.keywords = '';
                this.errors.location = '';
                }
            }
    }
</script>

