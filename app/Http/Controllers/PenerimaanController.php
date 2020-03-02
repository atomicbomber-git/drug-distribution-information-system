<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\GlobalHelpers\Formatter;
use App\Obat;
use App\Penerimaan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                Penerimaan::query()
                    ->select([
                        "id",
                        "nama_supplier",
                        "waktu_penerimaan",
                    ])
                )
                ->addIndexColumn()
                ->editColumn(
                    "waktu_penerimaan",
                    fn ($penerimaan) => Formatter::fancyDate($penerimaan->waktu_penerimaan)
                )
                ->addColumn("controls",
                    fn ($penerimaan) => view(
                        "penerimaan._index_controls",
                        compact("penerimaan")
                    )
                )
                ->toJson();
        }

        return view("penerimaan.index");
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

        return response()->view(
            "penerimaan.create", compact("obats")
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function show(Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penerimaan  $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penerimaan  $penerimaan
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Penerimaan $penerimaan)
    {
        $penerimaan->forceDelete();

        return redirect()
            ->route("penerimaan.index", $penerimaan)
            ->with("messages", [
                [
                    "state" => MessageState::STATE_SUCCESS,
                    "content" => __("messages.delete.success")
                ]
            ]);
    }
}
