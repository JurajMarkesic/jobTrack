<template>
    <form action="" method="POST" class="form">
        <div class="form-group row">
            <label for="_title" class="col-3 col-form-label">Title</label>
            <input v-if="edit" class="form-control col-6" id="_title" type="text" v-model="listing.title" @keyup="clearErrors">
            <span v-else>{{ listing.title }}</span>
        </div>
        <span v-if="edit" v-text="errors.title" class="form-text text-danger"></span>
         <div class="form-group row">
             <label for="_company_name" class="col-3 col-form-label">Company Name</label>
             <input v-if="edit" class="form-control col-6" id="_company_name" type="text" v-model="listing.company_name" @keyup="clearErrors">
             <span v-else>{{ listing.company_name }}</span>
         </div>
        <span v-if="edit" v-text="errors.company_name" class="form-text text-danger"></span>
         <div class="form-group row">
             <label for="_location" class="col-3 col-form-label">Location</label>
             <input v-if="edit" class="form-control col-6" id="_location" type="text" v-model="listing.location" @keyup="clearErrors">
             <span v-else>{{ listing.location }}</span>
         </div>
        <span v-if="edit" v-text="errors.location" class="form-text text-danger"></span>
         <div class="form-group row">
             <label for="_link" class="col-3 col-form-label">Link</label>
             <input v-if="edit" class="form-control col-6" id="_link" type="text" v-model="listing.link" @keyup="clearErrors">
             <a target="_blank" v-else :href="listing.link">Link</a>
         </div>
        <span v-if="edit" v-text="errors.link" class="form-text text-danger"></span>
        <div class="form-group row" v-if="edit">
            <label v-if="edit" for="_rating" class="col-3 col-form-label">Rating</label>
            <input v-if="edit" class="form-control  col-1" id="_rating" type="number" min="1" max="10" v-model="listing.rating">
        </div>
        <span v-if="edit" v-text="errors.rating" class="form-text text-danger"></span>
        <div class="form-group row" v-if="edit">
            <label v-if="edit" for="_status" class="col-3 col-form-label">Status</label>
            <select v-if="edit" class="form-control col-6" id="_status" v-model="listing.status">
                 <option value="Yet to apply">Yet to apply</option>
                 <option value="Applied">Applied</option>
                 <option value="Got a response">Got a response</option>
                 <option value="Got an interview">Got an interview</option>
                 <option value="Got the job!">Got the job!</option>
            </select><br v-if="edit">
        </div>
        <span v-if="edit" v-text="errors.status" class="form-text text-danger"></span>
         <div class="form-group row" v-if="edit">
             <label v-if="edit" for="_applied_on" class="col-3 col-form-label">Applied on</label>
             <input v-if="edit" class="form-control col-6" id="_applied_on" type="date" v-model="listing.contact.applied_on"  @keyup="clearErrors">
         </div>
        <span v-if="edit" v-text="errors.applied_on" class="form-text text-danger"></span>
         <div class="form-group row" v-if="edit">
            <label v-if="edit" for="_contact_name" class="col-3 col-form-label">Contact Name</label>
            <input v-if="edit" class="form-control col-6" id="_contact_name" type="text" v-model="listing.contact.contact_name"  @keyup="clearErrors">
         </div>
        <span v-if="edit" v-text="errors.contact_name" class="form-text text-danger"></span>
         <div class="form-group row" v-if="edit">
            <label v-if="edit" for="_contact_email" class="col-3 col-form-label">Contact email</label>
            <input v-if="edit" class="form-control col-6" id="_contact_email" type="email"  placeholder="sophie@example.com"
                   v-model="listing.contact.contact_email"  @keyup="clearErrors">
         </div>
        <span v-if="edit" v-text="errors.contact_email" class="form-text text-danger"></span>
        <br v-if="edit">
        <button v-if="edit" class="btn btn-success" @click.prevent="editListing" autofocus>Save</button>
        <button v-else class="btn btn-outline-primary" @click.prevent="edit = true">Edit</button>

        <button  v-if="edit" class="btn btn-outline-secondary ml-1" @click.prevent="edit = false">Cancel</button>
        <button v-else class="btn btn-danger ml-1" @click.prevent="deleteListing">Delete</button>

        <hr>
    </form>
</template>

<script>
    import { eventBus } from '../app.js';
    export default {
        props: [ 'listing'],
        data() {
            return {
                edit: false,
                errors: {
                    link: '',
                    title: '',
                    location: '',
                    company_name: '',
                    rating: '',
                    status: '',
                    applied_on: '',
                    contact_name: '',
                    contact_email: ''
                }
            }
        },
        methods: {
            editListing() {
                this.clearErrors();
                axios.patch('/listings/' + this.listing.id, {
                    company_name: this.listing.company_name,
                    link: this.listing.link,
                    title: this.listing.title,
                    location: this.listing.location,
                    rating: this.listing.rating,
                    status: this.listing.status,
                    applied_on: this.listing.contact.applied_on,
                    contact_name: this.listing.contact.contact_name,
                    contact_email: this.listing.contact.contact_email
                }).then((response) => {
                    this.edit = false;
                    console.log(response.data);
                }).catch((error) => {
                    if(error.response.data.errors.company_name) {
                        this.errors.company_name = error.response.data.errors.company_name[0];
                    }
                    if(error.response.data.errors.link) {
                        this.errors.link = error.response.data.errors.link[0];
                    }

                    if(error.response.data.errors.title) {
                        this.errors.title = error.response.data.errors.title[0];
                    }
                    if(error.response.data.errors.location) {
                        this.errors.location = error.response.data.errors.location[0];
                    }
                    if(error.response.data.errors.rating) {
                        this.errors.rating = error.response.data.errors.rating[0];
                    }
                    if(error.response.data.errors.status) {
                        this.errors.status = error.response.data.errors.status[0];
                    }
                    if(error.response.data.errors.applied_on) {
                        this.errors.applied_on = error.response.data.errors.applied_on[0];
                    }
                    if(error.response.data.errors.contact_name) {
                        this.errors.contact_name = error.response.data.errors.contact_name[0];
                    }
                    if(error.response.data.errors.contact_email) {
                        this.errors.contact_email = error.response.data.errors.contact_email[0];
                    }

                    console.log(error.response.data);
                })
            },
            deleteListing() {
                axios.delete('/listings/' + this.listing.id)
                    .then((response) => {
                        eventBus.$emit('listing-deleted');
                        console.log("Listing successfully deleted!");
                    })
                    .then((error) => {
                        console.log(error);
                    })
            },
            clearErrors() {
                this.errors =  {
                    link: '',
                    title: '',
                    location: '',
                    company_name: '',
                    rating: '',
                    status: '',
                    applied_on: '',
                    contact_name: '',
                    contact_email: ''
                };
            }
        }
    }
</script>

