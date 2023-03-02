<footer class="main-footer">
    <h5 class="font-size-18 font-bold" style="font-weight: 700"><span class="text-dark">ALT</span> <span style="background: #FFFFFF; padding:5px 10px; color:#333333" class="">RECOVERY</span> <span style="background: #333333; padding:5px 10px; color:#FFFFFF" class="text-light">MANAGER</span></h5>

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->





<script src="{{asset('dist/js/adminlte.js')}}"></script>


<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $('.summernote').summernote({
        codeviewFilter: false,
        height:300,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline','fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['misc',['fullscreen','undo','print']],
            ['height', ['height']]
        ]
    });
    $('.data-table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
</script>
