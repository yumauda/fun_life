<?php get_header(); ?>
<main>
  <div class="p-scroll-text wrapper js-scroll-text p-mv__scroll-text">
    <div class="loop">
      <img src="<?php echo get_template_directory_uri() ?>/images/common/loop4.svg" alt="" width="3006" height="160">
    </div>
    <div class="loop loop2">
      <img src="<?php echo get_template_directory_uri() ?>/images/common/loop4.svg" alt="" width="3006" height="160">
    </div>
  </div>

  <div class="p-home-topics__box">

    <section class="p-home-topics">
      <div class="l-inner">
        <div class="p-home-topics__content">
          <div class="p-home-topics__title">
            <h2 class="c-main-title">
              <span class="c-main-title__ja">トピックス</span>
              <span class="c-main-title__en">Topics</span>
            </h2>
          </div>
          <div class="p-home-topics__block">
            <?php if (have_posts()) : ?>
              <?php while (have_posts()) : ?>
                <?php the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="p-home-topics__row">
                  <div class="p-home-topics__metaBlock">
                    <time datetime="<?php the_time('Y-m-d'); ?>" class="p-home-topics__time"><?php the_time('Y.m.d'); ?></time>
                    <p class="p-home-topics__category">
                      <?php
                      $categories = get_the_category();
                      if (! empty($categories)) {
                        $cat_names = array_map(function ($cat) {
                          return esc_html($cat->name);
                        }, $categories);
                        echo implode(', ', $cat_names);
                      }
                      ?>
                    </p>
                  </div>
                  <p class="p-home-topics__blockTitle"><?php the_title(); ?></p>
                </a>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="p-home-topics__pagination">
            <?php
            $pagination_links = paginate_links(array(
              'type'      => 'array',
              'prev_text' => '&lt;',
              'next_text' => '&gt;',
              'end_size'  => 1,
              'mid_size'  => 2,
              'before_page_number' => '',
              'after_page_number'  => '',
            ));
            if ($pagination_links) : ?>
              <ul class="p-home-topics__lists">
                <?php foreach ($pagination_links as $link) : ?>
                  <li class="p-home-topics__list">
                    <?php echo str_replace('page-numbers', 'p-home-topics__pagination-link', $link); ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </div>


</main>
<?php get_footer() ?>