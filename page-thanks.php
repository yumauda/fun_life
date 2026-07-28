<?php get_header(); ?>

<main>
  <section class="p-thanks">
    <div class="l-inner">
      <div class="p-thanks__content">
        <header class="p-thanks__heading">
          <h1 class="p-thanks__title">THANK <br class="u-desktop">YOU</h1>
          <p class="p-thanks__subtitle">お問い合わせが完了しました</p>
        </header>

        <div class="p-thanks__message">
          <p class="p-thanks__lead">この度はお問い合わせいただき、誠にありがとうございます。送信いただいた内容は無事に受信いたしました。</p>
          <p class="p-thanks__text">ご入力いただいたメールアドレス宛に、自動返信による確認メールをお送りしておりますのでご確認ください。<br>通常、 3営業日以内に担当者より改めてご連絡を差し上げます。今しばらくお待ちいただけますようお願い申し上げます。</p>
          <p class="p-thanks__notice">※しばらく経ってもメールが届かない場合は、入力されたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。お手数ですがメールの受信設定をご確認のうえ、再度お問い合わせください。</p>
        </div>

        <a class="p-thanks__button" href="<?php echo esc_url(home_url('/')); ?>">TOPにもどる</a>
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