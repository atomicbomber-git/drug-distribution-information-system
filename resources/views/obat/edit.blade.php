@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-plus-circle"></i>
        Ubah Obat
    </h1>

    @include('layouts._messages')

    <form action="{{ route("obat.update", $obat) }}"
          method="POST">
        @method("PUT")
        @csrf

        <div class="uk-margin">
            <label class="uk-form-label"
                   for="nama"> Nama
            </label>
            <div class="uk-form-controls">
                <input
                    id="nama"
                    name="nama"
                    placeholder="Nama"
                    value="{{ old("nama", $obat->nama) }}"
                    type="text"
                    class="uk-input {{ $errors->has("nama") ? "uk-form-danger" : "" }}">

                <?php foreach($errors->get("nama") as $error): ?>
                <span class="uk-text-danger uk-text-small">
                        {{ $error }}
                    </span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="uk-margin">
            <label for="deskripsi"
                   class="uk-form-label"> Deskripsi
            </label>

            <div class="uk-form-controls">
                    <textarea
                        id="deskripsi"
                        rows="4"
                        name="deskripsi"
                        placeholder="Deskripsi"
                        type="text"
                        class="uk-textarea {{ $errors->has("deskripsi") ? "uk-form-danger" : "" }}">{{ old("deskripsi", $obat->deskripsi) }}</textarea>
            </div>

            <?php foreach($errors->get("deskripsi") as $error): ?>
                <span class="uk-text-danger uk-text-small">
                    {{ $error }}
                </span>
            <?php endforeach; ?>
        </div>

        <div class="uk-margin uk-flex uk-flex-right">
            <button class="uk-button uk-button-primary"
                    type="submit">
                Submit
            </button>
        </div>
    </form>

@endsection
