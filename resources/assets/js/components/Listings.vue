<template>
    <div>
        <div class="row">
            <label for="sortMethod" class="mt-2">Sort By</label>
            <select name="sortMethod" id="sortMethod" class="form-control col-8 col-md-3 ml-2" v-model="sortMethod" @change="fetchListings()">
                <option value="default">Default</option>
                <option value="date">Date applied</option>
                <option value="rating">Priority</option>
            </select>
            <ul class="pagination justify-content-center col-md-8 offset-md-2 col-lg-6 offset-lg-0  mt-1">
                <li :class="{'page-item': true, 'disabled': !pagination.prev_page_url}">
                    <a class="page-link" href="#" aria-label="Previous" @click="fetchListings(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                        <span aria-hidden="true">Previous</span>
                    </a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link" style="color: black">Page {{pagination.current_page}} of {{pagination.last_page}}</span>
                </li>
                <li :class="{'page-item': true, 'disabled': !pagination.next_page_url}">
                    <a class="page-link" href="#" aria-label="Next" @click="fetchListings(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                        <span aria-hidden="true">Next</span>
                    </a>
                </li>
            </ul>
        </div>

        <hr>
        <listing v-for="listing in listings" :listing="listing" :key="listing.id"></listing>
        <p v-if="!listings.length" class="text-warning">You have no listings saved!</p>
        <ul class="pagination justify-content-center">
            <li :class="{'page-item': true, 'disabled': !pagination.prev_page_url}">
                <a class="page-link" href="#" aria-label="Previous" @click="fetchListings(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                    <span aria-hidden="true">Previous</span>
                </a>
            </li>
            <li class="page-item disabled">
                <span class="page-link" style="color: black">Page {{pagination.current_page}} of {{pagination.last_page}}</span>
            </li>
            <li :class="{'page-item': true, 'disabled': !pagination.next_page_url}">
                <a class="page-link" href="#" aria-label="Next" @click="fetchListings(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        </ul>
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
                    page_url = 'http://jooble.oo/listings' + '?sort=' + this.sortMethod;
                }else {
                    page_url = page_url + '&sort=' + this.sortMethod;
                }

                axios.get(page_url).then((response) => {
                        console.log(response.data);
                        this.listings = response.data.listings.data;
                        this.makePagination(response.data.listings)
                        console.log("Listings fetched successfully!");
                    }).catch((error) => {
                        console.log(error.data);
                })
            },
            // sortListings() {
            //
            //     if(this.sortMethod === "default") {
            //         this.listings = _.orderBy(this.listings, [function(o) { return o.title; }]);
            //     } else if(this.sortMethod === "date") {
            //         this.listings = _.orderBy(this.listings, [function(o) { return o.contact.applied_on; }]);
            //     } else {
            //         this.listings = _.orderBy(this.listings, [function(o) { return o.rating; }], ['desc']);
            //     }
            // },
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

