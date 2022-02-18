<template>
    <div>
        <b-field>
            <b-taginput
                v-model="tags"
                :data="filteredTags"
                autocomplete
                :allow-new="allowNew"
                :open-on-focus="openOnFocus"
                field="name"
                icon="label"
                :placeholder="lang.select"
                @typing="getFilteredTags">
            </b-taginput>
        </b-field>
        <input type="hidden" name="additional_service_ids" v-bind:value="additional_service_ids"/>
    </div>
</template>

<script>

export default {
    name: "ExecutorAdditionalServicesProfile",
    props:['additional_services', 'executor_additional_services', 'lang'],
    data(){
        return {
            isSelectOnly: false,
            tags: [],
            allowNew: false,
            openOnFocus: true,
            additional_service_ids: [],
            filteredTags: this.additional_services,
        }
    },

    created() {
       this.tags = this.executor_additional_services
    },
    watch:{
        tags(){
            this.additional_service_ids = Object.keys(this.tags).map(id => this.tags[id].id);
        }
    },
    methods: {
        getFilteredTags(text) {
            this.filteredTags = this.additional_services.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(text.toLowerCase()) >= 0
            })
        }
    }
}
</script>

<style scoped>

</style>
