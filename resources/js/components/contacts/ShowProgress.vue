<template>
    <div class="text-center">
        <div v-if="isProcessing">
            <h2>Importing contacts</h2>
            <h3 class="text-muted text-lg mt-4"><i class="fas fa-cog fa-spin"></i></h3>
        </div>
        <div v-else>
            <h3>Contacts successfully imported </h3>
            <p class="text-muted">Now you can go to the contacts page!</p>
            <a href="/contacts">
                <buttong class="btn btn-success">Contacts</buttong>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'value',
        ],
        data() {
            return {
                isProcessing: true,
            }
        },
        mounted() {
            if (this.value.processed_at) {
                this.isProcessing = false
            } else {
                this.openWebSocket()
            }
        },
        methods: {
            openWebSocket() {
                window.Echo.private(`App.ContactFile.${this.value.id}`)
                    .listen('ContactsStored', event => {
                        this.isProcessing = false
                    })
            }
        }
    }
</script>
