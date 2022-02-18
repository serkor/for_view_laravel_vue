<template>
    <div>
        <b-tabs v-model="activeTabRegister" type="is-toggle" expanded>
            <b-tab-item value="customer" label="Автомобилист" icon="car">
                <customer-register
                    :lang="lang">
                </customer-register>
            </b-tab-item>

            <b-tab-item value="executor" label="Мастерская" icon="car-battery">
                <executor-register
                    :cities="cities"
                    :lang="lang">
                </executor-register>
            </b-tab-item>

            <b-tab-item value="login" label="Войти на сайт" icon="login"></b-tab-item>
        </b-tabs>
    </div>
</template>

<script>
export default {
    name: "allRegister",
    props:['lang', 'cities'],
    data() {
        return {
            activeTabRegister: 'customer'
        }
    },
    mounted() {
        this.activeTabRegister = localStorage.getItem('activeTabRegister')
    },
    watch: {
        activeTabRegister(val) {
            localStorage.setItem('activeTabRegister', val);
            if(val === 'login'){
                location.href = "/login";
                localStorage.removeItem('activeTabRegister');
            }
        }
    }
}
</script>
