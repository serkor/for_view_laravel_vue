<template>
    <div>
        <b-field>
            <b-taginput
                v-model="tags"
                :data="payment_types"
                autocomplete
                :allow-new="allowNew"
                :open-on-focus="openOnFocus"
                field="name"
                icon="label"
                placeholder="Выбрать ....."
                @typing="getFilteredPaymentTypes">
            </b-taginput>
        </b-field>
        <input type="hidden" name="payment_type_ids" v-bind:value="payment_type_ids"/>
    </div>
</template>

<script>

export default {
    name: "PaymentTypesProfile",
    props:['payment_types', 'executor_payment_types'],
    data(){
        return {
            filteredPaymentTypes: this.payment_types,
            isSelectOnly: false,
            tags: [],
            allowNew: false,
            openOnFocus: true,
            payment_type_ids: []
        }
    },

    created() {
       this.tags = this.executor_payment_types
    },
    watch:{
        tags(){
            this.payment_type_ids = Object.keys(this.tags).map(id => this.tags[id].id);
        }
    },
    methods: {
        Json(val){
          return JSON.parse(val)
        },
        getFilteredPaymentTypes(text) {
            this.payment_types.filter((option) => {
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
