<?php
/**
 * Template name: Warehousing
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package farbest
 */

get_header(); ?>
<?php
    $warehouse_hero_phrase  = get_field('warehouse_hero_phrase');
    $warehouse_hero_image   = get_field('warehouse_hero_image');
?>
<div class="custom-image page-hero" style="background-image: url('<?php echo $warehouse_hero_image; ?>');">
    <h2 class="hero-title"><?php echo $warehouse_hero_phrase; ?></h2>
</div>

<div class="content-container">
    <h1 class="page-title"><?php the_title(); ?></h1>
    <p><?php the_content(); ?></p>
</div>

<div class="grid col-3 content-container">
    <?php // Check rows exists.
        if( have_rows('warehouse_locations') ):

            // Loop through rows.
            while( have_rows('warehouse_locations') ) : the_row();

                // Values are from ACF. These values will only be loaded if there is content.
                $warehouse_name         = get_sub_field('warehouse_location_name');
                $warehouse_description  = get_sub_field('warehouse_location_description'); ?>
    <div class="column">
        <?php if( $warehouse_name): ?>
        <div class="card-top">
             <img class="icon-pin" src="<?php echo get_stylesheet_directory_uri(); ?>/images/map-pin.png" />
             <h4><?php echo $warehouse_name; ?></h4>
        </div>
        <p><?php echo $warehouse_description; ?></p>
        <?php endif; ?>
    </div>
    <?php
            // End loop.
            endwhile; endif; ?>
</div>
<div class="clearfix">&nbsp;</div>
<div id="cta1" class="hidden visible animated fadeInDown full-visible">
<div class="call-to-action">
    <div class="cta-content-container">
        <h3 class="cta-title wh"><?php echo $cta_headline = get_field('cta_headline'); ?></h3>
		<p><?php echo $cta_content = get_field('cta_content'); ?></p>
        <?php echo do_shortcode('[fc id="5" type="popup" class="homebutton"]ASK FOR A QUOTE   <i class="fa fa-chevron-right"></i>[/fc]'); ?>
    </div>
</div>
</div>
</div>
<!--cta1-->
<div class="clearfix">&nbsp;</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>