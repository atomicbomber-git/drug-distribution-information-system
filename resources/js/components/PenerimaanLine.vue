<template>
    <tr>
        <td> {{ index + 1 }}</td>
        <td> {{ value.nama }}</td>

        <td>
            <div class="uk-margin">
                <input
                    id="tanggal_kadaluarsa"
                    v-model="value.tanggal_kadaluarsa"
                    placeholder="Tanggal Kadaluarsa"
                    class="uk-input"
                    :class="{
                        'uk-form-danger': !!this.get(error_data, [`errors`, `item_penerimaans.${index}.tanggal_kadaluarsa`, 0], false)
                    }"
                    type="date"
                >
                <span class="uk-text-danger uk-text-small">
                    {{ this.get(error_data, [`errors`, `item_penerimaans.${index}.tanggal_kadaluarsa`, 0], '')}}
                </span>
            </div>
        </td>

        <td>
            <vue-cleave
                class="uk-input uk-text-right"
                :class="{ 'uk-form-danger': this.get(error_data, [`errors`, `item_penerimaans.${index}.jumlah_obat`, 0], false) }"
                placeholder="Jumlah Obat"
                v-model.number="value.jumlah_obat"
                :options="{ numeral: true }"
            />

            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, [`errors`, `item_penerimaans.${index}.jumlah_obat`, 0], '')}}
            </span>
        </td>
        <td>
            <vue-cleave
                class="uk-input uk-text-right"
                placeholder="Harga Satuan"
                v-model.number="value.harga_satuan_obat"
                :options="{ numeral: true }"
            />

            <span class="uk-text-danger uk-text-small">
                {{ this.get(error_data, [`errors`, `item_penerimaans.${index}.harga_satuan_obat`, 0], '') }}
            </span>
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

        mounted() {
            this.value.sub_total = this.sub_total
        },

        computed: {
            sub_total() {
                return (this.value.jumlah_obat *
                    this.value.harga_satuan_obat)
            }
        },

        watch: {
            sub_total(new_sub_total) {
                this.value.sub_total = new_sub_total
            },

            value: {
                handler: function () {
                    this.$emit('input', this.value);
                },
                deep: true,
            }
        }
    }
</script>
