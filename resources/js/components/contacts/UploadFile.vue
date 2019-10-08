<template>
    <div class="text-center">
        <h2>Import CSV</h2>
        <p class="text-muted">Import your contacts from a CSV file</p>

        <div class="mt-md-4">
            <label for="file" class="btn btn-success">
                Import
                <input class="d-none" type="file" id="file" accept=".csv" ref="input" @change="submit">
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'value',
        ],
        methods: {
            submit() {
                let payload = new FormData
                payload.append('file', this.$refs.input.files[0])

                axios.post('/api/contacts/files', payload)
                    .then(response => {
                        this.$emit('input', response.data)
                    })
                    .catch(error => {
                        console.log('An error occurred while uploading the file')
                    })
            }
        }
    }
</script>
