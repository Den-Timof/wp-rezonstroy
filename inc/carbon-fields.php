<?php

if( !defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Widget;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {

	Container::make( 'theme_options', 'Settings theme' )->add_fields( array(

		
		/**
		 * Главная страница
		 */
		Field::make( 'separator', 'sep_homepage', 'Главная страница' ),

		Field::make( 'image', 'logotype', 'Логотип' )
			->set_value_type( 'url' )
			->set_width(25),

		Field::make( 'image', 'home_bg_banner', 'Фоновое изображение баннера' )
			->set_value_type( 'url' )
			->set_width(25),

		Field::make('text', 'text_home_banner_under_description', 'Текст в баннере под описанием сайта'),

		Field::make( 'association', 'services_association', 'Порядок списка услуг на главной странице' )
			->set_types( array(
					array(
							'type' => 'post',
							'post_type' => 'page',
					),
			) ),
		Field::make('complex', 'rezon-s', 'Резон-С')
			->set_layout('tabbed-horizontal')
			->add_fields(array(
				Field::make('text', 'rezon-1', 'Верхний текст')->set_width(30),
				Field::make('text', 'rezon-2', 'Нижний текст')->set_width(70),
			)),
			Field::make('complex', 'steps-works', 'Как мы работаем?')
			->set_layout('tabbed-horizontal')
			->add_fields(array(
				Field::make('image', 'step-image', 'Изображение')->set_width(30),
				Field::make('text', 'step-text', 'Описание')->set_width(70),
			)),
			
		Field::make( 'media_gallery', 'home_media_gallery', 'Галерея работ на главной странице' )
			->set_type( array( 'image' ) ),

		/**
		 * Архивная страница
		 */
		Field::make( 'separator', 'sep_archive_page', 'Архивная страница' ),
		

		Field::make('text', 'archive_portfolio_count', 'Количество загружаемых работ портфолио на архивной странице'),

		/**
		 * Заголовки на главной странице
		 */
		Field::make( 'separator', 'sep_home_headers', 'Заголовки на главной странице' ),

		Field::make('text', 'headers_home_1', 'Раздел "Услуги"'),
		Field::make('text', 'headers_home_2', 'Раздел "Резон-С"'),
		Field::make('text', 'headers_home_3', 'Раздел "Как мы работаем"')
			->set_default_value('Как мы работаем'),
		Field::make('text', 'headers_home_4', 'Раздел "Примеры работ"')
			->set_default_value('Примеры работ'),

		/**
		 * Формы
		 */
		Field::make( 'separator', 'sep_forms', 'Формы' ),

		Field::make('image', 'form_feedback_1', 'Изображение формы обратной связи 1')
			->set_value_type( 'url' )
			->set_width(50),
		Field::make('image', 'form_feedback_2', 'Изображение формы обратной связи 2')
			->set_value_type( 'url' )
			->set_width(50),
		Field::make('text', 'form_feedback_1_title', 'Заголовок формы обратной связи 1'),
		Field::make('textarea', 'form_feedback_1_text', 'Текст формы обратной связи 1'),
		Field::make('text', 'form_feedback_1_textbtn', 'Текст кнопки формы обратной связи 1'),

		Field::make('textarea', 'form_feedback_2_text', 'Текст формы обратной связи 2'),
		Field::make('text', 'form_feedback_2_subtext', 'Другой текст формы обратной связи 2'),
		Field::make('text', 'form_feedback_2_textbtn', 'Текст кнопки формы обратной связи 2'),

		/**
		 * Кнопки
		 */
		Field::make( 'separator', 'sep_buttons', 'Кнопки' ),

		Field::make('text', 'text_button_home_banner', 'Текст кнопки в баннере на главной странице'),
		Field::make('text', 'text_button_portfolio', 'Текст кнопки в разделе "Примеры работ"')
			->set_default_value('Перейти в портфолио'),

		/**
		 * Подвал
		 */
		Field::make( 'separator', 'sep_footer', 'Подвал' ),

		Field::make('text', 'text_footer_under_line_1', 'Copyright'),
		Field::make('text', 'text_footer_under_line_2', 'Разработчик сайта'),
		Field::make('text', 'text_footer_develop_link', 'Ссылка на сайт разработкчика'),
		Field::make('image', 'bg_footer_section', 'Фоновое изображение подвала')
			->set_value_type( 'url' ),
		Field::make('text', 'footer_title_form', 'Заголовок формы в подвале')
			->set_default_value('Остались вопросы?'),
		Field::make('text', 'footer_text_form', 'Текст формы в подвале')
			->set_default_value('Наш менеджер ответит на них в течение одного часа'),
		Field::make('text', 'footer_btntext_form', 'Текст кнопки формы в подвале')
			->set_default_value('Бесплатная консультация'),

	));

	// Контакты
	Container::make( 'post_meta', 'CF' )
		->where( 'post_type', '=', 'page' )
		->where( 'post_id', '=', '39' )
		->add_fields( array(
			Field::make( 'text', 'phone', 'Телефон' ),
			Field::make( 'text', 'address', 'Адрес' ),
			Field::make( 'text', 'email', 'Электронная почта' ),
			Field::make( 'text', 'worktime', 'Рабочее время' ),
	));

	// // Дочерние страницы "Услуг"
	// Container::make( 'post_meta', 'CF' )
	// 	->show_on_page_children('uslugi')
	// 	->add_fields( array(
	// 		Field::make( 'rich_text', 'text_on_front_page', 'Текст для главной страницы' ),
	// ));

	// Страница портфолио
	Container::make( 'post_meta', 'CF' )
		->show_on_category('portfolio')
		->add_fields( array(
			Field::make( 'media_gallery', 'project_portfolio_gallery', 'Галерея медиафайлов в работе портфолио' )
			->set_type( array( 'image', 'video' ) ),
			Field::make( 'complex', 'project_portfolio_gallery_video', 'Видео проекта' )
				->add_fields( array(
					Field::make( 'textarea', 'project_video_link', 'Ссылка iframe на видео' )
					)
				)->set_layout('tabbed-horizontal'),

			Field::make('image', 'project_portfolio_before', 'Изображение ДО')->set_value_type( 'url' )->set_width(50),
			Field::make('image', 'project_portfolio_after', 'Изображение ПОСЛЕ')->set_value_type( 'url' )->set_width(50),
	));

	// Страница
	Container::make( 'post_meta', 'CF' )
		->add_fields( array(
			Field::make( 'rich_text', 'text_under_title', 'Текст под заголовком' ),
			Field::make('image', 'bg_banner_page', 'Фоновое изображение первого экрана')->set_value_type( 'url' )->set_width(50),
			// Field::make('image', 'anons_thumb', 'Изображение анонса')->set_value_type( 'url' )->set_width(50),
	));

	// Страница
	Container::make( 'post_meta', 'CF' )
		->where( 'post_type', '=', 'page' )
		->add_fields( array(
			// Field::make( 'rich_text', 'page_excerpt', 'Описание страницы' ),
			Field::make( 'checkbox', 'feedback_display', 'Отображать форму обратной связи' )->set_width(50),
			Field::make( 'checkbox', 'feedback_display_2', 'Альтернативный внешний вид формы обратной связи' )
			->set_conditional_logic( array(
				'relation' => 'AND', // Optional, defaults to "AND"
				array(
					'field' => 'feedback_display',
					'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
					'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
				)
			))->set_width(50),
	));


	/**
	 * Страница "Услуги" и её дочерние страницы
	 */
	Container::make( 'post_meta', 'CF' )
		->show_on_page_children('service')
		->add_fields( array(
			Field::make( 'rich_text', 'page_excerpt', 'Текст для анонса' )
	));
	Container::make( 'post_meta', 'CF' )
		->show_on_page(55)
		->add_fields( array(
			Field::make( 'rich_text', 'page_excerpt', 'Описание страницы' )
	));

	// term meta
	Container::make( 'term_meta', 'Category Properties' )
		->where( 'term_taxonomy', '=', 'category' )
		->add_fields( array(
			Field::make( 'image', 'bg_image_by_category', 'Фоновое изображение в баннере' )->set_value_type( 'url' ),
			Field::make( 'rich_text', 'text_under_title_by_category', 'Текст под заголовком' ),
		) );

	


	class ThemeWidgetExample extends Widget {
		// Register widget function. Must have the same name as the class
		function __construct() {
			$this->setup( 'theme_widget_example', 'Список дочерних страниц', 'Displays a block with title/text', array(
				Field::make( 'text', 'title', 'Название родительской страницы' ),
			) );
		}
	
		// Called when rendering the widget in the front-end
		function front_end( $args, $instance ) {
			$page = get_page_by_title( $instance['title'] );

			// Получаем все страницы, по которым будет проходить поиск.
			$my_wp_query = new WP_Query();
			$all_wp_pages = $my_wp_query->query(array(
				'post_type' => 'page',
				'posts_per_page' => -1,
				'order' => 'ASC',
			));

			// Получаем страницу, дочерние к которой нужно получить
			$portfolio =  get_page_by_title( $instance['title'] );

			// Фильтруем все страницы и находим дочерние к Portfolio
			$portfolio_children = get_page_children( $portfolio->ID, $all_wp_pages );

			// выводим на экран то, что мы в итоге поучили
			// echo '<pre>' . print_r( $portfolio_children, true ) . '</pre>';
			
			// var_dump($page);
			$length_children = count( $portfolio_children );
			$count = 0;
			
			echo '<ul class="widget-list">';
			foreach( $portfolio_children as $children_page ) {
				$active = ($children_page->ID == get_queried_object_id()) ? 'active' : '';
				
				$post_parent = $children_page->post_parent;

				if( $children_page->post_parent == $portfolio->ID ) {

					echo '<li class="' . $active . '">';
					echo '<a href="' . get_permalink($children_page->ID) . '">' . $children_page->post_title . '</a>';
	
					$child_wp_query = new WP_Query();
					$child_pages = $child_wp_query->query(array(
						'post_type' => 'page',
						'posts_per_page' => -1,
						'order' => 'ASC',
						'post_parent'	=> $children_page->ID,
					));
	
					if( !empty($child_pages) ) {
						echo '<ul class="sub-list">';
						foreach( $child_pages as $child_page ) {
							$active = ($child_page->ID == get_queried_object_id()) ? 'active' : '';

							echo '<li class="' . $active . '">';
							echo '<a href="' . get_permalink($child_page->ID) . '">' . $child_page->post_title . '</a>';
							echo '</li>';
						}
						echo '</ul>';
					}
					echo '</li>';

				}

			}
			echo '</ul>';

		}
	}
	
	function load_widgets() {
		register_widget( 'ThemeWidgetExample' );
	}

};




add_action( 'widgets_init', 'load_widgets' );

?>