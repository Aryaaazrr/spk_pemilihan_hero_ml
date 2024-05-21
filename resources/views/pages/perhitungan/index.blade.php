@extends('layout.main')

@section('subtitle', 'Perhitungan')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12 d-flex justify-content-start">
                        <h1 class="m-0">Perhitungan</h1>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-gameplay">
                                <i class="fas fa-book"></i> Strategi
                            </button>
                            <div class="modal fade" id="modal-gameplay">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ganti Strategi</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.kriteria.store') }}" method="POST">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="gameplay">Strategi Permainan</label>
                                                        <select class="form-control select2" style="width: 100%;"
                                                            name="gameplay" id="gameplay">
                                                            <option value="" selected disabled>Pilih Strategi
                                                            </option>
                                                            @foreach ($gameplay as $item)
                                                                <option value="{{ $item->id_gameplay }}">
                                                                    {{ $item->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alternatif content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{-- gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- Roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- Jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Hero</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Normalisasi content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- normalisasi gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiGoldLane" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiMidLane" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiEXPLane" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiRoam" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- normalisasi jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasiJungle" class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Pembobotan content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- pembobotan gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- pembobotan jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotanJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Himpunan Concordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        {{-- concordance gold lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Gold Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance mid lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Mid Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceMidLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance exp lane --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance EXP Lane</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceEXPLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance roam --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Roam</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceRoam" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        {{-- concordance jungle --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance Jungle</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceJungle" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th>Nama Hero</th> --}}
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($alternatif_gold_lane as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}

                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        {{-- @foreach ($tableData as $data)
                                            <tr>
                                                <td>{{ $data['nama_hero'] }}</td>
                                                @foreach ($alternatif_gold_lane as $alternatif)
                                                    <td>
                                                        @foreach ($data['true_kriteria'][$alternatif->nama] as $true_kriteria)
                                                            {{ $true_kriteria }}
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Himpunan Discordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Discordance</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableConcordanceGoldLane" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Alternatif 1</th>
                                            <th>Alternatif 2</th>
                                            <th>Kriteria yang Memenuhi</th>
                                            {{-- @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Concordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Concordance</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableKlasifikasi" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Discordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Discordance</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableKlasifikasi" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Dominan Concordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Concordance</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableKlasifikasi" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Matriks Dominan Discordance content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Matriks Dominan Discordance</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableKlasifikasi" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Aggregate Dominan Matriks content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Aggregate Dominan Matriks</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableKlasifikasi" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Laning</th>
                                            @foreach ($kriteria as $item)
                                                <th>{{ $item->nama }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <script>
            $(document).ready(function() {
                $("#myTableGoldLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan') }}',
                        data: {
                            laning: 'Gold Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableMidLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan') }}',
                        data: {
                            laning: 'Mid Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableEXPLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan') }}',
                        data: {
                            laning: 'EXP Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableRoam").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan') }}',
                        data: {
                            laning: 'Roam'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableJungle").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan') }}',
                        data: {
                            laning: 'Jungle'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableNormalisasiGoldLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.normalisasi') }}',
                        data: {
                            laning: 'Gold Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableNormalisasiMidLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.normalisasi') }}',
                        data: {
                            laning: 'Mid Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableNormalisasiEXPLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.normalisasi') }}',
                        data: {
                            laning: 'EXP Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableNormalisasiRoam").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.normalisasi') }}',
                        data: {
                            laning: 'Roam'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableNormalisasiJungle").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.normalisasi') }}',
                        data: {
                            laning: 'Jungle'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTablePembobotanGoldLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.pembobotan') }}',
                        data: {
                            laning: 'Gold Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTablePembobotanMidLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.pembobotan') }}',
                        data: {
                            laning: 'Mid Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTablePembobotanEXPLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.pembobotan') }}',
                        data: {
                            laning: 'EXP Lane'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTablePembobotanRoam").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.pembobotan') }}',
                        data: {
                            laning: 'Roam'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTablePembobotanJungle").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.pembobotan') }}',
                        data: {
                            laning: 'Jungle'
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data) {
                                return '<img src="{{ asset('storage') }}/' + data +
                                    '" alt="" style="width: 50px; height: 50px;">';
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        {
                            data: 'laning',
                            name: 'laning'
                        },
                        @foreach ($kriteria as $kriteriaItem)
                            {
                                data: 'subkriteria.{{ $kriteriaItem->nama }}',
                                name: '{{ $kriteriaItem->nama }}',
                                render: function(data) {
                                    return data ? data : 'N/A';
                                }
                            },
                        @endforeach
                    ],
                    rowCallback: function(row, data, index) {
                        var dt = this.api();
                        $(row).attr('data-id', data.id);
                        $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                    }
                });

                $("#myTableConcordanceGoldLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.concordance') }}',
                        data: {
                            laning: 'Gold Lane'
                        }
                    },
                    columns: [{
                            data: 'alternatif_1',
                            name: 'alternatif_1'
                        },
                        {
                            data: 'alternatif_2',
                            name: 'alternatif_2'
                        },
                        {
                            data: 'true_kriteria',
                            name: 'true_kriteria'
                        }
                    ]
                });

                $("#myTableConcordanceMidLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.concordance') }}',
                        data: {
                            laning: 'Mid Lane'
                        }
                    },
                    columns: [{
                            data: 'alternatif_1',
                            name: 'alternatif_1'
                        },
                        {
                            data: 'alternatif_2',
                            name: 'alternatif_2'
                        },
                        {
                            data: 'true_kriteria',
                            name: 'true_kriteria'
                        }
                    ]
                });

                $("#myTableConcordanceEXPLane").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.concordance') }}',
                        data: {
                            laning: 'EXP Lane'
                        }
                    },
                    columns: [{
                            data: 'alternatif_1',
                            name: 'alternatif_1'
                        },
                        {
                            data: 'alternatif_2',
                            name: 'alternatif_2'
                        },
                        {
                            data: 'true_kriteria',
                            name: 'true_kriteria'
                        }
                    ]
                });

                $("#myTableConcordanceRoam").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.concordance') }}',
                        data: {
                            laning: 'Roam'
                        }
                    },
                    columns: [{
                            data: 'alternatif_1',
                            name: 'alternatif_1'
                        },
                        {
                            data: 'alternatif_2',
                            name: 'alternatif_2'
                        },
                        {
                            data: 'true_kriteria',
                            name: 'true_kriteria'
                        }
                    ]
                });

                $("#myTableConcordanceJungle").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.perhitungan.concordance') }}',
                        data: {
                            laning: 'Jungle'
                        }
                    },
                    columns: [{
                            data: 'alternatif_1',
                            name: 'alternatif_1'
                        },
                        {
                            data: 'alternatif_2',
                            name: 'alternatif_2'
                        },
                        {
                            data: 'true_kriteria',
                            name: 'true_kriteria'
                        }
                    ]
                });

                $('.datatable-input').on('input', function() {
                    var searchText = $(this).val().toLowerCase();

                    $('.table tr').each(function() {
                        var rowData = $(this).text().toLowerCase();
                        if (rowData.indexOf(searchText) === -1) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                });
            });

            function validateForm() {
                var selects = document.querySelectorAll('#select2');

                for (var i = 0; i < selects.length; i++) {
                    if (!selects[i].value) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Mohon pilih semua kriteria sebelum menyimpan.'
                        });
                        return false;
                    }
                }
                return true;
            }
        </script>
    @endsection
