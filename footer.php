<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
$footer_opts = get_option('footer');
$endereco = str_replace("\n", '<br>', $footer_opts['footer_endereco']);
$emails = explode("\n", $footer_opts['footer_emails']);
$mapa_img = wp_get_attachment_image_src($footer_opts['footer_mapa_img'], 'full', false );
$mapa_img = $mapa_img[0];
?>

		</div><!-- #main -->
	</div><!-- .container -->
   <!-- bottom -->
    <div id="bottom" class="container">
        <div class="col-md-4 pull-left">
        	<img class="logo_footer" src="<?php bloginfo('template_url');?>/assets/images/logo-techcd-footer.png">
            <span class="col-md-12">CNPJ <?php echo $footer_opts['footer_cnpj'];?></span>
            <span class="col-md-12"><?php echo $endereco; ?></span>
        </div>
        <div class="col-md-4 pull-left infos">
        	<span class="tel"><?php echo $footer_opts['footer_tel'];?></span>
        	<?php for ($i = 0; $i < count($emails); $i++): ?>
        	  <a class="email" href="mailto:<?php echo $emails[$i];?>" class="col-md-12 emails"><?php echo $emails[$i]; ?></a>
            <?php endfor; ?>
        </div><!-- .col-md-3 pull-left -->
        <a href="<?php echo $footer_opts['footer_mapa_link'];?>" class="col-md-4 pull-right mapa_footer" target="_blank">
        	<img src="<?php echo $mapa_img;?>">
        </a><!-- .col-md-4 mapa_footer -->
    </div>
    <!-- //bottom -->
    <div id="footer" class="container curved-bottom">
    </div>
	<?php wp_footer(); ?>
</body>
</html>
