import numeral from 'numeral'

export function currencyFormat (value) {
    return numeral(value).format("0,0.00")

}
