<template>
    <section>
        <b-field>
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
        <input type="hidden" name="city_id" :value="id"/>
    </section>
</template>

<script>
export default {
    name: "CitySelect",
    props: ['cities', 'city'],
    data() {
        return {
            id: null,
            name: '',
            selected: '',
        }
    },
    mounted() {
        if (this.city) {
            this.id = this.city.id
            this.name = this.city.name
        }
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
        },
    },
}
</script>
