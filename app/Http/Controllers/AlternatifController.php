<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Analisa;
use App\Models\DetailHero;
use App\Models\GameplayType;
use App\Models\Hero;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $detailKriteria = Subkriteria::all();
        $gameplay = GameplayType::all();

        if ($request->ajax()) {
            $alternatif = Alternatif::with('hero')->get();

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
                    'subkriteria' => $subkriteriaData
                ];
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.alternatif.index', ['kriteria' => $kriteria, 'detailKriteria' => $detailKriteria, 'gameplay' => $gameplay]);
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
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp',
            'nama' => 'required|unique:hero',
            'role' => 'required',
            'laning' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $jumlahDataKriteria = Kriteria::count();

            if ($jumlahDataKriteria == 0) {
                throw new \Exception('Data kriteria masih kosong. Silahkan isi terlebih dahulu.');
            }

            DB::beginTransaction();

            $foto_path = null;
            $file_path_foto = 'uploads/foto';

            if ($request->file('foto')) {
                $foto = $request->file('foto');
                $foto_path = $foto->store($file_path_foto, 'public');
            }

            $alternatif = Alternatif::where('id_users', Auth::id())->with('hero')->get();

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

            if ($goldLane >= 10 && $roam >= 10 && $jungler >= 10 && $midLane >= 10 && $expLane >= 10) {
                throw new \Exception('Jumlah hero di setiap lane sudah maksimal.');
            }

            $hero = new Hero();
            $hero->nama = $request->nama;
            $hero->foto = $foto_path;
            $hero->role = $request->role;
            $hero->laning = $request->laning;

            if (!$hero->save()) {
                throw new \Exception('Gagal menyimpan data hero. Silahkan coba kembali.');
            }

            foreach ($request->all() as $key => $value) {
                if (strpos($key, '_kriteria') !== false) {
                    $kriteriaNama = str_replace('_', ' ', preg_replace("/_kriteria$/", "", $key));
                    $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                    if ($kriteria) {
                        $detailHero = new DetailHero();
                        $detailHero->id_hero = $hero->id_hero;
                        $detailHero->id_kriteria = $kriteria->id_kriteria;
                        $detailHero->id_subkriteria = $value;
                        if (!$detailHero->save()) {
                            throw new \Exception('Gagal menyimpan detail hero.');
                        }
                    } else {
                        throw new \Exception('Kriteria tidak ditemukan. Silahkan coba kembali.');
                    }
                }
            }

            $alternatif = new Alternatif();
            $alternatif->id_hero = $hero->id_hero;
            $alternatif->id_users = Auth::id();

            if (!$alternatif->save()) {
                throw new \Exception('Gagal menyimpan data alternatif. Silahkan coba kembali.');
            }

            DB::commit();

            return redirect()->route('admin.alternatif')->with('success', 'Data alternatif berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'nama' => 'required',
            'role' => 'required',
            'laning' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $alternatif = Alternatif::find($request->id_alternatif);

            if ($alternatif == null) {
                throw new \Exception('Data kriteria masih kosong. Silahkan isi terlebih dahulu.');
            }

            DB::beginTransaction();

            $hero = Hero::find($alternatif->id_hero);

            if (!$hero) {
                throw new \Exception('Hero tidak ditemukan. Silahkan coba kembali.');
            }

            $foto_path = $hero->foto;
            $file_path_foto = 'uploads/foto';

            if ($request->hasFile('foto')) {
                if ($foto_path) {
                    Storage::disk('public')->delete($foto_path);
                }

                $foto = $request->file('foto');
                $foto_path = $foto->store($file_path_foto, 'public');
            }

            $hero->nama = $request->nama;
            $hero->foto = $foto_path;
            $hero->role = $request->role;
            $hero->laning = $request->laning;

            if ($hero->save()) {
                DetailHero::where('id_hero', $hero->id_hero)->delete();

                foreach ($request->all() as $key => $value) {
                    if (strpos($key, '_kriteria') !== false) {
                        $kriteriaNama = str_replace('_', ' ', preg_replace("/_kriteria$/", "", $key));
                        $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                        if ($kriteria) {
                            $detailHero = new DetailHero();
                            $detailHero->id_hero = $hero->id_hero;
                            $detailHero->id_kriteria = $kriteria->id_kriteria;
                            $detailHero->id_subkriteria = $value;
                            if (!$detailHero->save()) {
                                throw new \Exception('Gagal menyimpan detail hero.');
                            }
                        } else {
                            throw new \Exception('Kriteria tidak ditemukan. Silahkan coba kembali.');
                        }
                    }
                }
            } else {
                throw new \Exception('Gagal menyimpan data hero. Silahkan coba kembali.');
            }

            DB::commit();

            return redirect()->route('admin.alternatif')->with('success', 'Data alternatif berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $alternatif = Alternatif::find($id);
            $hero = Hero::where('id_hero', $alternatif->id_hero)->first();
            $hero->delete();
            return response()->json(['message' => 'Data training berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}