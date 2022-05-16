@extends('layouts.main')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! QrCode::size(300)->generate($equipment['point_id']) !!}
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
@endsection