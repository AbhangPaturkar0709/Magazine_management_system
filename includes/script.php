<script src="includes/js/jquery.min.js"></script>
    <script src="includes/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="includes/js/popper.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <script src="includes/js/jquery.easing.1.3.js"></script>
    <script src="includes/js/jquery.waypoints.min.js"></script>
    <script src="includes/js/jquery.stellar.min.js"></script>
    <script src="includes/js/owl.carousel.min.js"></script>
    <script src="includes/js/jquery.magnific-popup.min.js"></script>
    <script src="includes/js/aos.js"></script>
    <script src="includes/js/jquery.animateNumber.min.js"></script>
    <script src="includes/js/bootstrap-datepicker.js"></script>
    <script src="includes/js/jquery.timepicker.min.js"></script>
    <script src="includes/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="includes/js/google-map.js"></script>
    <script src="includes/js/main.js"></script>
    <script>
  $(function () {
    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
  </body>
</html>