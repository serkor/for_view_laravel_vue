<template>
    <section>
        <b-dropdown
            v-model="template"
            aria-role="list">
            <template #trigger>
                <b-button
                    type="is-info is-light"
                    icon-right="menu-down">
                </b-button>
            </template>
            <b-dropdown-item v-for="template in offer_templates" :key="template.id" :value="template" aria-role="listitem">
                <span>{{ template.name }}</span>
            </b-dropdown-item>

            <b-dropdown-item @click="clear" aria-role="listitem">
                <span><strong>{{ lang.clear }}</strong></span>
            </b-dropdown-item>
        </b-dropdown>
    </section>
</template>

<script>
export default {
    name: "ExecutorOfferTemplate",
    props: ['offer_templates', 'lang'],
    data(){
        return {
            template: {},
        }
    },
    methods:{
        clear(){
            this.template = {}
            this.$root.$emit('sendOfferTemplateExecutorBid', this.template)
        }
    },
    watch:{
        template(){
            this.$root.$emit('sendOfferTemplateExecutorBid', this.template)
        }
    }
}
</script>

<style scoped>

</style>
