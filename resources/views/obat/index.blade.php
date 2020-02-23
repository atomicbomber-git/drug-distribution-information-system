@extends("layouts.app")

@section("content")
    <h1 class="uk-text-bolder">
        <i class="fas fa-pills"></i>
        Obat
    </h1>

    @include('layouts._messages')

    <div class="uk-flex uk-flex-right uk-margin-medium-bottom">
        <a href="{{ route("obat.create") }}" class="uk-button uk-button-primary">
            Obat Baru
            <i class="fas fa-plus-circle"></i>
        </a>
    </div>

    <table class="datatable uk-width-expand uk-table uk-table-striped">
        <thead>
            <tr>
                <th> No </th>
                <th> Nama </th>
                <th> Deskripsi </th>
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
                    { data: "id" },
                    { data: "nama" },
                    { data: "deskripsi" },
                    { data: "controls" },
                ],
                processing: true,
                serverSide: true,
                ajax: "",
            })
        })
    </script>
@endsection
