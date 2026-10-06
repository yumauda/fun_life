<?php
get_header();

if (have_posts()) :
  while (have_posts()) :
    the_post();

    $image_uri = get_template_directory_uri() . '/images/blog-single/';
    $post_categories = get_the_category();
    $primary_category = $post_categories ? $post_categories[0] : null;
    $category_slug = $primary_category instanceof WP_Term ? $primary_category->slug : '';
    $category_label = $primary_category instanceof WP_Term ? $primary_category->name : '施工事例';
    $is_works = in_array($category_slug, array('works', 'work', 'construction'), true)
      || in_array($category_label, array('施工事例', 'WORKS'), true);
    $single_category_config = array(
      'works' => array('en' => 'WORKS', 'ja' => '施工事例'),
      'column' => array('en' => 'COLUMN', 'ja' => 'コラム'),
      'blog' => array('en' => 'BLOG', 'ja' => 'ブログ'),
      'event' => array('en' => 'EVENT', 'ja' => 'イベント'),
    );
    $current_category_config = isset($single_category_config[$category_slug])
      ? $single_category_config[$category_slug]
      : array('en' => strtoupper($category_slug), 'ja' => $category_label);
    $eyebrow_en = $current_category_config['en'];
    $eyebrow_ja = $current_category_config['ja'];
    $works_url = fun_life_category_url('works');
    $column_url = fun_life_category_url('column');
    $blog_url = fun_life_category_url('blog');
    $event_url = fun_life_category_url('event');
    $archive_url = $primary_category instanceof WP_Term ? get_category_link($primary_category) : $blog_url;

    $get_detail = static function ($field_name, $fallback = '') {
      $value = function_exists('get_field') ? get_field($field_name) : get_post_meta(get_the_ID(), $field_name, true);

      if (is_string($value)) {
        $value = trim($value);
      }

      return $value !== '' && $value !== null && $value !== false ? $value : $fallback;
    };

    $render_heading = static function ($text) {
      return nl2br(esc_html((string) $text));
    };

    $render_image = static function ($attachment_id, $fallback_file, $fallback_alt, $fallback_width, $fallback_height, $lazy = true) use ($image_uri) {
      $attributes = array(
        'decoding' => 'async',
      );

      if ($lazy) {
        $attributes['loading'] = 'lazy';
      }

      if ($attachment_id) {
        $attachment_alt = get_post_meta((int) $attachment_id, '_wp_attachment_image_alt', true);
        $attributes['alt'] = $attachment_alt ?: $fallback_alt;

        return wp_get_attachment_image((int) $attachment_id, 'full', false, $attributes);
      }

      return sprintf(
        '<img src="%1$s" alt="%2$s" width="%3$d" height="%4$d"%5$s decoding="async">',
        esc_url($image_uri . $fallback_file),
        esc_attr($fallback_alt),
        (int) $fallback_width,
        (int) $fallback_height,
        $lazy ? ' loading="lazy"' : ''
      );
    };

    $content_fallback = trim(wp_strip_all_tags(get_the_content()));
    $works_spec = $get_detail('works_spec', get_the_excerpt());
    $intro_heading = $get_detail('works_intro_heading', "家族の気配を感じながら、\nそれぞれが心地よく過ごせる住まい。");
    $intro_text = $get_detail('works_intro_text', $content_fallback ?: '6人家族がのびのびと暮らせるよう、家族の繋がりと一人ひとりの居場所を大切にしました。外と内をゆるやかに結ぶ中庭や、家族が自然と集まるダイニングを中心に、毎日の動きがスムーズになる住まいをかたちにしています。');
    $second_heading = $get_detail('works_second_heading', "暮らしの中心に、\n家族が集まるダイニング。");
    $second_text = $get_detail('works_second_text', 'キッチンとダイニングをひと続きに配置し、料理をする人と食卓を囲む人の会話が自然に生まれる空間に。素材と色を丁寧に揃え、落ち着きの中にも家族らしい個性が感じられる設えとしました。');
    $third_heading = $get_detail('works_third_heading', "視線が抜ける、\n開放的な家族の空間。");
    $third_text = $get_detail('works_third_text', '吹き抜けとスケルトン階段が上下階を繋ぎ、どこにいても家族の気配を感じられます。たっぷりの自然光と、使いやすい収納計画で、心地よさと暮らしやすさを両立しました。');
    $before_after_text = $get_detail('works_before_after_text', '外からの視線をほどよく遮りながら、家族が安心して過ごせる中庭に。室内とひと続きに使える、もう一つのリビングが生まれました。');
    $works_overview_items = array(
      array('label' => '建物タイプ', 'value' => $get_detail('works_building_type')),
      array('label' => '間取り', 'value' => $get_detail('works_layout')),
      array('label' => '工事種別', 'value' => $get_detail('works_construction_type')),
      array('label' => 'テイスト', 'value' => $get_detail('works_taste')),
      array('label' => 'エリア', 'value' => $get_detail('works_area')),
      array('label' => '性能', 'value' => $get_detail('works_performance')),
      array('label' => '延床面積', 'value' => $get_detail('works_floor_area')),
      array('label' => 'こだわり', 'value' => $get_detail('works_features')),
      array('label' => '素材', 'value' => $get_detail('works_material')),
    );
    $works_overview_items = array_values(
      array_filter(
        $works_overview_items,
        static function ($overview_item) {
          return '' !== $overview_item['value'];
        }
      )
    );
    $works_overview_rows = array_map(
      static function ($overview_items) {
        return array(
          'left' => $overview_items[0],
          'right' => isset($overview_items[1]) ? $overview_items[1] : null,
        );
      },
      array_chunk($works_overview_items, 2)
    );
    $hero_image_id = get_post_thumbnail_id();
    $other_posts = new WP_Query(array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 2,
      'post__not_in' => array(get_the_ID()),
      'category__in' => $primary_category instanceof WP_Term ? array($primary_category->term_id) : array(),
      'ignore_sticky_posts' => true,
    ));
?>

<main>
  <article class="p-single-blog<?php echo $is_works ? ' p-single-blog--works' : ''; ?>">
    <header class="p-single-blog__hero l-inner">
      <div class="p-single-blog__hero-copy">
        <p class="p-single-blog__eyebrow">
          <span class="p-single-blog__eyebrow-en"><?php echo esc_html($eyebrow_en); ?></span>
          <span class="p-single-blog__eyebrow-ja"><?php echo esc_html($eyebrow_ja); ?></span>
        </p>
        <div class="p-single-blog__meta">
          <span class="p-single-blog__category"><?php echo esc_html($category_label); ?></span>
          <time class="p-single-blog__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
        </div>
        <?php if ($works_spec) : ?>
          <p class="p-single-blog__spec"><?php echo esc_html($works_spec); ?></p>
        <?php endif; ?>
        <h1 class="p-single-blog__title"><?php the_title(); ?></h1>
        <nav class="p-single-blog__pages" aria-label="カテゴリーページを切り替える">
          <div class="p-single-blog__pages-heading">
            <p class="p-single-blog__pages-title">PAGES</p>
            <a class="c-button-list" href="<?php echo esc_url($archive_url); ?>">
              <span>一覧へ</span>
              <span class="c-button-list__arrow" aria-hidden="true"></span>
            </a>
          </div>
          <div class="p-single-blog__pages-links">
            <a class="p-single-blog__pages-link c-hover-invert c-hover-invert--dark<?php echo 'works' === $category_slug ? ' is-current' : ''; ?>" href="<?php echo esc_url($works_url); ?>"<?php echo 'works' === $category_slug ? ' aria-current="page"' : ''; ?>>WORKS</a>
            <a class="p-single-blog__pages-link c-hover-invert c-hover-invert--dark<?php echo 'column' === $category_slug ? ' is-current' : ''; ?>" href="<?php echo esc_url($column_url); ?>"<?php echo 'column' === $category_slug ? ' aria-current="page"' : ''; ?>>COLUMN</a>
            <a class="p-single-blog__pages-link c-hover-invert c-hover-invert--dark<?php echo 'blog' === $category_slug ? ' is-current' : ''; ?>" href="<?php echo esc_url($blog_url); ?>"<?php echo 'blog' === $category_slug ? ' aria-current="page"' : ''; ?>>BLOG</a>
            <a class="p-single-blog__pages-link c-hover-invert c-hover-invert--dark<?php echo 'event' === $category_slug ? ' is-current' : ''; ?>" href="<?php echo esc_url($event_url); ?>"<?php echo 'event' === $category_slug ? ' aria-current="page"' : ''; ?>>EVENT</a>
          </div>
        </nav>
      </div>
      <figure class="p-single-blog__hero-image">
        <?php echo $render_image($hero_image_id, 'blog6.jpg', get_the_title(), 1000, 1500, false); ?>
      </figure>
    </header>

    <?php if ($is_works && $works_overview_rows) : ?>
      <section class="p-single-blog__works-overview" aria-label="施工事例の建物情報">
        <div class="l-inner">
          <table class="p-single-blog__works-overview-table">
            <caption>DATE</caption>
            <colgroup>
              <col class="p-single-blog__works-overview-label-column">
              <col class="p-single-blog__works-overview-value-column">
              <col class="p-single-blog__works-overview-label-column">
              <col class="p-single-blog__works-overview-value-column">
            </colgroup>
            <tbody>
              <?php foreach ($works_overview_rows as $overview_row) : ?>
                <tr<?php echo null === $overview_row['right'] ? ' class="p-single-blog__works-overview-material"' : ''; ?>>
                  <th scope="row"><?php echo esc_html($overview_row['left']['label']); ?></th>
                  <?php if (null === $overview_row['right']) : ?>
                    <td colspan="3"><?php echo esc_html($overview_row['left']['value']); ?></td>
                  <?php else : ?>
                    <td><?php echo esc_html($overview_row['left']['value']); ?></td>
                    <th scope="row"><?php echo esc_html($overview_row['right']['label']); ?></th>
                    <td><?php echo esc_html($overview_row['right']['value']); ?></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>
    <?php endif; ?>

    <div class="p-single-blog__body l-inner">
      <?php if ($is_works) : ?>
      <section class="p-single-blog__section">
        <div class="p-single-blog__text-block">
          <h2 class="p-single-blog__heading"><?php echo $render_heading($intro_heading); ?></h2>
          <p class="p-single-blog__text"><?php echo esc_html($intro_text); ?></p>
        </div>
        <div class="p-single-blog__gallery p-single-blog__gallery--four">
          <figure><?php echo $render_image($get_detail('works_gallery_1'), 'blog_8.jpg', get_the_title(), 2000, 3000); ?></figure>
          <figure><?php echo $render_image($get_detail('works_gallery_2'), 'blog_2.jpg', get_the_title(), 1000, 1500); ?></figure>
          <figure><?php echo $render_image($get_detail('works_gallery_3'), 'blog_7.jpg', get_the_title(), 1000, 1500); ?></figure>
          <figure><?php echo $render_image($get_detail('works_gallery_4'), 'blog_5.jpg', get_the_title(), 1000, 1500); ?></figure>
        </div>
      </section>

      <section class="p-single-blog__section">
        <figure class="p-single-blog__wide-image">
          <?php echo $render_image($get_detail('works_second_image'), 'blog_1.jpg', get_the_title(), 1000, 1500); ?>
        </figure>
        <div class="p-single-blog__text-block">
          <h2 class="p-single-blog__heading"><?php echo $render_heading($second_heading); ?></h2>
          <p class="p-single-blog__text"><?php echo esc_html($second_text); ?></p>
        </div>
      </section>

      <section class="p-single-blog__section">
        <div class="p-single-blog__pair">
          <figure><?php echo $render_image($get_detail('works_pair_1'), 'blog_6.jpg', get_the_title(), 2000, 3000); ?></figure>
          <figure><?php echo $render_image($get_detail('works_pair_2'), 'blog_4.jpg', get_the_title(), 1000, 1500); ?></figure>
        </div>
        <div class="p-single-blog__text-block p-single-blog__text-block--right">
          <h2 class="p-single-blog__heading"><?php echo $render_heading($third_heading); ?></h2>
          <p class="p-single-blog__text"><?php echo esc_html($third_text); ?></p>
        </div>
      </section>

      <div class="p-single-blog__section p-single-blog__section--before-after">
        <figure class="p-single-blog__before-after-image">
          <?php echo $render_image($get_detail('works_before_image'), 'blog_2.jpg', get_the_title(), 1000, 1500); ?>
          <figcaption>BEFORE</figcaption>
        </figure>
        <figure class="p-single-blog__before-after-image">
          <?php echo $render_image($get_detail('works_after_image'), 'blog_8.jpg', get_the_title(), 2000, 3000); ?>
          <figcaption>AFTER</figcaption>
        </figure>
        <p class="p-single-blog__text"><?php echo esc_html($before_after_text); ?></p>
      </div>
      <?php else : ?>
        <section class="p-single-blog__section">
          <div class="p-single-blog__editor-content">
            <?php the_content(); ?>
          </div>
        </section>
      <?php endif; ?>

      <section class="p-single-blog__other">
        <h2 class="p-single-blog__other-heading">OTHER</h2>
        <div class="p-single-blog__other-grid">
          <?php while ($other_posts->have_posts()) : ?>
            <?php
            $other_posts->the_post();
            $other_categories = get_the_category();
            $other_category_label = $other_categories ? $other_categories[0]->name : $category_label;
            $other_category_slug = $other_categories ? $other_categories[0]->slug : $category_slug;
            $other_category_en = isset($single_category_config[$other_category_slug])
              ? $single_category_config[$other_category_slug]['en']
              : strtoupper($other_category_slug);
            $other_spec = function_exists('get_field') ? get_field('works_spec') : get_post_meta(get_the_ID(), 'works_spec', true);
            $other_spec = $other_spec ?: get_the_excerpt();
            $other_building_type = function_exists('get_field') ? get_field('works_building_type') : get_post_meta(get_the_ID(), 'works_building_type', true);
            $other_building_type = $other_building_type ?: '二階建て';
            $other_thumbnail_id = get_post_thumbnail_id();
            $other_thumbnail_alt = $other_thumbnail_id ? get_post_meta($other_thumbnail_id, '_wp_attachment_image_alt', true) : '';
            ?>
            <a class="p-single-blog__other-card" href="<?php the_permalink(); ?>">
              <div class="p-single-blog__other-meta">
                <div class="p-single-blog__other-meta-primary">
                  <span class="p-single-blog__other-category"><?php echo esc_html($other_category_en ?: $other_category_label); ?></span>
                  <?php if ($is_works) : ?>
                    <span class="p-single-blog__other-type"><?php echo esc_html($other_building_type); ?></span>
                  <?php endif; ?>
                </div>
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
              </div>
              <figure>
                <?php if ($other_thumbnail_id) : ?>
                  <?php echo wp_get_attachment_image($other_thumbnail_id, 'large', false, array('alt' => $other_thumbnail_alt ?: get_the_title(), 'loading' => 'lazy', 'decoding' => 'async')); ?>
                <?php else : ?>
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/works_02.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="1200" height="1201" loading="lazy" decoding="async">
                <?php endif; ?>
              </figure>
              <?php if ($other_spec) : ?>
                <p class="p-single-blog__other-spec"><?php echo esc_html($other_spec); ?></p>
              <?php endif; ?>
              <h3><?php the_title(); ?></h3>
            </a>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>
        <nav class="p-single-blog__other-pages" aria-label="カテゴリーページを切り替える">
          <div class="p-single-blog__other-pages-heading">
            <p class="p-single-blog__other-pages-title">PAGES</p>
            <a class="c-button-list" href="<?php echo esc_url($archive_url); ?>">
              <span>一覧へ</span>
              <span class="c-button-list__arrow" aria-hidden="true"></span>
            </a>
          </div>
          <div class="p-single-blog__other-pages-links">
            <a class="p-single-blog__other-pages-link c-hover-invert c-hover-invert--dark" href="<?php echo esc_url($works_url); ?>">WORKS</a>
            <a class="p-single-blog__other-pages-link c-hover-invert c-hover-invert--dark" href="<?php echo esc_url($event_url); ?>">EVENT</a>
            <a class="p-single-blog__other-pages-link c-hover-invert c-hover-invert--dark" href="<?php echo esc_url($column_url); ?>">COLUMN</a>
          </div>
        </nav>
        <?php
        get_template_part(
          'includes/banner',
          null,
          array(
            'modifier' => 'p-banner--other',
            'with_inner' => false,
          )
        );
        ?>
      </section>
    </div>
  </article>

  <?php get_template_part('includes/contact'); ?>
</main>

<?php
  endwhile;
endif;

get_footer();
?>
