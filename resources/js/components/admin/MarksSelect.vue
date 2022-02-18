<template>
    <section>
        <b-field>
            <b-autocomplete
                v-model="name"
                :data="filteredDataArray"
                placeholder="например: Renault..."
                field="name"
                clearable
                open-on-focus
                @select="option => selected = option.id">
                <template #empty>Ничего не найдено....</template>
            </b-autocomplete>
        </b-field>
        <input type="hidden" name="mark_id" :value="id"/>
    </section>
</template>

<script>
export default {
    name: "MarksSelect",
    props: ['marks', 'mark_model'],
    data() {
        return {
            id: null,
            name: '',
            selected: '',
        }
    },

    mounted() {
        if (this.mark_model) {
            this.id = this.mark_model.mark_id
            this.name = this.mark_model.mark.name
        }
    },
    computed: {
        filteredDataArray() {
            return this.marks.filter((option) => {
                return option.name
                    .toString()
                    .toLowerCase()
                    .indexOf(this.name.toLowerCase()) >= 0
            });
        },
    },
    watch: {
        selected(val) {
            this.id = val
        },
    },
}
</script>

<style scoped>

</style>
