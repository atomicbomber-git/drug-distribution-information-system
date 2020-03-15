<?php

namespace App\Http\Controllers;

use App\GlobalHelpers\Formatter;
use App\Obat;
use App\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockGabunganShow extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Obat $obat
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, Obat $obat)
    {
        if ($request->ajax()) {
            return DataTables::eloquent($obat->stocks())
                ->editColumn("jumlah", function (Stock $stock) {
                    return Formatter::quantity($stock->harga_satuan);
                })
                ->editColumn("harga_satuan", function (Stock $stock) {
                    return Formatter::currency($stock->harga_satuan);
                })
                ->editColumn("tanggal_kadaluarsa", function (Stock $stock) {
                    return Formatter::fancyDate($stock->tanggal_kadaluarsa);
                })
                ->addIndexColumn()
                ->toJson();
        }

        return response()->view("stock_gabungan.show", compact("obat"));
    }
}
