$(document).ready(function () {
    $("#due-section-btn").click(function (e) { 
        e.preventDefault();
        $("#paid-section").hide();
        $("#due-section").slideDown("slow","swing");
    });

    $("#paid-section-btn").click(function (e) { 
        e.preventDefault();
        $("#due-section").hide();
        $("#paid-section").slideDown("slow","swing");
    });
});