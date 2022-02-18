<template>
    <div>
        <b-field>
            <b-taginput
                v-model="tags"
                :data="additional_services"
                autocomplete
                :allow-new="allowNew"
                :open-on-focus="openOnFocus"
                field="name"
                icon="label"
                placeholder="Выбрать....."
                @typing="getFilteredAdditionalServices">
            </b-taginput>
        </b-field>
        <input type="hidden" name="additional_service_ids" v-bind:value="additional_service_ids"/>
    </div>
</template>

<script>

export default {
    name: "AdditionalServicesProfile",
    props:['additional_services', 'executor_additional_services'],
    data(){
        return {
            filteredPaymentTypes: this.additional_services,
            isSelectOnly: false,
            tags: [],
            allowNew: false,
            openOnFocus: true,
            additional_service_ids: []
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
        Json(val){
          return JSON.parse(val)
        },
        getFilteredAdditionalServices(text) {
            this.additional_services.filter((option) => {
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
