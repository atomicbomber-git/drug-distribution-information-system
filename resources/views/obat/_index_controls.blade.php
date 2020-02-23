<div class="uk-flex uk-flex-center">
    <a href="{{ route("obat.edit", $obat) }}"
       class="uk-button uk-button-default uk-button-small uk-margin-small-right">
        Ubah
    </a>

    <form class="uk-display-inline-block"
          action="{{ route("obat.destroy", $obat) }}"
          method="post">
        @csrf
        @method("DELETE")

        <button class="uk-button uk-button-danger uk-button-small"
                type="submit">
            Hapus
        </button>
    </form>
</div>
