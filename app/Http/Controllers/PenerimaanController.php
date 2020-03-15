<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\GlobalHelpers\Formatter;
use App\ItemPenerimaan;
use App\Obat;
use App\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                    fn($penerimaan) => Formatter::fancyDate($penerimaan->waktu_penerimaan)
                )
                ->addColumn("controls",
                    fn($penerimaan) => view(
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "nama_supplier" => "required|string",
            "waktu_penerimaan" => "required|date_format:Y-m-d H:i:s",
            "item_penerimaans" => "required|array",
            "item_penerimaans.*.id" => "required|exists:obat",
            "item_penerimaans.*.jumlah_obat" => "required|numeric|gt:0",
            "item_penerimaans.*.harga_satuan_obat" => "required|numeric|gte:0",
        ]);

        DB::beginTransaction();

        $penerimaan = Penerimaan::query()
            ->create([
                "nama_supplier" => $data["nama_supplier"],
                "waktu_penerimaan" => $data["waktu_penerimaan"],
            ]);

        foreach ($data["item_penerimaans"] ?? [] as $item_penerimaan) {
            ItemPenerimaan::query()
                ->create([
                    "penerimaan_id" => $penerimaan->id,
                    "obat_id" => $item_penerimaan["id"],
                    "jumlah" => $item_penerimaan["jumlah_obat"],
                    "harga_satuan" => $item_penerimaan["harga_satuan_obat"],
                ]);
        }

        DB::commit();

        session()->flash('messages', [
            [
                "state" => MessageState::STATE_SUCCESS,
                "content" => __("messages.create.success"),
            ]
        ]);

        return response([
            "message" => "success",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function show(Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Penerimaan $penerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Penerimaan $penerimaan
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
