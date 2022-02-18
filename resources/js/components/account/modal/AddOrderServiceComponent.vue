<template>
    <div class="py-4">
        <div class="d-flex">
            <div>
                <button class="btn btn-success" @click="show=true">{{ lang_service.create_order }}</button>
            </div>
        </div>

        <stack-modal
            :show="show"
            title="Заказ услуги"
            :modal-class="{ [modalClass]: true }"
            @close="show=false"
            @closeOnEscape="true"
            :saveButton="{ visible: false}"
            :cancelButton="{ visible: false }">

            <div v-if="error_message" class="alert alert-danger" role="alert">
                {{ error_message }}
            </div>

            <div v-if="success_message" class="alert alert-success" role="alert">
                {{ success_message }}
            </div>

            <div v-if="form_block" class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label>{{ lang_service.order.name }}</label>
                        <input type="text" class="form-control" readonly :value="order.name"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ lang_service.order.price }}</label>
                        <input type="text" class="form-control" readonly v-model="order.price"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ lang_service.order.place }}</label>
                    <input type="text" class="form-control" v-model="order.place"/>
                </div>
                <div class="form-group">
                    <label>{{ lang_service.order.description }}</label>
                    <textarea type="text" class="form-control" v-model="order.description"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>{{ lang_service.order.person }}</label>
                        <input type="number" min="1" class="form-control" v-model="order.person"/>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ lang_service.order.hours }}</label>
                        <input type="number" min="1" class="form-control" v-model="order.hours"/>
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{ lang_service.order.total }}</label>
                        <input type="text" class="form-control" readonly v-bind:value="totalSum"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ lang_service.order.start }}</label>
                        <datetime type="datetime" format="yyyy-MM-dd HH:mm"
                                  v-model="order.start"></datetime>
                    </div>
                    <div class="form-group col-md-3">
                        <label>{{ lang_service.order.end }}</label>
                        <datetime type="datetime" format="yyyy-MM-dd HH:mm"
                                  v-model="order.end"></datetime>
                    </div>
                </div>
            </div>
            <div v-if="form_block">
                <button class="btn-lg btn-success" @click="addServiceOrder()">{{ lang_service.order.create }}</button>
            </div>

        </stack-modal>

    </div>
</template>

<script>
import StackModal from '@innologica/vue-stackable-modal';
import {Datetime} from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';

export default {
    name: "StackableModalDemo",
    components: {StackModal, Datetime},
    props: ['service', 'customer_id', 'executor_id', 'lang_service'],
    data() {
        return {
            error_message: '',
            success_message: '',
            form_block: true,
            show: false,
            modalClass: 'modal-lg',
            order: {
                id: 0,
                customer_id: this.customer_id,
                executor_id: this.executor_id,
                service_id: this.service.id,
                name: this.service.name,
                price: this.service.price,
                sale: 0,
                total: 0,
                hours: 1,
                person: 1,
                place: '',
                description: '',
                start: '',
                end: '',
            }
        }
    },
    computed: {
        totalSum() {
            this.order.total = this.order.hours * this.order.price;
            return this.order.total;
        },
    },
    methods: {
        addServiceOrder() {

            if (this.order.start === '' || this.order.end === '' || this.order.place === '' || this.order.description === '') {
                return this.error_message = this.lang_service.order.all_full_fields;
            }
            if (this.order.start === this.order.end) {
                return this.error_message = this.lang_service.order.time_is_null;
            }

            axios.patch('/account/customer-store-order-service', {
                order_service: {
                    customer_id: this.order.customer_id,
                    executor_id: this.order.executor_id,
                    service_id: this.order.service_id,
                    name: this.order.name,
                    description: this.order.description,
                    price: this.order.price,
                    sale: this.order.sale,
                    total: this.order.total,
                    hours: this.order.hours,
                    person: this.order.person,
                    place: this.order.place,
                    start: this.$luxon(this.order.start, "yyyy-MM-dd HH:mm"),
                    end: this.$luxon(this.order.end, "yyyy-MM-dd HH:mm"),
                },
            }).then(response => {
                this.order.id = response.data.order_service.id;
                this.addReminder(response.data.order_service.id);
                console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });

        },

        addReminder(id) {

            const new_id = Math.random().toString(36).substring(2, 15);
            axios.patch('/account/customer-store-reminder-calendar', {
                reminder: {
                    new_id: new_id,
                    type: 1,
                    title: 'Заказ №' + id,
                    executor_id: this.order.executor_id,
                    url: 'edit-executor-order-service/' + id,
                    start: this.$luxon(this.order.start, "yyyy-MM-dd HH:mm"),
                    end: this.$luxon(this.order.end, "yyyy-MM-dd HH:mm"),
                    allDay: false,
                },
            }).then(response => {
                console.log(response.data);
            }).catch(function (error) {
                console.log(error);
            });

            this.error_message = ''
            this.form_block = false;
            this.success_message = this.lang_service.order.order_created

        }

    },
}
</script>
