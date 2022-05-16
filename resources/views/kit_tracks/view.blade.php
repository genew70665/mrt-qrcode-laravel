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
                <div class="col-3">
                    <h3 class="card-title">Kit Track List</h3>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-hover dataTable" >
                <thead>
                    <tr>
                        <th>Account ID</th>
                        <th>Kit Id</th>
                        <th>Equipment Id</th>
                        <th>Equipment Name</th>
                        <th>Fluid in use</th>
                        <th>kit Type</th>
                        <th>Created</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kits as $kit)
                    <tr>
                        <td>{{ $kit->user->mrt_id }}</td>
                        <td>{{ $kit->kit->kit }}</td>
                        <td>{{ empty($kit->equipment->point_id) ? $kit->point_id : $kit->equipment->point_id}}</td>
                        <td>{{ $kit->identified_equipment }}</td>
                        <td>{{ $kit->fluid_in_use }}</td>
                        <td>{{ $kit->type }}</td>
                        <td>{{ $kit->created_at}}</td>
                        <td>{{ empty($kit->equipment->point_id) ? "New" : "Existing"}}</td>
                    </tr>
                   @endforeach
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
