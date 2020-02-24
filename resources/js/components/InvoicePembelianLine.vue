<template>
    <tr>
        <td> {{ index + 1 }}</td>
        <td> {{ value.nama }}</td>
        <td>
            <input
                    v-model="value.jumlah_obat"
                    placeholder="Jumlah"
                    class="uk-input"
                    :class="{
                                        'uk-form-danger': !!(get(error_data, 'errors.jumlah[0]', false))
                                }"
                    type="number"
            >
        </td>
        <td>
            <input
                    v-model="value.harga_satuan"
                    placeholder="Harga Satuan"
                    class="uk-input"
                    :class="{
                                        'uk-form-danger': !!(get(error_data, 'errors.harga_satuan[0]', false))
                                }"
                    type="number"
            >
        </td>
        <td>
            <input
                    v-model="value.diskon_grosir"
                    placeholder="Diskon Grosir"
                    class="uk-input"
                    :class="{
                                        'uk-form-danger': !!(get(error_data, 'errors.diskon_grosir[0]', false))
                                }"
                    type="number"
            >
        </td>
        <td>
        </td>
    </tr>
</template>
<script>
    export default {
        name: 'InvoicePembelianLine',
        props: {
            value: {},
            error_data: {},
            index: {}
        }
    }
</script>
