<template>
    <form action="" method="POST" class="form">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" v-model="title"><br>
            <span v-text="errors.title"></span><br>
        </div>
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" v-model="company_name"><br>
            <span v-text="errors.company_name"></span><br>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" v-model="location"><br>
            <span v-text="errors.location"></span><br>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" id="link" name="link" v-model="link"><br>
            <span v-text="errors.link"></span><br>
        </div>

        <button @click.prevent="storeListing">Send</button>
    </form>
</template>

<script>
    import { eventBus } from '../app.js';
    export default {
        data() {
            return {
                title: '',
                company_name: '',
                location: '',
                link: '',
                errors: {
                    title: '',
                    company_name: '',
                    location: '',
                    link: ''
                }
            }
        },
        methods: {
            storeListing() {
                axios.post('/listings', {
                    title: this.title,
                    company_name: this.company_name,
                    location: this.location,
                    link: this.link
                }).then((response) => {
                    eventBus.$emit('listing-added');
                    this.title = '';
                    this.company_name = '';
                    this.location = '';
                    this.link = '';
                    console.log(response.data);
                }).catch((error) => {
                    if(error.response.data.errors.title) {
                        this.errors.title = error.response.data.errors.title[0];
                    }
                    if(error.response.data.errors.company_name) {
                        this.errors.company_name = error.response.data.errors.company_name[0];
                    }
                    if(error.response.data.errors.location) {
                        this.errors.location = error.response.data.errors.location[0];
                    }
                    if(error.response.data.errors.link) {
                        this.errors.link = error.response.data.errors.link[0];
                    }
                    console.log(this.errors);

                })
            }
        }
    }
</script>
