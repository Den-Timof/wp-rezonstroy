jQuery(function($) {

	/**
	 * Ленивая загрузка изображений
	 */
	$('img[data-src]').each(function() {
		$(this).attr('src', $(this).data('src') );
	});

	var site_url = $('input[name="siteUrl"]').val();

	/**
	 * "Общие". Настройка атрибутов у телефона (tel:+) и электронной почты (mailto:)
	 */
	$(document).ready(function() {
		$('a[href="tel:+"]').each(function (i, e) {
			var element = $(e).html().replace(/\D+/g, "");
			$(this).attr('href', 'tel:+' + element);
		});
		$('a[href="mailto:"]').each(function (i, e) {
			var element = $(e).html();
			$(this).attr('href', 'mailto:' + element);
		});
	});
	//

	/**
	 * Активный пункт меню
	 */
	$(document).ready(function() {
		$('.menu-fiksirovannoe-container .menu > .menu-item > a').each(function() {
			var wp_kama_breadcrumb = $('.kama_breadcrumbs').text();
			var arr_breadcrumb;
			arr_breadcrumb = wp_kama_breadcrumb.split('/');

			for (let index = 0; index < arr_breadcrumb.length; index++) {
				const element = arr_breadcrumb[index];
				
				if( element.trim() == $(this).text() ) {
					$(this).parent('li.menu-item').addClass('active');
					return false;
				}
			}
		});
	});

	/**
	 * Появление iframe в видимой области экрана
	 * @param {*} tag 
	 */
	function isVisible(tag) {
		var t = $(tag);
		var w = $(window);
		var wt = w.scrollTop();
		var tt = t.offset().top;
		var tb = tt + t.height();
		return ((tb <= wt + w.height()) && (tt >= wt));
	}
	$(function () {
		$(window).scroll(function () {
			
			var b = $("#map");
			if ( ($('body.home').length || $('body.page-template-template-page-contacts').length) && !b.prop("shown") && isVisible(b)) {
				// console.log('works');
				b.prop("shown", true);
				// loadYmaps()

				var address_name, map_name;
				address_name = $('#address').attr('class');
				map_name = $('#map').attr('id');
				
				if( $('iframe[src^="https://api-maps.yandex.ru/"]').length == 0 ) {
					$.getScript('//api-maps.yandex.ru/2.1/?lang=ru_RU', function() {
						loadYmaps(address_name, map_name);
					});
				} else {
					loadYmaps(address_name, map_name);
				}
			}
		});
	});

	/**
	 * Добавление карты по клику на странице контакты. Работа с Яндекс.Картами
	 */
	function loadYmaps( param_address, param_map ) {
		// Создание обработчика для события window.onLoad
		ymaps.ready(function() {
			// Создание экземпляра карты и его привязка к созданному контейнеру
			var myMap = new ymaps.Map(param_map, { 
				center: [0, 0], 
				zoom: 9
			});
	
			myMap.setType('yandex#map');
	
			var address = $('#' + param_address).html().replace('<br>', ',');
			// console.log(address);
	
			var coorCity;
			var destinations = {};
			destinations.City = '';
			var menuContainer = $('#' + param_address);
	
			for (var item in destinations) {
	
				ymaps.geocode(address, { results: 1 }).then(function (res) {
					coorCity = res.geoObjects.get(0).geometry.getCoordinates();
					destinations.City = coorCity;
					// console.log(destinations.City);
		
					// Используем замыкание, чтобы работать с конкретным свойством объекта
					(function (title, geoPoint) {
						// Создаем обработчик по щелчку на ссылке
						$('#' + param_address).bind('click', function() {
							// Перемещаем карту
							myMap.panTo(coorCity, {flying: true});
							return false;
						}).end().appendTo(menuContainer);
					})(item, destinations.City)
	
					// Центрируем карту на городе
					ymaps.geocode(destinations.City, { results: 1 }).then(function (res) {
						var firstGeoObject  = res.geoObjects.get(0);
						var bounds          = firstGeoObject.properties.get('boundedBy');
		
						myMap.geoObjects
							.add(firstGeoObject);

							myMap.geoObjects.removeAll()

						myMap.setBounds(bounds, { 
							checkZoomRange: true,
						}).then(function() { 
							myMap.setZoom(10);

							myMap.geoObjects.add(new ymaps.Placemark( myMap.getCenter() , {
									hintContent: 'Садовый центр "Флора маркет"',
								}, {
									// Опции.
									// Необходимо указать данный тип макета.
									iconLayout: 'default#image',
									// Своё изображение иконки метки.
									iconImageHref: site_url + '/wp-content/uploads/2019/06/icon-map.png',
									// Размеры метки.
									iconImageSize: [40, 50],
									// Смещение левого верхнего угла иконки относительно
									// её "ножки" (точки привязки).
									iconImageOffset: [-5, -38]
								}
							));

						});

					});
				});
			};

			myMap.controls.remove('zoomControl');
			myMap.controls.remove('fullscreenControl');
			myMap.controls.remove('geolocationControl');
			myMap.controls.remove('searchControl');
			myMap.controls.remove('trafficControl');
			myMap.controls.remove('typeSelector');
			myMap.controls.remove('rulerControl');

			// myMap.setZoom( 16 );
	
		});
		
	}

	/**
	 * Слайдеры
	 */
	if( $('body.single').length ) {
		$('.slider-for').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			fade: true,
			asNavFor: '.slider-nav',
			prevArrow: '<button type="button" class="s-slider-arrow slick-btn slick-prev"></button>',
			nextArrow: '<button type="button" class="s-slider-arrow slick-btn slick-next"></button>'
		});
		$('.slider-nav').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			asNavFor: '.slider-for',
			dots: false,
			arrows: false,
			centerMode: true,
			focusOnSelect: true,
			infinite: true,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		});
	}

	/**
	 * Домашняя страница. Как мы работаем
	 */
	if( $('body.home').length ) {
		let step_length = $('.step-block').length;
		$('.step-block').each(function() {
			$(this).find('.step-length').text( '/' + step_length );
		});
	}


	/**
	 * Скрипт с плавным переходом между якорями
	 */
	if( $('body.home').length ) {
		$(function () {
			$.scrollIt({
				upKey: 38,
				downKey: 40,
				easing: 'linear',
				scrollTime: 600,
				activeClass: 'active',
				onPageChange: null,
				topOffset: 0
			});
		});
	}

	/**
	 * Залипание навигационной меню между областями
	 */
	if( $('body.home').length ) {
		$("#menuFullPage").stick_in_parent({
			parent: '#fullPage',
			offset_top: 300
		});
	}

	/**
	 * cookcodesmenu
	 */
	var phone_company = $('#phone-company').text();
	$(function() {
		$('#menu-fiksirovannoe').cookcodesmenu({
			display: 3840,
			brand: '<a href="tel:+">' + phone_company + '</a>',
			label: '',
			closedSymbol: "<img src='"+site_url+"/wp-content/themes/rezonstroy/assets/img/icon/icon-arrow-down-closed.png' alt=''>",
			openedSymbol: "<img src='"+site_url+"/wp-content/themes/rezonstroy/assets/img/icon/icon-arrow-up-open.png' alt=''>",
			init: function() {
				if(window.matchMedia('(min-width: 992px)').matches){
					$('.cookcodesmenu_menu').addClass('d-none');
					$('.cookcodesmenu_menu').css('opacity', '0');
					$('.cookcodesmenu_brand').after( $('.hidden-rows .logotype__link') );
				};
			},
		});
	});

	/**
	 * Работа скрола
	 */
	if(window.matchMedia('(min-width: 992px)').matches){
		var switch_var = 0;
		
		$(document).scroll(function() {
	
			var topmenu = $('.fixed-head');
			var section_first_screen = $('.section-first-screen');
			
			var mobile_menu = $('.cookcodesmenu_menu');
			var offset_topmenu = topmenu.offset().top;
	
			if( ( offset_topmenu > 0 ) && (switch_var == 0) ) {
				topmenu.fadeOut();
				mobile_menu.removeClass('d-none');
				mobile_menu.addClass('mx-auto');
	
				$(mobile_menu).animate({
					opacity: 1
				}, 500);
				
				switch_var = 1;
			}
			else if( (offset_topmenu == 0) ) {
				topmenu.fadeIn();
				
				$(mobile_menu).animate({
					opacity: 0
				}, 500, function() {
					mobile_menu.addClass('d-none');
					mobile_menu.removeClass('mx-auto');
				});
	
				switch_var = 0;
			}
			
		});
	}


	/**
	 * Примеры работ
	 */
	$(function () {
		var switch_var = 0;
		$(window).scroll(function () {
			
			var b = $(".section-projects");
			if ( $('body.home').length && !b.prop("shown") && isVisible(b) && (switch_var == 0) ) {

				// fancybox js
				$.getScript( site_url + '/wp-content/themes/rezonstroy/assets/plugins/fancybox/dist/jquery.fancybox.min.js', function() {
					// fancybox css
					let link_elem = $('head link#rezonstroy-fancybox-css');
					if( link_elem.length == 0 ) {
						let style_elem	= document.createElement('link');
						style_elem.id		= 'rezonstroy-fancybox-css';
						style_elem.rel = 'stylesheet';
						style_elem.type = 'text/css';
						style_elem.href	= site_url + '/wp-content/themes/rezonstroy/assets/plugins/fancybox/dist/jquery.fancybox.min.css';
						document.head.appendChild(style_elem);
					}
				});
				
				// jquery event move js
				$.getScript( site_url + '/wp-content/themes/rezonstroy/assets/plugins/twentytwenty-master/js/jquery.event.move.min.js', function() {
					// twentytwenty js
					$.getScript( site_url + '/wp-content/themes/rezonstroy/assets/plugins/twentytwenty-master/js/jquery.twentytwenty.min.js', function() {

						// twentytwenty css
						let link_elem = $('head link#rezonstroy-twentytwenty-css');
	
						if( link_elem.length == 0 ) {
							let style_elem	= document.createElement('link');
							style_elem.id		= 'rezonstroy-twentytwenty-css';
							style_elem.rel = 'stylesheet';
							style_elem.type = 'text/css';
							style_elem.href	= site_url + '/wp-content/themes/rezonstroy/assets/plugins/twentytwenty-master/css/twentytwenty.min.css';
							document.head.appendChild(style_elem);
						}

						// jcImgScroll js
						$.getScript( site_url + '/wp-content/themes/rezonstroy/assets/plugins/jcImgScroll/js/jQuery-jcImgScroll.min.js', function() {

								/**
								 * До / После
								 */
								$(".twentytwenty-container").twentytwenty({
									default_offset_pct: 0.7,
									orientation: 'horizontal',
									before_label: 'До',
									after_label: 'После',
									no_overlay: true,
									// move_slider_on_hover: true,
									move_with_handle_only: true,
									click_to_move: false
								});

								/**
								 * jcImgScroll - Media Query
								 */
								if( window.matchMedia('(min-width: 1600px)').matches ) {
										$("#jcImgScroll-demo").jcImgScroll({
											speed: 400, 
											width: 1172, 
											height: 692, 
											loadClass: "loading", 
											position: "center",
											arrow : {  
													width	:	60,
													height:	60,
											},
											count		: 5,
											offsetX	: 100,
											NumBtn	: true,
											title		:	false 
										});
								}
								else if(window.matchMedia('(min-width: 1200px)').matches){
									
										$("#jcImgScroll-demo").jcImgScroll({
											speed: 400, 
											width: 800, 
											height: 400, 
											loadClass: "loading", 
											position: "center",
											arrow : {  
													width	:	60,
													height:	60,
											},
											count		: 5,
											offsetX	: 100,
											NumBtn	: true,
											title		:	false 
										});
								}
								else if(window.matchMedia('(min-width: 992px)').matches) {
									
										$("#jcImgScroll-demo").jcImgScroll({
											speed: 400, 
											width: 600, 
											height: 300, 
											loadClass: "loading", 
											position: "center",
											arrow : {
													width	:	60,
													height:	60,
											},
											count		: 3,
											offsetX	: 100,
											NumBtn	: true,
											title		:	false 
										});
								}
								else if(window.matchMedia('(min-width: 768px)').matches)  {
									$("#jcImgScroll-demo").jcImgScroll({
										speed: 400, 
										width: 700, 
										height: 350, 
										loadClass: "loading", 
										position: "center",
										arrow : {  
											width	:	70,
											height:	80,
										},
										count		: 1,
										offsetX	: 100,
										NumBtn	: true,
										title		:	false 
									});
								}
								else if(window.matchMedia('(min-width: 576px)').matches) {
									$("#jcImgScroll-demo").jcImgScroll({
										speed: 400, 
										width: 500, 
										height: 275, 
										loadClass: "loading", 
										position: "center",
										arrow : {  
											width	:	70,
											height:	80,
										},
										count		: 1,
										offsetX	: 100,
										NumBtn	: true,
										title		:	false 
									});
								}
								else if(window.matchMedia('(max-width: 575.98px)').matches) {
									$("#jcImgScroll-demo").jcImgScroll({
										speed: 400, 
										width: 300, 
										height: 160, 
										loadClass: "loading", 
										position: "center",
										arrow : {  
											width	:	40,
											height:	60,
										},
										count		: 1,
										offsetX	: 100,
										NumBtn	: true,
										title		:	false 
									});
								}

								// if( window.matchMedia('(min-width: 1600px)').matches ) {}
								// else if(window.matchMedia('(min-width: 1200px)').matches){}
								// else if(window.matchMedia('(min-width: 992px)').matches) {}
								// else if(window.matchMedia('(min-width: 768px)').matches) {}
								// else if(window.matchMedia('(min-width: 576px)').matches) {}
								// else if(window.matchMedia('(min-width: 350px)').matches) {}
								// else if(window.matchMedia('(max-width: 349.98px)').matches) {}

								setTimeout(function() {

									$('.jcImgScroll ul li a').each(function() {
										$(this).append( $(this).find('img') );
										$(this).append( '<img class="image-2 d-block" src="">' );
										$(this).find('.image-2').attr( 'src', $(this).data('path2') );
										$(this).replaceWith('<span class="twentytwenty-container">' + $(this).html() +'</span>');
										$('.jcImgScroll ul li .twentytwenty-container').each(function() {
											return false;
										});
									});

									var offset1, offset2, offset3;

									if( window.matchMedia('(min-width: 1600px)').matches ) {
										offset1 = 574.517; offset2 = 649; offset3 = 1168;		}
									else if(window.matchMedia('(min-width: 1200px)').matches){
										offset1 = 407.667; offset2 = 443; offset3 = 797;		}
									else if(window.matchMedia('(min-width: 992px)').matches) {
										offset1 = 293.667; offset2 = 332; offset3 = 597;		}
									else if(window.matchMedia('(min-width: 768px)').matches) {
										offset1 = 346.667; offset2 = 387; offset3 = 697;		}
									else if(window.matchMedia('(min-width: 576px)').matches) {
										offset1 = 241.667; offset2 = 276; offset3 = 497;		}
									else if(window.matchMedia('(max-width: 575.98px)').matches) {
										offset1 = 153.333; offset2 = 166; offset3 = 299;		}

									$.when(
										$(".jcImgScroll ul li .twentytwenty-container").twentytwenty({
											default_offset_pct: 0.7,
											orientation: 'horizontal',
											before_label: 'До',
											after_label: 'После',
											no_overlay: true,
											// move_slider_on_hover: true,
											move_with_handle_only: true,
											click_to_move: false
										})
									).then(
										$('.jcImgScroll .slide .twentytwenty-container').each(function() {
											$(this).find('.twentytwenty-before').css('clip', 'rect(0px, '+offset1+'px, '+offset2+'px, 0px)');
											$(this).find('.twentytwenty-after').css('clip', 'rect(0px, '+offset3+'px, '+offset2+'px, '+offset1+'px)');
											$(this).find('.twentytwenty-handle').css('left', ''+offset1+'px');
										})
									);
								}, 3000);
							
						});
					});
				});

				switch_var = 1;

			}
		});
	});

	/**
	 * Значения высоты и ширины у всплывающих меню
	 */
	// $('ul#menu-fiksirovannoe > li.menu-item-has-children').hover(function() {

	// 	var $this = $(this);
	// 	var $text = $(this).children('ul.sub-menu');
	// 	var contentHeight = $text.addClass('heightAuto').outerHeight();

	// 	// console.log($text);
		
	// 	$text.attr('data-width', $text.outerWidth() );
	// 	$text.attr('data-height', $text.outerHeight() );

	// 	// Раскрытие
	// 	if( !$text.hasClass('open') ) {
	// 		$text.css('height', '0');
	// 		$text.addClass('open');
	// 		$text.removeClass('heightAuto').animate({ 
	// 				height: contentHeight
	// 		}, 500);
	// 	// Закрытие
	// 	} else {
	// 		$text.removeClass('open');
	// 		$text.removeClass('heightAuto').animate({ 
	// 			height: 0
	// 		}, 500);
	// 	}
	// });

	$('ul#menu-fiksirovannoe > li.menu-item-has-children > a').mouseover(function() {
		// var $this = $(this);
		var $text = $(this).siblings('ul.sub-menu');
		
		// Раскрытие
		if( !$text.hasClass('open') ) {
			var contentHeight = $text.addClass('heightAuto').outerHeight();
	
			// console.log( $(this).siblings('ul.sub-menu').hasClass('open') );
			
			// if( !$text.hasClass('open') ) {
			// 	console.log('has class open');
			// 	// $(this).siblings('ul.sub-menu').unbind();
			// }
	
			// console.log('mouseover');
			// alert('mouseover');
			
			$text.attr('data-width', $text.outerWidth() );
			$text.attr('data-height', $text.outerHeight() );

			$text.css('height', '0');
			$text.addClass('open');
			$text.removeClass('heightAuto').animate({ 
					height: contentHeight
			}, 500);
		}
	});

	$(document).on('mouseleave', 'ul#menu-fiksirovannoe > li.menu-item-has-children', function() {

		// console.log('mouseleave');
		// alert('mouseleave');
		// $(this).siblings('a').unbind();

		// var $this = $(this);
		var $text = $(this).children('ul.sub-menu');
		var contentHeight = $text.addClass('heightAuto').outerHeight();

		// if( !$text.hasClass('open') ) {
		// 	console.log('has not class open');
		// 	$text.addClass('open');
		// 	return false;
		// }

		$text.attr('data-width', $text.outerWidth() );
		$text.attr('data-height', $text.outerHeight() );

		// Закрытие
		// if( $text.hasClass('open') ) {
			$text.removeClass('heightAuto').animate({ 
				height: 0
			}, 500, function() {
				$text.removeClass('open');
			});
		// }
	});

	/**
	 * Анонс услуг. Высота описания
	 */
	// $('body.page-template-template-page-services article.post').hover(function() {
	// 	// var $text = $(this).find('.service-excerpt');
	// 	// var contentHeight;
		
	// 	// if( !$text.hasClass('open') ) $text.addClass('close');

	// 	if( $text.hasClass('close') ) {
			
	// 		$text.removeClass('close').addClass('open');
	// 		contentHeight = $text.addClass('heightAuto').height();
			
	// 		$text.removeClass('heightAuto').animate({ 
	// 			height: contentHeight
	// 		}, 500, function() {
	// 		});
	// 	} else if( $text.hasClass('open') ) {
	// 			$text.removeClass('open').addClass('close');

	// 			$text.animate({ 
	// 				height: 0
	// 			}, 500, function() {
	// 		});
	// 	}
		
	// });

	// $('body.page-template-template-page-services article.post').mouseover(function() {
	// 	var $text = $(this).find('.service-excerpt');
	// 	var contentHeight;

	// 	if( !$text.hasClass('open') ) $text.addClass('close');
	// 	console.log('mouseover');

	// 	if( $text.hasClass('close') ) {
			
	// 		$text.removeClass('close').addClass('open');
	// 		contentHeight = $text.addClass('heightAuto').height();
			
	// 		$text.removeClass('heightAuto').animate({ 
	// 			height: contentHeight
	// 		}, 500, function() {
	// 		});
	// 	}

	// });

	// $('body.page-template-template-page-services article.post').mouseout(function() {
	// 	var $text = $(this).find('.service-excerpt');
	// 	var contentHeight;
		
	// 	if( !$text.hasClass('close') ) $text.addClass('open');
	// 	console.log('mouseout');

	// 	if( $text.hasClass('open') ) {
	// 		$text.removeClass('open').addClass('close');

	// 		$text.animate({ 
	// 			height: 0
	// 		}, 500, function() {
	// 	});
	// }

	// });

	/**
	 * Превьюшка iframe Youtube 
	 */
	var arr_iframe = $('.slider-nav .slide iframe');
	var iframe_src;
	var youtube_video_id;
	
	arr_iframe.each(function() {

		iframe_src = $(this).attr('src');
		youtube_video_id = iframe_src.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();

		
		if (youtube_video_id.length == 11) {
			var video_thumbnail = $('<img src="//img.youtube.com/vi/'+youtube_video_id+'/0.jpg">');
			$(this).parent('.slide').append( video_thumbnail );
			$(this).parent('.slide').find('iframe').remove();
		}
	});
	
	
});
