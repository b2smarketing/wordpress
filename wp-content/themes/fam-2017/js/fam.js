(() => {
	var $ = jQuery;

	// Tab Controller via Hash
	$(document).ready(() => {
		// Javascript to enable link to tab
		var url = document.location.toString();
		if (url.match('#')) {
		    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
		    window.location.hash = e.target.hash;
		})
	});

	/********************************************************************
	 * Dropdown Sexy
	 */

	$('ul.nav li.dropdown').hover(function() {
		$(this).children('.dropdown-menu').stop(true, true).delay(200).toggle(300);
	}, function() {
		$(this).children('.dropdown-menu').stop(true, true).fadeOut(200);
    });
    
    // Original
	// $('ul.nav li.dropdown').hover(function() {
	// 	$(this).children('.dropdown-menu').stop(true, true).delay(100).fadeIn(200);
	// }, function() {
	// 	$(this).children('.dropdown-menu').stop(true, true).delay(100).fadeOut(200);
    // });
    
    $(".menu-item").on("click", function() {
        if ($(this).children("a")[0].attr("href") === "#")
            return false;
    })
    $(".dropdown-toggle").on("click", function() {
        return false;
    })

	/********************************************************************
	 * Parallax
	 */

	$(document).ready(function () {
		$('#slide').mousemove(function (e) {
			parallax(e, document.getElementById('slideMan'), 2);
		});
	});

	function parallax(e, target, layer) {
		if (!target)
			return;

		var layer_coeff = 100 / layer;
		var x = ($(window).width() - target.offsetWidth) / 4 - (e.pageX - ($(window).width() / 4)) / layer_coeff;
		var y = ($(window).height() - target.offsetHeight) / 0 - (e.pageY - ($(window).height() / 0)) / layer_coeff;
		$(target).offset({
			top: y
			, left: x
		});
	};

	$(document).ready(() => {
		window.go_sticky('.header');
	});

	var owl = $('.owl-carousel');
	owl.owlCarousel({
		items: 1,
		loop: true,
		autoplay: true,
		autoplayTimeout: 3000,
		URLhashListener:true,
    	autoplayHoverPause:true,
    	startPosition: 'URLHash',
	});

	/********************************************************************
	 * WoW Effects
	 */

	wow = new WOW({
		animateClass: 'animated',
		offset: 100,
		callback: function(box) {
			console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
		}
	});
	wow.init();
	// document.getElementById('moar').onclick = function() {
	// 	var section = document.createElement('section');
	// 	section.className = 'section--purple wow fadeInDown';
	// 	this.parentNode.insertBefore(section, this);
	// };

	/********************************************************************
	 * Scroller
	 */

	jQuery(document).ready(function($) {
		$(".scroll").click(function(event) {
			event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 800);
		});
	});

	/********************************************************************
	 * Acessibilidade
	 */

	jQuery(document).ready(function ($) {
		let cookie = {
			set (cname, cvalue, exdays) {
			    var d = new Date();
			    d.setTime(d.getTime() + (exdays*24*60*60*1000));
			    var expires = "expires="+ d.toUTCString();
			    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			},
			get (cname) {
			    var name = cname + "=";
			    var decodedCookie = decodeURIComponent(document.cookie);
			    var ca = decodedCookie.split(';');
			    for(var i = 0; i <ca.length; i++) {
			        var c = ca[i];
			        while (c.charAt(0) == ' ') {
			            c = c.substring(1);
			        }
			        if (c.indexOf(name) == 0) {
			            return c.substring(name.length, c.length);
			        }
			    }
			    return "";
			}
		};

		var zoom = cookie.get('acessibilidade-zoom') || 1.0;
		document.body.style.zoom = zoom;

		window.a11y = {
			zoomIn () {
				document.body.style.zoom = parseFloat(document.body.style.zoom) + 0.1;
				cookie.set('acessibilidade-zoom', document.body.style.zoom);
			},
			zoomOut () {
				document.body.style.zoom = parseFloat(document.body.style.zoom) - 0.1;
				cookie.set('acessibilidade-zoom', document.body.style.zoom);
			},
			zoomReset () {
				document.body.style.zoom = 1.0;
				cookie.set('acessibilidade-zoom', document.body.style.zoom);
			}
		};
	});

	/********************************************************************
	 * Menu para cima
	 */

	jQuery(document).ready(function ($) {
		let testOpenUp = () => {
			if ($(window).scrollTop() < ($('header.header').offset().top / 2))
				$('body').addClass('open-up');
			else
				$('body').removeClass('open-up');
		};
		
		$(window).on('scroll', testOpenUp);
        testOpenUp();
        
        $(window).on('scroll', function() {
            var posicaoHeaderTopo = document.getElementById("header").getBoundingClientRect().top;
            var tamanhoScrollAtual = document.documentElement.scrollTop;
            var alturaDaAreaVisivel = document.documentElement.clientHeight;

            if (posicaoHeaderTopo === 0) {
                if ($('#header').hasClass('home')) {
                    if (tamanhoScrollAtual > (alturaDaAreaVisivel)) {
                        $('#header').addClass("coladoNoTopo");
                    } else {
                        $('#header').removeClass("coladoNoTopo");
                    }
                } else {
					if (tamanhoScrollAtual > 0) {
						$('#header').addClass("coladoNoTopo");
					} else {
						$('#header').removeClass("coladoNoTopo");
					}
                }
            } else {
                $('#header').removeClass("coladoNoTopo");
            }
        });
	});
})();