<?php
function hook_simple_markup() {
    ?>
<!--
 --- Simple Schema Markup --- 
-->
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "LocalBusiness",
    "name": "<?php single_post_title(); ?>",
    "description": "<?php $value = ss_get_theme_option( 'desc_input' );
echo $value; ?>",
    "image": {
        "@type": "ImageObject",
        "url": "<?php $custom_logo_id = get_theme_mod( 'custom_logo' ); $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); echo $image[0];?>",
        "height": <?php $image_data = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?><?php $image_height = $image_data[0]; ?><?php $image_height = $image_data[2]; ?><?php echo $image_height; ?>,
        "width": <?php $image_data = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?><?php $image_width = $image_data[0]; ?><?php $image_width = $image_data[1]; ?><?php echo $image_width; ?>
    },
    "priceRange": "<?php $value = ss_get_theme_option( 'price_range_input' );
echo $value;?>",
    "telephone": "<?php $value = ss_get_theme_option( 'phone_input' );
echo $value;?>",
    "address": "<?php $value = ss_get_theme_option( 'address_input' );
echo $value;?>",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php $value = ss_get_theme_option( 'rating_input' );
echo $value;?>",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "<?php $value = ss_get_theme_option( 'rating_count_input' );
echo $value;?>"
    }
}
</script>

    <?php
}
add_action('wp_head', 'hook_simple_markup');