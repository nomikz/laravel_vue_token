<template>
    <div class="home">
        <div>
            <v-data-table
                :headers="headers"
                :items="insurancePolicies"
                @click:row="showItem"
                class="elevation-1"
                hide-default-footer
            >

                <!--top bar-->
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Страховые полисы</v-toolbar-title>
                        <v-divider
                            class="mx-4"
                            inset
                            vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            :to="{name: 'policyCreate'}"
                        >
                            Создать полис
                        </v-btn>
                    </v-toolbar>
                </template>

                <!--http error-->
                <template v-slot:no-data>
                    <v-btn
                        color="primary"
                        @click="initialize"
                    >
                        Перезагрузить
                    </v-btn>
                </template>

            </v-data-table>

            <!--pagination-->
            <div class="text-center">
                <v-pagination
                    class="py-2"
                    v-model="pagination.currentPage"
                    :length="pagination.pagesCount"
                ></v-pagination>
            </div>
        </div>


    </div>
</template>

<script>
import User from "@/apis/User";
import Api from "@/apis/Api";

export default {
    name: 'Home',
    data() {
        return {
            authUser: {},
            insurancePolicies: [],
            headers: [
                {
                    text: 'id',
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                {
                    text: 'Имя',
                    sortable: false,
                    value: 'first_name',
                },
                {
                    text: 'Фамилия',
                    value: 'last_name',
                    sortable: false,
                },
                {
                    text: 'Очество',
                    value: 'middle_name',
                    sortable: false,
                },
                {
                    text: 'ИИН',
                    value: 'iin',
                    sortable: false,
                },
                {
                    text: 'Телефон',
                    value: 'phone',
                    sortable: false,
                },
                {
                    text: 'Гос. номер ТС',
                    value: 'car_number',
                    sortable: false
                },
                {
                    text: 'Количество водителей',
                    value: 'drivers_count',
                    sortable: false
                },
            ],
            pagination: {
                pagesCount: 1,
                currentPage: 1,
            },
        }
    },
    components: {
    },
    watch: {
        'pagination.currentPage': function(newV, oldV) {
            this.loadPolicies(newV);
        }
    },
    created () {
        User.auth()
            .then((response) => {
                this.authUser = response.data;
                this.loadPolicies(1);
            });
    },
    methods: {
        loadPolicies(pageNumber) {
            Api()
                .get('insurance-policies?withDriversCount=true&page=' + pageNumber)
                .then(({data}) => {
                    this.insurancePolicies = data.data;

                    this.pagination.currentPage = data.meta.current_page;
                    this.pagination.pagesCount = data.meta.last_page;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        showItem (row) {
            this.$router.push(
                {
                    name: 'policyShow',
                    params: {
                        id: row.id
                    }
                }
            );
        },
    }
}
</script>
