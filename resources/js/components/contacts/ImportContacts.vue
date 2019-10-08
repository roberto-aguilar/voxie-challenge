<template>
    <upload-file v-model="file" v-if="showUploadFileComponent"></upload-file>
    <map-fields v-model="file" v-else-if="showMapFieldsComponent"></map-fields>
    <show-progress v-model="file" v-else></show-progress>
</template>

<script>
    import UploadFile from './UploadFile'
    import MapFields from './MapFields'
    import ShowProgress from './ShowProgress'

    export default {
        components: {
            UploadFile,
            MapFields,
            ShowProgress,
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
            showMapFieldsComponent() {
                return this.file.field_mappings === undefined
            },
        },
    }
</script>
