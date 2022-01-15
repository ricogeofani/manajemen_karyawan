@extends('layouts.admin')

@push('css')
       <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('header', 'halaman karyawan')
@section('content')
<component id="controller">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="#" @click="addData()" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Data</a>
                                <a href="javascript:location.reload(true)" class="btn btn-success"><i class="fa fa-undo" aria-hidden="true"></i> Refresh</a>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telp</th>
                                            <th>Alamat</th>
                                            <th>Gender</th>
                                            <th>Jabatan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           <!-- Modal -->
     <div class="modal fade" id="modal-default" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <form :action="actionUrl" method="post" autocomplete="of" @submit="submitForm($event, data.id)">
                    <div class="modal-header text-uppercase bg-warning">
                        <h4 class="modal-title" id="exampleModalLabel" v-if="!editStatus">Add Karyawan</h4>
                        <h4 class="modal-title" id="exampleModalLabel" v-if="editStatus">Edit Karyawan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="put" v-if="editStatus">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>foto</label> <br>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Nama Karyawan</label>
                                    <input type="text" name="nama" v-bind:value="data.nama" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Email Karyawan</label>
                                    <input type="email" name="email" v-bind:value="data.email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Telp Karyawan</label>
                                    <input type="text" name="telp" v-bind:value="data.telp" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Alamat Karyawan</label>
                                    <input type="text" name="alamat" v-bind:value="data.alamat" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="gender" class="form-control">
                                        <option value="0">.jenis kelamin</option>
                                        <option :selected="data.gender == 'L' " value="L">Laki-laki</option>
                                        <option :selected="data.gender == 'P' " value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Jabatan Karyawan</label>
                                    <select name="jabatan" class="form-control">
                                        <option value="0">.jabatan</option>
                                        <option :selected="data.jabatan == 'manager' " value="manager">Manager</option>
                                        <option :selected="data.jabatan == 'admin' " value="admin">Admin</option>
                                        <option :selected="data.jabatan == 'staff' " value="staff">Staff</option>
                                        <option :selected="data.jabatan == 'hrd' " value="hrd">Hrd</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-5" v-if="!editStatus">Create Data</button>
                        <button type="submit" class="btn btn-primary mr-5" v-if="editStatus">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
</component>
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
      var actionUrl = '{{ url('api/karyawan') }}';
        var columns = [
            {data: 'nama', class: 'text-center', orderable: true},
            {data: 'email', class: 'text-center', orderable: true},
            {data: 'telp', class: 'text-center', orderable: true},
            {data: 'alamat', class: 'text-center', orderable: true},
            {data: 'gender', class: 'text-center', orderable: true},
            {data: 'jabatan', class: 'text-center', orderable: true},
            {render: function(index, row, data, meta){
                return `
                <div class="d-flex">
                    <a href="#" class="btn btn-sm btn-warning" onclick="controller.editData(event, ${meta.row})"> 
                        Update
                    </a>
                    <a href="#" class="btn btn-danger btn-sm ml-2" onclick="controller.deleteData(event, ${data.id})">
                        Delete
                    </a>
                </div>
                `;
            }, orderable: false, width: '100px', class: 'text-center'},
        ];
</script>

<script src="{{ asset('js/data.js') }}"></script>
    
@endpush
