<template>
    <div class="buttons">
        <span :class="'mdi mdi-bell mdi-24px ' + active"></span>
        <span class="tag is-rounded notifications">{{ count }}</span>
    </div>
</template>

<script>
export default {
    name: "NotificationsCount",
    data(){
        return {
            count: 0,
            active: ''
        }
    },
    created() {
        this.getCount()
    },
    mounted() {
        setInterval(() => {
            this.getCount()
        }, 200000)
    },
    methods:{
        getCount() {
            axios.patch('/get-count-notifications').then(r => {
                this.count = r.data;
                if(r.data > 0){
                    this.active = 'notify is-active'
                }
            });
        },
    }
}
</script>

<style scoped>

</style>
