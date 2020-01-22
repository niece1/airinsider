/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("comments",require("./components/comments.vue").default);
Vue.component("likes",require("./components/likes.vue").default);
Vue.component("subscription",require("./components/subscription.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

//Navigation
$(document).ready(function() {

    $(".menu-toggle").click(function() {
        $("nav").toggleClass("active");
    });

    $("ul li").click(function() {
        $(this)
            .siblings()
            .removeClass("active");
        $(this).toggleClass("active");
    });

    $(document).mouseup(function(e) {
        var div = $("ul li");
        if(!div.is(e.target) && div.has(e.target).length === 0){div.removeClass("active");}
    });

    // Hamburger icon animation
    $(".menu-toggle").on("click", function() {
        $(".hamburger-menu").toggleClass("animate");
    });


    //Parallax
$(window).scroll(function() {
    var st = $(this).scrollTop();
    $('.parallax-text').css({
        'transform' : 'translate(0%, ' + st + '%'
    });
});
//Sticky Navigation
$(window).scroll(function(event) {
  if($(this).scrollTop() > 300) {
    $("header").fadeIn();
    $("header").addClass('fixed');
  }
  else {
    $("header").removeClass('fixed')
  }
});

$(".contact-slider-wrapper").slick({
      infinite:true,
      draggable: true,
      dots: false,
      arrows: true,
      autoplay: false,
      slidesToShow: 4,
      slidesToScroll: 1,
      speed: 1000,
      autoplaySpeed: 2000,
      pauseOnDotsHover:true,
      pauseOnHover:false,
      cssEase: 'ease',
      prevArrow: $('#left-arrow'),
      nextArrow: $('#right-arrow'),
      responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    },   
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
      
    });


});

//Sticky sidebar
$(".sidebar").stick_in_parent({offset_top: 120});





