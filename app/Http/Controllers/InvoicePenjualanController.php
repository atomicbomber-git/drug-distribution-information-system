<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\GlobalHelpers\Formatter;
use App\InvoicePenjualan;
use App\ItemInvoicePenjualan;
use App\Obat;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvoicePenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(InvoicePenjualan::query())
                ->addIndexColumn()
                ->editColumn("waktu_penerimaan", fn($invoice_penjualan) => Formatter::fancyDatetime($invoice_penjualan->waktu_penerimaan))
                ->addColumn("controls", fn($invoice_penjualan) => view("invoice_penjualan._index_controls", compact("invoice_penjualan")))
                ->toJson();
        }

        return response()->view("invoice_penjualan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obats = Obat::query()
            ->select(
                "obat.id",
                "nama",
                "total_jumlah"
            )
            ->leftJoinSub(
                Stock::query()
                    ->select(
                        "obat_id",
                        DB::raw("SUM(jumlah) AS total_jumlah")
                    )
                    ->groupBy("obat_id")
                , "stock_sum",
                "obat.id", "=", "stock_sum.obat_id"
            )
            ->orderBy("nama")
            ->get();

        return response()->view("invoice_penjualan.create", compact(
            "obats"
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "nama_customer" => "required|string",
            "waktu_penjualan" => "required|date_format:Y-m-d H:i:s",
            "item_penjualans" => "required|array",
            "item_penjualans.*.id" => "required|exists:obat",
            "item_penjualans.*.jumlah_obat" => "required|gt:0",
            "item_penjualans.*.harga_satuan_obat" => "required|gte:0",
            "item_penjualans.*.diskon_grosir" => "required|gte:1|lte:15",
        ]);

        DB::beginTransaction();

        $invoice_penjualan = InvoicePenjualan::query()->create([
            "nama_customer" => $data["nama_customer"],
            "waktu_penjualan" => $data["waktu_penjualan"],
            "persentase_pajak" => 0.1,
            "persentase_diskon_cash" => 0.03,
        ]);

        foreach ($data["item_penjualans"] as $data_item_penjualan) {
            ItemInvoicePenjualan::query()->create([
                "invoice_id" => $invoice_penjualan,
                "obat_id" => $data["obat_id"],
                "jumlah_obat" => $data["jumlah_obat"],
                "harga_satuan_obat" => $data["harga_satuan_obat"],
                "persentase_diskon_grosir" => $data["diskon_grosir"] / 100,
            ]);
        }

        DB::commit();

        return response($data, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\InvoicePenjualan $invoice_penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(InvoicePenjualan $invoice_penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\InvoicePenjualan $invoice_penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoicePenjualan $invoice_penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\InvoicePenjualan $invoice_penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoicePenjualan $invoice_penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoicePenjualan $invoice_penjualan
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(InvoicePenjualan $invoice_penjualan)
    {
        $messages = collect();
        try {
            $invoice_penjualan->forceDelete();
            $messages->add([
                "state" => MessageState::STATE_SUCCESS,
                "content" => __("messages.delete.success")
            ]);
        } catch (\Throwable $exception) {
            $messages->add([
                "state" => MessageState::STATE_DANGER,
                "content" => __("messages.delete.failure")
            ]);
        }

        return redirect()
            ->route("invoice_penjualan.index", $invoice_penjualan)
            ->with("messages", $messages);
    }
}
