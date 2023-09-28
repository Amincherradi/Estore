$.noConflict();
$(document).ready(function () {
    $('#ordertable').DataTable();
    $(document).on('click', 'a[id=Modorderrs]', function() {
        alert("ok");
        $.ajax({
            url:'ModOrders.php',
           success: function(data){
            alert("ok2");
               $("#Modifyorders").html(data);
           }
        });
    });
});
