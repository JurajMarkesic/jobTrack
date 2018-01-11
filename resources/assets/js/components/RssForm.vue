<template>
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="rsskeywords">Keywords</label>
            <input type="text" id="rsskeywords" name="keywords" v-model="keywords" @keyup="clearErrors"><br>
            <span v-text="errors.keywords"></span><br>
        </div>

        <button @click.prevent="getListings">Send</button>
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
