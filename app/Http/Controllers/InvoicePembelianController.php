<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\InvoicePembelian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoicePembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                InvoicePembelian::query()
            )
                ->addColumn("controls", fn($invoice_pembelian) =>
                    view("invoice_pembelian._index_controls", compact("invoice_pembelian"))
                )
                ->toJson();
        }

        return response()->view("invoice_pembelian.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view("invoice_pembelian.create");
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
     * @param \App\InvoicePembelian $invoicePembelian
     * @return \Illuminate\Http\Response
     */
    public function show(InvoicePembelian $invoicePembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\InvoicePembelian $invoicePembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoicePembelian $invoicePembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\InvoicePembelian $invoicePembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoicePembelian $invoicePembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoicePembelian $invoice_pembelian
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(InvoicePembelian $invoice_pembelian)
    {
        $invoice_pembelian->forceDelete();

        return redirect()
            ->route("invoice_pembelian.index", $invoice_pembelian)
            ->with("messages", [
                [
                    "state" => MessageState::STATE_SUCCESS,
                    "content" => __("messages.delete.success")
                ]
            ]);
    }
}
