<template>
    <div>
        <label for="sortMethod">Sort By</label>
        <select name="sortMethod" id="sortMethod" v-model="sortMethod" @change="sortListings">
            <option value="default">Default</option>
            <option value="date">Date applied</option>
            <option value="rating">Priority</option>
        </select>
        <button @click="fetchListings(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">Previous</button>
        <span>Page {{pagination.current_page}} of {{pagination.last_page}}</span>
        <button @click="fetchListings(pagination.next_page_url)" :disabled="!pagination.next_page_url">Next</button>
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
                sortMethod: "default",
                pagination: {}
            }
        },
        created() {
            this.fetchListings();
            eventBus.$on('listing-deleted', this.fetchListings);
            eventBus.$on('listing-added', this.fetchListings);
        },
        methods: {
            fetchListings(page_url) {
                if(typeof(page_url) === 'undefined') {
                    page_url = 'http://jooble.oo/listings'
                }
                axios.get(page_url)
                    .then((response) => {
                        console.log(response.data);
                        this.listings = response.data.listings.data;
                        this.makePagination(response.data.listings)
                        console.log("Listings fetched successfully!");
                    }).catch((error) => {
                        console.log(error.data);
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
            },
            makePagination(data) {
                this.pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                };
            }
        }

    }
</script>

