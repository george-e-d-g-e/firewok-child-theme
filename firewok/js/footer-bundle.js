"use strict";var firewok={showMenu:!1};function makeHeader(){var e=document.getElementById("masthead"),t="max";return{grow:function(){t="max",toggleClass(e,"min")},shrink:function(){toggleClass(e,t="min")},getType:function(){return t}}}function toggleMenu(){var e=document.getElementById("masthead");document.getElementById("hamburger-mobile").addEventListener("click",function(){toggleClass(e,"active"),toggleBodyScroll(e)},!0)}function addMegaMenu(){var l=document.getElementsByClassName("mega-menu")[0];l.firstChild&&function(){for(var e=document.getElementsByClassName("primary-navigation"),t=document.getElementById("contact-info"),n=e[0].getElementsByClassName("menu-item"),o=document.getElementById("mega-menu-back-btn"),a=n.length-1;0<=a;a--){if("Shop"==n[a].firstChild.innerText)window.matchMedia("(max-width: 767px)").matches?(n[a].addEventListener("click",function(e){e.preventDefault(),toggleClass(l,"active"),toggleClass(t,"hide")}),o.addEventListener("click",function(e){e.preventDefault(),toggleClass(l,"active"),toggleClass(t,"hide")})):(n[a].matches(":hover")&&l.classList.add("active"),n[a].addEventListener("mouseenter",function(){toggleClass(l,"active"),toggleClass(t,"hide")},!1),n[a].addEventListener("mouseleave",function(){toggleClass(l,"active"),toggleClass(t,"hide")},!1))}}()}function toggleClass(e,t){e.classList.toggle(t)}function toggleBodyScroll(e){firewok.showMenu=!firewok.showMenu,!1===firewok.showMenu?console.log("disable"):console.log("enable")}function updateVarForm(){if(0!==document.getElementsByClassName("variations_form").length){updateVarPrice();for(var e=document.querySelectorAll(".variations select"),t=e.length-1;0<=t;t--)e[t].addEventListener("change",function(){updateVarPrice()},!0)}}function updateVarPrice(){var n=0,o=setInterval(function(){var e=document.querySelectorAll(".summary p.price"),t=document.querySelectorAll(".woocommerce-variation-price span.price span.amount");0!==t.length&&(console.log(e[0].textContent),e[0].textContent!==t[0].lastChild.textContent&&(e[0].textContent="£"+t[0].lastChild.textContent,window.clearInterval(o))),5<n&&window.clearInterval(o),n++},200)}function displayAllTabs(){var e=document.getElementsByClassName("woocommerce-tabs");if(0<e.length){e=e[0].getElementsByClassName("wc-tab");for(var t=0;t<e.length;t++)e[t].style.display="block"}}window.onload=function(){addMegaMenu(),firewok.header=makeHeader(),updateVarForm(),toggleMenu(),displayAllTabs()},window.onscroll=function(e){if(firewok.header){var t=e.target.scrollingElement.scrollTop;0==t&&"min"==firewok.header.getType()?firewok.header.grow():0<t&&"max"==firewok.header.getType()&&firewok.header.shrink()}},function(e){e(document).ready(function(){0<e(".commentlist").length&&(e(".commentlist").slick({slidesToShow:2,slidesToScroll:2,dots:!0,adaptiveHeight:!0,speed:500,responsive:[{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]}),e("#review_form_wrapper")&&(e("#reviews").append('<a class="button" id="review-form-btn"> Add Review </a>'),e("#reviews").delegate(e("#review-form-btn"),"click",function(){e("#review-form-btn").css("display","none"),e("#review_form_wrapper").css("height","auto")})))})}(jQuery);