<template>
    <div>
        <b-field>
            <b-checkbox
                @input="addDel()"
                v-model="favorite">
                {{ lang.add_favorites }}
            </b-checkbox>
        </b-field>
    </div>
</template>

<script>

export default {
    name: "ExecutorFavoriteProfile",
    props: {
        executor: Object,
        favorites: Array,
        lang: Object
    },
    data() {
        return {
            favorite: false,
        }
    },
    mounted() {
        this.favorites.filter(x => x.id === this.executor.id).map(x => {
            if (x.id === this.executor.id) {
                this.favorite = true
            }
        })
    },
    methods: {
        addDel() {
            if (this.favorite) {
                this.add()
            } else {
                this.del()
            }
        },
        add() {
            axios.patch('/account/add-favorite', {
                id: this.executor.id,
            }).then(r => {
                if (r.data) {
                    this.$buefy.notification.open({
                        message: this.lang.added_favorites,
                        type: 'is-success'
                    })
                    this.favorite = true
                }
            })
        },
        del() {
            axios.patch('/account/del-favorite', {
                id: this.executor.id,
            }).then(r => {
                if (r.data) {
                    this.$buefy.notification.open({
                        message: this.lang.deleted_favorites,
                        type: 'is-success'
                    })
                    this.favorite = false
                }
            })
        },
    },
}
</script>

<style scoped>

</style>
