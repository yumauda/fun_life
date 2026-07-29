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
          <p class="p-thanks__lead">この度はお問い合わせいただき、誠にありがとうございます。<br class="u-desktop">送信いただいた内容は無事に受信いたしました。</p>
          <p class="p-thanks__text">ご入力いただいたメールアドレス宛に、自動返信による確認メールをお送りしておりますのでご確認ください。<br>通常、 3営業日以内に担当者より改めてご連絡を差し上げます。<br class="u-desktop">今しばらくお待ちいただけますようお願い申し上げます。</p>
          <div class="p-thanks__notice-wrapper">
            <h2 class="p-thanks__notice-title">※メールが届かない場合</h2>

            <p class="p-thanks__notice">弊社からの返信が迷惑メールフォルダに自動的に移動される場合があります。<br class="u-mobile">10分以上経っても自動延伸メールが届かない場合には、迷惑メールフォルダをご確認ください。<br class="u-desktop">また、受信できるように設定の変更をお願いします。迷惑メールフォルダにも返信が見当たらないようであれば、お手数ですが再度お問い合わせ下さいますようお願いいたします。</p>
          </div>
        </div>

        <a class="p-thanks__button" href="<?php echo esc_url(home_url('/')); ?>">TOPに戻る</a>
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