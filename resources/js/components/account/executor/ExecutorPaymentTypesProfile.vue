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
        <input type="hidden" name="payment_type_ids" v-bind:value="payment_type_ids"/>
    </div>
</template>

<script>

export default {
    name: "ExecutorPaymentTypesProfile",
    props:['payment_types', 'executor_payment_types', 'lang'],
    data(){
        return {
            isSelectOnly: false,
            tags: [],
            allowNew: false,
            openOnFocus: true,
            payment_type_ids: [],
            filteredTags: this.payment_types,
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
        getFilteredTags(text) {
            this.filteredTags = this.payment_types.filter((option) => {
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
