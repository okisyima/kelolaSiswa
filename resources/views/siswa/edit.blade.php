@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Form</h3>
                        </div>
                        <div class="panel-body">
                                <form action="/siswa/{{ $siswa->id }}/update" enctype="multipart/form-data" method="POST">
                                    {{ csrf_field() }}
                
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Depan</label>
                                        <input type="text" class="form-control" value="{{ $siswa->nama_depan }}" name="nama_depan" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama depan">
                                    </div>
                
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Belakang</label>
                                        <input type="text" class="form-control" value="{{ $siswa->nama_belakang }}"  name="nama_belakang" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama belakang">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="exampleFormControlSelect1">
                                            <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki - Laki</option>
                                            <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                        </select>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Agama</label>
                                        <input type="text" class="form-control" value="{{ $siswa->agama }}" name="agama" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="agama">
                                    </div>
                
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3">{{ $siswa->alamat }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Avatar</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('content1')
        
        @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
        @endif
        
        <div class="row">
        
            <h2>edit data</h2>
            <div class="col-lg-12">

                

            </div>

        </div>

@endsection