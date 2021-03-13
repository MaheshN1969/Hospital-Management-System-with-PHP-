function stopEverything(evnet){
    event.stopPropagation();
    event.preventDefault();
}

function onFoucsEvent(id){
    if(id == "username"){
        $('#user-error').hide();
    }else if(id == "password"){
        $('#pass-error').hide();
    }
}

function isEmpty(id, error_id, msg){
    var tagVal = $(id).val();
    if(tagVal == ""){
        $(error_id).html(msg);
        $(error_id).show();
        return true;
    }
    return false;
}

$(document).ready(function () {
    
    $('#login').click(function (e) { 

        var user_empty = isEmpty('#username','#user-error',"*Please, enter the username");
        var pass_empty = isEmpty('#password','#pass-error',"*Please, enter the password");
        if((user_empty && pass_empty) || user_empty || pass_empty){
            stopEverything(e);
        }  
    });
});


















































// function isUserEmpty(){
//     var username = $('#username').val();
//     if(username == ""){
//         stopEverything(e);
//         $('#user-error').html("*Please, enter the username");
//         $('#user-error').show();
//         return true;
//     }
//     return false;
// }




// function isPassEmpty(){
//     var password = $('#password').val();
//     if(password == ""){
//         stopEverything(e);
//         $('#pass-error').html("*Please, enter the password");
//         $('#pass-error').show();
//         return true;
//     }
//     return false;
// }


// $(document).ready(function () {
    
//     $('#login').click(function (e) { 
//         var username = $('#username').val();
//         var password = $('#password').val();

//         if(username == ""&&password == ""){
//             stopEverything(e);
//             $('#user-error').html("*Please, enter the username");
//             $('#user-error').show();
//             $('#pass-error').html("*Please, enter the password");
//             $('#pass-error').show();
//         }else if(username == ""){
//             stopEverything(e);
//             $('#user-error').html("*Please, enter the username");
//             $('#user-error').show();
//         }else if(password == ""){
//             stopEverything(e);
//             $('#pass-error').html("*Please, enter the password");
//             $('#pass-error').show();
//         }  
//     });
// });


