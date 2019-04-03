     <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('translate.ready_to_leave')}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
    <div class="modal-body">{{trans('translate.msg_logout')}}</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ trans('translate.cancel')}}</button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" >
            @csrf
          <button type="submit"class="btn btn-primary" href="{{route('logout')}}">{{ trans('translate.confirm')}}</button>
            </form>
        </div>
      </div>
    </div>
  </div>
<!-- Bootstrap core JavaScript-->
  <script src="{{URL::asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{URL::asset('js/sb-admin-2.min.js') }}"></script>


  <!-- Page level plugins -->
  <script src="{{URL::asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{URL::asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  <script src="{{URL::asset('vendor/datatables/buttons.server-side.js') }}"></script>


 <script src="//code.jquery.com/jquery-3.3.1.js"></script>
   <!--<script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>-->


</body>
@stack('js')
@stack('css')
</html>
