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
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form role="form" method="POST" action="{{ route('admin.change-password.update') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="opass" class="form-control @error('opass') is-invalid @enderror" value="{{ old('opass') }}" placeholder="Enter Old Password">
                            @error('opass')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="npass" class="form-control @error('npass') is-invalid @enderror" value="{{ old('npass') }}" placeholder="Enter New Password">
                            @error('npass')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="cpass" class="form-control @error('cpass') is-invalid @enderror" value="{{ old('cpass') }}" placeholder="Enter New Password">
                            @error('cpass')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </section>    
  </div>  
@endsection
