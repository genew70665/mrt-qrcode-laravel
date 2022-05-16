@extends('layouts.main')

@section('content')
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-left: 10px !important;
    height: auto !important;
    margin-top: -8px !important;
    margin-left: -12px !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">                
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3 class="card-title">Add Kit</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('kit.index') }}" class="btn btn-primary btn-small">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form role="form" method="POST" action="{{ route('kit.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select User</label>

                            <select class="form-control" name="user" id="select2-dropdown">
                                <option value="">Select Option</option>
                                @foreach($users as $user)
                                <option value="{{ $user->mrt_id }}">{{ $user->mrt_id }}</option>
                                @endforeach
                            </select>
                            @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>No. of kits</label>
                            <input type="number" class="form-control" name="number" @error('number') is-invalid @enderror value="{{ old('number') }}">
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kit Description</label>
                            <textarea name="description" class="form-control" @error('description') is-invalid @enderror value="{{ old('description') }}" placeholder="Enter kit description" style="resize:none; height:100px"></textarea>
                            @error('description')
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();
    });
</script>