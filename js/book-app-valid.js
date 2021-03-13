$(function () {
    $('#app-date').datepicker({
        format: 'dd/mm/yyyy',
        calendarWeeks: true,
        todayHighlight: true,
        autoclose: true,
		startDate: new Date() 
    });
});
   
$("#book-app-search").on("keyup", function(e){ 
    e.preventDefault();
    var value = $(this).val().toLowerCase();

    $("#book-app-table tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});

$("#app-date").change(function(e){
    var all_date_inputs = document.querySelectorAll('.app_date');
    var app_date = $("#app-date").val();
    all_date_inputs.forEach((e)=>{
        $(e).val(app_date);
    });
});

$("#time").change(function(e){
    var all_time_inputs = document.querySelectorAll('.app_time');
    var app_time = $("#time").val();
    all_time_inputs.forEach((e)=>{
        $(e).val(app_time);
    });
});



// function setDate(){
//     var app_date = $("#app-date").val();
//     $("#app-date-val").val(app_date);
//     console.log($("#app-date-val").val());
// }

// function setTime(){
//     var app_time = $("#time").val();
//     $("#app-time-val").val(app_time);
//     console.log($("#app-time-val").val());
// }

// $("#app-date").change(function(){
//     console.log("hello");
//     var app_date = $("#app-date").val();
//     $("#book-form #app-date-val").val(app_date);
//     console.log($("#book-form #app-date-val").val());
    
// });

// $("#time").change(function(){
//     var app_time = $("#time").val();
//     $("#book-form #app-time-val").val(app_time);
//     console.log($("#book-form #app-time-val").val());
// });


// $("#xyz").click(function(e){
//     $("#app-date-val").val($("#app-date").val());
//     $("#app-time-val").val($("#time").val());

//     console.log("hellosdfjlk");
//     console.log("hellosdfjlk");
//     console.log($("#app-time-val").val());
//     console.log($("#app-date-val").val());
//     alert($("#app-time-val").val());
//     alert($("#app-date-val").val());  
// });
 
