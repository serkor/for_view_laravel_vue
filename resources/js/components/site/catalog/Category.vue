<template>
    <section>
        <b-field label="Вид работы">
            <b-autocomplete
                v-model="name"
                :data="filteredDataArray"
                placeholder="Кузовные работы.."
                icon="magnify"
                field="name"
                clearable
                open-on-focus
                group-field="category.name"
                @select="option => selected = (option ? option.id : '')">
                <template #empty>Ничего не найдено....</template>
            </b-autocomplete>
        </b-field>

    </section>
</template>

<script>
export default {
    name: "Category",
    props: ['categories'],
    data() {
        return {
            id: null,
            name: '',
            selected: '',
        }
    },

    mounted() {
        this.$root.$on('isClearFilterCatalog', data => {
            if(data){
                this.selected = ''
            }
        });
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
            this.$root.$emit('getCatalogCategoryId', val);
        },
    },
}
</script>
