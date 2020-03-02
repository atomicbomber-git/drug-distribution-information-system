@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-plus-circle"></i>
        Penerimaan Baru
    </h1>

    @include('layouts._messages')

    <div id="app">
        <penerimaan-create
            submit_url='{{ route('penerimaan.store') }}'
            redirect_url='{{ route('penerimaan.index') }}'
            :obats='{{ json_encode($obats) }}'
        ></penerimaan-create>
    </div>
@endsection
