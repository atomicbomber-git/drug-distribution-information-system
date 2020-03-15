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
        return view("obat.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "nama" => "required|string|unique:obat",
            "deskripsi" => "required|string",
        ]);

        Obat::create($data);

        return redirect()
            ->route("obat.index")
            ->with("messages", [
               [
                   "state" => MessageState::STATE_SUCCESS,
                   "content" => __("messages.create.success"),
               ]
            ]);
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
        return response()
            ->view("obat.edit", compact("obat"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function update(Request $request, Obat $obat)
    {
        $data = $request->validate([
            "nama" => "required|string|unique:obat,nama,$obat->id",
            "deskripsi" => "required|string",
        ]);

        $obat->update($data);

        return redirect()
            ->route("obat.edit", $obat)
            ->with("messages", [
                [
                    "state" => MessageState::STATE_SUCCESS,
                    "content" => __("messages.update.success")
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function destroy(Obat $obat, Redirector $redirector)
    {
        $messages = collect();
        try {
            $obat->forceDelete();
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

        return $redirector
            ->route("obat.index")
            ->with("messages", $messages);
    }
}
