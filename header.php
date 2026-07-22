<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <!-- meta情報 -->
    <?php if (is_home() || is_front_page()) : ?>
        <title>ファンライフ株式会社</title>
        <meta name="description" content="横浜市港北区大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザライン)なども子供から大人まで安心の定額制です。" />
        <meta name="keywords" content="矯正歯科,港北区,大倉山" />
        <meta property="og:title" content="横浜市港北区大倉山の矯正専門歯科｜大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://familiar-kyousei.com/">
        <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg" />
        <meta property="og:site_name" content="大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:description" content="横浜市大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザラン)なども子供から大人まで安心の定額制です。" />
    <?php elseif (is_page('adult')) : ?>
        <title>大人の矯正・成人矯正｜大倉山ファミリア矯正歯科（横浜市港北区）</title>
        <meta name="description" content="横浜市港北区大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザライン)なども子供から大人まで安心の定額制です。" />
        <meta name="keywords" content="矯正歯科,港北区,大倉山" />
        <meta property="og:title" content="大人の矯正｜大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://familiar-kyousei.com/adult">
        <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg" />
        <meta property="og:site_name" content="大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:description" content="横浜市大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザラン)なども子供から大人まで安心の定額制です。" />
    <?php elseif (is_page((array('contact', 'confirm')))) : ?>
        <title>お問い合わせ｜大倉山ファミリア矯正歯科（横浜市港北区）</title>
        <meta name="description" content="横浜市港北区大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザライン)なども子供から大人まで安心の定額制です。" />
        <meta name="keywords" content="矯正歯科,港北区,大倉山" />
        <meta property="og:title" content="お問い合わせ｜大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://familiar-kyousei.com/contact">
        <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg" />
        <meta property="og:site_name" content="大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:description" content="横浜市大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザラン)なども子供から大人まで安心の定額制です。" />
    <?php elseif (is_page('thanks')) : ?>
        <title>送信完了｜大倉山ファミリア矯正歯科（横浜市港北区）</title>
        <meta name="description" content="横浜市港北区大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザライン)なども子供から大人まで安心の定額制です。" />
        <meta name="keywords" content="矯正歯科,港北区,大倉山" />
        <meta property="og:title" content="送信完了｜大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://familiar-kyousei.com/thanks">
        <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg" />
        <meta property="og:site_name" content="大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:description" content="横浜市大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザラン)なども子供から大人まで安心の定額制です。" />
    <?php elseif (is_single()) : ?>
        <title><?php the_title() ?>｜大倉山ファミリア矯正歯科（横浜市港北区）</title>
        <meta name="description" content="横浜市港北区大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザライン)なども子供から大人まで安心の定額制です。" />
        <meta name="keywords" content="矯正歯科,港北区,大倉山" />
        <meta property="og:title" content="<?php the_title() ?>｜大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:type" content="article">
        <meta property="og:url" content="https://familiar-kyousei.com/adult">
        <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg" />
        <meta property="og:site_name" content="大倉山ファミリア矯正歯科（横浜市港北区）" />
        <meta property="og:description" content="横浜市大倉山の、痛くない・目立たない矯正専門歯科。マウスピース矯正(インビザラン)なども子供から大人まで安心の定額制です。" />

    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri() ?>/images/common/ogp.jpg">

    <!-- ogp -->
    <!-- ファビコン -->
    <link rel="icon" href="<?php echo get_template_directory_uri() ?>/images/common/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/images/common/apple-touch-icon.png">
    <!-- css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <?php if (is_404()) : ?>
        <meta http-equiv="refresh" content=" 3; url=<?php echo esc_url(home_url("/")); ?>">
    <?php endif; ?>
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <header class="l-header p-header">
        <div class="l-inner">
            <div class="p-header__inner">
                <a class="p-header__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="ファンライフ株式会社 ホーム">
                    <img decoding="async" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/common/footer_logo.png" alt="Fun life. ファンライフ株式会社" width="431" height="118">
                </a>
                <div class="p-header__actions">
                    <a class="p-header__icon-link" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="メールでお問い合わせ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.58 23.8">
                            <path d="M15.37,12.82L30.58.94v-.48c0-.12-.04-.24-.12-.32-.07-.08-.17-.13-.28-.13H.39c-.11,0-.2.05-.28.13s-.12.2-.12.32v.48l15.26,11.91s0-.02.02-.02c.04,0,.07,0,.08-.02" fill="currentColor" />
                            <path d="M30.58,3.66l-14.13,11.03c-.32.25-.73.39-1.12.4-.41.01-.82-.11-1.15-.36L0,3.66v19.68c0,.12.04.24.12.32.07.08.17.13.28.13h29.8c.11,0,.2-.05.28-.13.07-.08.12-.2.12-.32V3.66Z" fill="currentColor" />
                        </svg>
                    </a>
                    <a class="p-header__icon-link" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="資料請求">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31.82 31.17">
                            <g>
                                <g>
                                    <path d="M6.93,8.83H.89c-.47,0-.86-.38-.86-.85s.39-.85.86-.85h6.04c.12,0,.21-.09.21-.2V.91c0-.47.39-.85.86-.85s.86.38.86.85v6.01c0,1.05-.87,1.91-1.92,1.91Z" />
                                    <path d="M21.71,31.17H1.91c-1.05,0-1.91-.86-1.91-1.91V8.35c0-.51.21-.99.56-1.34L7.05.55c.36-.36.83-.55,1.34-.55h13.32c1.05,0,1.92.85,1.92,1.91v27.34c0,1.05-.87,1.91-1.92,1.91ZM8.39,1.71s-.1.02-.13.05L1.77,8.22l-.05,21.03c0,.11.09.21.2.21h19.79c.12,0,.21-.09.21-.21V1.91c0-.11-.09-.2-.21-.2h-13.32Z" />
                                </g>
                                <g>
                                    <path d="M11.43,20.77h-6.13c-.47,0-.86-.38-.86-.85s.39-.85.86-.85h6.13c.47,0,.86.38.86.85s-.39.85-.86.85Z" />
                                    <path d="M18.34,16.83H5.29c-.47,0-.86-.38-.86-.85s.39-.85.86-.85h13.05c.47,0,.86.38.86.85s-.39.85-.86.85Z" />
                                    <path d="M18.34,12.88H5.29c-.47,0-.86-.38-.86-.85s.39-.85.86-.85h13.05c.47,0,.86.38.86.85s-.39.85-.86.85Z" />
                                    <path d="M11.43,24.71h-6.13c-.47,0-.86-.38-.86-.85s.39-.85.86-.85h6.13c.47,0,.86.38.86.85s-.39.85-.86.85Z" />
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M15.53,26.33l3.41-1.31c.06-.02.11-.06.16-.1l11.72-11.72c.18-.18.18-.47,0-.65l-1.68-1.68c-.18-.18-.47-.18-.65,0l-11.72,11.72s-.08.1-.1.16l-1.31,3.41c-.04.11.07.22.18.18Z" />
                                    <path d="M15.55,27.18c-.29,0-.62-.11-.79-.3-.23-.25-.31-.77-.18-1.08l1.29-3.37c.04-.09.2-.34.26-.42l11.75-11.76c.53-.52,1.35-.51,1.86,0l1.69,1.69c.24.24.39.58.39.93s-.15.68-.4.94l-11.71,11.71c-.1.09-.36.27-.49.31l-3.38,1.3h0c-.09.04-.19.05-.29.05ZM15.54,26.33h.02-.02ZM28.81,11.75l-11.44,11.44-.65,1.77,1.84-.71,11.38-11.38-1.12-1.12ZM30.21,13.15s0,0,0,0h0ZM30.21,12.59s0,0,0,0h0Z" />
                                </g>
                                <g>
                                    <line x1="19.1" y1="24.92" x2="16.77" y2="22.59" />
                                    <path d="M19.1,25.77c-.21,0-.44-.08-.61-.25l-2.33-2.33c-.33-.33-.33-.87,0-1.21.33-.33.88-.33,1.21,0l2.33,2.33c.33.33.33.87,0,1.21-.17.17-.39.25-.61.25Z" />
                                </g>
                                <g>
                                    <line x1="28.94" y1="15.08" x2="26.61" y2="12.75" />
                                    <path d="M28.95,15.93c-.21,0-.44-.08-.61-.25l-2.33-2.33c-.33-.34-.33-.87,0-1.21.33-.33.88-.33,1.21,0l2.33,2.33c.33.34.33.87,0,1.21-.17.17-.39.25-.61.25Z" />
                                </g>
                            </g>
                        </svg>
                    </a>
                    <a class="p-header__icon-link" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="LINEでお問い合わせ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.02 28.61">
                            <path d="M12.55,24.2c.49.11,1.15.32,1.32.74.15.38.1.97.05,1.36,0,0-.18,1.06-.21,1.28-.07.38-.3,1.48,1.3.81s8.65-5.09,11.79-8.72h0c2.18-2.39,3.22-4.81,3.22-7.5C30.02,5.47,23.29,0,15.01,0S0,5.47,0,12.18c0,6.02,5.34,11.07,12.55,12.02ZM20.53,15.16v-6.54h0c0-.17.13-.29.29-.29h4.22c.16,0,.29.13.29.29v1.06c0,.16-.13.29-.29.29h-2.87v1.11h2.87c.16,0,.29.13.29.29v1.06c0,.16-.13.29-.29.29h-2.87v1.11h2.87c.16,0,.29.13.29.29v1.06c0,.16-.13.29-.29.29h-4.22c-.16,0-.29-.13-.29-.29h0ZM13.28,8.61c0-.16.13-.29.29-.29h1.06s0,0,0,0c0,0,0,0,.02,0,0,0,.01,0,.02,0,0,0,0,0,.01,0,0,0,.01,0,.02,0,0,0,0,0,.01,0,0,0,.01,0,.02,0,0,0,0,0,0,0h.02s0,.01,0,.01c0,0,.01,0,.02,0,0,0,0,0,0,0,0,0,.01,0,.02.01,0,0,0,0,0,0,0,0,.01,0,.02.01,0,0,0,0,0,0,0,0,.01.01.02.02h0s.02.02.02.03l3,4.05v-3.89c0-.16.13-.29.29-.29h1.06c.16,0,.29.13.29.29v6.55c0,.16-.13.29-.29.29h-1.06s-.05,0-.07,0c0,0,0,0,0,0,0,0-.01,0-.02,0h0s0,0-.01,0c0,0,0,0-.01,0,0,0,0,0,0,0,0,0-.01,0-.02-.01,0,0,0,0,0,0-.03-.02-.05-.04-.07-.07l-3-4.05v3.89c0,.16-.13.29-.29.29h-1.06c-.16,0-.29-.13-.29-.29v-6.55ZM10.62,8.61c0-.16.13-.29.29-.29h1.07c.16,0,.29.13.29.29v6.55c0,.16-.13.29-.29.29h-1.07c-.16,0-.29-.13-.29-.29v-6.55ZM4.92,15.16v-6.55c0-.16.13-.29.29-.29h1.06c.16,0,.29.13.29.29v5.2h2.87c.16,0,.29.13.29.29v1.06c0,.16-.13.29-.29.29h-4.22c-.16,0-.29-.13-.29-.29h0Z" />
                        </svg>
                    </a>
                    <button class="p-header__button p-header__menu p-drawer-icon" type="button" aria-label="メニューを開く">
                        <span class="p-header__menu-text">MENU</span>
                        <span class="p-drawer-icon__bars" aria-hidden="true">
                            <span class="p-drawer-icon__bar1"></span>
                            <span class="p-drawer-icon__bar3"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="p-header__drawer-content p-drawer-content" id="drawer">
                <div class="p-drawer-content__items">
                    <div class="p-drawer-content__body">
                        <nav class="p-drawer-content__nav" aria-label="メインメニュー">
                            <ul class="p-drawer-content__lists">
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/')); ?>" class="p-drawer-content__link">TOP</a></li>
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/works/')); ?>" class="p-drawer-content__link">WORKS</a></li>
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/about/')); ?>" class="p-drawer-content__link">ABOUT</a></li>
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="p-drawer-content__link">BLOG</a></li>
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/works/')); ?>" class="p-drawer-content__link p-drawer-content__link--muted">WORKS</a></li>
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="p-drawer-content__link p-drawer-content__link--muted">EVENT/COLUMN</a></li>
                                <li class="p-drawer-content__list"><a href="<?php echo esc_url(home_url('/contact/')); ?>" class="p-drawer-content__link">CONTACT</a></li>
                            </ul>
                        </nav>
                        <div class="p-drawer-content__company">
                            <p class="p-drawer-content__address">〒861-3204<br class="u-mobile"> 熊本県上益城郡御船町大字木倉 222</p>
                            <p class="p-drawer-content__tel">TEL：096-281-1222&nbsp;&nbsp;FAX：096-281-1223</p>
                            <p class="p-drawer-content__copyright">©ファンライフ株式会社 .All Rights Reserved</p>
                        </div>
                    </div>
                    <figure class="p-drawer-content__image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/common/drawer-cat.webp" alt="室内に立つ猫" width="450" height="450" loading="lazy" decoding="async">
                    </figure>
                </div>
            </div>
        </div>
    </header>
