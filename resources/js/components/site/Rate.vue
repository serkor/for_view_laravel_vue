<template>
    <section>
        <b-rate
            v-model="rate"
            :icon-pack="packs"
            :icon="icons"
            :max="maxs"
            :size="sizes"
            :locale="locale"
            :show-score="score"
            :custom-text="custom"
            :show-text="text"
            :rtl="isRtl"
            :spaced="isSpaced"
            :disabled="isDisabled">
        </b-rate>
    </section>
</template>
<script>
export default {
    name: "Rate",
    props:['executor'],
    data() {
        return {
            rate: 0,
            maxs: 5,
            sizes: '',
            packs: 'mdi',
            icons: 'star',
            score: true,
            custom: '',
            text: false,
            isRtl: false,
            isSpaced: false,
            isDisabled: true,
            locale: undefined // Browser locale
        }
    },
    mounted() {
        this.rate = parseFloat(this.executor.rate)
    }

}
</script>

<style scoped>

</style>
