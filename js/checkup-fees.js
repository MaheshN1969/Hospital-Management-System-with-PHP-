$(document).ready(function () {
    var general_fee = 300; 
    var checkup_fee = 500;
    var inject_fee = 200;
    $('#submit').click(function () { 
        var total = 0;
        if($('#general').is(':checked')){
            total+=checkup_fee;
        }
        if($('#consult').is(':checked')){
            total+=general_fee;
        }
        if($('#inject').is(':checked')){
            total+=inject_fee;
        }
        $('#total-charges').val(total);

        alert($('#total-charges').val());
    });
  
});