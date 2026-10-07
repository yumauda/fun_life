<?php get_header(); ?>
<main>
  <div class="p-mv">
    <div class="l-inner">
      <div class="p-mv__content">
        <div class="p-mv__video">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/mv_pc.webp" alt="動画" width="900" height="480">
        </div>
        <!-- <video src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/mv.mp4" autoplay muted loop playsinline></video> -->
      </div>
    </div>
  </div>
  <section class="p-no">
    <div class="l-inner">
      <div class="p-no__content">
        <h2 class="p-no__title">No Fun No Life</h2>
        <div class="p-no__top-row">
          <div class="p-no__top-detail">
            <p class="p-no__lead">好きも、暮らしも、<br class="u-mobile">全部こだわる。</p>
            <p class="p-no__text p-no__text--main">
              家って、ただ住む箱じゃない。<br class="u-mobile">毎日帰って、笑って、落ち着いて、人生のほとんどを過ごす場所。だからファンライフは、むやみに棟数を増やさない。性能は、本当にいいと思えるものを。でも、間取りもデザイン性能も、「こうじゃないとダメ」とは言いません。
            </p>
          </div>
          <figure class="p-no__top-img c-parallax js-parallax">
            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/no_1.jpg" alt="ファンライフ株式会社" width="500" height="500">
          </figure>

        </div>
        <div class="p-no__second">
          <p class="p-no__text p-no__text--sub">
            大事にしているのはどう売るかより<br>
            「どう暮らしたいか」。妥協しない。<br>
            ちゃんと、自分たちの家をつくる。
          </p>
          <figure class="p-no__second-img c-parallax js-parallax">
            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/no_2.webp" alt="ファンライフ株式会社" width="350" height="270">
          </figure>

        </div>

        <div class="p-no__concept" id="concept">
          <div class="p-no__concept-detail">
            <p class="p-no__concept-title">about</p>
            <a href="#" class="p-no__concept-button c-hover-invert">view more</a>
          </div>
          <figure class="p-no__concept-img c-parallax js-parallax">
            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/concept_img.webp" alt="concept" width="600" height="400">
          </figure>
        </div>
      </div>
    </div>
    <?php
    $event_category = get_category_by_slug('news');
    $event_archive_url = fun_life_category_url('news');
    $event_query_args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => 5,
      'ignore_sticky_posts' => true,
    );

    if ($event_category instanceof WP_Term) {
      $event_query_args['cat'] = $event_category->term_id;
    } else {
      $event_query_args['category_name'] = 'news';
    }

    $event_posts = new WP_Query($event_query_args);
    ?>
    <?php if ($event_posts->have_posts()) : ?>
      <section class="p-home-event" aria-labelledby="home-event-title">
        <div class="l-inner p-home-event__inner">
          <div class="p-home-event__heading">
            <h2 class="p-home-event__title" id="home-event-title">お知らせ</h2>
            <div class="p-home-event__eyebrow-row">
              <p class="p-home-event__eyebrow">NEWS</p>
              <span class="p-home-event__heading-line" aria-hidden="true"></span>
            </div>
          </div>
        </div>
        <div class="p-home-event__slider-shell">
          <div class="swiper p-home-event__slider js-home-event-slider">
            <div class="swiper-wrapper">
              <?php while ($event_posts->have_posts()) : ?>
                <?php
                $event_posts->the_post();
                $event_categories = get_the_category();
                $event_category_label = 'お知らせ';
                $event_thumbnail_id = get_post_thumbnail_id();
                $event_thumbnail_alt = $event_thumbnail_id ? get_post_meta($event_thumbnail_id, '_wp_attachment_image_alt', true) : '';
                $event_date = get_post_meta(get_the_ID(), 'event_date', true);
                $event_location = get_post_meta(get_the_ID(), 'event_location', true);

                if (!$event_location) {
                  $event_location = get_post_meta(get_the_ID(), 'event_place', true);
                }

                foreach ($event_categories as $post_event_category) {
                  if ('news' === $post_event_category->slug) {
                    $event_category_label = $post_event_category->name;
                    break;
                  }
                }
                ?>
                <div class="swiper-slide">
                  <article class="p-home-event__card">
                    <a class="p-home-event__card-link" href="<?php the_permalink(); ?>">
                      <div class="p-home-event__meta">
                        <span class="p-home-event__label">NEWS</span>
                        <span class="p-home-event__category"><?php echo esc_html($event_category_label); ?></span>
                        <time class="p-home-event__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                      </div>
                      <figure class="p-home-event__image">
                        <?php if ($event_thumbnail_id) : ?>
                          <?php echo wp_get_attachment_image($event_thumbnail_id, 'large', false, array('alt' => $event_thumbnail_alt ?: get_the_title(), 'loading' => 'lazy', 'decoding' => 'async')); ?>
                        <?php else : ?>
                          <img src="<?php echo esc_url(get_template_directory_uri() . '/images/top/no_new.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="1600" height="1401" loading="lazy" decoding="async">
                        <?php endif; ?>
                      </figure>
                      <h3 class="p-home-event__card-title"><?php the_title(); ?></h3>
                      <dl class="p-home-event__details">
                        <?php if ($event_date || $event_location) : ?>
                          <?php if ($event_date) : ?>
                            <div class="p-home-event__detail-row">
                              <dt>日　時</dt>
                              <dd><?php echo esc_html($event_date); ?></dd>
                            </div>
                          <?php endif; ?>
                          <?php if ($event_location) : ?>
                            <div class="p-home-event__detail-row">
                              <dt>場　所</dt>
                              <dd><?php echo esc_html($event_location); ?></dd>
                            </div>
                          <?php endif; ?>
                        <?php else : ?>
                          <div class="p-home-event__detail-row">
                            <dt>公 開 日</dt>
                            <dd><?php echo esc_html(get_the_date('Y年 m月 d日')); ?></dd>
                          </div>
                        <?php endif; ?>
                      </dl>
                    </a>
                  </article>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
        <div class="p-home-event__footer">
          <div class="p-home-event__controls">
            <button class="p-home-event__arrow p-home-event__arrow--prev js-home-event-prev" type="button" aria-label="前の記事を表示"></button>
            <p class="p-home-event__counter" aria-live="polite">
              <span class="js-home-event-current">1</span>
              <span aria-hidden="true"> / </span>
              <span class="js-home-event-total"><?php echo esc_html((string) $event_posts->post_count); ?></span>
            </p>
            <button class="p-home-event__arrow p-home-event__arrow--next js-home-event-next" type="button" aria-label="次の記事を表示"></button>
          </div>
          <div class="p-home-event__more-row">
            <span class="p-home-event__footer-line" aria-hidden="true"></span>
            <a class="p-home-event__more c-hover-invert" href="<?php echo esc_url($event_archive_url); ?>">View More</a>
          </div>
        </div>
      </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <div class="l-inner">
      <div class="p-no__content">
        <figure class="p-no__bottom c-parallax js-parallax">
          <picture>
            <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/no_bottom.webp" media="(min-width: 768px)" width="1238" height="570">
            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/no_bottom_sp.webp" alt="" width="375" height="137">
          </picture>
        </figure>
      </div>
    </div>
  </section>
  <section class="p-no-works" id="works">
    <div class="l-inner">
      <h2 class="p-no-works__title">WORKS</h2>
    </div>

    <?php
    $project_examples_fallback = array(
      array(
        'title' => '菊池市泗水町吉富/36坪 5LDK＋書斎',
        'url' => '',
        'images' => array(
          array('attachment_id' => 0, 'name' => 'project-example-1-1.webp', 'width' => 1620, 'height' => 1080),
          array('attachment_id' => 0, 'name' => 'project-example-1-3.webp', 'width' => 1080, 'height' => 1620),
          array('attachment_id' => 0, 'name' => 'project-example-1-2.webp', 'width' => 1080, 'height' => 1620),
        ),
      ),
      array(
        'title' => '熊本市北区龍田 /29坪 バイクガレージ付2LDK',
        'url' => '',
        'images' => array(
          array('attachment_id' => 0, 'name' => 'project-example-2-1.webp', 'width' => 1620, 'height' => 1080),
          array('attachment_id' => 0, 'name' => 'project-example-2-3.webp', 'width' => 1080, 'height' => 1620),
          array('attachment_id' => 0, 'name' => 'project-example-2-2.webp', 'width' => 1080, 'height' => 1620),
        ),
      ),
      array(
        'title' => '上益城郡御船町豊秋/27.3坪/2LDK',
        'url' => '',
        'images' => array(
          array('attachment_id' => 0, 'name' => 'project-example-3-1.webp', 'width' => 1170, 'height' => 878),
          array('attachment_id' => 0, 'name' => 'project-example-3-3.webp', 'width' => 1600, 'height' => 2400),
          array('attachment_id' => 0, 'name' => 'project-example-3-2.webp', 'width' => 1600, 'height' => 2400),
        ),
      ),
    );
    $works_category = get_category_by_slug('works');

    if (!$works_category instanceof WP_Term) {
      $works_category = get_category_by_slug('blog-works');
    }

    if (!$works_category instanceof WP_Term) {
      $works_category = get_term_by('name', '施工事例', 'category');
    }

    $works_archive_url = $works_category instanceof WP_Term
      ? get_category_link($works_category)
      : fun_life_category_url('works');
    $project_examples = array();

    if ($works_category instanceof WP_Term) {
      $works_posts = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'cat' => $works_category->term_id,
        'ignore_sticky_posts' => true,
      ));

      while ($works_posts->have_posts()) {
        $works_posts->the_post();
        $project_images = array();
        $project_image_ids = array();

        foreach (array('works_top_slider_1', 'works_top_slider_2', 'works_top_slider_3') as $works_image_field) {
          $works_image_id = function_exists('get_field')
            ? get_field($works_image_field)
            : get_post_meta(get_the_ID(), $works_image_field, true);

          if (is_array($works_image_id) && isset($works_image_id['ID'])) {
            $works_image_id = $works_image_id['ID'];
          }

          $project_image_ids[] = (int) $works_image_id;
        }

        $project_image_ids = array_values(array_unique(array_filter(array_map('intval', $project_image_ids))));

        if (!$project_image_ids) {
          $project_image_ids = array(get_post_thumbnail_id());

          foreach (array('works_gallery_1', 'works_gallery_2', 'works_gallery_3', 'works_gallery_4') as $works_image_field) {
            $works_image_id = function_exists('get_field')
              ? get_field($works_image_field)
              : get_post_meta(get_the_ID(), $works_image_field, true);

            if (is_array($works_image_id) && isset($works_image_id['ID'])) {
              $works_image_id = $works_image_id['ID'];
            }

            $project_image_ids[] = (int) $works_image_id;
          }
        }

        foreach (array_unique(array_filter(array_map('intval', $project_image_ids))) as $project_image_id) {
          $project_images[] = array(
            'attachment_id' => $project_image_id,
            'name' => '',
            'width' => 0,
            'height' => 0,
          );

          if (3 === count($project_images)) {
            break;
          }
        }

        if (!$project_images) {
          $fallback_index = count($project_examples) % count($project_examples_fallback);
          $project_images = $project_examples_fallback[$fallback_index]['images'];
        }

        $project_examples[] = array(
          'title' => get_the_title(),
          'url' => get_permalink(),
          'images' => $project_images,
        );
      }

      wp_reset_postdata();
    }

    if (!$project_examples) {
      $project_examples = $project_examples_fallback;
    }
    ?>
    <section class="p-top-project" aria-labelledby="top-project-title">
      <div class="l-inner">
        <div class="p-top-project__content">
          <div class="p-top-project__detail">
            <h2 class="p-top-project__title" id="top-project-title">施工事例</h2>
            <p class="p-top-project__en">PROJECT EXAMPLES</p>
          </div>
        </div>
      </div>
      <div class="p-top-project__list">
        <?php foreach ($project_examples as $project_index => $project_example) : ?>
          <article class="p-top-project__item js-top-project-item">
            <div class="p-top-project__slider-shell">
              <div class="swiper p-top-project__slider js-top-project-slider">
                <div class="swiper-wrapper">
                  <?php foreach ($project_example['images'] as $image_index => $image) : ?>
                    <div class="swiper-slide">
                      <?php if ($project_example['url']) : ?>
                        <a class="p-top-project__slide-link" href="<?php echo esc_url($project_example['url']); ?>">
                        <?php endif; ?>
                        <figure class="p-top-project__img">
                          <?php if ($image['attachment_id']) : ?>
                            <?php echo wp_get_attachment_image($image['attachment_id'], 'large', false, array('alt' => $project_example['title'] . 'の施工事例写真' . ($image_index + 1), 'loading' => 'lazy', 'decoding' => 'async')); ?>
                          <?php else : ?>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/top/' . $image['name']); ?>" alt="<?php echo esc_attr($project_example['title'] . 'の施工事例写真' . ($image_index + 1)); ?>" width="<?php echo esc_attr((string) $image['width']); ?>" height="<?php echo esc_attr((string) $image['height']); ?>" loading="lazy" decoding="async">
                          <?php endif; ?>
                        </figure>
                        <?php if ($project_example['url']) : ?>
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="l-inner">
              <div class="p-top-project__meta">
                <h3 class="p-top-project__text">
                  <?php if ($project_example['url']) : ?>
                    <a href="<?php echo esc_url($project_example['url']); ?>"><?php echo esc_html($project_example['title']); ?></a>
                  <?php else : ?>
                    <?php echo esc_html($project_example['title']); ?>
                  <?php endif; ?>
                </h3>
                <div class="p-top-project__controls">
                  <button class="p-top-project__arrow p-top-project__arrow--prev js-top-project-prev" type="button" aria-label="<?php echo esc_attr(($project_index + 1) . 'つ目の施工事例で前の写真を表示'); ?>"></button>
                  <p class="p-top-project__counter" aria-live="polite">
                    <span class="js-top-project-current">1</span>
                    <span aria-hidden="true"> / </span>
                    <span class="js-top-project-total"><?php echo esc_html((string) count($project_example['images'])); ?></span>
                  </p>
                  <button class="p-top-project__arrow p-top-project__arrow--next js-top-project-next" type="button" aria-label="<?php echo esc_attr(($project_index + 1) . 'つ目の施工事例で次の写真を表示'); ?>"></button>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      <div class="p-top-project__more">
        <span class="p-top-project__more-line" aria-hidden="true"></span>
        <a href="<?php echo esc_url($works_archive_url); ?>" class="p-top-project__more-link c-hover-invert">View More</a>
      </div>
    </section>

    <div class="l-inner">
      <div class="p-no-works__body">
        <div class="p-no-works__detail">
          <div class="p-no-works__heading">
            <p class="p-no-works__category">新築住宅</p>
            <p class="p-no-works__eyebrow">DESIGNED FOR LIVING</p>
          </div>
          <div class="p-no-works__lead">
            <p>
              ファンライフの新築は、ただ新しい家を建てることではありません。これから先の暮らしを、もっと楽しく、もっと快適にするための家づくりです。性能はしっかり。でも、間取りやデザインに決まった型はありません。家事のしやすさ、家族との過ごし方、好きな空間や落ち着く時間まで、一人ひとり違う理想の暮らしに合わせて、1棟1棟丁寧につくり上げていきます。
            </p>
          </div>
        </div>
        <figure class="p-no-works__image c-parallax js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/no_new.webp" alt="新築住宅" width="500" height="500">

        </figure>
      </div>
      <div class="p-no-works__performance">
        <div class="p-no-works__performance-main">
          <h3 class="p-no-works__performance-title">基本性能</h3>
          <ul class="p-no-works__specs">
            <li class="p-no-works__spec">
              <span class="p-no-works__spec-label">断熱</span>
              <span class="p-no-works__spec-text">HEAT20評価基準G2 / UA値0.46以下</span>
            </li>
            <li class="p-no-works__spec">
              <span class="p-no-works__spec-label">気密</span>
              <span class="p-no-works__spec-text">C値0.1~0.5㎠/㎡</span>
            </li>
            <li class="p-no-works__spec">
              <span class="p-no-works__spec-label">換気</span>
              <span class="p-no-works__spec-text">ダクトレス</span>
            </li>
            <li class="p-no-works__spec">
              <span class="p-no-works__spec-label">耐震</span>
              <span class="p-no-works__spec-text">耐震等級3取得</span>
            </li>
          </ul>
        </div>
        <p class="p-no-works__performance-text">
          お客様の好みやこだわりに合わせて、さまざまなデザインに対応しています。<br>カッコイイも、カワイイも、暮らしやすさを追求するのも自由。<br>大切なのは、あなたらしい家であること。一緒に、自分たちだけのデザインを見つけましょう。
        </p>
      </div>
      <figure class="p-no-works__bottom c-parallax js-parallax">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/images/top/no_works_bottom.webp" media="(min-width: 768px)" width="1238" height="570" />
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/no_works_bottom_sp.webp" alt="" width="375" height="137">
        </picture>
      </figure>
    </div>
  </section>

  <section class="p-modular is-mobile-awaiting-selection" id="modular">
    <!-- ダミー外観写真: Pexels / Max Vakhtbovych（photo IDs 7587854–7587884） -->
    <div class="l-inner">
      <div class="p-modular__content">
        <div class="p-modular__heading">
          <p class="p-modular__category">規格住宅</p>
          <h2 class="p-modular__title">MODULAR HOME</h2>
        </div>
        <p class="p-modular__lead">
          規格住宅とは、プロが厳選した間取りやデザイン(型)を<br class="u-desktop">ベースに建てるお家です。
        </p>
        <div class="p-modular__body">
          <div class="p-modular__menu" aria-label="規格住宅プラン">
            <p class="p-modular__menu-title">シンプルモダン</p>
            <div class="p-modular__menu-row p-modular__menu-row--primary" data-modular-group="simple">
              <button class="p-modular__menu-button" type="button" aria-expanded="false" aria-controls="modular-simple-options">平屋</button>
              <div class="p-modular__sub-menu" id="modular-simple-options" aria-label="シンプルモダン 平屋">
                <button class="p-modular__sub-button is-active" type="button" data-modular-target="koti">コティ</button>
                <button class="p-modular__sub-button" type="button" data-modular-target="root">ルートゥ</button>
                <button class="p-modular__sub-button" type="button" data-modular-target="polku">ポルク</button>
                <button class="p-modular__sub-button" type="button" data-modular-target="perhe">ペルヘ</button>
              </div>
            </div>
            <div class="p-modular__additional-menu">
              <div class="p-modular__menu-row" data-modular-group="courtyard">
                <button class="p-modular__menu-button" type="button">中庭の家</button>
              </div>
              <div class="p-modular__menu-row" data-modular-group="second">
                <button class="p-modular__menu-button" type="button">2階リビング</button>
              </div>
              <div class="p-modular__menu-row" data-modular-group="skiphous">
                <button class="p-modular__menu-button" type="button">スキップフロア</button>
              </div>
              <div class="p-modular__menu-row" data-modular-group="earth">
                <button class="p-modular__menu-button" type="button">土間の家</button>
              </div>
              <p class="p-modular__menu-title p-modular__menu-title--mt">ワンルーム</p>
              <p class="p-modular__menu-title p-modular__menu-title--mt">ガレージハウス</p>
            </div>
          </div>
          <div class="p-modular__main">
            <div class="p-modular__panels" aria-live="polite">
              <div class="p-modular__panel is-active" data-modular-panel="koti">
                <div class="swiper p-modular__slider">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-koti-01.webp" alt="平屋の規格住宅 コティの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>「住むという空間を、<br class="u-mobile">とことん追求した家。」</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-koti-02.webp" alt="平屋の規格住宅 コティの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>「住むという空間を、<br class="u-mobile">とことん追求した家。」</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-modular__panel" data-modular-panel="root">
                <div class="swiper p-modular__slider">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-root-01.webp" alt="平屋の規格住宅 ルートゥの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>中庭を中心に、外と内がゆるやかにつながる住まい。</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-root-02.webp" alt="平屋の規格住宅 ルートゥの外観イメージ" width="1800" height="1200">
                          </figure>
                          <p class="p-modular__slider-note"><span>中庭を中心に、外と内がゆるやかにつながる住まい。</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-modular__panel" data-modular-panel="polku">
                <div class="swiper p-modular__slider">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-polku-01.webp" alt="平屋の規格住宅 ポルクの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>光と眺めを取り込む、2階リビングの暮らし。</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-polku-02.webp" alt="平屋の規格住宅 ポルクの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>光と眺めを取り込む、2階リビングの暮らし。</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-modular__panel" data-modular-panel="perhe">
                <div class="swiper p-modular__slider">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-perhe-01.webp" alt="平屋の規格住宅 ペルヘの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>段差で空間を分け、家族の距離が近くなる住まい。</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="p-modular__card">
                        <div class="p-modular__card-visual">
                          <figure class="p-modular__image">
                            <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/modular-perhe-02.webp" alt="平屋の規格住宅 ペルヘの外観イメージ" width="1800" height="1201">
                          </figure>
                          <p class="p-modular__slider-note"><span>段差で空間を分け、家族の距離が近くなる住まい。</span></p>
                        </div>
                        <p class="p-modular__description">資料の平面を再現し設計とアイデアを反映したCONCEPTモデルです。<br>シンプルタイプを中心にとして画像でみることで細かな注文住宅の空間をお届けします。</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <p class="p-modular__more">and more...</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="p-top-gallery">
    <div class="l-inner">
      <div class="p-top-gallery__content">
        <figure class="p-top-gallery__top-img c-parallax c-parallax--strong js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/top_gallery1.webp" alt="猫ちゃん" width="360" height="360">
        </figure>
        <figure class="p-top-gallery__top-img2 c-parallax c-parallax--strong js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/top_gallery2.webp" alt="カップルの写真" width="1080" height="529">
        </figure>
      </div>
    </div>

  </div>
  <section class="p-reform" id="reform">
    <div class="l-inner">
      <div class="p-reform__content">
        <div class="p-reform__heading">
          <h2 class="p-reform__title">
            <span class="p-reform__title-ja">リフォーム / リノベーション</span>
            <span class="p-reform__title-en">REFORM / RENOVATION</span>
          </h2>
        </div>
        <div class="p-reform__body">
          <div class="p-reform__item p-reform__item--before">
            <figure class="p-reform__image c-parallax js-parallax">
              <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/images/top/reform_1.webp" media="(min-width: 768px)" width="500" height="500" />
                <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/reform_1_sp.webp" alt="リフォーム前の暮らしのイメージ" width="375" height="227">
              </picture>
            </figure>
            <p class="p-reform__text">
              リフォームは、古くなった家を直すだけではありません。住み慣れた家や家族の思い出を残しながら今の暮らしに合った住まいへアップデートしていく方法です。新築ではなく「この家でこれからも暮らしたい」という想いに寄り添いながら暮らしやすさやデザインまで丁寧に考えこれからの毎日がもっと快適になるリフォームを提案しています。
            </p>
          </div>
          <div class="p-reform__item p-reform__item--after">
            <figure class="p-reform__image c-parallax js-parallax">
              <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/images/top/reform_2.webp" media="(min-width: 768px)" width="500" height="500" />
                <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/reform_2_sp.webp" alt="リフォーム後の住まいのイメージ" width="375" height="227">
              </picture>
            </figure>
            <p class="p-reform__text">
              家には、たくさんの思い出や、これまでの暮らしが詰まっています。だからこそファンライフは新しく建て替えるだけではなく、今ある家を活かすという選択も大切にしています。家族の記憶を残しながらこれからの暮らしがもっと快適になるように。そんな想いを込めて、一つひとつ丁寧にリフォームを行っています。
            </p>
          </div>
        </div>
        <figure class="p-reform__bottom c-parallax js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/reform_3.webp" alt="リフォーム後の暮らしを楽しむイメージ" width="930" height="340">
        </figure>
      </div>
    </div>
  </section>
  <section class="p-home-model-house" aria-labelledby="home-model-house-title">
    <div class="l-inner">
      <div class="p-home-model-house__content">
        <div class="p-home-model-house__heading">
          <h2 class="p-home-model-house__heading-ja" id="home-model-house-title">モデルハウス</h2>
          <p class="p-home-model-house__heading-en">MODELHOUSE</p>
        </div>
        <div class="p-home-model-house__layout">
          <div class="p-home-model-house__detail">
            <h3 class="p-home-model-house__title">宿泊体験型モデルハウス<br>「そのうち」</h3>
            <p class="p-home-model-house__address">〒861-3202 熊本県上益城郡御船町小坂999-3</p>
            <p class="p-home-model-house__text">「そのうち」は、ファンライフが自信を持ってご提案する宿泊体験型モデルハウスです。特別な仕様や高額なオプションではなく、ファンライフの標準仕様で建てた“等身大の家”。断熱・気密・換気・耐震のバランスが取れた住まいで、実際の暮らしに近い住み心地をご体感いただけます。いつか住みたくなるその時まで。家づくりについて、ゆっくり考えられる場所です。</p>
            <a class="p-home-model-house__button c-hover-invert" href="<?php echo esc_url(home_url('/contact/')); ?>">
              <svg class="p-home-model-house__button-icon" aria-hidden="true" viewBox="0 0 32 34" width="32" height="34">
                <path d="M4 2h14l7 7v9"></path>
                <path d="M18 2v7h7"></path>
                <path d="M18 32H4V2"></path>
                <path d="M9 14h10M9 19h10M9 24h7"></path>
                <path d="m18 27 9-9 3 3-9 9-4 1 1-4Z"></path>
              </svg>
              <span>ご予約はこちら</span>
            </a>
          </div>
          <div class="p-home-model-house__visual">
            <div class="p-home-model-house__status">
              <div class="p-home-model-house__progress" aria-label="モデルハウス画像を選択">
                <button class="p-home-model-house__progress-item is-active" type="button" aria-label="1枚目を表示" aria-current="true"></button>
                <button class="p-home-model-house__progress-item" type="button" aria-label="2枚目を表示"></button>
                <button class="p-home-model-house__progress-item" type="button" aria-label="3枚目を表示"></button>
                <button class="p-home-model-house__progress-item" type="button" aria-label="4枚目を表示"></button>
              </div>
              <p class="p-home-model-house__count" aria-live="polite">
                <span class="p-home-model-house__count-current">1</span><span class="p-home-model-house__count-rest">/<span class="p-home-model-house__count-total">4</span></span>
              </p>
            </div>
            <div class="p-home-model-house__slider js-home-model-house-slider" role="region" aria-roledescription="carousel" aria-label="モデルハウスの写真" tabindex="0">
              <div class="p-home-model-house__slides">
                <div class="p-home-model-house__slide is-active" aria-hidden="false">
                  <figure class="p-home-model-house__image">
                    <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/home_model_house.webp" alt="宿泊体験型モデルハウス「そのうち」の外観" width="2400" height="1600">
                  </figure>
                </div>
                <div class="p-home-model-house__slide" aria-hidden="true">
                  <figure class="p-home-model-house__image">
                    <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/project-example-1-1.webp" alt="モデルハウスのイメージ" width="1620" height="1080">
                  </figure>
                </div>
                <div class="p-home-model-house__slide" aria-hidden="true">
                  <figure class="p-home-model-house__image">
                    <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/project-example-2-1.webp" alt="モデルハウスのイメージ" width="1620" height="1080">
                  </figure>
                </div>
                <div class="p-home-model-house__slide" aria-hidden="true">
                  <figure class="p-home-model-house__image">
                    <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/project-example-3-1.webp" alt="モデルハウスのイメージ" width="1170" height="878">
                  </figure>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="p-image">
    <div class="l-inner">
      <div class="p-image__content">
        <figure class="p-image__img1 c-parallax c-parallax--strong js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/image_1.webp" alt="サーフボードを持つ男性" width="431" height="38">
        </figure>
        <figure class="p-image__img2 c-parallax c-parallax--strong js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/image_2.webp" alt="室内で過ごす猫" width="431" height="38">
        </figure>
      </div>
    </div>
  </div>
  <div class="p-image p-image--bottom">
    <div class="l-inner">
      <div class="p-image__content">
        <figure class="p-image__img3 c-parallax c-parallax--strong js-parallax">
          <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/image_3.webp" alt="リフォーム後の暮らしを楽しむイメージ" width="431" height="38">
        </figure>
      </div>
    </div>
  </div>
  <?php get_template_part("includes/contact"); ?>

</main>
<?php get_footer() ?>
