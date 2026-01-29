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

$(".navbar-toggler").on('click', function() {
    if ( $('.navbar').hasClass('navbar') ) {
        $('.navbar').toggleClass("nav-bg nav-bg-active");
    }
});

$(".nav-link").on('click', function() {
  if ( $('#navbarSupportedContent').hasClass('show') ) {
      $('#navbarSupportedContent').toggleClass("show");
  }
      
  if ( $('.navbar-toggler').hasClass('collapsed') ) {
      $('.navbar-toggler').toggleClass("collapsed");
  }

  const toggler = document.querySelector('.navbar-toggler');
  if (window.getComputedStyle(toggler).display !== 'none') {
    let expanded = $('.navbar-toggler').attr('aria-expanded') === 'true';
    $('.navbar-toggler').attr('aria-expanded', expanded ? 'false' : 'true');
    $('.navbar').toggleClass("nav-bg nav-bg-active");
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const toggler = document.querySelector('.navbar-toggler');
  toggler.addEventListener('click', toggleScroll);

  document.querySelectorAll('.page-template-page_admanager_v3 a').forEach(link => {
    link.addEventListener('click', function(e) {
      const href = link.getAttribute('href');
      if (href.startsWith('#')) {
        e.preventDefault();
        toggleScroll(this);
      }
    });
  });
});

function toggleScroll(link) {
  // Small delay to wait for Bootstrap's internal update
  setTimeout(() => {
    const toggler = document.querySelector('.navbar-toggler');
    const isOpen = toggler.getAttribute('aria-expanded') === 'true';
    if (isOpen) {
      document.body.classList.add('no-scroll');
    } else {
      document.body.classList.remove('no-scroll');
      if(link){
        const target = document.querySelector(link.getAttribute('href'));
        const offset = window.innerWidth >= 768 ? 106 : 66; // your offset amount

        const y = target.getBoundingClientRect().top + window.pageYOffset - offset;

        window.scrollTo({
          top: y,
          behavior: 'smooth'
        });
      }
    }
  }, 100); // ~instant; Bootstrap updates aria-expanded synchronously
}
