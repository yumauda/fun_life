<?php
get_header();

$works_url = fun_life_category_url('works');
$column_url = fun_life_category_url('column');
$event_url = fun_life_category_url('event');
?>

<main>
  <section class="p-blog">
    <div class="p-blog__heading l-inner">
      <h1 class="p-blog__title">
        <span class="p-blog__title-en">BLOG</span>
        <span class="p-blog__title-ja">ブログ</span>
      </h1>
      <nav class="p-blog__pages" aria-label="関連ページ">
        <p class="p-blog__pages-title">PAGES</p>
        <div class="p-blog__pages-links">
          <a class="p-blog__pages-link c-hover-invert c-hover-invert--dark" href="<?php echo esc_url($works_url); ?>">WORKS</a>
          <a class="p-blog__pages-link c-hover-invert c-hover-invert--dark" href="<?php echo esc_url($column_url); ?>">COLUMN</a>
          <a class="p-blog__pages-link c-hover-invert c-hover-invert--dark" href="<?php echo esc_url($event_url); ?>">EVENT</a>
        </div>
      </nav>
    </div>

    <div class="p-blog__archive">
      <div class="l-inner">
        <?php if (have_posts()) : ?>
          <div class="p-blog__grid">
            <?php while (have_posts()) : ?>
              <?php
              the_post();
              $post_categories = get_the_category();
              $card_category = $post_categories ? $post_categories[0]->name : '';
              $thumbnail_id = get_post_thumbnail_id();
              $thumbnail_alt = $thumbnail_id ? get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) : '';
              $thumbnail_alt = $thumbnail_alt ?: get_the_title();
              ?>
              <article class="p-blog__card">
                <a class="p-blog__card-link" href="<?php the_permalink(); ?>">
                  <div class="p-blog__meta">
                    <?php if ($card_category) : ?>
                      <span class="p-blog__category"><?php echo esc_html($card_category); ?></span>
                    <?php endif; ?>
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

          <?php fun_life_blog_pagination(); ?>
        <?php else : ?>
          <p class="p-blog__empty">現在、記事はありません。</p>
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
  </section>
  <?php get_template_part('includes/contact'); ?>

</main>

<?php get_footer(); ?>
