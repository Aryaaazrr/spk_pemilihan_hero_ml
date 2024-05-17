@extends('layout.main')

@section('title', 'Alternatif')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1 class="m-0">Alternatif</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Alternatif</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-perhitungan">
                                        <i class="fas fa-chart-line"></i>
                                        Cek Hasil Perhitungan
                                    </button>
                                    <div class="modal fade" id="modal-perhitungan">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Cek Hasil Perhitungan</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.perhitungan.store') }}" method="POST">
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-default">
                                        <i class="fas fa-plus"></i> Tambah
                                    </button>
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Alternatif</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.alternatif.store') }}" method="POST"
                                                        onsubmit="return validateForm()" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputFile">Foto Hero</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input"
                                                                            id="exampleInputFile" name="foto"
                                                                            accept="image/*">
                                                                        <label class="custom-file-label"
                                                                            for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Upload</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama">Nama Hero</label>
                                                                <input type="text" class="form-control" name="nama"
                                                                    id="nama" placeholder="Nama">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Role Hero</label>
                                                                <select class="form-control select2" id="role"
                                                                    name="role" style="width: 100%;" required>
                                                                    <option disabled selected>Pilih Role Hero</option>
                                                                    <option value="Tank">Tank</option>
                                                                    <option value="Fighter">Fighter</option>
                                                                    <option value="Assassin">Assassin</option>
                                                                    <option value="Mage">Mage</option>
                                                                    <option value="Marksman">Marksman</option>
                                                                    <option value="Support">Support</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="laning">Laning</label>
                                                                <select class="form-control select2" id="laning"
                                                                    name="laning" style="width: 100%;" required>
                                                                    <option disabled selected>Pilih Laning</option>
                                                                    <option value="Roam">Roam</option>
                                                                    <option value="Jungle">Jungle</option>
                                                                    <option value="Gold Lane">Gold Lane</option>
                                                                    <option value="EXP Lane">EXP Lane</option>
                                                                    <option value="Mid Lane">Mid Lane</option>
                                                                </select>
                                                            </div>
                                                            @foreach ($kriteria as $kriteriaItem)
                                                                <div class="form-group">
                                                                    <label
                                                                        for="{{ $kriteriaItem->nama }}">{{ $kriteriaItem->nama }}</label>
                                                                    <select class="form-control select2" id="select2"
                                                                        name="{{ str_replace(' ', '_', $kriteriaItem->nama) }}_kriteria"
                                                                        style="width: 100%;" required>
                                                                        <option disabled selected>Pilih
                                                                            {{ $kriteriaItem->nama }}</option>
                                                                        @foreach ($detailKriteria->where('id_kriteria', $kriteriaItem->id_kriteria) as $detail)
                                                                            <option value="{{ $detail->id_subkriteria }}">
                                                                                ({{ $detail->nilai }})
                                                                                {{ $detail->subkriteria }}</option>
                                                                        @endforeach
                                                                    </select>
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
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
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
                                            <th>Opsi</th>
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
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Training</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.alternatif.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <input type="hidden" name="id_alternatif" id="id_alternatif">
                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Hero</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                name="foto" accept="image/*">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Hero</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role Hero</label>
                                    <select class="form-control select2" id="role" name="role"
                                        style="width: 100%;" required>
                                        <option disabled selected>Pilih Role Hero</option>
                                        <option value="Tank">Tank</option>
                                        <option value="Fighter">Fighter</option>
                                        <option value="Assassin">Assassin</option>
                                        <option value="Mage">Mage</option>
                                        <option value="Marksman">Marksman</option>
                                        <option value="Support">Support</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="laning">Laning</label>
                                    <select class="form-control select2" id="laning" name="laning"
                                        style="width: 100%;" required>
                                        <option disabled selected>Pilih Laning</option>
                                        <option value="Roam">Roam</option>
                                        <option value="Jungle">Jungle</option>
                                        <option value="Gold Lane">Gold Lane</option>
                                        <option value="EXP Lane">EXP Lane</option>
                                        <option value="Mid Lane">Mid Lane</option>
                                    </select>
                                </div>
                                @foreach ($kriteria as $kriteriaItem)
                                    <div class="form-group">
                                        <label
                                            for="{{ str_replace(' ', '_', $kriteriaItem->nama) }}_kriteria">{{ $kriteriaItem->nama }}</label>
                                        <select class="form-control select2"
                                            id="{{ str_replace(' ', '_', $kriteriaItem->nama) }}_kriteria"
                                            name="{{ str_replace(' ', '_', $kriteriaItem->nama) }}_kriteria"
                                            style="width: 100%;" required>
                                            <option disabled selected value="">Pilih {{ $kriteriaItem->nama }}
                                            </option>
                                            @foreach ($detailKriteria->where('id_kriteria', $kriteriaItem->id_kriteria) as $detail)
                                                <option value="{{ $detail->id_subkriteria }}">
                                                    ({{ $detail->nilai }})
                                                    {{ $detail->subkriteria }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                processing: true,
                ordering: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('admin.alternatif') }}",
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
                    @endforeach {
                        data: null,
                        render: function(data) {
                            var subkriteriaString = JSON.stringify(data.subkriteria);

                            return '<div class="row justify-content-center">' +
                                '<div class="col-auto">' +
                                '<button type="button" class="btn btn-warning m-1" data-toggle="modal"' +
                                'data-target="#modal-edit" data-id=' + data.DT_RowIndex +
                                ' data-foto="' + data.foto + '" data-role="' + data.role +
                                '" data-nama="' + data.nama + '" data-laning="' + data.laning +
                                '" data-subkriteria=\'' +
                                subkriteriaString + '\' data-nilai="' + data.nilai +
                                '">' + 'Edit' +
                                '</button>' +
                                '<button type="button" class="btn btn-danger m-1" onclick="confirmDelete(' +
                                data.DT_RowIndex + ')"' +
                                'data-id="' + data.DT_RowIndex +
                                '">Hapus</button>' +
                                '</div>' +
                                '</div>';
                        }
                    }
                ],
                rowCallback: function(row, data, index) {
                    var dt = this.api();
                    $(row).attr('data-id', data.id);
                    $('td:eq(0)', row).html(dt.page.info().start + index + 1);
                }
            });


            $('#modal-edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id_alternatif = button.data('id');
                var foto = button.data('foto');
                var nama = button.data('nama');
                var role = button.data('role');
                var laning = button.data('laning');
                var subkriteria = button.data('subkriteria');
                var modal = $(this);

                modal.find('.modal-body #id_alternatif').val(id_alternatif);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #role').val(role).trigger('change');
                modal.find('.modal-body #laning').val(laning).trigger('change');

                $.each(subkriteria, function(namaKriteria, nilai) {
                    var inputId = '#' + namaKriteria.toLowerCase().replace(/\s+/g, '_') +
                        '_kriteria';
                    modal.find(inputId).val(nilai).trigger('change');
                });
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
                        url: "{{ url('admin/alternatif') }}/" + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            $('#myTable').DataTable().ajax.reload();
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

        function validateForm() {
            var selects = document.querySelectorAll('#select2');

            for (var i = 0; i < selects.length; i++) {
                if (!selects[i].selectedOptions[0]) {
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
