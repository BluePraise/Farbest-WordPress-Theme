<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package farbest
 */
?>

<div class="footer-top-shape">
	<?php echo file_get_contents( get_template_directory() . '/images/footer_top_shape.svg' ); ?>
</div>

<footer>
<div class="fb_content clearfix">

<div id="leftFooter"><?php dynamic_sidebar( 'footer_left' ); ?><hr class="stack"></div>

<div id="centerFooter"><?php dynamic_sidebar( 'footer_center' ); ?><hr class="stack"></div>

<div id="rightFooter"><?php dynamic_sidebar( 'footer_right' ); ?></div>
</div>

</footer>


<?php if(is_page_template( 'page-ingredients.php') || is_page_template( 'page-colors.php') || is_page_template( 'page-colorsides.php')) { ?>

<script type="text/javascript">

jQuery(document).ready(function() {
	jQuery(function () {
    	 jQuery(".ingred_acc").accordion({
			 collapsible: true,
			 animate: { easing: 'swing', duration: 500 },
			 active: false,
			 heightStyle: "content"
		 })
        .show();
	 });
	 jQuery('ul#menu-ingredients-desktop').show();
});
</script>

<?php } ?>

<?php if(is_page_template( 'page-team.php')) { ?> 

<script type="text/javascript">


window.addEventListener( 'load', function ( ) {
	jQuery(".team_acc").accordion({
			 collapsible: true,
			 animate: { easing: 'swing', duration: 500 },
			 heightStyle: "content",
			 active:false,
		 });
}
, true );

//jQuery(document).ready(function() {
//	jQuery(function () {
//    	 jQuery(".team_acc").accordion({
//			 collapsible: true,
//			 animate: { easing: 'swing', duration: 500 },
//			 heightStyle: "content",
//			 active:false,
//		 })
//	 });
//});

</script>

<?php } ?>

<?php if(is_page(array (18 ))) { ?>

<script type="text/javascript">

jQuery(function() {

    // grab the initial top offset of the navigation 
    var sticky_navigation_offset_top = jQuery('header#fb_home').offset().top;
     
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var sticky_navigation = function(){
        var scroll_top = jQuery(window).scrollTop(); // our current vertical position from the top
         
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_navigation_offset_top) { 
            jQuery('header#fb_home').css({ 'opacity': '1', 'transition' : 'opacity .5s ease-in-out' });
        } else {
            jQuery('header#fb_home').css({ 'opacity': '0' }); 
			jQuery('#hero img').css({ 'opacity': '1', 'transition' : 'opacity .5s ease-in-out' });
        }   
    };
     
    // run our function on load
    sticky_navigation();
     
    // and run it again every time you scroll
    jQuery(window).scroll(function() {
         sticky_navigation();
    });
 
});
</script>

<?php } ?>

<?php if(is_page(array (18, 77 ))) { ?>

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#cta1').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInDown',
        offset: 150,
        callbackFunction: function(elem, action){
               jQuery('#cta1').find('.homebutton').animate({"margin-right":""}, 1000); 
               // Callback to do after a class was added/ removed to an element.
           } 
       });   
});

jQuery(document).ready(function() {
    jQuery('#cta2').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInDown',
        offset: 150,
        callbackFunction: function(elem, action){
              jQuery('#cta2').find('.button').animate({"margin-right":""}, 1000); 
               // Callback to do after a class was added/ removed to an element.
           } 
       });   
});

jQuery(document).ready(function() {
    jQuery('#cta3').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated fadeInDown',
        offset: 250,
        callbackFunction: function(elem, action){
              jQuery('#cta3').find('.button').animate({"margin-right":"120px"}, 1000); 
               // Callback to do after a class was added/ removed to an element.
           } 
       });   
});

</script>

<?php } ?>

<?php if(is_page(79) || is_page(1054)) { ?>

<script type="text/javascript">

window.addEventListener( 'load', function ( ) {
jQuery('.openup').click(function() {
    jQuery(this).siblings('.clip').toggleClass('clipactive');	
    jQuery('.fadeout').toggleClass('nofade');	
});

jQuery('i').css("cursor","pointer");
jQuery('i').on('click touch', function () {
 if(jQuery(this).hasClass("fa fa-chevron-up")){
  jQuery(this).removeClass("fa fa-chevron-up");
  jQuery(this).addClass("fa fa-chevron-down");
 }
 else if(jQuery(this).hasClass("fa fa-chevron-down")){
  jQuery(this).removeClass("fa fa-chevron-down");
  jQuery(this).addClass("fa fa-chevron-up");
 }
});

console.log( jQuery( '.openup' ));
console.log( jQuery( 'i' ));

}
, true );

</script>

<?php } ?>

<script>
jQuery( '#site-navigation li:has(ul)' ).doubleTapToGo();
</script>


<script>
window.addEventListener( 'load', function ( ) {
  jQuery('div.dcjq-accordion  a[href="' + window.location.protocol + "//" + window.location.host + window.location.pathname + '"]').addClass('current');
}, true )
</script>

<?php if(is_page(1453)) { ?>
<script>
jQuery('.jscolor').on('change', function(e) {
jQuery(this).parent().parent().find('[type="hidden"]').val(this.value);
console.log(jQuery(this).parent().parent().find('[type="hidden"]').attr('name'));
})
</script>
<?php } ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
