@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-pills"></i>
        Detail Stock "{{ $obat->nama }}"
    </h1>

    @include('layouts._messages')

    <table class="datatable uk-width-expand uk-table uk-table-striped">
        <thead>
        <tr>
            <th> No </th>
            <th> Jumlah </th>
            <th> Harga Satuan (Rp.) </th>
            <th> Tanggal Kadaluarsa </th>
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
                    { data: "jumlah", className: "dt-right" },
                    { data: "harga_satuan", className: "dt-right" },
                    { data: "tanggal_kadaluarsa", className: "dt-right" },
                ],
                "order": [[ 1, "asc" ]],
                processing: true,
                serverSide: true,
                ajax: "",
            })
        })
    </script>
@endsection
