<template>
    <form @submit.prevent="onFormSubmit">
        <div class="uk-margin">
            <label for="nama_customer"
                   class="uk-form-label"> Nama Customer
            </label>

            <input
                id="nama_customer"
                v-model="nama_customer"
                placeholder="Nama Customer"
                class="uk-input"
                :class="{
                    'uk-form-danger': !!this.get(error_data, 'errors.nama_customer[0]', false)
                }"
                type="text"
            >
            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.nama_customer[0]', '')}}
            </span>
        </div>

        <div class="uk-margin">
            <label for="waktu_penjualan"
                   class="uk-form-label"> Waktu Penjualan
            </label>

            <datetime
                id="waktu_penjualan"
                :input-class="{'uk-input': true, 'uk-form-danger': get(this.error_data, 'errors.waktu_penjualan', false)}"
                placeholder="Waktu Mulai"
                type="datetime"
                v-model="waktu_penjualan"></datetime>

            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.waktu_penjualan[0]', '')}}
            </span>
        </div>

        <div class="uk-margin">
            <label
                class="uk-form-label"> Obat
            </label>

            <Multiselect
                id="obat"
                v-model="d_obat"
                :options="this.d_unpicked_obats"
                :custom-label="({ nama, total_jumlah }) => `${nama} (Stock: ${total_jumlah})`"
            >
            </Multiselect>


            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.obat[0]', '')}}
            </span>
        </div>

        <div class="uk-margin uk-text-small">
            <table class="uk-table uk-table-small uk-table-striped uk-table-middle">
                <thead>
                <tr>
                    <th> #</th>
                    <th> Nama</th>
                    <th class="uk-text-right"> Stock</th>
                    <th class="uk-text-right"> Jumlah</th>
                    <th class="uk-text-right"> Harga Satuan (Rp.)</th>
                    <th class="uk-text-right"> Diskon Grosir (%)</th>
                    <th class="uk-text-right"> Sub Total (Rp.)</th>
                    <th class="uk-text-center">
                        <i class="fas fa-wrench"></i>
                    </th>
                </tr>
                </thead>

                <tbody>
                <template v-for="(d_picked_obat_id, index) in Object.keys(this.d_picked_obats)">
                    <InvoicePembelianLine v-model="d_picked_obats[d_picked_obat_id]"
                                          :key="d_picked_obat_id"
                                          :error_data="error_data"
                                          :index="index"
                                          @item-remove="id => { d_picked_obats[id].picked = false }"
                    />
                </template>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="uk-text-right"> Sub Total (Rp.):</td>
                    <td class="uk-text-right">
                        {{ currencyFormat(d_picked_obats_subtotal_sum) }}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="uk-margin uk-flex uk-flex-right">
            <button @click.prevent="onFormSubmit"
                    class="uk-button uk-button-primary"
                    type="submit">
                Submit
            </button>
        </div>
    </form>
</template>

<script>
    import InvoicePembelianLine from "./InvoicePenjualanLine";
    import {keyBy, pick, toArray} from "lodash";
    import numeral from "numeral";
    import moment from "moment";
    import {Datetime} from 'vue-datetime';
    import modal from "../modal"

    export default {
        components: {
            InvoicePembelianLine,
            Multiselect: require("vue-multiselect").Multiselect,
            Datetime,
        },

        props: {
            obats: Array,
            submit_url: String,
            redirect_url: String,
        },

        mounted() {
        },

        data() {
            return {
                nama_customer: null,
                waktu_penjualan: null,
                error_data: null,

                d_obat: null,
                d_obats: this.obats.map(obat => ({
                    ...obat,

                    total_jumlah: numeral(obat.total_jumlah).format("0.[0000]"),
                    jumlah_obat: 0,
                    harga_satuan_obat: 0,
                    diskon_grosir: 0,

                    picked: false,
                })),

                d_picked_obats_subtotal_sum: 0,
            }
        },

        watch: {
            d_obat(new_d_obat) {
                if (new_d_obat === null) return
                this.d_obat.picked = true
                this.d_obat = null
            },

            d_obats: {
                deep: true,
                handler: function () {
                    this.d_picked_obats_subtotal_sum = Object.keys(this.d_picked_obats)
                        .map(key => this.d_picked_obats[key])
                        .reduce((curr, next) => {
                            return curr + (next.sub_total ?? 0)
                        }, 0)
                }
            }
        },

        computed: {
            d_unpicked_obats() {
                return this.d_obats
                    .filter(({picked}) => !picked)
            },

            d_picked_obats() {
                return keyBy(
                    this.d_obats.filter(({picked}) => picked),
                    "id"
                )
            },

            form_data() {
                return {
                    nama_customer: this.nama_customer,
                    waktu_penjualan: moment(this.waktu_penjualan).format("YYYY-MM-DD HH:mm:ss"),
                    item_penjualans: toArray(this.d_picked_obats)
                        .map(obat => pick(obat, ["id", "jumlah_obat", "harga_satuan_obat", "diskon_grosir"]))
                }
            }
        },

        methods: {
            onFormSubmit() {
                modal.confirmationModal()
                    .then(result => {
                        if (!result.value) throw new Error();
                        return axios.post(this.submit_url, this.form_data)
                    })
                    .then(() => {
                        window.location.replace(this.redirect_url)
                    })
                    .catch(error => {
                        let error_data = get(error, "response.data", null);
                        if (error_data) this.error_data = error_data;
                    })
            }
        }
    }
</script>
