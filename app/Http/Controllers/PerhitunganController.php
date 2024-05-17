<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\BobotKriteria;
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

        $alternatif = Alternatif::with('hero')->where('id_users', Auth::id())->get();

        $goldLane = $alternatif->filter(function ($item) {
            return $item->hero->laning == 'Gold Lane';
        })->count();

        $roam = $alternatif->filter(function ($item) {
            return $item->hero->laning == 'Roam';
        })->count();

        $jungler = $alternatif->filter(function ($item) {
            return $item->hero->laning == 'Jungle';
        })->count();

        $midLane = $alternatif->filter(function ($item) {
            return $item->hero->laning == 'Mid Lane';
        })->count();

        $expLane = $alternatif->filter(function ($item) {
            return $item->hero->laning == 'EXP Lane';
        })->count();

        if ($goldLane < 5 || $roam < 5 || $jungler < 5 || $midLane < 5 || $expLane < 5) {
            return redirect()->route('admin.alternatif')->withErrors(['Lengkapi Data Alternatif dahulu. Setiap laning minimal 5 Hero.']);
        }

        if ($request->ajax()) {
            $rowData = [];

            foreach ($alternatif as $row) {
                $hero = $row->hero;
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
                    'DT_RowIndex' => $row->id_alternatif,
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

        return view('pages.perhitungan.index', ['kriteria' => $kriteria, 'detailKriteria' => $subkriteria]);
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

            $alternatif = Alternatif::with('hero')->where('id_users', Auth::id())->get();

            $goldLane = $alternatif->filter(function ($item) {
                return $item->hero->laning == 'Gold Lane';
            })->count();

            $roam = $alternatif->filter(function ($item) {
                return $item->hero->laning == 'Roam';
            })->count();

            $jungler = $alternatif->filter(function ($item) {
                return $item->hero->laning == 'Jungle';
            })->count();

            $midLane = $alternatif->filter(function ($item) {
                return $item->hero->laning == 'Mid Lane';
            })->count();

            $expLane = $alternatif->filter(function ($item) {
                return $item->hero->laning == 'EXP Lane';
            })->count();

            if ($goldLane < 5 || $roam < 5 || $jungler < 5 || $midLane < 5 || $expLane < 5) {
                throw new \Exception('Setiap laning minimal 5 Hero.');
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
    public function normalisasi()
    {
        $alternatif = Alternatif::with('hero.detail_hero')->where('id_users', Auth::id())->get();
        $heroes = $alternatif->pluck('hero');
        $kriteria = Kriteria::all();
        $weights = $kriteria->pluck('bobot')->toArray();

        $matrix = [];
        foreach ($heroes as $hero) {
            $row = [];
            foreach ($kriteria as $krit) {
                $detailHero = $hero->detail_hero()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = Subkriteria::where('id_subkriteria', $detailHero->id_subkriteria)->first();
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }

        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $rowData = [];

        foreach ($heroes as $index => $hero) {
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

    public function pembobotan()
    {
        $alternatif = Alternatif::with('hero.detail_hero')->where('id_users', Auth::id())->get();
        $heroes = $alternatif->pluck('hero')->unique('id_hero');

        $analisa = Analisa::where('id_users', Auth::id())->first();
        if (!$analisa) {
            return back()->withErrors(['error' => 'Analisa tidak ditemukan.']);
        }

        $gameplay = $analisa->id_gameplay;
        $kriteria = Kriteria::all();
        $bobotKriteria = BobotKriteria::where('id_gameplay', $gameplay)->get();
        $weights = $bobotKriteria->pluck('bobot')->toArray();

        $matrix = [];
        foreach ($heroes as $hero) {
            $row = [];
            foreach ($kriteria as $krit) {
                $detailHero = $hero->detail_hero()->where('id_kriteria', $krit->id_kriteria)->first();
                $subkriteria = Subkriteria::where('id_subkriteria', $detailHero->id_subkriteria)->first();
                $row[] = $subkriteria ? $subkriteria->nilai : 0;
            }
            $matrix[] = $row;
        }

        $normalisasiMatrix = $this->normalisasiMatrix($matrix);
        $weightedMatrix = $this->pembobotanNormalisasiMatrix($normalisasiMatrix, $weights);
        $rowData = [];

        foreach ($heroes as $index => $hero) {
            $subkriteriaData = [];
            foreach ($kriteria as $kIndex => $krit) {
                $subkriteriaData[$krit->nama] = $weightedMatrix[$index][$kIndex];
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
}
