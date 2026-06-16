<?php

/**
 * Functions
 */

/**
 * WordPress標準機能
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 */
function my_setup()
{
	add_theme_support('post-thumbnails'); /* アイキャッチ */
	add_theme_support('automatic-feed-links'); /* RSSフィード */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action('after_setup_theme', 'my_setup');

/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{
	wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.0.min.js', '', "1.0.1", true);

	wp_enqueue_style('my', get_template_directory_uri() . '/css/styles.css', array(), filemtime(get_theme_file_path('/css/styles.css')), 'all');
	wp_enqueue_script('gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', '', "1.0.1", true);
	wp_enqueue_script('scrollTrigger', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js', '', "1.0.1", true);
	wp_enqueue_script('js-gsap', get_template_directory_uri() . '/js/gsap.js', array('jquery'), filemtime(get_theme_file_path('/js/gsap.js')), true);

	if (is_front_page()) {
		wp_enqueue_style('swiper-css', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), filemtime(get_theme_file_path('/css/swiper-bundle.min.css')), 'all');
		wp_enqueue_script('js-swiper-bundle', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), filemtime(get_theme_file_path('/js/swiper.min.js')), true);
		wp_enqueue_script('js-swiper-init', get_template_directory_uri() . '/js/swiper.js', array('jquery'), filemtime(get_theme_file_path('/js/swiper.js')), true);
	}
	if (is_page('banquet') || is_page('restaurant') || is_page('suite-a') || is_page('suite-b') || is_page('twin') || is_page('double') || is_page('single') || is_page('japanese')) {
		wp_enqueue_style('swiper-css', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), filemtime(get_theme_file_path('/css/swiper-bundle.min.css')), 'all');
		wp_enqueue_script('js-swiper-bundle', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), filemtime(get_theme_file_path('/js/swiper.min.js')), true);
		wp_enqueue_script('js-swiper-init', get_template_directory_uri() . '/js/swiper.js', array('jquery'), filemtime(get_theme_file_path('/js/swiper.js')), true);
	}
	if (is_page('office')) {
		wp_enqueue_script('js-office-agreement', get_template_directory_uri() . '/js/office-agreement.js', array('jquery'), filemtime(get_theme_file_path('/js/office-agreement.js')), true);
	}
	wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), filemtime(get_theme_file_path('/js/script.js')), true);
}
add_action('wp_enqueue_scripts', 'my_script_init');







/**
 * メニューの登録
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */
// function my_menu_init() {
// 	register_nav_menus(
// 		array(
// 			'global'  => 'ヘッダーメニュー',
// 			'utility' => 'ユーティリティメニュー',
// 			'drawer'  => 'ドロワーメニュー',
// 		)
// 	);
// }
// add_action( 'init', 'my_menu_init' );
/**
 * メニューの登録
 *
 * 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */


/**
 * ウィジェットの登録
 *
 * @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
// function my_widget_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => 'サイドバー',
// 			'id'            => 'sidebar',
// 			'before_widget' => '<div id="%1$s" class="p-widget %2$s">',
// 			'after_widget'  => '</div>',
// 			'before_title'  => '<div class="p-widget__title">',
// 			'after_title'   => '</div>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'my_widget_init' );


/**
 * アーカイブタイトル書き換え
 *
 * @param string $title 書き換え前のタイトル.
 * @return string $title 書き換え後のタイトル.
 */
function my_archive_title($title)
{

	if (is_home()) { /* ホームの場合 */
		$title = 'ブログ';
	} elseif (is_category()) { /* カテゴリーアーカイブの場合 */
		$title = '' . single_cat_title('', false) . '';
	} elseif (is_tag()) { /* タグアーカイブの場合 */
		$title = '' . single_tag_title('', false) . '';
	} elseif (is_post_type_archive()) { /* 投稿タイプのアーカイブの場合 */
		$title = '' . post_type_archive_title('', false) . '';
	} elseif (is_tax()) { /* タームアーカイブの場合 */
		$title = '' . single_term_title('', false);
	} elseif (is_search()) { /* 検索結果アーカイブの場合 */
		$title = '「' . esc_html(get_query_var('s')) . '」の検索結果';
	} elseif (is_author()) { /* 作者アーカイブの場合 */
		$title = '' . get_the_author() . '';
	} elseif (is_date()) { /* 日付アーカイブの場合 */
		$title = '';
		if (get_query_var('year')) {
			$title .= get_query_var('year') . '年';
		}
		if (get_query_var('monthnum')) {
			$title .= get_query_var('monthnum') . '月';
		}
		if (get_query_var('day')) {
			$title .= get_query_var('day') . '日';
		}
	}
	return $title;
};
add_filter('get_the_archive_title', 'my_archive_title');


/**
 * 抜粋文の文字数の変更
 *
 * @param int $length 変更前の文字数.
 * @return int $length 変更後の文字数.
 */
function my_excerpt_length($length)
{
	return 80;
}
add_filter('excerpt_length', 'my_excerpt_length', 999);
/**
 * 抜粋文の省略記法の変更
 *
 * @param string $more 変更前の省略記法.
 * @return string $more 変更後の省略記法.
 */
function my_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');

function breadcrumb()
{
	$home = '<li class="c-breadcrumbs__list"><a class="c-breadcrumbs__link" href="' . get_bloginfo('url') . '" >HOME</a></li>';

	echo '<ul class="c-breadcrumbs__lists">';
	if (is_front_page()) {
		// トップページの場合
	} else if (is_category()) {
		// カテゴリページの場合
		$cat = get_queried_object();
		$cat_id = $cat->parent;
		$cat_list = array();
		while ($cat_id != 0) {
			$cat = get_category($cat_id);
			$cat_link = get_category_link($cat_id);
			array_unshift($cat_list, '<li class="c-breadcrumbs__list"><a class="c-breadcrumbs__link" href="' . $cat_link . '">' . $cat->name . '</a></li>');
			$cat_id = $cat->parent;
		}
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		foreach ($cat_list as $value) {
			echo $value;
		}
		the_archive_title('<li class="c-breadcrumbs__list">', '</li>');
	} else if (is_archive()) {
		// 月別アーカイブ・タグページの場合
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		the_archive_title('<li class="c-breadcrumbs__list">', '</li>');
	} else if (is_home()) {
		// 月別アーカイブ・タグページの場合
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		the_archive_title('<li class="c-breadcrumbs__list">', '</li>');
	} else if (is_single()) {
		// 投稿ページの場合
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		echo "<a href=" . "/blog-all" . ">ブログ</a>";
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow c-breadcrumbs__arrow--2"><</li>';
		the_title('<li class="c-breadcrumbs__list c-breadcrumbs__list--mt2">', '</li>');
	} else if (is_page()) {
		// 固定ページの場合
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		the_title('<li class="c-breadcrumbs__list">', '</li>');
	} else if (is_search()) {
		// 検索ページの場合
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		echo '<li class="c-breadcrumbs__list">「' . get_search_query() . '」の検索結果</li>';
	} else if (is_404()) {
		// 404ページの場合
		echo $home;
		echo '<li class="c-breadcrumbs__list c-breadcrumbs__arrow"><</li>';
		echo '<li class="c-breadcrumbs__list">ページが見つかりません</li>';
	}
	echo "</ul>";
}

// アーカイブの余計なタイトルを削除
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_month()) {
		$title = single_month_title('', false);
	}
	return $title;
});

add_filter('wpcf7_autop_or_not', '__return_false');

// titleタグの削除
function remove_title_tag()
{
	remove_action('wp_head', '_wp_render_title_tag', 1);
}
add_action('init', 'remove_title_tag');


// 管理画面上「投稿」の名前変更
function Change_menulabel()
{
	global $menu;
	global $submenu;
	$name = 'お知らせ';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name . '一覧';
	$submenu['edit.php'][10][0] = '新しい' . $name;
}
function Change_objectlabel()
{
	global $wp_post_types;
	$name = 'お知らせ';
	$labels = &$wp_post_types['post']->labels;
	$labels->name = $name;
	$labels->singular_name = $name;
	$labels->add_new = _x('追加', $name);
	$labels->add_new_item = $name . 'の新規追加';
	$labels->edit_item = $name . 'の編集';
	$labels->new_item = '新規' . $name;
	$labels->view_item = $name . 'を表示';
	$labels->search_items = $name . 'を検索';
	$labels->not_found = $name . 'が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'Change_objectlabel');
add_action('admin_menu', 'Change_menulabel');

//ログイン画面のロゴ変更
function login_logo()
{
	echo '<style type="text/css">
	  #login h1 a {
		background: url(' . get_template_directory_uri() . '/images/common/login_logo.png) no-repeat top center;
		background-size:100% auto;
		width: 70px; //ログインの幅
		height: 70px; //ログインの高さ
	  }
	  body{
		background: url(' . get_template_directory_uri() . '/images/common/mv_bg.jpg) no-repeat top center;
		background-color:rgba(255,255,255,0.5);
		background-blend-mode:lighten;
		background-size: cover;
		
	  }
	</style>';
}
add_action('login_head', 'login_logo');

function custom_pagination()
{
	global $wp_query;
	$big = 999999999;
	$pages = paginate_links(array(
		'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages,
		'type'  => 'array',
		'prev_next'   => true,
		'prev_text'   => '<',
		'next_text'   => '>',
	));
	if (is_array($pages)) {
		$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
		echo '<div class="p-work__pager p-pager"><ul class="p-pager__lists">';
		foreach ($pages as $page) {
			echo "<li class='p-pager__list'>$page</li>";
		}
		echo '</ul></div>';
	}
}

function exclude_multiple_categories_from_homepage($query)
{
	if ($query->is_home() && $query->is_main_query()) {
		$query->set('cat', '-1,-8,-9,-10');
	}
}
add_action('pre_get_posts', 'exclude_multiple_categories_from_homepage');

add_filter('wpcf7_validate_text', 'custom_hiragana_validation_filter', 20, 2);
add_filter('wpcf7_validate_text*', 'custom_hiragana_validation_filter', 20, 2);

function custom_hiragana_validation_filter($result, $tag)
{
	if ('your-hiragana-field' == $tag->name) {
		$value = isset($_POST[$tag->name]) ? trim(wp_unslash(strtr((string)$_POST[$tag->name], "\n", " "))) : '';

		if (!preg_match("/^[ぁ-ん]+$/u", $value)) {
			$result->invalidate($tag, "ひらがなで入力してください。");
		}
	}

	return $result;
}

//投稿タイプの作成(カスタム投稿)
register_post_type(
	'allcolumn',
	array(
		'labels' => array(
			'name' => __('コラム'),
			'singular_name' => __('コラム')
		),
		'supports' => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'comments',
			'categories'
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
	)
);
register_taxonomy('allcolumn_category', array('allcolumn'), array(
	'hierarchical' => true,
	'label' => 'カテゴリー',
	'show_ui' => true,
	'public' => true
));
register_taxonomy('allcolumn_tag', 'allcolumn', array(
	'hierarchical' => false,
	'label' => 'タグ',
	'show_ui' => true,
	'public' => true,
	'show_in_rest' => true,
));

add_filter('body_class', function ($classes) {
	if (is_front_page()) {
		$classes[] = 'home';
	}
	return $classes;
});

/**
 * WebP画像のサポートを追加
 */
function enable_webp_upload($mimes)
{
	$mimes['webp'] = 'image/webp';
	return $mimes;
}
add_filter('mime_types', 'enable_webp_upload');

// WebP画像のプレビュー表示を有効化
function webp_is_displayable($result, $path)
{
	if ($result === false) {
		$displayable_image_types = array(IMAGETYPE_WEBP);
		$info = @getimagesize($path);

		if (empty($info)) {
			$result = false;
		} elseif (!in_array($info[2], $displayable_image_types)) {
			$result = false;
		} else {
			$result = true;
		}
	}

	return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);
