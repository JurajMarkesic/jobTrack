<template>
    <div class="mt-5">
        <templisting v-for="listing in sharedState.joobleListings" :listing="listing" :key="listing.id"></templisting>
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
        },
        methods: {

        }
    }
</script>

