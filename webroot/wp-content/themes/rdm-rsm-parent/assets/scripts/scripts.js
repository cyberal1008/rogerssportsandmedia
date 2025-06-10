$(window).on("load resize",function(e){
    if (window.innerWidth < 768){
        $( ".dropdown").find('.dropdown-menu').removeClass('dropdown-menu').addClass('dropdown-mob');
        //$( "header nav ").removeClass('fixed-top');
        $(".date-mobile").html(function () {
            return $(this).html().replace("/", "<br>"); 
        });
    }else{
        $( ".dropdown").find('.dropdown-mob').removeClass('dropdown-mob').addClass('dropdown-menu');
        //$( "header nav ").addClass('fixed-top');
        $('.navbar').addClass("nav-bg").removeClass("nav-bg-active");
        $(".date-mobile").html(function () {
            return $(this).html().replace("<br>", "/"); 
        });
    }
})

$(".navbar-toggler").click(function() {
    if ( $('.navbar').hasClass('navbar') ) {
        $('.navbar').toggleClass("nav-bg nav-bg-active");
    }
});

document.addEventListener('DOMContentLoaded', () => {
  const toggler = document.querySelector('.navbar-toggler');

  toggler.addEventListener('click', () => {
    // Small delay to wait for Bootstrap's internal update
    setTimeout(() => {
      const isOpen = toggler.getAttribute('aria-expanded') === 'true';

      if (isOpen) {
        console.log('Navbar is open');
        document.body.classList.add('no-scroll');
      } else {
        console.log('Navbar is closed');
        document.body.classList.remove('no-scroll');
      }
    }, 100); // ~instant; Bootstrap updates aria-expanded synchronously
  });
});
