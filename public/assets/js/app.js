$(".menu").click(function(a){a.preventDefault(),$(this).toggleClass("open"),$(".header-nav").stop().slideToggle()}),$(".settings-dropdown").click(function(a){a.preventDefault(),$(".dropdown-toggle").stop().slideToggle()}),$(window).on("resize",function(){$(window).width()>=768?($(".header-nav").css("display","block"),$(".menu").removeClass("open")):$(window).width()<768&&$(".header-nav").css("display","none")}),$(".tabgroup > div").hide();var rightTab=$(".profile--tabs .active").attr("data-tabID"),solTab=$(".task--tabs .active").attr("data-tabID");$(".tabgroup #tab"+rightTab).show(),$(".task-tabs #tab1").show(),$(".settings-tabs #tab1").show(),$(".tabs a").click(function(a){a.preventDefault();var e=$(this),t="#"+e.parents(".tabs").data("tabgroup"),s=e.closest("li").siblings().children("a"),i=e.attr("href");s.removeClass("active"),e.addClass("active"),$(t).children("div").hide(),$(i).show()}),$("#profile_pic").on("change",function(){var a=this.files[0],e=a.type,t=["image/jpeg","image/png"];if($.inArray(e,t)<0);else{var s=new FileReader;s.onload=function(a){$(".user--img").css("background-image","url('"+a.target.result+"')")},s.readAsDataURL(this.files[0])}});