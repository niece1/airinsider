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

Vue.component("comments", require("./components/comments.vue").default);
Vue.component("likes", require("./components/likes.vue").default);
Vue.component("subscription", require("./components/subscription.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});

/**
 * nearby.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2018, Codrops
 * http://www.codrops.com
 */
{
    /**
     * Distance between two points P1 (x1,y1) and P2 (x2,y2).
     */
    const distancePoints = (x1, y1, x2, y2) =>
        Math.sqrt((x1 - x2) * (x1 - x2) + (y1 - y2) * (y1 - y2));

    // from http://www.quirksmode.org/js/events_properties.html#position
    const getMousePos = e => {
        var posx = 0,
            posy = 0;
        if (!e) var e = window.event;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY) {
            posx =
                e.clientX +
                document.body.scrollLeft +
                document.documentElement.scrollLeft;
            posy =
                e.clientY +
                document.body.scrollTop +
                document.documentElement.scrollTop;
        }
        return { x: posx, y: posy };
    };

    class Nearby {
        constructor(el, options) {
            this.DOM = { el: el };
            this.options = options;
            this.init();
        }
        init() {
            this.mousemoveFn = ev =>
                requestAnimationFrame(() => {
                    const mousepos = getMousePos(ev);
                    const docScrolls = {
                        left:
                            document.body.scrollLeft +
                            document.documentElement.scrollLeft,
                        top:
                            document.body.scrollTop +
                            document.documentElement.scrollTop
                    };
                    const elRect = this.DOM.el.getBoundingClientRect();
                    const elCoords = {
                        x1: elRect.left + docScrolls.left,
                        x2: elRect.width + elRect.left + docScrolls.left,
                        y1: elRect.top + docScrolls.top,
                        y2: elRect.height + elRect.top + docScrolls.top
                    };
                    const closestPoint = { x: mousepos.x, y: mousepos.y };

                    if (mousepos.x < elCoords.x1) {
                        closestPoint.x = elCoords.x1;
                    } else if (mousepos.x > elCoords.x2) {
                        closestPoint.x = elCoords.x2;
                    }
                    if (mousepos.y < elCoords.y1) {
                        closestPoint.y = elCoords.y1;
                    } else if (mousepos.y > elCoords.y2) {
                        closestPoint.y = elCoords.y2;
                    }
                    if (this.options.onProgress) {
                        this.options.onProgress(
                            distancePoints(
                                mousepos.x,
                                mousepos.y,
                                closestPoint.x,
                                closestPoint.y
                            )
                        );
                    }
                });

            window.addEventListener("mousemove", this.mousemoveFn);
        }
    }

    window.Nearby = Nearby;
}

// Pulsing heart footer animation Green Sock Animation platform

const lineEq = (y2, y1, x2, x1, currentVal) => {
    // y = mx + b
    var m = (y2 - y1) / (x2 - x1),
        b = y1 - m * x1;
    return m * currentVal + b;
};

const distanceThreshold = { min: 0, max: 100 };

/**************** Heart Icon ****************/
const iconHeart = document.querySelector(".icon--heart");
const iconHeartButton = iconHeart.parentNode;
const heartbeatInterval = { from: 1, to: 40 };
const grayscaleInterval = { from: 1, to: 0 };

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
        if (!div.is(e.target) && div.has(e.target).length === 0) {
            div.removeClass("active");
        }
    });

    // Hamburger icon animation
    $(".menu-toggle").on("click", function() {
        $(".hamburger-menu").toggleClass("animate");
    });

    //Fullscreen search menu
    $("#search").click(function() {
        $(".search-overlay").css("width", "100%");
    });

    $(".close-search").click(function() {
        $(".search-overlay").css("width", "0%");
    });

    //Parallax
    $(window).scroll(function() {
        var st = $(this).scrollTop();
        $(".parallax-text").css({
            transform: "translate(0%, " + st + "%"
        });
    });

    //Sticky Navigation
    $(window).scroll(function(event) {
        if ($(this).scrollTop() > 300) {
            $("header").addClass("fixed");
        } else {
            $("header").removeClass("fixed");
        }
    });

    //Slick slider
    $(".contact-slider-wrapper").slick({
        infinite: true,
        draggable: true,
        dots: false,
        arrows: true,
        autoplay: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 1000,
        autoplaySpeed: 2000,
        pauseOnDotsHover: true,
        pauseOnHover: false,
        cssEase: "ease",
        prevArrow: $("#left-arrow"),
        nextArrow: $("#right-arrow"),
        responsive: [
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1050,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});

//Sticky sidebar
$(".sidebar").stick_in_parent({ offset_top: 120 });
