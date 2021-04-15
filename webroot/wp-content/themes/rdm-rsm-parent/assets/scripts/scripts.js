$(window).on("load resize",function(e){
    if (window.innerWidth < 768){
        $( ".dropdown").find('.dropdown-menu').removeClass('dropdown-menu').addClass('dropdown-mob');
    }else{
        $( ".dropdown").find('.dropdown-mob').removeClass('dropdown-mob').addClass('dropdown-menu');
    }
})

$(".navbar-toggler").click(function() {
    if ( $('.navbar').hasClass('nav-bg') ) {
        $('.navbar').toggleClass("nav-bg nav-bg-active");
    }
});