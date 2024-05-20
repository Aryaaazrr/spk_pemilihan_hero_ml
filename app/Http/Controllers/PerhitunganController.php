<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\BobotKriteria;
use App\Models\GameplayType;
use App\Models\Hero;
use App\Models\Kriteria;
use App\Models\RiwayatAnalisa;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        $gameplay = GameplayType::all();

        $cekAlternatif = Alternatif::where('id_users', Auth::id())->get();

        $goldLane = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Gold Lane';
        })->count();

        $roam = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Roam';
        })->count();

        $jungler = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Jungle';
        })->count();

        $midLane = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'Mid Lane';
        })->count();

        $expLane = $cekAlternatif->filter(function ($item) {
            return $item->laning == 'EXP Lane';
        })->count();

        if ($goldLane < 5 || $roam < 5 || $jungler < 5 || $midLane < 5 || $expLane < 5) {
            return redirect()->route('admin.alternatif')->withErrors(['Lengkapi Data Alternatif dahulu. Setiap laning minimal 5 Hero.']);
        }

        $laning = $request->get('laning');
        $alternatif = Alternatif::with('detail_alternatif')
            ->where('laning', $laning)
            ->where('id_users', Auth::id())
            ->get();

        $alternatif_gold_lane = Alternatif::with('detail_alternatif')
            ->where('laning', 'Gold Lane')
            ->where('id_users', Auth::id())
            ->get();

        if ($request->ajax()) {
            $rowData = [];

            foreach ($alternatif as $row) {
                $detailAlternatif = $row->detail_alternatif;
                $subkriteriaData = [];

                foreach ($detailAlternatif as $detail) {
                    $kriteria = Kriteria::find($detail->id_kriteria);
                    $subkriteria = Subkriteria::find($detail->id_subkriteria);

                    if ($kriteria && $subkriteria) {
                        $subkriteriaData[$kriteria->nama] = $subkriteria->nilai;
                    }
                }

                $rowData[] = [
                    'DT_RowIndex' => $row->id_alternatif,
                    'id_alternatif' => $row->id_alternatif,
                    'foto' => $row->foto,
                    'nama' => $row->nama,
                    'role' => $row->role,
                    'laning' => $row->laning,
                    'subkriteria' => $subkriteriaData,
                ];
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.perhitungan.index', ['kriteria' => $kriteria, 'detailKriteria' => $subkriteria, 'gameplay' => $gameplay, 'alternatif_gold_lane' => $alternatif_gold_lane]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gameplay' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $bobot = BobotKriteria::count();

            if (!$bobot) {
                throw new \Exception('Bobot kriteria masih kosong. Silahkan isi terlebih dahulu.');
            }

            DB::beginTransaction();

            $analisa = new Analisa();
            $analisa->id_users = Auth::id();
            $analisa->id_gameplay = $request->gameplay;

            if (!$analisa->save()) {
                throw new \Exception('Gagal menyimpan data analisa. Silahkan coba kembali.');
            }

            $alternatif = Alternatif::where('id_users', Auth::id())->get();

            $goldLane = $alternatif->filter(function ($item) {
                return $item->laning == 'Gold Lane';
            })->count();

            $roam = $alternatif->filter(function ($item) {
                return $item->laning == 'Roam';
            })->count();

            $jungler = $alternatif->filter(function ($item) {
                return $item->laning == 'Jungle';
            })->count();

            $midLane = $alternatif->filter(function ($item) {
                return $item->laning == 'Mid Lane';
            })->count();

            $expLane = $alternatif->filter(function ($item) {
                return $item->laning == 'EXP Lane';
            })->count();

            if ($goldLane < 5 || $roam < 5 || $jungler < 5 || $midLane < 5 || $expLane < 5) {
                throw new \Exception('Setiap laning minimal 5 Data Alternatif.');
            }

            foreach ($alternatif as $value) {
                $riwayatAnalisa = new RiwayatAnalisa();
                $riwayatAnalisa->id_analisa = $analisa->id_analisa;
                $riwayatAnalisa->id_alternatif = $value->id_alternatif;

                if (!$riwayatAnalisa->save()) {
                    throw new \Exception('Gagal menyimpan riwayat analisa.');
                }
            }

            DB::commit();

            return redirect()->route('admin.perhitungan')->with('success', 'Data Hasil Perhitungan berhasil.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function normalisasi(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = Alternatif::with('detail_alternatif')
            ->where('laning', $laning)
            ->where('id_users', Auth::id())
            ->get();

        $kriteria = Kriteria::all();

        $matrix = [];
        foreach ($alternatif as $alt) {
            $row = [];
            foreach ($kriteria as $krit) {
                $detailAlternatif = $alt->detail_alternatif()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = Subkriteria::where('id_subkriteria', $detailAlternatif->id_subkriteria)->first();
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }

        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $rowData = [];

        foreach ($alternatif as $index => $hero) {
            $subkriteriaData = [];
            foreach ($kriteria as $kIndex => $krit) {
                $subkriteriaData[$krit->nama] = $normalisasiMatrix[$index][$kIndex];
            }
            $rowData[] = [
                'DT_RowIndex' => $index + 1,
                'id_hero' => $hero->id_hero,
                'foto' => $hero->foto,
                'nama' => $hero->nama,
                'role' => $hero->role,
                'laning' => $hero->laning,
                'subkriteria' => $subkriteriaData,
            ];
        }

        return DataTables::of($rowData)->toJson();
    }


    public function pembobotan(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = Alternatif::with('detail_alternatif')
            ->where('laning', $laning)
            ->where('id_users', Auth::id())
            ->get();

        $analisa = Analisa::where('id_users', Auth::id())->first();
        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $gameplay = $analisa->id_gameplay;
        $kriteria = Kriteria::all();
        $bobotKriteria = BobotKriteria::where('id_gameplay', $gameplay)->get();
        $weights = $bobotKriteria->pluck('bobot')->toArray();

        $matrix = [];
        foreach ($alternatif as $alt) {
            $row = [];
            foreach ($kriteria as $krit) {
                $detailAlternatif = $alt->detail_alternatif()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = Subkriteria::where('id_subkriteria', $detailAlternatif->id_subkriteria)->first();
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }

        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);
        $rowData = [];

        foreach ($alternatif as $index => $value) {
            $subkriteriaData = [];
            foreach ($kriteria as $kIndex => $krit) {
                $subkriteriaData[$krit->nama] = $weightedMatrix[$index][$kIndex];
            }
            $rowData[] = [
                'DT_RowIndex' => $index + 1,
                'id_alternatif' => $value->id_alternatif,
                'foto' => $value->foto,
                'nama' => $value->nama,
                'role' => $value->role,
                'laning' => $value->laning,
                'subkriteria' => $subkriteriaData,
            ];
        }

        return DataTables::of($rowData)->toJson();
    }


    public function concordance(Request $request)
    {
        $laning = $request->get('laning');
        $alternatif = Alternatif::with('detail_alternatif')
            ->where('laning', $laning)
            ->where('id_users', Auth::id())
            ->get();

        if ($alternatif->isEmpty()) {
            return response()->json([]);
        }

        $analisa = Analisa::where('id_users', Auth::id())->first();

        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $gameplay = $analisa->id_gameplay;
        $kriteria = Kriteria::all();
        $bobotKriteria = BobotKriteria::where('id_gameplay', $gameplay)->get();
        $weights = $bobotKriteria->pluck('bobot')->toArray();

        $matrix = [];
        foreach ($alternatif as $alt) {
            $row = [];
            foreach ($kriteria as $krit) {
                $detailAlternatif = $alt->detail_alternatif()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = Subkriteria::where('id_subkriteria', $detailAlternatif->id_subkriteria)->first();
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }

        $normalisasiMatrix = $this->normalisasiMatrix($matrix);

        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);

        $concordanceMatrix = $this->generateConcordanceSubset($weightedMatrix);

        $rowData = [];
        foreach ($alternatif as $alt) {
            $rowData = [
                'DT_RowIndex' => $alt->id_alternatif,
                'nama_hero' => $alt->nama,
                'true_kriteria' => [],
            ];

            foreach ($kriteria as $krit) {
                $kriteriaIndex = $krit->id_kriteria - 1;
                $trueKriteria = [];
                foreach ($concordanceMatrix as $pair => $concordance) {
                    list($a, $b) = explode('-', $pair);
                    if ($a == $alt->id_alternatif) {
                        $trueKriteria = [];
                        foreach ($concordance as $kriteriaIndex => $isTrue) {
                            if (isset($concordance[$kriteriaIndex]) && $concordance[$kriteriaIndex]) {
                                $trueKriteria[] = $kriteria[$kriteriaIndex]->nama;
                            }
                        }
                        $rowData['true_kriteria'] = $trueKriteria;
                    }
                }
            }
            $tableData[] = $rowData;
        }
        return DataTables::of($tableData)->toJson();
    }

    private function normalisasiMatrix($matrix)
    {
        $normalisasiMatrix = [];
        foreach ($matrix[0] as $j => $value) {
            $kuadrat = 0;
            foreach ($matrix as $i => $row) {
                $kuadrat += pow($row[$j], 2);
            }
            foreach ($matrix as $i => $row) {
                $normalisasiMatrix[$i][$j] = $row[$j] / sqrt($kuadrat);
            }
        }
        return $normalisasiMatrix;
    }

    private function pembobotanNormalisasiMatrix($normalizedMatrix, $weights)
    {
        $weightedMatrix = [];
        foreach ($normalizedMatrix as $i => $row) {
            $weightedMatrix[$i] = [];
            foreach ($row as $j => $value) {
                $weightedMatrix[$i][$j] = $value * $weights[$j];
            }
        }
        return $weightedMatrix;
    }

    private function generateConcordanceSubset($weightedMatrix)
    {
        $concordanceSubset = [];
        $n = count($weightedMatrix);
        $kriteria = Kriteria::all();

        for ($k = 0; $k < $n; $k++) {
            for ($l = 0; $l < $n; $l++) {
                if ($k != $l) {
                    $concordance = [];

                    foreach ($kriteria as $krit) {
                        if ($weightedMatrix[$k][$krit->id_kriteria - 1] >= $weightedMatrix[$l][$krit->id_kriteria - 1]) {
                            $concordance[] = $krit->nama;
                        }
                    }
                    $concordanceSubset["$k-$l"] = $concordance;
                }
            }
        }
        return $concordanceSubset;
    }


    private function indexConcordanceSubset($concordanceSubset)
    {
        $indexedConcordanceSubset = [];
        foreach ($concordanceSubset as $key => $subset) {
            foreach ($subset as $index) {
                $indexedConcordanceSubset[$index][] = $key;
            }
        }
        return $indexedConcordanceSubset;
    }

    private function indexDiscordanceSubset($discordanceSubset)
    {
        $indexedDiscordanceSubset = [];
        foreach ($discordanceSubset as $key => $subset) {
            foreach ($subset as $index) {
                $indexedDiscordanceSubset[$index][] = $key;
            }
        }
        return $indexedDiscordanceSubset;
    }
}