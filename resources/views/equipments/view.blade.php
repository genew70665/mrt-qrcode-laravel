@extends('layouts.main')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <h3 class="card-title">Equipment List</h3>
                                </div>
                                <div class="col-6">
                                    <form role="form" method="POST" id="my-form" action="{{ route('equipment.import') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input type="file" name="file"
                                                class="form-control @error('file') is-invalid @enderror">
                                            <div class="input-group-append">
                                                <button id="btn-submit" class="btn btn-primary btn-sm">
                                                    <img src="{{ asset('images/loading_icon.gif') }}" id="submitLoader" style="float:left;width: 23px;display:none;">
                                                    <span id="buttonText">Import Equipments</span>
                                                </button>
                                            </div>

                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <a href="{{ asset('sample/equipment_csv_template.csv') }}" style="display:block"
                                        class="btn btn-info">Download Template</a>
                                </div>
                                <div class="col-2">
                                    <form method="POST" id="id-form" action="{{ route('equipment.select') }}">
                                        @csrf
                                        <input type="hidden" id="updateData" name="table_id">
                                        <button class="btn btn-success btn-m" name="selectEqu" id="selectEqu">Print Equipment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="printtable" class="table table-bordered table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll" class="main" /></th>
                                        <th>Point Id (11 Digit)</th>
                                        <th>Site Name</th>
                                        <th>Area Name</th>
                                        <th>Unit Name</th>
                                        <th>Equipment Name</th>
                                        <th>Description</th>
                                        <th>Fluid in use</th>
                                        <th>Fluid Grade</th>
                                        <th>Machine Type</th>
                                        <th>Latest Sample</th>
                                        <th>Last Sampled On</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
        </section>
    </div>
@endsection
