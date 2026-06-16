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
  <div class="p-single-topics">
    <div class="l-inner">
      <div class="p-single-topics__content">
        <div class="p-single-topics__title">
          <h2 class="c-main-title">
            <span class="c-main-title__ja">トピックス</span>
            <span class="c-main-title__en">Topics</span>
          </h2>
        </div>
        <div class="p-single-topics__main">
          <div class="p-single-topics__main-inner">
            <div class="p-single-topics__main-content">
              <h3 class="p-single-topics__main-title"><?php the_title(); ?></h3>
            </div>
          </div>
        </div>
        <div class="p-single-topics__meta">
          <div class="p-single-topics__meta-inner">
            <div class="p-single-topics__meta-content">
              <p class="p-single-topics__meta-text"><?php the_time('Y.m.d'); ?></p>
              <?php
              $categories = get_the_category();
              if (! empty($categories)) {
                $cat_names = array_map(function ($cat) {
                  return esc_html($cat->name);
                }, $categories);
                echo '<span class="p-single-topics__meta-category">' . implode(', ', $cat_names) . '</span>';
              }
              ?>
            </div>
          </div>
        </div>
        <div class="p-single-topics__main-content">
          <?php the_content(); ?>
        </div>
        <div class="p-single-topics__btn-wrapper">
          <a href="<?php echo esc_url(home_url('/topics')); ?>" class="p-single-topics__btn">
            <span class="p-single-topics__icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="24.5" height="49" viewBox="0 0 24.5 49">
                <path d="M24.5,48.5a24,24,0,0,1,0-48" transform="translate(0 0)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="1" />
              </svg>
            </span>
            <p class="p-single-topics__btn-text">トピックス一覧へ</p>
            <span class="p-single-topics__icon p-single-topics__icon--right">
              <svg xmlns="http://www.w3.org/2000/svg" width="24.5" height="49" viewBox="0 0 24.5 49">
                <path d="M.5,48.5A24,24,0,0,0,.5.5" transform="translate(-0.5 0)" fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="1" />
              </svg>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>
<?php get_footer() ?>