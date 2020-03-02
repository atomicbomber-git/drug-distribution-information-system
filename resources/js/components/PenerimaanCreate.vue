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
                {{ this.get(error_data, 'errors.obat[0]', '')}}
            </span>
        </div>

        <div class="uk-margin uk-text-small">
            <table class="uk-table uk-table-small uk-table-striped uk-table-middle">
                <thead>
                <tr>
                    <th> #</th>
                    <th> Nama</th>
                    <th class="uk-text-right"> Jumlah </th>
                    <th class="uk-text-right"> Harga Satuan (Rp.) </th>
                    <th class="uk-text-right"> Sub Total (Rp.) </th>
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
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td class="uk-text-right"> Sub Total: </td>
                        <td class="uk-text-right">
                            {{ d_picked_obats_subtotal_sum }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </form>
</template>

<script>
    import InvoicePembelianLine from "./InvoicePenjualanLine";
    import {keyBy} from "lodash";
    import PenerimaanLine from "./PenerimaanLine";

    export default {
        components: {
            PenerimaanLine,
            InvoicePembelianLine,
            Multiselect: require("vue-multiselect").Multiselect
        },

        props: {
            "obats": Array,
        },

        mounted() {
        },

        data() {
            return {
                submit_url: null,
                redirect_url: null,
                nama_supplier: null,
                error_data: null,

                d_obat: null,
                d_obats: this.obats.map(obat => ({
                    ...obat,

                    jumlah_obat: 0,
                    harga_satuan_obat: 0,
                    sub_total: 0,

                    picked: false,
                }))
            }
        },

        watch: {
            d_obat(new_d_obat) {
                if (new_d_obat === null) return
                this.d_obat.picked = true
                this.d_obat = null
            }
        },

        computed: {
            d_unpicked_obats() {
                return this.d_obats
                    .filter(({picked}) => !picked)
            },

            d_picked_obats_subtotal_sum() {
                return Object.keys(this.d_picked_obats).reduce((curr, next) => {
                    return curr + (
                        (this.d_picked_obats[next]["jumlah_obat"] ?? 0) *
                        (this.d_picked_obats[next]["harga_satuan_obat"] ?? 0)
                    )
                }, 0)
            },

            d_picked_obats() {
                return keyBy(
                    this.d_obats.filter(({picked}) => picked),
                    "id"
                )
            }
        },

        methods: {
            onFormSubmit() {
            }
        }
    }
</script>
