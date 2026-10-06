<?php
$banner_args = wp_parse_args(
  $args ?? array(),
  array(
    'modifier' => '',
    'with_inner' => true,
  )
);

$banner_classes = array('p-banner');

if ($banner_args['modifier']) {
  $banner_classes[] = sanitize_html_class($banner_args['modifier']);
}
?>

<aside class="<?php echo esc_attr(implode(' ', $banner_classes)); ?>" aria-label="宿泊体験型モデルハウスのご予約">
  <?php if ($banner_args['with_inner']) : ?>
    <div class="l-inner">
  <?php endif; ?>
    <a class="p-banner__link" href="<?php echo esc_url(home_url('/contact/')); ?>">
      <figure class="p-banner__image">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/banner_model_house.webp" alt="宿泊体験型モデルハウス「そのうち」ご予約はこちら" width="1100" height="449" loading="lazy" decoding="async">
      </figure>
    </a>
  <?php if ($banner_args['with_inner']) : ?>
    </div>
  <?php endif; ?>
</aside>
