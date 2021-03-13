function stopEverything(event){
    event.stopPropagation();
    event.preventDefault();
}
//function to check the input is valid or not 
function isValid(id, regx= new RegExp('^[\s\S]*'), error_id, msg, regmsg){
    var tagVal = $(id).val();
    
    if(tagVal == ""){
        $(error_id).html(msg);
        $(error_id).show();
        
        return false;
    }else if(!regx.test(tagVal)){
        $(error_id).html(regmsg);
        $(error_id).show();
        
        return false;
    }else{
        $(error_id).hide();
        return true;
    } 
}

//function to check passwords are matched or not
function isMatched(){
    var pass = $('#new-password').val();
    var con_pass = $('#con-new-password').val();

    if(pass == con_pass){
        $('#con-new-pass-error').hide();
        return true;
    }        
    $('#con-new-pass-error').html("Password does not match");
    $('#con-new-pass-error').show(); 
    return false;
}

//function to check wether input is empty or not
function isEmpty(id, error_id, msg){
    var tagVal = $(id).val();
    
    if(tagVal == ""){
        $(error_id).html(msg);
        $(error_id).show();
        
        return false;
    }else if(tagVal === null){
        $(error_id).html(msg);
        $(error_id).show();
        
        return false;
    }else{
        $(error_id).hide();
        return true;
    } 
}

function form_validation(){

    // Regular expression for validation 
    var pass_rgx = new RegExp("^([A-Za-z0-9_\.@\$!]{8,20})$");

    var old_pass = isEmpty('#old-password',
                    '#old-pass-error',
                    "*Please, enter your current password");
    
    var new_pass = isValid('#new-password',
                    pass_rgx,
                    '#new-pass-error', 
                    "*Please, enter the new password", 
                    "*Weak Password");

    var con_new_pass = isEmpty('#con-new-password',
                            '#con-new-pass-error',
                            "*Please, confirm your new password")  && isMatched();

    return (old_pass && new_pass && con_new_pass && pass_valid);
}



$(document).ready(function () {

    $('#change').click(function (e) { 
        if(!form_validation()){
            stopEverything(e);
        } 
    });

    $('#cancel').click(function () { 
        $('#change-pass-form input[type="password"]').val('');
        var errors = document.querySelectorAll('.error-text');
        errors.forEach(e => {
            $(e).hide();
        });
    });
});