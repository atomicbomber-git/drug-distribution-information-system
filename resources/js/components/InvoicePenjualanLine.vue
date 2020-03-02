<template>
    <tr>
        <td> {{ index + 1 }}</td>
        <td> {{ value.nama }}</td>
        <td>
            <input
                    v-model.number="value.jumlah_obat"
                    placeholder="Jumlah"
                    class="uk-input"
                    :class="{'uk-form-danger': !!(get(error_data, 'errors.jumlah[0]', false))}"
                    type="number"
            >
        </td>
        <td>
            <input
                    v-model.number="value.harga_satuan_obat"
                    placeholder="Harga Satuan"
                    class="uk-input"
                    :class="{'uk-form-danger': !!(get(error_data, 'errors.harga_satuan[0]', false))}"
                    type="number"
            >
        </td>
        <td>
            <input
                    max="15"
                    v-model.number="value.diskon_grosir"
                    placeholder="Diskon Grosir"
                    class="uk-input"
                    :class="{'uk-form-danger': !!(get(error_data, 'errors.diskon_grosir[0]', false))}"
                    type="number"
            >
        </td>
        <td>
            {{ sub_total }}
        </td>
    </tr>
</template>
<script>
    export default {
        name: 'InvoicePenjualanLine',
        props: {
            value: {},
            error_data: {},
            index: {}
        },

        watch: {
            "value.diskon_grosir": function (new_diskon_grosir) {
                if (new_diskon_grosir > 15) {
                    this.value.diskon_grosir = 15
                }
            },
        },

        computed: {
            sub_total() {
                return this.value.jumlah_obat +
                    this.value.harga_satuan_obat +
                    this.value.diskon_grosir
            }
        },
    }
</script>
