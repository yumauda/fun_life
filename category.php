<?php
get_header();

$queried_category = get_queried_object();
$category_slug = $queried_category instanceof WP_Term ? $queried_category->slug : '';
$category_name = $queried_category instanceof WP_Term ? $queried_category->name : '';
$is_works_category = in_array($category_slug, array('works', 'work', 'construction'), true)
  || in_array($category_name, array('施工事例', 'WORKS'), true);

$find_category = static function ($slugs, $name) {
  $category = null;

  foreach ((array) $slugs as $slug) {
    $category = get_category_by_slug($slug);

    if ($category) {
      break;
    }
  }

  if (!$category) {
    $category = get_term_by('name', $name, 'category');
  }

  return $category instanceof WP_Term ? $category : null;
};

$event_column_category = $find_category(array('event-column', 'event_column'), 'イベント・コラム');
$event_category = $find_category('event', 'イベント');
$column_category = $find_category('column', 'コラム');
$posts_page_id = (int) get_option('page_for_posts');
$blog_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
$event_column_url = $event_column_category ? get_category_link($event_column_category) : home_url('/category/event-column/');
$all_posts_url = $event_column_url;
$switch_label = 'ブログ一覧へ';
?>

<main>
  <section class="p-category<?php echo $is_works_category ? ' p-category--works' : ''; ?>">
    <div class="p-category__heading l-inner">
      <h1 class="p-category__title">
        <span class="p-category__title-en"><?php echo $is_works_category ? 'WORKS' : 'EVENT/COLUMN'; ?></span>
        <span class="p-category__title-ja"><?php echo $is_works_category ? '施工事例' : 'イベント / コラム'; ?></span>
      </h1>

      <div class="p-category__controls">
        <?php if (!$is_works_category) : ?>
          <nav class="p-category__filter" aria-label="カテゴリーで絞り込む">
            <p class="p-category__filter-title">CATEGORY</p>
            <div class="p-category__filter-links">
              <a class="p-category__filter-link<?php echo $event_column_category && $queried_category->term_id === $event_column_category->term_id ? ' is-current' : ''; ?>" href="<?php echo esc_url($all_posts_url); ?>"<?php echo $event_column_category && $queried_category->term_id === $event_column_category->term_id ? ' aria-current="page"' : ''; ?>>すべて</a>
              <?php if ($event_category) : ?>
                <a class="p-category__filter-link<?php echo $queried_category->term_id === $event_category->term_id ? ' is-current' : ''; ?>" href="<?php echo esc_url(get_category_link($event_category)); ?>"<?php echo $queried_category->term_id === $event_category->term_id ? ' aria-current="page"' : ''; ?>>イベント</a>
              <?php endif; ?>
              <?php if ($column_category) : ?>
                <a class="p-category__filter-link<?php echo $queried_category->term_id === $column_category->term_id ? ' is-current' : ''; ?>" href="<?php echo esc_url(get_category_link($column_category)); ?>"<?php echo $queried_category->term_id === $column_category->term_id ? ' aria-current="page"' : ''; ?>>コラム</a>
              <?php endif; ?>
            </div>
          </nav>
        <?php endif; ?>
        <div class="p-category__back-wrapper">
          <a class="p-category__back" href="<?php echo esc_url($blog_url); ?>" aria-label="<?php echo esc_attr($switch_label); ?>">
            <p class="p-category__back-text">一覧へ</p>
            <span class="p-category__back-icon" aria-hidden="true">
              <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/common/back.webp" alt="" width="110" height="25">
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="p-blog__archive p-category__archive">
    <div class="l-inner">
      <?php if (have_posts()) : ?>
        <div class="p-blog__grid">
          <?php while (have_posts()) : ?>
            <?php
            the_post();
            $post_categories = get_the_category();
            $card_category = $post_categories ? $post_categories[0]->name : $category_name;
            $thumbnail_id = get_post_thumbnail_id();
            $thumbnail_alt = $thumbnail_id ? get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) : '';
            $thumbnail_alt = $thumbnail_alt ?: get_the_title();
            ?>
            <article class="p-blog__card">
              <a class="p-blog__card-link" href="<?php the_permalink(); ?>">
                <div class="p-blog__meta">
                  <span class="p-blog__category"><?php echo esc_html($card_category); ?></span>
                  <time class="p-blog__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                </div>
                <figure class="p-blog__image">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large', array('alt' => $thumbnail_alt, 'loading' => 'lazy', 'decoding' => 'async')); ?>
                  <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/works_02.webp'); ?>" alt="" width="1200" height="1201" loading="lazy" decoding="async">
                  <?php endif; ?>
                </figure>
                <?php if (has_excerpt()) : ?>
                  <p class="p-blog__card-meta"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>
                <h2 class="p-blog__card-title"><?php the_title(); ?></h2>
              </a>
            </article>
          <?php endwhile; ?>
        </div>

        <?php fun_life_blog_pagination('記事一覧のページ送り'); ?>
      <?php else : ?>
        <p class="p-category__empty">現在、このカテゴリーの記事はありません。</p>
      <?php endif; ?>
    </div>
  </section>

  <?php get_template_part('includes/contact'); ?>
</main>

<?php get_footer(); ?>
