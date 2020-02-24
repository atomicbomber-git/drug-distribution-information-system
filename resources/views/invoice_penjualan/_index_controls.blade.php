<div class="uk-flex uk-flex-center">
    <a href="{{ route("invoice_penjualan.edit", $invoice_penjualan) }}"
       class="uk-button uk-button-default uk-button-small uk-margin-small-right">
        Ubah
    </a>

    <form class="uk-display-inline-block"
          action="{{ route("invoice_penjualan.destroy", $invoice_penjualan) }}"
          method="post">
        @csrf
        @method("DELETE")

        <button class="uk-button uk-button-danger uk-button-small"
                type="submit">
            Hapus
        </button>
    </form>
</div>
