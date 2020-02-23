<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Obat;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|JsonResponse|Response|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                Obat::query()
            )->addColumn(
                "controls", fn ($obat) => view("obat._index_controls", compact("obat"))
            )->toJson();
        }

        return view("obat.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Obat $obat
     * @return Response
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Obat $obat
     * @return Response
     */
    public function edit(Obat $obat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Obat $obat
     * @return Response
     */
    public function update(Request $request, Obat $obat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function destroy(Obat $obat, Redirector $redirector)
    {
        $obat->forceDelete();

        return $redirector
            ->route("obat.index")
            ->with("messages", [
                [
                    "state" => MessageState::STATE_SUCCESS,
                    "content" => __("messages.delete.success")
                ]
            ]);
    }
}
