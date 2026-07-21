<?php
get_header();

$image_uri = get_template_directory_uri() . '/images/blog-single/';
?>

<main>
  <article class="p-single-blog">
    <header class="p-single-blog__hero l-inner">
      <div class="p-single-blog__hero-copy">
        <p class="p-single-blog__eyebrow">
          <span class="p-single-blog__eyebrow-en">WORKS</span>
          <span class="p-single-blog__eyebrow-ja">施工事例</span>
        </p>
        <div class="p-single-blog__meta">
          <span class="p-single-blog__category">施工事例</span>
          <time class="p-single-blog__date" datetime="2026-01-01">2026.00.00</time>
        </div>
        <p class="p-single-blog__spec">熊本市中央区八王寺／32坪／3LDK吹き抜け／2階建て</p>
        <h1 class="p-single-blog__title">6人家族の会話が弾む<br>“繋がり”が深まるお家</h1>
      </div>
      <figure class="p-single-blog__hero-image">
        <img src="<?php echo esc_url($image_uri . 'blog6.jpg'); ?>" alt="ネイビーと白のガルバリウム外壁が印象的な住宅" width="1000" height="1500">
      </figure>
    </header>

    <div class="p-single-blog__body l-inner">
      <section class="p-single-blog__section">
        <div class="p-single-blog__text-block">
          <h2 class="p-single-blog__heading">家族の気配を感じながら、<br>それぞれが心地よく過ごせる住まい。</h2>
          <p class="p-single-blog__text">6人家族がのびのびと暮らせるよう、家族の繋がりと一人ひとりの居場所を大切にしました。外と内をゆるやかに結ぶ中庭や、家族が自然と集まるダイニングを中心に、毎日の動きがスムーズになる住まいをかたちにしています。</p>
        </div>
        <div class="p-single-blog__gallery p-single-blog__gallery--four">
          <figure><img src="<?php echo esc_url($image_uri . 'blog_8.jpg'); ?>" alt="中庭とテラス屋根" width="2000" height="3000" loading="lazy" decoding="async"></figure>
          <figure><img src="<?php echo esc_url($image_uri . 'blog_2.jpg'); ?>" alt="ネイビーの外壁に面したテラス" width="1000" height="1500" loading="lazy" decoding="async"></figure>
          <figure><img src="<?php echo esc_url($image_uri . 'blog_7.jpg'); ?>" alt="収納とワークスペースを備えたキッチン" width="1000" height="1500" loading="lazy" decoding="async"></figure>
          <figure><img src="<?php echo esc_url($image_uri . 'blog_5.jpg'); ?>" alt="玄関から見た明るい室内" width="1000" height="1500" loading="lazy" decoding="async"></figure>
        </div>
      </section>

      <section class="p-single-blog__section">
        <figure class="p-single-blog__wide-image">
          <img src="<?php echo esc_url($image_uri . 'blog_1.jpg'); ?>" alt="木目の玄関ドアと植栽" width="1000" height="1500" loading="lazy" decoding="async">
        </figure>
        <div class="p-single-blog__text-block">
          <h2 class="p-single-blog__heading">暮らしの中心に、<br>家族が集まるダイニング。</h2>
          <p class="p-single-blog__text">キッチンとダイニングをひと続きに配置し、料理をする人と食卓を囲む人の会話が自然に生まれる空間に。素材と色を丁寧に揃え、落ち着きの中にも家族らしい個性が感じられる設えとしました。</p>
        </div>
      </section>

      <section class="p-single-blog__section">
        <div class="p-single-blog__pair">
          <figure><img src="<?php echo esc_url($image_uri . 'blog_6.jpg'); ?>" alt="大きな照明が印象的なダイニング" width="2000" height="3000" loading="lazy" decoding="async"></figure>
          <figure><img src="<?php echo esc_url($image_uri . 'blog_4.jpg'); ?>" alt="カーテンで目隠しできる玄関収納" width="1000" height="1500" loading="lazy" decoding="async"></figure>
        </div>
        <div class="p-single-blog__text-block p-single-blog__text-block--right">
          <h2 class="p-single-blog__heading">視線が抜ける、<br>開放的な家族の空間。</h2>
          <p class="p-single-blog__text">吹き抜けとスケルトン階段が上下階を繋ぎ、どこにいても家族の気配を感じられます。たっぷりの自然光と、使いやすい収納計画で、心地よさと暮らしやすさを両立しました。</p>
        </div>
      </section>

      <section class="p-single-blog__section p-single-blog__section--before-after">
        <figure class="p-single-blog__before-after-image">
          <img src="<?php echo esc_url($image_uri . 'blog_2.jpg'); ?>" alt="テラス施工前の住宅外観" width="1000" height="1500" loading="lazy" decoding="async">
          <figcaption>BEFORE</figcaption>
        </figure>
        <figure class="p-single-blog__before-after-image">
          <img src="<?php echo esc_url($image_uri . 'blog_8.jpg'); ?>" alt="テラス屋根を設けた施工後の中庭" width="2000" height="3000" loading="lazy" decoding="async">
          <figcaption>AFTER</figcaption>
        </figure>
        <p class="p-single-blog__text">外からの視線をほどよく遮りながら、家族が安心して過ごせる中庭に。室内とひと続きに使える、もう一つのリビングが生まれました。</p>
      </section>

      <section class="p-single-blog__other">
        <h2 class="p-single-blog__other-heading">OTHER</h2>
        <div class="p-single-blog__other-grid">
          <a class="p-single-blog__other-card" href="#">
            <div class="p-single-blog__other-meta"><span>施工事例</span><time datetime="2025-06-09">2025.06.09</time></div>
            <figure><img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/works_02.webp'); ?>" alt="グレーの外壁の二階建て住宅" width="1200" height="1201" loading="lazy" decoding="async"></figure>
            <p class="p-single-blog__other-spec">上益城郡御船町／敷地27.3坪／3LDK</p>
            <h3>大型プロジェクターとシアターシステムを設置した趣味をとことん楽しむ唯一無二のアートな家</h3>
          </a>
          <a class="p-single-blog__other-card" href="#">
            <div class="p-single-blog__other-meta"><span>施工事例</span><time datetime="2025-06-09">2025.06.09</time></div>
            <figure><img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/works_04.webp'); ?>" alt="夕暮れに明かりが灯る黒い外観" width="1200" height="1201" loading="lazy" decoding="async"></figure>
            <p class="p-single-blog__other-spec">菊池郡菊陽町／5LDK＋和室</p>
            <h3>6人家族の会話が弾む“繋がり”が深まるお家</h3>
          </a>
        </div>
        <nav class="p-single-blog__other-nav" aria-label="記事ナビゲーション">
          <a href="#">← 前へ</a>
          <a href="<?php echo esc_url(home_url('/blog/')); ?>">イベント・ブログへ<br>↑</a>
          <a href="#">施工事例へ<br>→</a>
        </nav>
      </section>
    </div>
  </article>

  <?php get_template_part('includes/contact'); ?>
</main>

<?php get_footer(); ?>
