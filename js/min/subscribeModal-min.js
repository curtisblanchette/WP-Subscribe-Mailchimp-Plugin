jQuery(document).ready(function($){function e(e){e=e||window.event,e.preventDefault&&e.preventDefault(),e.returnValue=!1}function n(n){for(var t=u.length;t--;)if(n.keyCode===u[t])return void e(n)}function t(n){e(n)}function i(){window.addEventListener&&window.addEventListener("DOMMouseScroll",t,!1),window.onmousewheel=document.onmousewheel=t,document.onkeydown=n}function o(){window.removeEventListener&&window.removeEventListener("DOMMouseScroll",t,!1),window.onmousewheel=document.onmousewheel=document.onkeydown=null}var s=function(){var e={},n,t,s;return $("#thmlvContent").addClass("transition-blur"),e.center=function(){var e,t;e=Math.max($(window).height()-n.outerHeight(),0)/2,t=Math.max($(window).width()-n.outerWidth(),0)/2,n.css({top:e+$(window).scrollTop(),left:t+$(window).scrollLeft(),height:$(window).height()})},e.open=function(o){t.empty().append(o.content),n.css({width:o.width||"100%",height:o.height||"100%",top:"0"}),e.center(),$(window).bind("resize.modal",e.center),$("#thmlvContent").addClass("blur"),$(".subscribeToggle").css("opacity",0),i()},e.close=function(){n.css("top","-100%"),$(window).unbind("resize.modal"),$("#thmlvContent").removeClass("blur"),$(".subscribeToggle").css("opacity",1),o()},n=$('<div id="subscribeContainer"></div>'),t=$('<div id="subscribeContent"></div>'),s=$('<a id="closeModal" href="#"><i class="fa fa-close"></i></a>'),n.append(t,s),$(document).ready(function(){$("body").append(n)}),s.click(function(n){n.preventDefault(),e.close()}),e}(),r=curts_vars.setting_1,a=curts_vars.setting_2,d="<h1 class='subscribe-head'>"+r+"</h1>",c="<p class='subscribe-body'>"+a+"</p>",l="<form class='subscribe-form' id='subscribe' name='mc-embedded-subscribe-form' action='#' method='get'><span id='response'><? require_once('mailchimp-api/inc/store-address.php'); if($_GET['submit']){ echo storeAddress(); } ?></span><input type='email' id='email' name='email' style='width:75%; margin-right:5%;' placeholder='Email Address' name='email'/><input name='submit' type='submit' style='width:20%;' value='Subscribe'/></form>";$(".subscribeToggle").click(function(e){s.open({content:d+c+l}),e.preventDefault(),$("#subscribe").submit(function(e){return e.preventDefault(),$("#response").html("Adding email address..."),$.ajax({url:"http://localhost:8888/politik.io/wp-content/plugins/curts-modal-overlay/mailchimp-api/inc/store-address.php",data:"ajax=true&email="+escape($("#email").val()),success:function(e){$("#response").html(e)}}),!1})});var u=[38,40]});