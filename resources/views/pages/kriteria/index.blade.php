@extends('layout.main')

@section('title', 'Kriteria')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kriteria</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Kriteria</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-gameplay">
                                        <i class="fas fa-plus"></i> Gameplay
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
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#modal-kriteria">
                                        <i class="fas fa-plus"></i>
                                        Kriteria
                                    </button>
                                    <div class="modal fade" id="modal-kriteria">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Kriteria</h4>
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
                                                                <label for="nama_kriteria">Nama Kriteria</label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_kriteria" id="nama_kriteria"
                                                                    placeholder="Nama Kriteria">
                                                            </div>
                                                            @foreach ($gameplay as $item)
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
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipe Gameplay</th>
                                            @foreach ($kriteria as $k)
                                                <th>{{ $k->nama }} ({{ $k->keterangan }})</th>
                                            @endforeach
                                            <th class="w-10">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($gameplay as $g)
                                            <tr>
                                                <td>{{ $g->nama }}</td>
                                                @foreach ($kriteria as $k)
                                                    <td>{{ $bobot[$g->id_gameplay][$k->id_kriteria] ?? 'N/A' }}</td>
                                                @endforeach
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-warning m-1"
                                                                data-toggle="modal"
                                                                data-target="#modal-edit-{{ $g->id_gameplay }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger m-1"
                                                                onclick="confirmDelete({{ $g->id_gameplay }})"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
            @foreach ($gameplay as $type)
                <div class="modal fade" id="modal-edit-{{ $type->id_gameplay }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data Kriteria</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.kriteria.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <input type="hidden" name="id_gameplay"
                                            id="id_gameplay_{{ $type->id_gameplay }}" value="{{ $type->id_gameplay }}">
                                        <div class="form-group">
                                            <label for="nama_{{ $type->id_gameplay }}">Gameplay</label>
                                            <input type="text" class="form-control" name="nama_gameplay"
                                                id="nama_{{ $type->id_gameplay }}" value="{{ $type->nama }}">
                                        </div>
                                        <hr>
                                        <label for="nama_kriteria">Nama Kriteria</label>
                                        @foreach ($kriteria as $item)
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="nama_kriteria[{{ $item->id_kriteria }}]"
                                                    value="{{ $item->nama }}" id="nama_{{ $item->id_kriteria }}">
                                            </div>
                                        @endforeach
                                        <hr>
                                        @foreach ($kriteria as $item)
                                            <label for="keterangan_kriteria">Keterangan {{ $item->nama }}</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="keterangan_kriteria[{{ $item->id_kriteria }}]"
                                                    value="{{ $item->keterangan }}"
                                                    id="keterangan_{{ $item->id_kriteria }}">
                                            </div>
                                        @endforeach
                                        <hr>
                                        @foreach ($kriteria as $item)
                                            <div class="form-group">
                                                <label for="{{ $item->nama }}_bobot">Bobot
                                                    {{ $item->nama }}</label>
                                                <input type="text" class="form-control"
                                                    name="{{ $item->nama }}_bobot" id="{{ $item->nama }}_bobot"
                                                    placeholder="Masukkan Bobot {{ $item->nama }}">
                                            </div>
                                        @endforeach
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
            @endforeach

        </section>
        <!-- /.content -->

    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $("#myTable").DataTable({
                // processing: true,
                // ordering: true,
                // responsive: true,
                // serverSide: true,
                // ajax: "{{ route('admin.kriteria') }}",
                // columns: [{
                //         data: 'DT_RowIndex',
                //         name: 'DT_RowIndex'
                //     },
                //     {
                //         data: 'gameplay',
                //         name: 'gameplay'
                //     },
                //     {
                //         data: 'bobot',
                //         name: 'bobot'
                //     },
                //     {
                //         data: 'keterangan',
                //         name: 'keterangan'
                //     },
                //     {
                //         data: null,
                //         render: function(data) {
                //             return '<div class="row justify-content-center">' +
                //                 '<div class="col-auto">' +
                //                 '<button type="button" class="btn btn-warning m-1" data-toggle="modal"' +
                //                 'data-target="#modal-edit" data-id="' + data
                //                 .id_kriteria + '" data-nama="' + data.nama + '" data-bobot="' +
                //                 data.bobot + '" data-keterangan="' +
                //                 data.keterangan + '">' +
                //                 'Edit' +
                //                 '</button>' +
                //                 '<button type="button" class="btn btn-danger m-1" onclick="confirmDelete(' +
                //                 data.id_kriteria + ')"' +
                //                 'data-id="' + data.id_kriteria +
                //                 '">Hapus</button>' +
                //                 '</div>' +
                //                 '</div>';
                //         }
                //     }
                // ],
                // rowCallback: function(row, data, index) {
                //     var dt = this.api();
                //     $(row).attr('data-id', data.id);
                //     $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                // }
            });
            $('#modal-edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_kriteria = button.data('id');
                var nama = button.data('nama');
                var bobot = button.data('bobot');
                var keterangan = button.data('keterangan');
                var modal = $(this);

                modal.find('.modal-body #id_kriteria').val(id_kriteria);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #bobot').val(bobot);
                modal.find('.modal-body #keterangan').val(keterangan);
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

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/kriteria') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#myTable').DataTable().row($('#myTable').find('tr[data-id="' + id +
                                '"]')).remove().draw();
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data. Silahkan coba lagi',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
