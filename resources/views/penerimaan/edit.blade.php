@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-pencil"></i>
        Ubah Penerimaan
    </h1>

    @include('layouts._messages')

    <div id="app">
        <penerimaan-edit
            submit_url="{{ route('penerimaan.store') }}"
            redirect_url="{{ route('penerimaan.index') }}"
            :obats='{{ json_encode($obats) }}'
            :penerimaan='{{ json_encode($penerimaan) }}'
        ></penerimaan-edit>
    </div>
@endsection
