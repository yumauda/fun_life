<?php get_header(); ?>

<main>
  <section class="p-thanks">
    <div class="l-inner">
      <div class="p-thanks__content">
        <header class="p-thanks__heading">
          <h1 class="p-thanks__title">THANK<br>YOU</h1>
          <p class="p-thanks__subtitle">お問い合わせが完了しました</p>
        </header>

        <div class="p-thanks__message">
          <p class="p-thanks__lead">この度はお問い合わせいただき、<br>誠にありがとうございます。</p>
          <p class="p-thanks__text">ご入力いただいたメールアドレス宛に、自動返信メールをお送りしました。<br>お問い合わせ内容を確認のうえ、担当者より改めてご連絡いたします。</p>
          <p class="p-thanks__notice">※しばらく経ってもメールが届かない場合は、入力されたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。お手数ですがメールの受信設定をご確認のうえ、再度お問い合わせください。</p>
        </div>

        <a class="p-thanks__button" href="<?php echo esc_url(home_url('/')); ?>">TOPにもどる</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>