<link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon.ico') }}" />
<link href="{{ asset('admin/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('admin/assets/js/loader.js') }}"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<link href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('admin/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/forms/theme-checkbox-radio.css') }}">
{{-- <link href="{{ asset('admin/assets/css/main.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('admin/assets/css/structure.css') }}" rel="stylesheet" type="text/css" /> --}}
{{-- <link href="{{ asset('admin/plugins/highlight/styles/monokai-sublime.css') }}" rel="stylesheet" type="text/css" /> --}}

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('admin/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('admin/plugins/editors/markdown/simplemde.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>


<link rel="stylesheet" href="{{ asset('admin/animate.min.css') }}">

{{-- Data Table start --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
{{-- Data Table end --}}

<script src="{{ asset('admin/assets/js/libs/jquery-3.1.1.min.js') }}"></script>



<style>
    .profile_img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        box-shadow: 0 1pt 12pt rgb(150, 165, 237);
    }

    .company_logo {
        width: 155px;
        height: 60px;
        box-shadow: 0 1pt 12pt rgb(150, 165, 237);
    }

    .due-info {
        float: left;
        width: 60%;
    }

    .supplier_info {
        width: 40%;
        float: left;
    }

    .amount_info {
        width: 30%;
        float: left;
    }

    .note-info {
        width: 30%;
        float: right;
    }

    .supplier_amount {
        background: #ECF1F5;
        padding: 5px 0px;
    }

    .task_report_container {
        min-width: 300px;
    }

    .sale_variant_preview_list {
        list-style-type: none;
        padding: 0 0 0 5px;

    }

    .sale_variant_preview_list li {
        padding: 3px 3px;
        font-size: 14px;
        color: #000;
        font-family: serif;
    }

    .final_order_complition_list {
        list-style-type: none;
        padding: 0 0 0 5px;

    }

    .final_order_complition_list li {
        padding: 10px 5px;
        font-size: 16px;
        color: #000;
        font-family: serif;
    }


    .group_report_list_container ul {
        list-style-type: none;
        padding: 0 0 0 5px;

    }

    .group_report_list_container ul li {
        padding: 3px 5px;

    }


    .task_report_container ul {
        list-style-type: none;
        padding: 0 0 0 5px;

    }

    .task_report_container ul li {
        display: block;
        padding: 3px 5px;

    }


    .variant_container ul {
        list-style-type: none;
        padding: 0 0 0 5px;

    }

    .variant_container ul li {
        display: block;
        padding: 3px 5px;

    }

    .variant_value_container {
        width: 350px;
        margin-left: 25px;
    }

    .order_completion_variant_values {
        height: 33px !important;
    }

    .order_variant_values, .sale_variant_values {
        height: 33px !important;
    }

    .order_task_assign_variant_values {
        height: 33px !important;
    }

    .order_task_receive_variant_values {
        height: 33px !important;
    }

    .new-checkbox {
        margin-top: 6px;
    }

</style>
