 </div>
    <!-- /container -->
 
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<!-- end the HTML page -->


<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
  
    var id = $(this).attr('delete-id');
  
    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
  
            if(result==true){
                $.post('delete_download.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        },
        callback: function (result) {
  if(result==true){
      $.comm('update_comm.php', {
          comment_id: comment_id
      }, function(data){
          location.reload();
      }).fail(function() {
          alert('Unable to update.');
      });
  }
}
    });
    return false;
});
</script>
</body>
</html>