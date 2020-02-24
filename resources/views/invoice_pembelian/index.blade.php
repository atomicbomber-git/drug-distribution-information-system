@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-pills"></i>
        Invoice Pembelian
    </h1>

    @include('layouts._messages')

    <div class="uk-flex uk-flex-right uk-margin-medium-bottom">
        <a href="{{ route("invoice_pembelian.create") }}" class="uk-button uk-button-primary">
            Invoice Pembelian
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <table class="datatable uk-width-expand uk-table uk-table-striped">
        <thead>
            <tr>
                <th> No </th>
                <th> Nama Perusahaan </th>
                <th> Tanggal Penerimaan </th>
                <th> Manajemen </th>
            </tr>
        </thead>

        <tbody>
        </tbody>
    </table>
@endsection

@section("footer-script")
    <script>
        $(document).ready(function () {
            $("table.datatable").DataTable({
                columns: [
                    { data: 'DT_RowIndex', orderable: false },
                    { data: "nama_perusahaan" },
                    { data: "tanggal_penerimaan" },
                    { data: "controls" },
                ],
                processing: true,
                serverSide: true,
                ajax: "",
            })
        })
    </script>
@endsection
