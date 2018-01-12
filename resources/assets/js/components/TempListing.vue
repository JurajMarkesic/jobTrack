<template>
    <tr class="row">
        <td class="col-3">{{ listing.title }}</td>
        <td class="col-3">{{ listing.location }}</td>
        <td class="col-3">{{ listing.company }}</td>
        <td class="col-1">
            <a :href="listing.link">Link</a>
        </td>
        <td class="col-1">
            <button @click="saveListing">Save</button>
        </td>
        <td class="col-1"><i v-if="isAdded" class="fa fa-check fa-lg" style="color: green;"></i>
            <i v-else class="fa fa-arrow-left" style="color: white;"></i></td>
    </tr>
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
