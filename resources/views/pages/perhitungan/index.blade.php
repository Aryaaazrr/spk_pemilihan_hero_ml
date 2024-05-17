@extends('layout.main')

@section('subtitle', 'Perhitungan')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Perhitungan</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alternatif content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-gameplay">
                                        <i class="fas fa-book"></i> Strategi
                                    </button>
                                    <div class="modal fade" id="modal-gameplay">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Gameplay</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.kriteria.store') }}" method="POST">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="nama_gameplay">Nama Gameplay</label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_gameplay" id="nama_gameplay"
                                                                    placeholder="Nama gameplay">
                                                            </div>
                                                            @foreach ($kriteria as $item)
                                                                <div class="form-group">
                                                                    <label for="{{ $item->nama }}_bobot">Bobot
                                                                        {{ $item->nama }}</label>
                                                                    <input type="text" class="form-control"
                                                                        name="{{ $item->nama }}_bobot"
                                                                        id="{{ $item->nama }}_bobot"
                                                                        placeholder="Masukkan Bobot {{ $item->nama }}">
                                                                </div>
                                                            @endforeach
                                                            <div class="form-group">
                                                                <label for="keterangan_kriteria">Keterangan Kriteria</label>
                                                                <input type="text" class="form-control"
                                                                    name="keterangan_kriteria" id="keterangan_kriteria"
                                                                    placeholder="Keterangan Kriteria">
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
                            <div class="card-body">
                                <table id="myTableAlternatif" class="table table-bordered table-hover">
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

        <!-- Normalisasi content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Normalisasi</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableNormalisasi" class="table table-bordered table-hover">
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pembobotan</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTablePembobotan" class="table table-bordered table-hover">
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Himpunan Concordance</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTableEncludean" class="table table-bordered table-hover">
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
                $("#myTableAlternatif").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ route('admin.perhitungan') }}",
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

                $("#myTableNormalisasi").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ route('admin.perhitungan.normalisasi') }}",
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

                $("#myTablePembobotan").DataTable({
                    processing: true,
                    ordering: true,
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ route('admin.perhitungan.pembobotan') }}",
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
