<template>
    <div>
        <label for="sortMethod">Sort By</label>
        <select name="sortMethod" id="sortMethod" v-model="sortMethod" @change="sortListings">
            <option value="default">Default</option>
            <option value="date">Date applied</option>
            <option value="rating">Priority</option>
        </select>
        <hr>
        <listing v-for="listing in listings" :listing="listing" :key="listing.id"></listing>
        <p v-if="!listings.length" class="text-warning">You have no listings saved!</p>
    </div>
</template>

<script>
    import { eventBus } from '../app.js';

    export default {
        data() {
            return {
                listing: '',
                listings: [],
                sortMethod: "default"
            }
        },
        created() {
            this.fetchListings();
            eventBus.$on('listing-deleted', this.fetchListings);
            eventBus.$on('listing-added', this.fetchListings);
        },
        methods: {
            fetchListings() {
                axios.get('/listings')
                    .then((response) => {
                        this.listings = response.data.listings;
                        console.log("Listings fetched successfully!");
                    }).catch((error) => {
                        console.log(error);
                })
            },
            sortListings() {
                
                if(this.sortMethod === "default") {
                    this.listings = _.orderBy(this.listings, [function(o) { return o.title; }]);
                } else if(this.sortMethod === "date") {
                    this.listings = _.orderBy(this.listings, [function(o) { return o.contact.applied_on; }]);
                } else {
                    this.listings = _.orderBy(this.listings, [function(o) { return o.rating; }], ['desc']);
                }
            }
        }

    }
</script>

