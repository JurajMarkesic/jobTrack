<template>
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="keywords">Keywords</label>
            <input type="text" name="keywords" id="keywords" v-model="keywords"><br>
            <span v-text="errors.keywords"></span><br>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" v-model="location"><br>
            <span v-text="errors.location"></span><br>
        </div>

        <button @click.prevent="fetchListings">Send</button>
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
                axios.post('/joobleAPI', {keywords: this.keywords, location: this.location})
                    .then((response) => {

                        this.listings = response.data.listings;
                        this.sharedState.joobleListings = this.listings;
                        this.keywords = "";
                        this.location = "";
                        console.log(response.data);
                    }).catch((error) => {
                        if(error.response.data.errors.keywords) {
                            this.errors.keywords = error.response.data.errors.keywords[0];
                        }
                        if(error.response.data.errors.location) {
                            this.errors.location = error.response.data.errors.location[0];
                        }
                        console.log(error);
                })
            }
        }
    }
</script>

