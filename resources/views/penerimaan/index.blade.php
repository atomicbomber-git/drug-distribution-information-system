@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-pills"></i>
        Penerimaan
    </h1>

    @include('layouts._messages')

    <div class="uk-flex uk-flex-right uk-margin-medium-bottom">
        <a href="{{ route("penerimaan.create") }}" class="uk-button uk-button-primary">
            Penerimaan
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <table class="datatable uk-width-expand uk-table uk-table-striped">
        <thead>
            <tr>
                <th> No </th>
                <th> Nama Perusahaan </th>
                <th> Waktu Penerimaan </th>
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
                    { data: "nama_supplier" },
                    { data: "waktu_penerimaan" },
                    { data: "controls" },
                ],
                processing: true,
                serverSide: true,
                ajax: "",
            })
        })
    </script>
@endsection
