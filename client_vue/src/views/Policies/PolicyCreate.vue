<template>
    <div>
        <v-row>
            <v-col cols="3"></v-col>
            <v-col cols="6">
                <v-card
                    width="600"
                    class="pa-7"
                >
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <v-text-field
                            v-model="policy.first_name"
                            :rules="policyValidation.name"
                            label="Имя*"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="policy.last_name"
                            :rules="policyValidation.name"
                            label="Фамилия*"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="policy.middle_name"
                            :rules="policyValidation.middleName"
                            label="Очество"
                        ></v-text-field>

                        <v-text-field
                            v-model="policy.iin"
                            :rules="policyValidation.iin"
                            label="ИИН*"
                            required
                        ></v-text-field>

                        <v-text-field
                            v-model="policy.phone"
                            :rules="policyValidation.phone"
                            label="Номер телефона"
                            placeholder="+7"
                        ></v-text-field>

                        <v-text-field
                            v-model="policy.car_number"
                            :rules="policyValidation.car_number"
                            label="Гос. номер ТС*"
                        ></v-text-field>


                        <v-row>
                            <v-col
                                cols="12"
                            >
                                <v-date-picker
                                    v-model="dates"
                                    range
                                    locale="ru-Latn"
                                    selected-items-text="Выберите период"
                                ></v-date-picker>
                            </v-col>
                        </v-row>

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
            </v-col>
        </v-row>
    </div>
</template>
<script>

import Api from "@/apis/Api";

export default {
    data: () => ({
        dates: ['2019-09-10', '2019-09-20'],

        valid: true,
        policy: {
            first_name: '',
            last_name: '',
            middle_name: '',
            iin: '',
            phone: '',
            car_number: '',
            valid_from: '',
            valid_until: '',
        },
        policyValidation: {
            name: [
                v => !!v || 'Заполните поле',
                function (v) { // only letters
                    // топорный вариант 😅😅
                    const regExpForCyrillic = /^[аАбБвВгГдДеЕёЁжЖзЗиИйЙкКлЛмМнНоОпПрРсСтТуУфФхХцЦчЧшШщЩъЪыЫьЬэЭюЮяЯ]+$/;
                    const regExpForLatin = /^[A-Za-z]+$/;

                    if (
                        regExpForCyrillic.test(v)
                        || regExpForLatin.test(v)
                    ) {
                        return true
                    }

                    return 'Поле может содержать только буквы';
                },
                v => (v && v.length > 2) || 'Не может быть короче 2 букв',
            ],
            middleName: [
                v => (v && (v.length > 1) || (v.length === 0)) || 'Не может быть короче 2 букв',
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
        }
    }),
    computed: {
        dateRangeText () {
            return this.dates.join(' ~ ')
        },
    },

    methods: {
        submit() {
            let data = this.policy;

            if (!this.policy.middle_name) {
                delete data['middle_name'];
            }

            data.valid_from = this.dates[0];
            data.valid_until = this.dates[1];

            Api().post('/insurance-policies', data)
                .then((response) => {
                    const policy = response.data.data;

                    this.$router.push({
                        name: 'policyShow',
                        params: {
                            id: policy.id,
                        }
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
}
</script>
