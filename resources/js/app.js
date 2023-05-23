require("./bootstrap");

window.Vue = require("vue");

Vue.component("comments", require("./components/comments.vue").default);
Vue.component("likes", require("./components/likes.vue").default);

const app = new Vue({
  el: "#app"
});

import nearby from "./nearby.js";

// Pulsing heart footer animation Green Sock Animation platform
const lineEq = (y2, y1, x2, x1, currentVal) => {
  // y = mx + b
  var m = (y2 - y1) / (x2 - x1),
    b = y1 - m * x1;
  return m * currentVal + b;
};

const distanceThreshold = {min: 0, max: 100};

/**************** Heart Icon ****************/
const iconHeart = document.querySelector(".icon--heart");
const iconHeartButton = iconHeart.parentNode;
const heartbeatInterval = {from: 1, to: 40};
const grayscaleInterval = {from: 1, to: 0};

const tweenHeart = TweenMax.to(iconHeart, 5, {
  yoyoEase: Power2.easeOut,
  repeat: -1,
  yoyo: true,
  scale: 1.3,
  paused: true
});

let stateHeart = "paused";
new Nearby(iconHeartButton, {
  onProgress: distance => {
    const time = lineEq(
      heartbeatInterval.from,
      heartbeatInterval.to,
      distanceThreshold.max,
      distanceThreshold.min,
      distance
      );
    tweenHeart.timeScale(
      Math.min(
        Math.max(time, heartbeatInterval.from),
        heartbeatInterval.to
        )
      );
    if (
      distance < distanceThreshold.max &&
      distance >= distanceThreshold.min &&
      stateHeart !== "running"
      ) {
      tweenHeart.play();
      stateHeart = "running";
    } else if (
      (distance > distanceThreshold.max ||
        distance < distanceThreshold.min) &&
      stateHeart !== "paused"
      ) {
      tweenHeart.pause();
      stateHeart = "paused";
      TweenMax.to(iconHeart, 0.2, {
        ease: Power2.easeOut,
        scale: 1,
        onComplete: () => tweenHeart.time(0)
      });
    }

    const bw = lineEq(
      grayscaleInterval.from,
      grayscaleInterval.to,
      distanceThreshold.max,
      distanceThreshold.min,
      distance
      );
    TweenMax.to(iconHeart, 1, {
      ease: Power2.easeOut,
      filter: `grayscale(${Math.min(bw, grayscaleInterval.from)})`
    });
  }
});

$(document).ready(function () {
  //Navigation
  $(".menu-toggle").click(function () {
    $("nav").toggleClass("active");
  });
  $("ul li").click(function () {
    $(this)
      .siblings()
      .removeClass("active");
    $(this).toggleClass("active");
  });
  $(document).mouseup(function (e) {
    var div = $("ul li");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
      div.removeClass("active");
    }
  });

  // Hamburger icon animation
  $(".menu-toggle").on("click", function () {
    $(".hamburger-menu").toggleClass("animate");
  });

  //Fullscreen search menu
  $("#search").click(function () {
    $(".search-overlay").css("display", "block");
  });
  $(".close-search").click(function () {
    $(".search-overlay").css("display", "none");
  });

  //Parallax
  $(window).scroll(function () {
    var st = $(this).scrollTop();
    $(".parallax-text").css({
      transform: "translate(0%, " + st + "%"
    });
  });
});

//Sticky Navigation
$(window).scroll(function (event) {
  if ($(this).scrollTop() > 300) {
    $("header").addClass("fixed");
  } else {
    $("header").removeClass("fixed");
  }
});

//Fullscreen search underline animation
const wrapper = document.querySelector(".input-wrapper"),
  textInput = document.querySelector("input#search");
textInput.addEventListener("keyup", event => {
  wrapper.setAttribute("data-text", event.target.value);
});