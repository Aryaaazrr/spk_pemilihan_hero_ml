<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $subkriteria = Subkriteria::all();

        if ($request->ajax()) {
            $alternatif = Alternatif::with('hero')->first();

            if ($alternatif) {
                $rowData = [];
                $hero = $alternatif->hero;
                $detailHero = $hero->detail_hero;
                $subkriteriaData = [];

                foreach ($detailHero as $detail) {
                    $kriteria = Kriteria::find($detail->id_kriteria);
                    $subkriteria = Subkriteria::find($detail->id_subkriteria);

                    if ($kriteria && $subkriteria) {
                        $subkriteriaData[$kriteria->nama] = $subkriteria->nilai;
                    }
                }

                $rowData[] = [
                    'DT_RowIndex' => $alternatif->id_alternatif,
                    'id_hero' => $hero->id_hero,
                    'foto' => $hero->foto,
                    'nama' => $hero->nama,
                    'role' => $hero->role,
                    'laning' => $hero->laning,
                    'subkriteria' => $subkriteriaData,
                ];

                return DataTables::of($rowData)->toJson();
            } else {
                return response()->json([]);
            }
        }

        return view('pages.perhitungan.index', ['kriteria' => $kriteria, 'detailKriteria' => $subkriteria]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
