<template>
    <form @submit.prevent="onFormSubmit">
        <div class="uk-margin">
            <label for="nama_supplier"
                   class="uk-form-label"> Nama Supplier
            </label>

            <input
                id="nama_supplier"
                v-model="nama_supplier"
                placeholder="Nama Supplier"
                class="uk-input"
                :class="{
                    'uk-form-danger': !!this.get(error_data, 'errors.nama_supplier[0]', false)
                }"
                type="text"
            >
            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.nama_supplier[0]', '')}}
            </span>
        </div>

        <div class="uk-margin">
            <label for="waktu_penerimaan"
                   class="uk-form-label"> Waktu Penerimaan
            </label>

            <input
                id="waktu_penerimaan"
                v-model="waktu_penerimaan"
                placeholder="Waktu Penerimaan"
                class="uk-input"
                :class="{
                    'uk-form-danger': !!this.get(error_data, 'errors.waktu_penerimaan[0]', false)
                }"
                type="datetime-local"
            >
            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.waktu_penerimaan[0]', '')}}
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
                :custom-label="({ nama }) => nama"
            >
            </Multiselect>

            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.item_penerimaans[0]', '')}}
            </span>
        </div>

        <div class="uk-margin uk-text-small">
            <table class="uk-table uk-table-small uk-table-striped">
                <thead>
                <tr>
                    <th> #</th>
                    <th> Nama</th>
                    <th class="uk-text-right"> Tanggal Kadaluarsa</th>
                    <th class="uk-text-right"> Jumlah</th>
                    <th class="uk-text-right"> Harga Satuan (Rp.)</th>
                    <th class="uk-text-right"> Sub Total (Rp.)</th>
                </tr>
                </thead>

                <tbody>
                <template v-for="(d_picked_obat_id, index) in Object.keys(this.d_picked_obats)">
                    <PenerimaanLine v-model="d_picked_obats[d_picked_obat_id]"
                                    :key="d_picked_obat_id"
                                    :error_data="error_data"
                                    :index="index"/>
                </template>
                </tbody>
                <tfoot>
                <tr>
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
            <button type="submit"
                    class="uk-button uk-button-primary">
                Terima
            </button>
        </div>
    </form>
</template>

<script>
    import InvoicePembelianLine from "./InvoicePenjualanLine";
    import {get, keyBy, pick, toArray} from "lodash";
    import PenerimaanLine from "./PenerimaanLine";
    import moment from "moment";
    import modal from "../modal"

    export default {
        components: {
            PenerimaanLine,
            InvoicePembelianLine,
            Multiselect: require("vue-multiselect").Multiselect
        },

        props: {
            obats: Array,
            submit_url: String,
            redirect_url: String,
            penerimaan: Object,
        },

        data() {
            return {
                nama_supplier: null,
                waktu_penerimaan: null,
                error_data: null,

                d_obat: null,
                d_obats: this.obats.map(obat => {
                    let item_penerimaan = this.penerimaan.item_penerimaans.find(item_penerimaan => {
                        return item_penerimaan.obat_id === obat.id
                    });

                    if (item_penerimaan) {
                        return {
                            ...obat,

                            tanggal_kadaluarsa: moment(item_penerimaan.tanggal_kadaluarsa).format("YYYY-MM-DD"),
                            jumlah_obat: item_penerimaan.jumlah,
                            harga_satuan_obat: item_penerimaan.harga_satuan,
                            sub_total: null,

                            picked: true,
                        }
                    }

                    return {
                        ...obat,

                        jumlah_obat: 0,
                        harga_satuan_obat: 0,
                        sub_total: 0,

                        picked: false,
                    }
                })
            }
        },

        watch: {
            d_obat(new_d_obat) {
                if (new_d_obat === null) return;
                this.d_obat.picked = true;
                this.d_obat = null
            },
        },

        computed: {
            d_unpicked_obats() {
                return this.d_obats
                    .filter(({picked}) => !picked)
            },

            d_picked_obats_subtotal_sum() {
                return Object.keys(this.d_picked_obats).reduce((curr, next) => {
                    return curr + (this.d_picked_obats[next].sub_total ?? 0)
                }, 0)
            },

            d_picked_obats() {
                return keyBy(
                    this.d_obats.filter(({picked}) => picked),
                    "id"
                )
            },

            form_data() {
                return {
                    nama_supplier: this.nama_supplier,
                    waktu_penerimaan: moment(this.waktu_penerimaan).format("YYYY-MM-DD HH:mm:ss"),
                    item_penerimaans: toArray(this.d_picked_obats)
                        .map(obat => pick(obat, ["id", "jumlah_obat", "harga_satuan_obat", "tanggal_kadaluarsa"]))
                        .map(obat => ({
                            ...obat,
                            tanggal_kadaluarsa: moment(obat.tanggal_kadaluarsa).format("YYYY-MM-DD")
                        }))
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
