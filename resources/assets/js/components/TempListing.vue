<template>
    <tr>
        <td>{{ listing.title }}</td>
        <td>{{ listing.location }}</td>
        <td>{{ listing.company }}</td>
        <td>
            <button @click="saveListing">Save</button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: [ 'listing'],
        data() {
            return {

            }
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
                        console.log("Listings saved successfully!");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>
