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
                group-field="category.name"
                :placeholder="lang.select"
                @typing="getFilteredTags">
            </b-taginput>
        </b-field>
        <input type="hidden" name="category_ids" v-bind:value="category_ids"/>
    </div>
</template>

<script>

export default {
    name: "ExecutorCategoriesProfile",
    props: ['categories', 'executor_categories', 'lang'],
    data() {
        return {
            isSelectOnly: false,
            tags: [],
            allowNew: false,
            openOnFocus: true,
            category_ids: [],
            filteredTags: this.categories,
        }
    },
    created() {
       this.tags = this.executor_categories
    },
    watch:{
        tags(){
            this.category_ids = Object.keys(this.tags).map(id => this.tags[id].id);
        }
    },
    methods: {
        getFilteredTags(text) {
            this.filteredTags = this.categories.filter((option) => {
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
