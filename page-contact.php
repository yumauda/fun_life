<?php get_header(); ?>

<main>
  <section class="p-contact" id="contact-form">
    <div class="l-inner">
      <div class="p-contact__content">
        <header class="p-contact__heading">
          <h1 class="p-contact__title">CONTACT</h1>
          <p class="p-contact__subtitle js-contact-subtitle" data-input-title="お問い合わせ" data-confirm-title="お問い合わせ内容の確認">お問い合わせ</p>
          <p class="p-contact__intro js-contact-intro">お家づくり・資料請求など、お気軽にお問い合わせください。<br>必要事項をご入力のうえ、内容確認へお進みください。</p>
        </header>

        <div class="p-contact__form">
          <?php echo do_shortcode('[contact-form-7 id="41" title="コンタクトフォーム 1"]'); ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
