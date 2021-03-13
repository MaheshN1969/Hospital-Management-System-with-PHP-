(function($) {
    "use strict";
    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            console.log(path);
            //var patharr = path.split("/");
            if (this.href === path) {
                $(this).addClass("active");
            }
        });
    
    // Toggle the side navigation
});

$("#sidebarToggle").on("click", function(e) {
    e.preventDefault();
    $("body").toggleClass("sb-sidenav-toggled");
});