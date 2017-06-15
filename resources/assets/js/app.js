$(".menu").click(function(e){
    e.preventDefault();
  $(this).toggleClass("open");
  $('.header-nav').stop().slideToggle();
});

$('.settings-dropdown').click(function(e){
    e.preventDefault();
    console.log('I get here');
    $('.dropdown-toggle').stop().slideToggle();
});

$(window).on("resize", function(){
    if($(window).width() >= 768){
        $('.header-nav').css("display", "block");
        $('.menu').removeClass('open');
    }else if($(window).width() < 768){
        $('.header-nav').css("display", "none");
    }
});
