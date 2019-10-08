<template>
    <upload-file v-model="file" v-if="showUploadFileComponent"></upload-file>
</template>

<script>
    import UploadFile from "./UploadFile"

    export default {
        components: {
            UploadFile,
        },
        data() {
            return {
                file: {},
            }
        },
        computed: {
            showUploadFileComponent() {
                return this.file.id === undefined
            },
        },
    }
</script>
