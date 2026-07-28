<?php get_header(); ?>

<main>
  <section class="p-contact" id="contact-form">
    <div class="l-inner">
      <div class="p-contact__content">
        <header class="p-contact__heading">
          <h1 class="p-contact__title">CONTACT</h1>
          <p class="p-contact__subtitle js-contact-subtitle" data-input-title="お問い合わせ" data-confirm-title="お問い合わせ内容の確認">お問い合わせ</p>
          <p class="p-contact__intro js-contact-intro">お急ぎの方は、お電話、もしくは公式LINEからのお問い合わせを。<br>*は必須項目です。必ず入力してください</p>
        </header>

        <div class="p-contact__form">
          <?php echo do_shortcode('[contact-form-7 id="41" title="コンタクトフォーム 1"]'); ?>
        </div>
      </div>
    </div>
  </section>

  <?php
  get_template_part(
    'includes/contact',
    null,
    array(
      'id' => 'return-top',
      'modifier' => 'p-top-contact--return',
      'href' => home_url('/'),
      'aria_label' => 'トップページへ戻る',
      'request' => 'RETURN',
      'title' => 'TOP',
      'text' => 'トップに戻る',
      'image_alt' => '',
    )
  );
  ?>
</main>

<?php get_footer(); ?>
