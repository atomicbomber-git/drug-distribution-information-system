<template>
    <tr>
        <td> {{ index + 1 }}</td>
        <td> {{ value.nama }}</td>
        <td class="uk-text-right"> {{ quantityFormat(value.total_jumlah) }}</td>
        <td>
            <input
                v-model.number="value.jumlah_obat"
                placeholder="Jumlah"
                class="uk-input uk-text-right"
                :class="{'uk-form-danger': !!(get(error_data, 'errors.jumlah[0]', false))}"
                type="number"
            >
        </td>
        <td>
            <input
                v-model.number="value.harga_satuan_obat"
                placeholder="Harga Satuan"
                class="uk-input uk-text-right"
                :class="{'uk-form-danger': !!(get(error_data, 'errors.harga_satuan[0]', false))}"
                type="number"
            >
        </td>
        <td>
            <input
                max="15"
                v-model.number="value.diskon_grosir"
                placeholder="Diskon Grosir"
                class="uk-input uk-text-right"
                :class="{'uk-form-danger': !!(get(error_data, 'errors.diskon_grosir[0]', false))}"
                type="number"
            >
        </td>
        <td class="uk-text-right">
            {{ currencyFormat(this.sub_total) }}
        </td>
        <td class="uk-text-center">
            <button
                    @click="onItemRemove()"
                    class="uk-button uk-button-danger uk-button-small"
                    type="button">
                <i class="fas fa-trash"></i>
            </button>
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

        mounted() {
            this.value.sub_total = this.sub_total
        },

        methods: {
          onItemRemove() {
              this.$emit("item-remove", this.value.id)
          }
        },

        watch: {
            "value.diskon_grosir": function (new_diskon_grosir) {
                if (new_diskon_grosir > 15) {
                    this.value.diskon_grosir = 15
                }
            },

            sub_total(new_sub_total) {
                this.value.sub_total = new_sub_total
            },

            value: {
                handler: function () {
                    this.$emit('input', this.value);
                },
                deep: true,
            }
        },

        computed: {
            sub_total_without_discount() {
                return (this.value.jumlah_obat || 0) * (this.value.harga_satuan_obat || 0)
            },

            sub_total() {
                return this.sub_total_without_discount * ((100 - this.value.diskon_grosir) / 100)
            }
        },
    }
</script>
