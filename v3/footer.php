  </div>
<script>
$(document).ready(function(){
  $("#pencarian").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

 <script>
        $('#datepicker').datepicker({
          format: 'dd-mm-yyyy',
            uiLibrary: 'bootstrap4'
        });
    </script>

    <script type="text/javascript">
      $('.dropdown').click(function(){
  $('.dropdown-menu').toggleClass('show');
});
    </script>