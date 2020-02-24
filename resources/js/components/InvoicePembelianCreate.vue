<template>
    <form @submit.prevent="onFormSubmit">
        <div class="uk-margin">
            <label for="nama_perusahaan"
                   class="uk-form-label"> Nama Perusahaan
            </label>

            <input
                id="nama_perusahaan"
                v-model="nama_perusahaan"
                placeholder="Nama Perusahaan"
                class="uk-input"
                :class="{
                    'uk-form-danger': !!this.get(error_data, 'errors.nama_perusahaan[0]', false)
                }"
                type="text"
            >
            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, 'errors.nama_perusahaan[0]', '')}}
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
            <table class="uk-table uk-table-small uk-table-striped">
                <thead>
                <tr>
                    <th> #</th>
                    <th> Nama</th>
                    <th> Jumlah</th>
                    <th> Harga Satuan (Rp.)</th>
                    <th> Diskon Grosir (%)</th>
                    <th> Sub Total</th>
                </tr>
                </thead>

                <tbody>
                <template v-for="(d_picked_obat, index) in this.d_picked_obats">
                    <InvoicePembelianLine v-model="d_picked_obat"
                                          :key="d_picked_obat.id"
                                          :error_data="error_data"
                                          :index="index"/>
                </template>
                </tbody>
            </table>
        </div>

    </form>
</template>

<script>
    import InvoicePembelianLine from "./InvoicePembelianLine";

    export default {
        components: {
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
                nama_perusahaan: null,
                error_data: null,

                d_obat: null,
                d_obats: this.obats.map(obat => ({
                    ...obat,

                    jumlah_obat: 0,
                    harga_satuan_obat: 0,
                    persentase_diskon_grosir: 0,

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

            d_picked_obats() {
                return this.d_obats
                    .filter(({picked}) => picked)
            }
        },

        methods: {
            onFormSubmit() {
            }
        }
    }
</script>
