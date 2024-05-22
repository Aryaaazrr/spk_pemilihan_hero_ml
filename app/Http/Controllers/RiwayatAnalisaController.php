<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\GameplayType;
use App\Models\RiwayatAnalisa;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatAnalisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function export()
    {
        $data = Analisa::where('id_users', Auth::id())->where('status', '0')->with('riwayat_analisa.alternatif')->first();

        if (!$data) {
            return back()->withErrors(['error' => 'Data analisa tidak ditemukan. Silahkan coba kembali.']);
        }

        $gameplay = GameplayType::where('id_gameplay', $data->id_analisa)->first();
        $cekAlternatifGoldLane = Alternatif::where('id_users', Auth::id())->where('laning', 'Gold Lane')->get();
        $cekAlternatifMidLane = Alternatif::where('id_users', Auth::id())->where('laning', 'Mid Lane')->get();
        $cekAlternatifEXPLane = Alternatif::where('id_users', Auth::id())->where('laning', 'EXP Lane')->get();
        $cekAlternatifRoam = Alternatif::where('id_users', Auth::id())->where('laning', 'Roam')->get();
        $cekAlternatifJungle = Alternatif::where('id_users', Auth::id())->where('laning', 'Jungle')->get();
        $riwayat = RiwayatAnalisa::with(['alternatif', 'analisa'])
            ->where('id_analisa', $data->id_analisa)
            ->get();

        $rowDataGoldLane = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifGoldLane->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataGoldLane[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $alternatif->foto,
                    'nama' => $alternatif->nama,
                    'role' => $alternatif->role,
                    'laning' => $alternatif->laning,
                    'nilai' => $row->nilai,
                    'rangking' => $row->rangking,
                ];
            }
        }
        $rowDataMidLane = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifMidLane->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataMidLane[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $alternatif->foto,
                    'nama' => $alternatif->nama,
                    'role' => $alternatif->role,
                    'laning' => $alternatif->laning,
                    'nilai' => $row->nilai,
                    'rangking' => $row->rangking,
                ];
            }
        }
        $rowDataEXPLane = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifEXPLane->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataEXPLane[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $alternatif->foto,
                    'nama' => $alternatif->nama,
                    'role' => $alternatif->role,
                    'laning' => $alternatif->laning,
                    'nilai' => $row->nilai,
                    'rangking' => $row->rangking,
                ];
            }
        }
        $rowDataRoam = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifRoam->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataRoam[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $alternatif->foto,
                    'nama' => $alternatif->nama,
                    'role' => $alternatif->role,
                    'laning' => $alternatif->laning,
                    'nilai' => $row->nilai,
                    'rangking' => $row->rangking,
                ];
            }
        }
        $rowDataJungle = [];
        foreach ($riwayat as $row) {
            $alternatif = $cekAlternatifJungle->where('id_alternatif', $row->id_alternatif)->first();
            if ($alternatif) {
                $rowDataJungle[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $alternatif->foto,
                    'nama' => $alternatif->nama,
                    'role' => $alternatif->role,
                    'laning' => $alternatif->laning,
                    'nilai' => $row->nilai,
                    'rangking' => $row->rangking,
                ];
            }
        }

        $data->status = '1';

        if ($data->save()) {
            $html = view('pages.export.hasil', ['rowDataGoldLane' => $rowDataGoldLane, 'rowDataMidLane' => $rowDataMidLane, 'rowDataEXPLane' => $rowDataEXPLane, 'rowDataRoam' => $rowDataRoam, 'rowDataJungle' => $rowDataJungle, 'gameplay' => $gameplay])->render();

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            $dompdf->stream('Hasil_Analisa_Metode_Electre_Strategi_' . $gameplay->nama . '.pdf');
        } else {
            return back()->withErrors(['error' => 'Gagal memperbarui status analisa.']);
        }
    }
}
