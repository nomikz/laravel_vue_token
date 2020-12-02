<template>
    <div>
        <v-card
            max-width="1000"
            class="pa-5 mt-3 mx-auto"
        >
           <v-row>
               <v-col cols="4">
                   <p class="display-1">
                       Создать полис
                   </p>
               </v-col>

               <v-col  cols="8">
                   <v-alert
                       dense
                       outlined
                       type="error"
                       v-if="errorMessage"
                       v-text="errorMessage"
                   >
                   </v-alert>
               </v-col>
           </v-row>

            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >
                <v-row>
                    <v-col>
                        <v-text-field
                            v-model="policy.first_name"
                            :rules="policyValidation.name"
                            label="Имя*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="policy.last_name"
                            :rules="policyValidation.name"
                            label="Фамилия*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="policy.middle_name"
                            :rules="policyValidation.middleName"
                            label="Отчество"
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <v-text-field
                            v-model="policy.iin"
                            :rules="policyValidation.iin"
                            label="ИИН*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="policy.phone"
                            :rules="policyValidation.phone"
                            label="Номер телефона*"
                            placeholder="+7"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="policy.car_number"
                            :rules="policyValidation.car_number"
                            label="Гос. номер ТС*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col>
                        <v-menu
                            v-model="modal.menuValidFrom"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="policy.valid_from"
                                    label="Начала срока"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                    outlined
                                    dense
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                locale="ru-Latn"
                                v-model="policy.valid_from"
                                :min="policyValidation.minDate"
                                @input="menu2 = false"
                            ></v-date-picker>
                        </v-menu>
                    </v-col>

                    <v-col>
                        <v-menu
                            v-model="modal.menuValidUntil"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="290px"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="policy.valid_until"
                                    :rules="validUntilRules"
                                    :disabled="policy.valid_from.length===0"
                                    label="Конец срока"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                    outlined
                                    dense
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                locale="ru-Latn"
                                v-model="policy.valid_until"
                                :min="policyValidation.minDate"
                                @input="menu2 = false"
                            ></v-date-picker>
                        </v-menu>
                    </v-col>
                </v-row>

                <v-divider class="mb-2"></v-divider>

                <h3
                    style="color: #111111"
                    class="font-weight-regular mb-4"
                >
                    Дополнительные водители
                </h3>



                <v-row v-for="(driver, index) in additionalDrivers">
                    <v-col>
                        <v-text-field
                            v-model="additionalDrivers[index].first_name"
                            :rules="policyValidation.name"
                            label="Имя*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="additionalDrivers[index].last_name"
                            :rules="policyValidation.name"
                            label="Фамилия*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="additionalDrivers[index].middle_name"
                            :rules="policyValidation.middleName"
                            label="Отчество"
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>

                    <v-col>
                        <v-text-field
                            v-model="additionalDrivers[index].iin"
                            :rules="policyValidation.iin"
                            label="ИИН*"
                            required
                            outlined
                            dense
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="1"
                    >
                        <v-btn
                            icon
                            color="red lighten-1"
                            @click="deleteAdditionalDriver(index)"
                        >
                            <v-icon>
                                mdi-close-thick
                            </v-icon>
                        </v-btn>
                    </v-col>
                </v-row>

                <v-row
                    align="center"
                    justify="space-around"
                    >
                    <v-btn
                        small
                        class="mx-2"
                        outlined
                        dark
                        color="indigo"
                        @click="addAdditionalDriver"
                    >
                        <v-icon dark small>
                            mdi-plus
                        </v-icon>
                        Добавить водителя
                    </v-btn>
                </v-row>

                <v-divider class="my-5"></v-divider>


                <v-btn
                    color="secondary"
                    class="mr-4"
                    :to="{ name: 'policyList' }"
                >
                    Отменить
                </v-btn>

                <v-btn
                    color="primary"
                    class="mr-4"
                    :disabled="!valid"
                    @click="submit"
                >
                    Создать
                </v-btn>
            </v-form>
        </v-card>
    </div>
</template>


<script>
// TODO: refactor view to components.
import Api from "@/apis/Api";

export default {
    data: () => ({
        modal: {
            menuValidFrom: false,
            menuValidUntil: false,
        },
        errorMessage: '',

        additionalDrivers: [],

        valid: false,

        policy: {
            first_name: '',
            last_name: '',
            middle_name: '',
            iin: '',
            phone: '',
            car_number: '',
            valid_from:  '',
            valid_until:  '',
        },
        policyValidation: {
            name: [
                v => !!v || 'Заполните поле',
                function (v) { // only letters
                    // топорный вариант 😅😅
                    const regExpForCyrillicAndLatin = /[A-Za-z]+|[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ]+/;
                    const regExpForNumbers = /[0-9]+/;

                    if (regExpForCyrillicAndLatin.test(v) && !regExpForNumbers.test(v)) {
                        return true
                    }


                    return 'Поле может содержать только символы английского и русского языка';
                },
                v => (v && v.length > 2) || 'Не может быть короче 2 букв',
            ],
            middleName: [
                v => (v && (v.length > 1) || (v.length === 0)) || 'Не может быть короче 2 букв',
                function (v) { // only letters
                    // топорный вариант 😅😅
                    const regExpForCyrillicAndLatin = /[A-Za-z]+|[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ]+/;
                    const regExpForNumbers = /[0-9]+/;

                    if ((regExpForCyrillicAndLatin.test(v) && !regExpForNumbers.test(v)) || v.length === 0) {
                        return true
                    }

                    return 'Поле может содержать только символы английского и русского языка';
                },
            ],
            iin: [
                function (v) { // only digit chars
                    const regExp = /^\d+$/;
                    if (regExp.test(v)) {
                        return true;
                    }

                    return 'ИИН должен содержать только цифры.';
                },
                v => !!v || 'Заполните ИИН',
                v => (v && v.length === 12) || 'ИИН должен содержать 12 цифр',
            ],
            phone: [
                v => !!v || 'Заполните телефонный номер',
                function (v) { // should start from +7
                    let firstTwoChars = v.substring(0, 2);

                    if (
                        firstTwoChars.localeCompare('+7') === 0
                    ) {
                        return true;
                    }

                    return 'Номер должен начинаться с "+7"';
                },
                function (v) {
                    let lettersAfterPlus = v.substring(1, v.length);
                    const regExp = /^\d+$/;

                    if (regExp.test(lettersAfterPlus)) {
                        return true;
                    }

                    return 'Номер не может содержать буквы';
                },
                v => (v && v.length > 11) || 'Номер слишком короткий',
                v => (v && v.length <= 12) || 'Номер слишком длинный',
            ],
            car_number: [
                v => !!v || 'Заполните номер ТС',
                v => (v && v.length > 5) || 'Слишком короткий номер ТС',
                v => (v && v.length < 8) || 'Слишком длинный номер ТС',
            ],
            minDate: new Date().toJSON().slice(0,10).replace(/-/g,'/'),

        }
    }),
    computed: {
        validUntilRules: function () { // in computed in data(), it can't reference another data property
                return [
                    (v) => {
                        if (new Date(this.policy.valid_from) < new Date(v)) {
                            return true;
                        }

                        return 'Дата завершения не может быть раньше даты начал.';
                    },
                ];
        }
    },
    methods: {
        submit() {
            if(!this.$refs.form.validate()) {
                return;
            }

            let data = this.policy;
            data.additionalDrivers = this.additionalDrivers;

            Api().post('/insurance-policies', data)
                .then((response) => {
                    this.$store.dispatch(
                        'setNotification',
                        {
                            'text': 'Страховой полис успешно создан 👍👍',
                            'color': 'green',
                        }
                    );
                    const policy = response.data.data;

                    this.$router.push({
                        name: 'policyShow',
                        params: {
                            id: policy.id,
                        }
                    });
                })
                .catch((error) => {
                    this.errorMessage = 'Проверьте что правильно заполнили форму!';

                    setTimeout(() => {
                        this.errorMessage = '';
                    }, 2000);
                });
        },
        addAdditionalDriver() {
            this.additionalDrivers.push({
                first_name: '',
                last_name: '',
                middle_name: '',
                iin: '',
            });
        },
        deleteAdditionalDriver(i) {
            console.log('index: ' + i);
            console.log(this.additionalDrivers);

            this.additionalDrivers.splice(i, 1);
        }
    },
}
</script>
