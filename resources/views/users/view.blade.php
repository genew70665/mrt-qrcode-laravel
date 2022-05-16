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
                    <h3 class="card-title">User List</h3>
                </div>
                <div class="col-6">
                  <form role="form" method="POST" action="{{ route('users.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                      <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm">Import Users</button>
                      </div>

                      @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </form>
              </div>
              <div class="col-2 offset-1">
                  <a href="{{ asset('sample/users_sample_csv_template.csv') }}" style="display:block" class="btn btn-info btn-m">Download Template</a>
              </div>
              </div> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="user-dataTable" class="table table-bordered table-hover dataTable" >
                <thead>
                    <tr>
                        <th>Account ID (7&nbspDigit)</th>
                        <th>MRT Client Name</th>
                        <th>MRT Client Email</th>
                        <th>Client Company Name</th>
                        <th>Shipping Phone</th>
                        <th>Shipping Addr. 1</th>
                        <th>Shipping Addr. 2</th>
                        <th>Shipping City</th>
                        <th>Shipping State</th>
                        <th>Shipping Zip</th>
                        <th>Notes</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1 @endphp
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->mrt_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->company }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address1 }}</td>
                        <td>{{ $user->address2 }}</td>
                        <td>{{ $user->city }}</td>
                        <td>{{ $user->state }}</td>
                        <td>{{ $user->zip }}</td>
                        <td>{{ $user->notes }}</td>
                        <td>
                          <button data-id="{{$user->id}}" class="toggle-class {{ $user->status ? 'btn-active' : 'btn-block' }}" type="button" data-status={{ $user->status ? 0 : 1 }} >{{ $user->status ? 'Active' : 'Block' }}</button>
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
    </section>    
  </div>  
@endsection