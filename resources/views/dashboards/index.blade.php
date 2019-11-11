@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Rank 5 Besar!!</h3>
                    <p class="panel-subtitle">Period: 2019</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (rank5besar() as $siswa)                                    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->namaLengkap() }}</td>
                                        <td>{{ $siswa->ratarata }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                        <div class="col-md-2">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <p>
                                    <span class="number">{{ totalSiswa() }}</span>
                                    <span class="title">Total Siswa</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-user"></i></span>
                                <p>
                                    <span class="number">{{ totalGuru() }}</span>
                                    <span class="title">Total Guru</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection