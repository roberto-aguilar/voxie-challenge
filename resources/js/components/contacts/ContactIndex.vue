<template>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>team_id</th>
                    <th>unsubscribed_status</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>sticky_phone_number_id</th>
                    <th>twitter_id</th>
                    <th>fb_messenger_id</th>
                    <th>time_zone</th>
                    <th>custom_attributes</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts">
                    <td v-text="contact.id">id</td>
                    <td v-text="contact.team_id">team_id</td>
                    <td v-text="contact.unsubscribed_status">unsubscribed_status</td>
                    <td v-text="contact.first_name">first_name</td>
                    <td v-text="contact.last_name">last_name</td>
                    <td v-text="contact.phone">phone</td>
                    <td v-text="contact.email">email</td>
                    <td v-text="contact.sticky_phone_number_id">sticky_phone_number_id</td>
                    <td v-text="contact.twitter_id">twitter_id</td>
                    <td v-text="contact.fb_messenger_id">fb_messenger_id</td>
                    <td v-text="contact.time_zone">time_zone</td>
                    <td>
                        <pre v-text="contact.custom_attributes"></pre>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                contacts: []
            }
        },
        mounted() {
            axios.get('/api/contacts')
                .then(response => {
                    this.contacts = response.data
                })
        },
    }
</script>
