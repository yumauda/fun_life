<?php
$modifier = isset($args['modifier']) ? sanitize_html_class($args['modifier']) : '';
$class_name = 'c-button-list__arrow' . ($modifier ? ' ' . $modifier : '');
?>
<svg class="<?php echo esc_attr($class_name); ?>" viewBox="0 0 3.9 1.2" aria-hidden="true" focusable="false">
  <path d="M3.9.6H.86" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width=".2"></path>
  <path d="M1.04 0 0 .6l1.04.6V0z" fill="currentColor"></path>
</svg>
