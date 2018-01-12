<template>
    <form action="" method="POST" class="form">
        <div class="formt-group row">
            <label for="title" class="col-3 col-form-label">Title</label>
            <input type="text"  class="form-control col-6" id="title" name="title" v-model="title"  @keyup="clearErrors"><br>
        </div>
        <span v-text="errors.title"  class="form-text text-danger"></span>
        <div class="formt-group row">
            <label for="company_name" class="col-3 col-form-label">Company Name</label>
            <input type="text" class="form-control col-6" id="company_name" name="company_name" v-model="company_name"  @keyup="clearErrors"><br>
        </div>
        <span v-text="errors.company_name"  class="form-text text-danger"></span>
        <div class="formt-group row">
            <label for="location" class="col-3 col-form-label">Location</label>
            <input type="text" class="form-control col-6" id="location" name="location" v-model="location"  @keyup="clearErrors"><br>
        </div>
        <span v-text="errors.location"  class="form-text text-danger"></span>
        <div class="formt-group row">
            <label for="link" class="col-3 col-form-label">Link</label>
            <input type="url" class="form-control col-6" id="link" name="link" v-model="link"  @keyup="clearErrors"><br>
        </div>
        <span v-text="errors.link"  class="form-text text-danger"></span>

        <button @click.prevent="storeListing" class="btn btn-primary">Send</button>
        <br>
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
                    if (error.response.data.errors.title) {
                        this.errors.title = error.response.data.errors.title[0];
                    }
                    if (error.response.data.errors.company_name) {
                        this.errors.company_name = error.response.data.errors.company_name[0];
                    }
                    if (error.response.data.errors.location) {
                        this.errors.location = error.response.data.errors.location[0];
                    }
                    if (error.response.data.errors.link) {
                        this.errors.link = error.response.data.errors.link[0];
                    }
                    console.log(this.errors);

                })
            },
            clearErrors() {
                this.errors = {
                    link: '',
                    title: '',
                    location: '',
                    company_name: ''
                };
            }
        }
    }
</script>
