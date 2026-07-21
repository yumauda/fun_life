<?php
get_header();

$blog_posts = array(
  array(
    'category' => '施工事例',
    'date' => '2025.06.09',
    'datetime' => '2025-06-09',
    'image' => 'works_02.webp',
    'width' => 1200,
    'height' => 1201,
    'alt' => 'モダンな外観の二階建て住宅',
    'meta' => '久留米市新築住宅／二階建て',
    'title' => '大栄プロジェクトで叶える、暮らしに寄り添う住まい。',
  ),
  array(
    'category' => '施工事例',
    'date' => '2025.06.09',
    'datetime' => '2025-06-09',
    'image' => 'works_04.webp',
    'width' => 1200,
    'height' => 1201,
    'alt' => '照明と植栽が印象的な店舗外観',
    'meta' => '福岡市店舗改装／店舗リノベーション',
    'title' => 'もっと素敵な店舗空間を。想いが伝わる店づくり。',
  ),
  array(
    'category' => 'コラム',
    'date' => '2025.06.30',
    'datetime' => '2025-06-30',
    'image' => 'before_after03.webp',
    'width' => 1401,
    'height' => 1401,
    'alt' => '木とレンガを活かした店舗の玄関',
    'meta' => '家づくりのアイデア',
    'title' => '住まいの表情をつくる、素材選びのポイント。',
  ),
  array(
    'category' => 'コラム',
    'date' => '2025.06.09',
    'datetime' => '2025-06-09',
    'image' => 'before_after02.webp',
    'width' => 1398,
    'height' => 1398,
    'alt' => '木の温もりを感じる明るいリビング',
    'meta' => 'リフォームの基礎知識',
    'title' => '住まいを快適に整える、リフォームの考え方。',
  ),
);
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
          <a class="p-blog__pages-link" href="<?php echo esc_url(home_url('/works/')); ?>">WORKS</a>
          <a class="p-blog__pages-link" href="<?php echo esc_url(home_url('/#concept')); ?>">ENVIRONMENT</a>
        </div>
      </nav>
    </div>

    <div class="p-blog__archive">
      <div class="l-inner">
        <div class="p-blog__grid">
          <?php foreach ($blog_posts as $blog_item) : ?>
            <article class="p-blog__card">
              <a class="p-blog__card-link" href="#">
                <div class="p-blog__meta">
                  <span class="p-blog__category"><?php echo esc_html($blog_item['category']); ?></span>
                  <time class="p-blog__date" datetime="<?php echo esc_attr($blog_item['datetime']); ?>"><?php echo esc_html($blog_item['date']); ?></time>
                </div>
                <figure class="p-blog__image">
                  <img src="<?php echo esc_url(get_template_directory_uri() . '/images/works/' . $blog_item['image']); ?>" alt="<?php echo esc_attr($blog_item['alt']); ?>" width="<?php echo esc_attr($blog_item['width']); ?>" height="<?php echo esc_attr($blog_item['height']); ?>" loading="lazy" decoding="async">
                </figure>
                <p class="p-blog__card-meta"><?php echo esc_html($blog_item['meta']); ?></p>
                <h2 class="p-blog__card-title"><?php echo esc_html($blog_item['title']); ?></h2>
              </a>
            </article>
          <?php endforeach; ?>
        </div>

        <nav class="p-blog__pagination" aria-label="ブログ一覧のページ送り">
          <a class="p-blog__pagination-link is-current" href="#" aria-current="page">1</a>
          <a class="p-blog__pagination-link" href="#">2</a>
          <a class="p-blog__pagination-link" href="#">3</a>
          <span class="p-blog__pagination-dots" aria-hidden="true">…</span>
          <a class="p-blog__pagination-link" href="#">7</a>
          <a class="p-blog__pagination-next" href="#" aria-label="次のページへ"></a>
        </nav>
      </div>
    </div>
  </section>
  <?php get_template_part('includes/contact'); ?>
</main>

<?php get_footer(); ?>
