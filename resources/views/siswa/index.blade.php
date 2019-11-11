@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                    @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{ session('sukses') }}
                    </div>
                    @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Siswa</h3>
                                <div class="right">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i>
                                    Tambah Data Siswa
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Depan</th>
                                            <th>Nama Belakang</th>
                                            <th>Agama</th>
                                            <th width="8%">Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Rata2 Nilai</th>
                                            <th width="12%">Aksi</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach ($siswa as $sis)
                                        <tr>
                                            <td><a href="/siswa/{{ $sis->id }}/profile">{{ $sis->nama_depan }}</a></td>
                                            <td><a href="/siswa/{{ $sis->id }}/profile">{{ $sis->nama_belakang }}</a></td>
                                            <td>{{ $sis->agama }}</td>
                                            <td>{{ $sis->jenis_kelamin }}</td>
                                            <td>{{ $sis->alamat }}</td>
                                            <td>{{ $sis->ratarata() }}</td>
                                            <td>
                                                <a href="/siswa/{{ $sis->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="/siswa/{{ $sis->id }}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Beneran Bro?')">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
                    <label for="exampleInputEmail1">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama depan" value="{{ old('nama_depan') }}">
                    @if ($errors->has('nama_depan'))
                        <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('nama_belakang') ? 'has-error' : '' }}">
                    <label for="exampleInputEmail1">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama belakang" value="{{ old('nama_belakang') }}">
                    @if ($errors->has('nama_belakang'))
                        <span class="help-block">{{ $errors->first('nama_belakang') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
                        <option>-Pilih-</option>
                        <option value="L" {{ (old('jenis_kelamin') == 'L') ? 'selected' : '' }}>Laki - Laki</option>
                        <option value="P" {{ (old('jenis_kelamin') == 'P') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @if ($errors->has('jenis_kelamin'))
                        <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                    <label for="exampleInputEmail1">Agama</label>
                    <input type="text" class="form-control" name="agama" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="agama" value="{{ old('agama') }}">
                    @if ($errors->has('agama'))
                        <span class="help-block">{{ $errors->first('agama') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                    <label for="exampleFormControlTextarea1">Alamat</label>
                    <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">{{ old('alamat') }}</textarea>
                    @if ($errors->has('alamat'))
                        <span class="help-block">{{ $errors->first('alamat') }}</span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                    <label for="">Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                    @if ($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                    @endif
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>

        </div>

    </div>
    </div>
</div>
@endsection