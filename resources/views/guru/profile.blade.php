@extends('layouts.master');

@section('xeditable')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <div class="panel panel-profile">
                        @if (session('sukses'))
                        <div class="alert alert-success" role="alert">
                            {{ session('sukses') }}
                        </div>
                        @endif

                        @if (session('gagal'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('gagal') }}
                        </div>
                        @endif
                    <div class="clearfix">
                        <!-- LEFT COLUMN -->
                        <div class="profile-left">
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                                    
                                <div class="overlay"></div>
                                <div class="profile-main">
                                    <img src="#" class="img-circle" alt="Avatar" width="150" height="150">
                                    <h3 class="name">{{ $guru->nama }}</h3>
                                    <span class="online-status status-available">Available</span>
                                </div>
                                
                            </div>
                            
                            <!-- END PROFILE DETAIL -->
                        </div>
                        <!-- END LEFT COLUMN -->
                        <!-- RIGHT COLUMN -->
                        <div class="profile-right">
                                
                            <div class="panel">
								<div class="panel-heading">
                                    <h3 class="panel-title">Mata Pelajaran oleh <b>{{ $guru->nama }}</b></h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Mata Pelajaran</th>
												<th>Semester</th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($guru->mapel as $mapel)                                            
											<tr>
                                                <td>{{ $mapel->nama }}</td>
                                                <td>{{ $mapel->semester }}</td>
                                            </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
                          <div class="panel">
                              <div id="chartNilai"></div>
                          </div>
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>

@endsection