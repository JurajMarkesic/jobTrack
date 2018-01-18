<template>
    <form action="" method="POST" class="form">
        <div class="row">
            <div class="form-group col-12 col-sm-6">
                <label for="_title" class="col-form-label">Title:</label>
                <input v-if="edit" class="form-control" id="_title" type="text" v-model="listing.title" @keyup="clearErrors">
                <span v-else class="">{{ listing.title }}</span>
                <span v-if="edit" v-text="errors.title" class="form-text text-danger"></span>
            </div>

             <div class="form-group col-12 col-sm-6">
                 <label for="_company_name" class="col-form-label">Company Name:</label>
                 <input v-if="edit" class="form-control " id="_company_name" type="text" v-model="listing.company_name" @keyup="clearErrors">
                 <span v-else class="">{{ listing.company_name }}</span>
                 <span v-if="edit" v-text="errors.company_name" class="form-text text-danger"></span>
             </div>
        </div>
        <div class="row">
             <div class="form-group col-12 col-sm-6">
                 <label for="_location" class="col-form-label">Location:</label>
                 <input v-if="edit" class="form-control " id="_location" type="text" v-model="listing.location" @keyup="clearErrors">
                 <span v-else class="">{{ listing.location }}</span>
                 <span v-if="edit" v-text="errors.location" class="form-text text-danger"></span>
             </div>
             <div class="form-group col-12 col-sm-6">
                 <label v-if="edit" for="_link" class="col-form-label">Link:</label>
                 <input v-if="edit" class="form-control " id="_link" type="text" v-model="listing.link" @keyup="clearErrors">
                 <a target="_blank" v-else :href="listing.link" class="">Link</a>
                 <span v-if="edit" v-text="errors.link" class="form-text text-danger"></span>
             </div>
        </div>

        <div class="dropdownWrap">
            <i v-if="statusHide" class=" fa fa-angle-down fa-2x" @click.prevent="statusHide = false;"></i>
            <i v-else class="fa fa-angle-up fa-2x" @click.prevent="statusHide = true;"></i>
            <span @click.prevent="statusHide = false;" style="font-size: 1.1rem;">Status & Priority</span>
        </div>

        <div :class="{row: true, 'd-none': statusHide}">
            <div class="form-group col-12 col-sm-6 mb-0">
                <label for="_rating" class=" col-form-label">Priority:</label>
                <input v-if="edit" class="form-control" id="_rating" type="number" min="1" max="10" v-model="listing.rating">
                <span v-else>{{listing.rating}}</span>
                <span v-if="edit" v-text="errors.rating" class="form-text text-danger"></span>
            </div>
            <div class="form-group col-12 col-sm-6 mb-0">
                <label  for="_status" class=" col-form-label">Status:</label>
                <select v-if="edit" class="form-control " id="_status" v-model="listing.status">
                     <option value="Yet to apply">Yet to apply</option>
                     <option value="Applied">Applied</option>
                     <option value="Got a response">Got a response</option>
                     <option value="Got an interview">Got an interview</option>
                     <option value="Got the job!">Got the job!</option>
                </select>
                <span v-else>{{listing.status}}</span>
                <span v-if="edit" v-text="errors.status" class="form-text text-danger"></span>
            </div>
            <hr>
        </div>
        <br>

        <div class="dropdownWrap">
            <i v-if="contactHide" class=" fa fa-angle-down fa-2x" @click.prevent="contactHide = false;"></i>
            <i v-else class=" fa fa-angle-up fa-2x" @click.prevent="contactHide = true;"></i>
            <span @click.prevent="contactHide = false;" style="font-size: 1.1rem;">Contact</span>
        </div>
        <div :class="{row: true, 'd-none': contactHide}">
             <div class="form-group col-12 col-sm-4 mb-0">
                 <label  for="_applied_on" class=" col-form-label">Applied on:</label>
                 <input v-if="edit" class="form-control " id="_applied_on" type="date" v-model="listing.applied_on"  @keyup="clearErrors">
                 <span v-else>
                     <span v-if="listing.applied_on">{{listing.applied_on}}</span><span v-else>Yet to apply.</span>
                 </span>
                 <span v-if="edit" v-text="errors.applied_on" class="form-text text-danger"></span>
             </div>
             <div class="form-group col-12 col-sm-4 mb-0">
                <label  for="_contact_name" class=" col-form-label">Contact Name:</label>
                <input v-if="edit" class="form-control " id="_contact_name" type="text" v-model="listing.contact_name"  @keyup="clearErrors">
                 <span v-else>{{listing.contact_name}}</span>
                 <span v-if="edit" v-text="errors.contact_name" class="form-text text-danger"></span>
             </div>
             <div class="form-group col-12 col-sm-4 mb-0">
                <label for="_contact_email" class=" col-form-label">Contact email:</label>
                <input v-if="edit" class="form-control " id="_contact_email" type="email"  placeholder="sophie@example.com"
                       v-model="listing.contact_email"  @keyup="clearErrors">
                 <span v-else>{{listing.contact_email}}</span>
                 <span v-if="edit" v-text="errors.contact_email" class="form-text text-danger"></span>
             </div>
        </div>
        <br>
        <br>
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
                },
                contactHide: true,
                statusHide: true
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
                    applied_on: this.listing.applied_on,
                    contact_name: this.listing.contact_name,
                    contact_email: this.listing.contact_email
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

