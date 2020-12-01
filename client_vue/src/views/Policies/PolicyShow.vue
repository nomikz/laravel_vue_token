<template>
    <div>

        <v-row>
            <!--insurance policy-->
            <v-col cols="6" class="pa-10">
                <p class="display-1">Страховой полис</p>
                <v-card
                    class="mx-auto pa-4"
                >
                    <v-simple-table>
                        <template v-slot:default>
                            <tbody>
                            <tr
                                v-for="(field, i) in policyFields"
                                :key="i"
                            >
                                <td>{{ field.name }}</td>
                                <td>{{ policy[field.key] }}</td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </v-card>
            </v-col>

            <!--additional drivers-->
            <v-col cols="6" class="pa-10">
                <p class="display-1">Дополнительные водители</p>
                <template v-if="!hasDrivers">
                    <p class="text--secondary">Полис не имеет дополнительных водилетей.</p>
                </template>
                <template v-else>
                    <v-card
                        width="400"
                        class="mb-4"
                        v-for="driver in policy.additional_drivers"
                    >
                        <v-simple-table>
                            <template v-slot:default>
                                <tbody>
                                <tr
                                    v-for="(field, i) in driverFields"
                                    :key="i"
                                >
                                    <td>{{ field.name }}</td>
                                    <td>{{ driver[field.key] }}</td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-card>
                </template>
            </v-col>
        </v-row>
    </div>
</template>

<script>

import Api from "@/apis/Api";

export default {
    data() {
        return {
            policy: {},
            driverFields: [
                {
                    key: 'first_name',
                    name: 'Имя',
                },
                {
                    key: 'last_name',
                    name: 'Фамилия',
                },
                {
                    key: 'middle_name',
                    name: 'Отчество',
                },
                {
                    key: 'iin',
                    name: 'ИИН',
                },
            ],
            policyFields: [
                {
                    key: 'first_name',
                    name: 'Имя',
                },
                {
                    key: 'last_name',
                    name: 'Фамилия',
                },
                {
                    key: 'middle_name',
                    name: 'Отчество',
                },
                {
                    key: 'iin',
                    name: 'ИИН',
                },
                {
                    key: 'phone',
                    name: 'Телефон',
                },
                {
                    key: 'car_number',
                    name: 'Гос. номер ТС',
                },
            ]
        }
    },
    created() {
        this.loadPolicy(this.$route.params.id);
    },
    computed: {
        hasDrivers: function () {
            if (this.policy.additional_drivers) {
                return this.policy.additional_drivers.length
            } else {
                return true
            }
        }
    },
    methods: {
        loadPolicy(id) {
            Api().get('/insurance-policies/' + id)
                .then(({data}) => {
                    this.policy = data.data;
                });
        }
    }
}
</script>
