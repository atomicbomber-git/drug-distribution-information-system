<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\GlobalHelpers\Formatter;
use App\InvoicePenjualan;
use App\Obat;
use Illuminate\Http\Request;
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
                ->addColumn("controls", fn($invoice_penjualan) => view("invoice_penjualan._index_controls", compact("invoice_penjualan"))
                )
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
        //
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
        }
        catch (\Throwable $exception) {
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
