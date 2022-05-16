<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Icon-App-40x40@3x.png') }}" type="image/x-icon"/>

    <title>{{ config('app.name') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/enlarge.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }} ">


    <style>
      .form-control.is-invalid, .was-validated .form-control:invalid{
        background-position: center right calc(.375em + .5875rem) !important;
      }
      .counter{
        position: absolute;
        top: -11px;
        left: auto;
        z-index: 2;
        padding: 2px 6px;
        margin-left: 12px;
        font-size: 11px;
        border-radius: 100%;
      }
      .invalid-feedback {
            display: block !important;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #dc3545;
        }
        .btn-active{
          background-color: #d5f5d5;
          border: 1px solid green;
          border-radius: 5px;
          padding: 3px 11px;
          color: #014001;
        }
        .btn-block{
          background-color: #ffbcbc;
          color: #cb0404;
          border: 1px solid #cb0404;
          border-radius: 5px;
          padding: 3px 11px;
        }
    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.change-password.index') }}">Change Password</i></a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::guard('admin')->user()->email }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('admin/dashboard') }}" class="brand-link ml-2">
          <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
              <a href="{{ url('admin/dashboard') }}" class="d-block">{{ Auth::guard('admin')->user()->name }}</span>
            </div>
          </div>

          @include('partials.menu')
        </div>
        <!-- /.sidebar -->
      </aside>
      @yield('content')
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">

        </div>
        <!-- Default to the left -->
        {{-- <strong>Copyright &copy; 2019-2020 TAND.</strong> All rights reserved. --}}
      </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        $(function () {
              if ( sessionStorage.reloadAfterPageLoad ) {
                  toastr.success(sessionStorage.getItem('message'));
                  sessionStorage.clear();
              }
        });

        $(document).ready(function() {
          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4',
          });
        })

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pageLength": 100,
            });
        });

        $(document).ready(function() {
            $('#user-dataTable').DataTable({
                "scrollX": true,
                "pageLength": 100,
            });
        });

        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

  <script>
    $(document).on('click','.toggle-class',function(){
        var status = $(this).attr('data-status');
        var user_id = $(this).attr('data-id');
        // this.value = status ? 'Active' : 'Block';

        if(status == 1){
          $(this).text('Active');
          $(this).attr('data-status',0);
          $(this).removeClass("btn-block").addClass("btn-active");

        }else{
          $(this).text('Block');
          $(this).attr('data-status',1);
          $(this).removeClass("btn-active").addClass("btn-block");
        }

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
            }
        });
    })
  </script>
  <script type="text/javascript">

   $(document).ready(function () {
       $("#my-form").submit(function (e) {
           $("#btn-submit").attr("disabled", true);
           $("#buttonText").text('Loading');
           $("#submitLoader").show();
           return true;
       });
   });

</script>
<script type="text/javascript">
   $(document).ready(function() {

       var table = $("#printtable").DataTable({
           "order": [[1]],
           "columnDefs": [
               { "orderable": false, "targets": [0] } // Applies the option to all columns
           ],
           "scrollX": true,
           ajax: {
               url: '{{ url('admin/equipment-list') }}',
           },
           buttons: true,
           "pageLength": 100,
           searching: true,
           scrollCollapse: true,

           columns: [{
                   data: "id",
                   render: (id) => `<input type="checkbox" id="selecteq" data-id="${id}"/>`,
               },
               {
                   data: "point_id",
                   className: 'pointId'
               },
               {
                   data: "site",
                   className: 'site'
               },
               {
                   data: "area",
                   className: 'area'
               },
               {
                   data: "unit",
                   className: 'unit'
               },
               {
                   data: "equipment",
                   className: 'equipment'
               },
               {
                   data: "description",
                   className: 'description'
               },
               {
                   data: "fluid_in_use",
                   className: 'fluid_in_use'
               },
               {
                   data: "fluid_grade",
                   className: 'fluid_grade'
               },
               {
                   data: "equipment_type",
                   className: 'equipment_type'
               },
               {
                   data: "recent_sample",
                   className: 'recent_sample'
               },
               {
                   data: "last_sample_date",
                   className: 'last_sample_date'
               }
           ],
       });

       var id_global=null;

       $('#selectAll').click(function(e) {
           if($(this).hasClass('checkedAll')) {
           var che = table.$("input[type='checkbox']").prop('checked', false);
           var id = table.rows( { selected: true, search: 'applied' } ).data().map(item => item.id);
           id_global = table.rows('.selected').data().$('#selecteq:checked').map(function() {
               return $(this).attr('data-id');
           }).get().join(", ");

           $(this).removeClass('checkedAll');
           } else {
           var che = table.$("input[type='checkbox']").prop('checked', true);
           var id = table.rows( { selected: true, search: 'applied' } ).data().map(item => item.id);
           id_global =id.join(", ");
           $(this).addClass('checkedAll');
           }
       });

       $('#printtable tbody').on('click', 'tr', function() {
           $(this).toggleClass('selected');
       });

       $('#selectEqu').click(function() {
           if(!id_global){
               var id = table.rows('.selected').data().$('#selecteq:checked').map(function() {
               return $(this).attr('data-id');
               }).get().join(", ");
               $('#updateData').val(id);
           }
           else{
               $('#updateData').val(id_global);
           }
           $("#id-form").on("submit", function(e) {
               if ($('#updateData').val() == '') {
                   alert('Please select a Equipment');
                   return false; // cancel submit
               }
               $('#selectAll').prop('checked', false);
               return true; // allow submit
           });
       });

   });
</script>

    @yield('scripts')
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
  </body>
</html>
