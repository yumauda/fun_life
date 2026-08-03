<?php
$contact_args = wp_parse_args(
    $args ?? array(),
    array(
        'id' => 'contact',
        'modifier' => '',
        'href' => home_url('/contact/'),
        'aria_label' => 'お問い合わせページへ',
        'request' => 'request',
        'title' => 'CONTACT',
        'text' => 'お問い合わせ・資料請求',
        'image_alt' => 'お問い合わせ・資料請求',
    )
);

$contact_classes = array('p-top-contact');

if ($contact_args['modifier']) {
    $contact_classes[] = sanitize_html_class($contact_args['modifier']);
}
?>

<section class="<?php echo esc_attr(implode(' ', $contact_classes)); ?>" id="<?php echo esc_attr($contact_args['id']); ?>">
    <div class="l-inner">
        <div class="p-top-contact__content">
            <a href="<?php echo esc_url($contact_args['href']); ?>" class="p-top-contact__btn" aria-label="<?php echo esc_attr($contact_args['aria_label']); ?>">

                <figure class="p-top-contact__img">
                    <picture>
                        <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/contact_bg.webp" media="(min-width: 768px)" width="3840" height="1604" />
                        <img decoding="async" loading="lazy" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/top/contact_bg_sp.webp" alt="<?php echo esc_attr($contact_args['image_alt']); ?>" width="788" height="534">
                    </picture>
                </figure>
                    <div class="p-top-contact__detail">
                        <div class="p-top-contact__text-wrapper">
                            <p class="p-top-contact__request"><?php echo esc_html($contact_args['request']); ?></p>
                            <h3 class="p-top-contact__title"><?php echo esc_html($contact_args['title']); ?></h3>
                            <p class="p-top-contact__text">
                                <?php echo esc_html($contact_args['text']); ?>
                            </p>
                        </div>
                        <div class="p-top-contact__arrow">
                            <span class="p-top-contact__arrow-icon" aria-hidden="true"></span>
                        </div>

                    </div>
            </a>
        </div>
    </div>
</section>
