<template>
    <tr>
        <td> {{ index + 1 }}</td>
        <td> {{ value.nama }}</td>
        <td>
            <vue-cleave
                class="uk-input uk-text-right"
                placeholder="Jumlah Obat"
                v-model.number="value.jumlah_obat"
                :options="{ numeral: true }"
            />
        </td>
        <td>
            <vue-cleave
                class="uk-input uk-text-right"
                placeholder="Harga Satuan"
                v-model.number="value.harga_satuan_obat"
                :options="{ numeral: true }"
            />
        </td>
        <td class="uk-text-right">
            {{ currencyFormat(sub_total) }}
        </td>
    </tr>
</template>
<script>
    import VueCleave from "vue-cleave-component";

    export default {
        name: 'PenerimaanLine',
        components: { VueCleave },
        props: {
            value: {},
            error_data: {},
            index: {}
        },

        computed: {
            sub_total() {
                return (this.value.jumlah_obat *
                    this.value.harga_satuan_obat)
            }
        },

        watch: {
            value: {
                deep: true,
                handler: function () {
                    this.$emit('input', {
                        ...this.value,
                        sub_total: this.sub_total
                    });
                }
            }
        }
    }
</script>
