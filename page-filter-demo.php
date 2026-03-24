<?php

/**
 * Template Name: Filter Demo
 * Description: Proof of concept for ingredient filtering — powered by Farbest Product Catalog plugin (React + REST API)
 */

get_header(); ?>
<!-- Demo Ribbon -->
<div id="demo-ribbon" role="banner" aria-label="Demo notice">
    <div class="demo-ribbon-inner">
        <span class="demo-ribbon-badge">DEMO</span>
        <span class="demo-ribbon-message">
            This is a <strong>client preview</strong> — features, data, and design are subject to change and do not represent the final product.
        </span>
        <button class="demo-ribbon-close" onclick="document.getElementById('demo-ribbon').style.display='none'" aria-label="Dismiss notice">&times;</button>
    </div>
</div>
<div class="content-wrapper container">
    <!-- Hero Section -->
    <section class="fbd-hero">
        <div class="fbd-hero-inner">
            <div class="fbd-hero-text">
                <h1 class="fbd-hero-title">Our Ingredients,<br>Your Sourcing Simplified.</h1>
                <p class="fbd-hero-subtitle">Whether you're looking for proteins, texturants, sweeteners,<br />
                    vitamins, natural colors, or something else, our selection of
                    ingredients can solve your formulation needs.</p>
            </div>
            <div class="fbd-hero-cta">
                <a href="#" class="fbd-cta-button">Get in Touch</a>
            </div>
        </div>
    </section>

    <!-- React App Mount Point (assets enqueued via farbest_scripts in functions.php) -->
    <div class="fbd-catalog-wrap">
        <div id="farbest-ingredient-grid"></div>
    </div>
</div>
<?php get_footer(); ?>