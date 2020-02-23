<div class="uk-flex uk-flex-center">
    <form action="{{ route("obat.destroy", $obat) }}"
          method="post">
        @csrf
        @method("DELETE")

        <button class="uk-button uk-button-danger uk-button-small" type="submit">
            Hapus
        </button>
    </form>
</div>
