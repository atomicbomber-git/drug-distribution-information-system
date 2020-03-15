@extends("layouts.app")

@section("content")
    <ul class="uk-breadcrumb">
        <li><a href="{{ \App\Providers\RouteServiceProvider::HOME }}"> {{ config("app.name") }} </a></li>
        <li><span> Stock Gabungan </span></li>
    </ul>

    <h1 class="uk-text-bolder">
        <i class="fas fa-pills"></i>
        Stock Gabungan
    </h1>

    @include('layouts._messages')

    <table class="datatable uk-width-expand uk-table uk-table-striped">
        <thead>
        <tr>
            <th> No </th>
            <th> Obat </th>
            <th> Total Jumlah </th>
            <th> Total Harga </th>
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
                    { data: "obat_nama" },
                    { data: "total_jumlah", className: "dt-right" },
                    { data: "total_harga", className: "dt-right" },
                    { data: "controls", className: "dt-center" },
                ],
                "order": [[ 1, "asc" ]],
                processing: true,
                serverSide: true,
                ajax: "",
            })
        })
    </script>
@endsection
