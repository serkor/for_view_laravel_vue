<template>
    <section>
        <b-field label="Город">
            <b-autocomplete
                v-model="name"
                :data="filteredDataArray"
                placeholder="Киев..."
                icon="magnify"
                field="name"
                clearable
                open-on-focus
                group-field="city.name"
                @select="option => selected = (option ? option.id : '')">
                <template #empty>Ничего не найдено....</template>
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
export default {
    name: "City",
    props: ['cities'],
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
                this.name = ''
            }
        });
    },

    computed: {
        filteredDataArray() {
            return this.cities.filter((option) => {
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
            this.$root.$emit('getCatalogCityId', val);
        },
    },
}
</script>
