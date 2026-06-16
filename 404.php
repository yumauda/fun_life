<?php get_header(); ?>
<main>
  <section class="l-404 p-404">
    <div class="l-inner p-404__inner">
      <div class="p-404__content">
        <div class="p-404__block">
          <div class="p-404__title-wrapper">
            <h2 class="p-404__title">page not found</h2>
            <p class="p-404__number">404</p>
          </div>
          <div class="p-404__text-wrapper">
            <p class="p-404__text">ご覧いただいているURLにはページはありません。<br class="u-desktop">
              URLの入力間違いか、ページが移動している可能性があります。</p>
          </div>
          <div class="p-404__btn-wrapper">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="p-404__btn">
              <p class="p-404__btn-text">トップページへ戻る</p>
              <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle opacity="1" cx="16" cy="16" r="16" fill="#fff" />
                <path d="M22.3536 16.3536C22.5488 16.1583 22.5488 15.8417 22.3536 15.6464L19.1716 12.4645C18.9763 12.2692 18.6597 12.2692 18.4645 12.4645C18.2692 12.6597 18.2692 12.9763 18.4645 13.1716L21.2929 16L18.4645 18.8284C18.2692 19.0237 18.2692 19.3403 18.4645 19.5355C18.6597 19.7308 18.9763 19.7308 19.1716 19.5355L22.3536 16.3536ZM10 16.5L22 16.5V15.5L10 15.5V16.5Z" fill="#6D6D6D" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php get_template_part('includes/reserve'); ?>
</main>
<?php get_footer() ?>