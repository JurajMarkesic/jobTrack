<template>
    <div id="tempListingWrap">
    <div class="row">
        <div class="col-5 col-md-6" style="font-weight: bold;">{{ listing.title }}</div>
        <div class="col-5 col-md-4">{{ listing.location }}</div>
    </div>
    <div class="row">
        <div class="col-5 col-md-6">{{ listing.company }}</div>
        <div class="col-3 col-md-4">
            <a :href="listing.link" target="_blank">Link</a>
        </div>
        <div class="col-2 col-md-1">
            <button class=" btn btn-outline-primary" @click="saveListing">Save</button>
        </div>
        <div class="col-2 col-md-1">
            <i v-if="isAdded" class="fa fa-check fa-lg" style="color: green; margin-top: 0.6rem;"></i>
            <i v-else class="fa fa-arrow-left" style="color: white;"></i>
        </div>
    </div>
        <hr>
    </div>
</template>

<script>

    export default {
        props: [ 'listing'],
        data() {
            return {
                isAdded: ''
            }
        },
        created() {
            this.checkIfSaved();
        },
        methods: {
            saveListing() {
                axios.post('/listings', {
                    company_name : this.listing.company,
                    title : this.listing.title,
                    link : this.listing.link,
                    location : this.listing.location
                })
                    .then((response) => {
                        this.isAdded = true;
                        console.log("Listings saved successfully!");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            checkIfSaved() {
                axios.post('/listings/check', {
                    listingTitle: this.listing.title,
                    listingCompany: this.listing.company
                }).then((response) => {
                    this.isAdded =  response.data.isSaved;
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error.response.data);
                })
            }
        }
    }
</script>
