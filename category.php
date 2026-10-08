<?php
get_header();

$queried_term = get_queried_object();
$category_slug = $queried_term instanceof WP_Term ? $queried_term->slug : '';
$category_name = $queried_term instanceof WP_Term ? $queried_term->name : '';
$category_config = fun_life_blog_category_config();
$blog_url = fun_life_blog_url();
$current_config = isset($category_config[$category_slug])
  ? $category_config[$category_slug]
  : array('en' => strtoupper($category_slug), 'ja' => $category_name);
$is_works_category = 'works' === $category_slug;
$selected_tag_slug = isset($_GET['tag_filter'])
  ? sanitize_title(wp_unslash($_GET['tag_filter']))
  : '';
$archive_tags = $queried_term instanceof WP_Term
  ? fun_life_get_category_tags($queried_term->term_id)
  : array();
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
            <div class="p-category__pages-heading">
              <p class="p-category__pages-title">PAGES</p>
              <a class="p-category__pages-back c-button-list c-hover-invert" href="<?php echo esc_url($blog_url); ?>">
                <span>一覧へ</span>
                <span class="c-button-list__arrow p-category__pages-back-arrow" aria-hidden="true"></span>
              </a>
            </div>
            <div class="p-category__pages-links">
              <?php foreach ($category_config as $filter_slug => $filter_config) : ?>
                <?php $is_current = $category_slug === $filter_slug; ?>
                <a class="p-category__pages-link c-hover-invert c-hover-invert--dark<?php echo $is_current ? ' is-current' : ''; ?>" href="<?php echo esc_url(fun_life_category_url($filter_slug)); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>><?php echo esc_html($filter_config['en']); ?></a>
              <?php endforeach; ?>
            </div>
          </nav>
        </div>

        <?php if ($archive_tags) : ?>
          <aside class="p-category__tags" aria-label="<?php echo esc_attr($current_config['en']); ?>の記事タグ">
            <p class="p-category__tags-title">TAGS</p>
            <div class="p-category__tags-list">
              <a class="p-category__tag<?php echo $selected_tag_slug ? '' : ' is-current'; ?>" href="<?php echo esc_url(fun_life_category_filter_url($category_slug)); ?>"<?php echo $selected_tag_slug ? '' : ' aria-current="page"'; ?>>すべて</a>
              <?php foreach ($archive_tags as $archive_tag) : ?>
                <?php $is_current_tag = $selected_tag_slug === $archive_tag->slug; ?>
                <a class="p-category__tag<?php echo $is_current_tag ? ' is-current' : ''; ?>" href="<?php echo esc_url(fun_life_category_filter_url($category_slug, $archive_tag->slug)); ?>"<?php echo $is_current_tag ? ' aria-current="page"' : ''; ?>><?php echo esc_html($archive_tag->name); ?></a>
              <?php endforeach; ?>
            </div>
          </aside>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <div class="p-blog__archive p-category__archive">
    <div class="l-inner">
      <?php if (have_posts()) : ?>
        <div class="p-blog__grid">
          <?php while (have_posts()) : ?>
            <?php
            the_post();
            $card_category_term = fun_life_get_primary_blog_category();
            $card_category = $card_category_term instanceof WP_Term
              ? $card_category_term->name
              : $current_config['ja'];
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
        <p class="p-category__empty">現在、該当する記事はありません。</p>
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
  </div>

  <?php get_template_part('includes/contact'); ?>
</main>

<?php get_footer(); ?>
