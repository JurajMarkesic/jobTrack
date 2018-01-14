<template>
    <div class=" mt-5">
        <templisting v-for="listing in sharedState.rssListings" :listing="listing" :key="listing.title"></templisting>
    </div>
</template>

<script>
    import { eventBus } from '../app.js';
    import { store } from '../app.js';

    export default {
        data() {
            return {
                listing: '',
                sharedState: store.state
            }
        }
    }
</script>
