<?php get_header(); ?>
<main>
  <section class="p-works-feature">
    <div class="l-inner">
      <div class="p-works-feature__content">
        <div class="c-section-heading c-section-heading--ja-first">
          <div class="c-section-heading__index" aria-hidden="true">
            <span class="c-section-heading__label">WORKS</span>
            <span class="c-section-heading__number">01</span>
          </div>
          <div class="c-section-heading__body">
            <p class="c-section-heading__en">CONCEPT</p>
            <h1 class="c-section-heading__ja">ずっと、となりで。</h1>
          </div>
        </div>
        <div class="p-works-feature__body">
          <figure class="p-works-feature__image">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/works_01.webp" alt="家づくりに伴走するファンライフの担当者" width="1401" height="1401" loading="lazy" decoding="async">
          </figure>
          <div class="p-works-feature__detail">
            <h2 class="p-works-feature__title">土地探しから完成まで。<br>同じ担当者が最後まで伴走します。</h2>
            <p class="p-works-feature__text">ファンライフでは、お客さまとの最初の打ち合わせからお引き渡しまで、一人の担当者が責任を持って対応していきます。土地探しや資金計画、プランニング、現場での進捗確認まで一貫して関わることで、お客さまのご要望や想いをしっかり共有しながら家づくりを進めていきます。</p>
            <p class="p-works-feature__text">また、私たちは少数精鋭の体制で運営しているため、土地が未確定の段階での詳細なプラン作成やお見積りのご提示は行っておりません。その代わり、家づくりへのお気持ちや方向性をしっかり共有いただいた上で、一組一組のお客さまに丁寧に向き合うことを大切にしています。担当者が変わらない安心感と、最後まで寄り添う家づくり。それがファンライフの考える住まいづくりです。</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="p-works-feature p-works-feature--reverse">
    <div class="l-inner">
      <div class="p-works-feature__content">
        <div class="c-section-heading">
          <div class="c-section-heading__index" aria-hidden="true">
            <span class="c-section-heading__label">WORKS</span>
            <span class="c-section-heading__number">02</span>
          </div>
          <div class="c-section-heading__body">
            <p class="c-section-heading__en">DESIGNED FOR LIVING</p>
            <h2 class="c-section-heading__ja">暮らしから考える家づくり。</h2>
          </div>
        </div>
        <div class="p-works-feature__body-wrapper">
          <div class="p-works-feature__body">
            <figure class="p-works-feature__image">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/works_02.webp" alt="ゆとりを愉しむ平屋の外観" width="1200" height="1201" loading="lazy" decoding="async">
            </figure>
            <div class="p-works-feature__detail">
              <h3 class="p-works-feature__title">ゆとりを愉しむ平屋</h3>
              <p class="p-works-feature__label">HIRAYA</p>
              <p class="p-works-feature__text">ワンフロアで暮らしが完結する平屋は、動線のない快適な間取りと、家族の気配を感じやすい一体感が魅力です。天井を高くしたり、大きな窓を設けたりと、開放感のある空間づくりとの相性も抜群。庭やウッドデッキとのつながりを楽しめるのも平屋ならではです。</p>
            </div>
          </div>
          <div class="p-works-feature__body">
            <figure class="p-works-feature__image">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/works_03.webp" alt="ゆとりを愉しむ平屋の外観" width="1200" height="1201" loading="lazy" decoding="async">
            </figure>
            <div class="p-works-feature__detail">
              <h3 class="p-works-feature__title">暮らしが広がる二階建て</h3>
              <p class="p-works-feature__label">TWO STORY</p>
              <p class="p-works-feature__text">限られた敷地の中でも、理想の暮らしを叶えやすい二階建て住宅。家族が集まる空間と、一人の時間を過ごす空間をバランスよく計画できるため、ライフスタイルに合わせた住まいづくりが可能です。デザインも間取りも自由に。これからの暮らしに寄り添う住まいを、一緒に形にしていきます。</p>
            </div>
          </div>
          <div class="p-works-feature__body">
            <figure class="p-works-feature__image">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/works_04.webp" alt="ゆとりを愉しむ平屋の外観" width="1200" height="1201" loading="lazy" decoding="async">
            </figure>
            <div class="p-works-feature__detail">
              <h3 class="p-works-feature__title">想いを届ける店舗づくり</h3>
              <p class="p-works-feature__label">SHOP</p>
              <p class="p-works-feature__text">お店は、商品やサービスだけでなく、その場所の空気感や想いを伝える空間でもあります。ファンライフでは、店舗のコンセプトやブランドイメージを大切にしながら、使いやすさにも配慮した空間づくりをご提案しています。訪れる人にとっても、働く人にとっても心地よい場所を、一緒につくり上げていきます。</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <section class="p-free">
    <?php
    $works_modal_items = array(
      array(
        'slug' => 'two-story',
        'title' => '二階建て',
        'en' => 'TWO STORY',
        'image' => 'works_slider1.webp',
        'alt' => '二階建て住宅の施工事例',
        'lead' => '家族の時間も、一人の時間も心地よく。',
        'text' => '限られた敷地を立体的に活かし、家族が自然に集まる場所と、それぞれが落ち着いて過ごせる場所を両立します。暮らし方や将来の変化まで見据え、動線と光の入り方を丁寧に整えた住まいをご提案します。',
      ),
      array(
        'slug' => 'hiraya',
        'title' => '平屋',
        'en' => 'HIRAYA',
        'image' => 'works_slider2.webp',
        'alt' => '平屋住宅の施工事例',
        'lead' => 'ひとつながりの空間で、ゆとりを愉しむ。',
        'text' => '生活がワンフロアで完結する平屋は、移動がスムーズで家族の気配を感じやすいことが魅力です。庭やウッドデッキとのつながり、高い天井や大きな窓による開放感を取り入れ、のびやかな暮らしを形にします。',
      ),
      array(
        'slug' => 'apartment',
        'title' => 'アパート',
        'en' => 'APARTMENT',
        'image' => 'works_slider3.webp',
        'alt' => 'アパートの施工事例',
        'lead' => '住む人にも、街にも選ばれる建物へ。',
        'text' => '入居者の心地よさと、オーナーさまにとっての価値を両立する集合住宅を考えます。周辺環境や土地の特性を読み取り、外観の印象から各住戸の動線まで、長く愛されるための工夫を積み重ねます。',
      ),
    );
    ?>
    <div class="l-inner">
      <div class="p-free__content">
        <div class="p-free__intro">
          <h2 class="p-free__title">決まった形ではなく、<br>理想の暮らしから考える自由設計。</h2>
          <p class="p-free__text">どんな家に住みたいかではなく、どんな暮らしをしたいか。<br>家族が自然に集まるリビング、家事を楽しむための動線、趣味のクリエイティブスペース。暮らし方は家庭ごとに違い、一人ひとりの理想に合わせて間取りを考えていきます。決まったプランに当てはめるのではなく、あなたらしい暮らしを叶えるための住まいをご提案します。</p>
        </div>
        <div class="swiper p-free__slider">
          <div class="swiper-wrapper">
            <?php for ($loop = 0; $loop < 2; $loop++) : ?>
              <?php foreach ($works_modal_items as $item) : ?>
                <article class="swiper-slide p-free__card">
                  <button class="p-free__card-button js-works-modal-open" type="button" data-modal-target="works-modal-<?php echo esc_attr($item['slug']); ?>" aria-haspopup="dialog">
                    <figure class="p-free__image">
                      <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/' . $item['image']); ?>" alt="<?php echo esc_attr($item['alt']); ?>" width="1000" height="834" loading="lazy" decoding="async">
                    </figure>
                    <span class="p-free__card-bottom">
                      <span>
                        <span class="p-free__card-title"><?php echo esc_html($item['title']); ?></span>
                        <span class="p-free__card-en"><?php echo esc_html($item['en']); ?></span>
                      </span>
                      <span class="p-free__more">MORE</span>
                    </span>
                  </button>
                </article>
              <?php endforeach; ?>
            <?php endfor; ?>
          </div>
        </div>
      </div>
    </div>
    <?php foreach ($works_modal_items as $item) : ?>
      <div class="p-works-modal js-works-modal" id="works-modal-<?php echo esc_attr($item['slug']); ?>" aria-hidden="true">
        <div class="p-works-modal__backdrop js-works-modal-close"></div>
        <div class="p-works-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="works-modal-title-<?php echo esc_attr($item['slug']); ?>" tabindex="-1">
          <button class="p-works-modal__close js-works-modal-close" type="button" aria-label="モーダルを閉じる"><span></span><span></span></button>
          <div class="p-works-modal__inner">
            <figure class="p-works-modal__image">
              <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/' . $item['image']); ?>" alt="" width="1000" height="834" loading="lazy" decoding="async">
            </figure>
            <div class="p-works-modal__body">
              <p class="p-works-modal__en"><?php echo esc_html($item['en']); ?></p>
              <h2 class="p-works-modal__title" id="works-modal-title-<?php echo esc_attr($item['slug']); ?>"><?php echo esc_html($item['title']); ?></h2>
              <p class="p-works-modal__lead"><?php echo esc_html($item['lead']); ?></p>
              <p class="p-works-modal__text"><?php echo esc_html($item['text']); ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
  <section class="p-balance">
    <div class="l-inner">
      <div class="p-balance__content">
        <figure class="p-balance__image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/balance_img.webp" alt="縁側でくつろぐ家族" width="858" height="606" loading="lazy" decoding="async">
        </figure>
        <div class="p-balance__detail">
          <div class="p-balance__diagram" aria-label="断熱、気密、換気、耐震の4つのバランス">
            <span class="p-balance__item">断 熱</span>
            <span class="p-balance__item">気 密</span>
            <span class="p-balance__item">換 気</span>
            <span class="p-balance__item">耐 震</span>
          </div>
          <p class="p-balance__text">理想の家づくりには、<br>この4つのバランスが重要です。</p>
        </div>
      </div>
    </div>
  </section>
  <?php
  $lineup_items = array(
    array(
      'kana' => 'リミニ コティ',
      'image' => 'line_01.webp',
      'width' => 879,
      'height' => 879,
      'alt' => '白い外壁のKoti住宅',
      'title' => 'あなたに合う<br>暮らしのカタチを。',
      'text' => 'まずは住まいのベースとなるプランをお選びください。暮らし方や家族構成、将来のライフスタイルをイメージしながら、自分たちに合った住まいを見つけてみましょう。',
    ),
    array(
      'kana' => 'リミニ ルートゥ',
      'image' => 'line_02.webp',
      'width' => 878,
      'height' => 878,
      'alt' => '深いグリーンの外壁のRuutu住宅',
      'title' => '四角い空間を、<br>自由に楽しむ。',
      'text' => 'シンプルなフォルムの中に、暮らしやすさと遊び心を詰め込んだ住まい。家族の個性に合わせて、心地よい空間を組み立てていけます。',
    ),
    array(
      'kana' => 'リミニ ポルク',
      'image' => 'line_03.webp',
      'width' => 876,
      'height' => 876,
      'alt' => '木目を取り入れた平屋のPolku住宅',
      'title' => '暮らしと庭を、<br>ひとつながりに。',
      'text' => '内と外が自然につながる、開放的な平屋スタイル。光や風、季節の移ろいを身近に感じながら、のびやかに暮らせるプランです。',
    ),
    array(
      'kana' => 'リミニ ペルヘ',
      'image' => 'line_04.webp',
      'width' => 884,
      'height' => 883,
      'alt' => '白と木目を組み合わせたPerhe住宅',
      'title' => '家族の時間を、<br>やさしく包む。',
      'text' => '家族が自然と集まる場所と、一人で落ち着ける場所。そのどちらも大切にしながら、毎日の変化に寄り添う住まいを考えます。',
    ),
  );
  ?>
  <section class="p-lineup js-style">
    <div class="l-inner">
      <div class="p-lineup__heading">
        <span class="p-lineup__heading-line" aria-hidden="true"></span>
        <h2 class="p-lineup__heading-text">LINE UP</h2>
      </div>
      <div class="p-lineup__content">
        <div class="p-lineup__gallery js-style-gallery">
          <?php foreach ($lineup_items as $index => $item) : ?>
            <button class="p-lineup__item js-style-item<?php echo 0 === $index ? ' is-active' : ''; ?>" type="button" data-style-title="<?php echo esc_attr($item['title']); ?>" data-style-text="<?php echo esc_attr($item['text']); ?>" aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>">
              <figure class="p-lineup__image">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/' . $item['image']); ?>" alt="<?php echo esc_attr($item['alt']); ?>" width="<?php echo esc_attr($item['width']); ?>" height="<?php echo esc_attr($item['height']); ?>" loading="lazy" decoding="async">
              </figure>
            </button>
          <?php endforeach; ?>
        </div>
        <div class="p-lineup__detail p-style__detail" aria-live="polite">
          <h3 class="p-lineup__detail-title js-style-title"><?php echo wp_kses_post($lineup_items[0]['title']); ?></h3>
          <p class="p-lineup__detail-text js-style-text"><?php echo esc_html($lineup_items[0]['text']); ?></p>
        </div>
      </div>
    </div>
    <span class="p-lineup__cursor p-style__cursor js-style-cursor" aria-hidden="true">CLICK</span>
  </section>
  <?php
  $style_items = array(
    array(
      'slug' => 'natural',
      'image' => 'style_01.webp',
      'width' => 901,
      'height' => 811,
      'alt' => '明るくナチュラルな外観の住宅スタイル',
      'title' => '理想の暮らしは、<br>ここからはじまる。',
      'text' => '住まいづくりの第一歩は、自分たちに合ったカタチを見つけること。あなたらしい暮らしを思い描きながら、お好みのプランをお選びください。',
    ),
    array(
      'slug' => 'simple',
      'image' => 'style_02.webp',
      'width' => 865,
      'height' => 811,
      'alt' => '白を基調にしたシンプルな住宅スタイル',
      'title' => 'すっきりと美しく、<br>心地よく暮らす。',
      'text' => '余計なものを削ぎ落としたシンプルな住まい。光と風を取り込みながら、毎日の動きに寄り添う機能的な空間をつくります。',
    ),
    array(
      'slug' => 'modern',
      'image' => 'style_03.webp',
      'width' => 901,
      'height' => 811,
      'alt' => '落ち着いた色合いのモダンな住宅スタイル',
      'title' => '素材を愉しむ、<br>表情豊かな住まい。',
      'text' => '色や質感の組み合わせにこだわり、落ち着きのある佇まいへ。住むほどに愛着が深まる、自分たちらしい住空間をご提案します。',
    ),
    array(
      'slug' => 'warm',
      'image' => 'style_04.webp',
      'width' => 848,
      'height' => 764,
      'alt' => '木の温もりを取り入れた住宅スタイル',
      'title' => '温もりを感じる、<br>やさしい暮らし。',
      'text' => '木の表情とやわらかな色合いを活かしたデザイン。家族が自然と集まり、穏やかな時間を過ごせる住まいを考えます。',
    ),
  );
  ?>
  <section class="p-style js-style">
    <div class="l-inner">
      <div class="p-style__content">
        <div class="p-style__detail" aria-live="polite">
          <h2 class="p-style__detail-title js-style-title"><?php echo wp_kses_post($style_items[0]['title']); ?></h2>
          <p class="p-style__detail-text js-style-text"><?php echo esc_html($style_items[0]['text']); ?></p>
        </div>
        <div class="p-style__main">
          <div class="p-style__heading">
            <p class="p-style__heading-text">STYLE</p>
            <span class="p-style__heading-line" aria-hidden="true"></span>
          </div>
          <div class="p-style__gallery js-style-gallery">
            <?php foreach ($style_items as $index => $item) : ?>
              <button class="p-style__item js-style-item<?php echo 0 === $index ? ' is-active' : ''; ?>" type="button" data-style-title="<?php echo esc_attr($item['title']); ?>" data-style-text="<?php echo esc_attr($item['text']); ?>" aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>">
                <figure class="p-style__image">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/' . $item['image']); ?>" alt="<?php echo esc_attr($item['alt']); ?>" width="<?php echo esc_attr($item['width']); ?>" height="<?php echo esc_attr($item['height']); ?>" loading="lazy" decoding="async">
                </figure>
              </button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <span class="p-style__cursor js-style-cursor" aria-hidden="true">CLICK</span>
  </section>
  <section class="p-your">
    <div class="l-inner">
      <div class="p-your__content">
        <figure class="p-your__image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/your_img.webp" alt="新しい住まいで喜ぶ女性たち" width="1548" height="1126" loading="lazy" decoding="async">
        </figure>
        <p class="p-your__copy">あなたにピッタリな家を。<br>ご相談はご気軽に。</p>
      </div>
    </div>
  </section>
  <section class="p-good">
    <div class="l-inner">
      <div class="p-good__content">
        <figure class="p-good__image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/works/good_img.webp" alt="リビングでゲームを楽しむ若者たち" width="2733" height="1413" loading="lazy" decoding="async">
        </figure>
        <p class="p-good__copy">いい人生は、<br>いい住まいから。</p>
      </div>
    </div>
  </section>
  <?php get_template_part('includes/contact'); ?>
</main>
<?php get_footer(); ?>
