//function for datepicker
$(function () {
    $('#dob').datepicker({
        format: 'dd/mm/yyyy',
        calendarWeeks: true,
        todayHighlight: true,
        autoclose: true,
        endDate:'0'
    });
});

// dob to age convertor
$(function(){
    $('#dob').change(function () { 
        var dob = $('#dob').val().split('/');
        console.log(dob);
        var now = new Date();
        console.log(now.getDate() +" / "+ (now.getMonth()+1) +" / "+ now.getFullYear());

        var birth_date = dob[0];
        var birth_month = dob[1];
        var birth_year = dob[2];

        var current_date = now.getDate();
        var current_month = now.getMonth() + 1;
        var current_year  = now.getFullYear();

        var month =[31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; 

        if(birth_date > current_date){
            current_date += month[birth_month - 1];
            current_month -= 1;
        }
          
        if(birth_month > current_month){
            current_month += 12;
            current_year -= 1;
        }

        var age_D = current_date - birth_date;
        var age_M = current_month - birth_month;
        var age_Y = current_year - birth_year;
        
        $('#age').val(age_Y);
        $('#age-val').val(age_Y);
        //console.log(age_Y, age_M , age_D);
    });
});

function stopEverything(event){
    event.stopPropagation();
    event.preventDefault();
}

//function to view element 
function scrollTo(view){
    var position = $(view).parent().offset();
    $('html, body').stop().animate({scrollTop : position.top}, 500);
}

//function to check the input is valid or not 
function isValid(id, regx= new RegExp('^[\s\S]*'), error_id, msg, regmsg){
    var tagVal = $(id).val();
    
    if(tagVal == ""){
        $(error_id).html(msg);
        $(error_id).show();
        scrollTo(id);
        return false;
    }else if(!regx.test(tagVal)){
        $(error_id).html(regmsg);
        $(error_id).show();
        scrollTo(id);
        return false;
    }else{
        $(error_id).hide();
        return true;
    } 
}

//function to check wether input is empty or not
function isEmpty(id, error_id, msg){
    var tagVal = $(id).val();
    
    if(tagVal == ""){
        $(error_id).html(msg);
        $(error_id).show();
        scrollTo(id);
        return false;
    }else if(tagVal === null){
        $(error_id).html(msg);
        $(error_id).show();
        scrollTo(id);
        return false;
    }else{
        $(error_id).hide();
        return true;
    } 
}

//function to check passwords are matched or not
function isMatched(){
    var pass = $('#user-password').val();
    var con_pass = $('#con-pass').val();

    if(pass == con_pass){
        $('#cpass-error').hide();
        return true;
    }        
    $('#cpass-error').html("Password does not match");
    $('#cpass-error').show(); 
    return false;
}

//function to check radio button 
function isChecked(name, error_id, error_msg){
    if($(name).val()){
        $(error_id).hide();
        return true;
    }
    $(error_id).html(error_msg);
    $(error_id).show();
    return false;
}

function form_validation(){

    // Regular expression for validation 
    var name_rgx = new RegExp("^([a-zA-Z]{2,25})$");
    var email_rgx =new RegExp("^([A-Za-z0-9\.-]+)@([A-Za-z0-9]+)\.([A-Za-z]{2,8})$");
    var contact_rgx = new RegExp("^[0-9]{10}$");
    var city_rgx = new RegExp("^[A-Za-z]{2,}$");
    var pin_rgx = new RegExp("^[0-9]{6}$");
    var pass_rgx = new RegExp("^([A-Za-z0-9_\.@\$!]{8,20})$");

    
    var con_pass = isEmpty('#con-pass',
                            '#cpass-error',
                            "*Please, confirm your password")  && isMatched();
 
    var pass_valid = isValid('#user-password',
                            pass_rgx,
                            '#pass-error', 
                            "*Please, enter the password", 
                            "*Weak Password");
    
    var pincode_valid = isValid('#pincode',
                            pin_rgx,
                            '#pin-error', 
                            "*Please, enter the pincode", 
                            "*Please, enter valid pincode");
    
    var state_valid = isEmpty("#state",
                            '#state-error', 
                            "*Please, select the state");
                            

    var city_valid = isValid('#city',
                            city_rgx,
                            '#city-error', 
                            "*Please, enter the city", 
                            "*Please, enter valid city");
                            
    var addr_valid = isEmpty('#address',
                            '#addr-error', 
                            "*Please, enter the address");                          

    var contact_valid = isValid('#contact',
                            contact_rgx,
                            '#contact-error', 
                            "*Please, enter the contact no", 
                            "*Please, enter valid contact no");                         
    
    var email_valid = isValid('#email',
                            email_rgx,
                            '#email-error', 
                            "*Please, enter the email id", 
                            "*Please, enter valid email id");  
    
    var special_valid = isEmpty("#special",
                            '#special-error', 
                            "*Please, select the specialization");

    /*var gender_valid = isChecked("input[name='gender']:checked",
                            '#gender-error', 
                            "*Please, select the gender");  */


    var dob_valid = isEmpty('#dob',
                            '#dob-error', 
                            "*Please, select date of birth");  
    

    var lname_valid = isValid('#lname',
                            name_rgx,
                            '#lname-error', 
                            "*Please, enter last name", 
                            "*Please, enter valid name");  
    
    var mname_valid = isValid('#mname',
                            name_rgx,
                            '#mname-error', 
                            "*Please, enter middle name", 
                            "*Please, enter valid name");
                            
    var fname_valid = isValid('#fname',
                            name_rgx,
                            '#fname-error', 
                            "*Please, enter first name", 
                            "*Please, enter valid name");

    return (fname_valid && mname_valid && lname_valid && 
            dob_valid &&  
            special_valid && 
            email_valid && contact_valid && addr_valid  && city_valid && 
            state_valid && 
            pincode_valid && pass_valid && con_pass);
}

$(document).ready(function () {

    $('#regbtn').click(function (e) { 
        if(!form_validation()){
            stopEverything(e);
        } 
    });

    $('#resetbtn').click(function () { 
        var errors = document.querySelectorAll('.error-text');
        errors.forEach(e => {
            $(e).hide();
        });
    });
});