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
                      <h3 class="card-title">Kit lists</h3>
                  </div>
                  <div class="col-6 text-right">
                      <a href="{{ route('kit.create') }}" class="btn btn-primary btn-small">Add Kit</a>
                  </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dataTable" class="table table-bordered table-hover dataTable" >
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Account Id</th>
                        <th>Client Name</th>
                        <th>Kit Id</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kits as $i=>$kit)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $kit->user }}</td>
                        <td>{{ $kit->userData->name }}</td>
                        <td>{{ $kit->kit }}</td>
                        <td><span class="{{ $kit->status == '1' ? 'text-success' : 'text-danger'}}">{{ $kit->status == '1' ? 'Active' : 'Inactive'}}</span></td>
                        <td>{{ $kit->created_at }}</td>
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
@section('scripts')
<script>
  function onDeleteAdmin(adminId){
    $.confirm({
      title:"Are you sure?",
      content: 'Please be careful, Admin user will be deleted permanently. <br> Do you really want to delete this user? ',
      buttons: {
        confirm: function () {
          $.ajax({
            url: 'admin/'+adminId,
            type:'DELETE',
            data:{"_token": "{{ csrf_token() }}"},
            success:function(data){
              if(data.status===200){
                sessionStorage.reloadAfterPageLoad = true;
                sessionStorage.setItem('message',data.message);
                window.location.reload();
              }else if(data.status===403){
                toastr.error(data.message);
              }
            }
          })
        },
        cancel: function () {

        }
      }
    })
  }
</script>
@endsection
