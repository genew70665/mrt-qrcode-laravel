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
                            <label>Kit Number</label>
                            <input type="text" class="form-control @error('kit') is-invalid @enderror" value="{{ $kit }}" placeholder="Enter kit number" disabled>
                            <input type="hidden" name="kit" value="{{ $kit }}" />
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kit Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="Enter kit description" style="resize:none; height:100px"></textarea>
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