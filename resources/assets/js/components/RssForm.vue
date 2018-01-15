<template>
    <form action="" method="POST" class="form mt-5">
        <div class="form-group row">
            <label for="rsskeywords" class="col-3 col-md-1 col-form-label">Keywords</label>
            <input type="text" class="form-control col-7 col-md-4" id="rsskeywords" name="keywords"
                   placeholder="e.g. Junior Developer" v-model="keywords" @keyup="clearErrors">
        </div>
        <span v-text="errors.keywords"  class="form-text text-danger"></span>

        <button @click.prevent="getListings" class="btn btn-primary">Send</button>
        <br>
    </form>
</template>

<script>
    import { store } from '../app.js';

    export default {
        data() {
            return {
                keywords: '',
                errors: {
                    keywords: ''
                },
                sharedState: store.state
            }
        },
        methods: {
            getListings() {
                this.sharedState.rssListings = [];
                axios.post('/getRSS', {
                    keywords: this.keywords
                })
                    .then((response) => {
                        this.sharedState.rssListings = response.data.listings;
                        console.log(response.data);
                    }).catch((error) => {
                        if(error.response.data.errors.keywords) {
                            this.errors.keywords = error.response.data.errors.keywords[0];
                        }
                        console.log(error.response.data);
                })
            },
            clearErrors() {
                this.errors.keywords = '';
            }
        }
    }
</script>
