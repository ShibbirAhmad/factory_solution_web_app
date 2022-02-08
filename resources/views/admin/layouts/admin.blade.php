<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') | Production Solution </title>
    @include('admin.include.admin-header-script')
    @yield('css')
    @yield('style')

</head>

<body class="sidebar-noneoverflow">
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
@include('admin.include.admin-header')
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <!--  BEGIN SIDEBAR  -->
    @include('admin.include.admin-menu')
    <!--  END SIDEBAR  -->
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @include('admin.include.admin-breadcrumb',
                    ['mainPage'=>\Request::route()->getName(),'details'=>'MI. Production Software.'])
            @yield('content')
        </div>
        @include('admin.include.admin-footer')
    </div>
    <!--  END CONTENT AREA  -->
</div>
<!-- END MAIN CONTAINER -->


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
@include('admin.include.admin-footer-script')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer:5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

</script>

{{--Success Message start --}}
@if(session()->has('success'))
    <script>
        $(function (){
            $.notify({{ session()->get("success") }}, "success");
        });
    </script>
@endif
{{--Success Message end --}}


{{--error Message start --}}
@if(session()->has('error'))
    <script>
        Toast.fire({
            icon: 'error',
            title: '{{ session()->get("error") }}'
        })
    </script>
@endif
{{--error Message end --}}



{{--warning Message start --}}
@if(session()->has('warning'))
    <script>
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get("warning") }}'
        })
    </script>
@endif
{{--warning Message end --}}

{{-- Delete start --}}
<script>
    $(document).on('click', '.erase', function () {
        var id = $(this).attr('data-id');
        var url=$(this).attr('data-url');
        console.log("Clicked ID : "+id+ " Request URL : "+url);
        var token = '{{csrf_token()}}';
        var $tr = $(this).closest('tr');
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this information!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {id: id, _token: token},
                        dateType:'html',
                        success: function (response) {
                            swal("Deleted!", "Data has been Deleted.", "success"),
                                swal({
                                        title: "Deleted!",
                                        text: "Data has been Deleted.",
                                        type: "success"
                                    },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            $tr.find('td').fadeOut(1000, function () {
                                                $tr.remove();
                                            });
                                        }
                                    });
                        }
                    });
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            });
    });
</script>
{{-- Delete end --}}


<script>
    $(document).ready(function (){
        $("#dataTable").DataTable();
    });
</script>

@yield('js')
@yield('script')
</body>

</html>
