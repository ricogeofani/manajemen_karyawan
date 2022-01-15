@extends('layouts.admin')

@push('css')
       <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <style type="text/css">
    .jam {
        font-size: 5em;
        text-shadow: -3px -3px 1px gray;
    }
    .input {
        margin-left: 30px;
    }
</style>
@endpush

@section('header', 'halaman Absen Karyawan')
@section('content')
<component id="controller">

    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="time">
                    <span class="jam"></span>
                </div>
                <div class="form-absen d-flex">
                    <form action="{{ route('absen-masuk') }}" method="POST">
                        @csrf
                            <div class="input">
                                <input type="hidden" name="absen" value="1">
                                <button type="submit" class="btn btn-primary">Absen masuk</button>
                            </div>
                    </form>
                    <form action="{{ route('absen-masuk') }}" method="POST">
                        @csrf
                            <div class="input border">
                                <input type="radio" name="absen" value="0" class="mb-4 ml-2"> Tidak Masuk <br>
                                <input type="radio" name="ket" value="sakit" class="ml-2">Ijin Sakit
                                <input type="date" name="cuti" class="mb-3 ml-2"> Ijin Cuti
                                <button type="submit" class="btn btn-primary">Tidak Masuk</button>
                            </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-6">
                <table class="table table-borderd">
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Absen</th>
                        <th>Keterangan</th>
                        <th>Cuti</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($data_absen as $absen)
                        <tr>
                            <td>{{ $absen->karyawan->nama }}</td>
                            <td>{{ $absen->karyawan->jabatan }}</td>
                            <td>{{ $absen->absen == 1 ? 'masuk' : 'tidak masuk' }}</td>
                            <td>{{ $absen->keterangan != null ? $absen->keterangan : 'tanpa keterangan' }}</td>
                            <td>{{ $absen->cuti != null ? $absen->cuti : 'tanpa keterangan' }}</td>
                            <td>
                                <form action="{{ route('absen-masuk') }}" method="post">
                                    @csrf
                                        <div class="input border">
                                            <input type="hidden" name="id" value="{{ $absen->id }}">
                                            <input type="radio" name="ket" value="sakit" class="mb-2"> Ijin Sakit
                                            <button type="submit" @click="update($absen)" class="btn btn-warning btn-sm">Edit Keterangan</button>
                                        </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
     
</component>
@endsection

@push('js')
<script type="text/javascript">
    function jam() {
        var time = new Date(),
            hours = time.getHours(),
            minutes = time.getMinutes(),
            seconds = time.getSeconds();
        document.querySelectorAll('.jam')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
        
        function harold(standIn) {
            if (standIn < 10) {
            standIn = '0' + standIn
            }
            return standIn;
            }
    }
    setInterval(jam, 1000);

    // setInterval(function () {document.getElementById("submit").click();}, 5000);

</script>
<script type="text/javascript">
    var app = new Vue({
        el: '#controller',
        data: {
            editStatus: false,
            absen: {},
            actionURL: ''
        },
        mounted: function() {

        },
        methods: {
            update(absen){
                return axios.put('http://localhost:8000/absen-masuk/' + absen.id , this.absen).then(res => {
                this.load()
                this.updateSubmit = true
                alert('update success');
            }).catch((err) => {
                console.log(err);
            })
            },
        }
    });
</script>
@endpush
