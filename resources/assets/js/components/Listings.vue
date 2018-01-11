<template>
    <div>
        <listing v-for="listing in listings" :listing="listing" :key="listing.id"></listing>
    </div>
</template>

<script>
    import { eventBus } from '../app.js';

    export default {
        data() {
            return {
                listing: '',
                listings: []
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
            }
        }

    }
</script>

