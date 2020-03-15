<?php

namespace App\Http\Controllers;

use App\GlobalHelpers\Formatter;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StockGabunganIndex extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::query($this->getStocksQuery())
                ->addIndexColumn()
                ->editColumn("total_harga", function ($stock_gabungan) {
                    return Formatter::currency($stock_gabungan->total_harga);
                })
                ->editColumn("total_jumlah", function ($stock_gabungan) {
                    return Formatter::currency($stock_gabungan->total_jumlah);
                })
                ->addColumn("controls", function ($stock_gabungan) {
                    return view("stock_gabungan._index_controls", compact(
                        "stock_gabungan"
                    ));
                })
                ->toJson();
        }

        return response()->view("stock_gabungan/index");
    }

    public function getStocksQuery(): Builder
    {
        return DB::table("stock")
            ->select(
                "obat.id AS obat_id",
                "obat.nama AS obat_nama",
                DB::raw("SUM(jumlah) AS total_jumlah"),
                DB::raw("SUM(jumlah * harga_satuan) AS total_harga"),
                )
            ->leftJoin("obat", "obat.id", "=", "stock.obat_id")
            ->groupBy("obat.id");
    }
}
