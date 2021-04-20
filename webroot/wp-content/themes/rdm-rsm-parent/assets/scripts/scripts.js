$(window).on("load resize",function(e){
    if (window.innerWidth < 768){
        $( ".dropdown").find('.dropdown-menu').removeClass('dropdown-menu').addClass('dropdown-mob');
        $( "header nav ").removeClass('fixed-top');
    }else{
        $( ".dropdown").find('.dropdown-mob').removeClass('dropdown-mob').addClass('dropdown-menu');
        $( "header nav ").addClass('fixed-top');
        $('.navbar').addClass("nav-bg").removeClass("nav-bg-active");
    }
})

$(".navbar-toggler").click(function() {
    if ( $('.navbar').hasClass('navbar') ) {
        $('.navbar').toggleClass("nav-bg nav-bg-active");
    }
});


