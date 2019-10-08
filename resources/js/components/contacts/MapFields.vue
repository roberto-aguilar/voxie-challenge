<template>
    <div class="text-center">
        <h2>Map Fields</h2>
        <p class="text-muted">Map the fields in your CSV to database fields.</p>

        <p>Found {{ recordsCount }} contacts in:</p>
        <p class="text-success"><i class="fas fa-check"></i> {{ value.name }}</p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">CSV Field</th>
                <th scope="col">Contact Field</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="field in value.csv_fields">
                <td v-text="field"></td>
                <td>
                    <select class="custom-select" v-model="field_mappings[field]">
                        <option value="team_id">Team ID</option>
                        <option value="unsubscribed_status">Unsubscribed Status</option>
                        <option value="first_name">First Name</option>
                        <option value="last_name">Last Name</option>
                        <option value="phone">Phone</option>
                        <option value="email">Email</option>
                        <option value="sticky_phone_number_id">Sticky Phone Number ID</option>
                        <option value="twitter_id">Twitter ID</option>
                        <option value="fb_messenger_id">Facebook Messenger ID</option>
                        <option value="time_zone">Time Zone</option>
                        <option value="custom_attribute">Custom Attribute</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>

        <button class="btn btn-success" @click.prevent="submit">Continue</button>
    </div>
</template>

<script>
    export default {
        props: [
            'value',
        ],
        computed: {
            recordsCount() {
                return this.value.csv_records.length
            }
        },
        data() {
            return {
                field_mappings: this.value.csv_fields.reduce((field_mappings, field) => {
                    let contactFields = [
                        'team_id',
                        'unsubscribed_status',
                        'first_name',
                        'last_name',
                        'phone',
                        'email',
                        'sticky_phone_number_id',
                        'twitter_id',
                        'fb_messenger_id',
                        'time_zone',
                    ];

                    field_mappings[field] = contactFields.includes(field) ? field : 'custom_attribute'

                    return field_mappings
                }, {})
            }
        },
        methods: {
            submit() {
                axios.patch(`/api/contacts/files/${this.value.id}/mappings`, {
                        field_mappings: this.field_mappings,
                    })
                    .then(response => {
                        this.$emit('input', response.data)
                    })
                    .catch(response => {
                        console.log('An error ocurred while updating the field mappings')
                    })
            }
        }
    }
</script>
