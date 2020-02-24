@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-plus-circle"></i>
        Invoice Pembelian Baru
    </h1>

    @include('layouts._messages')

    <div id="app">
        <invoice-pembelian-create
            submit_url='{{ route('invoice_pembelian.store') }}'
            redirect_url='{{ route('invoice_pembelian.index') }}'
            :obats='{{ json_encode($obats) }}'
        ></invoice-pembelian-create>
    </div>
@endsection
