
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

{{--<script src="{{ asset('admin/plugins/editors/markdown/simplemde.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/plugins/editors/markdown/custom-markdown.js') }}"></script>--}}

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('admin/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.js') }}"></script>
<script src="{{ asset('admin/notify.min.js') }}"></script>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script>
    $(document).ready(function() {
        App.init();
    });
    function purchase(){
        document.getElementById('purchase_history_data').style.display="none";
    }
</script>
<script src="{{ asset('admin/assets') }}/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('admin/assets') }}/js/dashboard/dash_1.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<script>
    $(document).ready(function() {
        App.init();
    });

</script>
<script src="{{ asset('admin/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
{{--<script src="{{ asset('admin/plugins/apex/apexcharts.min.js') }}"></script>--}}
<script src="{{ asset('admin/assets/js/dashboard/dash_1.js') }}"></script>
