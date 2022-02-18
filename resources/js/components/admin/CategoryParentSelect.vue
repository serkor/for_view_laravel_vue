<template>
    <section>
        <b-field>
            <b-autocomplete
                v-model="name"
                :data="filteredDataArray"
                placeholder="например: ТО..."
                field="name"
                clearable
                open-on-focus
                group-field="category.name"
                @select="option => selected = option.id">
                <template #empty>Ничего не найдено....</template>
            </b-autocomplete>
        </b-field>
        <input type="hidden" name="parent_id" :value="id"/>
    </section>
</template>

<script>
export default {
    name: "CategoryParentSelect",
    props: ['categories', 'parent'],
    data() {
        return {
            id: null,
            name: '',
            selected: '',
        }
    },

    mounted() {
        if (this.parent) {
            this.id = this.parent.parent_id
            this.name = this.parent.category.name
        }
    },
    computed: {
        filteredDataArray() {
            return this.categories.filter((option) => {
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
