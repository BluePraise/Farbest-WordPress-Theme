<?php
/**
 * Detailed download output
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
?>
<aside class="download-box">

	<?php $dlm_download->the_image(); ?>


	<div class="download-box-content">


		<a class="download-button" title="<?php if ( $dlm_download->has_version_number() ) {
			printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_the_version_number() );
		} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
			<i class="fa fa-download"></i> <?php _e( 'Download Now!', 'download-monitor' ); ?>
			<!--<small><?php $dlm_download->the_filename(); ?> &ndash; <?php $dlm_download->the_filesize(); ?></small>-->
		</a>

	</div>
</aside>


