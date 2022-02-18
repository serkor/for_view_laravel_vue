<template>
    <div>
        <div class="columns">
            <div class="column is-2">
                <b-button
                    :label="lang.specify"
                    type="is-dark is-light"
                    @click="isScheduleModalActive = true"/>
            </div>
            <div class="column is-4">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <tbody>
                    <tr>
                        <td>{{ lang.weekdays }}:</td>
                        <td>{{work_hours.weekdays}}</td>
                    </tr>
                    <tr>
                        <td>{{ lang.saturday }}:</td>
                        <td>{{work_hours.saturday}}</td>
                    </tr>
                    <tr>
                        <td>{{lang.sunday}}:</td>
                        <td>{{work_hours.sunday}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <b-modal
            :active="isScheduleModalActive"
            trap-focus
            :can-cancel="false"
            :destroy-on-hide="false"
            aria-role="dialog"
            width="300px"
            aria-modal>
            <template #default="props">
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">{{lang.schedule_title}}</p>
                    </header>
                    <section class="modal-card-body">
                        <b-field :label="lang.weekdays">
                            <b-input
                                manlength="20"
                                type="text"
                                placeholder="9 - 18"
                                v-model="work_hours.weekdays">
                            </b-input>
                        </b-field>
                        <b-field :label="lang.saturday">
                            <b-input
                                manlength="20"
                                placeholder="10 - 16"
                                type="text"
                                v-model="work_hours.saturday">
                            </b-input>
                        </b-field>
                        <b-field :label="lang.sunday">
                            <b-input
                                manlength="20"
                                :placeholder="lang.day_off"
                                type="text"
                                v-model="work_hours.sunday">
                            </b-input>
                        </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            :label="lang.save_1"
                            @click="isScheduleModalActive = false"
                            type="is-dark"/>
                    </footer>
                </div>
            </template>
        </b-modal>
        <input type="text" name="work_hours" :value="JSON.stringify(work_hours)" hidden></input>
    </div>
</template>

<script>

export default {
    name: "ExecutorScheduleProfile",
    props: ['executor', 'lang'],
    data() {
        return {
            isScheduleModalActive: false,
            work_hours: {
                weekdays: '',
                saturday: '',
                sunday: '',
            },
        }
    },
    created() {
        this.work_hours = this.executor.work_hours ? JSON.parse(this.executor.work_hours) : {}
    }
}
</script>

<style scoped>

</style>
