<?php
get_header();

$queried_category = get_queried_object();
$category_slug = $queried_category instanceof WP_Term ? $queried_category->slug : '';
$category_name = $queried_category instanceof WP_Term ? $queried_category->name : '';
$is_works_category = in_array($category_slug, array('works', 'work', 'construction'), true)
  || in_array($category_name, array('施工事例', 'WORKS'), true);
$category_config = array(
  'works' => array('en' => 'WORKS', 'ja' => '施工事例'),
  'column' => array('en' => 'COLUMN', 'ja' => 'コラム'),
  'blog' => array('en' => 'BLOG', 'ja' => 'ブログ'),
  'event' => array('en' => 'EVENT', 'ja' => 'イベント/お知らせ'),
);
$current_config = isset($category_config[$category_slug])
  ? $category_config[$category_slug]
  : array('en' => strtoupper($category_slug), 'ja' => $category_name);
$category_nav_order = array('works', 'event', 'column', 'blog');
$placeholder_tags = array(
  'すべて',
  '平屋',
  '規格住宅',
  '二階建て',
  '店舗兼住宅',
  'リフォーム',
  'リノベーション',
  'アパート',
  '内装',
  '外装',
  'モデルハウス',
  'メンテナンス',
  'お知らせ',
);
?>

<main>
  <section class="p-category<?php echo $is_works_category ? ' p-category--works' : ''; ?>">
    <div class="l-inner">
      <div class="p-category__heading">
        <div class="p-category__main">
          <h1 class="p-category__title">
            <span class="p-category__title-en"><?php echo esc_html($current_config['en']); ?></span>
            <span class="p-category__title-ja"><?php echo esc_html($current_config['ja']); ?></span>
          </h1>

          <nav class="p-category__pages" aria-label="カテゴリーページを切り替える">
            <p class="p-category__pages-title">PAGES</p>
            <div class="p-category__pages-links">
              <?php foreach ($category_nav_order as $filter_slug) : ?>
                <?php if (!isset($category_config[$filter_slug])) : ?>
                  <?php continue; ?>
                <?php endif; ?>
                <?php $is_current = $category_slug === $filter_slug; ?>
                <a class="p-category__pages-link c-hover-invert c-hover-invert--dark<?php echo $is_current ? ' is-current' : ''; ?>" href="<?php echo esc_url(fun_life_category_url($filter_slug)); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>><?php echo esc_html($category_config[$filter_slug]['en']); ?></a>
              <?php endforeach; ?>
            </div>
          </nav>
        </div>

        <aside class="p-category__tags" aria-label="タグ一覧">
          <p class="p-category__tags-title">TAGS</p>
          <div class="p-category__tags-list">
            <?php foreach ($placeholder_tags as $tag_index => $placeholder_tag) : ?>
              <?php $is_current_tag = 0 === $tag_index; ?>
              <span class="p-category__tag<?php echo $is_current_tag ? ' is-current' : ''; ?>"><?php echo esc_html($placeholder_tag); ?></span>
            <?php endforeach; ?>
          </div>
        </aside>
      </div>
      <div class="p-category__back-wrapper">
        <a class="p-category__back" href="<?php echo esc_url(home_url('/')); ?>" aria-label="トップページへ">
          <p class="p-category__back-text">TOPへ</p>
          <span class="p-category__back-icon" aria-hidden="true">
            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/common/back.webp" alt="" width="110" height="25">
          </span>
        </a>
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
      <?php
      get_template_part(
        'includes/banner',
        null,
        array(
          'modifier' => 'p-banner--archive',
          'with_inner' => false,
        )
      );
      ?>
    </div>
  </section>

  <?php get_template_part('includes/contact'); ?>
</main>

<?php get_footer(); ?>
