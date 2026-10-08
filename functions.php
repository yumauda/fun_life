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
	wp_enqueue_script('jquery');

	wp_enqueue_style('my', get_template_directory_uri() . '/css/styles.css', array(), filemtime(get_theme_file_path('/css/styles.css')), 'all');
	wp_enqueue_script('gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', array(), '3.9.1', true);
	wp_enqueue_script('scrollTrigger', '//cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js', array('gsap'), '3.9.1', true);
	wp_enqueue_script('js-gsap', get_template_directory_uri() . '/js/gsap.js', array('gsap', 'scrollTrigger'), filemtime(get_theme_file_path('/js/gsap.js')), true);

	if (is_front_page() || is_page('works')) {
		wp_enqueue_style('swiper-css', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), filemtime(get_theme_file_path('/css/swiper-bundle.min.css')), 'all');
		wp_enqueue_script('js-swiper-bundle', get_template_directory_uri() . '/js/swiper.min.js', array(), filemtime(get_theme_file_path('/js/swiper.min.js')), true);
		wp_enqueue_script('js-swiper-init', get_template_directory_uri() . '/js/swiper.js', array('js-swiper-bundle'), filemtime(get_theme_file_path('/js/swiper.js')), true);
	}

	if (is_page('contact')) {
		wp_enqueue_script('js-contact-form', get_template_directory_uri() . '/js/contact-form.js', array(), filemtime(get_theme_file_path('/js/contact-form.js')), true);
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

// WordPress標準のtitleタグとcanonicalタグの削除
function remove_default_meta_tags()
{
	remove_action('wp_head', '_wp_render_title_tag', 1);
	remove_action('wp_head', 'rel_canonical');
}
add_action('init', 'remove_default_meta_tags');

/**
 * 検索結果・エラーページ・フォーム完了画面を検索対象外にする
 *
 * @param array $robots robotsメタの設定値.
 * @return array
 */
function fun_life_meta_robots($robots)
{
	if (is_search() || is_404() || is_page(array('confirm', 'thanks'))) {
		$robots['noindex'] = true;
	}

	return $robots;
}
add_filter('wp_robots', 'fun_life_meta_robots');


// 管理画面上「投稿」の名前変更
function Change_menulabel()
{
	global $menu;
	global $submenu;
	$name = 'ブログ';
	$menu[5][0] = $name;
	$submenu['edit.php'][5][0] = $name . '一覧';
	$submenu['edit.php'][10][0] = '新しい' . $name;
}
function Change_objectlabel()
{
	global $wp_post_types;
	$name = 'ブログ';
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

function fun_life_blog_pagination($aria_label = 'ブログ一覧のページ送り')
{
	global $wp_query;

	$current_page = max(1, (int) get_query_var('paged'));
	$total_pages = $wp_query ? (int) $wp_query->max_num_pages : 0;

	if ($total_pages <= 1) {
		return;
	}

	$pagination_items = paginate_links(array(
		'current'   => $current_page,
		'total'     => $total_pages,
		'type'      => 'array',
		'end_size'  => 1,
		'mid_size'  => 2,
		'prev_next' => false,
	));

	if (!is_array($pagination_items)) {
		return;
	}

	echo '<nav class="p-blog__pagination" aria-label="' . esc_attr($aria_label) . '">';

	if ($current_page > 1) {
		echo '<a class="p-blog__pagination-prev" href="' . esc_url(get_pagenum_link($current_page - 1)) . '" aria-label="前のページへ"></a>';
	}

	foreach ($pagination_items as $pagination_item) {
		$pagination_label = html_entity_decode(wp_strip_all_tags($pagination_item), ENT_QUOTES, get_bloginfo('charset'));

		if ('…' === $pagination_label) {
			echo '<span class="p-blog__pagination-dots" aria-hidden="true">…</span>';
			continue;
		}

		$page_number = (int) $pagination_label;
		$is_current = $page_number === $current_page;

		echo '<a class="p-blog__pagination-link' . ($is_current ? ' is-current' : '') . '" href="' . esc_url(get_pagenum_link($page_number)) . '"' . ($is_current ? ' aria-current="page"' : '') . '>' . esc_html((string) $page_number) . '</a>';
	}

	if ($current_page < $total_pages) {
		echo '<a class="p-blog__pagination-next" href="' . esc_url(get_pagenum_link($current_page + 1)) . '" aria-label="次のページへ"></a>';
	}

	echo '</nav>';
}

/**
 * カテゴリーアーカイブURLを取得する。
 *
 * @param string $slug カテゴリースラッグ。
 * @return string
 */
function fun_life_category_url($slug)
{
	$category = get_category_by_slug($slug);

	return $category instanceof WP_Term
		? get_category_link($category)
		: home_url('/category/' . $slug . '/');
}

/**
 * ブログで使用する大分類カテゴリーを取得する。
 *
 * @return array<string, array<string, string>>
 */
function fun_life_blog_category_config()
{
	return array(
		'works' => array('en' => 'WORKS', 'ja' => '施工事例'),
		'event' => array('en' => 'EVENT', 'ja' => 'イベント / お知らせ'),
		'column' => array('en' => 'COLUMN', 'ja' => 'コラム'),
	);
}

/**
 * 旧NEWSカテゴリーをEVENTカテゴリーへ移行する。
 */
function fun_life_migrate_news_category_to_event()
{
	if ('1' === get_option('fun_life_event_category_migration_version')) {
		return;
	}

	$news_category = get_category_by_slug('news');
	$event_category = get_category_by_slug('event');

	if ($news_category instanceof WP_Term && !($event_category instanceof WP_Term)) {
		$result = wp_update_term(
			$news_category->term_id,
			'category',
			array(
				'name' => 'イベント / お知らせ',
				'slug' => 'event',
			)
		);

		if (is_wp_error($result)) {
			return;
		}
	} elseif ($event_category instanceof WP_Term) {
		wp_update_term(
			$event_category->term_id,
			'category',
			array('name' => 'イベント / お知らせ')
		);

		if ($news_category instanceof WP_Term) {
			$news_post_ids = get_posts(
				array(
					'post_type' => 'post',
					'post_status' => 'any',
					'category' => $news_category->term_id,
					'fields' => 'ids',
					'posts_per_page' => -1,
					'no_found_rows' => true,
				)
			);

			foreach ($news_post_ids as $news_post_id) {
				wp_set_post_categories($news_post_id, array($event_category->term_id), true);
			}

			wp_delete_term($news_category->term_id, 'category');
		}
	}

	$event_category = get_category_by_slug('event');

	if (!($event_category instanceof WP_Term)) {
		return;
	}

	update_option('fun_life_event_category_migration_version', '1');
}
add_action('init', 'fun_life_migrate_news_category_to_event', 5);

/**
 * 旧NEWSカテゴリーURLをEVENTカテゴリーへ転送する。
 */
function fun_life_redirect_legacy_news_category()
{
	$request_uri = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '';
	$request_path = trim((string) wp_parse_url($request_uri, PHP_URL_PATH), '/');
	$category_base = trim((string) get_option('category_base'), '/') ?: 'category';

	if ($category_base . '/news' !== $request_path) {
		return;
	}

	wp_safe_redirect(fun_life_category_url('event'), 301);
	exit;
}
add_action('template_redirect', 'fun_life_redirect_legacy_news_category');

/**
 * BLOGトップのURLを取得する。
 *
 * @return string
 */
function fun_life_blog_url()
{
	$posts_page_id = (int) get_option('page_for_posts');

	return $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
}

/**
 * 投稿に設定されたブログ大分類カテゴリーを取得する。
 *
 * @param int $post_id 投稿ID。
 * @return WP_Term|null
 */
function fun_life_get_primary_blog_category($post_id = 0)
{
	$post_id = $post_id ?: get_the_ID();
	$post_categories = get_the_category($post_id);
	$category_config = fun_life_blog_category_config();

	foreach (array_keys($category_config) as $category_slug) {
		foreach ($post_categories as $post_category) {
			if ($category_slug === $post_category->slug) {
				return $post_category;
			}
		}
	}

	return $post_categories ? $post_categories[0] : null;
}

/**
 * カードに表示する先頭タグを取得する。
 *
 * @param int $post_id 投稿ID。
 * @return WP_Term|null
 */
function fun_life_get_card_tag($post_id = 0)
{
	$post_id = $post_id ?: get_the_ID();
	$post_tags = wp_get_post_tags(
		$post_id,
		array(
			'orderby' => 'term_id',
			'order' => 'ASC',
		)
	);

	return $post_tags ? $post_tags[0] : null;
}

/**
 * 指定カテゴリーの投稿で使用されているタグを取得する。
 *
 * @param int $category_id カテゴリーID。
 * @return WP_Term[]
 */
function fun_life_get_category_tags($category_id)
{
	$post_ids = get_posts(
		array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'category' => (int) $category_id,
			'fields' => 'ids',
			'posts_per_page' => -1,
			'no_found_rows' => true,
		)
	);

	if (!$post_ids) {
		return array();
	}

	$tags = wp_get_object_terms(
		$post_ids,
		'post_tag',
		array(
			'orderby' => 'term_id',
			'order' => 'ASC',
		)
	);

	return is_wp_error($tags) ? array() : $tags;
}

/**
 * カテゴリー内タグ絞り込みURLを取得する。
 *
 * @param string $category_slug カテゴリースラッグ。
 * @param string $tag_slug タグスラッグ。
 * @return string
 */
function fun_life_category_filter_url($category_slug, $tag_slug = '')
{
	$category_url = fun_life_category_url($category_slug);

	return $tag_slug
		? add_query_arg('tag_filter', sanitize_title($tag_slug), $category_url)
		: $category_url;
}

/**
 * works固定ページと施工事例詳細のURL競合を避ける。
 */
function fun_life_add_works_post_rewrite()
{
	add_rewrite_rule('^works/([0-9]+)/?$', 'index.php?p=$matches[1]', 'top');

	if ('1' !== get_option('fun_life_works_rewrite_version')) {
		flush_rewrite_rules(false);
		update_option('fun_life_works_rewrite_version', '1');
	}
}
add_action('init', 'fun_life_add_works_post_rewrite');

function fun_life_filter_blog_queries($query)
{
	if (is_admin() || !$query->is_main_query()) {
		return;
	}

	$category_config = fun_life_blog_category_config();

	if ($query->is_home()) {
		$category_ids = array();

		foreach (array_keys($category_config) as $category_slug) {
			$category = get_category_by_slug($category_slug);

			if ($category instanceof WP_Term) {
				$category_ids[] = (int) $category->term_id;
			}
		}

		$query->set('category__in', $category_ids ?: array(0));

		$query->set('posts_per_page', 4);
	}

	if ($query->is_category(array_keys($category_config))) {
		$tag_filter = isset($_GET['tag_filter'])
			? sanitize_title(wp_unslash($_GET['tag_filter']))
			: '';

		if ($tag_filter) {
			$query->set('tag', $tag_filter);
		}
	}
}
add_action('pre_get_posts', 'fun_life_filter_blog_queries');

/**
 * 旧タグアーカイブを、カテゴリー内タグ絞り込みへ案内する。
 */
function fun_life_redirect_tag_archive()
{
	if (!is_tag()) {
		return;
	}

	$tag = get_queried_object();

	if (!$tag instanceof WP_Term) {
		return;
	}

	$posts = get_posts(
		array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'tag_id' => (int) $tag->term_id,
			'posts_per_page' => 20,
			'no_found_rows' => true,
		)
	);

	foreach ($posts as $post) {
		$category = fun_life_get_primary_blog_category($post->ID);

		if ($category instanceof WP_Term && isset(fun_life_blog_category_config()[$category->slug])) {
			wp_safe_redirect(fun_life_category_filter_url($category->slug, $tag->slug), 301);
			exit;
		}
	}
}
add_action('template_redirect', 'fun_life_redirect_tag_archive');

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
// register_post_type(
// 	'allcolumn',
// 	array(
// 		'labels' => array(
// 			'name' => __('コラム'),
// 			'singular_name' => __('コラム')
// 		),
// 		'supports' => array(
// 			'title',
// 			'editor',
// 			'author',
// 			'thumbnail',
// 			'excerpt',
// 			'custom-fields',
// 			'comments',
// 			'categories'
// 		),
// 		'public' => true,
// 		'has_archive' => true,
// 		'show_in_rest' => true,
// 	)
// );
// register_taxonomy('allcolumn_category', array('allcolumn'), array(
// 	'hierarchical' => true,
// 	'label' => 'カテゴリー',
// 	'show_ui' => true,
// 	'public' => true
// ));
// register_taxonomy('allcolumn_tag', 'allcolumn', array(
// 	'hierarchical' => false,
// 	'label' => 'タグ',
// 	'show_ui' => true,
// 	'public' => true,
// 	'show_in_rest' => true,
// ));

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

/**
 * 投稿の入力項目を追加
 */
function fun_life_register_single_fields()
{
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	$top_slider_fields = array(
		array('key' => 'field_fun_life_works_top_slider_1', 'label' => 'TOPスライダー画像1', 'name' => 'works_top_slider_1'),
		array('key' => 'field_fun_life_works_top_slider_2', 'label' => 'TOPスライダー画像2', 'name' => 'works_top_slider_2'),
		array('key' => 'field_fun_life_works_top_slider_3', 'label' => 'TOPスライダー画像3', 'name' => 'works_top_slider_3'),
	);

	foreach ($top_slider_fields as &$top_slider_field) {
		$top_slider_field['type'] = 'image';
		$top_slider_field['instructions'] = 'TOPページの施工事例スライダーに表示する画像を設定します。';
		$top_slider_field['return_format'] = 'id';
		$top_slider_field['preview_size'] = 'medium';
		$top_slider_field['library'] = 'all';
		$top_slider_field['wrapper'] = array('width' => '33.33');
	}
	unset($top_slider_field);

	acf_add_local_field_group(array(
		'key' => 'group_fun_life_works_top_slider',
		'title' => 'TOP施工事例スライダー',
		'fields' => $top_slider_fields,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => -1,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'show_in_rest' => 0,
	));

	$text_fields = array(
		array('key' => 'field_fun_life_works_spec', 'label' => '物件概要', 'name' => 'works_spec', 'type' => 'text'),
		array('key' => 'field_fun_life_works_intro_heading', 'label' => 'セクション1 見出し', 'name' => 'works_intro_heading', 'type' => 'textarea', 'rows' => 2, 'new_lines' => ''),
		array('key' => 'field_fun_life_works_intro_text', 'label' => 'セクション1 本文', 'name' => 'works_intro_text', 'type' => 'textarea', 'rows' => 5, 'new_lines' => ''),
		array('key' => 'field_fun_life_works_second_heading', 'label' => 'セクション2 見出し', 'name' => 'works_second_heading', 'type' => 'textarea', 'rows' => 2, 'new_lines' => ''),
		array('key' => 'field_fun_life_works_second_text', 'label' => 'セクション2 本文', 'name' => 'works_second_text', 'type' => 'textarea', 'rows' => 5, 'new_lines' => ''),
		array('key' => 'field_fun_life_works_third_heading', 'label' => 'セクション3 見出し', 'name' => 'works_third_heading', 'type' => 'textarea', 'rows' => 2, 'new_lines' => ''),
		array('key' => 'field_fun_life_works_third_text', 'label' => 'セクション3 本文', 'name' => 'works_third_text', 'type' => 'textarea', 'rows' => 5, 'new_lines' => ''),
		array('key' => 'field_fun_life_works_before_after_text', 'label' => 'BEFORE / AFTER 本文', 'name' => 'works_before_after_text', 'type' => 'textarea', 'rows' => 4, 'new_lines' => ''),
	);

	$overview_fields = array(
		array('key' => 'field_fun_life_works_building_type', 'label' => '建物タイプ', 'name' => 'works_building_type', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_layout', 'label' => '間取り', 'name' => 'works_layout', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_construction_type', 'label' => '工事種別', 'name' => 'works_construction_type', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_taste', 'label' => 'テイスト', 'name' => 'works_taste', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_area', 'label' => 'エリア', 'name' => 'works_area', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_performance', 'label' => '性能', 'name' => 'works_performance', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_floor_area', 'label' => '延床面積', 'name' => 'works_floor_area', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_features', 'label' => 'こだわり', 'name' => 'works_features', 'type' => 'text', 'wrapper' => array('width' => '50')),
		array('key' => 'field_fun_life_works_material', 'label' => '素材', 'name' => 'works_material', 'type' => 'text'),
	);

	$image_fields = array(
		array('key' => 'field_fun_life_works_gallery_1', 'label' => 'ギャラリー画像1', 'name' => 'works_gallery_1'),
		array('key' => 'field_fun_life_works_gallery_2', 'label' => 'ギャラリー画像2', 'name' => 'works_gallery_2'),
		array('key' => 'field_fun_life_works_gallery_3', 'label' => 'ギャラリー画像3', 'name' => 'works_gallery_3'),
		array('key' => 'field_fun_life_works_gallery_4', 'label' => 'ギャラリー画像4', 'name' => 'works_gallery_4'),
		array('key' => 'field_fun_life_works_second_image', 'label' => 'セクション2 画像', 'name' => 'works_second_image'),
		array('key' => 'field_fun_life_works_pair_1', 'label' => 'セクション3 画像1', 'name' => 'works_pair_1'),
		array('key' => 'field_fun_life_works_pair_2', 'label' => 'セクション3 画像2', 'name' => 'works_pair_2'),
		array('key' => 'field_fun_life_works_before_image', 'label' => 'BEFORE画像', 'name' => 'works_before_image'),
		array('key' => 'field_fun_life_works_after_image', 'label' => 'AFTER画像', 'name' => 'works_after_image'),
	);

	foreach ($image_fields as &$image_field) {
		$image_field['type'] = 'image';
		$image_field['return_format'] = 'id';
		$image_field['preview_size'] = 'medium';
		$image_field['library'] = 'all';
		$image_field['wrapper'] = array('width' => '50');
	}
	unset($image_field);

	acf_add_local_field_group(array(
		'key' => 'group_fun_life_single_fields',
		'title' => '記事詳細',
		'fields' => array_merge(
			array_slice($text_fields, 0, 1),
			$overview_fields,
			array_slice($text_fields, 1, 2),
			array_slice($image_fields, 0, 4),
			array_slice($text_fields, 3, 2),
			array_slice($image_fields, 4, 1),
			array_slice($text_fields, 5, 2),
			array_slice($image_fields, 5, 2),
			array_slice($image_fields, 7, 2),
			array_slice($text_fields, 7, 1)
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'show_in_rest' => 0,
	));

	acf_add_local_field_group(array(
		'key' => 'group_fun_life_event_fields',
		'title' => 'イベント情報',
		'fields' => array(
			array(
				'key' => 'field_fun_life_event_date',
				'label' => '日時',
				'name' => 'event_date',
				'type' => 'text',
				'instructions' => '例：2026年 09月 10日',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_fun_life_event_location',
				'label' => '場所',
				'name' => 'event_location',
				'type' => 'text',
				'instructions' => '例：〒861-3202 熊本県上益城郡御船町小坂999-3',
				'wrapper' => array('width' => '50'),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_taxonomy',
					'operator' => '==',
					'value' => 'category:event',
				),
			),
		),
		'menu_order' => -2,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'show_in_rest' => 0,
	));
}
add_action('acf/init', 'fun_life_register_single_fields');

/**
 * 施工事例用ACFの管理画面制御を読み込む。
 *
 * @param string $hook_suffix 現在の管理画面フック。
 */
function fun_life_enqueue_works_admin_assets($hook_suffix)
{
	if (!in_array($hook_suffix, array('post.php', 'post-new.php'), true)) {
		return;
	}

	$screen = get_current_screen();

	if (!$screen || 'post' !== $screen->post_type) {
		return;
	}

	$works_category = get_category_by_slug('works');

	if (!$works_category instanceof WP_Term) {
		return;
	}

	wp_enqueue_style(
		'fun-life-admin-works-fields',
		get_template_directory_uri() . '/css/admin-works-fields.css',
		array(),
		filemtime(get_theme_file_path('/css/admin-works-fields.css'))
	);
	wp_enqueue_script(
		'fun-life-admin-works-fields',
		get_template_directory_uri() . '/js/admin-works-fields.js',
		array('wp-data'),
		filemtime(get_theme_file_path('/js/admin-works-fields.js')),
		true
	);
	wp_localize_script(
		'fun-life-admin-works-fields',
		'funLifeWorksFields',
		array(
			'categoryId' => (int) $works_category->term_id,
			'groupKey' => 'group_fun_life_works_top_slider',
		)
	);
}
add_action('admin_enqueue_scripts', 'fun_life_enqueue_works_admin_assets');

/**
 * 施工事例以外の投稿ではTOPスライダー画像を更新しない。
 *
 * @param mixed  $value   保存予定の値。
 * @param mixed  $post_id 投稿ID。
 * @param array  $field   ACFフィールド設定。
 * @return mixed
 */
function fun_life_restrict_works_slider_value($value, $post_id, $field)
{
	$post_id = (int) $post_id;

	if (!$post_id || has_category('works', $post_id)) {
		return $value;
	}

	return get_post_meta($post_id, $field['name'], true);
}

foreach (array('works_top_slider_1', 'works_top_slider_2', 'works_top_slider_3') as $works_slider_field_name) {
	add_filter('acf/update_value/name=' . $works_slider_field_name, 'fun_life_restrict_works_slider_value', 10, 3);
}
