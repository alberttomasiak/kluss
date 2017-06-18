$(".menu").click(function(e){
    e.preventDefault();
  $(this).toggleClass("open");
  $('.header-nav').stop().slideToggle();
});

$('.settings-dropdown').click(function(e){
    e.preventDefault();
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

$('.tabgroup > div').hide();
var rightTab = $('.profile--tabs .active').attr('data-tabID');
var solTab = $('.task--tabs .active').attr('data-tabID');
$('.tabgroup #tab'+rightTab).show();
$('.task-tabs #tab1').show();

$('.tabs a').click(function(e){
  e.preventDefault();
    var $this = $(this),
        tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
        others = $this.closest('li').siblings().children('a'),
        target = $this.attr('href');
    others.removeClass('active');
    $this.addClass('active');
    $(tabgroup).children('div').hide();
    $(target).show();
})
