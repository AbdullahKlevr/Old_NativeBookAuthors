<?php
/**
 * Add/Edit Product Archive Layout setting page
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Blog_Designer_PRO
 * @subpackage Blog_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wpdb, $bdp_errors, $bdp_success;
if ( isset( $_GET['page'] ) && 'bdp_add_product_archive_layout' === $_GET['page'] ) {
	$page                = esc_attr( sanitize_text_field( wp_unslash( $_GET['page'] ) ) );
	$bdp_settings        = array();
	$custom_archive_type = '';
	if ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) {
		$archive_id      = intval( $_GET['id'] );
		$table_name      = $wpdb->prefix . 'bdp_product_archives';
		$get_allsettings = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}bdp_product_archives WHERE ID = %d", $archive_id ), ARRAY_A );
		if ( ! isset( $get_allsettings[0]['settings'] ) ) {
			echo '<div class="updated notice">';
			wp_die( esc_html__( 'You attempted to edit an item that doesn’t exist. Perhaps it was deleted?', 'blog-designer-pro' ) );
			echo '</div>';
		}
		$allsettings = $get_allsettings[0]['settings'];
		if ( is_serialized( $allsettings ) ) {
			$bdp_settings        = maybe_unserialize( $allsettings );
			$custom_archive_type = $get_allsettings[0]['product_archive_template'];
		}
	}
}
$font_family                    = Bdp_Utility::default_recognized_font_faces();
$template_name                  = isset( $bdp_settings['template_name'] ) ? $bdp_settings['template_name'] : 'classical';
$archive_name                   = isset( $bdp_settings['archive_name'] ) ? $bdp_settings['archive_name'] : '';
$posts_per_page                 = isset( $bdp_settings['posts_per_page'] ) ? $bdp_settings['posts_per_page'] : 5;
$pagination_type                = isset( $bdp_settings['pagination_type'] ) ? $bdp_settings['pagination_type'] : 'paged';
$template_category              = isset( $bdp_settings['template_category'] ) ? $bdp_settings['template_category'] : array();
$template_tags                  = isset( $bdp_settings['template_tags'] ) ? $bdp_settings['template_tags'] : array();
$template_author                = isset( $bdp_settings['template_author'] ) ? $bdp_settings['template_author'] : array();
$display_feature_image          = isset( $bdp_settings['display_feature_image'] ) ? $bdp_settings['display_feature_image'] : '1';
$display_category               = isset( $bdp_settings['display_category'] ) ? $bdp_settings['display_category'] : '1';
$display_postlike               = isset( $bdp_settings['display_postlike'] ) ? $bdp_settings['display_postlike'] : '0';
$display_tag                    = isset( $bdp_settings['display_tag'] ) ? $bdp_settings['display_tag'] : '1';
$display_author                 = isset( $bdp_settings['display_author'] ) ? $bdp_settings['display_author'] : '1';
$display_date                   = isset( $bdp_settings['display_date'] ) ? $bdp_settings['display_date'] : '1';
$display_story_year             = isset( $bdp_settings['display_story_year'] ) ? $bdp_settings['display_story_year'] : '1';
$display_comment_count          = isset( $bdp_settings['display_comment_count'] ) ? $bdp_settings['display_comment_count'] : '1';
$template_columns               = isset( $bdp_settings['template_columns'] ) ? $bdp_settings['template_columns'] : 2;
$template_alternativebackground = isset( $bdp_settings['template_alternativebackground'] ) ? $bdp_settings['template_alternativebackground'] : '0';
$template_titlefontface         = isset( $bdp_settings['template_titlefontface'] ) ? $bdp_settings['template_titlefontface'] : 'Georgia, serif';
$template_titlefontsize         = isset( $bdp_settings['template_titlefontsize'] ) ? $bdp_settings['template_titlefontsize'] : '25';
$rss_use_excerpt                = isset( $bdp_settings['rss_use_excerpt'] ) ? $bdp_settings['rss_use_excerpt'] : '1';
$txt_excerpt_length             = isset( $bdp_settings['txtExcerptlength'] ) ? $bdp_settings['txtExcerptlength'] : '50';
$content_fontsize               = isset( $bdp_settings['content_fontsize'] ) ? $bdp_settings['content_fontsize'] : '14';
$template_contentcolor          = isset( $bdp_settings['template_contentcolor'] ) ? $bdp_settings['template_contentcolor'] : '#666';
$template_content_hovercolor    = isset( $bdp_settings['template_content_hovercolor'] ) ? $bdp_settings['template_content_hovercolor'] : '#f5f5f5';
$txt_readmore_text              = isset( $bdp_settings['txtReadmoretext'] ) ? $bdp_settings['txtReadmoretext'] : __( 'Read More', 'blog-designer-pro' );
$template_readmorecolor         = isset( $bdp_settings['template_readmorecolor'] ) ? $bdp_settings['template_readmorecolor'] : '#f1f1f1';
$template_readmorebackcolor     = isset( $bdp_settings['template_readmorebackcolor'] ) ? $bdp_settings['template_readmorebackcolor'] : '#999';
$display_author_biography       = isset( $bdp_settings['display_author_biography'] ) ? $bdp_settings['display_author_biography'] : '1';
$display_author_social          = isset( $bdp_settings['display_author_social'] ) ? $bdp_settings['display_author_social'] : '1';
$bdp_timeline_layout            = isset( $bdp_settings['bdp_timeline_layout'] ) ? $bdp_settings['bdp_timeline_layout'] : '';
$easy_timeline_effect           = isset( $bdp_settings['easy_timeline_effect'] ) ? $bdp_settings['easy_timeline_effect'] : 'default-effect';

$tempate_list = Bdp_Template::blog_template_list();
$loaders      = array(
	'circularG'               => '<div class="bdp-circularG-wrapper"><div class="bdp-circularG bdp-circularG_1"></div><div class="bdp-circularG bdp-circularG_2"></div><div class="bdp-circularG bdp-circularG_3"></div><div class="bdp-circularG bdp-circularG_4"></div><div class="bdp-circularG bdp-circularG_5"></div><div class="bdp-circularG bdp-circularG_6"></div><div class="bdp-circularG bdp-circularG_7"></div><div class="bdp-circularG bdp-circularG_8"></div></div>',
	'floatingCirclesG'        => '<div class="bdp-floatingCirclesG"><div class="bdp-f_circleG bdp-frotateG_01"></div><div class="bdp-f_circleG bdp-frotateG_02"></div><div class="bdp-f_circleG bdp-frotateG_03"></div><div class="bdp-f_circleG bdp-frotateG_04"></div><div class="bdp-f_circleG bdp-frotateG_05"></div><div class="bdp-f_circleG bdp-frotateG_06"></div><div class="bdp-frotateG_07 bdp-f_circleG"></div><div class="bdp-frotateG_08 bdp-f_circleG"></div></div>',
	'spinloader'              => '<div class="bdp-spinloader"></div>',
	'doublecircle'            => '<div class="bdp-doublec-container"><ul class="bdp-doublec-flex-container"><li><span class="bdp-doublec-loading"></span></li></ul></div>',
	'wBall'                   => '<div class="bdp-windows8"><div class="bdp-wBall bdp-wBall_1"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_2"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_3"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_4"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall_5 bdp-wBall"><div class="bdp-wInnerBall"></div></div></div>',
	'cssanim'                 => '<div class="bdp-cssload-aim"></div>',
	'thecube'                 => '<div class="bdp-cssload-thecube"><div class="bdp-cssload-cube bdp-cssload-c1"></div><div class="bdp-cssload-cube bdp-cssload-c2"></div><div class="bdp-cssload-cube bdp-cssload-c4"></div><div class="bdp-cssload-cube bdp-cssload-c3"></div></div>',
	'ballloader'              => '<div class="bdp-ballloader"><div class="bdp-loader-inner bdp-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
	'squareloader'            => '<div class="bdp-squareloader"><div class="bdp-square"></div><div class="bdp-square"></div><div class="bdp-square last"></div><div class="bdp-square clear"></div><div class="bdp-square"></div><div class="bdp-square last"></div><div class="bdp-square clear"></div><div class="bdp-square"></div><div class="bdp-square last"></div></div>',
	'loadFacebookG'           => '<div class="bdp-loadFacebookG"><div class="bdp-blockG_1 bdp-facebook_blockG"></div><div class="bdp-blockG_2 bdp-facebook_blockG"></div><div class="bdp-facebook_blockG bdp-blockG_3"></div></div>',
	'floatBarsG'              => '<div class="bdp-floatBarsG-wrapper"><div class="bdp-floatBarsG_1 bdp-floatBarsG"></div><div class="bdp-floatBarsG_2 bdp-floatBarsG"></div><div class="bdp-floatBarsG_3 bdp-floatBarsG"></div><div class="bdp-floatBarsG_4 bdp-floatBarsG"></div><div class="bdp-floatBarsG_5 bdp-floatBarsG"></div><div class="bdp-floatBarsG_6 bdp-floatBarsG"></div><div class="bdp-floatBarsG_7 bdp-floatBarsG"></div><div class="bdp-floatBarsG_8 bdp-floatBarsG"></div></div>',
	'movingBallG'             => '<div class="bdp-movingBallG-wrapper"><div class="bdp-movingBallLineG"></div><div class="bdp-movingBallG_1 bdp-movingBallG"></div></div>',
	'ballsWaveG'              => '<div class="bdp-ballsWaveG-wrapper"><div class="bdp-ballsWaveG_1 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_2 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_3 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_4 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_5 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_6 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_7 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_8 bdp-ballsWaveG"></div></div>',
	'fountainG'               => '<div class="fountainG-wrapper"><div class="bdp-fountainG_1 bdp-fountainG"></div><div class="bdp-fountainG_2 bdp-fountainG"></div><div class="bdp-fountainG_3 bdp-fountainG"></div><div class="bdp-fountainG_4 bdp-fountainG"></div><div class="bdp-fountainG_5 bdp-fountainG"></div><div class="bdp-fountainG_6 bdp-fountainG"></div><div class="bdp-fountainG_7 bdp-fountainG"></div><div class="bdp-fountainG_8 bdp-fountainG"></div></div>',
	'audio_wave'              => '<div class="bdp-audio_wave"><span></span><span></span><span></span><span></span><span></span></div>',
	'warningGradientBarLineG' => '<div class="bdp-warningGradientOuterBarG"><div class="bdp-warningGradientFrontBarG bdp-warningGradientAnimationG"><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div></div></div>',
	'floatingBarsG'           => '<div class="bdp-floatingBarsG"><div class="bdp-rotateG_01 bdp-blockG"></div><div class="bdp-rotateG_02 bdp-blockG"></div><div class="bdp-rotateG_03 bdp-blockG"></div><div class="bdp-rotateG_04 bdp-blockG"></div><div class="bdp-rotateG_05 bdp-blockG"></div><div class="bdp-rotateG_06 bdp-blockG"></div><div class="bdp-rotateG_07 bdp-blockG"></div><div class="bdp-rotateG_08 bdp-blockG"></div></div>',
	'rotatecircle'            => '<div class="bdp-cssload-loader"><div class="bdp-cssload-inner bdp-cssload-one"></div><div class="bdp-cssload-inner bdp-cssload-two"></div><div class="bdp-cssload-inner bdp-cssload-three"></div></div>',
	'overlay-loader'          => '<div class="bdp-overlay-loader"><div class="bdp-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
	'circlewave'              => '<div class="bdp-circlewave"></div>',
	'cssload-ball'            => '<div class="bdp-cssload-ball"></div>',
	'cssheart'                => '<div class="bdp-cssload-main"><div class="bdp-cssload-heart"><span class="bdp-cssload-heartL"></span><span class="bdp-cssload-heartR"></span><span class="bdp-cssload-square"></span></div><div class="bdp-cssload-shadow"></div></div>',
	'spinload'                => '<div class="bdp-spinload-loading"><i></i><i></i><i></i></div>',
	'bigball'                 => '<div class="bdp-bigball-container"><div class="bdp-bigball-loading"><i></i><i></i><i></i></div></div>',
	'bubblec'                 => '<div class="bdp-bubble-container"><div class="bdp-bubble-loading"><i></i><i></i></div></div>',
	'csball'                  => '<div class="bdp-csball-container"><div class="bdp-csball-loading"><i></i><i></i><i></i><i></i></div></div>',
	'ccball'                  => '<div class="bdp-ccball-container"><div class="bdp-ccball-loading"><i></i><i></i></div></div>',
	'circulardot'             => '<div class="bdp-cssload-wrap"><div class="bdp-circulardot-container"><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span></div></div>',
);

if ( 'cool_horizontal' === $template_name || 'overlay_horizontal' === $template_name ) {
	$pagination_type = 'no_pagination';
}

if ( 'brite' === $template_name ) {
	$winter_category_txt = esc_html__( 'Choose Tags Background Color', 'blog-designer-pro' );
} else {
	$winter_category_txt = esc_html__( 'Choose Category Background Color', 'blog-designer-pro' );
}
?>
<div class="wrap">
	<?php if ( isset( $_GET['message'] ) && 'archive_added_msg' === $_GET['message'] ) { ?>
		<div class="updated notice">
			<p><?php esc_html_e( 'Archive layout added successfully.', 'blog-designer-pro' ); ?></p>
		</div>
		<?php
	}
	if ( isset( $_GET['message'] ) && 'shortcode_duplicate_msg' === $_GET['message'] ) {
		?>
		<div class="updated notice">
			<p><?php esc_html_e( 'Archive layout has been duplicated successfully. Please Select Archive Type.', 'blog-designer-pro' ); ?></p>
		</div>
		<?php
	}
	if ( isset( $bdp_errors ) ) {
		if ( is_wp_error( $bdp_errors ) ) {
			?>
			<div class="error notice">
				<p><?php echo esc_html( $bdp_errors->get_error_message() ); ?></p>
			</div>
			<?php
		}
	}
	if ( isset( $bdp_success ) ) {
		?>
		<div class="updated notice">
			<p><?php echo wp_kses( $bdp_success,  Bdp_Admin_Functions::args_kses() ); ?></p>
		</div>
		<?php
	}
	?>
	<h1 class="bdp-shortcode-div">
		<div class= "pull-left bdp_edit_layout">
		<?php
		if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) ) {
			esc_html_e( 'Edit Product Archive Layout', 'blog-designer-pro' );
		} else {
			esc_html_e( 'Add Product Archive Layout', 'blog-designer-pro' );
		}
		?>
		</div>
		<?php if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) ) { ?>
			<div class="pull-right">
			<a class="page-title-action bdp_create_new_layout" href="?page=bdp_add_product_archive_layout">
				<?php esc_html_e( 'Create New Archive Layout', 'blog-designer-pro' ); ?>
			</a>
			</div>
		<?php } ?>
	</h1>
	<div class="splash-screen"></div>
	<form method="post" action="" id="edit_archive_layout_form" class="bd-form-class bdp-product-archive-page">
		<?php
		wp_nonce_field( 'bdp-product-archive-page-submit', 'bdp-product-archive-nonce' );
		$page = '';
		if ( isset( $_GET['page'] ) && '' != $_GET['page'] ) {
			$page = esc_attr( sanitize_text_field( wp_unslash( $_GET['page'] ) ) );
			?>
			<input type="hidden" name="originalpage" class="bdporiginalpage" value="<?php echo esc_attr( $page ); ?>">
		<?php } ?>
		<div id="poststuff">
			<div class="postbox-container bd-settings-wrappers bd_poststuff">
				<div class="bdp-preview-box" id="bdp-preview-box"></div>
				<div class="bd-header-wrapper">
					<div class="bd-logo-wrapper pull-left">
						<h3><?php esc_html_e( 'Blog designer settings', 'blog-designer-pro' ); ?></h3>
					</div>
					<div class="pull-right">
						<a id="bdp-btn-show-submit" title="<?php esc_html_e( 'Save Changes', 'blog-designer-pro' ); ?>" class="show_archive_save button submit_fixed button-primary">
							<span><i class="fas fa-check"></i>&nbsp;&nbsp;<?php esc_html_e( 'Save Changes', 'blog-designer-pro' ); ?></span>
						</a>
						<input type="submit" style="display:none;" class="button-primary archive_savebtn button" name="savedata" value="<?php esc_attr_e( 'Save Changes', 'blog-designer-pro' ); ?>" />
					</div>
				</div>
				<div class="bd-menu-setting">
					<?php
					$bdpgeneral_class               = '';
					$dbptimeline_class              = '';
					$bdpstandard_class              = '';
					$bdptitle_class                 = '';
					$bdpauthor_class                = '';
					$bdpcontent_class               = '';
					$bdpmedia_class                 = '';
					$bdpslider_class                = '';
					$bdpsocial_class                = '';
					$bdpfilter_class                = '';
					$bdppagination_class            = '';
					$bdpproductsetting_class        = '';
					$bdpacffieldssetting_class      = '';
					$bdpgeneral_class_show          = '';
					$dbptimeline_class_show         = '';
					$bdpstandard_class_show         = '';
					$bdptitle_class_show            = '';
					$bdpauthor_class_show           = '';
					$bdpcontent_class_show          = '';
					$bdpmedia_class_show            = '';
					$bdpslider_class_show           = '';
					$bdpsocial_class_show           = '';
					$bdpfilter_class_show           = '';
					$bdppagination_class            = '';
					$bdppagination_class_show       = '';
					$bdpproductsetting_class_show   = '';
					$bdpacffieldssetting_class_show = '';
					if ( Bdp_Posts::postbox_classes( 'bdpproductgeneral', $page ) ) {
						$bdpgeneral_class      = 'bd-active-tab';
						$bdpgeneral_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpstandard', $page ) ) {
						$bdpstandard_class      = 'bd-active-tab';
						$bdpstandard_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdptitle', $page ) ) {
						$bdptitle_class      = 'bd-active-tab';
						$bdptitle_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpcontent', $page ) ) {
						$bdpcontent_class      = 'bd-active-tab';
						$bdpcontent_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpmedia', $page ) ) {
						$bdpmedia_class      = 'bd-active-tab';
						$bdpmedia_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'dbptimeline', $page ) ) {
						$dbptimeline_class      = 'bd-active-tab';
						$dbptimeline_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpslider', $page ) ) {
						$bdpslider_class      = 'bd-active-tab';
						$bdpslider_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpfilter', $page ) ) {
						$bdpfilter_class      = 'bd-active-tab';
						$bdpfilter_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdppagination', $page ) ) {
						$bdppagination_class      = 'bd-active-tab';
						$bdppagination_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpproductarchivesetting', $page ) ) {
						$bdpproductsetting_class      = 'bd-active-tab';
						$bdpproductsetting_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpacffield', $page ) ) {
						$bdpsocial_class      = 'bd-active-tab';
						$bdpsocial_class_show = 'display:block';
					} elseif ( Bdp_Posts::postbox_classes( 'bdpsocial', $page ) ) {
						$bdpsocial_class      = 'bd-active-tab';
						$bdpsocial_class_show = 'display:block';
					} else {
						$bdpgeneral_class      = 'bd-active-tab';
						$bdpgeneral_class_show = 'display:block';
					}
					?>
					<ul class="bd-setting-handle">
						<li data-show="bdpproductgeneral" class=<?php echo esc_attr( $bdpgeneral_class ); ?>>
							<i class="fas fa-cog"></i>
							<span><?php esc_html_e( 'General Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdpstandard" class=<?php echo esc_attr( $bdpstandard_class ); ?>>
							<i class="fas fa-gavel"></i>
							<span><?php esc_html_e( 'Standard Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdptitle" class=<?php echo esc_attr( $bdptitle_class ); ?>>
							<i class="fas fa-text-width"></i>
							<span><?php esc_html_e( 'Title Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdpcontent" class=<?php echo esc_attr( $bdpcontent_class ); ?>>
							<i class="far fa-file-alt"></i>
							<span><?php esc_html_e( 'Content Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdpmedia" class=<?php echo esc_attr( $bdpmedia_class ); ?>>
							<i class="far fa-image"></i>
							<span><?php esc_html_e( 'Media Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="dbptimeline" class=<?php echo esc_attr( $dbptimeline_class ); ?>>
							<i class="far fa-clock"></i>
							<span><?php esc_html_e( 'Horizontal Timeline Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdpslider" class=<?php echo esc_attr( $bdpslider_class ); ?>>
							<i class="fas fa-sliders-h"></i>
							<span><?php esc_html_e( 'Slider Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdpfilter" class=<?php echo esc_attr( $bdpfilter_class ); ?>>
							<i class="fas fa-filter"></i>
							<span><?php esc_html_e( 'Filter Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<li data-show="bdppagination" class=<?php echo esc_attr( $bdppagination_class ); ?>>
							<i class="fas fa-angle-double-right"></i>
							<span><?php esc_html_e( 'Pagination Settings', 'blog-designer-pro' ); ?></span>
						</li>
						<?php
						if ( Bdp_Woocommerce::is_woocommerce_plugin() ) {
							?>
							<li data-show="bdpproductarchivesetting" class=<?php echo esc_attr( $bdpproductsetting_class ); ?>>
								<i class="fas fa-shopping-cart"></i>
								<span><?php esc_html_e( 'Product Settings', 'blog-designer-pro' ); ?></span>
							</li>
							<?php
						}
						?>
						<?php
						if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
							$groups = acf_get_field_groups();
							if ( ! empty( $groups ) ) {
								?>
								<li data-show="bdpacffieldssetting" class=<?php echo esc_attr( $bdpacffieldssetting_class ); ?>>
									<i class="fas fa-plus-square"></i>
									<span><?php esc_html_e( 'Acf Field Settings', 'blog-designer-pro' ); ?></span>
								</li>
								<?php
							}
						}
						?>
						<li data-show="bdpsocial" class=<?php echo esc_attr( $bdpsocial_class ); ?>>
							<i class="fas fa-share-alt"></i>
							<span><?php esc_html_e( 'Social Share Settings', 'blog-designer-pro' ); ?></span>
						</li>
					</ul>
				</div>
				<div id="bdpproductgeneral" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpgeneral_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<h3 class="bdp-table-title"><?php esc_html_e( 'Select Product Archive Layout', 'blog-designer-pro' ); ?></h3>
							<li>
								<div class="bdp-left">
									<p class="bdp-margin-bottom-50"><?php esc_html_e( 'Select your favorite layout from 61 powerful archive layouts', 'blog-designer-pro' ); ?>. </p>
									<p class="bdp-margin-bottom-30"><b> <?php esc_html_e( 'Current Template', 'blog-designer-pro' ); ?>:</b> &nbsp;&nbsp;
										<span class="bdp-template-name">
										<?php
										if ( isset( $bdp_settings['template_name'] ) ) {
											echo esc_html( $tempate_list[ $bdp_settings['template_name'] ]['template_name'] );
										} else {
											esc_html_e( 'Classical Template', 'blog-designer-pro' );
										}
										?>
										</span>
									</p>
									<div class="bdp_select_template_button_div">
										<input type="button" class="bdp_select_template" value="<?php esc_attr_e( 'Select Other Template', 'blog-designer-pro' ); ?>">
										<?php
										if ( isset( $_GET['page'] ) && 'add_shortcode' === $_GET['page'] && ! isset( $_GET['action'] ) ) {
											$bdpcrtscode = 'bdp_template_name bdp-create-shortcode';
										} else {
											$bdpcrtscode = 'bdp_template_name';
										}
										if ( $template_name ) {
											$temp_nameval = $template_name;
										} else {
											$temp_nameval = '';
										}
										?>
										<input type="hidden" class="<?php echo esc_attr( $bdpcrtscode ); ?>" value="<?php echo esc_attr( $temp_nameval ); ?>" name="template_name">
									</div>
									<?php if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['id'] ) ) { ?>
										<input type="submit" class="bdp-reset-data" name="resetdata" value="<?php esc_attr_e( 'Reset Layout Settings', 'blog-designer-pro' ); ?>" />
										<?php
									}
									?>
								</div>
								<div class="bdp-right">
									<div class="select_button_upper_div">

										<div class="bdp_selected_template_image">
											<div 
											<?php
											if ( empty( $template_name ) ) {
												echo ' class="bdp_no_template_found"';
											}
											?>
											>
												<?php
												if ( ! empty( $template_name ) ) {
													$image_name = $template_name . '.jpg';
													?>
												<img title="
													<?php
													if ( isset( $bdp_settings['template_name'] ) ) {
														echo esc_attr( $tempate_list[ $bdp_settings['template_name'] ]['template_name'] );
													}
													?>
													" alt="
													<?php
													if ( isset( $bdp_settings['template_name'] ) ) {
														echo esc_attr( $tempate_list[ $bdp_settings['template_name'] ]['template_name'] );
													}
													?>
													" src="
													<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/admin/images/layouts/' . esc_attr( $image_name ); ?>" />
												<label id="template_select_name">
													<?php
													if ( isset( $bdp_settings['template_name'] ) ) {
														echo esc_html( $tempate_list[ $bdp_settings['template_name'] ]['template_name'] );
													} else {
														esc_html_e( 'Classical Template', 'blog-designer-pro' );
													}
													?>
												</label>
													<?php
												} else {
													esc_html_e( 'No template exist for selection', 'blog-designer-pro' );
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Template Color Preset', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right bdp-preset-position">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select color preset', 'blog-designer-pro' ); ?></span></span>
									<?php
										$bdp_color_preset      = isset( $bdp_settings['bdp_color_preset'] ) ? $bdp_settings['bdp_color_preset'] : $template_name . '_default';
										$template_color_preset = array(
											'accordion'    => array(
												'accordion_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#239190,template_fthovercolor:#ffffff,template_titlecolor:#239190,template_icon_color:#239190,template_titlehovercolor:#333333,template_titlebackcolor:#ffffff,template_contentcolor:#555555,template_readmorecolor:#ffffff,template_readmorebackcolor:#239190,bdp_sale_tagbgcolor:#239190,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#239190,bdp_pricetextcolor:#555555,bdp_wishlist_textcolor:#239190,bdp_wishlist_backgroundcolor:#f2f2f2,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#239190,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#239190,bdp_addtocart_text_hover_color:#239190,bdp_addtocart_hover_backgroundcolor:#f2f2f2',
													'display_value' => '#239190,#ffffff,#239190,#555555',
												),
												'accordion_persian-red' => array(
													'preset_name' => esc_html__( 'Persian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#dd3333,template_fthovercolor:#ffffff,template_titlecolor:#484848,template_icon_color:#484848,template_titlehovercolor:#dd3333,template_titlebackcolor:#ffffff,template_contentcolor:#7b7b7b,template_readmorecolor:#ffffff,template_readmorebackcolor:#535353,bdp_sale_tagbgcolor:#484848,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#dd3333,bdp_pricetextcolor:#555555,bdp_wishlist_textcolor:#484848,bdp_wishlist_backgroundcolor:#f2f2f2,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#484848,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#484848,bdp_addtocart_text_hover_color:#484848,bdp_addtocart_hover_backgroundcolor:#f2f2f2',
													'display_value' => '#dd3333,#ffffff,#dd3333,#484848',
												),
												'accordion_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EAEDF6,template_ftcolor:#465BAC,template_fthovercolor:#ffffff,template_titlecolor:#465BAC,template_icon_color:#465BAC,template_titlehovercolor:#484848,template_titlebackcolor:#eaedf6,template_contentcolor:#7b7b7b,template_readmorecolor:#465BAC,template_readmorebackcolor:#EAEDF6,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#465BAC,bdp_pricetextcolor:#484848,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#484848,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#484848',
													'display_value' => '#465BAC,#EAEDF6,#465BAC,#484848',
												),
												'accordion_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FFEAF1,template_ftcolor:#FA336C,template_fthovercolor:#ffffff,template_titlecolor:#FA336C,template_icon_color:#FA336C,template_titlehovercolor:#484848,template_titlebackcolor:#FFEAF1,template_contentcolor:#7b7b7b,template_readmorecolor:#FA336C,template_readmorebackcolor:#FFEAF1,bdp_sale_tagbgcolor:#FA336C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#FA336C,bdp_wishlist_textcolor:#FA336C,bdp_wishlist_backgroundcolor:#ffeaf1,bdp_wishlist_text_hover_color:#ffeaf1,bdp_wishlist_hover_backgroundcolor:#FA336C,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FA336C,bdp_addtocart_text_hover_color:#FA336C,bdp_addtocart_hover_backgroundcolor:#ffeaf1',
													'display_value' => '#FA336C,#FFEAF1,#FA336C,#484848',
												),
												'accordion_flamenco' => array(
													'preset_name' => esc_html__( 'Flamenco', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FFF3ED,template_ftcolor:#683C6F,template_fthovercolor:#ffffff,template_titlecolor:#683C6F,template_icon_color:#683C6F,template_titlehovercolor:#484848,template_titlebackcolor:#FFF3ED,template_contentcolor:#7b7b7b,template_readmorecolor:#683C6F,template_readmorebackcolor:#FFF3ED,bdp_sale_tagbgcolor:#683C6F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#683C6F,bdp_wishlist_textcolor:#683C6F,bdp_wishlist_backgroundcolor:#FFF3ED,bdp_wishlist_text_hover_color:#FFF3ED,bdp_wishlist_hover_backgroundcolor:#683C6F,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#683C6F,bdp_addtocart_text_hover_color:#683C6F,bdp_addtocart_hover_backgroundcolor:#FFF3ED',
													'display_value' => '#683C6F,#FFF3ED,#683C6F,#484848',
												),
												'accordion_finch' => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EFF0EB,template_ftcolor:#75815B,template_fthovercolor:#ffffff,template_titlecolor:#75815B,template_icon_color:#75815B,template_titlehovercolor:#484848,template_titlebackcolor:#EFF0EB,template_contentcolor:#7b7b7b,template_readmorecolor:#75815B,template_readmorebackcolor:#EFF0EB,bdp_sale_tagbgcolor:#75815B,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#75815B,bdp_wishlist_textcolor:#75815B,bdp_wishlist_backgroundcolor:#EFF0EB,bdp_wishlist_text_hover_color:#EFF0EB,bdp_wishlist_hover_backgroundcolor:#75815B,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75815B,bdp_addtocart_text_hover_color:#75815B,bdp_addtocart_hover_backgroundcolor:#EFF0EB',
													'display_value' => '#75815B,#EFF0EB,#75815B,#484848',
												),
											),
											'blog_grid_box' => array(
												'blog_grid_box_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#3E91AD,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#3E91AD,template_readmorecolor:#3E91AD,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#3E91AD,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#222222,bdp_edd_price_color:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#3E91AD,bdp_edd_addtocart_backgroundcolor:#3E91AD,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222,bdp_edd_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#3E91AD,#222222,#555555,#666666',
												),
												'blog_grid_box_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F3F0F1,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_readmorecolor:#6D4657,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#49182D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#49182D,bdp_edd_price_color:#49182D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#49182D,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6D4657,bdp_edd_addtocart_backgroundcolor:#6D4657,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#49182D,#6D4657,#555555,#666666',
												),
												'blog_grid_box_prussian' => array(
													'preset_name' => esc_html__( 'Prussian', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#99a8ba,template_bgcolor:#e5e9ed,template_ftcolor:#000308,template_fthovercolor:#000b19,template_titlecolor:#e5e9ed,template_titlehovercolor:#99a8ba,template_titlebackcolor:,template_contentcolor:#000308,template_readmorecolor:#e5e9ed,template_readmorebackcolor:#000308,template_readmore_hover_backcolor:#193b65,beforeloop_readmorecolor:#e5e9ed,beforeloop_readmorebackcolor:#000308,beforeloop_readmorehovercolor:#e5e9ed,beforeloop_readmorehoverbackcolor:#193b65,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#193b65,bdp_pricetextcolor:#000308,bdp_edd_price_color:#000308,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000b19,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#193b65,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_edd_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000308,bdp_edd_addtocart_hover_backgroundcolor:#000308',
													'display_value' => '#99a8ba,#193b65,#000b19,#000308',
												),
												'blog_grid_box_tangerine'   => array(
													'preset_name' => esc_html__( 'Tangerine', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f8df9f,template_bgcolor:#fdf7e7,template_ftcolor:#171101,template_fthovercolor:#473505,template_titlecolor:#fdf7e7,template_titlehovercolor:#f8df9f,template_titlebackcolor:,template_contentcolor:#171101,template_readmorecolor:#fdf7e7,template_readmorebackcolor:#171101,template_readmore_hover_backcolor:#efb828,beforeloop_readmorecolor:#fdf7e7,beforeloop_readmorebackcolor:#171101,beforeloop_readmorehovercolor:#fdf7e7,beforeloop_readmorehoverbackcolor:#efb828,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#473505,bdp_pricetextcolor:#171101,bdp_edd_price_color:#171101,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#888888,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#473505,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_edd_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#473505,bdp_edd_addtocart_hover_backgroundcolor:#473505',
													'display_value' => '#f8df9f,#efb828,#473505,#171101',
												),
											),
											'blog_carousel' => array(
												'blog_carousel_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#15506F,template_bgcolor:#ffffff,template_bghovercolor:#DFEDF1,template_ftcolor:#15506F,template_fthovercolor:#555555,template_titlecolor:#15506F,template_titlehovercolor:#DFEDF1,template_contentcolor:#999999,template_readmorecolor:#15506F,template_readmorebackcolor:#15506F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#15506F,beforeloop_readmorehovercolor:#15506F,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#15506F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#15506F,bdp_pricetextcolor:#999999,bdp_edd_price_color:#999999,bdp_wishlist_textcolor:#15506F,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#15506F,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#15506F,bdp_edd_addtocart_backgroundcolor:#15506F,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#15506F,#DFEDF1,#555555,#999999',
												),
												'blog_carousel_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#974772,template_bgcolor:#ffffff,template_bghovercolor:#EDE1E7,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#974772,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#974772,bdp_pricetextcolor:#999999,bdp_edd_price_color:#999999,bdp_wishlist_textcolor:#974772,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#974772,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#974772,bdp_edd_addtocart_backgroundcolor:#974772,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#7D194F,#974772,#555555,#999999',
												),
												'blog_carousel_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#465BAC,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#465BAC,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#465BAC,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#465BAC,bdp_pricetextcolor:#e0e0e0,bdp_edd_price_color:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#465BAC,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_edd_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#465BAC,bdp_edd_addtocart_hover_backgroundcolor:#465BAC',
													'display_value' => '#465BAC,#e0e0e0,#ffffff,#e0e0e0',
												),
												'blog_carousel_finch'   => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#93A564,template_bgcolor:#ffffff,template_bghovercolor:#EDEDE9,template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#93A564,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#93A564,bdp_pricetextcolor:#999999,bdp_edd_price_color:#999999,bdp_wishlist_textcolor:#93A564,bdp_wishlist_backgroundcolor:#EDEDE9,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#93A564,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#93A564,bdp_edd_addtocart_backgroundcolor:#93A564,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#788F3D,#93A564,#555555,#999999',
												),
											),
											'boxy'         => array(
												'boxy_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#239190,template_fthovercolor:#ffffff,template_titlecolor:#239190,template_titlehovercolor:#333333,template_titlebackcolor:#ffffff,template_contentcolor:#555555,template_readmorecolor:#ffffff,template_readmorebackcolor:#239190,bdp_sale_tagbgcolor:#239190,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#239190,bdp_pricetextcolor:#555555,bdp_wishlist_textcolor:#239190,bdp_wishlist_backgroundcolor:#f2f2f2,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#239190,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#239190,bdp_addtocart_text_hover_color:#239190,bdp_addtocart_hover_backgroundcolor:#f2f2f2',
													'display_value' => '#239190,#ffffff,#239190,#555555',
												),
												'boxy_persian-red' => array(
													'preset_name' => esc_html__( 'Persian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#dd3333,template_fthovercolor:#ffffff,template_titlecolor:#484848,template_titlehovercolor:#dd3333,template_titlebackcolor:#ffffff,template_contentcolor:#7b7b7b,template_readmorecolor:#ffffff,template_readmorebackcolor:#535353,bdp_sale_tagbgcolor:#484848,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#dd3333,bdp_pricetextcolor:#555555,bdp_wishlist_textcolor:#484848,bdp_wishlist_backgroundcolor:#f2f2f2,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#484848,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#484848,bdp_addtocart_text_hover_color:#484848,bdp_addtocart_hover_backgroundcolor:#f2f2f2',
													'display_value' => '#dd3333,#ffffff,#dd3333,#484848',
												),
												'boxy_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EAEDF6,template_ftcolor:#465BAC,template_fthovercolor:#ffffff,template_titlecolor:#465BAC,template_titlehovercolor:#484848,template_titlebackcolor:#eaedf6,template_contentcolor:#7b7b7b,template_readmorecolor:#465BAC,template_readmorebackcolor:#EAEDF6,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#465BAC,bdp_pricetextcolor:#484848,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#484848,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#484848',
													'display_value' => '#465BAC,#EAEDF6,#465BAC,#484848',
												),
												'boxy_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FFEAF1,template_ftcolor:#FA336C,template_fthovercolor:#ffffff,template_titlecolor:#FA336C,template_titlehovercolor:#484848,template_titlebackcolor:#FFEAF1,template_contentcolor:#7b7b7b,template_readmorecolor:#FA336C,template_readmorebackcolor:#FFEAF1,bdp_sale_tagbgcolor:#FA336C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#FA336C,bdp_wishlist_textcolor:#FA336C,bdp_wishlist_backgroundcolor:#ffeaf1,bdp_wishlist_text_hover_color:#ffeaf1,bdp_wishlist_hover_backgroundcolor:#FA336C,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FA336C,bdp_addtocart_text_hover_color:#FA336C,bdp_addtocart_hover_backgroundcolor:#ffeaf1',
													'display_value' => '#FA336C,#FFEAF1,#FA336C,#484848',
												),
												'boxy_flamenco' => array(
													'preset_name' => esc_html__( 'Flamenco', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FFF3ED,template_ftcolor:#683C6F,template_fthovercolor:#ffffff,template_titlecolor:#683C6F,template_titlehovercolor:#484848,template_titlebackcolor:#FFF3ED,template_contentcolor:#7b7b7b,template_readmorecolor:#683C6F,template_readmorebackcolor:#FFF3ED,bdp_sale_tagbgcolor:#683C6F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#683C6F,bdp_wishlist_textcolor:#683C6F,bdp_wishlist_backgroundcolor:#FFF3ED,bdp_wishlist_text_hover_color:#FFF3ED,bdp_wishlist_hover_backgroundcolor:#683C6F,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#683C6F,bdp_addtocart_text_hover_color:#683C6F,bdp_addtocart_hover_backgroundcolor:#FFF3ED',
													'display_value' => '#683C6F,#FFF3ED,#683C6F,#484848',
												),
												'boxy_finch' => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EFF0EB,template_ftcolor:#75815B,template_fthovercolor:#ffffff,template_titlecolor:#75815B,template_titlehovercolor:#484848,template_titlebackcolor:#EFF0EB,template_contentcolor:#7b7b7b,template_readmorecolor:#75815B,template_readmorebackcolor:#EFF0EB,bdp_sale_tagbgcolor:#75815B,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#75815B,bdp_wishlist_textcolor:#75815B,bdp_wishlist_backgroundcolor:#EFF0EB,bdp_wishlist_text_hover_color:#EFF0EB,bdp_wishlist_hover_backgroundcolor:#75815B,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75815B,bdp_addtocart_text_hover_color:#75815B,bdp_addtocart_hover_backgroundcolor:#EFF0EB',
													'display_value' => '#75815B,#EFF0EB,#75815B,#484848',
												),
											),
											'boxy-clean'   => array(
												'boxy-clean_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#15506F,template_bgcolor:#ffffff,template_bghovercolor:#DFEDF1,template_ftcolor:#15506F,template_fthovercolor:#555555,template_titlecolor:#15506F,template_titlehovercolor:#DFEDF1,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#15506F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#15506F,beforeloop_readmorehovercolor:#15506F,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#15506F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#15506F,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#15506F,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#15506F,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#15506F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#15506F,#DFEDF1,#555555,#999999',
												),
												'boxy-clean_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#974772,template_bgcolor:#ffffff,template_bghovercolor:#EDE1E7,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#974772,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#974772,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#974772,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#974772,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#974772,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#7D194F,#974772,#555555,#999999',
												),
												'boxy-clean_roof_terracotta' => array(
													'preset_name' => esc_html__( 'Roof Terracotta', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#B06F6D,template_bgcolor:#ffffff,template_bghovercolor:#F1E7E7,template_ftcolor:#555555,template_fthovercolor:#B06F6D,template_titlecolor:#9C4B48,template_titlehovercolor:#B06F6D,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#B06F6D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#B06F6D,beforeloop_readmorehovercolor:#B06F6D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#B06F6D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#B06F6D,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#B06F6D,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#B06F6D,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B06F6D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#9C4B48,#B06F6D,#555555,#999999',
												),
												'boxy-clean_lemon-ginger' => array(
													'preset_name' => esc_html__( 'Lemon Ginger', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#CEBF59,template_bgcolor:#ffffff,template_bghovercolor:#F0EEE4,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#CEBF59,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CEBF59,beforeloop_readmorehovercolor:#CEBF59,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#CEBF59,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#CEBF59,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#CEBF59,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#CEBF59,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#CEBF59,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#C2AF2F,#CEBF59,#555555,#999999',
												),
												'boxy-clean_finch' => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#93A564,template_bgcolor:#ffffff,template_bghovercolor:#EDEDE9,template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#93A564,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#93A564,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#93A564,bdp_wishlist_backgroundcolor:#EDEDE9,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#93A564,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#93A564,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#788F3D,#93A564,#555555,#999999',
												),
												'boxy-clean_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#6D4657,template_bgcolor:#ffffff,template_bghovercolor:#E7E1E3,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D4657,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6D4657,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#6D4657,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#6D4657,bdp_wishlist_backgroundcolor:#E7E1E3,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#6D4657,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6D4657,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#49182D,#6D4657,#555555,#999999',
												),
											),
											'brit_co'      => array(
												'brit_co_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#222222,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#3E91AD,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#222222,bdp_star_rating_bg_color:#3E91AD,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#3E91AD,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#222222,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#222222,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#3E91AD',
													'display_value' => '#222222,#3E91AD,#555555,#999999',
												),
												'brit_co_yonder' => array(
													'preset_name' => esc_html__( 'Yonder', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#F18547,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8BA3CE,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#6E8CC2,bdp_star_rating_bg_color:#8BA3CE,bdp_pricetextcolor:#6E8CC2,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#8BA3CE,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#6E8CC2,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#8BA3CE',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#999999',
												),
												'brit_co_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#67704E,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#414C22,bdp_star_rating_bg_color:#67704E,bdp_pricetextcolor:#414C22,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#414C22,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#67704E',
													'display_value' => '#414C22,#67704E,#555555,#999999',
												),
												'brit_co_lemon_ginger' => array(
													'preset_name' => esc_html__( 'Lemon Ginger', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#A39D5A,template_titlecolor:#8C8431,template_titlehovercolor:#A39D5A,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#A39D5A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#8C8431,bdp_star_rating_bg_color:#A39D5A,bdp_pricetextcolor:#8C8431,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#A39D5A,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#8C8431,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C8431,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#A39D5A',
													'display_value' => '#8C8431,#A39D5A,#555555,#999999',
												),
												'brit_co_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ED4961,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#E81B3A,bdp_star_rating_bg_color:#ED4961,bdp_pricetextcolor:#E81B3A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#ED4961,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#E81B3A,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E81B3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#ED4961',
													'display_value' => '#E81B3A,#ED4961,#555555,#999999',
												),
												'brit_co_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#BE9055,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#AE742A,bdp_star_rating_bg_color:#BE9055,bdp_pricetextcolor:#AE742A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#BE9055,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#AE742A,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AE742A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#BE9055',
													'display_value' => '#AE742A,#BE9055,#555555,#999999',
												),
											),
											'brite'        => array(
												'brite_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff;template_ftcolor:#555555,template_fthovercolor:#0e83cd,winter_category_color:#0e83cd,template_titlecolor:#222222,template_titlehovercolor:#0e83cd,template_contentcolor:#545454,template_readmorecolor:#ffffff,template_readmorebackcolor:#0e83cd,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0e83cd,beforeloop_readmorehovercolor:#0e83cd,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0e83cd,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#545454,bdp_star_rating_bg_color:#0e83cd,bdp_pricetextcolor:#545454,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#0e83cd,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0e83cd,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#0e83cd,#222222,#555555,#545454',
												),
												'brite_mountain_meadow' => array(
													'preset_name' => esc_html__( 'Mountain Meadow', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff;template_ftcolor:#545454,template_fthovercolor:#5dbabc,winter_category_color:#21be85,template_titlecolor:#222222,template_titlehovercolor:#21be85,template_contentcolor:#545454,template_readmorecolor:#ffffff,template_readmorebackcolor:#21be85,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#21be85,beforeloop_readmorehovercolor:#21be85,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#5dbabc,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#545454,bdp_star_rating_bg_color:#5dbabc,bdp_pricetextcolor:#545454,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#21be85,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#5dbabc,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#21be85,#5dbabc,#222222,#545454',
												),
												'brite_brandy_punch' => array(
													'preset_name' => esc_html__( 'Brandy Punch', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff;template_ftcolor:#545454,template_fthovercolor:#c27938,winter_category_color:#c27938,template_titlecolor:#c27938,template_titlehovercolor:#222222,template_contentcolor:#545454,template_readmorecolor:#ffffff,template_readmorebackcolor:#c27938,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#c27938,beforeloop_readmorehovercolor:#c27938,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#c27938,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#545454,bdp_star_rating_bg_color:#c27938,bdp_pricetextcolor:#545454,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#c27938,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#c27938,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#c27938,#222222,#555555,#545454',
												),
											),
											'chapter'      => array(
												'chapter_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#e9181d,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ffffff,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#e9181d,beforeloop_readmorehovercolor:#e9181d,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#e9181d,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e9181d,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#a9181d,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#a9181d,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#a9181d,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#a9181d',
													'display_value' => '#e9181d,#000000,#ffffff,#ffffff',
												),
												'chapter_curious_blue' => array(
													'preset_name' => esc_html__( 'Curious Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#257fb4,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#e1edf5,template_titlehovercolor:#ffffff,template_contentcolor:#e1edf5,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#257fb4,beforeloop_readmorehovercolor:#257fb4,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#257fb4,bdp_sale_tagtextcolor:#e1edf5,bdp_star_rating_color:#e1edf5,bdp_star_rating_bg_color:#e1edf5,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#257fb4,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#257fb4,bdp_addtocart_textcolor:#257fb4,bdp_addtocart_backgroundcolor:#e1edf5,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#257fb4',
													'display_value' => '#257fb4,#000000,#e1edf5,#ffffff',
												),
												'chapter_buddha_gold' => array(
													'preset_name' => esc_html__( 'Buddha Gold', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#c4a618,template_bgcolor:#342b06,template_ftcolor:#f7f3e1,template_fthovercolor:#f7f3e1,template_titlecolor:#f0e7c3,template_titlehovercolor:#f7f3e1,template_contentcolor:#f7f3e1,template_readmorecolor:#f7f3e1,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#c4a618,beforeloop_readmorehovercolor:#c4a618,beforeloop_readmorehoverbackcolor:#f7f3e1,bdp_sale_tagbgcolor:#c4a618,bdp_sale_tagtextcolor:#f7f3e1,bdp_star_rating_color:#f0e7c3,bdp_star_rating_bg_color:#f0e7c3,bdp_pricetextcolor:#f0e7c3,bdp_wishlist_textcolor:#f7f3e1,bdp_wishlist_backgroundcolor:#c4a618,bdp_wishlist_text_hover_color:#342b06,bdp_wishlist_hover_backgroundcolor:#f0e7c3,bdp_addtocart_textcolor:#342b06,bdp_addtocart_backgroundcolor:#f0e7c3,bdp_addtocart_text_hover_color:#f7f3e1,bdp_addtocart_hover_backgroundcolor:#c4a618',
													'display_value' => '#c4a618,#342b06,#f0e7c3,#f7f3e1',
												),
												'chapter_sea_green' => array(
													'preset_name' => esc_html__( 'Sea Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#1ba3ab,template_bgcolor:#051b1d,template_ftcolor:#e1f3f4,template_fthovercolor:#e1f3f4,template_titlecolor:#c3e7e9,template_titlehovercolor:#e1f3f4,template_contentcolor:#e1f3f4,template_readmorecolor:#e1f3f4,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#1ba3ab,beforeloop_readmorehovercolor:#1ba3ab,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#1ba3ab,bdp_sale_tagtextcolor:#e1f3f4,bdp_star_rating_color:#1ba3ab,bdp_star_rating_bg_color:#c3e7e9,bdp_pricetextcolor:#c3e7e9,bdp_wishlist_textcolor:#e1f3f4,bdp_wishlist_backgroundcolor:#051b1d,bdp_wishlist_text_hover_color:#c3e7e9,bdp_wishlist_hover_backgroundcolor:#051b1d,bdp_addtocart_textcolor:#1ba3ab,bdp_addtocart_backgroundcolor:#e1f3f4,bdp_addtocart_text_hover_color:#e1f3f4,bdp_addtocart_hover_backgroundcolor:#051b1d',
													'display_value' => '#1ba3ab,#051b1d,#c3e7e9,#e1f3f4',
												),
												'chapter_fun_green' => array(
													'preset_name' => esc_html__( 'Fun Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#0E663C,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ffffff,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0E663C,beforeloop_readmorehovercolor:#0E663C,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#0E663C,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#0E663C,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#0E663C,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#0E663C,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E663C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#0E663C',
													'display_value' => '#0E663C,#000000,#ffffff,#ffffff',
												),
												'chapter_madras' => array(
													'preset_name' => esc_html__( 'Madras', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#493917,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ffffff,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#493917,beforeloop_readmorehovercolor:#493917,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#493917,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#493917,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#493917,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#493917,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#493917,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#493917',
													'display_value' => '#493917,#000000,#ffffff,#ffffff',
												),
											),
											'cover'        => array(
												'cover_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f2f2f2,template_bgcolor:#f9f9f9,template_ftcolor:#fb6262,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#fb6262,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#fb6262,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#fb6262,bdp_sale_tagbgcolor:#fb6262,bdp_sale_tagtextcolor:#f2f2f2,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#fb6262,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#f2f2f2,bdp_wishlist_backgroundcolor:#fb6262,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#f2f2f2,bdp_addtocart_hover_backgroundcolor:#fb6262',
													'display_value' => '#f2f2f2,#fb6262,#333333,#666666',
												),
												'cover_dodger_blue' => array(
													'preset_name' => esc_html__( 'Dodger Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#E2F1FC,template_bgcolor:#f9f9f9,template_ftcolor:#2A97EA,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#2A97EA,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#2A97EA,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#2A97EA,bdp_sale_tagbgcolor:#2A97EA,bdp_sale_tagtextcolor:#E2F1FC,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#2A97EA,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#E2F1FC,bdp_wishlist_backgroundcolor:#2A97EA,bdp_wishlist_text_hover_color:#E2F1FC,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#E2F1FC,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#E2F1FC,bdp_addtocart_hover_backgroundcolor:#2A97EA',
													'display_value' => '#E2F1FC,#2A97EA,#333333,#666666',
												),
												'cover_west_side' => array(
													'preset_name' => esc_html__( 'West Side', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#fcf2e9,template_bgcolor:#f9f9f9,template_ftcolor:#EA7D2A,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#EA7D2A,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#EA7D2A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#EA7D2A,bdp_sale_tagbgcolor:#EA7D2A,bdp_sale_tagtextcolor:#fcf2e9,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#EA7D2A,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#fcf2e9,bdp_wishlist_backgroundcolor:#EA7D2A,bdp_wishlist_text_hover_color:#fcf2e9,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#fcf2e9,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#fcf2e9,bdp_addtocart_hover_backgroundcolor:#EA7D2A',
													'display_value' => '#fcf2e9,#EA7D2A,#333333,#666666',
												),
												'cover_salem' => array(
													'preset_name' => esc_html__( 'Salem', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#e8f3ed,template_bgcolor:#f9f9f9,template_ftcolor:#198c4b,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#198c4b,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#198c4b,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#198c4b,bdp_sale_tagbgcolor:#198c4b,bdp_sale_tagtextcolor:#e8f3ed,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#198c4b,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#e8f3ed,bdp_wishlist_backgroundcolor:#198c4b,bdp_wishlist_text_hover_color:#e8f3ed,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#e8f3ed,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#e8f3ed,bdp_addtocart_hover_backgroundcolor:#198c4b',
													'display_value' => '#e8f3ed,#198c4b,#333333,#666666',
												),
												'cover_flame_red' => array(
													'preset_name' => esc_html__( 'Flame Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f3e8e8,template_bgcolor:#f9f9f9,template_ftcolor:#8c1920,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#8c1920,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#8c1920,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#8c1920,bdp_sale_tagbgcolor:#8c1920,bdp_sale_tagtextcolor:#f3e8e8,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#8c1920,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#f3e8e8,bdp_wishlist_backgroundcolor:#8c1920,bdp_wishlist_text_hover_color:#f3e8e8,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#f3e8e8,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#f3e8e8,bdp_addtocart_hover_backgroundcolor:#8c1920',
													'display_value' => '#f3e8e8,#8c1920,#333333,#666666',
												),
												'cover_mulled_wine' => array(
													'preset_name' => esc_html__( 'Mulled Wine', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f3e8e8,template_bgcolor:#f9f9f9,template_ftcolor:#544c6a,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#544c6a,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#544c6a,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#544c6a,bdp_sale_tagbgcolor:#544c6a,bdp_sale_tagtextcolor:#ededf0,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#544c6a,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#544c6a,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#544c6a',
													'display_value' => '#ededf0,#544c6a,#333333,#666666',
												),
											),
											'classical'    => array(
												'classical_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#2a97ea,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2a97ea,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#2a97ea,beforeloop_readmorecolor:#2a97ea,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#2a97ea,bdp_sale_tagbgcolor:#2a97ea,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#2a97ea,bdp_pricetextcolor:#2a97ea,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#2a97ea,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#999999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2a97ea',
													'display_value' => '#2a97ea,#222222,#555555,#999999',
												),
												'classical_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E91AD,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E91AD,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E91AD,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#0E7699,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#0E7699,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#999999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#0E7699',
													'display_value' => '#0E7699,#3E91AD,#555555,#999999',
												),
												'classical_fun_green' => array(
													'preset_name' => esc_html__( 'Fun Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E8563,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E8563,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E8563,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#0E663C,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#0E663C,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#999999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#0E663C',
													'display_value' => '#0E663C,#3E8563,#555555,#999999',
												),
												'classical_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#6D4657,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#6D4657,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#6D4657,bdp_sale_tagbgcolor:#49182D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#49182D,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#49182D,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#999999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#49182D',
													'display_value' => '#49182D,#6D4657,#555555,#999999',
												),
												'classical_earls_green' => array(
													'preset_name' => esc_html__( 'Earls Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#CEBF59,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#CEBF59,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#CEBF59,bdp_sale_tagbgcolor:#C2AF2F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#C2AF2F,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C2AF2F,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#999999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#C2AF2F',
													'display_value' => '#C2AF2F,#CEBF59,#555555,#999999',
												),
												'classical_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#F4ECE2,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F4ECE2,template_contentcolor:#999999,template_readmorecolor:#BE9055,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#BE9055,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#BE9055,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#AE742A,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#AE742A,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#999999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#AE742A',
													'display_value' => '#AE742A,#BE9055,#555555,#999999',
												),
											),
											'clicky'       => array(
												'clicky_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#adadad,template_fthovercolor:#444444,template_titlecolor:#5b7090,template_titlehovercolor:#000000,template_titlebackcolor:#ffffff,template_contentcolor:#444444,template_readmorecolor:#5b7090,template_readmorebackcolor:#ffffff,template_readmore_hover_backcolor:#e7e7e7,beforeloop_readmorecolor:#5b7090,beforeloop_readmorebackcolor:#ffffff,beforeloop_readmorehovercolor:#5b7090,beforeloop_readmorehoverbackcolor:#e7e7e7,bdp_sale_tagbgcolor:#000000,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#5b7090,bdp_pricetextcolor:#000000,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#444444,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#5b7090,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000000',
													'display_value' => '#ffffff,#5b7090,#444444,#000000',
												),
												'clicky_limeade' => array(
													'preset_name' => esc_html__( 'Limeade', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E9F1E2,template_ftcolor:#AECA91,template_fthovercolor:#324E15,template_titlecolor:#629928,template_titlehovercolor:#20320E,template_titlebackcolor:#E9F1E2,template_contentcolor:#324E15,template_readmorecolor:#629928,template_readmorebackcolor:#E9F1E2,template_readmore_hover_backcolor:#AECA91,beforeloop_readmorecolor:#629928,beforeloop_readmorebackcolor:#E9F1E2,beforeloop_readmorehovercolor:#629928,beforeloop_readmorehoverbackcolor:#AECA91,bdp_sale_tagbgcolor:#20320E,bdp_sale_tagtextcolor:#E9F1E2,bdp_star_rating_color:#324E15,bdp_star_rating_bg_color:#629928,bdp_pricetextcolor:#629928,bdp_wishlist_textcolor:#E9F1E2,bdp_wishlist_backgroundcolor:#20320E,bdp_wishlist_text_hover_color:#E9F1E2,bdp_wishlist_hover_backgroundcolor:#629928,bdp_addtocart_textcolor:#E9F1E2,bdp_addtocart_backgroundcolor:#324E15,bdp_addtocart_text_hover_color:#E9F1E2,bdp_addtocart_hover_backgroundcolor:#629928',
													'display_value' => '#E9F1E2,#629928,#324E15,#20320E',
												),
												'clicky_violet' => array(
													'preset_name' => esc_html__( 'Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F1E5FD,template_ftcolor:#CA9CFD,template_fthovercolor:#4E1F81,template_titlecolor:#983DFB,template_titlehovercolor:#321452,template_titlebackcolor:#F1E5FD,template_contentcolor:#4E1F81,template_readmorecolor:#983DFB,template_readmorebackcolor:#F1E5FD,template_readmore_hover_backcolor:#CA9CFD,beforeloop_readmorecolor:#983DFB,beforeloop_readmorebackcolor:#F1E5FD,beforeloop_readmorehovercolor:#983DFB,beforeloop_readmorehoverbackcolor:#CA9CFD,bdp_sale_tagbgcolor:#321452,bdp_sale_tagtextcolor:#F1E5FD,bdp_star_rating_color:#4E1F81,bdp_star_rating_bg_color:#983DFB,bdp_pricetextcolor:#983DFB,bdp_wishlist_textcolor:#F1E5FD,bdp_wishlist_backgroundcolor:#321452,bdp_wishlist_text_hover_color:#F1E5FD,bdp_wishlist_hover_backgroundcolor:#4E1F81,bdp_addtocart_textcolor:#F1E5FD,bdp_addtocart_backgroundcolor:#983DFB,bdp_addtocart_text_hover_color:#F1E5FD,bdp_addtocart_hover_backgroundcolor:#4E1F81',
													'display_value' => '#F1E5FD,#983DFB,#4E1F81,#321452',
												),
												'clicky_punga' => array(
													'preset_name' => esc_html__( 'Punga', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E7E7E4,template_ftcolor:#A6A195,template_fthovercolor:#2A2518,template_titlecolor:#51492F,template_titlehovercolor:#1B180F,template_titlebackcolor:#E7E7E4,template_contentcolor:#2A2518,template_readmorecolor:#51492F,template_readmorebackcolor:#E7E7E4,template_readmore_hover_backcolor:#A6A195,beforeloop_readmorecolor:#51492F,beforeloop_readmorebackcolor:#E7E7E4,beforeloop_readmorehovercolor:#51492F,beforeloop_readmorehoverbackcolor:#A6A195,bdp_sale_tagbgcolor:#1B180F,bdp_sale_tagtextcolor:#E7E7E4,bdp_star_rating_color:#2A2518,bdp_star_rating_bg_color:#51492F,bdp_pricetextcolor:#51492F,bdp_wishlist_textcolor:#E7E7E4,bdp_wishlist_backgroundcolor:#1B180F,bdp_wishlist_text_hover_color:#E7E7E4,bdp_wishlist_hover_backgroundcolor:#2A2518,bdp_addtocart_textcolor:#E7E7E4,bdp_addtocart_backgroundcolor:#51492F,bdp_addtocart_text_hover_color:#E7E7E4,bdp_addtocart_hover_backgroundcolor:#2A2518',
													'display_value' => '#E7E7E4,#51492F,#2A2518,#1B180F',
												),
												'clicky_radical' => array(
													'preset_name' => esc_html__( 'Radical', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FDE7E9,template_ftcolor:#F9A1A9,template_fthovercolor:#7C242C,template_titlecolor:#F34656,template_titlehovercolor:#4F171C,template_titlebackcolor:#FDE7E9,template_contentcolor:#7C242C,template_readmorecolor:#F34656,template_readmorebackcolor:#FDE7E9,template_readmore_hover_backcolor:#F9A1A9,beforeloop_readmorecolor:#F34656,beforeloop_readmorebackcolor:#FDE7E9,beforeloop_readmorehovercolor:#F34656,beforeloop_readmorehoverbackcolor:#F9A1A9,bdp_sale_tagbgcolor:#4F171C,bdp_sale_tagtextcolor:#FDE7E9,bdp_star_rating_color:#7C242C,bdp_star_rating_bg_color:#F34656,bdp_pricetextcolor:#FDE7E9,bdp_wishlist_textcolor:#FDE7E9,bdp_wishlist_backgroundcolor:#4F171C,bdp_wishlist_text_hover_color:#FDE7E9,bdp_wishlist_hover_backgroundcolor:#7C242C,bdp_addtocart_textcolor:#FDE7E9,bdp_addtocart_backgroundcolor:#F34656,bdp_addtocart_text_hover_color:#FDE7E9,bdp_addtocart_hover_backgroundcolor:#7C242C',
													'display_value' => '#FDE7E9,#F34656,#7C242C,#4F171C',
												),
												'clicky_goldenrod' => array(
													'preset_name' => esc_html__( 'Goldenrod', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F4EDDD,template_ftcolor:#D7BD81,template_fthovercolor:#5B4204,template_titlecolor:#B28007,template_titlehovercolor:#3A2A02,template_titlebackcolor:#F4EDDD,template_contentcolor:#5B4204,template_readmorecolor:#B28007,template_readmorebackcolor:#F4EDDD,template_readmore_hover_backcolor:#D7BD81,beforeloop_readmorecolor:#B28007,beforeloop_readmorebackcolor:#F4EDDD,beforeloop_readmorehovercolor:#B28007,beforeloop_readmorehoverbackcolor:#D7BD81,bdp_sale_tagbgcolor:#3A2A02,bdp_sale_tagtextcolor:#F4EDDD,bdp_star_rating_color:#5B4204,bdp_star_rating_bg_color:#B28007,bdp_pricetextcolor:#F4EDDD,bdp_wishlist_textcolor:#F4EDDD,bdp_wishlist_backgroundcolor:#3A2A02,bdp_wishlist_text_hover_color:#F4EDDD, bdp_wishlist_hover_backgroundcolor:#5B4204,bdp_addtocart_textcolor:#F4EDDD,bdp_addtocart_backgroundcolor:#B28007,bdp_addtocart_text_hover_color:#F4EDDD,bdp_addtocart_hover_backgroundcolor:#5B4204',
													'display_value' => '#F4EDDD,#B28007,#5B4204,#3A2A02',
												),
											),
											'cool_horizontal' => array(
												'cool_horizontal_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#F16C20,template_titlecolor:#F16C20,template_titlehovercolor:#333333,template_readmorecolor:#F16C20,template_readmorebackcolor:#ffffff,template_contentcolor:#999999,beforeloop_readmorecolor:#F16C20,beforeloop_readmorebackcolor:#555555,beforeloop_readmorehovercolor:#F16C20,beforeloop_readmorehoverbackcolor:#555555,bdp_sale_tagbgcolor:#F16C20,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#F16C20,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#F16C20,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#555555,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#F16C20',
													'display_value' => '#F16C20,#333333,#555555,#999999',
												),
												'cool_horizontal_crimson' => array(
													'preset_name' => esc_html__( 'Crimson', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#e21130,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999,bdp_sale_tagbgcolor:#e21130,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#e21130,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#e21130,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#666666,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#e21130',
													'display_value' => '#e21130,#333333,#666666,#444444',
												),
												'cool_horizontal_blue' => array(
													'preset_name' => esc_html__( 'Chetwode Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#6C71C3,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999,bdp_sale_tagbgcolor:#6C71C3,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#6C71C3,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#6C71C3,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#666666,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#6C71C3',
													'display_value' => '#6C71C3,#333333,#666666,#444444',
												),
												'cool_horizontal_java' => array(
													'preset_name' => esc_html__( 'Java', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#29A198,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999,bdp_sale_tagbgcolor:#29A198,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#29A198,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#29A198,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#666666,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#29A198',
													'display_value' => '#29A198,#333333,#666666,#444444',
												),
												'cool_horizontal_curious_blue' => array(
													'preset_name' => esc_html__( 'Curious Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#268BD3,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999,bdp_sale_tagbgcolor:#268BD3,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#268BD3,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#268BD3,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#666666,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#268BD3',
													'display_value' => '#268BD3,#333333,#666666,#444444',
												),
												'cool_horizontal_olive' => array(
													'preset_name' => esc_html__( 'Olive', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#869901,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999,bdp_sale_tagbgcolor:#869901,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#869901,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#869901,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#666666,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#869901',
													'display_value' => '#869901,#333333,#666666,#444444',
												),
											),
											'crayon_slider' => array(
												'crayon_slider_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#F5C034,template_fthovercolor:#ffffff,winter_category_color:#F5C034,template_titlecolor:#ffffff,template_titlehovercolor:#F5C034,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#F5C034,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#F5C034,beforeloop_readmorehovercolor:#F5C034,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#F5C034,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#F5C034,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#F5C034,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#F5C034',
													'display_value' => '#000000,#ffffff,#F5C034,#ffffff',
												),
												'crayon_slider_cerise' => array(
													'preset_name' => esc_html__( 'Cerise', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ff00ae,winter_category_color:#ff00ae,template_titlecolor:#ffffff,template_titlehovercolor:#ff00ae,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#ff00ae,template_readmorebackcolor:#00809D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ff00ae,beforeloop_readmorehovercolor:#ff00ae,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ff00ae,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ff00ae,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#ff00ae,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#ff00ae',
													'display_value' => '#000000,#ffffff,#ff00ae,#ffffff',
												),
												'crayon_slider_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#FA336C,winter_category_color:#FA336C,template_titlecolor:#ffffff,template_titlehovercolor:#FA336C,,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#FA336C,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FA336C,beforeloop_readmorehovercolor:#FA336C,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#FA336C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#FA336C,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#FA336C,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#FA336C',
													'display_value' => '#000000,#ffffff,#FA336C,#ffffff',
												),
												'crayon_slider_eminence' => array(
													'preset_name' => esc_html__( 'Eminence', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#683C6F,winter_category_color:#683C6F,template_titlecolor:#ffffff,template_titlehovercolor:#683C6F,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#683C6F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#683C6F,beforeloop_readmorehovercolor:#683C6F,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#683C6F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#683C6F,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#683C6F,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#683C6F',
													'display_value' => '#000000,#ffffff,#683C6F,#ffffff',
												),
												'crayon_slider_persian_red' => array(
													'preset_name' => esc_html__( 'Persian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#DC3330,winter_category_color:#DC3330,template_titlecolor:#ffffff,template_titlehovercolor:#DC3330,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#DC3330,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#DC3330,beforeloop_readmorehovercolor:#DC3330,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DC3330,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#DC3330,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#DC3330,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#DC3330',
													'display_value' => '#000000,#ffffff,#DC3330,#ffffff',
												),
												'crayon_slider_fun-green' => array(
													'preset_name' => esc_html__( 'Fun Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#0E663C,winter_category_color:#0E663C,template_titlecolor:#ffffff,template_titlehovercolor:#0E663C,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#0E663C,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0E663C,beforeloop_readmorehovercolor:#0E663C,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#0E663C,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#0E663C,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#0E663C',
													'display_value' => '#000000,#ffffff,#0E663C,#ffffff',
												),
											),
											'deport'       => array(
												'deport_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#92A660,template_fthovercolor:#555555,deport_dashcolor:#92A660,template_titlecolor:#222222,template_titlehovercolor:#92A660,template_readmorecolor:#ffffff,template_readmorebackcolor:#92A660,template_contentcolor:#777777,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#92A660,beforeloop_readmorehovercolor:#92A660,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#92A660,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#777777,bdp_star_rating_bg_color:#92A660,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#777777,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#92A660,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#92A660,#222222,#555555,#777777',
												),
												'deport_catalina_blue' => array(
													'preset_name' => esc_html__( 'Catalina Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#495F85,deport_dashcolor:#495F85,template_titlecolor:#1B3766,template_titlehovercolor:#495F85,template_readmorecolor:#ffffff,template_readmorebackcolor:#495F85,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#495F85,beforeloop_readmorehovercolor:#495F85,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#1B3766,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#1B3766,bdp_pricetextcolor:#1B3766,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#1B3766,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#495F85',
													'display_value' => '#1B3766,#495F85,#555555,#999999',
												),
												'deport_fun-green' => array(
													'preset_name' => esc_html__( 'Fun Green', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#3E8563,template_fthovercolor:#999999,deport_dashcolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#0E663C,bdp_pricetextcolor:#0E663C,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E663C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#3E8563',
													'display_value' => '#0E663C,#3E8563,#555555,#999999',
												),
												'deport_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#ED4961,deport_dashcolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E81B3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#E81B3A,bdp_pricetextcolor:#E81B3A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E81B3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#ED4961',
													'display_value' => '#E81B3A,#ED4961,#555555,#999999',
												),
												'deport_mckenzie' => array(
													'preset_name' => esc_html__( 'McKenzie', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#A2855B,deport_dashcolor:#A2855B,template_titlecolor:#8B6632,template_titlehovercolor:#A2855B,template_readmorecolor:#ffffff,template_readmorebackcolor:#A2855B,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A2855B,beforeloop_readmorehovercolor:#A2855B,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8B6632,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#8B6632,bdp_pricetextcolor:#8B6632,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8B6632,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#A2855B',
													'display_value' => '#8B6632,#A2855B,#555555,#999999',
												),
												'deport_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#6D4657,deport_dashcolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D4657,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#49182D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#49182D,bdp_pricetextcolor:#49182D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#49182D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#6D4657',
													'display_value' => '#49182D,#6D4657,#555555,#999999',
												),
											),
											'easy_timeline' => array(
												'easy_timeline_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#C58A3C,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#C58A3C,template_readmorecolor:#C58A3C,template_readmorebackcolor:#ffffff,template_contentcolor:#555555,bdp_sale_tagbgcolor:#C58A3C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#222222,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#222222,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#C58A3C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#ffffff,#C58A3C,#222222,#555555',
												),
												'easy_timeline_crimson' => array(
													'preset_name' => esc_html__( 'Crimson', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#E21130,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#E21130,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#E21130,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#E21130,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#E21130,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#E21130,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#E21130,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#E21130,#ffffff,#f1f1f1,#E21130',
												),
												'easy_timeline_flamenco' => array(
													'preset_name' => esc_html__( 'Flamenco', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#E18942,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#E18942,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#E18942,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#E18942,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#E18942,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#E18942,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#E18942,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#E18942,#ffffff,#f1f1f1,#E18942',
												),
												'easy_timeline_jagger' => array(
													'preset_name' => esc_html__( 'Jagger', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#3D3242,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#3D3242,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#3D3242,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#3D3242,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#3D3242,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#3D3242,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#3D3242,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#3D3242,#ffffff,#f1f1f1,#3D3242',
												),
												'easy_timeline_camelot' => array(
													'preset_name' => esc_html__( 'Camelot', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#7A3E48,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#7A3E48,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#7A3E48,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#7A3E48,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#7A3E48,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#7A3E48,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#7A3E48,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#7A3E48,#ffffff,#f1f1f1,#7A3E48',
												),
												'easy_timeline_sundance' => array(
													'preset_name' => esc_html__( 'Sundance', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#C59F4A,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#C59F4A,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#C59F4A,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#C59F4A,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#C59F4A,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#C59F4A,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#C59F4A,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#C59F4A,#ffffff,#f1f1f1,#C59F4A',
												),
											),
											'elina'        => array(
												'elina_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#3E91AD,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#3E91AD,template_readmorecolor:#3E91AD,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#3E91AD,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#3E91AD,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#3E91AD,#222222,#555555,#666666',
												),
												'elina_crimson' => array(
													'preset_name' => esc_html__( 'Crimson', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FDEEF1,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,template_titlehovercolor:#E84159,template_readmorecolor:#E84159,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E84159,beforeloop_readmorehovercolor:#E84159,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E21130,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#E21130,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#E21130,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E84159,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#E21130,#E84159,#555555,#666666',
												),
												'elina_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_readmorecolor:#67704E,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#414C22,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#414C22,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#67704E,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#414C22,#67704E,#555555,#666666',
												),
												'elina_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F9F5F1,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_readmorecolor:#BE9055,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#AE742A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#AE742A,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#BE9055,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#AE742A,#BE9055,#555555,#666666',
												),
												'elina_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F3F0F1,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_readmorecolor:#6D4657,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#49182D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#49182D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#49182D,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6D4657,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#49182D,#6D4657,#555555,#666666',
												),
												'elina_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#1B3766,template_titlehovercolor:#A381BB,template_readmorecolor:#A381BB,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#1B3766,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#1B3766,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#1B3766,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#A381BB,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#1B3766,#A381BB,#555555,#666666',
												),
											),
											'evolution'    => array(
												'evolution_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_alterbgcolor:#ffffff,template_ftcolor:#2E6480,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2E6480,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#2E6480,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#2E6480,beforeloop_readmorehovercolor:#2E6480,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#2E6480,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2E6480,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#2E6480,#222222,#555555,#333333',
												),
												'evolution_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EDE1E7,template_alterbgcolor:#E1EDE7,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#7D194F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#7D194F,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#974772,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#7D194F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#7D194F,#974772,#555555,#333333',
												),
												'evolution_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E5E7E1,template_alterbgcolor:#E3E1E7,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#414C22,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#67704E,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#414C22,#67704E,#555555,#333333',
												),
												'evolution_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCE1E4,template_alterbgcolor:#E1FCF8,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,template_titlehovercolor:#EE4861,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#EE4861,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EE4861,beforeloop_readmorehovercolor:#EE4861,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#EA1A3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#EA1A3A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#EE4861,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#EA1A3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#EA1A3A,#EE4861,#555555,#333333',
												),
												'evolution_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0E2,template_alterbgcolor:#E2EDFA,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#DF8D27,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#E5A452,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#DF8D27,#E5A452,#555555,#333333',
												),
												'evolution_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F0E9F4,template_alterbgcolor:#EDF4E9,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C62AA,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8C62AA,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#A381BB,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C62AA,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#8C62AA,#A381BB,#555555,#333333',
												),
											),
											'explore'      => array(
												'explore_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#000000,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#e0e0e0,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#000000,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#000000,bdp_pricetextcolor:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000000,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000000',
													'display_value' => '#000000,#e0e0e0,#ffffff,#e0e0e0',
												),
												'explore_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#465BAC,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#465BAC,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#465BAC,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#465BAC,bdp_pricetextcolor:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#465BAC,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#465BAC',
													'display_value' => '#465BAC,#e0e0e0,#ffffff,#e0e0e0',
												),
												'explore_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#FA336C,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#FA336C,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#FA336C,bdp_sale_tagbgcolor:#FA336C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#FA336C,bdp_pricetextcolor:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#FA336C,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#FA336C,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FA336C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#FA336C',
													'display_value' => '#FA336C,#e0e0e0,#ffffff,#e0e0e0',
												),
												'explore_finch' => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#75815B,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#75815B,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#75815B,bdp_sale_tagbgcolor:#75815B,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#75815B,bdp_pricetextcolor:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#75815B,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#75815B,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75815B,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#75815B',
													'display_value' => '#75815B,#e0e0e0,#ffffff,#e0e0e0',
												),
												'explore_vivid_gamboge' => array(
													'preset_name' => esc_html__( 'Vivid Gamboge', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#f99900,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#f99900,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f999000,bdp_sale_tagbgcolor:#f99900,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#f99900,bdp_pricetextcolor:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#f99900,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#f99900,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#f99900,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#f99900',
													'display_value' => '#f99900,#e0e0e0,#ffffff,#e0e0e0',
												),
												'explore_moderate-orange' => array(
													'preset_name' => esc_html__( 'Moderate Orange', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#8B6632,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#8B6632,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#8B6632,bdp_sale_tagbgcolor:#8B6632,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#8B6632,bdp_pricetextcolor:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#8B6632,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#8B6632,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8B6632,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#8B6632',
													'display_value' => '#8B6632,#e0e0e0,#ffffff,#e0e0e0',
												),
											),
											'famous'       => array(
												'famous_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#f42887,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#f42887,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#f42887,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f42887,bdp_sale_tagbgcolor:#333333,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#777777,bdp_pricetextcolor:#777777,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#777777,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#f42887,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#ffffff,#f42887,#333333,#777777',
												),
												'famous_vivid_gamboge' => array(
													'preset_name' => esc_html__( 'Vivid Gamboge', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#fef4e5,template_ftcolor:#f99900,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#f99900,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#f99900,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f99900,bdp_sale_tagbgcolor:#333333,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#777777,bdp_pricetextcolor:#777777,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#777777,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#f99900,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#fef4e5,#f99900,#333333,#777777',
												),
												'famous_jagger' => array(
													'preset_name' => esc_html__( 'Jagger', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ebeaec,template_ftcolor:#3d3242,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3d3242,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3d3242,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#3d3242,bdp_sale_tagbgcolor:#333333,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#777777,bdp_pricetextcolor:#777777,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#777777,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#3d3242,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#ebeaec,#3d3242,#333333,#777777',
												),
												'famous_timber_green' => array(
													'preset_name' => esc_html__( 'Timber Green', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ebeaec,template_ftcolor:#374232,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#374232,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#374232,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#374232,bdp_sale_tagbgcolor:#333333,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#777777,bdp_pricetextcolor:#777777,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#777777,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#374232,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#ebecea,#374232,#333333,#777777',
												),
												'famous_barossa' => array(
													'preset_name' => esc_html__( 'Barossa', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ebeaec,template_ftcolor:#423237,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#423237,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#423237,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#423237,bdp_sale_tagbgcolor:#333333,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#777777,bdp_pricetextcolor:#777777,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#777777,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#423237,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#eceaeb,#423237,#333333,#777777',
												),
												'famous_blumine' => array(
													'preset_name' => esc_html__( 'Blumine', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#e9eeef,template_ftcolor:#2a5b66,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#2a5b66,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#2a5b66,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#2a5b66,bdp_sale_tagbgcolor:#333333,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#777777,bdp_pricetextcolor:#777777,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#777777,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2a5b66,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#e9eeef,#2a5b66,#333333,#777777',
												),
											),
											'fairy'        => array(
												'fairy_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f7f7f7,template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#888888,template_titlecolor:#ffffff,template_titlehovercolor:#e5d3d3,template_titlebackcolor:,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#333333,template_readmore_hover_backcolor:#888888,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#333333,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#888888,bdp_sale_tagbgcolor:#000000,bdp_sale_tagtextcolor:#f7f7f7,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#888888,bdp_pricetextcolor:#888888,bdp_wishlist_textcolor:#f7f7f7,bdp_wishlist_backgroundcolor:#888888,bdp_wishlist_text_hover_color:#f7f7f7,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#f7f7f7,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#f7f7f7,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#f7f7f7,#888888,#333333,#000000',
												),
												'fairy_tangerine' => array(
													'preset_name' => esc_html__( 'Tangerine', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f8df9f,template_bgcolor:#fdf7e7,template_ftcolor:#171101,template_fthovercolor:#473505,template_titlecolor:#fdf7e7,template_titlehovercolor:#f8df9f,template_titlebackcolor:,template_contentcolor:#171101,template_readmorecolor:#fdf7e7,template_readmorebackcolor:#171101,template_readmore_hover_backcolor:#efb828,beforeloop_readmorecolor:#fdf7e7,beforeloop_readmorebackcolor:#171101,beforeloop_readmorehovercolor:#fdf7e7,beforeloop_readmorehoverbackcolor:#efb828,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#473505,bdp_pricetextcolor:#171101,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#888888,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#473505,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#473505',
													'display_value' => '#f8df9f,#efb828,#473505,#171101',
												),
												'fairy_prussian' => array(
													'preset_name' => esc_html__( 'Prussian', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#99a8ba,template_bgcolor:#e5e9ed,template_ftcolor:#000308,template_fthovercolor:#000b19,template_titlecolor:#e5e9ed,template_titlehovercolor:#99a8ba,template_titlebackcolor:,template_contentcolor:#000308,template_readmorecolor:#e5e9ed,template_readmorebackcolor:#000308,template_readmore_hover_backcolor:#193b65,beforeloop_readmorecolor:#e5e9ed,beforeloop_readmorebackcolor:#000308,beforeloop_readmorehovercolor:#e5e9ed,beforeloop_readmorehoverbackcolor:#193b65,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#193b65,bdp_pricetextcolor:#000308,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000b19,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#193b65,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000308',
													'display_value' => '#99a8ba,#193b65,#000b19,#000308',
												),
											),
											'glamour'      => array(
												'glamour_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#f5c034,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#f5c034,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#f5c034,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#f5c034,bdp_sale_tagtextcolor:#2d2d2d,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2d2d2d,bdp_wishlist_backgroundcolor:#f5c034,bdp_wishlist_text_hover_color:#2d2d2d,bdp_wishlist_hover_backgroundcolor:#f5c034,bdp_addtocart_textcolor:#2d2d2d,bdp_addtocart_backgroundcolor:#f5c034,bdp_addtocart_text_hover_color:#2d2d2d,bdp_addtocart_hover_backgroundcolor:#f5c034',
													'display_value' => '#f5c034,#333333,#2d2d2d,#000000',
												),
												'glamour_aqua' => array(
													'preset_name' => esc_html__( 'Aqua', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#00FFE9,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#00FFE9,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#00FFE9,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#00FFE9,bdp_sale_tagtextcolor:#2d2d2d,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2d2d2d,bdp_wishlist_backgroundcolor:#00FFE9,bdp_wishlist_text_hover_color:#2d2d2d,bdp_wishlist_hover_backgroundcolor:#00FFE9,bdp_addtocart_textcolor:#2d2d2d,bdp_addtocart_backgroundcolor:#00FFE9,bdp_addtocart_text_hover_color:#2d2d2d,bdp_addtocart_hover_backgroundcolor:#00FFE9',
													'display_value' => '#00FFE9,#333333,#2d2d2d,#000000',
												),
												'glamour_harlequin' => array(
													'preset_name' => esc_html__( 'Harlequin', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#43FF00,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#43FF00,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#43FF00,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#43FF00,bdp_sale_tagtextcolor:#2d2d2d,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2d2d2d,bdp_wishlist_backgroundcolor:#43FF00,bdp_wishlist_text_hover_color:#2d2d2d,bdp_wishlist_hover_backgroundcolor:#43FF00,bdp_addtocart_textcolor:#2d2d2d,bdp_addtocart_backgroundcolor:#43FF00,bdp_addtocart_text_hover_color:#2d2d2d,bdp_addtocart_hover_backgroundcolor:#43FF00',
													'display_value' => '#43FF00,#333333,#2d2d2d,#000000',
												),
												'glamour_red' => array(
													'preset_name' => esc_html__( 'Red', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#FF0000,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#FF0000,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#FF0000,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#FF0000,bdp_sale_tagtextcolor:#2d2d2d,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#FF0000,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#FF0000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FF0000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#FF0000',
													'display_value' => '#FF0000,#333333,#2d2d2d,#000000',
												),
												'glamour_spring_green' => array(
													'preset_name' => esc_html__( 'Spring Green', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#00FF80,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#00FF80,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#00FF80,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#00FF80,bdp_sale_tagtextcolor:#2d2d2d,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2d2d2d,bdp_wishlist_backgroundcolor:#00FF80,bdp_wishlist_text_hover_color:#2d2d2d,bdp_wishlist_hover_backgroundcolor:#00FF80,bdp_addtocart_textcolor:#2d2d2d,bdp_addtocart_backgroundcolor:#00FF80,bdp_addtocart_text_hover_color:#2d2d2d,bdp_addtocart_hover_backgroundcolor:#00FF80',
													'display_value' => '#00FF80,#333333,#2d2d2d,#000000',
												),
												'glamour_pale_turquoise' => array(
													'preset_name' => esc_html__( 'Pale Turquoise', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#ACFEFF,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ACFEFF,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#ACFEFF,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#ACFEFF,bdp_sale_tagtextcolor:#2d2d2d,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2d2d2d,bdp_wishlist_backgroundcolor:#ACFEFF,bdp_wishlist_text_hover_color:#2d2d2d,bdp_wishlist_hover_backgroundcolor:#ACFEFF,bdp_addtocart_textcolor:#2d2d2d,bdp_addtocart_backgroundcolor:#ACFEFF,bdp_addtocart_text_hover_color:#2d2d2d,bdp_addtocart_hover_backgroundcolor:#ACFEFF',
													'display_value' => '#ACFEFF,#333333,#2d2d2d,#000000',
												),
											),
											'glossary'     => array(
												'glossary_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#E84159,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#E84159,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#E84159,template_readmorecolor:#ffffff,template_readmorebackcolor:#E84159,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E84159,beforeloop_readmorehovercolor:#E84159,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E84159,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E84159,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#E84159,#222222,#555555,#999999',
												),
												'glossary_madras' => array(
													'preset_name' => esc_html__( 'Madras', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D6145,template_titlecolor:#493917,template_titlehovercolor:#6D6145,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#6D6145,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D6145,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D6145,beforeloop_readmorehovercolor:#6D6145,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#493917,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#6D6145,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#6D6145,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#493917,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#493917,#6D6145,#555555,#999999',
												),
												'glossary_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#974772,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#7D194F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#974772,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#974772,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#7D194F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#7D194F,#974772,#555555,#999999',
												),
												'glossary_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#6D6145,template_titlebackcolor:#E5E7E1,template_contentcolor:#999999,template_content_hovercolor:#67704E,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#414C22,#67704E,#555555,#999999',
												),
												'glossary_peru_tan' => array(
													'preset_name' => esc_html__( 'Peru Tan', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EDE5E1,template_ftcolor:#555555,template_fthovercolor:#916748,template_titlecolor:#75411A,template_titlehovercolor:#916748,template_titlebackcolor:#EDE5E1,template_contentcolor:#999999,template_content_hovercolor:#916748,template_readmorecolor:#ffffff,template_readmorebackcolor:#916748,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#916748,beforeloop_readmorehovercolor:#916748,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#75411A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#916748,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#916748,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75411A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#75411A,#916748,#555555,#999999',
												),
												'glossary_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#999999,template_content_hovercolor:#E5A452,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#E5A452,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E5A452,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#DF8D27,#E5A452,#555555,#999999',
												),
											),
											'hoverbic'     => array(
												'hoverbic_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#000000,template_ftcolor:#ff9600,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ff9600,beforeloop_readmorecolor:#e0e0e0,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#000000,bdp_sale_tagbgcolor:#000000,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e0e0e0,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000000,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#000000,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#000000,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000000',
													'display_value' => '#000000,#ff9600,#ffffff,#e0e0e0',
												),
												'hoverbic_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#465BAC,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#465BAC,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#465BAC,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e0e0e0,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#465BAC,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#465BAC',
													'display_value' => '#465BAC,#e0e0e0,#ffffff,#e0e0e0',
												),
												'hoverbic_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#FA336C,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#FA336C,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#FA336C,bdp_sale_tagbgcolor:#FA336C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e0e0e0,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#FA336C,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#FA336C,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FA336C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#FA336C',
													'display_value' => '#FA336C,#e0e0e0,#ffffff,#e0e0e0',
												),
												'hoverbic_finch' => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#75815B,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#75815B,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#75815B,bdp_sale_tagbgcolor:#75815B,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e0e0e0,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#75815B,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#75815B,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75815B,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#75815B',
													'display_value' => '#75815B,#e0e0e0,#ffffff,#e0e0e0',
												),
												'hoverbic_vivid_gamboge' => array(
													'preset_name' => esc_html__( 'Vivid Gamboge', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#f99900,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#f99900,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f999000,bdp_sale_tagbgcolor:#f99900,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e0e0e0,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#f99900,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#f99900,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#f99900,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#f99900',
													'display_value' => '#f99900,#e0e0e0,#ffffff,#e0e0e0',
												),
												'hoverbic_moderate-orange' => array(
													'preset_name' => esc_html__( 'Moderate Orange', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#8B6632,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#8B6632,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#8B6632,bdp_sale_tagbgcolor:#8B6632,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#e0e0e0,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#8B6632,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#8B6632,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8B6632,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#8B6632',
													'display_value' => '#8B6632,#e0e0e0,#ffffff,#e0e0e0',
												),
											),
											'hub'          => array(
												'hub_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#495F85,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#495F85,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#495F85,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#495F85,beforeloop_readmorehovercolor:#495F85,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#495F85,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#495F85,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#495F85,#222222,#555555,#333333',
												),
												'hub_torea_bay' => array(
													'preset_name' => esc_html__( 'Torea Bay', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#3E91AD,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#999999,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#3E91AD',
													'display_value' => '#0E7699,#3E91AD,#555555,#999999',
												),
												'hub_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,template_titlehovercolor:#EE4861,template_titlebackcolor:#FCE1E4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#EE4861,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EE4861,beforeloop_readmorehovercolor:#EE4861,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#EA1A3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#EE4861,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#EA1A3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#EE4861',
													'display_value' => '#EA1A3A,#EE4861,#555555,#333333',
												),
												'hub_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#E5A452,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#E5A452',
													'display_value' => '#DF8D27,#E5A452,#555555,#333333',
												),
												'hub_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#F0E9F4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C62AA,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#A381BB,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C62AA,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#A381BB',
													'display_value' => '#8C62AA,#A381BB,#555555,#333333',
												),
												'hub_wild_yonder' => array(
													'preset_name' => esc_html__( 'Wild Yonder', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ECF0F7,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#ECF0F7,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6E8CC2,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8BA3CE,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#8BA3CE',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#333333',
												),
											),
											'invert-grid'  => array(
												'invert-grid_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#CC0001,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#CC0001,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#CC0001,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#4c3e37,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#CC0001,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#4c3e37,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2b2b2b,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#CC0001',
													'display_value' => '#CC0001,#2b2b2b,#CC0001,#4c3e37',
												),
												'invert-grid_tawny' => array(
													'preset_name' => esc_html__( 'Tawny', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#d35400,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#d35400,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#d35400,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#d35400,beforeloop_readmorehovercolor:#d35400,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#d35400,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#4c3e37,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#d35400,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#4c3e37,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2b2b2b,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#d35400',
													'display_value' => '#d35400,#2b2b2b,#d35400,#4c3e37',
												),
												'invert-grid_pacific_blue' => array(
													'preset_name' => esc_html__( 'Pacific Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#0099CB,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#0099CB,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0099CB,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#4c3e37,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#0099CB,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#4c3e37,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2b2b2b,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#0099CB',
													'display_value' => '#0099CB,#2b2b2b,#0099CB,#4c3e37',
												),
												'invert-grid_pacific_dark_orchid' => array(
													'preset_name' => esc_html__( 'Dark Orchid', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#9A33CC,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#9A33CC,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#9A33CC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#4c3e37,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#9A33CC,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#4c3e37,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2b2b2b,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#9A33CC',
													'display_value' => '#9A33CC,#2b2b2b,#9A33CC,#4c3e37',
												),
												'invert-grid_pacific_dark_orange' => array(
													'preset_name' => esc_html__( 'Dark Orange', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#FF8A00,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#FF8A00,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#4c3e37,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#FF8A00,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#4c3e37,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2b2b2b,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#FF8A00',
													'display_value' => '#FF8A00,#2b2b2b,#FF8A00,#4c3e37',
												),
												'invert-grid_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#414C22,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#414C22,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#414C22,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#414C22,beforeloop_readmorehovercolor:#414C22,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#4c3e37,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#414C22,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#4c3e37,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2b2b2b,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#414C22',
													'display_value' => '#414C22,#2b2b2b,#414C22,#4c3e37',
												),
											),
											'lightbreeze'  => array(
												'lightbreeze_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#1eafa6,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#1eafa6,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#1eafa6,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#1eafa6,beforeloop_readmorehovercolor:#1eafa6,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#1eafa6,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#1eafa6,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#1eafa6,#222222,#555555,#999999',
												),
												'lightbreeze_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#414C22,#67704E,#555555,#999999',
												),
												'lightbreeze_red_violet' => array(
													'preset_name' => esc_html__( 'Red Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#B51F76,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#B51F76,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C44C91,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B51F76,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#B51F76,#C44C91,#555555,#999999',
												),
											),
											'masonry_timeline' => array(
												'masonry_timeline_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#A39D5A,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#A39D5A,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#A39D5A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#A39D5A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#A39D5A,#222222,#555555,#666666',
												),
												'masonry_timeline_crimson' => array(
													'preset_name' => esc_html__( 'Crimson', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,template_titlehovercolor:#E84159,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#E21130,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E21130,beforeloop_readmorehovercolor:#E21130,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E21130,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#E84159,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E84159,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E21130,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#E21130,#E84159,#555555,#666666',
												),
												'masonry_timeline_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#414C22,#67704E,#555555,#666666',
												),
												'masonry_timeline_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#EEF6F8,template_titlecolor:#0E7699,template_titlehovercolor:#EEF6F8,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#EEF6F8,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EEF6F8,beforeloop_readmorehovercolor:#EEF6F8,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E7699,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#0E7699,#3E91AD,#555555,#666666',
												),
												'masonry_timeline_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FDF7F1,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#DF8D27,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E5A452,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#DF8D27,#E5A452,#555555,#666666',
												),
												'masonry_timeline_red_violet' => array(
													'preset_name' => esc_html__( 'Red Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0F6,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#B51F76,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#B51F76,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C44C91,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B51F76,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#B51F76,#C44C91,#555555,#666666',
												),
											),
											'media-grid'   => array(
												'media-grid_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#A49538,template_fthovercolor:#2b2b2b,template_titlecolor:#000000,template_titlehovercolor:#A49538,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#A49538,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A49538,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#A49538,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#000000,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#000000,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#A49538,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#A49538,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000000',
													'display_value' => '#A49538,#ffffff,#000000,#7b6b79',
												),
												'media-grid_salt-box' => array(
													'preset_name' => esc_html__( 'Salt Box', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#60505e,template_fthovercolor:#333333,template_titlecolor:#60505e,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#60505e,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#60505e,beforeloop_readmorehovercolor:#60505e,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#60505e,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#60505e,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#60505e,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#60505e,#ffffff,#2b2b2b,#7b6b79',
												),
												'media-grid_pacific_blue' => array(
													'preset_name' => esc_html__( 'Pacific Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#0099CB,template_fthovercolor:#2b2b2b,template_titlecolor:#0099CB,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0099CB,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#0099CB,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0099CB,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#0099CB,#ffffff,#2b2b2b,#7b6b79',
												),
												'media-grid_pacific_dark_orchid' => array(
													'preset_name' => esc_html__( 'Dark Orchid', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#9A33CC,template_fthovercolor:#2b2b2b,template_titlecolor:#9A33CC,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#9A33CC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#9A33CC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#9A33CC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#9A33CC,#ffffff,#2b2b2b,#7b6b79',
												),
												'media-grid_pacific_dark_orange' => array(
													'preset_name' => esc_html__( 'Dark Orange', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#FF8A00,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#FF8A00,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#FF8A00,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FF8A00,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#FF8A00,#ffffff,#2b2b2b,#7b6b79',
												),
												'media-grid_pacific_venetian_red' => array(
													'preset_name' => esc_html__( 'Venetian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#CC0001,template_fthovercolor:#2b2b2b,template_titlecolor:#CC0001,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#CC0001,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#CC0001,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#CC0001,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#CC0001,#ffffff,#2b2b2b,#7b6b79',
												),
											),
											'minimal'      => array(
												'minimal_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#444444,template_fthovercolor:#2b2b2b,template_titlecolor:#444444,template_titlehovercolor:#e84c89,template_contentcolor:#ffffff,template_contentcolor:#444444,template_readmorecolor:#ffffff,template_readmorebackcolor:#e84c89,template_readmore_hover_backcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#e84c89,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#444444,bdp_sale_tagbgcolor:#e84c89,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#2b2b2b,bdp_pricetextcolor:#444444,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#444444,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#e84c89,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#e84c89,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#ffffff,#e84c89,#2b2b2b,#444444',
												),
												'minimal_cyan' => array(
													'preset_name' => esc_html__( 'Cyan', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#DDEEF1,template_ftcolor:#00363B,template_fthovercolor:#002226,template_titlecolor:#00363B,template_titlehovercolor:#008491,template_contentcolor:#DDEEF1,template_contentcolor:#00363B,template_readmorecolor:#DDEEF1,template_readmorebackcolor:#008491,template_readmore_hover_backcolor:#00363B,beforeloop_readmorecolor:#DDEEF1,beforeloop_readmorebackcolor:#008491,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#00363B,bdp_sale_tagbgcolor:#008491,bdp_sale_tagtextcolor:#DDEEF1,bdp_star_rating_color:#00363B,bdp_star_rating_bg_color:#002226,bdp_pricetextcolor:#00363B,bdp_wishlist_textcolor:#DDEEF1,bdp_wishlist_backgroundcolor:#00363B,bdp_wishlist_text_hover_color:#DDEEF1,bdp_wishlist_hover_backgroundcolor:#008491,bdp_addtocart_textcolor:#DDEEF1,bdp_addtocart_backgroundcolor:#008491,bdp_addtocart_text_hover_color:#DDEEF1,bdp_addtocart_hover_backgroundcolor:#002226',
													'display_value' => '#DDEEF1,#008491,#002226,#00363B',
												),
												'minimal_purple_heart' => array(
													'preset_name' => esc_html__( 'Purple Heart', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E9E4F6,template_ftcolor:#26164E,template_fthovercolor:#180E32,template_titlecolor:#26164E,template_titlehovercolor:#5C37BF,template_contentcolor:#E9E4F6,template_contentcolor:#26164E,template_readmorecolor:#E9E4F6,template_readmorebackcolor:#5C37BF,template_readmore_hover_backcolor:#26164E,beforeloop_readmorecolor:#E9E4F6,beforeloop_readmorebackcolor:#5C37BF,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#26164E,bdp_sale_tagbgcolor:#5C37BF,bdp_sale_tagtextcolor:#E9E4F6,bdp_star_rating_color:#26164E,bdp_star_rating_bg_color:#180E32,bdp_pricetextcolor:#26164E,bdp_wishlist_textcolor:#E9E4F6,bdp_wishlist_backgroundcolor:#26164E,bdp_wishlist_text_hover_color:#E9E4F6,bdp_wishlist_hover_backgroundcolor:#5C37BF,bdp_addtocart_textcolor:#E9E4F6,bdp_addtocart_backgroundcolor:#5C37BF,bdp_addtocart_text_hover_color:#E9E4F6,bdp_addtocart_hover_backgroundcolor:#180E32',
													'display_value' => '#E9E4F6,#5C37BF,#180E32,#26164E',
												),
												'minimal_go_ben' => array(
													'preset_name' => esc_html__( 'Go Ben', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EDECE7,template_ftcolor:#3E3B25,template_fthovercolor:#282618,template_titlecolor:#3E3B25,template_titlehovercolor:#787449,template_contentcolor:#EDECE7,template_contentcolor:#3E3B25,template_readmorecolor:#EDECE7,template_readmorebackcolor:#787449,template_readmore_hover_backcolor:#3E3B25,beforeloop_readmorecolor:#EDECE7,beforeloop_readmorebackcolor:#787449,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#3E3B25,bdp_sale_tagbgcolor:#787449,bdp_sale_tagtextcolor:#EDECE7,bdp_star_rating_color:#3E3B25,bdp_star_rating_bg_color:#282618,bdp_pricetextcolor:#3E3B25,bdp_wishlist_textcolor:#EDECE7,bdp_wishlist_backgroundcolor:#3E3B25,bdp_wishlist_text_hover_color:#EDECE7,bdp_wishlist_hover_backgroundcolor:#787449,bdp_addtocart_textcolor:#EDECE7,bdp_addtocart_backgroundcolor:#787449,bdp_addtocart_text_hover_color:#EDECE7,bdp_addtocart_hover_backgroundcolor:#282618',
													'display_value' => '#EDECE7,#787449,#282618,#3E3B25',
												),
												'minimal_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EAE1E7,template_ftcolor:#35122A,template_fthovercolor:#220B1B,template_titlecolor:#35122A,template_titlehovercolor:#662451,template_contentcolor:#EAE1E7,template_contentcolor:#35122A,template_readmorecolor:#EAE1E7,template_readmorebackcolor:#662451,template_readmore_hover_backcolor:#35122A,beforeloop_readmorecolor:#EAE1E7,beforeloop_readmorebackcolor:#662451,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#35122A,bdp_sale_tagbgcolor:#662451,bdp_sale_tagtextcolor:#EAE1E7,bdp_star_rating_color:#35122A,bdp_star_rating_bg_color:#220B1B,bdp_pricetextcolor:#35122A,bdp_wishlist_textcolor:#EAE1E7,bdp_wishlist_backgroundcolor:#35122A,bdp_wishlist_text_hover_color:#EAE1E7,bdp_wishlist_hover_backgroundcolor:#662451,bdp_addtocart_textcolor:#EAE1E7,bdp_addtocart_backgroundcolor:#662451,bdp_addtocart_text_hover_color:#EAE1E7,bdp_addtocart_hover_backgroundcolor:#220B1B',
													'display_value' => '#EAE1E7,#662451,#220B1B,#35122A',
												),
												'minimal_royal_blue' => array(
													'preset_name' => esc_html__( 'Royal Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E4EAF9,template_ftcolor:#1B326A,template_fthovercolor:#122044,template_titlecolor:#1B326A,template_titlehovercolor:#3463D0,template_contentcolor:#E4EAF9,template_contentcolor:#1B326A,template_readmorecolor:#E4EAF9,template_readmorebackcolor:#3463D0,template_readmore_hover_backcolor:#1B326A,beforeloop_readmorecolor:#E4EAF9,beforeloop_readmorebackcolor:#3463D0,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#1B326A,bdp_sale_tagbgcolor:#3463D0,bdp_sale_tagtextcolor:#E4EAF9,bdp_star_rating_color:#1B326A,bdp_star_rating_bg_color:#122044,bdp_pricetextcolor:#1B326A,bdp_wishlist_textcolor:#E4EAF9,bdp_wishlist_backgroundcolor:#1B326A,bdp_wishlist_text_hover_color:#E4EAF9,bdp_wishlist_hover_backgroundcolor:#3463D0,bdp_addtocart_textcolor:#E4EAF9,bdp_addtocart_backgroundcolor:#3463D0,bdp_addtocart_text_hover_color:#E4EAF9,bdp_addtocart_hover_backgroundcolor:#122044',
													'display_value' => '#E4EAF9,#3463D0,#122044,#1B326A',
												),
											),
											'miracle'      => array(
												'miracle_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#62bf7c,template_fthovercolor:#686868,template_titlecolor:#353535,template_titlehovercolor:#62bf7c,template_titlebackcolor:#ffffff,template_contentcolor:#252525,template_readmorecolor:#ffffff,template_readmorebackcolor:#62bf7c,template_readmore_hover_backcolor:#686868,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#62bf7c,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#686868,bdp_sale_tagbgcolor:#62bf7c,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#252525,bdp_star_rating_bg_color:#353535,bdp_pricetextcolor:#353535,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#353535,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#62bf7c,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#62bf7c,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#353535',
													'display_value' => '#ffffff,#62bf7c,#353535,#252525',
												),
												'miracle_lochmara' => array(
													'preset_name' => esc_html__( 'Lochmara', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F7FAFC,template_ftcolor:#227CAD,template_fthovercolor:#0E3246,template_titlecolor:#051117,template_titlehovercolor:#227CAD,template_titlebackcolor:#F7FAFC,template_contentcolor:#09202D,template_readmorecolor:#F7FAFC,template_readmorebackcolor:#227CAD,template_readmore_hover_backcolor:#0E3246,beforeloop_readmorecolor:#F7FAFC,beforeloop_readmorebackcolor:#227CAD,beforeloop_readmorehovercolor:#F7FAFC,beforeloop_readmorehoverbackcolor:#0E3246,bdp_sale_tagbgcolor:#227CAD,bdp_sale_tagtextcolor:#F7FAFC,bdp_star_rating_color:#09202D,bdp_star_rating_bg_color:#051117,bdp_pricetextcolor:#051117,bdp_wishlist_textcolor:#F7FAFC,bdp_wishlist_backgroundcolor:#051117,bdp_wishlist_text_hover_color:#F7FAFC,bdp_wishlist_hover_backgroundcolor:#227CAD,bdp_addtocart_textcolor:#F7FAFC,bdp_addtocart_backgroundcolor:#227CAD,bdp_addtocart_text_hover_color:#F7FAFC,bdp_addtocart_hover_backgroundcolor:#051117',
													'display_value' => '#F7FAFC,#227CAD,#051117,#09202D',
												),
												'miracle_burgundy' => array(
													'preset_name' => esc_html__( 'Burgundy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF6F7,template_ftcolor:#6C0124,template_fthovercolor:#2C010E,template_titlecolor:#0E0105,template_titlehovercolor:#6C0124,template_titlebackcolor:#FAF6F7,template_contentcolor:#1C0109,template_readmorecolor:#FAF6F7,template_readmorebackcolor:#6C0124,template_readmore_hover_backcolor:#2C010E,beforeloop_readmorecolor:#FAF6F7,beforeloop_readmorebackcolor:#6C0124,beforeloop_readmorehovercolor:#FAF6F7,beforeloop_readmorehoverbackcolor:#2C010E,bdp_sale_tagbgcolor:#6C0124,bdp_sale_tagtextcolor:#FAF6F7,bdp_star_rating_color:#1C0109,bdp_star_rating_bg_color:#0E0105,bdp_pricetextcolor:#0E0105,bdp_wishlist_textcolor:#FAF6F7,bdp_wishlist_backgroundcolor:#0E0105,bdp_wishlist_text_hover_color:#FAF6F7,bdp_wishlist_hover_backgroundcolor:#6C0124,bdp_addtocart_textcolor:#FAF6F7,bdp_addtocart_backgroundcolor:#6C0124,bdp_addtocart_text_hover_color:#FAF6F7,bdp_addtocart_hover_backgroundcolor:#0E0105',
													'display_value' => '#FAF6F7,#6C0124,#0E0105,#1C0109',
												),
												'miracle_hillary' => array(
													'preset_name' => esc_html__( 'Hillary', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCFBFA,template_ftcolor:#A49E77,template_fthovercolor:#434131,template_titlecolor:#161610,template_titlehovercolor:#A49E77,template_titlebackcolor:#FCFBFA,template_contentcolor:#2B2A1F,template_readmorecolor:#FCFBFA,template_readmorebackcolor:#A49E77,template_readmore_hover_backcolor:#434131,beforeloop_readmorecolor:#FCFBFA,beforeloop_readmorebackcolor:#A49E77,beforeloop_readmorehovercolor:#FCFBFA,beforeloop_readmorehoverbackcolor:#434131,bdp_sale_tagbgcolor:#A49E77,bdp_sale_tagtextcolor:#FCFBFA,bdp_star_rating_color:#2B2A1F,bdp_star_rating_bg_color:#161610,bdp_pricetextcolor:#161610,bdp_wishlist_textcolor:#FCFBFA,bdp_wishlist_backgroundcolor:#161610,bdp_wishlist_text_hover_color:#FCFBFA,bdp_wishlist_hover_backgroundcolor:#A49E77,bdp_addtocart_textcolor:#FCFBFA,bdp_addtocart_backgroundcolor:#A49E77,bdp_addtocart_text_hover_color:#FCFBFA,bdp_addtocart_hover_backgroundcolor:#161610',
													'display_value' => '#FCFBFA,#A49E77,#161610,#2B2A1F',
												),
												'miracle_amaranth' => array(
													'preset_name' => esc_html__( 'Amaranth', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FDF9FA,template_ftcolor:#DE364A,template_fthovercolor:#491218,template_titlecolor:#1E070A,template_titlehovercolor:#DE364A,template_titlebackcolor:#FDF9FA,template_contentcolor:#2E0B0F,template_readmorecolor:#FDF9FA,template_readmorebackcolor:#DE364A,template_readmore_hover_backcolor:#491218,beforeloop_readmorecolor:#FDF9FA,beforeloop_readmorebackcolor:#DE364A,beforeloop_readmorehovercolor:#FDF9FA,beforeloop_readmorehoverbackcolor:#491218,bdp_sale_tagbgcolor:#DE364A,bdp_sale_tagtextcolor:#FDF9FA,bdp_star_rating_color:#2E0B0F,bdp_star_rating_bg_color:#1E070A,bdp_pricetextcolor:#1E070A,bdp_wishlist_textcolor:#FDF9FA,bdp_wishlist_backgroundcolor:#1E070A,bdp_wishlist_text_hover_color:#FDF9FA,bdp_wishlist_hover_backgroundcolor:#DE364A,bdp_addtocart_textcolor:#FDF9FA,bdp_addtocart_backgroundcolor:#DE364A,bdp_addtocart_text_hover_color:#FDF9FA,bdp_addtocart_hover_backgroundcolor:#1E070A',
													'display_value' => '#FDF9FA,#DE364A,#1E070A,#2E0B0F',
												),
												'miracle_manatee' => array(
													'preset_name' => esc_html__( 'Manatee', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCFCFD,template_ftcolor:#9699A7,template_fthovercolor:#3E3E45,template_titlecolor:#151516,template_titlehovercolor:#9699A7,template_titlebackcolor:#FCFCFD,template_contentcolor:#28282C,template_readmorecolor:#FCFCFD,template_readmorebackcolor:#9699A7,template_readmore_hover_backcolor:#3E3E45,beforeloop_readmorecolor:#FCFCFD,beforeloop_readmorebackcolor:#9699A7,beforeloop_readmorehovercolor:#FCFCFD,beforeloop_readmorehoverbackcolor:#3E3E45,bdp_sale_tagbgcolor:#DE364A,bdp_sale_tagtextcolor:#FCFCFD,bdp_star_rating_color:#9699A7,bdp_star_rating_bg_color:#151516,bdp_pricetextcolor:#151516,bdp_wishlist_textcolor:#FCFCFD,bdp_wishlist_backgroundcolor:#151516,bdp_wishlist_text_hover_color:#FCFCFD,bdp_wishlist_hover_backgroundcolor:#9699A7,bdp_addtocart_textcolor:#FCFCFD,bdp_addtocart_backgroundcolor:#9699A7,bdp_addtocart_text_hover_color:#FCFCFD,bdp_addtocart_hover_backgroundcolor:#151516',
													'display_value' => '#FCFCFD,#9699A7,#151516,#28282C',
												),
											),
											'my_diary'     => array(
												'my_diary_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#128775,template_fthovercolor:#000000,template_titlecolor:#128775,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#128775,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#128775,beforeloop_readmorehovercolor:#128775,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#128775,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#313131,bdp_pricetextcolor:#128775,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#128775,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#128775,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#313131',
													'display_value' => '#128775,#313131,#ffffff,#333333',
												),
												'my_diary_crimson' => array(
													'preset_name' => esc_html__( 'Crimson', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#e21130,template_fthovercolor:#000000,template_titlecolor:#e21130,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#e21130,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#e21130,beforeloop_readmorehovercolor:#e21130,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#e21130,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#000000,bdp_pricetextcolor:#e21130,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#e21130,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#e21130,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000000',
													'display_value' => '#e21130,#000000,#ffffff,#333333',
												),
												'my_diary_eastern_blue' => array(
													'preset_name' => esc_html__( 'Eastern Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#DAEBFF,template_ftcolor:#00809D,template_fthovercolor:#000000,template_titlecolor:#00809D,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#00809D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#00809D,beforeloop_readmorehovercolor:#00809D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#00809D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#000000,bdp_star_rating_bg_color:#DAEBFF,bdp_pricetextcolor:#00809D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000000,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#00809D,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#00809D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#DAEBFF',
													'display_value' => '#00809D,#DAEBFF,#ffffff,#000000',
												),
												'my_diary_eastern_mint_tulip' => array(
													'preset_name' => esc_html__( 'Mint Tulip', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#E18942,template_fthovercolor:#000000,template_titlecolor:#E18942,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E18942,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E18942,beforeloop_readmorehovercolor:#E18942,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E18942,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#313131,bdp_pricetextcolor:#E18942,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#E18942,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E18942,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#313131',
													'display_value' => '#E18942,#313131,#ffffff,#333333',
												),
												'my_diary_camelot' => array(
													'preset_name' => esc_html__( 'Camelot', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#7A3E48,template_fthovercolor:#000000,template_titlecolor:#7A3E48,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#7A3E48,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#00809D,beforeloop_readmorehovercolor:#00809D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#7A3E48,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#313131,bdp_pricetextcolor:#7A3E48,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#7A3E48,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#7A3E48,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#313131',
													'display_value' => '#7A3E48,#313131,#ffffff,#333333',
												),
												'my_diary_sundance' => array(
													'preset_name' => esc_html__( 'Sundance', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#C59F4A,template_fthovercolor:#000000,template_titlecolor:#C59F4A,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#C59F4A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#00809D,beforeloop_readmorehovercolor:#00809D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#C59F4A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#313131,bdp_pricetextcolor:#C59F4A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#C59F4A,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#C59F4A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#313131',
													'display_value' => '#C59F4A,#313131,#ffffff,#333333',
												),
											),
											'navia'        => array(
												'navia_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#D65D88,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#D65D88,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#D65D88,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#D65D88,beforeloop_readmorehovercolor:#D65D88,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#D65D88,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#D65D88,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#D65D88,#222222,#555555,#999999',
												),
												'navia_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#BE9055,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AE742A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#BE9055',
													'display_value' => '#AE742A,#BE9055,#555555,#999999',
												),
												'navia_fun_green' => array(
													'preset_name' => esc_html__( 'Fun Green', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#3E8563,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E663C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#3E8563',
													'display_value' => '#0E663C,#3E8563,#555555,#999999',
												),
												'navia_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C62AA,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#A381BB,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C62AA,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#A381BB',
													'display_value' => '#8C62AA,#A381BB,#555555,#999999',
												),
												'navia_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#E5A452,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#E5A452',
													'display_value' => '#DF8D27,#E5A452,#555555,#999999',
												),
												'navia_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#FCE1E4,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E81B3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#ED4961,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#999999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E81B3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#ED4961',
													'display_value' => '#E81B3A,#ED4961,#555555,#999999',
												),
											),
											'news'         => array(
												'news_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#AF583D,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#AF583D,template_titlebackcolor:#ffffff,template_contentcolor:#444444,template_readmorecolor:#AF583D,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#AF583D,beforeloop_readmorehovercolor:#AF583D,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#AF583D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AF583D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#AF583D,#222222,#555555,#444444',
												),
												'news_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F8F3ED,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F8F3ED,template_contentcolor:#444444,template_readmorecolor:#683C6F,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#f1f1f1,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#BE9055,bdp_wishlist_textcolor:#f1f1f1,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#f1f1f1,bdp_wishlist_hover_backgroundcolor:#BE9055,bdp_addtocart_textcolor:#f1f1f1,bdp_addtocart_backgroundcolor:#AE742A,bdp_addtocart_text_hover_color:#f1f1f1,bdp_addtocart_hover_backgroundcolor:#444444',
													'display_value' => '#AE742A,#BE9055,#555555,#444444',
												),
												'news_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#EEF6F8,template_contentcolor:#444444,template_readmorecolor:#3E91AD,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#f1f1f1,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#3E91AD,bdp_wishlist_textcolor:#f1f1f1,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#f1f1f1,bdp_wishlist_hover_backgroundcolor:#3E91AD,bdp_addtocart_textcolor:#f1f1f1,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#f1f1f1,bdp_addtocart_hover_backgroundcolor:#444444',
													'display_value' => '#0E7699,#3E91AD,#555555,#444444',
												),
												'news_rich-gold' => array(
													'preset_name' => esc_html__( 'Rich Gold', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F9F4F0,template_ftcolor:#555555,template_fthovercolor:#BA7850,template_titlecolor:#A95624,template_titlehovercolor:#BA7850,template_titlebackcolor:#F9F4F0,template_contentcolor:#444444,template_readmorecolor:#BA7850,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#BA7850,beforeloop_readmorehovercolor:#BA7850,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#A95624,bdp_sale_tagtextcolor:#f1f1f1,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#BA7850,bdp_wishlist_textcolor:#f1f1f1,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#f1f1f1,bdp_wishlist_hover_backgroundcolor:#BA7850,bdp_addtocart_textcolor:#f1f1f1,bdp_addtocart_backgroundcolor:#A95624,bdp_addtocart_text_hover_color:#f1f1f1,bdp_addtocart_hover_backgroundcolor:#444444',
													'display_value' => '#A95624,#BA7850,#555555,#444444',
												),
												'news_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#F1F3F0,template_contentcolor:#444444,template_readmorecolor:#67704E,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#f1f1f1,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#f1f1f1,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#f1f1f1,bdp_wishlist_hover_backgroundcolor:#67704E,bdp_addtocart_textcolor:#f1f1f1,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#f1f1f1,bdp_addtocart_hover_backgroundcolor:#444444',
													'display_value' => '#414C22,#67704E,#555555,#444444',
												),
												'news_regal_blue' => array(
													'preset_name' => esc_html__( 'Regal Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EEF1F4,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,template_titlehovercolor:#435F7F,template_titlebackcolor:#EEF1F4,template_contentcolor:#444444,template_readmorecolor:#435F7F,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#435F7F,beforeloop_readmorehovercolor:#435F7F,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#14375F,bdp_sale_tagtextcolor:#f1f1f1,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#435F7F,bdp_wishlist_textcolor:#f1f1f1,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#f1f1f1,bdp_wishlist_hover_backgroundcolor:#435F7F,bdp_addtocart_textcolor:#f1f1f1,bdp_addtocart_backgroundcolor:#14375F,bdp_addtocart_text_hover_color:#f1f1f1,bdp_addtocart_hover_backgroundcolor:#444444',
													'display_value' => '#14375F,#435F7F,#555555,#444444',
												),
											),
											'offer_blog'   => array(
												'offer_blog_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#BE6A67,template_fthovercolor:#555555,template_titlecolor:#333333,template_titlehovercolor:#BE6A67,template_titlebackcolor:#ffffff,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE6A67,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE6A67,beforeloop_readmorehovercolor:#BE6A67,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#BE6A67,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#333333,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#BE6A67,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#BE6A67,#333333,#555555,#666666',
												),
												'offer_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#F1F3F0,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#67704E,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#414C22,#67704E,#555555,#666666',
												),
												'offer_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F9F5F1,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F9F5F1,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#BE9055,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#BE9055,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AE742A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#AE742A,#BE9055,#555555,#666666',
												),
												'offer_regal_blue' => array(
													'preset_name' => esc_html__( 'Regal Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EEF1F4,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,template_titlehovercolor:#435F7F,template_titlebackcolor:#EEF1F4,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#435F7F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#435F7F,beforeloop_readmorehovercolor:#435F7F,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#435F7F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#14375F,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#435F7F,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#14375F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#14375F,#435F7F,#555555,#666666',
												),
												'offer_shiraz' => array(
													'preset_name' => esc_html__( 'Shiraz', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EEE2E4,template_ftcolor:#555555,template_fthovercolor:#9E555D,template_titlecolor:#862A35,template_titlehovercolor:#9E555D,template_titlebackcolor:#EEE2E4,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#9E555D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9E555D,beforeloop_readmorehovercolor:#9E555D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#862A35,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#862A35,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#9E555D,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#862A35,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#862A35,#9E555D,#555555,#666666',
												),
												'offer_yonder' => array(
													'preset_name' => esc_html__( 'Yonder', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F3F5FA,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F3F5FA,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6E8CC2,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#6E8CC2,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#8BA3CE,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#666666',
												),
											),
											'overlay_horizontal' => array(
												'overlay_horizontal_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#dd5555,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#ffffff,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#dd5555,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#dd5555,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#aaaaaa,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#aaaaaa,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#dd5555,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#dd5555,#ffffff,#aaaaaa,#ffffff',
												),
												'overlay_horizontal_persian_red' => array(
													'preset_name' => esc_html__( 'Persian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#DC3330,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#DC3330,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#DC3330,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#DC3330,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#aaaaaa,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#aaaaaa,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#DC3330,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#DC3330,#ffffff,#aaaaaa,#ffffff',
												),
												'overlay_horizontal_dark_goldenrod' => array(
													'preset_name' => esc_html__( 'Dark Goldenrod', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#B48900,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#B48900,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#B48900,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#B48900,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#aaaaaa,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#aaaaaa,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#B48900,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#B48900,#ffffff,#aaaaaa,#ffffff',
												),
												'overlay_horizontal_deep_cerise' => array(
													'preset_name' => esc_html__( 'Deep Cerise', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#D23582,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#D23582,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#D23582,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#D23582,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#aaaaaa,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#aaaaaa,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#D23582,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#D23582,#ffffff,#aaaaaa,#ffffff',
												),
												'overlay_horizontal_rust' => array(
													'preset_name' => esc_html__( 'Rust', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#CA4B16,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#CA4B16,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#CA4B16,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#CA4B16,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#aaaaaa,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#aaaaaa,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#CA4B16,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#CA4B16,#ffffff,#aaaaaa,#ffffff,',
												),
												'overlay_horizontal_blue' => array(
													'preset_name' => esc_html__( 'Chetwode Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#6C71C3,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#6C71C3,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#6C71C3,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffffff,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#6C71C3,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#aaaaaa,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#aaaaaa,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#6C71C3,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#6C71C3,#ffffff,#aaaaaa,#ffffff',
												),
											),
											'nicy'         => array(
												'nicy_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#ED4961,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#ED4961,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ED4961,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#ED4961,bdp_sale_tagbgcolor:#ED4961,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#222222,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#ED4961,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#ED4961,#222222,#555555,#999999',
												),
												'nicy_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E91AD,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E91AD,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E91AD,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E7699,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#0E7699,#3E91AD,#555555,#999999',
												),
												'nicy_fun_green' => array(
													'preset_name' => esc_html__( 'Fun Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E8563,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E8563,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E8563,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E663C,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E8563,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E663C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#0E663C,#3E8563,#555555,#999999',
												),
												'nicy_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#6D4657,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#6D4657,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#6D4657,bdp_sale_tagbgcolor:#49182D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#49182D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#6D4657,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#49182D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#49182D,#6D4657,#555555,#999999',
												),
												'nicy_earls_green' => array(
													'preset_name' => esc_html__( 'Earls Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#CEBF59,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#CEBF59,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#CEBF59,bdp_sale_tagbgcolor:#C2AF2F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#C2AF2F,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#CEBF59,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#C2AF2F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#C2AF2F,#CEBF59,#555555,#999999',
												),
												'nicy_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#F4ECE2,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F4ECE2,template_contentcolor:#999999,template_readmorecolor:#BE9055,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#BE9055,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#BE9055,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#AE742A,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#BE9055,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AE742A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#AE742A,#BE9055,#555555,#999999',
												),
											),
											'region'       => array(
												'region_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#AC619B,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#AC619B,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#AC619B,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#AC619B,beforeloop_readmorehovercolor:#AC619B,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#AC619B,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AC619B,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#AC619B,#222222,#555555,#333333',
												),
												'region_red_violet' => array(
													'preset_name' => esc_html__( 'Red Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F5E1ED,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_titlebackcolor:#F5E1ED,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#B51F76,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#C44C91,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C44C91,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B51F76,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#B51F76,#C44C91,#555555,#333333',
												),
												'region_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#FCE1E4,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#E81B3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#ED4961,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#ED4961,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E81B3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#E81B3A,#ED4961,#555555,#333333',
												),
												'region_earls_green' => array(
													'preset_name' => esc_html__( 'Earls Green', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F7F4E4,template_ftcolor:#55555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#F7F4E4,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#CEBF59,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#CEBF59,beforeloop_readmorehovercolor:#CEBF59,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#C2AF2F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#CEBF59,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#CEBF59,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#C2AF2F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#C2AF2F,#CEBF59,#555555,#333333',
												),
												'region_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#E5E7E1,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#414C22,#67704E,#555555,#333333',
												),
												'region_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#F0E9F4,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#8C62AA,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#A381BB,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#A381BB,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C62AA,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#8C62AA,#A381BB,#555555,#333333',
												),
											),
											'roctangle'    => array(
												'roctangle_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_color:#f18293,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_titlehovercolor:#f18293,template_readmorecolor:#222222,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#f18293,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#222222,template_contentcolor:#444444,bdp_sale_tagbgcolor:#f18293,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#f18293,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#f18293,#222222,#444444,#666666',
												),
												'roctangle_sky_blue' => array(
													'preset_name' => esc_html__( 'Sky Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_color:#92E2FD,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_titlehovercolor:#92E2FD,template_readmorecolor:#222222,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#92E2FD,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#222222,template_contentcolor:#444444,bdp_sale_tagbgcolor:#92E2FD,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#92E2FD,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#92E2FD,#222222,#444444,#666666',
												),
												'roctangle_lite_green' => array(
													'preset_name' => esc_html__( 'Lite Green', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_color:#0ef58d,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_titlehovercolor:#0ef58d,template_readmorecolor:#222222,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0ef58d,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#222222,template_contentcolor:#444444,bdp_sale_tagbgcolor:#0ef58d,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#444444,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0ef58d,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#0ef58d,#222222,#444444,#666666',
												),
											),
											'sharpen'      => array(
												'sharpen_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#2E6480,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2E6480,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#2E6480,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#2E6480,beforeloop_readmorehovercolor:#2E6480,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#2E6480,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#999999,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2E6480,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#2E6480,#222222,#555555,#999999',
												),
												'sharpen_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#999999,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#414C22,#67704E,#555555,#999999',
												),
												'sharpen_red_violet' => array(
													'preset_name' => esc_html__( 'Red Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#B51F76,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#999999,bdp_pricetextcolor:#C44C91,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C44C91,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B51F76,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#B51F76,#C44C91,#555555,#999999',
												),
											),
											'spektrum'     => array(
												'spektrum_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#2d7fc1,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2d7fc1,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#2d7fc1,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#2d7fc1,beforeloop_readmorehovercolor:#2d7fc1,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#2d7fc1,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#2d7fc1,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#2d7fc1,#222222,#555555,#333333',
												),
												'spektrum_torea_bay' => array(
													'preset_name' => esc_html__( 'Torea Bay', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#3E91AD,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#0E7699,#3E91AD,#555555,#999999',
												),
												'spektrum_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,template_titlehovercolor:#EE4861,template_titlebackcolor:#FCE1E4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#EE4861,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EE4861,beforeloop_readmorehovercolor:#EE4861,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#EA1A3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#EE4861,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#EE4861,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#EA1A3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#EA1A3A,#EE4861,#555555,#333333',
												),
												'spektrum_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#E5A452,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E5A452,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#DF8D27,#E5A452,#555555,#333333',
												),
												'spektrum_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#F0E9F4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C62AA,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#A381BB,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#A381BB,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C62AA,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#8C62AA,#A381BB,#555555,#333333',
												),
												'spektrum_wild_yonder' => array(
													'preset_name' => esc_html__( 'Wild Yonder', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ECF0F7,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#ECF0F7,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6E8CC2,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8BA3CE,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#8BA3CE,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#333333',
												),
											),
											'steps'        => array(
												'steps_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#d1d1d1,template_bgcolor:#ffffff,template_ftcolor:#b7b7b7,template_fthovercolor:#2a2727,template_titlecolor:#2a2727,template_titlehovercolor:#e21130,template_titlebackcolor:#ffffff,template_contentcolor:#504d4d,template_readmorecolor:#e21130,beforeloop_readmorecolor:#e21130,beforeloop_readmorebackcolor:#ffffff,beforeloop_readmorehovercolor:#504d4d,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#e21130,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#504d4d,bdp_star_rating_bg_color:#b7b7b7,bdp_pricetextcolor:#2a2727,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#2a2727,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#e21130,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#e21130,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#504d4d',
													'display_value' => '#d1d1d1,#b7b7b7,#2a2727,#e21130',
												),
												'steps_tan' => array(
													'preset_name' => esc_html__( 'Tan', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#E7DDC5,template_bgcolor:#F9F6F0,template_ftcolor:#D9CAA5,template_fthovercolor:#6A6149,template_titlecolor:#6A6149,template_titlehovercolor:#CFBD8F,template_titlebackcolor:#F9F6F0,template_contentcolor:#6A6149,template_readmorecolor:#CFBD8F,beforeloop_readmorecolor:#CFBD8F,beforeloop_readmorebackcolor:#F9F6F0,beforeloop_readmorehovercolor:#6A6149,beforeloop_readmorehoverbackcolor:#F9F6F0,bdp_sale_tagbgcolor:#6A6149,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#CFBD8F,bdp_star_rating_bg_color:#CFBD8F,bdp_pricetextcolor:#6A6149,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#CFBD8F,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#6A6149,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6A6149,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#CFBD8F',
													'display_value' => '#E7DDC5,#D9CAA5,#6A6149,#CFBD8F',
												),
												'steps_nordic' => array(
													'preset_name' => esc_html__( 'Nordic', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#849697,template_bgcolor:#DFE4E4,template_ftcolor:#3F5B5D,template_fthovercolor:#081A1B,template_titlecolor:#081A1B,template_titlehovercolor:#0F3235,template_titlebackcolor:#DFE4E4,template_contentcolor:#081A1B,template_readmorecolor:#0F3235,beforeloop_readmorecolor:#0F3235,beforeloop_readmorebackcolor:#DFE4E4,beforeloop_readmorehovercolor:#081A1B,beforeloop_readmorehoverbackcolor:#DFE4E4,bdp_sale_tagbgcolor:#0F3235,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#CFBD8F,bdp_star_rating_bg_color:#CFBD8F,bdp_pricetextcolor:#081A1B,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3F5B5D,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#081A1B,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0F3235,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#3F5B5D',
													'display_value' => '#849697,#3F5B5D,#081A1B,#0F3235',
												),
											),
											'story'        => array(
												'story_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#0c555e,template_alternative_color:#ff6861,story_startup_border_color:#ffffff,story_startup_background:#71a405,story_startup_text_color:#ffffff,story_ending_background:#71a405,story_ending_text_color:#ffffff,template_ftcolor:#0c555e,template_fthovercolor:#2b2b2b,template_titlecolor:#333333,template_titlehovercolor:#ade175,template_contentcolor:#666666,template_readmorecolor:#d6d6d6,template_readmorebackcolor:#333333,bdp_sale_tagbgcolor:#0c555e,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#ff6861,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#ff6861,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#0c555e,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#ff6861',
													'display_value' => '#0c555e,#ff6861,#0c555e,#333333',
												),
												'story_goldenrod' => array(
													'preset_name' => esc_html__( 'Goldenrod', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#b48900,template_alternative_color:#d23582,story_startup_border_color:#e21130,story_startup_background:#e21130,story_startup_text_color:#ffffff,story_ending_background:#e21130,story_ending_text_color:#ffffff,template_ftcolor:#e21130,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,template_titlehovercolor:#e21130,template_contentcolor:#666666,template_readmorecolor:#d6d6d6,template_readmorebackcolor:#e21130,bdp_sale_tagbgcolor:#b48900,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#707070,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#d23582,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#b48900,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#e21130',
													'display_value' => '#b48900,#d23582,#e21130,#333333',
												),
												'story_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#fa336c,template_alternative_color:#f18547,story_startup_border_color:#75815b,story_startup_background:#75815b,story_startup_text_color:#ffffff,story_ending_background:#75815b,story_ending_text_color:#ffffff,template_ftcolor:#75815b,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,template_titlehovercolor:#75815b,template_contentcolor:#666666,template_readmorecolor:#d6d6d6,template_readmorebackcolor:#75815b,bdp_sale_tagbgcolor:#fa336c,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#707070,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#f18547,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#fa336c,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#75815b',
													'display_value' => '#fa336c,#f18547,#75815b,#333333',
												),
											),
											'timeline'     => array(
												'timeline_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'displaydate_backcolor:#414a54,template_color:#E0254D,template_bgcolor:#ffffff,template_ftcolor:#E0254D,template_fthovercolor:#444444,template_titlecolor:#E0254D,template_titlehovercolor:#444444,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E0254D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E0254D,beforeloop_readmorehovercolor:#E0254D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E0254D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#414a54,bdp_pricetextcolor:#E0254D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#414a54,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#E0254D,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E0254D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#E0254D,#414a54,#ffffff,#333333',
												),
												'timeline_pink' => array(
													'preset_name' => esc_html__( 'Dark Sea Green', 'blog-designer-pro' ),
													'preset_value' => 'displaydate_backcolor:#9AB999,template_color:#9AB999,template_bgcolor:#F6F8F5,template_ftcolor:#9AB999,template_fthovercolor:#444444,template_titlecolor:#9AB999,template_titlehovercolor:#444444,template_titlebackcolor:#F6F8F5,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#9AB999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9AB999,beforeloop_readmorehovercolor:#9AB999,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#9AB999,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#9AB999,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#9AB999,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#9AB999,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#9AB999,#F6F8F5,#9AB999,#333333',
												),
												'timeline_pacific_blue' => array(
													'preset_name' => esc_html__( 'Pacific Blue', 'blog-designer-pro' ),
													'preset_value' => 'displaydate_backcolor:#0099CB,template_color:#0099CB,template_bgcolor:#E6F5FA,template_ftcolor:#0099CB,template_fthovercolor:#444444,template_titlecolor:#0099CB,template_titlehovercolor:#444444,template_titlebackcolor:#E6F5FA,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0099CB,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#0099CB,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#0099CB,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0099CB,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#0099CB,#E6F5FA,#0099CB,#333333',
												),
												'timeline_dark_orchid' => array(
													'preset_name' => esc_html__( 'Dark Orchid', 'blog-designer-pro' ),
													'preset_value' => 'displaydate_backcolor:#9A33CC,template_color:#9A33CC,template_bgcolor:#F5EAFA,template_ftcolor:#9A33CC,template_fthovercolor:#444444,template_titlecolor:#9A33CC,template_titlehovercolor:#444444,template_titlebackcolor:#F5EAFA,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#9A33CC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#9A33CC,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#9A33CC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#9A33CC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#9A33CC,#F5EAFA,#9A33CC,#333333',
												),
												'timeline_dark_orange' => array(
													'preset_name' => esc_html__( 'Dark Orange', 'blog-designer-pro' ),
													'preset_value' => 'displaydate_backcolor:#FF8A00,template_color:#FF8A00,template_bgcolor:#FFF3E5,template_ftcolor:#FF8A00,template_fthovercolor:#444444,template_titlecolor:#FF8A00,template_titlehovercolor:#444444,template_titlebackcolor:#FFF3E5,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#FF8A00,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#FF8A00,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#FF8A00,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FF8A00,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#FF8A00,#FFF3E5,#FF8A00,#333333',
												),
												'timeline_venetian_red' => array(
													'preset_name' => esc_html__( 'Venetian Red', 'blog-designer-pro' ),
													'preset_value' => 'displaydate_backcolor:#CC0001,template_color:#CC0001,template_bgcolor:#FAE4E6,template_ftcolor:#CC0001,template_fthovercolor:#444444,template_titlecolor:#CC0001,template_titlehovercolor:#444444,template_titlebackcolor:#FAE4E6,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#CC0001,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#333333,bdp_pricetextcolor:#CC0001,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#CC0001,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#CC0001,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#CC0001,#FAE4E6,#CC0001,#333333',
												),
											),
											'winter'       => array(
												'winter_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#E7492F,template_bgcolor:#ffffff,template_ftcolor:#E7492F,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#ED4961,template_titlebackcolor:#ffffff,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E7492F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E7492F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#E7492F,#222222,#555555,#666666',
												),
												'winter_toddy' => array(
													'preset_name' => esc_html__( 'Toddy', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#BE9055,template_bgcolor:#F9F5F1,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F9F5F1,template_contentcolor:#666666,template_readmorecolor:#F9F5F1,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#AE742A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#BE9055,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#BE9055,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#AE742A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#AE742A,#BE9055,#555555,#666666',
												),
												'winter_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#67704E,template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#E5E7E1,template_titlebackcolor:#E5E7E1,template_contentcolor:#666666,template_readmorecolor:#E5E7E1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#414C22,#67704E,#555555,#666666',
												),
												'winter_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#3E91AD,template_bgcolor:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#EEF6F8,template_contentcolor:#666666,template_readmorecolor:#EEF6F8,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#3E91AD,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#0E7699,#3E91AD,#555555,#666666',
												),
												'winter_ce_soir' => array(
													'preset_name' => esc_html__( 'Ce Soir', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#A381BB,template_bgcolor:#F7F4F9,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#3E91AD,template_titlebackcolor:#F7F4F9,template_contentcolor:#666666,template_readmorecolor:#F7F4F9,template_readmorebackcolor:#8C62AA,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8C62AA,beforeloop_readmorehovercolor:#8C62AA,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C62AA,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#A381BB,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#A381BB,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C62AA,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#8C62AA,#A381BB,#555555,#666666',
												),
												'winter_yonder' => array(
													'preset_name' => esc_html__( 'Yonder', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#8BA3CE,template_bgcolor:#F5F7FB,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F5F7FB,template_contentcolor:#666666,template_readmorecolor:#F5F7FB,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6E8CC2,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8BA3CE,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#8BA3CE,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#666666',
												),
											),
											'sallet_slider' => array(
												'sallet_slider_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,winter_category_color:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E663C,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E8563,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E663C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#0E663C,#3E8563,#555555,#333333',
												),
												'sallet_slider_red_violet' => array(
													'preset_name' => esc_html__( 'Red Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#FBF3F8,template_ftcolor:#555555,template_fthovercolor:#C44C91,winter_category_color:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#B51F76,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#B51F76,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C44C91,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B51F76,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#B51F76,#C44C91,#555555,#333333',
												),
												'sallet_slider_lemon_ginger' => array(
													'preset_name' => esc_html__( 'Lemon Ginger', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#F7F6F1,template_ftcolor:#555555,template_fthovercolor:#A39D5A,winter_category_color:#A39D5A,template_titlecolor:#8C8431,template_titlehovercolor:#A39D5A,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C8431,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8C8431,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#A39D5A,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C8431,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#8C8431,#A39D5A,#555555,#333333',
												),
												'sallet_slider_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,winter_category_color:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E7699,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#0E7699,#3E91AD,#555555,#333333',
												),
												'sallet_slider_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#FDF7F1,template_ftcolor:#555555,template_fthovercolor:#E5A452,winter_category_color:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#DF8D27,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E5A452,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#DF8D27,#E5A452,#555555,#333333',
												),
												'sallet_slider_wasabi' => array(
													'preset_name' => esc_html__( 'Wasabi', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#F6F7F1,template_ftcolor:#555555,template_fthovercolor:#93A564,winter_category_color:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#788F3D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#788F3D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#93A564,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#788F3D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#788F3D,#93A564,#555555,#333333',
												),
											),
											'colorful_sliding' => array(
												'colorful_sliding_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,winter_category_color:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E663C,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E663C,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E8563,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E663C,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#0E663C,#3E8563,#555555,#333333',
												),
												'colorful_sliding_red_violet' => array(
													'preset_name' => esc_html__( 'Red Violet', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#FBF3F8,template_ftcolor:#555555,template_fthovercolor:#C44C91,winter_category_color:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#B51F76,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#B51F76,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#C44C91,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B51F76,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#B51F76,#C44C91,#555555,#333333',
												),
												'colorful_sliding_lemon_ginger' => array(
													'preset_name' => esc_html__( 'Lemon Ginger', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#F7F6F1,template_ftcolor:#555555,template_fthovercolor:#A39D5A,winter_category_color:#A39D5A,template_titlecolor:#8C8431,template_titlehovercolor:#A39D5A,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#8C8431,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8C8431,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#A39D5A,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#8C8431,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#8C8431,#A39D5A,#555555,#333333',
												),
												'colorful_sliding_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,winter_category_color:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#0E7699,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#0E7699,#3E91AD,#555555,#333333',
												),
												'colorful_sliding_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#FDF7F1,template_ftcolor:#555555,template_fthovercolor:#E5A452,winter_category_color:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#DF8D27,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E5A452,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#DF8D27,#E5A452,#555555,#333333',
												),
												'colorful_sliding_wasabi' => array(
													'preset_name' => esc_html__( 'Wasabi', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#F6F7F1,template_ftcolor:#555555,template_fthovercolor:#93A564,winter_category_color:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#788F3D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#333333,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#788F3D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#93A564,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#788F3D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#333333',
													'display_value' => '#788F3D,#93A564,#555555,#333333',
												),
											),
											'sunshiny_slider' => array(
												'sunshiny_slider_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ff00ae,winter_category_color:#ff00ae,template_titlecolor:#ffffff,template_titlehovercolor:#ff00ae,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#ff00ae,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#333333,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ff00ae,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#ff00ae,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#333333,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#333333,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#ff00ae,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#ffffff,#ff00ae,#ffffff,#333333',
												),
												'sunshiny_slider_radical_red' => array(
													'preset_name' => esc_html__( 'Radical Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#330a12,template_ftcolor:#ffeaee,template_fthovercolor:#ff355e,winter_category_color:#ff355e,template_titlecolor:#ffd6de,template_titlehovercolor:#FA336C,template_contentcolor:#ffeaee,template_readmorecolor:#ffffff,template_readmorebackcolor:#FA336C,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#ff355e,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffeaee,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#330a12,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#ff355e,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#ff355e,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#330a12,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#330a12,#ff355e,#ffd6de,#ffeaee',
												),
												'sunshiny_slider_eminence' => array(
													'preset_name' => esc_html__( 'Eminence', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#2b1334,template_ftcolor:#e1d5e6,template_fthovercolor:#2b1334,winter_category_color:#6c3082,template_titlecolor:#e1d5e6,template_titlehovercolor:#2b1334,template_contentcolor:#f0eaf2,template_readmorecolor:#ffffff,template_readmorebackcolor:#683C6F,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#6c3082,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffeaee,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2b1334,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#6c3082,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#6c3082,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#2b1334,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#2b1334,#6c3082,#e1d5e6,#f0eaf2',
												),
												'sunshiny_slider_dark_orange' => array(
													'preset_name' => esc_html__( 'Dark Orange', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#FF8A00,template_color:#FFF3E5,template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#FF8A00,template_titlehovercolor:#2b2b2b,template_contentcolor:#2b2b2b,template_readmorecolor:#ffffff,template_readmorebackcolor:#FF8A00,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#FFF3E5,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffeaee,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#FF8A00,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#FFF3E5,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#FFF3E5,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#FF8A00,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#FF8A00,#FFF3E5,#ffffff,#2b2b2b',
												),
												'sunshiny_slider_persian_red' => array(
													'preset_name' => esc_html__( 'Persian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#3d0f0f,template_ftcolor:#ffffff,template_fthovercolor:#3d0f0f,winter_category_color:#cc3333,template_titlecolor:#f4d6d6,template_titlehovercolor:#3d0f0f,template_contentcolor:#f9eaea,template_readmorecolor:#ffffff,template_readmorebackcolor:#DC3330,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#cc3333,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffeaee,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#3d0f0f,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#cc3333,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#cc3333,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#3d0f0f,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#3d0f0f,#cc3333,#f4d6d6,#f9eaea',
												),
												'sunshiny_slider_venetian_red' => array(
													'preset_name' => esc_html__( 'Venetian Red', 'blog-designer-pro' ),
													'preset_value' => 'winter_category_color:#CC0001,template_color:#FAE4E6,template_ftcolor:#ffffff,template_fthovercolor:#2b2b2b,template_titlecolor:#ffffff,template_titlehovercolor:#2b2b2b,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#CC0001,bdp_sale_tagbgcolor:#ffffff,bdp_sale_tagtextcolor:#CC0001,bdp_star_rating_color:#ffffff,bdp_star_rating_bg_color:#ffeaee,bdp_pricetextcolor:#ffffff,bdp_wishlist_textcolor:#2b2b2b,bdp_wishlist_backgroundcolor:#ffffff,bdp_wishlist_text_hover_color:#CC0001,bdp_wishlist_hover_backgroundcolor:#ffffff,bdp_addtocart_textcolor:#CC0001,bdp_addtocart_backgroundcolor:#ffffff,bdp_addtocart_text_hover_color:#2b2b2b,bdp_addtocart_hover_backgroundcolor:#ffffff',
													'display_value' => '#FAE4E6,#CC0001,#ffffff,#2b2b2b',
												),
											),
											'pretty'       => array(
												'pretty_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ff93a3,template_bgcolor:#ffffff,template_ftcolor:#b7b7b7,template_fthovercolor:#859f88,template_titlecolor:#859f88,template_titlehovercolor:#ff93a3,template_titlebackcolor:#ffffff,template_readmorecolor:#f7fbfc,template_readmorebackcolor:#859f88,template_contentcolor:#484848,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#859f88,beforeloop_readmorehovercolor:#859f88,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#ff93a3,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#484848,bdp_star_rating_bg_color:#859f88,bdp_pricetextcolor:#859f88,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#859f88,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#484848,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#ff93a3,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#484848',
													'display_value' => '#ff93a3,#ffffff,#484848,#859f88',
												),
												'pretty_sky_blue' => array(
													'preset_name' => esc_html__( 'Sky Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#00809D,template_bgcolor:#DAEBFF,template_ftcolor:#888888,template_fthovercolor:#00809D,template_titlecolor:#00809D,template_titlehovercolor:#888888,template_titlebackcolor:#DAEBFF,template_readmorecolor:#f7fbfc,template_readmorebackcolor:#00809D,template_contentcolor:#484848,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#DAEBFF,beforeloop_readmorehovercolor:#DAEBFF,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#00809D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#484848,bdp_star_rating_bg_color:#888888,bdp_pricetextcolor:#888888,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#888888,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#484848,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#00809D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#484848',
													'display_value' => '#00809D,#DAEBFF,#484848,#888888',
												),
												'pretty_lite_green' => array(
													'preset_name' => esc_html__( 'Lite Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#0ef58d,template_bgcolor:#C3F3DD,template_ftcolor:#888888,template_fthovercolor:#E21130,template_titlecolor:#e21130,template_titlehovercolor:#0ef58d,template_titlebackcolor:#C3F3DD,template_readmorecolor:#f7fbfc,template_readmorebackcolor:#E21130,template_contentcolor:#484848,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C3F3DD,beforeloop_readmorehovercolor:#C3F3DD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0ef58d,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#484848,bdp_star_rating_bg_color:#E21130,bdp_pricetextcolor:#E21130,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E21130,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#484848,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0ef58d,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#484848',
													'display_value' => '#0ef58d,#C3F3DD,#484848,#E21130',
												),
											),
											'tagly'        => array(
												'tagly_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#b79a5e,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#b79a5e,template_titlecolor:#333333,template_titlehovercolor:#b79a5e,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#b79a5e,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#b79a5e,beforeloop_readmorehovercolor:#b79a5e,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#b79a5e,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#333333,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#b79a5e,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#b79a5e,#333333,#555555,#999999',
												),
												'tagly_earls_green' => array(
													'preset_name' => esc_html__( 'Earls Green', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#CEBF59,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#CEBF59,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CEBF59,beforeloop_readmorehovercolor:#CEBF59,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#C2AF2F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#CEBF59,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#CEBF59,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#C2AF2F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#C2AF2F,#CEBF59,#555555,#999999',
												),
												'tagly_cerulean' => array(
													'preset_name' => esc_html__( 'Cerulean', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#3E91AD,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0E7699,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#3E91AD,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#3E91AD,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0E7699,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#0E7699,#3E91AD,#555555,#999999',
												),
												'tagly_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#974772,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#7D194F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#974772,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#974772,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#7D194F,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#7D194F,#974772,#555555,#999999',
												),
												'tagly_alizarin' => array(
													'preset_name' => esc_html__( 'Alizarin', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#ED4961,template_bgcolor:#FDF0F1,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#FDF0F1,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E81B3A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#ED4961,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#ED4961,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E81B3A,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#E81B3A,#ED4961,#555555,#999999',
												),
												'tagly_yonder' => array(
													'preset_name' => esc_html__( 'Yonder', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#8BA3CE,template_bgcolor:#F5F7FB,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F5F7FB,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6E8CC2,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#8BA3CE,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#8BA3CE,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#999999',
												),
											),
											'foodbox'      => array(
												'foodbox_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#6e3d30,template_bgcolor:#f7f4ef,template_ftcolor:#444444,template_fthovercolor:#000000,template_titlecolor:#312725,template_titlehovercolor:#000000,template_readmorecolor:#ffffff,template_readmorebackcolor:#6e3d30,template_contentcolor:#444444,
                                                    template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6e3d30,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#000000',
													'display_value' => '#312725,#000000,#6e3d30,#444444',
												),
												'foodbox_radical' => array(
													'preset_name' => esc_html__( 'Radical', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#4F171C,template_bgcolor:#FDE7E9,template_ftcolor:#4F171C,template_fthovercolor:#7C242C,template_titlecolor:#F34656,template_titlehovercolor:#4F171C,template_titlebackcolor:#FDE7E9,template_contentcolor:#7C242C,template_readmorecolor:#fde7e9,template_readmorebackcolor:#F34656,template_readmore_hover_backcolor:#F9A1A9,beforeloop_readmorecolor:#F34656,beforeloop_readmorebackcolor:#FDE7E9,beforeloop_readmorehovercolor:#F34656,beforeloop_readmorehoverbackcolor:#F9A1A9,bdp_sale_tagbgcolor:#4F171C,bdp_sale_tagtextcolor:#FDE7E9,bdp_star_rating_color:#7C242C,bdp_star_rating_bg_color:#F34656,bdp_pricetextcolor:#FDE7E9,bdp_wishlist_textcolor:#FDE7E9,bdp_wishlist_backgroundcolor:#4F171C,bdp_wishlist_text_hover_color:#FDE7E9,bdp_wishlist_hover_backgroundcolor:#7C242C,bdp_addtocart_textcolor:#FDE7E9,bdp_addtocart_backgroundcolor:#F34656,bdp_addtocart_text_hover_color:#FDE7E9,bdp_addtocart_hover_backgroundcolor:#7C242C',
													'display_value' => '#FDE7E9,#F34656,#7C242C,#4F171C',
												),
												'Foodbox_tangerine' => array(
													'preset_name' => esc_html__( 'Tangerine', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#efb828,template_bgcolor:#fdf7e7,template_ftcolor:#171101,template_fthovercolor:#473505,template_titlecolor:#473505,template_titlehovercolor:#efb828,template_titlebackcolor:#fdf7e7,template_contentcolor:#171101,template_readmorecolor:#fdf7e7,template_readmorebackcolor:#171101,template_readmore_hover_backcolor:#efb828,beforeloop_readmorecolor:#fdf7e7,beforeloop_readmorebackcolor:#171101,beforeloop_readmorehovercolor:#fdf7e7,beforeloop_readmorehoverbackcolor:#efb828,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#473505,bdp_pricetextcolor:#171101,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#888888,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#473505,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#473505',
													'display_value' => '#f8df9f,#efb828,#473505,#171101',
												),
												'foodbox_rich-gold' => array(
													'preset_name' => esc_html__( 'Rich Gold', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#A95624,template_bgcolor:#ffd1b6,template_ftcolor:#444444,template_fthovercolor:#A95624,template_titlecolor:#A95624,template_titlehovercolor:#BA7850,template_titlebackcolor:#ffd1b6,template_contentcolor:#444444,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#A95624,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#BA7850,beforeloop_readmorehovercolor:#BA7850,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#A95624,bdp_sale_tagtextcolor:#f1f1f1,bdp_star_rating_color:#444444,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#BA7850,bdp_wishlist_textcolor:#f1f1f1,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#f1f1f1,bdp_wishlist_hover_backgroundcolor:#BA7850,bdp_addtocart_textcolor:#f1f1f1,bdp_addtocart_backgroundcolor:#A95624,bdp_addtocart_text_hover_color:#f1f1f1,bdp_addtocart_hover_backgroundcolor:#444444',
													'display_value' => '#BA7850,#A95624,#555555,#444444',
												),
											),
											'neaty_block'  => array(
												'neaty_block_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#c4e2f7,template_ftcolor:#444444,template_fthovercolor:#000000,template_titlecolor:#444444,template_titlehovercolor:#000000,template_readmorecolor:#ffffff,template_readmorebackcolor:#444444,template_contentcolor:#444444,
                                                    template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#444444,beforeloop_readmorehoverbackcolor:#000000',
													'display_value' => '#444444,#000000,#444444,#000000',
												),
												'neaty_block_roof_terracotta' => array(
													'preset_name' => esc_html__( 'Roof Terracotta', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#B06F6D,template_bgcolor:#ffffff,template_bghovercolor:#F1E7E7,template_ftcolor:#555555,template_fthovercolor:#B06F6D,template_titlecolor:#9C4B48,template_titlehovercolor:#B06F6D,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#B06F6D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#B06F6D,beforeloop_readmorehovercolor:#B06F6D,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#B06F6D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#B06F6D,bdp_pricetextcolor:#999999,bdp_wishlist_textcolor:#B06F6D,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#B06F6D,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#B06F6D,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#9C4B48,#B06F6D,#555555,#999999',
												),
												'neaty_block_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#414C22,#67704E,#555555,#999999',
												),
												'offer_yonder' => array(
													'preset_name' => esc_html__( 'Yonder', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F3F5FA,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F3F5FA,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#6E8CC2,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#6E8CC2,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#8BA3CE,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6E8CC2,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#666666',
													'display_value' => '#6E8CC2,#8BA3CE,#555555,#666666',
												),
											),
											'wise_block'   => array(
												'wise_block_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#444444,template_bgcolor:#c4e2f7,template_ftcolor:#444444,template_fthovercolor:#000000,template_titlecolor:#444444,template_titlehovercolor:#000000,template_readmorecolor:#ffffff,template_readmorebackcolor:#444444,template_contentcolor:#444444,
                                                    template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#444444,beforeloop_readmorehoverbackcolor:#000000',
													'display_value' => '#444444,#000000,#444444,#000000',
												),
												'wise_block_goldenrod' => array(
													'preset_name' => esc_html__( 'Goldenrod', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F4EDDD,template_ftcolor:#3A2A02,template_fthovercolor:#5B4204,template_titlecolor:#5B4204,template_titlehovercolor:#3A2A02,template_titlebackcolor:#ffffff,template_contentcolor:#5B4204,template_readmorecolor:#B28007,template_readmorebackcolor:#F4EDDD,template_readmore_hover_backcolor:#D7BD81,beforeloop_readmorecolor:#B28007,beforeloop_readmorebackcolor:#F4EDDD,beforeloop_readmorehovercolor:#B28007,beforeloop_readmorehoverbackcolor:#D7BD81,bdp_sale_tagbgcolor:#3A2A02,bdp_sale_tagtextcolor:#F4EDDD,bdp_star_rating_color:#5B4204,bdp_star_rating_bg_color:#B28007,bdp_pricetextcolor:#F4EDDD,bdp_wishlist_textcolor:#F4EDDD,bdp_wishlist_backgroundcolor:#3A2A02,bdp_wishlist_text_hover_color:#F4EDDD, bdp_wishlist_hover_backgroundcolor:#5B4204,bdp_addtocart_textcolor:#F4EDDD,bdp_addtocart_backgroundcolor:#B28007,bdp_addtocart_text_hover_color:#F4EDDD,bdp_addtocart_hover_backgroundcolor:#5B4204',
													'display_value' => '#F4EDDD,#B28007,#5B4204,#3A2A02',
												),
												'wise_block_salem' => array(
													'preset_name' => esc_html__( 'Salem', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#e8f3ed,template_bgcolor:#e8f3ed,template_ftcolor:#198c4b,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#198c4b,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#198c4b,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#198c4b,bdp_sale_tagbgcolor:#198c4b,bdp_sale_tagtextcolor:#e8f3ed,bdp_star_rating_color:#666666,bdp_star_rating_bg_color:#198c4b,bdp_pricetextcolor:#333333,bdp_wishlist_textcolor:#e8f3ed,bdp_wishlist_backgroundcolor:#198c4b,bdp_wishlist_text_hover_color:#e8f3ed,bdp_wishlist_hover_backgroundcolor:#666666,bdp_addtocart_textcolor:#e8f3ed,bdp_addtocart_backgroundcolor:#333333,bdp_addtocart_text_hover_color:#e8f3ed,bdp_addtocart_hover_backgroundcolor:#198c4b',
													'display_value' => '#e8f3ed,#198c4b,#333333,#666666',
												),
												'wise_block_prussian' => array(
													'preset_name' => esc_html__( 'Prussian', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#99a8ba,template_bgcolor:#e5e9ed,template_ftcolor:#000308,template_fthovercolor:#000b19,template_titlecolor:#193b65,template_titlehovercolor:#000b19,template_titlebackcolor:,template_contentcolor:#000308,template_readmorecolor:#e5e9ed,template_readmorebackcolor:#000308,template_readmore_hover_backcolor:#193b65,beforeloop_readmorecolor:#e5e9ed,beforeloop_readmorebackcolor:#000308,beforeloop_readmorehovercolor:#e5e9ed,beforeloop_readmorehoverbackcolor:#193b65,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#193b65,bdp_pricetextcolor:#000308,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000b19,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#193b65,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000308',
													'display_value' => '#99a8ba,#193b65,#000b19,#000308',
												),
												'wise_block_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EAE1E7,template_ftcolor:#35122A,template_fthovercolor:#220B1B,template_titlecolor:#35122A,template_titlehovercolor:#662451,template_contentcolor:#EAE1E7,template_contentcolor:#35122A,template_readmorecolor:#EAE1E7,template_readmorebackcolor:#662451,template_readmore_hover_backcolor:#35122A,beforeloop_readmorecolor:#EAE1E7,beforeloop_readmorebackcolor:#662451,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#35122A,bdp_sale_tagbgcolor:#662451,bdp_sale_tagtextcolor:#EAE1E7,bdp_star_rating_color:#35122A,bdp_star_rating_bg_color:#220B1B,bdp_pricetextcolor:#35122A,bdp_wishlist_textcolor:#EAE1E7,bdp_wishlist_backgroundcolor:#35122A,bdp_wishlist_text_hover_color:#EAE1E7,bdp_wishlist_hover_backgroundcolor:#662451,bdp_addtocart_textcolor:#EAE1E7,bdp_addtocart_backgroundcolor:#662451,bdp_addtocart_text_hover_color:#EAE1E7,bdp_addtocart_hover_backgroundcolor:#220B1B',
													'display_value' => '#EAE1E7,#662451,#220B1B,#35122A',
												),
												'wise_block_go_ben' => array(
													'preset_name' => esc_html__( 'Go Ben', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EDECE7,template_ftcolor:#3E3B25,template_fthovercolor:#282618,template_titlecolor:#3E3B25,template_titlehovercolor:#787449,template_contentcolor:#EDECE7,template_contentcolor:#3E3B25,template_readmorecolor:#EDECE7,template_readmorebackcolor:#787449,template_readmore_hover_backcolor:#3E3B25,beforeloop_readmorecolor:#EDECE7,beforeloop_readmorebackcolor:#787449,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#3E3B25,bdp_sale_tagbgcolor:#787449,bdp_sale_tagtextcolor:#EDECE7,bdp_star_rating_color:#3E3B25,bdp_star_rating_bg_color:#282618,bdp_pricetextcolor:#3E3B25,bdp_wishlist_textcolor:#EDECE7,bdp_wishlist_backgroundcolor:#3E3B25,bdp_wishlist_text_hover_color:#EDECE7,bdp_wishlist_hover_backgroundcolor:#787449,bdp_addtocart_textcolor:#EDECE7,bdp_addtocart_backgroundcolor:#787449,bdp_addtocart_text_hover_color:#EDECE7,bdp_addtocart_hover_backgroundcolor:#282618',
													'display_value' => '#EDECE7,#787449,#282618,#3E3B25',
												),
											),
											'soft_block'   => array(
												'soft_block_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#444444,template_bgcolor:#f7f4ef,template_ftcolor:#444444,template_fthovercolor:#444444,template_titlecolor:#444444,template_titlehovercolor:#ece0e0,template_readmorecolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#444444,beforeloop_readmorehoverbackcolor:#000000,template_bgcolor1:#4fbfc1,template_bgcolor2:#508FC4,template_bgcolor3:#F47882,template_bgcolor4:#F0CF80,template_bgcolor5:#75C77D,template_bgcolor6:#76ABD5',
													'display_value' => '#444444,#000000,#ece0e0,#ffffff',
												),
												'soft_block_lochmara' => array(
													'preset_name' => esc_html__( 'Lochmara', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F7FAFC,template_ftcolor:#227CAD,template_fthovercolor:#0E3246,template_titlecolor:#F7FAFC,template_titlehovercolor:#227CAD,template_contentcolor:#F7FAFC,template_readmorecolor:#F7FAFC,template_readmorebackcolor:#227CAD,template_readmore_hover_backcolor:#0E3246,beforeloop_readmorecolor:#F7FAFC,beforeloop_readmorebackcolor:#227CAD,beforeloop_readmorehovercolor:#F7FAFC,beforeloop_readmorehoverbackcolor:#0E3246,bdp_sale_tagbgcolor:#227CAD,bdp_sale_tagtextcolor:#F7FAFC,bdp_star_rating_color:#09202D,bdp_star_rating_bg_color:#051117,bdp_pricetextcolor:#051117,bdp_wishlist_textcolor:#F7FAFC,bdp_wishlist_backgroundcolor:#051117,bdp_wishlist_text_hover_color:#F7FAFC,bdp_wishlist_hover_backgroundcolor:#227CAD,bdp_addtocart_textcolor:#F7FAFC,bdp_addtocart_backgroundcolor:#227CAD,bdp_addtocart_text_hover_color:#F7FAFC,bdp_addtocart_hover_backgroundcolor:#051117',
													'display_value' => '#F7FAFC,#227CAD,#051117,#09202D',
												),
												'soft_block_burgundy' => array(
													'preset_name' => esc_html__( 'Burgundy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF6F7,template_ftcolor:#6C0124,template_fthovercolor:#2C010E,template_titlecolor:#FAF6F7,template_titlehovercolor:#6C0124,template_contentcolor:#FAF6F7,template_readmorecolor:#FAF6F7,template_readmorebackcolor:#6C0124,template_readmore_hover_backcolor:#2C010E,beforeloop_readmorecolor:#FAF6F7,beforeloop_readmorebackcolor:#6C0124,beforeloop_readmorehovercolor:#FAF6F7,beforeloop_readmorehoverbackcolor:#2C010E,bdp_sale_tagbgcolor:#6C0124,bdp_sale_tagtextcolor:#FAF6F7,bdp_star_rating_color:#1C0109,bdp_star_rating_bg_color:#0E0105,bdp_pricetextcolor:#0E0105,bdp_wishlist_textcolor:#FAF6F7,bdp_wishlist_backgroundcolor:#0E0105,bdp_wishlist_text_hover_color:#FAF6F7,bdp_wishlist_hover_backgroundcolor:#6C0124,bdp_addtocart_textcolor:#FAF6F7,bdp_addtocart_backgroundcolor:#6C0124,bdp_addtocart_text_hover_color:#FAF6F7,bdp_addtocart_hover_backgroundcolor:#0E0105',
													'display_value' => '#FAF6F7,#6C0124,#0E0105,#1C0109',
												),
												'soft_block_hillary' => array(
													'preset_name' => esc_html__( 'Hillary', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCFBFA,template_ftcolor:#A49E77,template_fthovercolor:#434131,template_titlecolor:#FCFBFA,template_titlehovercolor:#A49E77,template_contentcolor:#FCFBFA,template_readmorecolor:#FCFBFA,template_readmorebackcolor:#A49E77,template_readmore_hover_backcolor:#434131,beforeloop_readmorecolor:#FCFBFA,beforeloop_readmorebackcolor:#A49E77,beforeloop_readmorehovercolor:#FCFBFA,beforeloop_readmorehoverbackcolor:#434131,bdp_sale_tagbgcolor:#A49E77,bdp_sale_tagtextcolor:#FCFBFA,bdp_star_rating_color:#2B2A1F,bdp_star_rating_bg_color:#161610,bdp_pricetextcolor:#161610,bdp_wishlist_textcolor:#FCFBFA,bdp_wishlist_backgroundcolor:#161610,bdp_wishlist_text_hover_color:#FCFBFA,bdp_wishlist_hover_backgroundcolor:#A49E77,bdp_addtocart_textcolor:#FCFBFA,bdp_addtocart_backgroundcolor:#A49E77,bdp_addtocart_text_hover_color:#FCFBFA,bdp_addtocart_hover_backgroundcolor:#161610',
													'display_value' => '#FCFBFA,#A49E77,#161610,#2B2A1F',
												),
												'soft_block_amaranth' => array(
													'preset_name' => esc_html__( 'Amaranth', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FDF9FA,template_ftcolor:#DE364A,template_fthovercolor:#491218,template_titlecolor:#FDF9FA,template_titlehovercolor:#DE364A,template_contentcolor:#FDF9FA,template_readmorecolor:#FDF9FA,template_readmorebackcolor:#DE364A,template_readmore_hover_backcolor:#491218,beforeloop_readmorecolor:#FDF9FA,beforeloop_readmorebackcolor:#DE364A,beforeloop_readmorehovercolor:#FDF9FA,beforeloop_readmorehoverbackcolor:#491218,bdp_sale_tagbgcolor:#DE364A,bdp_sale_tagtextcolor:#FDF9FA,bdp_star_rating_color:#2E0B0F,bdp_star_rating_bg_color:#1E070A,bdp_pricetextcolor:#1E070A,bdp_wishlist_textcolor:#FDF9FA,bdp_wishlist_backgroundcolor:#1E070A,bdp_wishlist_text_hover_color:#FDF9FA,bdp_wishlist_hover_backgroundcolor:#DE364A,bdp_addtocart_textcolor:#FDF9FA,bdp_addtocart_backgroundcolor:#DE364A,bdp_addtocart_text_hover_color:#FDF9FA,bdp_addtocart_hover_backgroundcolor:#1E070A',
													'display_value' => '#FDF9FA,#DE364A,#1E070A,#2E0B0F',
												),
												'soft_block_manatee' => array(
													'preset_name' => esc_html__( 'Manatee', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCFCFD,template_ftcolor:#9699A7,template_fthovercolor:#3E3E45,template_titlecolor:#FCFCFD,template_titlehovercolor:#9699A7,template_titlebackcolor:#FCFCFD,template_contentcolor:#FCFCFD,template_readmorecolor:#FCFCFD,template_readmorebackcolor:#9699A7,template_readmore_hover_backcolor:#3E3E45,beforeloop_readmorecolor:#FCFCFD,beforeloop_readmorebackcolor:#9699A7,beforeloop_readmorehovercolor:#FCFCFD,beforeloop_readmorehoverbackcolor:#3E3E45,bdp_sale_tagbgcolor:#DE364A,bdp_sale_tagtextcolor:#FCFCFD,bdp_star_rating_color:#9699A7,bdp_star_rating_bg_color:#151516,bdp_pricetextcolor:#151516,bdp_wishlist_textcolor:#FCFCFD,bdp_wishlist_backgroundcolor:#151516,bdp_wishlist_text_hover_color:#FCFCFD,bdp_wishlist_hover_backgroundcolor:#9699A7,bdp_addtocart_textcolor:#FCFCFD,bdp_addtocart_backgroundcolor:#9699A7,bdp_addtocart_text_hover_color:#FCFCFD,bdp_addtocart_hover_backgroundcolor:#151516',
													'display_value' => '#FCFCFD,#9699A7,#151516,#28282C',
												),
											),
											'schedule'     => array(
												'schedule_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#e21130,template_bgcolor:#ffffff,template_ftcolor:#a5a5a5,template_fthovercolor:#123123,template_titlecolor:#444444,,template_titlebackcolor:#ffffff,template_titlehovercolor:#123123,template_readmorecolor:#ffffff,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#444444,beforeloop_readmorehoverbackcolor:#000000,winter_category_color:#a5a5a5',
													'display_value' => '#444444,#000000,#333333,#ffffff',
												),
												'schedule_radical' => array(
													'preset_name' => esc_html__( 'Radical', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#7C242C,template_bgcolor:#FDE7E9,template_ftcolor:#F9A1A9,template_fthovercolor:#7C242C,template_titlecolor:#F34656,template_titlehovercolor:#4F171C,template_titlebackcolor:#FDE7E9,template_contentcolor:#7C242C,template_readmorecolor:#F34656,template_readmorebackcolor:#FDE7E9,template_readmore_hover_backcolor:#F9A1A9,beforeloop_readmorecolor:#F34656,beforeloop_readmorebackcolor:#FDE7E9,beforeloop_readmorehovercolor:#F34656,beforeloop_readmorehoverbackcolor:#F9A1A9,bdp_sale_tagbgcolor:#4F171C,bdp_sale_tagtextcolor:#FDE7E9,bdp_star_rating_color:#7C242C,bdp_star_rating_bg_color:#F34656,bdp_pricetextcolor:#FDE7E9,bdp_wishlist_textcolor:#FDE7E9,bdp_wishlist_backgroundcolor:#4F171C,bdp_wishlist_text_hover_color:#FDE7E9,bdp_wishlist_hover_backgroundcolor:#7C242C,bdp_addtocart_textcolor:#FDE7E9,bdp_addtocart_backgroundcolor:#F34656,bdp_addtocart_text_hover_color:#FDE7E9,bdp_addtocart_hover_backgroundcolor:#7C242C,
                                                        winter_category_color:#7C242C',
													'display_value' => '#FDE7E9,#F34656,#7C242C,#4F171C',
												),
												'schedule_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#465BAC,template_bgcolor:#EAEDF6,template_ftcolor:#465BAC,template_fthovercolor:#ffffff,template_titlecolor:#465BAC,template_titlehovercolor:#484848,template_titlebackcolor:#eaedf6,template_contentcolor:#7b7b7b,template_readmorecolor:#465BAC,template_readmorebackcolor:#EAEDF6,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#465BAC,bdp_pricetextcolor:#484848,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#484848,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#484848,winter_category_color:#465BAC',
													'display_value' => '#465BAC,#EAEDF6,#465BAC,#484848',
												),
												'schedule_flamenco' => array(
													'preset_name' => esc_html__( 'Flamenco', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#683C6F,template_bgcolor:#FFF3ED,template_ftcolor:#683C6F,template_fthovercolor:#ffffff,template_titlecolor:#683C6F,template_titlehovercolor:#484848,template_titlebackcolor:#FFF3ED,template_contentcolor:#7b7b7b,template_readmorecolor:#683C6F,template_readmorebackcolor:#FFF3ED,bdp_sale_tagbgcolor:#683C6F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#683C6F,
                                                        bdp_wishlist_textcolor:#683C6F,bdp_wishlist_backgroundcolor:#FFF3ED,bdp_wishlist_text_hover_color:#FFF3ED,bdp_wishlist_hover_backgroundcolor:#683C6F,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#683C6F,bdp_addtocart_text_hover_color:#683C6F,bdp_addtocart_hover_backgroundcolor:#FFF3ED,
                                                        winter_category_color:#683C6F',
													'display_value' => '#683C6F,#FFF3ED,#683C6F,#484848',
												),
												'schedule_finch' => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#75815B,template_bgcolor:#EFF0EB,template_ftcolor:#75815B,template_fthovercolor:#ffffff,template_titlecolor:#75815B,template_titlehovercolor:#484848,template_titlebackcolor:#EFF0EB,template_contentcolor:#7b7b7b,template_readmorecolor:#75815B,template_readmorebackcolor:#EFF0EB,bdp_sale_tagbgcolor:#75815B,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#7b7b7b,bdp_star_rating_bg_color:#75815B,
                                                        bdp_wishlist_textcolor:#75815B,bdp_wishlist_backgroundcolor:#EFF0EB,bdp_wishlist_text_hover_color:#EFF0EB,bdp_wishlist_hover_backgroundcolor:#75815B,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75815B,bdp_addtocart_text_hover_color:#75815B,bdp_addtocart_hover_backgroundcolor:#EFF0EB,winter_category_color:#75815B',
													'display_value' => '#75815B,#EFF0EB,#75815B,#484848',
												),
											),
											'quci'         => array(
												'quci_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#3fd39d,template_fthovercolor:#3fd39d,template_titlecolor:#222222,template_titlehovercolor:#3fd39d,template_titlebackcolor:#ffffff,template_contentcolor:#555555,template_content_hovercolor:#E84159,template_readmorecolor:#3fd39d,template_readmorebackcolor:#E84159,beforeloop_readmorecolor:#3fd39d,beforeloop_readmorebackcolor:#ffffff,beforeloop_readmorehovercolor:#3fd39d,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#E84159,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#222222,bdp_edd_price_color:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#222222,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#E84159,bdp_edd_addtocart_backgroundcolor:#E84159,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999,bdp_edd_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#3fd39d,#222222,#555555,#999999',
												),
												'quci_madras' => array(
													'preset_name' => esc_html__( 'Madras', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D6145,template_titlecolor:#493917,template_titlehovercolor:#6D6145,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#6D6145,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D6145,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D6145,beforeloop_readmorehovercolor:#6D6145,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#493917,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#6D6145,bdp_edd_price_color:#6D6145,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#6D6145,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#493917,bdp_edd_addtocart_backgroundcolor:#493917,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999,bdp_edd_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#493917,#6D6145,#555555,#999999',
												),
												'quci_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#974772,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#7D194F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#974772,bdp_edd_price_color:#974772,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#974772,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#7D194F,bdp_edd_addtocart_backgroundcolor:#7D194F,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999,bdp_edd_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#7D194F,#974772,#555555,#999999',
												),
												'quci_bronzetone' => array(
													'preset_name' => esc_html__( 'Bronzetone', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#6D6145,template_titlebackcolor:#E5E7E1,template_contentcolor:#999999,template_content_hovercolor:#67704E,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#414C22,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#67704E,bdp_edd_price_color:#67704E,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#67704E,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#414C22,bdp_edd_addtocart_backgroundcolor:#414C22,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999,bdp_edd_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#414C22,#67704E,#555555,#999999',
												),
												'quci_peru_tan' => array(
													'preset_name' => esc_html__( 'Peru Tan', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#EDE5E1,template_ftcolor:#555555,template_fthovercolor:#916748,template_titlecolor:#75411A,template_titlehovercolor:#916748,template_titlebackcolor:#EDE5E1,template_contentcolor:#999999,template_content_hovercolor:#916748,template_readmorecolor:#ffffff,template_readmorebackcolor:#916748,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#916748,beforeloop_readmorehovercolor:#916748,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#75411A,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#916748,bdp_edd_price_color:#916748,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#916748,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#75411A,bdp_edd_addtocart_backgroundcolor:#75411A,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999,bdp_edd_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#75411A,#916748,#555555,#999999',
												),
												'quci_buttercup' => array(
													'preset_name' => esc_html__( 'Buttercup', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#999999,template_content_hovercolor:#E5A452,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#DF8D27,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#555555,bdp_pricetextcolor:#E5A452,bdp_edd_price_color:#E5A452,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#E5A452,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#DF8D27,bdp_edd_addtocart_backgroundcolor:#DF8D27,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#999999,bdp_edd_addtocart_hover_backgroundcolor:#999999',
													'display_value' => '#DF8D27,#E5A452,#555555,#999999',
												),
											),
											'pedal'        => array(
												'pedal_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#333333,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#33cb7d,template_readmore_hover_backcolor:#33cb7d,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#62bf7c,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#686868,bdp_sale_tagbgcolor:#62bf7c,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#252525,bdp_star_rating_bg_color:#353535,bdp_pricetextcolor:#353535,bdp_edd_price_color:#353535,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#353535,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#62bf7c,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#62bf7c,bdp_edd_addtocart_backgroundcolor:#62bf7c,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#353535,bdp_edd_addtocart_hover_backgroundcolor:#353535',
													'display_value' => '#ffffff,#33cb7d,#222222,#333333',
												),
												'pedal_lochmara' => array(
													'preset_name' => esc_html__( 'Lochmara', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#F7FAFC,template_ftcolor:#227CAD,template_fthovercolor:#0E3246,template_titlecolor:#051117,template_titlehovercolor:#227CAD,template_titlebackcolor:#F7FAFC,template_contentcolor:#09202D,template_readmorecolor:#F7FAFC,template_readmorebackcolor:#227CAD,template_readmore_hover_backcolor:#0E3246,beforeloop_readmorecolor:#F7FAFC,beforeloop_readmorebackcolor:#227CAD,beforeloop_readmorehovercolor:#F7FAFC,beforeloop_readmorehoverbackcolor:#0E3246,bdp_sale_tagbgcolor:#227CAD,bdp_sale_tagtextcolor:#F7FAFC,bdp_star_rating_color:#09202D,bdp_star_rating_bg_color:#051117,bdp_pricetextcolor:#051117,bdp_edd_price_color:#051117,bdp_wishlist_textcolor:#F7FAFC,bdp_wishlist_backgroundcolor:#051117,bdp_wishlist_text_hover_color:#F7FAFC,bdp_wishlist_hover_backgroundcolor:#227CAD,bdp_addtocart_textcolor:#F7FAFC,bdp_edd_addtocart_textcolor:#F7FAFC,bdp_addtocart_backgroundcolor:#227CAD,bdp_edd_addtocart_backgroundcolor:#227CAD,bdp_addtocart_text_hover_color:#F7FAFC,bdp_edd_addtocart_text_hover_color:#F7FAFC,bdp_addtocart_hover_backgroundcolor:#051117,bdp_edd_addtocart_hover_backgroundcolor:#051117',
													'display_value' => '#F7FAFC,#227CAD,#051117,#09202D',
												),
												'pedal_burgundy' => array(
													'preset_name' => esc_html__( 'Burgundy', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FAF6F7,template_ftcolor:#6C0124,template_fthovercolor:#2C010E,template_titlecolor:#0E0105,template_titlehovercolor:#6C0124,template_titlebackcolor:#FAF6F7,template_contentcolor:#1C0109,template_readmorecolor:#FAF6F7,template_readmorebackcolor:#6C0124,template_readmore_hover_backcolor:#2C010E,beforeloop_readmorecolor:#FAF6F7,beforeloop_readmorebackcolor:#6C0124,beforeloop_readmorehovercolor:#FAF6F7,beforeloop_readmorehoverbackcolor:#2C010E,bdp_sale_tagbgcolor:#6C0124,bdp_sale_tagtextcolor:#FAF6F7,bdp_star_rating_color:#1C0109,bdp_star_rating_bg_color:#0E0105,bdp_pricetextcolor:#0E0105,bdp_edd_price_color:#0E0105,bdp_wishlist_textcolor:#FAF6F7,bdp_wishlist_backgroundcolor:#0E0105,bdp_wishlist_text_hover_color:#FAF6F7,bdp_wishlist_hover_backgroundcolor:#6C0124,bdp_addtocart_textcolor:#FAF6F7,bdp_edd_addtocart_textcolor:#FAF6F7,bdp_addtocart_backgroundcolor:#6C0124,bdp_edd_addtocart_backgroundcolor:#6C0124,bdp_addtocart_text_hover_color:#FAF6F7,bdp_edd_addtocart_text_hover_color:#FAF6F7,bdp_addtocart_hover_backgroundcolor:#0E0105,bdp_edd_addtocart_hover_backgroundcolor:#0E0105',
													'display_value' => '#FAF6F7,#6C0124,#0E0105,#1C0109',
												),
												'pedal_hillary' => array(
													'preset_name' => esc_html__( 'Hillary', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCFBFA,template_ftcolor:#A49E77,template_fthovercolor:#434131,template_titlecolor:#161610,template_titlehovercolor:#A49E77,template_titlebackcolor:#FCFBFA,template_contentcolor:#2B2A1F,template_readmorecolor:#FCFBFA,template_readmorebackcolor:#A49E77,template_readmore_hover_backcolor:#434131,beforeloop_readmorecolor:#FCFBFA,beforeloop_readmorebackcolor:#A49E77,beforeloop_readmorehovercolor:#FCFBFA,beforeloop_readmorehoverbackcolor:#434131,bdp_sale_tagbgcolor:#A49E77,bdp_sale_tagtextcolor:#FCFBFA,bdp_star_rating_color:#2B2A1F,bdp_star_rating_bg_color:#161610,bdp_pricetextcolor:#161610,bdp_edd_price_color:#161610,bdp_wishlist_textcolor:#FCFBFA,bdp_wishlist_backgroundcolor:#161610,bdp_wishlist_text_hover_color:#FCFBFA,bdp_wishlist_hover_backgroundcolor:#A49E77,bdp_addtocart_textcolor:#FCFBFA,bdp_edd_addtocart_textcolor:#FCFBFA,bdp_addtocart_backgroundcolor:#A49E77,bdp_edd_addtocart_backgroundcolor:#A49E77,bdp_addtocart_text_hover_color:#FCFBFA,bdp_edd_addtocart_text_hover_color:#FCFBFA,bdp_addtocart_hover_backgroundcolor:#161610,bdp_edd_addtocart_hover_backgroundcolor:#161610',
													'display_value' => '#FCFBFA,#A49E77,#161610,#2B2A1F',
												),
												'pedal_amaranth' => array(
													'preset_name' => esc_html__( 'Amaranth', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FDF9FA,template_ftcolor:#DE364A,template_fthovercolor:#491218,template_titlecolor:#1E070A,template_titlehovercolor:#DE364A,template_titlebackcolor:#FDF9FA,template_contentcolor:#2E0B0F,template_readmorecolor:#FDF9FA,template_readmorebackcolor:#DE364A,template_readmore_hover_backcolor:#491218,beforeloop_readmorecolor:#FDF9FA,beforeloop_readmorebackcolor:#DE364A,beforeloop_readmorehovercolor:#FDF9FA,beforeloop_readmorehoverbackcolor:#491218,bdp_sale_tagbgcolor:#DE364A,bdp_sale_tagtextcolor:#FDF9FA,bdp_star_rating_color:#2E0B0F,bdp_star_rating_bg_color:#1E070A,bdp_pricetextcolor:#1E070A,bdp_edd_price_color:#1E070A,bdp_wishlist_textcolor:#FDF9FA,bdp_wishlist_backgroundcolor:#1E070A,bdp_wishlist_text_hover_color:#FDF9FA,bdp_wishlist_hover_backgroundcolor:#DE364A,bdp_addtocart_textcolor:#FDF9FA,bdp_edd_addtocart_textcolor:#FDF9FA,bdp_addtocart_backgroundcolor:#DE364A,bdp_edd_addtocart_backgroundcolor:#DE364A,bdp_addtocart_text_hover_color:#FDF9FA,bdp_edd_addtocart_text_hover_color:#FDF9FA,bdp_addtocart_hover_backgroundcolor:#1E070A,bdp_edd_addtocart_hover_backgroundcolor:#1E070A',
													'display_value' => '#FDF9FA,#DE364A,#1E070A,#2E0B0F',
												),
												'pedal_manatee' => array(
													'preset_name' => esc_html__( 'Manatee', 'blog-designer-pro' ),
													'preset_value' => 'template_bgcolor:#FCFCFD,template_ftcolor:#9699A7,template_fthovercolor:#3E3E45,template_titlecolor:#151516,template_titlehovercolor:#9699A7,template_titlebackcolor:#FCFCFD,template_contentcolor:#28282C,template_readmorecolor:#FCFCFD,template_readmorebackcolor:#9699A7,template_readmore_hover_backcolor:#3E3E45,beforeloop_readmorecolor:#FCFCFD,beforeloop_readmorebackcolor:#9699A7,beforeloop_readmorehovercolor:#FCFCFD,beforeloop_readmorehoverbackcolor:#3E3E45,bdp_sale_tagbgcolor:#DE364A,bdp_sale_tagtextcolor:#FCFCFD,bdp_star_rating_color:#9699A7,bdp_star_rating_bg_color:#151516,bdp_pricetextcolor:#151516,bdp_edd_price_color:#151516,bdp_wishlist_textcolor:#FCFCFD,bdp_wishlist_backgroundcolor:#151516,bdp_wishlist_text_hover_color:#FCFCFD,bdp_wishlist_hover_backgroundcolor:#9699A7,bdp_addtocart_textcolor:#FCFCFD,bdp_edd_addtocart_textcolor:#FCFCFD,bdp_addtocart_backgroundcolor:#9699A7,bdp_edd_addtocart_backgroundcolor:#9699A7,bdp_addtocart_text_hover_color:#FCFCFD,bdp_edd_addtocart_text_hover_color:#FCFCFD,bdp_addtocart_hover_backgroundcolor:#151516,bdp_edd_addtocart_hover_backgroundcolor:#151516',
													'display_value' => '#FCFCFD,#9699A7,#151516,#28282C',
												),
											),
											'threed_carousel' => array(
												'threed_carousel_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#15506F,template_bgcolor:#ffffff,template_bghovercolor:#DFEDF1,template_ftcolor:#15506F,template_fthovercolor:#555555,template_titlecolor:#15506F,template_titlehovercolor:#DFEDF1,template_contentcolor:#999999,template_readmorecolor:#15506F,template_readmorebackcolor:#15506F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#15506F,beforeloop_readmorehovercolor:#15506F,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#15506F,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#15506F,bdp_pricetextcolor:#999999,bdp_edd_price_color:#999999,bdp_wishlist_textcolor:#15506F,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#15506F,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#15506F,bdp_edd_addtocart_backgroundcolor:#15506F,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#15506F,#DFEDF1,#555555,#999999',
												),
												'threed_carousel_pompadour' => array(
													'preset_name' => esc_html__( 'Pompadour', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#974772,template_bgcolor:#ffffff,template_bghovercolor:#EDE1E7,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#974772,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#974772,bdp_pricetextcolor:#999999,bdp_edd_price_color:#999999,bdp_wishlist_textcolor:#974772,bdp_wishlist_backgroundcolor:#555555,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#974772,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#974772,bdp_edd_addtocart_backgroundcolor:#974772,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#7D194F,#974772,#555555,#999999',
												),
												'threed_carousel_mariner' => array(
													'preset_name' => esc_html__( 'Mariner', 'blog-designer-pro' ),
													'preset_value' => 'grid_hoverback_color:#465BAC,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#465BAC,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#465BAC,bdp_sale_tagbgcolor:#465BAC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#e0e0e0,bdp_star_rating_bg_color:#465BAC,bdp_pricetextcolor:#e0e0e0,bdp_edd_price_color:#e0e0e0,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#465BAC,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#465BAC,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#465BAC,bdp_edd_addtocart_backgroundcolor:#465BAC,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#465BAC,bdp_edd_addtocart_hover_backgroundcolor:#465BAC',
													'display_value' => '#465BAC,#e0e0e0,#ffffff,#e0e0e0',
												),
												'threed_carousel_finch'   => array(
													'preset_name' => esc_html__( 'Finch', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#93A564,template_bgcolor:#ffffff,template_bghovercolor:#EDEDE9,template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#93A564,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#999999,bdp_star_rating_bg_color:#93A564,bdp_pricetextcolor:#999999,bdp_edd_price_color:#999999,bdp_wishlist_textcolor:#93A564,bdp_wishlist_backgroundcolor:#EDEDE9,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#93A564,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#93A564,bdp_edd_addtocart_backgroundcolor:#93A564,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#788F3D,#93A564,#555555,#999999',
												),
											),
											'flip_book_3d' => array(
												'flip_book_3d_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#A49538,template_fthovercolor:#2b2b2b,template_titlecolor:#000000,template_titlehovercolor:#A49538,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#A49538,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A49538,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#A49538,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#000000,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#000000,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#A49538,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#A49538,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000000',
													'display_value' => '#A49538,#ffffff,#000000,#7b6b79',
												),
												'flip_book_3d_salt-box' => array(
													'preset_name' => esc_html__( 'Salt Box', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#60505e,template_fthovercolor:#333333,template_titlecolor:#60505e,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#60505e,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#60505e,beforeloop_readmorehovercolor:#60505e,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#60505e,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#60505e,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#60505e,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#60505e,#ffffff,#2b2b2b,#7b6b79',
												),
												'flip_book_3d_pacific_blue' => array(
													'preset_name' => esc_html__( 'Pacific Blue', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#0099CB,template_fthovercolor:#2b2b2b,template_titlecolor:#0099CB,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#0099CB,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#0099CB,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#0099CB,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#0099CB,#ffffff,#2b2b2b,#7b6b79',
												),
												'flip_book_3d_pacific_dark_orchid' => array(
													'preset_name' => esc_html__( 'Dark Orchid', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#9A33CC,template_fthovercolor:#2b2b2b,template_titlecolor:#9A33CC,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#9A33CC,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#9A33CC,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#9A33CC,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#9A33CC,#ffffff,#2b2b2b,#7b6b79',
												),
												'flip_book_3d_pacific_dark_orange' => array(
													'preset_name' => esc_html__( 'Dark Orange', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#FF8A00,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#FF8A00,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#FF8A00,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#FF8A00,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#FF8A00,#ffffff,#2b2b2b,#7b6b79',
												),
												'flip_book_3d_pacific_venetian_red' => array(
													'preset_name' => esc_html__( 'Venetian Red', 'blog-designer-pro' ),
													'preset_value' => 'template_ftcolor:#CC0001,template_fthovercolor:#2b2b2b,template_titlecolor:#CC0001,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#CC0001,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#2b2b2b,bdp_star_rating_bg_color:#7b6b79,bdp_pricetextcolor:#2b2b2b,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#7b6b79,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#CC0001,bdp_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#CC0001,bdp_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#2b2b2b',
													'display_value' => '#CC0001,#ffffff,#2b2b2b,#7b6b79',
												),
											),
											'banner'       => array(
												'banner_default' => array(
													'preset_name' => esc_html__( 'Default', 'blog-designer-pro' ),
													'preset_value' => '
													template_color:#102950,template_lazy_load_color:#FF0000,template_ftcolor:#3E91AD,template_fthovercolor:#555555,template_titlecolor:#FFFFFF,template_titlehovercolor:#3E91AD,template_readmorecolor:#FFFFFF,template_readmorebackcolor:#283f62,template_contentcolor:#FFFFFF,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#3E91AD,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#555555,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#222222,bdp_edd_price_color:#222222,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#555555,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#3E91AD,bdp_edd_addtocart_backgroundcolor:#3E91AD,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#222222,bdp_edd_addtocart_hover_backgroundcolor:#222222',
													'display_value' => '#3E91AD,#222222,#555555,#666666',
												),
												'banner_blackberry' => array(
													'preset_name' => esc_html__( 'Blackberry', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#6D4657,template_lazy_load_color:#FF0000,template_ftcolor:#FFFFFF,template_fthovercolor:#FFFFFF,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_readmorecolor:#FFFFFF,template_readmorebackcolor:#666666,template_contentcolor:#FFFFFF,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff,bdp_sale_tagbgcolor:#49182D,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#FFFFFF,bdp_star_rating_bg_color:#666666,bdp_pricetextcolor:#49182D,bdp_edd_price_color:#49182D,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#666666,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#49182D,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#6D4657,bdp_edd_addtocart_backgroundcolor:#6D4657,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#555555,bdp_edd_addtocart_hover_backgroundcolor:#555555',
													'display_value' => '#49182D,#6D4657,#555555,#666666',
												),
												'banner_prussian' => array(
													'preset_name' => esc_html__( 'Prussian', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#99a8ba,template_lazy_load_color:#FF0000,template_ftcolor:#000308,template_fthovercolor:#000b19,template_titlecolor:#e5e9ed,template_titlehovercolor:#99a8ba,template_titlebackcolor:,template_contentcolor:#000308,template_readmorecolor:#e5e9ed,template_readmorebackcolor:#000308,template_readmore_hover_backcolor:#193b65,beforeloop_readmorecolor:#e5e9ed,beforeloop_readmorebackcolor:#000308,beforeloop_readmorehovercolor:#e5e9ed,beforeloop_readmorehoverbackcolor:#193b65,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#193b65,bdp_pricetextcolor:#000308,bdp_edd_price_color:#000308,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#000b19,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#193b65,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_edd_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#000308,bdp_edd_addtocart_hover_backgroundcolor:#000308',
													'display_value' => '#99a8ba,#193b65,#000b19,#000308',
												),
												'banner_tangerine'   => array(
													'preset_name' => esc_html__( 'Tangerine', 'blog-designer-pro' ),
													'preset_value' => 'template_color:#f8df9f,template_lazy_load_color:#FF0000,template_ftcolor:#171101,template_fthovercolor:#473505,template_titlecolor:#fdf7e7,template_titlehovercolor:#f8df9f,template_titlebackcolor:,template_contentcolor:#171101,template_readmorecolor:#fdf7e7,template_readmorebackcolor:#171101,template_readmore_hover_backcolor:#efb828,beforeloop_readmorecolor:#fdf7e7,beforeloop_readmorebackcolor:#171101,beforeloop_readmorehovercolor:#fdf7e7,beforeloop_readmorehoverbackcolor:#efb828,bdp_sale_tagbgcolor:#171101,bdp_sale_tagtextcolor:#ffffff,bdp_star_rating_color:#171101,bdp_star_rating_bg_color:#473505,bdp_pricetextcolor:#171101,bdp_edd_price_color:#171101,bdp_wishlist_textcolor:#ffffff,bdp_wishlist_backgroundcolor:#888888,bdp_wishlist_text_hover_color:#ffffff,bdp_wishlist_hover_backgroundcolor:#473505,bdp_addtocart_textcolor:#ffffff,bdp_edd_addtocart_textcolor:#ffffff,bdp_addtocart_backgroundcolor:#171101,bdp_edd_addtocart_backgroundcolor:#171101,bdp_addtocart_text_hover_color:#ffffff,bdp_edd_addtocart_text_hover_color:#ffffff,bdp_addtocart_hover_backgroundcolor:#473505,bdp_edd_addtocart_hover_backgroundcolor:#473505',
													'display_value' => '#f8df9f,#efb828,#473505,#171101',
												),
											),

										);
										foreach ( $template_color_preset as $key => $single_template ) {
											?>
											<div class="controls_preset <?php echo esc_attr( $key ); ?>" style="display:none;">
												<?php foreach ( $single_template as $name => $value ) { ?>
													<div class="color-option preset
													<?php
													if ( $bdp_color_preset == $name ) {
														echo ' color_preset_selected';
													}
													?>
													" data-value="<?php echo esc_attr( $value['preset_value'] ); ?>">
														<label>
															<input class="of-radio-color" type="radio" name="bdp_color_preset" value="<?php echo esc_attr( $name ); ?>" <?php checked( $bdp_color_preset, $name ); ?>>
															<?php echo esc_html( $value['preset_name'] ); ?>
														</label>
														<?php
														Bdp_Utility::admin_color_preset( $value['display_value'] );
														?>
													</div>
													<?php
												}
												?>
											</div>
											<?php
										}
										?>
								</div>
							</li>

							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Archive Layout Name', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter archive layout name', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="archive_name" id="archive_name" value="<?php echo esc_attr( stripslashes( $archive_name ) ); ?>" placeholder="<?php esc_attr_e( 'Enter archive layout name', 'blog-designer-pro' ); ?>">
								</div>
							</li>
							<li class="display-layout_type">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Timeline Layout', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select timeline layout', 'blog-designer-pro' ); ?></span></span>
									<?php
									$bdp_timeline_layout = '';
									if ( isset( $bdp_settings['bdp_timeline_layout'] ) ) {
										$bdp_timeline_layout = $bdp_settings['bdp_timeline_layout'];
									}
									?>
									<select id="bdp_timeline_layout" name="bdp_timeline_layout">
										<option value="" <?php echo selected( '', $bdp_timeline_layout ); ?>><?php esc_html_e( 'Default Layout', 'blog-designer-pro' ); ?></option>
										<option value="left_side" <?php echo selected( 'left_side', $bdp_timeline_layout ); ?>><?php esc_html_e( 'Left Side', 'blog-designer-pro' ); ?></option>
										<option value="right_side" <?php echo selected( 'right_side', $bdp_timeline_layout ); ?>><?php esc_html_e( 'Right Side', 'blog-designer-pro' ); ?></option>
										<option value="center" <?php echo selected( 'center', $bdp_timeline_layout ); ?>><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
						   
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Archive Type', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select archive type for archive page design', 'blog-designer-pro' ); ?></span></span>
									<select name="custom_archive_type" id="custom_archive_type" >
																				<option value="category_template" 
										<?php
										if ( 'category_template' === $custom_archive_type ) {
											echo 'selected=selected';
										}
										?>
										><?php esc_html_e( 'Category', 'blog-designer-pro' ); ?></option>
										<option value="tag_template" 
										<?php
										if ( 'tag_template' === $custom_archive_type ) {
											echo 'selected=selected';
										}
										?>
										><?php esc_html_e( 'Tag', 'blog-designer-pro' ); ?></option>
									   
									</select>
								</div>
							</li>

							<li class="post-category">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Product Categories', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php esc_html_e( 'Filter product via category', 'blog-designer-pro' ); ?></span></span>
									<?php
										$categories       = get_terms(
											'product_cat',
											array(
												'child_of' => '',
												'hide_empty' => 1,
											)
										);
										$db_categories    = $wpdb->get_results( 'SELECT product_sub_categories FROM ' . $wpdb->prefix . 'bdp_product_archives WHERE product_archive_template = "category_template"' );
										$db_category_list = array();
										if ( $db_categories ) {
											foreach ( $db_categories as $db_category ) {
												$sub_list = $db_category->product_sub_categories;
												if ( $sub_list ) {
													$db_category_ids = explode( ',', $sub_list );
													foreach ( $db_category_ids as $db_category_id ) {
														$db_category_list[] = $db_category_id;
													}
												}
											}
										}
										$final_cat = array();
										if ( is_array( $template_category ) && ! empty( $template_category ) ) {
											$final_cat = array_diff( $db_category_list, $template_category );
										}
										?>
										<select data-placeholder="<?php esc_attr_e( 'Choose Product Categories', 'blog-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="template_category[]" id="template_category">
											<?php foreach ( $categories as $category_obj ) : ?>
												<option value="<?php echo esc_attr( $category_obj->term_id ); ?>" 
													<?php
													if ( in_array( $category_obj->term_id, $template_category ) ) {
														echo 'selected="selected"';
													} if ( in_array( $category_obj->term_id, $final_cat ) ) {
														echo 'disabled="disabled"';
													}
													?>
												><?php echo esc_html( $category_obj->name ); ?></option>
													<?php endforeach; ?>
										</select>
										<div class="bdp-setting-description bdp-note">
											<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>: </b>
											<?php esc_html_e( 'Select atleast one Category to display on Category archive page!', 'blog-designer-pro' ); ?>
										</div>
								</div>
							</li>

							<li class="post-tag">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Product Tags', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php esc_html_e( 'Filter product via tags', 'blog-designer-pro' ); ?></span></span>
									<?php
									$tags        = get_terms(
										'product_tag',
										array(
											'child_of'   => '',
											'hide_empty' => 1,
										)
									);
									$db_tags     = $wpdb->get_results( 'SELECT product_sub_categories FROM ' . $wpdb->prefix . 'bdp_product_archives WHERE product_archive_template = "tag_template"' );
									$db_tag_list = array();
									if ( $db_tags ) {
										foreach ( $db_tags as $db_tag ) {
											$sub_list = $db_tag->product_sub_categories;
											if ( $sub_list ) {
												$db_tag_ids = explode( ',', $sub_list );
												foreach ( $db_tag_ids as $db_tag_id ) {
													$db_tag_list[] = $db_tag_id;
												}
											}
										}
									}
									$final_tag = array();
									if ( is_array( $template_tags ) && ! empty( $template_tags ) ) {
										$final_tag = array_diff( $db_tag_list, $template_tags );
									}
									?>
									<select data-placeholder="<?php esc_attr_e( 'Choose Product Tags', 'blog-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="template_tags[]" id="template_tags">
										<?php foreach ( $tags as $tag ) : ?>
											<option value="<?php echo esc_attr( $tag->term_id ); ?>" 
												<?php
												if ( @in_array( $tag->term_id, $template_tags ) ) {
													echo 'selected="selected"';
												} if ( in_array( $tag->term_id, $final_tag ) ) {
													echo 'disabled="disabled"';
												}
												?>
											><?php echo esc_html( $tag->name ); ?></option>
										<?php endforeach; ?>
									</select>
									<div class="bdp-setting-description bdp-note">
										<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>: </b>
										<?php esc_html_e( 'Select atleast one Tag to display on Tag archive page.', 'blog-designer-pro' ); ?>
									</div>
								</div>
							</li>
							<li class="archive_blog_page_show">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Number of Products to Display', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter number of products to display per page', 'blog-designer-pro' ); ?></span></span>
									<input name="posts_per_page" type="number" step="1" min="1" id="posts_per_page" value="<?php echo esc_attr( $posts_per_page ); ?>" class="" onkeypress="return isNumberKey(event)" />
								</div>
							</li>
							<li class="bdp_display_tabbed_options">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Tabbed Layout', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select tabbed layout', 'blog-designer-pro' ); ?></span></span>
									<?php
									$bdp_tabbed_layout = 'left_side';
									if ( isset( $bdp_settings['bdp_tabbed_layout'] ) ) {
										$bdp_tabbed_layout = $bdp_settings['bdp_tabbed_layout'];
									}
									?>
									<select id="bdp_tabbed_layout" name="bdp_tabbed_layout">
										<option value="left_side" <?php echo selected( 'left_side', $bdp_tabbed_layout ); ?>><?php esc_html_e( 'Left Post And Right Posts List', 'blog-designer-pro' ); ?></option>
										<option value="right_side" <?php echo selected( 'right_side', $bdp_tabbed_layout ); ?>><?php esc_html_e( 'Right Post And Left Posts List', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="bdp_display_tabbed_filter">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Tabbed layout Filter by', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select tabbed layout filter for blog', 'blog-designer-pro' ); ?></span></span>
									<select id="archive_display_tabbed_filter_by" name="archive_display_tabbed_filter_by">
										<?php
										$display_tabbed_filter_by = 'category';
										if ( isset( $bdp_settings['archive_display_tabbed_filter_by'] ) ) {
											$display_tabbed_filter_by = $bdp_settings['archive_display_tabbed_filter_by'];
										}
										$custom_posttype = 'product';
										$taxonomy_names  = get_object_taxonomies( $custom_posttype, 'objects' );
										$taxonomy_names  = apply_filters( 'bdp_hide_taxonomies', $taxonomy_names );
										if ( ! empty( $taxonomy_names ) ) {
											foreach ( $taxonomy_names as $taxonomy_name ) {
												$terms = get_terms( $taxonomy_name->name, array( 'hide_empty' => false ) );
												if ( ! empty( $terms ) ) {
													?>
													<option value="<?php echo esc_attr( $taxonomy_name->name ); ?>" <?php echo selected( $taxonomy_name->name, $display_tabbed_filter_by ); ?>><?php echo esc_html( $taxonomy_name->label ); ?></option>
													<?php
												}
											}
										}
										?>
									</select>
								</div>
							</li> 
							<?php
							$custom_posttype = 'product';
							$terms           = get_terms( $display_tabbed_filter_by, array( 'hide_empty' => false ) );
							if ( ! empty( $terms ) ) {
								foreach ( $taxonomy_names as $taxonomy_name ) {
									if ( $taxonomy_name->name == $display_tabbed_filter_by ) {
										?>
										<li class="bdp_display_tabbed_filter_html">
											<div class="bdp-left">
												<span class="bdp-key-title">
													<?php echo esc_html__( 'Select tabbed layout', 'blog-designer-pro' ) . ' ' . esc_html( $taxonomy_name->label ); ?>
												</span>
											</div>
											<div class="bdp-right">
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php echo esc_html__( 'Filter post via', 'blog-designer-pro' ) . ' ' . esc_attr( $taxonomy_name->label ); ?></span></span>
												<select data-placeholder="Choose <?php echo esc_attr( $taxonomy_name->label ); ?>" multiple style="width:220px;" class="chosen-select custom_post_term" name="<?php echo esc_attr( $taxonomy_name->name ); ?>_tabbed_terms[]" id="terms_tabbed_<?php echo esc_attr( $taxonomy_name->name ); ?>" data-name="<?php echo esc_attr( $taxonomy_name->name ); ?>">
												<?php
												if( isset( $bdp_settings[ $taxonomy_name->name . '_tabbed_terms' ] ) ){
													$tax_count = count( $bdp_settings[ $taxonomy_name->name . '_tabbed_terms' ] );
												}
													foreach ( $terms as $term ) {
													?>
													<option 
													<?php
													if ( isset( $bdp_settings[ $taxonomy_name->name . '_tabbed_terms' ] ) ) {
														for ( $i = 0; $i < $tax_count; $i++ ) {
															if ( $term->name == $bdp_settings[ $taxonomy_name->name . '_tabbed_terms' ][ $i ] ) {
																echo 'selected=selected';
															}
														}
													}
													?>
													value="<?php echo esc_attr( $term->name ); ?>"><?php echo esc_html( $term->name ); ?></option>
												<?php } ?>
												</select>
											</div>
										</li>
										<?php
									}
								}
							}
							?>
							<h3 class="bdp-table-title"><?php esc_html_e( 'Display Settings', 'blog-designer-pro' ); ?></h3>
							<li class="bdp-display-settings">
								<div class="bdp-typography-wrapper bdp-button-settings">
									<?php
										$taxonomy_names = get_object_taxonomies( 'product', 'objects' );
										$taxonomy_names = apply_filters( 'bdp_hide_taxonomies', $taxonomy_names );
									if ( ! empty( $taxonomy_names ) ) {
										foreach ( $taxonomy_names as $taxonomy_name ) {
											if ( ! empty( $taxonomy_name ) ) {
												?>
												<div class="bdp-typography-cover display-custom-taxonomy">
													<div class="bdp-typography-label">
														<span class="bd-key-title">
														<?php echo esc_html( $taxonomy_name->label ); ?>
														</span>
														<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php echo esc_html__( 'Enable/Disable', 'blog-designer-pro' ) . ' ' . esc_html( $taxonomy_name->label ) . ' ' . esc_html__( 'in blog layout', 'blog-designer-pro' ); ?></span></span>
													</div>
													<div class="bdp-typography-content">
													<?php
													$_name              = 'display_taxonomy_' . $taxonomy_name->name;
													$display_custom_tax = isset( $bdp_settings[ $_name ] ) ? $bdp_settings[ $_name ] : 0;
													?>
														<fieldset class="bdp-social-options bdp-display_tax buttonset">
															<input id="<?php echo esc_attr( $_name ) . '_1'; ?>" name="<?php echo esc_attr( $_name ); ?>" type="radio" value="1" <?php echo checked( 1, $display_custom_tax ); ?>/>
															<label for="<?php echo esc_attr( $_name ) . '_1'; ?>"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
															<input id="<?php echo esc_attr( $_name ) . '_0'; ?>" name="<?php echo esc_attr( $_name ); ?>" type="radio" value="0" <?php echo checked( 0, $display_custom_tax ); ?> />
															<label for="<?php echo esc_attr( $_name ) . '_0'; ?>"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
														</fieldset>
														</label><label class="disable_link">
															<input id="disable_link_taxonomy_<?php echo esc_attr( $taxonomy_name->name ); ?>" name="disable_link_taxonomy_<?php echo esc_attr( $taxonomy_name->name ); ?>" type="checkbox" value="1" 
															<?php
															if ( isset( $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy_name->name ] ) ) {
																checked( 1, $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy_name->name ] );
															}
															?>
															/> <?php esc_html_e( 'Disable Link', 'blog-designer-pro' ); ?>
														</label>
													</div>
												</div>
												<?php
											}
										}
									}
									?>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bd-key-title">
												<?php esc_html_e( 'Product Author', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product author', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<fieldset class="buttonset">
												<input id="display_author_1" name="display_author" type="radio" value="1"  <?php checked( 1, $display_author ); ?>/>
												<label for="display_author_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="display_author_0" name="display_author" type="radio" value="0" <?php checked( 0, $display_author ); ?> />
												<label for="display_author_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
											<label class="disable_link">
												<input id="disable_link_author" name="disable_link_author" type="checkbox" value="1" 
												<?php
												if ( isset( $bdp_settings['disable_link_author'] ) ) {
													checked( 1, $bdp_settings['disable_link_author'] );
												}
												?>
												/> <?php esc_html_e( 'Disable Link for Author', 'blog-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="bdp-typography-cover bdp_archive_display_date">
										<div class="bdp-typography-label">
											<span class="bd-key-title">
												<?php esc_html_e( 'Product Publish Date', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product publish date', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-display_date buttonset buttonset-hide ui-buttonset" data-hide="1">
												<input id="display_date_1" name="display_date" type="radio" value="1" <?php checked( 1, $display_date ); ?> />
												<label for="display_date_1" <?php checked( 1, $display_date ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="display_date_0" name="display_date" type="radio" value="0" <?php checked( 0, $display_date ); ?> />
												<label for="display_date_0" <?php checked( 0, $display_date ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
											<label class="disable_link">
												<input id="disable_link_date" name="disable_link_date" type="checkbox" value="1" 
												<?php
												if ( isset( $bdp_settings['disable_link_date'] ) ) {
													checked( 1, $bdp_settings['disable_link_date'] );
												}
												?>
												/> <?php esc_html_e( 'Disable Link for Publish Date', 'blog-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="bdp-typography-cover display_comment">
										<div class="bdp-typography-label">
											<span class="bd-key-title">
												<?php esc_html_e( 'Product Comment Count', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product comment count', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-display_comment_count buttonset buttonset-hide ui-buttonset" data-hide="1">
												<input id="display_comment_count_1" name="display_comment_count" type="radio" value="1" <?php checked( 1, $display_comment_count ); ?> />
												<label for="display_comment_count_1" <?php checked( 1, $display_comment_count ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="display_comment_count_0" name="display_comment_count" type="radio" value="0" <?php checked( 0, $display_comment_count ); ?> />
												<label for="display_comment_count_0" <?php checked( 0, $display_comment_count ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
											<label class="disable_link">
												<input id="disable_link_comment" name="disable_link_comment" type="checkbox" value="1" 
												<?php
												if ( isset( $bdp_settings['disable_link_comment'] ) ) {
													checked( 1, $bdp_settings['disable_link_comment'] );
												}
												?>
												/> <?php esc_html_e( 'Disable Link', 'blog-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="bdp-typography-cover display-postlike">
										<div class="bdp-typography-label">
											<span class="bd-key-title">
												<?php esc_html_e( 'Product Like', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product like', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $display_postlike = isset( $bdp_settings['display_postlike'] ) ? $bdp_settings['display_postlike'] : '0'; ?>
											<fieldset class="buttonset">
												<input id="display_postlike_1" name="display_postlike" type="radio" value="1" <?php echo checked( 1, $display_postlike ); ?> />
												<label for="display_postlike_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="display_postlike_0" name="display_postlike" type="radio" value="0" <?php echo checked( 0, $display_postlike ); ?> />
												<label for="display_postlike_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover display_year">
										<div class="bdp-typography-label">
											<span class="bd-key-title">
												<?php esc_html_e( 'Product Published Year', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product published year', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-display_year buttonset buttonset-hide ui-buttonset" data-hide="1">
												<input id="display_story_year_1" name="display_story_year" type="radio" value="1" <?php checked( 1, $display_story_year ); ?> />
												<label for="display_story_year_1" <?php checked( 1, $display_story_year ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="display_story_year_0" name="display_story_year" type="radio" value="0" <?php checked( 0, $display_story_year ); ?> />
												<label for="display_story_year_0" <?php checked( 0, $display_story_year ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Custom CSS', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-textarea"><span class="bdp-tooltips"><?php esc_html_e( 'Write a "Custom CSS" to add your additional design for archive page', 'blog-designer-pro' ); ?></span></span>
									<?php
									echo '<textarea class="widefat textarea" name="custom_css" id="custom_css" placeholder=".class_name{ color:#ffffff }">';
									if ( isset( $bdp_settings['custom_css'] ) ) {
										echo esc_textarea( wp_unslash( $bdp_settings['custom_css'] ) );
									}
									echo '</textarea>';
									?>
									<div class="bdp-setting-description bdp-note">
										<b class=""><?php esc_html_e( 'Example', 'blog-designer-pro' ); ?>:</b>
										<?php echo '.class_name{ color:#ffffff }'; ?>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="dbptimeline" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $dbptimeline_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings">
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Timeline Bar', 'blog-designer-pro' ); ?>&nbsp;
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display timeline bar', 'blog-designer-pro' ); ?></span></span>
									<?php $display_timeline_bar = isset( $bdp_settings['display_timeline_bar'] ) ? $bdp_settings['display_timeline_bar'] : ''; ?>
									<fieldset class="bdp-social-options bdp-display_timeline_bar buttonset buttonset-hide ui-buttonset" data-hide="1">
										<input id="display_timeline_bar_0" name="display_timeline_bar" class="display_timeline_bar" type="radio" value="0" <?php checked( 0, $display_timeline_bar ); ?> />
										<label for="display_timeline_bar_0" <?php checked( 0, $display_timeline_bar ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_timeline_bar_1" name="display_timeline_bar" class="display_timeline_bar" type="radio" value="1" <?php checked( 1, $display_timeline_bar ); ?> />
										<label for="display_timeline_bar_1" <?php checked( 1, $display_timeline_bar ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Active Product', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right active_post_list">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product to start timeline layout with some specific product', 'blog-designer-pro' ); ?></span></span>
									<?php
									$timeline_start_from = '';
									if ( isset( $bdp_settings['timeline_start_from'] ) && '' != $bdp_settings['timeline_start_from'] ) {
										$timeline_start_from = $bdp_settings['timeline_start_from'];
									}
									if ( 'category_template' === $custom_archive_type ) {
										$taxonomy    = 'product_cat';
										$template_id = isset( $bdp_settings['template_category'] ) ? $bdp_settings['template_category'] : '';
									} elseif ( 'tag_template' === $custom_archive_type ) {
										$taxonomy    = 'product_tag';
										$template_id = isset( $bdp_settings['template_tags'] ) ? $bdp_settings['template_tags'] : '';
									}
									global $post;
									$args = array(
										'post_type'     => 'product',
										'cache_results' => false,
										'no_found_rows' => true,
										'fields'        => 'ids',
										'showposts'     => '-1',
										'post_status'   => 'publish',
									);
									if ( is_array( $template_id ) && '' != $template_id ) {
										if ( 'category_template' === $custom_archive_type || 'tag_template' === $custom_archive_type ) {
											$args['tax_query'] = array(
												array(
													'taxonomy' => $taxonomy,
													'field'    => 'term_id',
													'terms'    => $template_id,
												),
											);
										}
									}
									$bdp_timeline_the_query = get_posts( $args );
									if ( $bdp_timeline_the_query ) {
										?>
										<input type="hidden" value="<?php echo esc_attr( $timeline_start_from ); ?>" name="timeline_start_from_hidden" id="timeline_start_from_hidden">
										<?php
										echo '<select name="timeline_start_from" id="timeline_start_from">';
										foreach ( $bdp_timeline_the_query as $post ) {
											$post__id = get_the_ID();
											if ( get_the_date( 'd/m/Y', $post__id ) == $timeline_start_from ) {
												?>
												<option value="<?php echo esc_attr( get_the_date( 'd/m/Y', $post__id ) ); ?>" <?php echo ( get_the_date( 'd/m/Y', $post__id ) == $timeline_start_from ) ? 'selected="selected"' : ''; ?>><?php echo esc_attr( get_the_title( $post__id ) ); ?></option>
												<?php
											}
										}
										wp_reset_postdata();
										echo '</select>';
									} else {
										echo '<p>' . esc_html__( 'No Post Found', 'blog-designer-pro' ) . '</p>';
									}
									?>
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Products Effect', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the transition effect for archive layout', 'blog-designer-pro' ); ?></span></span>
									<?php $template_easing = isset( $bdp_settings['template_easing'] ) ? $bdp_settings['template_easing'] : 'easeInQuad'; ?>
									<select name="template_easing" id="template_easing">
										<option value="easeInQuad" <?php echo 'easeInQuad' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInQuad', 'blog-designer-pro' ); ?></option>
										<option value="easeOutQuad" <?php echo 'easeOutQuad' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutQuad', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutQuad" <?php echo 'easeInOutQuad' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutQuad', 'blog-designer-pro' ); ?></option>
										<option value="easeInCubic" <?php echo 'easeInCubic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInCubic', 'blog-designer-pro' ); ?></option>
										<option value="easeOutCubic" <?php echo 'easeInCubic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInCubic', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutCubic" <?php echo 'easeInOutCubic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutCubic', 'blog-designer-pro' ); ?></option>
										<option value="easeInQuart" <?php echo 'easeInQuart' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInQuart', 'blog-designer-pro' ); ?></option>
										<option value="easeOutQuart" <?php echo 'easeOutQuart' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutQuart', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutQuart" <?php echo 'easeInOutQuart' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutQuart', 'blog-designer-pro' ); ?></option>
										<option value="easeInQuint" <?php echo 'easeInQuint' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInQuint', 'blog-designer-pro' ); ?></option>
										<option value="easeOutQuint" <?php echo 'easeOutQuint' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutQuint', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutQuint" <?php echo 'easeInOutQuint' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutQuint', 'blog-designer-pro' ); ?></option>
										<option value="easeInSine" <?php echo 'easeInSine' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInSine', 'blog-designer-pro' ); ?></option>
										<option value="easeOutSine" <?php echo 'easeOutSine' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutSine', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutSine" <?php echo 'easeInOutSine' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutSine', 'blog-designer-pro' ); ?></option>
										<option value="easeInExpo" <?php echo 'easeInExpo' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInExpo', 'blog-designer-pro' ); ?></option>
										<option value="easeOutExpo" <?php echo 'easeOutExpo' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutExpo', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutExpo" <?php echo 'easeInOutExpo' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutExpo', 'blog-designer-pro' ); ?></option>
										<option value="easeInCirc" <?php echo 'easeInCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInCirc', 'blog-designer-pro' ); ?></option>
										<option value="easeOutCirc" <?php echo 'easeOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutCirc', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutCirc" <?php echo 'easeInOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutCirc', 'blog-designer-pro' ); ?></option>
										<option value="easeOutCirc" <?php echo 'easeOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutCirc', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutCirc" <?php echo 'easeInOutCirc' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutCirc', 'blog-designer-pro' ); ?></option>
										<option value="easeInElastic" <?php echo 'easeInElastic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInElastic', 'blog-designer-pro' ); ?></option>
										<option value="easeOutElastic" <?php echo 'easeOutElastic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutElastic', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutElastic" <?php echo 'easeInOutElastic' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutElastic', 'blog-designer-pro' ); ?></option>
										<option value="easeInBack" <?php echo 'easeInBack' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInBack', 'blog-designer-pro' ); ?></option>
										<option value="easeOutBack" <?php echo 'easeOutBack' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutBack', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutBack" <?php echo 'easeInOutBack' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutBack', 'blog-designer-pro' ); ?></option>
										<option value="easeInBounce" <?php echo 'easeInBounce' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInBounce', 'blog-designer-pro' ); ?></option>
										<option value="easeOutBounce" <?php echo 'easeOutBounce' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeOutBounce', 'blog-designer-pro' ); ?></option>
										<option value="easeInOutBounce" <?php echo 'easeInOutBounce' === $template_easing ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'easeInOutBounce', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Width (px)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the width of the product', 'blog-designer-pro' ); ?></span></span>
									<input type="number" name="item_width" id="item_width" min="100" max="1100" step="1" onblur="if (this.value <= 100) (this.value = 100)" value="<?php echo ( isset( $bdp_settings['item_width'] ) ? esc_attr( $bdp_settings['item_width'] ) : 400 ); ?>">
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Item Height (px)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the height of the product', 'blog-designer-pro' ); ?></span></span>
									<input type="number" name="item_height" id="item_height" min="100" max="1100" step="1" onblur="if (this.value <= 100) (this.value = 100)" value="<?php echo ( isset( $bdp_settings['item_height'] ) ? esc_attr( $bdp_settings['item_height'] ) : 570 ); ?>">
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Margin between Blog Product (px)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the margin for product', 'blog-designer-pro' ); ?></span></span>
									<?php $template_post_margin = ( isset( $bdp_settings['template_post_margin'] ) && '' != $bdp_settings['template_post_margin'] ) ? $bdp_settings['template_post_margin'] : 20; ?>
									<div class="grid_col_space range_slider_fontsize" id="template_template_post_marginInput" data-value="<?php echo esc_attr( $template_post_margin ); ?>" ></div>
									<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_post_margin" id="template_post_margin" value="<?php echo esc_attr( $template_post_margin ); ?>" /></div>
								</div>
							</li>

							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Enable Autoslide', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable autoslide', 'blog-designer-pro' ); ?></span></span>
									<?php $enable_autoslide = ( ( isset( $bdp_settings['enable_autoslide'] ) && '' != $bdp_settings['enable_autoslide'] ) ) ? $bdp_settings['enable_autoslide'] : 1; ?>
									<fieldset class="bdp-social-options bdp-enable_autoslide buttonset buttonset-hide ui-buttonset" data-hide="1">
										<input id="enable_autoslide_1" name="enable_autoslide" class="enable_autoslide" type="radio" value="1" <?php checked( 1, $enable_autoslide ); ?> />
										<label for="enable_autoslide_1" <?php checked( 1, $enable_autoslide ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="enable_autoslide_0" name="enable_autoslide" class="enable_autoslide" type="radio" value="0" <?php checked( 0, $enable_autoslide ); ?> />
										<label for="enable_autoslide_0" <?php checked( 0, $enable_autoslide ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="scroll_speed_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Scrolling Speed(ms)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the slide speed', 'blog-designer-pro' ); ?></span></span>
									<input type="number" name="scroll_speed" id="scroll_speed" min="500" step="100" onblur="if (this.value <= 500) (this.value = 500)" value="<?php echo ( isset( $bdp_settings['scroll_speed'] ) ? esc_attr( $bdp_settings['scroll_speed'] ) : 1000 ); ?>">
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdpstandard" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpstandard_class_show ); ?>>
					<div class="inside">
					<ul class="bdp-settings bdp-lineheight">
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Main Container Class Name', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter main container class name', 'blog-designer-pro' ); ?></span></span>
									<?php $main_container_class = ( isset( $bdp_settings['main_container_class'] ) && '' != $bdp_settings['main_container_class'] ) ? $bdp_settings['main_container_class'] : ''; ?>
									<input type="text" name="main_container_class" id="main_container_class" value="<?php echo esc_attr( $main_container_class ); ?>" placeholder="<?php esc_attr_e( 'Enter main container class name', 'blog-designer-pro' ); ?>">
								</div>
							</li>

							<li class="apply_same_height_section">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Apply same height for posts block?', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Apply same height for posts block', 'blog-designer-pro' ); ?></span></span>
									<?php $apply_same_height = isset( $bdp_settings['apply_same_height'] ) ? $bdp_settings['apply_same_height'] : '0'; ?>
									<fieldset class="bdp-social-options bdp-apply_same_height buttonset buttonset-hide ui-buttonset">
										<input id="apply_same_height_1" name="apply_same_height" type="radio" value="1" <?php checked( 1, $apply_same_height ); ?> />
										<label for="apply_same_height_1" <?php checked( 1, $apply_same_height ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="apply_same_height_0" name="apply_same_height" type="radio" value="0" <?php checked( 0, $apply_same_height ); ?> />
										<label for="apply_same_height_0" <?php checked( 0, $apply_same_height ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="column_setting_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Column', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Desktop - Above', 'blog-designer-pro' ) . ' 980px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php
									$template_name  = ( isset( $bdp_settings['template_name'] ) && '' != $bdp_settings['template_name'] ) ? $bdp_settings['template_name'] : '';
									$column         = ( 'chapter' === $template_name ) ? 3 : 2;
									$column_setting = ( isset( $bdp_settings['column_setting'] ) && '' != $bdp_settings['column_setting'] ) ? $bdp_settings['column_setting'] : $column;
									?>
									<select id="column_setting" name="column_setting">
										<option value="1" <?php echo ( 1 == $column_setting ) ? 'selected="selected"' : ''; ?> > <?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?> </option>
										<option value="2" <?php echo ( 2 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="3" <?php echo ( 3 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="4" <?php echo ( 4 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?> </option>
									</select>
								</div>
							</li>

							<li class="column_setting_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Column', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'iPad', 'blog-designer-pro' ) . ' - 720px - 980px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php
									$template_name  = ( isset( $bdp_settings['template_name'] ) && '' != $bdp_settings['template_name'] ) ? $bdp_settings['template_name'] : '';
									$column         = ( 'chapter' === $template_name ) ? 3 : 2;
									$column_setting = ( isset( $bdp_settings['column_setting_ipad'] ) && '' != $bdp_settings['column_setting_ipad'] ) ? $bdp_settings['column_setting_ipad'] : $column;
									?>
									<select id="column_setting_ipad" name="column_setting_ipad">
										<option value="1" <?php echo ( 1 == $column_setting ) ? 'selected="selected"' : ''; ?> > <?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?> </option>
										<option value="2" <?php echo ( 2 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="3" <?php echo ( 3 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="4" <?php echo ( 4 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?> </option>
									</select>
								</div>
							</li>

							<li class="column_setting_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Column', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Tablet', 'blog-designer-pro' ) . ' - 480px - 720px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php
									$template_name  = ( isset( $bdp_settings['template_name'] ) && '' != $bdp_settings['template_name'] ) ? $bdp_settings['template_name'] : '';
									$column         = ( 'chapter' === $template_name ) ? 2 : 1;
									$column_setting = ( isset( $bdp_settings['column_setting_tablet'] ) && '' != $bdp_settings['column_setting_tablet'] ) ? $bdp_settings['column_setting_tablet'] : $column;
									?>
									<select id="column_setting_tablet" name="column_setting_tablet">
										<option value="1" <?php echo ( 1 == $column_setting ) ? 'selected="selected"' : ''; ?> > <?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?> </option>
										<option value="2" <?php echo ( 2 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="3" <?php echo ( 3 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="4" <?php echo ( 4 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?> </option>
									</select>
								</div>
							</li>
							<li class="column_setting_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Column', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Mobile - Smaller Than', 'blog-designer-pro' ) . ' 480px </i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php $column_setting = ( isset( $bdp_settings['column_setting_mobile'] ) && '' != $bdp_settings['column_setting_mobile'] ) ? $bdp_settings['column_setting_mobile'] : 1; ?>
									<select id="column_setting_mobile" name="column_setting_mobile">
										<option value="1" <?php echo ( 1 == $column_setting ) ? 'selected="selected"' : ''; ?> > <?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?> </option>
										<option value="2" <?php echo ( 2 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="3" <?php echo ( 3 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?> </option>
										<option value="4" <?php echo ( 4 == $column_setting ) ? 'selected="selected"' : ''; ?>> <?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?> </option>
									</select>
								</div>
							</li>

							<li class="blog_unique_design_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Unique Design', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show unique design for specific post', 'blog-designer-pro' ); ?></span></span>
									<label>
										<input id="blog_unique_design" name="blog_unique_design" type="checkbox" value="1" 
										<?php
										if ( isset( $bdp_settings['blog_unique_design'] ) ) {
											checked( 1, $bdp_settings['blog_unique_design'] );
										}
										?>
										/>
									</label>
								</div>
							</li>
							<li class="blog-unique-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Unique Design for first post or Featured posts', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select unique design for first post or featured posts', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['unique_design_option'] = isset( $bdp_settings['unique_design_option'] ) ? $bdp_settings['unique_design_option'] : 'first_post'; ?>
									<select name="unique_design_option" id="unique_design_option">
										<option value="first_post" 
										<?php
										if ( 'first_post' === $bdp_settings['unique_design_option'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'First Post', 'blog-designer-pro' ); ?>
										</option>
										<option value="featured_posts" 
										<?php
										if ( 'featured_posts' === $bdp_settings['unique_design_option'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Featured Posts', 'blog-designer-pro' ); ?>
										</option>
									</select>
									<div class="bdp-setting-description bdp-note">
										<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'If you selected featured post option, then unique design apply on sticky post.', 'blog-designer-pro' ); ?>
									</div>
								</div>
							</li>

							<li class="blog-columns-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php echo esc_html_e( 'Blog Grid Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Desktop - Above', 'blog-designer-pro' ) . ' 980px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_columns'] = isset( $bdp_settings['template_columns'] ) ? $bdp_settings['template_columns'] : 2; ?>
									<select name="template_columns" id="template_columns">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>

							<li class="blog-columns-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php echo esc_html_e( 'Blog Grid Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'iPad', 'blog-designer-pro' ) . ' - 720px - 980px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_columns_ipad'] = isset( $bdp_settings['template_columns_ipad'] ) ? $bdp_settings['template_columns_ipad'] : 1; ?>
									<select name="template_columns_ipad" id="template_columns_ipad">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="blog-columns-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php echo esc_html_e( 'Blog Grid Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Tablet', 'blog-designer-pro' ) . ' - 480px - 720px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_columns_tablet'] = isset( $bdp_settings['template_columns_tablet'] ) ? $bdp_settings['template_columns_tablet'] : 1; ?>
									<select name="template_columns_tablet" id="template_columns_tablet">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="blog-columns-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php echo esc_html_e( 'Blog Grid Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Mobile - Smaller Than', 'blog-designer-pro' ) . ' 480px </i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for post', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_columns_mobile'] = isset( $bdp_settings['template_columns_mobile'] ) ? $bdp_settings['template_columns_mobile'] : 1; ?>
									<select name="template_columns_mobile" id="template_columns_mobile">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="blog-templatecolor-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Posts Template Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color" id="template_color" value="<?php echo isset( $bdp_settings['template_color'] ) ? esc_attr( $bdp_settings['template_color'] ) : '#000000'; ?>"/>
								</div>
							</li>
							<li class="blog-templatecolor-tr1">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetative Blog Posts Template Color 1', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color1" id="template_color1" value="<?php echo isset( $bdp_settings['template_color1'] ) ? esc_attr( $bdp_settings['template_color1'] ) : '#72616e'; ?>"/>
								</div>
							</li>
							<li class="blog-templatecolor-tr2">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetative Blog Posts Template Color 2', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color2" id="template_color2" value="<?php echo isset( $bdp_settings['template_color2'] ) ? esc_attr( $bdp_settings['template_color2'] ) : '#e8846b'; ?>"/>
								</div>
							</li>
							<li class="blog-templatecolor-tr3">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetative Blog Posts Template Color 3', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color3" id="template_color3" value="<?php echo isset( $bdp_settings['template_color3'] ) ? esc_attr( $bdp_settings['template_color3'] ) : '#16528e'; ?>"/>
								</div>
							</li>
							<li class="blog-templatecolor-tr4">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetative Blog Posts Template Color 4', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color4" id="template_color4" value="<?php echo isset( $bdp_settings['template_color4'] ) ? esc_attr( $bdp_settings['template_color4'] ) : '#e54b4b'; ?>"/>
								</div>
							</li>
							<li class="blog-templatecolor-tr5">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetative Blog Posts Template Color 5', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color5" id="template_color5" value="<?php echo isset( $bdp_settings['template_color5'] ) ? esc_attr( $bdp_settings['template_color5'] ) : '#a2c5bf'; ?>"/>
								</div>
							</li>
							<li class="blog-templatecolor-tr6">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetative Blog Posts Template Color 6', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_color6" id="template_color6" value="<?php echo isset( $bdp_settings['template_color6'] ) ? esc_attr( $bdp_settings['template_color6'] ) : '#167c80'; ?>"/>
								</div>
							</li>
							<li class="blog-sallet-slider-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php echo esc_html_e( 'Display Blog Content in ', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display Blog Content', 'blog-designer-pro' ); ?></span></span>
										<?php $bdp_settings['template_slider_content'] = isset( $bdp_settings['template_slider_content'] ) ? $bdp_settings['template_slider_content'] : 'center'; ?>
									<select name="template_slider_content" id="template_slider_content">
										<option value="center" 
										<?php
										if ( 'center' === $bdp_settings['template_slider_content'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Center', 'blog-designer-pro' ); ?>
										</option>
										<option value="right" 
										<?php
										if ( 'right' === $bdp_settings['template_slider_content'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Right', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>

							<li class="ticker-effect-option">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Ticker Effect', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
								<?php $ticker_effect = isset( $bdp_settings['ticker_effect'] ) ? $bdp_settings['ticker_effect'] : 'none'; ?>
								<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the ticker effect', 'blog-designer-pro' ); ?></span></span>
									<div class="select-cover">
										<select name="ticker_effect" id="ticker_effect">
											<option <?php selected( $ticker_effect, 'fade' ); ?> value="fade"><?php esc_html_e( 'Fade', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $ticker_effect, 'typography' ); ?> value="typography"><?php esc_html_e( 'Type', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $ticker_effect, 'scroll' ); ?> value="scroll"><?php esc_html_e( 'Scroll', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $ticker_effect, 'slide-down' ); ?> value="slide-down"><?php esc_html_e( 'Scroll Down', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $ticker_effect, 'slide-up' ); ?> value="slide-up"><?php esc_html_e( 'Scroll Up', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $ticker_effect, 'slide-right' ); ?> value="slide-right"><?php esc_html_e( 'Scroll Right', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $ticker_effect, 'slide-left' ); ?> value="slide-left"><?php esc_html_e( 'Scroll Left', 'blog-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>

							<li class="ticker-label-text">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Ticker Label Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter main container class name', 'blog-designer-pro' ); ?></span></span>
									<?php $ticker_label_text = ( isset( $bdp_settings['ticker_label_text'] ) && '' != $bdp_settings['ticker_label_text'] ) ? $bdp_settings['ticker_label_text'] : ''; ?>
									<input type="text" name="ticker_label_text" id="ticker_label_text" value="<?php echo esc_attr( $ticker_label_text ); ?>" placeholder="<?php esc_attr_e( 'Enter text for ticker label', 'blog-designer-pro' ); ?>">
								</div>
							</li>

							<li class="crayon-slider-design">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Design', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
								<?php $cd_design_type = ( isset( $bdp_settings['cd_design_type'] ) && ! empty( $bdp_settings['cd_design_type'] ) ) ? $bdp_settings['cd_design_type'] : '0'; ?>
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Choose Design for Crayon Slider', 'blog-designer-pro' ); ?></span></span>
									<div class="select-cover">
										<select name="cd_design_type" id="cd_design_type">
											<option <?php selected( $cd_design_type, 'design1' ); ?> value="design1"><?php esc_html_e( 'Design 1', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $cd_design_type, 'design2' ); ?> value="design2"><?php esc_html_e( 'Design 2', 'blog-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
							<li class="timeline-layout-design">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Design', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
								<?php $timeline_design = ( isset( $bdp_settings['timeline_design'] ) && ! empty( $bdp_settings['timeline_design'] ) ) ? $bdp_settings['timeline_design'] : '0'; ?>
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Choose Design for Timeline', 'blog-designer-pro' ); ?></span></span>
									<div class="select-cover">
										<select name="timeline_design" id="timeline_design">
											<option <?php selected( $timeline_design, 'design1' ); ?> value="design1"><?php esc_html_e( 'Design 1', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $timeline_design, 'design2' ); ?> value="design2"><?php esc_html_e( 'Design 2', 'blog-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
							<li class="template_alternative_color">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Posts Alternative Template Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blog post alternate template color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_alternative_color" id="template_alternative_color" value="<?php echo isset( $bdp_settings['template_alternative_color'] ) ? esc_attr( $bdp_settings['template_alternative_color'] ) : '#c34376'; ?>"/>
								</div>
							</li>
							<li class="story-startup-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Border Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select story border color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_startup_border_color" id="story_startup_border_color" value="<?php echo isset( $bdp_settings['story_startup_border_color'] ) ? esc_attr( $bdp_settings['story_startup_border_color'] ) : '#ffffff'; ?>"/>
								</div>
							</li>
							<li class="story-startup-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Startup Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter story startup text', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_startup_text" id="story_startup_text" value="<?php echo isset( $bdp_settings['story_startup_text'] ) ? esc_attr( $bdp_settings['story_startup_text'] ) : esc_html__( 'STARTUP', 'blog-designer-pro' ); ?>"/>
								</div>
							</li>
							<li class="story-startup-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Startup Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select story startup background color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_startup_background" id="story_startup_background" value="<?php echo isset( $bdp_settings['story_startup_background'] ) ? esc_attr( $bdp_settings['story_startup_background'] ) : '#ade175'; ?>" data-default-color="<?php echo isset( $bdp_settings['story_startup_background'] ) ? esc_attr( $bdp_settings['story_startup_background'] ) : '#ade175'; ?>"/>
								</div>
							</li>

							<li class="story-startup-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Startup Text Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select story startup color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_startup_text_color" id="story_startup_text_color"
										value="<?php echo isset( $bdp_settings['story_startup_text_color'] ) ? esc_attr( $bdp_settings['story_startup_text_color'] ) : '#333'; ?>"
										data-default-color="<?php echo isset( $bdp_settings['story_startup_text_color'] ) ? esc_attr( $bdp_settings['story_startup_text_color'] ) : '#333'; ?>"/>
								</div>
							</li>

							<li class="story-ending-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Ending Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select story ending text', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_text" id="story_ending_text" value="<?php echo isset( $bdp_settings['story_ending_text'] ) ? esc_attr( $bdp_settings['story_ending_text'] ) : esc_html__( 'Ending', 'blog-designer-pro' ); ?>"/>
								</div>
							</li>

							<li class="story-ending-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Ending Link', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter story ending link', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_link" id="story_ending_link" value="<?php echo isset( $bdp_settings['story_ending_link'] ) ? esc_attr( $bdp_settings['story_ending_link'] ) : ''; ?>"/>
								</div>
							</li>
							<li class="story-ending-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Ending Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select story ending background color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_background" id="story_ending_background" value="<?php echo isset( $bdp_settings['story_ending_background'] ) ? esc_attr( $bdp_settings['story_ending_background'] ) : '#ade175'; ?>" data-default-color="<?php echo isset( $bdp_settings['story_ending_background'] ) ? esc_attr( $bdp_settings['story_ending_background'] ) : '#ade175'; ?>"/>
								</div>
							</li>

							<li class="story-ending-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Ending Text Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select story ending text color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="story_ending_text_color" id="story_ending_text_color"
										value="<?php echo isset( $bdp_settings['story_ending_text_color'] ) ? esc_attr( $bdp_settings['story_ending_text_color'] ) : '#333'; ?>"
										data-default-color="<?php echo isset( $bdp_settings['story_ending_text_color'] ) ? esc_attr( $bdp_settings['story_ending_text_color'] ) : '#333'; ?>"/>
								</div>
							</li>

							<li class="story-ending-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Story Post Loop Alignment', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select story post loop alignment', 'blog-designer-pro' ); ?></span></span>
									<?php $post_loop_alignment = isset( $bdp_settings['post_loop_alignment'] ) ? $bdp_settings['post_loop_alignment'] : 'default'; ?>
									<select name="post_loop_alignment" id="story_loop_alignment">
										<option value="default" <?php echo selected( 'default', $post_loop_alignment ); ?>>
											<?php esc_html_e( 'Default', 'blog-designer-pro' ); ?>
										</option>
										<option value="left" <?php echo selected( 'left', $post_loop_alignment ); ?>>
											<?php esc_html_e( 'Left', 'blog-designer-pro' ); ?>
										</option>
										<option value="right" <?php echo selected( 'right', $post_loop_alignment ); ?>>
											<?php esc_html_e( 'Right', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="deport-dash-div" style="display: none;">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Dash Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select dash color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="deport_dashcolor" id="deport_dashcolor"
										value="
										<?php
										if ( isset( $bdp_settings['deport_dashcolor'] ) ) {
											echo esc_attr( $bdp_settings['deport_dashcolor'] );
										}
										?>
										"
										data-default-color="
										<?php
										if ( isset( $bdp_settings['deport_dashcolor'] ) ) {
											echo esc_attr( $bdp_settings['deport_dashcolor'] );
										}
										?>
										"/>
								</div>
							</li>

							<li class="winter-category-back-color" style="display: none;">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php echo esc_html( $winter_category_txt ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php echo esc_html( $winter_category_txt ); ?></span></span>
									<input type="text" name="winter_category_color" id="winter_category_color"
										value="
										<?php
										if ( isset( $bdp_settings['winter_category_color'] ) ) {
											echo esc_attr( $bdp_settings['winter_category_color'] );
										}
										?>
										"
										data-default-color="
										<?php
										if ( isset( $bdp_settings['winter_category_color'] ) ) {
											echo esc_attr( $bdp_settings['winter_category_color'] );
										}
										?>
										"/>
								</div>
							</li>
							<li class="lightbreeze-image-corner" style="display:none">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Image Corner Selection', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select image corner shape', 'blog-designer-pro' ); ?></span></span>
									<?php $image_corner_selection = isset( $bdp_settings['image_corner_selection'] ) ? $bdp_settings['image_corner_selection'] : 0; ?>
									<fieldset class="bdp-social-size buttonset buttonset-hide green" data-hide='1'>
										<input id="image_corner_selection_0" name="image_corner_selection" type="radio" value="0" <?php checked( 0, $image_corner_selection ); ?> />
										<label id="bdp-options-button" for="image_corner_selection_0" <?php checked( 0, $image_corner_selection ); ?>><?php esc_html_e( 'Triangle', 'blog-designer-pro' ); ?></label>
										<input id="image_corner_selection_1" name="image_corner_selection" type="radio" value="1" <?php checked( 1, $image_corner_selection ); ?> />
										<label id="bdp-options-button" for="image_corner_selection_1" <?php checked( 1, $image_corner_selection ); ?>><?php esc_html_e( 'Square', 'blog-designer-pro' ); ?></label>
										<input id="image_corner_selection_2" name="image_corner_selection" type="radio" value="2" <?php checked( 2, $image_corner_selection ); ?> />
										<label id="bdp-options-button" for="image_corner_selection_2" <?php checked( 2, $image_corner_selection ); ?>><?php esc_html_e( 'Round', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp-table-sub-title bdp-bg-title-wrap"><?php esc_html_e( 'Background Settings', 'blog-designer-pro' ); ?></h3>
							<li class="blog-template-tr bdp-back-color-blog-wrap">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Background Color for Blog Post Wrap', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select background color for blog post wrap', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor_wrap = ( isset( $bdp_settings['template_bgcolor_wrap'] ) && ! empty( $bdp_settings['template_bgcolor_wrap'] ) ) ? $bdp_settings['template_bgcolor_wrap'] : ''; ?>
									<input type="text" name="template_bgcolor_wrap" id="template_bgcolor_wrap" value="<?php echo esc_attr( $template_bgcolor_wrap ); ?>"/>
								</div>
							</li>
							<li class="blog-template-tr bdp-back-color-blog">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Background Color for Blog Posts', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select post background color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor = ( isset( $bdp_settings['template_bgcolor'] ) && ! empty( $bdp_settings['template_bgcolor'] ) ) ? $bdp_settings['template_bgcolor'] : ''; ?>
									<input type="text" name="template_bgcolor" id="template_bgcolor" value="<?php echo esc_attr( $template_bgcolor ); ?>"/>
								</div>
							</li>
							<li class="display_bgimage_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Background Image', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select background image', 'blog-designer-pro' ); ?></span></span>
									<span class="bdp_default_image_holder bdp_bg_image">
										<?php
										if ( isset( $bdp_settings['bdp_bg_image_src'] ) && '' != $bdp_settings['bdp_bg_image_src'] ) {
											echo '<img src="' . esc_url( $bdp_settings['bdp_bg_image_src'] ) . '"/>';
										}
										?>
									</span>
									<?php if ( isset( $bdp_settings['bdp_bg_image_src'] ) && '' != $bdp_settings['bdp_bg_image_src'] ) { ?>
										<input id="bdp-image-action-button" class="button bdp-remove_image_button bdp_bg_image" type="button" value="<?php esc_attr_e( 'Remove Image', 'blog-designer-pro' ); ?>">
									<?php } else { ?>
										<input class="button bdp-upload_image_button bdp_bg_image" type="button" value="<?php esc_attr_e( 'Upload Image', 'blog-designer-pro' ); ?>">
									<?php } ?>
									<input type="hidden" value="<?php echo isset( $bdp_settings['bdp_bg_image_id'] ) ? esc_attr( $bdp_settings['bdp_bg_image_id'] ) : ''; ?>" name="bdp_bg_image_id" id="bdp_bg_image_id">
									<input type="hidden" value="<?php echo isset( $bdp_settings['bdp_bg_image_src'] ) ? esc_attr( $bdp_settings['bdp_bg_image_src'] ) : ''; ?>" name="bdp_bg_image_src" id="bdp_bg_image_src">
								</div>
							</li>
							<li class="hoverbic-hoverbackcolor-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Posts hover Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select post hover background color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="grid_hoverback_color" id="grid_hoverback_color" value="<?php echo isset( $bdp_settings['grid_hoverback_color'] ) ? esc_attr( $bdp_settings['grid_hoverback_color'] ) : '#000000'; ?>"/>
								</div>
							</li>
							<li class="bdp-back-color-soft-block">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Blog Background Color 1', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select repetative blog background color 1', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor1 = ( isset( $bdp_settings['template_bgcolor1'] ) && ! empty( $bdp_settings['template_bgcolor1'] ) ) ? $bdp_settings['template_bgcolor1'] : ''; ?>
									<input type="text" name="template_bgcolor1" id="template_bgcolor1" value="<?php echo esc_attr( $template_bgcolor1 ); ?>"/>
								</div>
							</li>
							<li class="bdp-back-color-soft-block">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Blog Background Color 2', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select repetative blog background color 2', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor2 = ( isset( $bdp_settings['template_bgcolor2'] ) && ! empty( $bdp_settings['template_bgcolor2'] ) ) ? $bdp_settings['template_bgcolor2'] : ''; ?>
									<input type="text" name="template_bgcolor2" id="template_bgcolor2" value="<?php echo esc_attr( $template_bgcolor2 ); ?>"/>
								</div>
							</li>
							<li class="bdp-back-color-soft-block">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Blog Background Color 3', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select repetative blog background color 3', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor3 = ( isset( $bdp_settings['template_bgcolor3'] ) && ! empty( $bdp_settings['template_bgcolor3'] ) ) ? $bdp_settings['template_bgcolor3'] : ''; ?>
									<input type="text" name="template_bgcolor3" id="template_bgcolor3" value="<?php echo esc_attr( $template_bgcolor3 ); ?>"/>
								</div>
							</li>
							<li class="bdp-back-color-soft-block">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Blog Background Color 4', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select repetative blog background color 4', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor4 = ( isset( $bdp_settings['template_bgcolor4'] ) && ! empty( $bdp_settings['template_bgcolor4'] ) ) ? $bdp_settings['template_bgcolor4'] : ''; ?>
									<input type="text" name="template_bgcolor4" id="template_bgcolor4" value="<?php echo esc_attr( $template_bgcolor4 ); ?>"/>
								</div>
							</li>
							<li class="bdp-back-color-soft-block">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Blog Background Color 5', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select repetative blog background color 5', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor5 = ( isset( $bdp_settings['template_bgcolor5'] ) && ! empty( $bdp_settings['template_bgcolor5'] ) ) ? $bdp_settings['template_bgcolor5'] : ''; ?>
									<input type="text" name="template_bgcolor5" id="template_bgcolor5" value="<?php echo esc_attr( $template_bgcolor5 ); ?>"/>
								</div>
							</li>
							<li class="bdp-back-color-soft-block">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Blog Background Color 6', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select repetative blog background color 6', 'blog-designer-pro' ); ?></span></span>
									<?php $template_bgcolor6 = ( isset( $bdp_settings['template_bgcolor6'] ) && ! empty( $bdp_settings['template_bgcolor6'] ) ) ? $bdp_settings['template_bgcolor6'] : ''; ?>
									<input type="text" name="template_bgcolor6" id="template_bgcolor6" value="<?php echo esc_attr( $template_bgcolor6 ); ?>"/>
								</div>
							</li>
							<li class="blog_background_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Post Feature Image set as Background Image', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable feature image as post background image', 'blog-designer-pro' ); ?></span></span>
									<label>
										<input id="blog_background_image" name="blog_background_image" type="checkbox" value="1" 
										<?php
										if ( isset( $bdp_settings['blog_background_image'] ) ) {
											checked( 1, $bdp_settings['blog_background_image'] );
										}
										?>
										/>
									</label>
								</div>
							</li>
							<li class="blog_background_image_tr blog_background_image_style_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Post Background Image Style', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select post background image style', 'blog-designer-pro' ); ?></span></span>
									<?php $blog_background_image_style = isset( $bdp_settings['blog_background_image_style'] ) ? $bdp_settings['blog_background_image_style'] : 1; ?>
									<fieldset class="bdp-blog_background_image_style buttonset buttonset-hide green" data-hide='1'>
										<input id="blog_background_image_style_0" name="blog_background_image_style" type="radio" value="0" <?php checked( 0, $blog_background_image_style ); ?> />
										<label id="bdp-options-button" for="blog_background_image_style_0" <?php checked( 0, $blog_background_image_style ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></label>
										<input id="blog_background_image_style_1" name="blog_background_image_style" type="radio" value="1" <?php checked( 1, $blog_background_image_style ); ?> />
										<label id="bdp-options-button" for="blog_background_image_style_1" <?php checked( 1, $blog_background_image_style ); ?>><?php esc_html_e( 'Parallax', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="bdp-back-hover-color-blog">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Background Hover Color for Blog Posts', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select post hover background color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_bghovercolor" id="template_bghovercolor" value="<?php echo isset( $bdp_settings['template_bghovercolor'] ) ? esc_attr( $bdp_settings['template_bghovercolor'] ) : '#eeeeee'; ?>"/>
								</div>
							</li>

							<li class="blog-template-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Alternative Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable alternative background color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_alternativebackground = isset( $bdp_settings['template_alternativebackground'] ) ? $bdp_settings['template_alternativebackground'] : 0; ?>
									<fieldset class="bdp-social-options bdp-alternative_color buttonset buttonset-hide" data-hide='1'>
										<input id="template_alternativebackground_1" type="radio" value="1" name="template_alternativebackground" <?php checked( 1, $template_alternativebackground ); ?> />
										<label for="template_alternativebackground_1" <?php checked( 1, $template_alternativebackground ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="template_alternativebackground_0" type="radio" value="0" name="template_alternativebackground" <?php checked( 0, $template_alternativebackground ); ?> />
										<label for="template_alternativebackground_0" <?php checked( 0, $template_alternativebackground ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="alternative-color-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Alternative Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select alternative background color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_alterbgcolor = ( isset( $bdp_settings['template_alterbgcolor'] ) && ! empty( $bdp_settings['template_alterbgcolor'] ) ) ? $bdp_settings['template_alterbgcolor'] : ''; ?>
									<input type="text" name="template_alterbgcolor" id="template_alterbgcolor" value="<?php echo esc_attr( $template_alterbgcolor ); ?>"/>
								</div>
							</li>
							<h3 class="bdp-table-title bdp-table-sub-title bdp_accordion_template"><?php esc_html_e( 'Accordion Layout Settings', 'blog-designer-pro' ); ?></h3>
							<li class="bdp_accordion_template">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Accordion Template', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select accordion template', 'blog-designer-pro' ); ?></span></span>
									<?php $accordion_template = isset( $bdp_settings['accordion_template'] ) ? $bdp_settings['accordion_template'] : 'accordion-template-1'; ?>
									<select name="accordion_template" id="accordion_template">
										<option value="accordion-template-1" <?php echo selected( 'accordion-template-1', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 1', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-2" <?php echo selected( 'accordion-template-2', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 2', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-3" <?php echo selected( 'accordion-template-3', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 3', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-4" <?php echo selected( 'accordion-template-4', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 4', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-5" <?php echo selected( 'accordion-template-5', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 5', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-6" <?php echo selected( 'accordion-template-6', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 6', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-7" <?php echo selected( 'accordion-template-7', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 7', 'blog-designer-pro' ); ?>
										</option>
										<option value="accordion-template-8" <?php echo selected( 'accordion-template-8', $accordion_template ); ?>>
											<?php esc_html_e( 'Accordion Template 8', 'blog-designer-pro' ); ?>
										</option>
									</select>
									<div class="bdp-setting-description bdp-setting-accordion">
										<img class="accordion_template_images"src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/admin/images/accordion/' . esc_attr( $accordion_template ) . '.png'; ?>">
									</div>
								</div>
							</li>
							<li class="post_content_border_radius_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Content Border Radius(px)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Set content border radius', 'blog-designer-pro' ); ?></span></span>
									<?php $content_button_border_radius = isset( $bdp_settings['content_button_border_radius'] ) ? $bdp_settings['content_button_border_radius'] : '0'; ?>
									<input type="number" id="content_button_border_radius" name="content_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $content_button_border_radius ); ?>" onkeypress="return isNumberKey(event)">
								</div>
							</li>
							<li class="bdp_icon_color_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Icon Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select icon color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_icon_color = isset( $bdp_settings['template_icon_color'] ) ? $bdp_settings['template_icon_color'] : '#000000'; ?>
									<input type="text" name="template_icon_color" id="template_icon_color"
										value="<?php echo esc_attr( $template_icon_color ); ?>"
										data-default-color="<?php echo esc_attr( $template_icon_color ); ?>"/>
								</div>
							</li>
							<li class="bdp_icon_hover_color_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Icon Hover Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select icon hover color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_icon_hover_color = isset( $bdp_settings['template_icon_hover_color'] ) ? $bdp_settings['template_icon_hover_color'] : '#000000'; ?>
									<input type="text" name="template_icon_hover_color" id="template_icon_hover_color"
										value="<?php echo esc_attr( $template_icon_hover_color ); ?>"
										data-default-color="<?php echo esc_attr( $template_icon_hover_color ); ?>"/>
								</div>
							</li>

							<li class="bdp_icon_active_header_color_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Active Header Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select active header color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_icon_active_header_color = isset( $bdp_settings['template_icon_active_header_color'] ) ? $bdp_settings['template_icon_active_header_color'] : '#000000'; ?>
									<input type="text" name="template_icon_active_header_color" id="template_icon_active_header_color"
										value="<?php echo esc_attr( $template_icon_active_header_color ); ?>"
										data-default-color="<?php echo esc_attr( $template_icon_active_header_color ); ?>"/>
								</div>
							</li>

							<li class="bdp_icon_bg_color_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Icon Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select icon background color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_icon_bgcolor = isset( $bdp_settings['template_icon_bgcolor'] ) ? $bdp_settings['template_icon_bgcolor'] : 'transparent'; ?>
									<input type="text" name="template_icon_bgcolor" id="template_icon_bgcolor"
										value="<?php echo esc_attr( $template_icon_bgcolor ); ?>"
										data-default-color="<?php echo esc_attr( $template_icon_bgcolor ); ?>"/>
								</div>
							</li>

							<li class="bdp_rep_icon_bg_color_1">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Icon Color 1', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select Repetitive Icon Color 1', 'blog-designer-pro' ); ?></span></span>
									<?php $repetative_icon_color1 = ( isset( $bdp_settings['repetative_icon_color1'] ) && ! empty( $bdp_settings['repetative_icon_color1'] ) ) ? $bdp_settings['repetative_icon_color1'] : ''; ?>
									<input type="text" name="repetative_icon_color1" id="repetative_icon_color1" value="<?php echo esc_attr( $repetative_icon_color1 ); ?>"/>
								</div>
							</li>

							<li class="bdp_rep_icon_bg_color_2">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Icon Color 2', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select Repetitive Icon Color 2', 'blog-designer-pro' ); ?></span></span>
									<?php $repetative_icon_color2 = ( isset( $bdp_settings['repetative_icon_color2'] ) && ! empty( $bdp_settings['repetative_icon_color2'] ) ) ? $bdp_settings['repetative_icon_color2'] : ''; ?>
									<input type="text" name="repetative_icon_color2" id="repetative_icon_color2" value="<?php echo esc_attr( $repetative_icon_color2 ); ?>"/>
								</div>
							</li>

							<li class="bdp_rep_icon_bg_color_3">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Repetitive Icon Color 3', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select Repetitive Icon Color 3', 'blog-designer-pro' ); ?></span></span>
									<?php $repetative_icon_color3 = ( isset( $bdp_settings['repetative_icon_color3'] ) && ! empty( $bdp_settings['repetative_icon_color3'] ) ) ? $bdp_settings['repetative_icon_color3'] : ''; ?>
									<input type="text" name="repetative_icon_color3" id="repetative_icon_color3" value="<?php echo esc_attr( $repetative_icon_color3 ); ?>"/>
								</div>
							</li>

							<li class="bdp_icon_alignment_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Icon Alignment', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select icon alignment', 'blog-designer-pro' ); ?></span></span>
									<?php
									$template_icon_alignment = 'icon-left';
									if ( isset( $bdp_settings['template_icon_alignment'] ) ) {
										$template_icon_alignment = $bdp_settings['template_icon_alignment'];
									}
									?>
									<fieldset class="buttonset green" data-hide='1'>
											<input id="template_icon_alignment_left" name="template_icon_alignment" type="radio" value="icon-left" <?php checked( 'icon-left', $template_icon_alignment ); ?> />
											<label id="bdp-options-button" for="template_icon_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
											<input id="template_icon_alignment_right" name="template_icon_alignment" type="radio" value="icon-right" <?php checked( 'icon-right', $template_icon_alignment ); ?> />
											<label id="bdp-options-button" for="template_icon_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="icon_border_radius_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Icon Border Radius(px)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Set icon border radius', 'blog-designer-pro' ); ?></span></span>
									<?php $icon_button_border_radius = isset( $bdp_settings['icon_button_border_radius'] ) ? $bdp_settings['icon_button_border_radius'] : '0'; ?>
									<input type="number" id="icon_button_border_radius" name="icon_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $icon_button_border_radius ); ?>" onkeypress="return isNumberKey(event)">
								</div>
							</li>


							<li class="icon_font_size_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Icon Font Size (px)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Set icon font size', 'blog-designer-pro' ); ?></span></span>
									<?php $icon_fontsize = isset( $bdp_settings['icon_fontsize'] ) ? $bdp_settings['icon_fontsize'] : '0'; ?>
									<?php
									if ( isset( $bdp_settings['icon_fontsize'] ) && '' != $bdp_settings['icon_fontsize'] ) {
										$icon_fontsize = $bdp_settings['icon_fontsize'];
									} else {
										$icon_fontsize = 14;
									}
									?>
											<div class="grid_col_space range_slider_fontsize" id="template_iconfontsizeInput" data-value="<?php echo esc_attr( $icon_fontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="icon_fontsize" id="icon_fontsize" value="<?php echo esc_attr( $icon_fontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
								</div>
							</li>
							<li class="icon_padding_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Set Icon padding', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right bdp-border-cover">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Set icon padding', 'blog-designer-pro' ); ?></span></span>
									<div class="bdp-padding-wrapper bdp-padding-wrapper1 bdp-border-wrap">
										<div class="bdp-padding-cover">
											<div class="bdp-padding-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
												</span>
											</div>
											<div class="bdp-padding-content">
												<?php $icon_paddingleft = isset( $bdp_settings['icon_paddingleft'] ) ? $bdp_settings['icon_paddingleft'] : '0'; ?>
												<input type="number" id="icon_paddingleft" name="icon_paddingleft" step="1" min="0" value="<?php echo esc_attr( $icon_paddingleft ); ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
										<div class="bdp-padding-cover">
											<div class="bdp-padding-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
												</span>
											</div>
											<div class="bdp-padding-content">
												<?php $icon_paddingright = isset( $bdp_settings['icon_paddingright'] ) ? $bdp_settings['icon_paddingright'] : '0'; ?>
												<input type="number" id="icon_paddingright" name="icon_paddingright" step="1" min="0" value="<?php echo esc_attr( $icon_paddingright ); ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
										<div class="bdp-padding-cover">
											<div class="bdp-padding-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
												</span>
											</div>
											<div class="bdp-padding-content">
												<?php $icon_paddingtop = isset( $bdp_settings['icon_paddingtop'] ) ? $bdp_settings['icon_paddingtop'] : '0'; ?>
												<input type="number" id="icon_paddingtop" name="icon_paddingtop" step="1" min="0" value="<?php echo esc_attr( $icon_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
											</div>
										</div>
										<div class="bdp-padding-cover">
											<div class="bdp-padding-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
												</span>
											</div>
											<div class="bdp-padding-content">
												<?php $icon_paddingbottom = isset( $bdp_settings['icon_paddingbottom'] ) ? $bdp_settings['icon_paddingbottom'] : '0'; ?>
												<input type="number" id="icon_paddingbottom" name="icon_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $icon_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
								</div>								
							</li>
							<h3 class="bdp-table-title bdp-table-sub-title"><?php esc_html_e( 'Normal Settings', 'blog-designer-pro' ); ?></h3>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Link Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select link color', 'blog-designer-pro' ); ?></span></span>
									<?php $template_ftcolor = isset( $bdp_settings['template_ftcolor'] ) ? $bdp_settings['template_ftcolor'] : ''; ?>
									<input type="text" name="template_ftcolor" id="template_ftcolor"
										value="<?php echo esc_attr( $template_ftcolor ); ?>"
										data-default-color="<?php echo esc_attr( $template_ftcolor ); ?>"/>
								</div>
							</li>
							<h3 class="bdp-table-title bdp-table-sub-title"><?php esc_html_e( 'Hover Settings', 'blog-designer-pro' ); ?></h3>
							<li class="link-hover-color-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Link Hover Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select link hover color', 'blog-designer-pro' ); ?></span></span>
									<?php $fthover = isset( $bdp_settings['template_fthovercolor'] ) ? $bdp_settings['template_fthovercolor'] : ''; ?>
									<input type="text" name="template_fthovercolor" id="template_fthovercolor"
										value="<?php echo esc_attr( $fthover ); ?>"
										data-default-color="<?php echo esc_attr( $fthover ); ?>"/>
								</div>
							</li>
							<li class="bdp-post-container-hover">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Hide Hover Effect on Blog post', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable hover effect on blog post', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_hide_hover_post = isset( $bdp_settings['bdp_hide_hover_post'] ) ? $bdp_settings['bdp_hide_hover_post'] : '0'; ?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="bdp_hide_hover_post_1" name="bdp_hide_hover_post" type="radio" value="1" <?php checked( 1, $bdp_hide_hover_post ); ?> />
										<label id="bdp-options-button" for="bdp_hide_hover_post_1" <?php checked( 1, $bdp_hide_hover_post ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="bdp_hide_hover_post_0" name="bdp_hide_hover_post" type="radio" value="0" <?php checked( 0, $bdp_hide_hover_post ); ?> />
										<label id="bdp-options-button" for="bdp_hide_hover_post_0" <?php checked( 0, $bdp_hide_hover_post ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp-table-sub-title bdp_print_page"><?php esc_html_e( 'Print page Settings', 'blog-designer-pro' ); ?></h3>
							<li class="enable_print_page">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Enable Print Page?', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show print page on product archive layout', 'blog-designer-pro' ); ?></span></span>
									<?php

									$enable_print_page = isset( $bdp_settings['enable_print_page'] ) ? $bdp_settings['enable_print_page'] : '1';
									?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="enable_print_page_1" name="enable_print_page" type="radio" value="1" <?php checked( 1, $enable_print_page ); ?> />
										<label id="bdp-options-button" for="enable_print_page_1" <?php checked( 1, $enable_print_page ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="enable_print_page_0" name="enable_print_page" type="radio" value="0" <?php checked( 0, $enable_print_page ); ?> />
										<label id="bdp-options-button" for="enable_print_page_0" <?php checked( 0, $enable_print_page ); ?>><?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="bdp-print-page">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Print Page Display Name', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter Print Page name', 'blog-designer-pro' ); ?></span></span>
									<?php $txt_print_page = ( isset( $bdp_settings['txt_print_page'] ) && '' != $bdp_settings['txt_print_page'] ) ? $bdp_settings['txt_print_page'] : ''; ?>
									<input type="text" name="txt_print_page" id="txt_print_page" value="<?php echo esc_attr( $txt_print_page ); ?>" placeholder="<?php esc_attr_e( 'Enter Print Page name', 'blog-designer-pro' ); ?>">
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdptitle" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdptitle_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Title Link', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product title link', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_post_title_link = isset( $bdp_settings['bdp_post_title_link'] ) ? $bdp_settings['bdp_post_title_link'] : '1'; ?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="bdp_post_title_link_1" name="bdp_post_title_link" type="radio" value="1" <?php checked( 1, $bdp_post_title_link ); ?> />
										<label id="bdp-options-button" for="bdp_post_title_link_1" <?php checked( 1, $bdp_post_title_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="bdp_post_title_link_0" name="bdp_post_title_link" type="radio" value="0" <?php checked( 0, $bdp_post_title_link ); ?> />
										<label id="bdp-options-button" for="bdp_post_title_link_0" <?php checked( 0, $bdp_post_title_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Title Alignment', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product title alignment', 'blog-designer-pro' ); ?></span></span>
									<?php
									$template_title_alignment = 'left';
									if ( isset( $bdp_settings['template_title_alignment'] ) ) {
										$template_title_alignment = $bdp_settings['template_title_alignment'];
									}
									?>
									<fieldset class="buttonset green" data-hide='1'>
											<input id="template_title_alignment_left" name="template_title_alignment" type="radio" value="left" <?php checked( 'left', $template_title_alignment ); ?> />
											<label id="bdp-options-button" for="template_title_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
											<input id="template_title_alignment_center" name="template_title_alignment" type="radio" value="center" <?php checked( 'center', $template_title_alignment ); ?> />
											<label id="bdp-options-button" for="template_title_alignment_center" class="template_title_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
											<input id="template_title_alignment_right" name="template_title_alignment" type="radio" value="right" <?php checked( 'right', $template_title_alignment ); ?> />
											<label id="bdp-options-button" for="template_title_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="bdp_padding_0 bdp_title_color_settings">
								<div class="bdp-typography-wrapper bdp-typography-wrapper1">
									<div class="bdp-typography-cover">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Normal Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-sub-cover title-link-color-tr">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Title Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( ' Select Product title color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $template_titlecolor = isset( $bdp_settings['template_titlecolor'] ) ? $bdp_settings['template_titlecolor'] : ''; ?>
												<input type="text" name="template_titlecolor" id="template_titlecolor" value="<?php echo esc_attr( $template_titlecolor ); ?>"/>
											</div>
										</div>
										<div class="bdp-typography-sub-cover titlebackcolor_tr">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select Product title background color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $template_titlebackcolor = isset( $bdp_settings['template_titlebackcolor'] ) ? $bdp_settings['template_titlebackcolor'] : ''; ?>
												<input type="text" name="template_titlebackcolor" id="template_titlebackcolor" value="<?php echo esc_attr( $template_titlebackcolor ); ?>"/>
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover title-link-hover-color-tr">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Hover Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-sub-cover title-link-hover-color-tr">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Title Link Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select Product title link hover color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $template_titlehovercolor = isset( $bdp_settings['template_titlehovercolor'] ) ? $bdp_settings['template_titlehovercolor'] : '#444'; ?>
												<input type="text" name="template_titlehovercolor" id="template_titlehovercolor" value="<?php echo esc_attr( $template_titlehovercolor ); ?>"/>
											</div>
										</div>
									</div>
								</div>
							</li>
							<h3 class="bdp-table-title"><?php esc_html_e( 'Box Shadow Settings', 'blog-designer-pro' ); ?></h3>
							<li class="edd_addtocart_button_box_shadow_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'H-offset (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $bdp_title_top_box_shadow = isset( $bdp_settings['bdp_title_top_box_shadow'] ) ? $bdp_settings['bdp_title_top_box_shadow'] : '0'; ?>
											<input type="number" id="bdp_title_top_box_shadow" name="bdp_title_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_title_top_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'V-offset (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select vertical offset value', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $bdp_title_right_box_shadow = isset( $bdp_settings['bdp_title_right_box_shadow'] ) ? $bdp_settings['bdp_title_right_box_shadow'] : '0'; ?>
											<input type="number" id="bdp_title_right_box_shadow" name="bdp_title_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_title_right_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Blur (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blur value', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $bdp_title_bottom_box_shadow = isset( $bdp_settings['bdp_title_bottom_box_shadow'] ) ? $bdp_settings['bdp_title_bottom_box_shadow'] : '0'; ?>
											<input type="number" id="bdp_title_bottom_box_shadow" name="bdp_title_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_title_bottom_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover bdp-boxshadow-color">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select title shadow color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
												<?php $bdp_title_box_shadow_color = isset( $bdp_settings['bdp_title_box_shadow_color'] ) ? $bdp_settings['bdp_title_box_shadow_color'] : ''; ?>
												<input type="text" name="bdp_title_box_shadow_color" id="bdp_title_box_shadow_color" value="<?php echo esc_attr( $bdp_title_box_shadow_color ); ?>"/>
										</div>
									</div>
								</div>
							</li>
							<h3 class="bdp-table-title"><?php esc_html_e( 'Typography Settings', 'blog-designer-pro' ); ?></h3>
							<li>
								<div class="bdp-typography-wrapper bdp-typography-wrapper1">
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font family', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											if ( isset( $bdp_settings['template_titlefontface'] ) && '' != $bdp_settings['template_titlefontface'] ) {
												$template_titlefontface = $bdp_settings['template_titlefontface'];
											} else {
												$template_titlefontface = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" name="template_titlefontface_font_type" id="template_titlefontface_font_type" value="<?php echo isset( $bdp_settings['template_titlefontface_font_type'] ) ? esc_attr( $bdp_settings['template_titlefontface_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="template_titlefontface" id="template_titlefontface">
														<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
														<?php
														$old_version = '';
														$cnt         = 0;
														foreach ( $font_family as $key => $value ) {
															if ( $value['version'] != $old_version ) {
																if ( $cnt > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																$old_version = $value['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";

															if ( '' != $template_titlefontface && ( str_replace( '"', '', $template_titlefontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_html( $value['label'] ) . '</option>';
															$cnt++;
														}
														if ( count( $font_family ) == $cnt ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font size', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $template_titlefontsize = ( isset( $bdp_settings['template_titlefontsize'] ) && '' != $bdp_settings['template_titlefontsize'] ) ? $bdp_settings['template_titlefontsize'] : 14; ?>
											<div class="grid_col_space range_slider_fontsize" id="template_postTitlefontsizeInput" data-value="<?php echo esc_attr( $template_titlefontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_titlefontsize" id="template_titlefontsize" value="<?php echo esc_attr( $template_titlefontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font weight', 'blog-designer-pro' ); ?></span></span>
										</div>

										<div class="bdp-typography-content">
											<?php $template_title_font_weight = isset( $bdp_settings['template_title_font_weight'] ) ? $bdp_settings['template_title_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="template_title_font_weight" id="template_title_font_weight">
													<option value="100" <?php selected( $template_title_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $template_title_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $template_title_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $template_title_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $template_title_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $template_title_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $template_title_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $template_title_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $template_title_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $template_title_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $template_title_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter line height', 'blog-designer-pro' ); ?></span></span>
										</div>

										<div class="bdp-typography-content">
											<div class="input-type-number">
												<input type="number" name="template_title_font_line_height" id="template_title_font_line_height" step="0.1" min="0" value="<?php echo isset( $bdp_settings['template_title_font_line_height'] ) ? esc_attr( $bdp_settings['template_title_font_line_height'] ) : '1.5'; ?>" onkeypress="return isNumberKey(event)" >
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display italic font style', 'blog-designer-pro' ); ?></span></span>
										</div>

										<div class="bdp-typography-content">
											<?php $template_title_font_italic = isset( $bdp_settings['template_title_font_italic'] ) ? $bdp_settings['template_title_font_italic'] : '0'; ?>
											<fieldset class="bdp-social-options bdp-display_author buttonset">
												<input id="template_title_font_italic_1" name="template_title_font_italic" type="radio" value="1"  <?php checked( 1, $template_title_font_italic ); ?> />
												<label for="template_title_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="template_title_font_italic_0" name="template_title_font_italic" type="radio" value="0" <?php checked( 0, $template_title_font_italic ); ?> />
												<label for="template_title_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text transform style', 'blog-designer-pro' ); ?></span></span>
										</div>

										<div class="bdp-typography-content">
											<?php $template_title_font_text_transform = isset( $bdp_settings['template_title_font_text_transform'] ) ? $bdp_settings['template_title_font_text_transform'] : 'none'; ?>
											<div class="select-cover">
												<select name="template_title_font_text_transform" id="template_title_font_text_transform">
													<option <?php selected( $template_title_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $template_title_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text decoration style', 'blog-designer-pro' ); ?></span></span>
										</div>

										<div class="bdp-typography-content">
											<div class="select-cover">
												<?php $template_title_font_text_decoration = isset( $bdp_settings['template_title_font_text_decoration'] ) ? $bdp_settings['template_title_font_text_decoration'] : 'none'; ?>
												<div class="select-cover">
													<select name="template_title_font_text_decoration" id="template_title_font_text_decoration">
														<option <?php selected( $template_title_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $template_title_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $template_title_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $template_title_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter letter spacing', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<div class="input-type-number">
												<input type="number" name="template_title_font_letter_spacing" id="template_title_font_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['template_title_font_letter_spacing'] ) ? esc_attr( $bdp_settings['template_title_font_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
								</div>
							</li>
							<h3 class="product_post_title_wrap bdp-table-title post_title_border_setting"><?php esc_html_e( 'Product Post Title Margin', 'blog-designer-pro' ); ?></h3>
							<li class="product_post_title_wrap edd_addtocart_button_box_shadow_setting post_title_border_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_marginleft = isset( $bdp_settings['product_post_title_marginleft'] ) ? $bdp_settings['product_post_title_marginleft'] : 0; ?>
											<input type="number" id="product_post_title_marginleft" name="product_post_title_marginleft" step="1" value="<?php echo esc_attr( $product_post_title_marginleft ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_marginright = isset( $bdp_settings['product_post_title_marginright'] ) ? $bdp_settings['product_post_title_marginright'] : 0; ?>
											<input type="number" id="product_post_title_marginright" name="product_post_title_marginright" step="1" value="<?php echo esc_attr( $product_post_title_marginright ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_margintop = isset( $bdp_settings['product_post_title_margintop'] ) ? $bdp_settings['product_post_title_margintop'] : 0; ?>
											<input type="number" id="product_post_title_margintop" name="product_post_title_margintop" step="1" value="<?php echo esc_attr( $product_post_title_margintop ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_marginbottom = isset( $bdp_settings['product_post_title_marginbottom'] ) ? $bdp_settings['product_post_title_marginbottom'] : 0; ?>
											<input type="number" id="product_post_title_marginbottom" name="product_post_title_marginbottom" step="1" value="<?php echo esc_attr( $product_post_title_marginbottom ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</li>
							<h3 class="product_post_title_padding_wrap bdp-table-title post_title_border_setting"><?php esc_html_e( 'Product Post Title Padding', 'blog-designer-pro' ); ?></h3>
							<li class="product_post_title_padding_wrap edd_addtocart_button_box_shadow_setting post_title_border_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_paddingleft = isset( $bdp_settings['product_post_title_paddingleft'] ) ? $bdp_settings['product_post_title_paddingleft'] : 0; ?>
											<input type="number" id="product_post_title_paddingleft" name="product_post_title_paddingleft" step="1" value="<?php echo esc_attr( $product_post_title_paddingleft ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_paddingright = isset( $bdp_settings['product_post_title_paddingright'] ) ? $bdp_settings['product_post_title_paddingright'] : 0; ?>
											<input type="number" id="product_post_title_paddingright" name="product_post_title_paddingright" step="1" value="<?php echo esc_attr( $product_post_title_paddingright ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_paddingtop = isset( $bdp_settings['product_post_title_paddingtop'] ) ? $bdp_settings['product_post_title_paddingtop'] : 0; ?>
											<input type="number" id="product_post_title_paddingtop" name="product_post_title_paddingtop" step="1" value="<?php echo esc_attr( $product_post_title_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_title_paddingbottom = isset( $bdp_settings['product_post_title_paddingbottom'] ) ? $bdp_settings['product_post_title_paddingbottom'] : 0; ?>
											<input type="number" id="product_post_title_paddingbottom" name="product_post_title_paddingbottom" step="1" value="<?php echo esc_attr( $product_post_title_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdpcontent" class="postbox postbox-with-fw-options bdp-content-setting1" style=<?php echo esc_attr( $bdpcontent_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li class="feed_excert">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'For each Article in a Feed, Show ', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right rss_use_excerpt">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'To display full text for each product, select full text option, otherwise select the summary option.', 'blog-designer-pro' ); ?></span></span>
									<fieldset class="buttonset buttonset-hide green" data-hide='1'>
										<input id="rss_use_excerpt_0" name="rss_use_excerpt" type="radio" value="0" <?php checked( 0, $rss_use_excerpt ); ?> />
										<label id="bdp-options-button" for="rss_use_excerpt_0" <?php checked( 0, $rss_use_excerpt ); ?>><?php esc_html_e( 'Full Text', 'blog-designer-pro' ); ?></label>
										<input id="rss_use_excerpt_1" name="rss_use_excerpt" type="radio" value="1" <?php checked( 1, $rss_use_excerpt ); ?> />
										<label id="bdp-options-button" for="rss_use_excerpt_1" <?php checked( 1, $rss_use_excerpt ); ?>><?php esc_html_e( 'Summary', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="post_content_from">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Show Content From', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'To display text from product content or from product excerpt', 'blog-designer-pro' ); ?></span></span>
									<?php $template_post_content_from = isset( $bdp_settings['template_post_content_from'] ) ? $bdp_settings['template_post_content_from'] : 'from_content'; ?>
									<select name="template_post_content_from" id="template_post_content_from">
										<option value="from_content" <?php selected( $template_post_content_from, 'from_content' ); ?> ><?php esc_html_e( 'Post Content', 'blog-designer-pro' ); ?></option>
										<option value="from_excerpt" <?php selected( $template_post_content_from, 'from_excerpt' ); ?>><?php esc_html_e( 'Post Short Description', 'blog-designer-pro' ); ?></option>
									</select>
									<div class="bdp-setting-description bdp-note">
										<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>:</b>
										<?php esc_html_e( 'If Post Short Description is empty then Content will get automatically from Post Content.', 'blog-designer-pro' ); ?>
									</div>
								</div>
							</li>
							<li class="display_html_tags_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display HTML tags with Summary', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show HTML tags with summary', 'blog-designer-pro' ); ?></span></span>
									<?php $display_html_tags = ( isset( $bdp_settings['display_html_tags'] ) ) ? $bdp_settings['display_html_tags'] : 0; ?>
									<fieldset class="buttonset display_html_tags">
										<input id="display_html_tags_1" name="display_html_tags" type="radio" value="1" <?php checked( 1, $display_html_tags ); ?> />
										<label for="display_html_tags_1" <?php checked( 1, $display_html_tags ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_html_tags_0" name="display_html_tags" type="radio" value="0" <?php checked( 0, $display_html_tags ); ?> />
										<label for="display_html_tags_0" <?php checked( 0, $display_html_tags ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="content-firstletter-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'First letter as Dropcap', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display first letter as dropcap', 'blog-designer-pro' ); ?></span></span>
									<?php $firstletter_big = ( isset( $bdp_settings['firstletter_big'] ) ) ? $bdp_settings['firstletter_big'] : 0; ?>
									<fieldset class="buttonset firstletter_big">
										<input id="firstletter_big_1" name="firstletter_big" type="radio" value="1" <?php checked( 1, $firstletter_big ); ?> />
										<label for="firstletter_big_1" <?php checked( 1, $firstletter_big ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="firstletter_big_0" name="firstletter_big" type="radio" value="0" <?php checked( 0, $firstletter_big ); ?> />
										<label for="firstletter_big_0" <?php checked( 0, $firstletter_big ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title firstletter-setting bdp-dropcap-settings"><?php esc_html_e( 'Dropcap Settings', 'blog-designer-pro' ); ?></h3>
							<li class="firstletter-setting bdp-dropcap-settings">
								<div class="bdp-typography-wrapper bdp-typography-wrapper1">
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Dropcap Font Family', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font family for dropcap', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $firstletter_font_family = ( isset( $bdp_settings['firstletter_font_family'] ) && '' != $bdp_settings['firstletter_font_family'] ) ? $bdp_settings['firstletter_font_family'] : ''; ?>
											<div class="typo-field">
												<input type="hidden" id="firstletter_font_family_font_type" name="firstletter_font_family_font_type" value="<?php echo isset( $bdp_settings['firstletter_font_family_font_type'] ) ? esc_attr( $bdp_settings['firstletter_font_family_font_type'] ) : ''; ?>">
												<select name="firstletter_font_family" id="firstletter_font_family">
													<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
													<?php
													$old_version = '';
													$cnt         = 0;
													foreach ( $font_family as $key => $value ) {
														if ( $value['version'] != $old_version ) {
															if ( $cnt > 0 ) {
																echo '</optgroup>';
															}
															echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
															$old_version = $value['version'];
														}
														echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
														if ( '' != $firstletter_font_family && ( str_replace( '"', '', $firstletter_font_family ) == str_replace( '"', '', $value['label'] ) ) ) {
															echo ' selected';
														}
														echo '>' . esc_html( $value['label'] ) . '</option>';
														$cnt++;
													}
													if ( count( $font_family ) == $cnt ) {
														echo '</optgroup>';
													}
													?>
												</select>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Dropcap Font Size (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font size for dropcap', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $firstletter_fontsize = ( isset( $bdp_settings['firstletter_fontsize'] ) && '' != $bdp_settings['firstletter_fontsize'] ) ? $bdp_settings['firstletter_fontsize'] : '35'; ?>
												<div class="grid_col_space range_slider_fontsize" id="firstletter_fontsize_slider" ></div>
												<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="firstletter_fontsize" id="firstletter_fontsize" value="<?php echo esc_attr( $firstletter_fontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Dropcap Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select dropcap color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											if ( isset( $bdp_settings['firstletter_contentcolor'] ) ) {
												$firstletter_contentcolor = $bdp_settings['firstletter_contentcolor'];
											} else {
												$firstletter_contentcolor = '#000000';
											}
											?>
											<input type="text" name="firstletter_contentcolor" id="firstletter_contentcolor" value="<?php echo esc_attr( $firstletter_contentcolor ); ?>"/>
										</div>
									</div>
								</div>
							</li>
							<li class="excerpt_length">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Enter Product content length (words)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter product content length in number of words', 'blog-designer-pro' ); ?></span></span>
									<input type="number" id="txtExcerptlength" name="txtExcerptlength" step="1" min="0" value="<?php echo esc_attr( $txt_excerpt_length ); ?>" placeholder="Enter excerpt length" onkeypress="return isNumberKey(event)">
								</div>
							</li>
							<li class="advance_contents_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Advance Product Contents', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable advance blog contents', 'blog-designer-pro' ); ?></span></span>
									<?php $advance_contents = ( isset( $bdp_settings['advance_contents'] ) ) ? $bdp_settings['advance_contents'] : 0; ?>
									<fieldset class="buttonset advance_contents">
										<input id="advance_contents_1" name="advance_contents" type="radio" value="1" <?php checked( 1, $advance_contents ); ?> />
										<label for="advance_contents_1" <?php checked( 1, $advance_contents ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="advance_contents_0" name="advance_contents" type="radio" value="0" <?php checked( 0, $advance_contents ); ?> />
										<label for="advance_contents_0" <?php checked( 0, $advance_contents ); ?>><?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="advance_contents_tr advance_contents_settings">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Stoppage From', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display content stop from', 'blog-designer-pro' ); ?></span></span>
									<?php $contents_stopage_from = isset( $bdp_settings['contents_stopage_from'] ) ? $bdp_settings['contents_stopage_from'] : 'paragraph'; ?>
									<select name="contents_stopage_from" id="contents_stopage_from">
										<option value="paragraph" <?php selected( $contents_stopage_from, 'paragraph' ); ?> ><?php esc_html_e( 'Last Paragraph', 'blog-designer-pro' ); ?></option>
										<option value="character" <?php selected( $contents_stopage_from, 'character' ); ?>><?php esc_html_e( 'Characters', 'blog-designer-pro' ); ?></option>
									</select>
									<div class="bdp-setting-description bdp-note">
										<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>:</b> &nbsp;
										<?php
										esc_html_e( 'If "Display HTML tags with Summary" is Enable then Stoppage From Characters option is disable.', 'blog-designer-pro' );
										?>
									</div>
								</div>
							</li>
							<li class="advance_contents_tr advance_contents_settings advance_contents_settings_character">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Stoppage Characters', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
								<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php esc_html_e( 'Select display content stoppage characters', 'blog-designer-pro' ); ?></span></span>
									<?php $contents_stopage_character = isset( $bdp_settings['contents_stopage_character'] ) ? $bdp_settings['contents_stopage_character'] : array( '.' ); ?>
									<select data-placeholder="<?php esc_attr_e( 'Choose stoppage characters', 'blog-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="contents_stopage_character[]" id="contents_stopage_character">										<option value="." <?php echo ( in_array( '.', $contents_stopage_character ) ) ? 'selected="selected"' : ''; ?>> . </option>
										<option value="?" <?php echo ( in_array( '?', $contents_stopage_character ) ) ? 'selected="selected"' : ''; ?>> ? </option>
										<option value="," <?php echo ( in_array( ',', $contents_stopage_character ) ) ? 'selected="selected"' : ''; ?>> , </option>
										<option value=";" <?php echo ( in_array( ';', $contents_stopage_character ) ) ? 'selected="selected"' : ''; ?>> ; </option>
										<option value=":" <?php echo ( in_array( ':', $contents_stopage_character ) ) ? 'selected="selected"' : ''; ?>> : </option>
									</select>								</div>
							</li>
							<li class="contentcolor_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Content Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select product content color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_contentcolor" id="template_contentcolor" value="<?php echo esc_attr( $template_contentcolor ); ?>" />
								</div>
							</li>
							<li class="post_content_hover">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Content Section Hover Background Color', 'blog-designer-pro' ); ?>
									</span>
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product content hover background color', 'blog-designer-pro' ); ?></span></span>
								</div>
								<div class="bdp-right">
									<input type="text" name="template_content_hovercolor" id="template_content_hovercolor" value="<?php echo esc_attr( $template_content_hovercolor ); ?>"/>
								</div>
							</li>
							<h3 class="bdp-table-title"><?php esc_html_e( 'Box Shadow Settings', 'blog-designer-pro' ); ?></h3>
							<li class="edd_addtocart_button_box_shadow_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'H-offset (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $bdp_content_top_box_shadow = isset( $bdp_settings['bdp_content_top_box_shadow'] ) ? $bdp_settings['bdp_content_top_box_shadow'] : '0'; ?>
											<input type="number" id="bdp_content_top_box_shadow" name="bdp_content_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_content_top_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'V-offset (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select vertical offset value', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $bdp_content_right_box_shadow = isset( $bdp_settings['bdp_content_right_box_shadow'] ) ? $bdp_settings['bdp_content_right_box_shadow'] : '0'; ?>
											<input type="number" id="bdp_content_right_box_shadow" name="bdp_content_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_content_right_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Blur (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blur value', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $bdp_content_bottom_box_shadow = isset( $bdp_settings['bdp_content_bottom_box_shadow'] ) ? $bdp_settings['bdp_content_bottom_box_shadow'] : '0'; ?>
											<input type="number" id="bdp_content_bottom_box_shadow" name="bdp_content_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_content_bottom_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover bdp-boxshadow-color">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select title shadow color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-boxshadow-content">
												<?php $bdp_content_box_shadow_color = isset( $bdp_settings['bdp_content_box_shadow_color'] ) ? $bdp_settings['bdp_content_box_shadow_color'] : ''; ?>
												<input type="text" name="bdp_content_box_shadow_color" id="bdp_content_box_shadow_color" value="<?php echo esc_attr( $bdp_content_box_shadow_color ); ?>"/>
										</div>
									</div>
								</div>
							</li>
							<h3 class="bdp-table-title"><?php esc_html_e( 'Product Content Typography Settings', 'blog-designer-pro' ); ?></h3>
							<li>
								<div class="bdp-typography-wrapper bdp-typography-wrapper1">
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font family for product content', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											if ( isset( $bdp_settings['content_font_family'] ) && '' != $bdp_settings['content_font_family'] ) {
												$content_font_family = $bdp_settings['content_font_family'];
											} else {
												$content_font_family = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" id="content_font_family_font_type" name="content_font_family_font_type" value="<?php echo isset( $bdp_settings['content_font_family_font_type'] ) ? esc_attr( $bdp_settings['content_font_family_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="content_font_family" id="content_font_family">
														<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
														<?php
														$old_version = '';
														$cnt         = 0;
														foreach ( $font_family as $key => $value ) {
															if ( $value['version'] != $old_version ) {
																if ( $cnt > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																$old_version = $value['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";

															if ( '' != $content_font_family && ( str_replace( '"', '', $content_font_family ) == str_replace( '"', '', $value['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_html( $value['label'] ) . '</option>';
															$cnt++;
														}
														if ( count( $font_family ) == $cnt ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font size for product content', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<div class="grid_col_space range_slider_fontsize" id="content_fontsize_slider" data-value="<?php echo esc_attr( $content_fontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="content_fontsize" id="content_fontsize" value="<?php echo esc_attr( $content_fontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font weight', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $content_font_weight = isset( $bdp_settings['content_font_weight'] ) ? $bdp_settings['content_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="content_font_weight" id="content_font_weight">
													<option value="100" <?php selected( $content_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $content_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $content_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $content_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $content_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $content_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $content_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $content_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $content_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $content_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $content_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter line height', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<div class="input-type-number">
												<input type="number" name="content_font_line_height" id="content_font_line_height" step="0.1" min="0" value="<?php echo isset( $bdp_settings['content_font_line_height'] ) ? esc_attr( $bdp_settings['content_font_line_height'] ) : '1.5'; ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display italic font style', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $content_font_italic = isset( $bdp_settings['content_font_italic'] ) ? $bdp_settings['content_font_italic'] : '0'; ?>
											<fieldset class="bdp-social-options bdp-display_author buttonset">
												<input id="content_font_italic_1" name="content_font_italic" type="radio" value="1"  <?php checked( 1, $content_font_italic ); ?> />
												<label for="content_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="content_font_italic_0" name="content_font_italic" type="radio" value="0" <?php checked( 0, $content_font_italic ); ?> />
												<label for="content_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text transform style', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $content_font_text_transform = isset( $bdp_settings['content_font_text_transform'] ) ? $bdp_settings['content_font_text_transform'] : 'none'; ?>
											<div class="select-cover">
												<select name="content_font_text_transform" id="content_font_text_transform">
													<option <?php selected( $content_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text decoration style', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $content_font_text_decoration = isset( $bdp_settings['content_font_text_decoration'] ) ? $bdp_settings['content_font_text_decoration'] : 'none'; ?>
											<div class="select-cover">
												<select name="content_font_text_decoration" id="content_font_text_decoration">
													<option <?php selected( $content_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $content_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter letter spacing', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<div class="input-type-number">
												<input type="number" name="content_font_letter_spacing" id="content_font_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['content_font_letter_spacing'] ) ? esc_attr( $bdp_settings['content_font_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
								</div>
							</li>
							<h3 class="product_post_content_wrap bdp-table-title post_content_border_setting"><?php esc_html_e( 'Product Post Content Margin', 'blog-designer-pro' ); ?></h3>
							<li class="product_post_content_wrap edd_addtocart_button_box_shadow_setting post_content_border_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_marginleft = isset( $bdp_settings['product_post_content_marginleft'] ) ? $bdp_settings['product_post_content_marginleft'] : 0; ?>
											<input type="number" id="product_post_content_marginleft" name="product_post_content_marginleft" step="1" value="<?php echo esc_attr( $product_post_content_marginleft ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_marginright = isset( $bdp_settings['product_post_content_marginright'] ) ? $bdp_settings['product_post_content_marginright'] : 0; ?>
											<input type="number" id="product_post_content_marginright" name="product_post_content_marginright" step="1" value="<?php echo esc_attr( $product_post_content_marginright ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_margintop = isset( $bdp_settings['product_post_content_margintop'] ) ? $bdp_settings['product_post_content_margintop'] : 0; ?>
											<input type="number" id="product_post_content_margintop" name="product_post_content_margintop" step="1" value="<?php echo esc_attr( $product_post_content_margintop ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_marginbottom = isset( $bdp_settings['product_post_content_marginbottom'] ) ? $bdp_settings['product_post_content_marginbottom'] : 0; ?>
											<input type="number" id="product_post_content_marginbottom" name="product_post_content_marginbottom" step="1" value="<?php echo esc_attr( $product_post_content_marginbottom ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</li>
							<h3 class="product_post_content_padding_wrap bdp-table-title post_content_border_setting"><?php esc_html_e( 'Product Post Content Padding', 'blog-designer-pro' ); ?></h3>
							<li class="product_post_content_padding_wrap edd_addtocart_button_box_shadow_setting post_content_border_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_paddingleft = isset( $bdp_settings['product_post_content_paddingleft'] ) ? $bdp_settings['product_post_content_paddingleft'] : 0; ?>
											<input type="number" id="product_post_content_paddingleft" name="product_post_content_paddingleft" step="1" value="<?php echo esc_attr( $product_post_content_paddingleft ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_paddingright = isset( $bdp_settings['product_post_content_paddingright'] ) ? $bdp_settings['product_post_content_paddingright'] : 0; ?>
											<input type="number" id="product_post_content_paddingright" name="product_post_content_paddingright" step="1" value="<?php echo esc_attr( $product_post_content_paddingright ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_paddingtop = isset( $bdp_settings['product_post_content_paddingtop'] ) ? $bdp_settings['product_post_content_paddingtop'] : 0; ?>
											<input type="number" id="product_post_content_paddingtop" name="product_post_content_paddingtop" step="1" value="<?php echo esc_attr( $product_post_content_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $product_post_content_paddingbottom = isset( $bdp_settings['product_post_content_paddingbottom'] ) ? $bdp_settings['product_post_content_paddingbottom'] : 0; ?>
											<input type="number" id="product_post_content_paddingbottom" name="product_post_content_paddingbottom" step="1" value="<?php echo esc_attr( $product_post_content_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</li>
							<h3 class="bdp-table-title display_read_more_link"><?php esc_html_e( 'Read More Settings', 'blog-designer-pro' ); ?></h3>
							<li class="display_read_more_link">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Read More Link', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable to show read more product link', 'blog-designer-pro' ); ?></span></span>
									<?php $read_more_link = isset( $bdp_settings['read_more_link'] ) ? $bdp_settings['read_more_link'] : '1'; ?>
									<fieldset class="bdp-social-options bdp-read_more_link buttonset buttonset-hide ui-buttonset">
										<input id="read_more_link_1" name="read_more_link" type="radio" value="1" <?php checked( 1, $read_more_link ); ?> />
										<label for="read_more_link_1" <?php checked( 1, $read_more_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="read_more_link_0" name="read_more_link" type="radio" value="0" <?php checked( 0, $read_more_link ); ?> />
										<label for="read_more_link_0" <?php checked( 0, $read_more_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="display_read_more_on read_more_wrap">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Read More On', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select option for display read more button where to display', 'blog-designer-pro' ); ?></span></span>
									<?php $read_more_on = isset( $bdp_settings['read_more_on'] ) ? $bdp_settings['read_more_on'] : '2'; ?>
									<fieldset class="bdp-social-options bdp-read_more_on buttonset buttonset-hide ui-buttonset green">
										<input id="read_more_on_1" name="read_more_on" type="radio" value="1" <?php checked( 1, $read_more_on ); ?> />
										<label id="bdp-options-button" for="read_more_on_1" <?php checked( 1, $read_more_on ); ?>><?php esc_html_e( 'Same Line', 'blog-designer-pro' ); ?></label>
										<input id="read_more_on_2" name="read_more_on" type="radio" value="2" <?php checked( 2, $read_more_on ); ?> />
										<label id="bdp-options-button" for="read_more_on_2" <?php checked( 2, $read_more_on ); ?>><?php esc_html_e( 'Next Line', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="read_more_text read_more_wrap">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Read More Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter read more text label', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="txtReadmoretext" id="txtReadmoretext" value="<?php echo esc_attr( $txt_readmore_text ); ?>" placeholder="Enter read more text">
								</div>
							</li>
							<li class="read_more_wrap">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Read More Link', 'blog-designer-pro' ); ?>&nbsp;
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more link type.', 'blog-designer-pro' ); ?></span></span>
									<?php $post_link_type = isset( $bdp_settings['post_link_type'] ) ? $bdp_settings['post_link_type'] : '0'; ?>
									<fieldset class="bdp-post_link_type buttonset buttonset-hide green" data-hide='1'>
										<input id="post_link_type_0" name="post_link_type" type="radio" value="0" <?php checked( 0, $post_link_type ); ?> />
										<label id="bdp-options-button" for="post_link_type_0" <?php checked( 0, $post_link_type ); ?>><?php esc_html_e( 'Post Link', 'blog-designer-pro' ); ?></label>
										<input id="post_link_type_1" name="post_link_type" type="radio" value="1" <?php checked( 1, $post_link_type ); ?> />
										<label id="bdp-options-button" for="post_link_type_1" <?php checked( 1, $post_link_type ); ?>><?php esc_html_e( 'Custom Link', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="link-behaviour-option">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Link Behaviour', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
								<?php $link_behaviour = isset( $bdp_settings['link_behaviour'] ) ? $bdp_settings['link_behaviour'] : ''; ?>
								<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the Link Behaviour', 'blog-designer-pro' ); ?></span></span>
									<div class="select-cover">
										<select name="link_behaviour" id="link_behaviour">
											<option <?php selected( $link_behaviour, 'self' ); ?> value="self"><?php esc_html_e( 'Self', 'blog-designer-pro' ); ?></option>
											<option <?php selected( $link_behaviour, 'new' ); ?> value="new"><?php esc_html_e( 'New', 'blog-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
							<li class="read_more_wrap read_more_button_alignment_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Read More Button Alignment', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more button alignment', 'blog-designer-pro' ); ?></span></span>
									<?php
									$readmore_button_alignment = 'left';
									if ( isset( $bdp_settings['readmore_button_alignment'] ) ) {
										$readmore_button_alignment = $bdp_settings['readmore_button_alignment'];
									}
									?>
									<fieldset class="buttonset green" data-hide='1'>
											<input id="readmore_button_alignment_left" name="readmore_button_alignment" type="radio" value="left" <?php checked( 'left', $readmore_button_alignment ); ?> />
											<label id="bdp-options-button" for="readmore_button_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
											<input id="readmore_button_alignment_center" name="readmore_button_alignment" type="radio" value="center" <?php checked( 'center', $readmore_button_alignment ); ?> />
											<label id="bdp-options-button" for="readmore_button_alignment_center" class="readmore_button_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
											<input id="readmore_button_alignment_right" name="readmore_button_alignment" type="radio" value="right" <?php checked( 'right', $readmore_button_alignment ); ?> />
											<label id="bdp-options-button" for="readmore_button_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="read_more_wrap custom_link_url">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Custom Link URL', 'blog-designer-pro' ); ?>&nbsp;
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter custom link url.', 'blog-designer-pro' ); ?></span></span>
									<?php $custom_link_url = isset( $bdp_settings['custom_link_url'] ) ? $bdp_settings['custom_link_url'] : ''; ?>
										<input type="text" name="custom_link_url" id="custom_link_url" value="<?php echo esc_attr( $custom_link_url ); ?>" placeholder="<?php echo esc_html__( 'eg.', 'blog-designer-pro' ) . ' ' . esc_url( get_site_url() ); ?>" />
								</div>
							</li>
							<li class="read_more_wrap bdp_padding_0">
								<div class="bdp-typography-wrapper bdp-typography-wrapper1">
									<div class="bdp-typography-cover product-archive-readmore-normal">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Normal Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-sub-cover read_more_text_color">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more text color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $template_readmorecolor = isset( $bdp_settings['template_readmorecolor'] ) ? $bdp_settings['template_readmorecolor'] : ''; ?>
												<input type="text" name="template_readmorecolor" id="template_readmorecolor" value="<?php echo esc_attr( $template_readmorecolor ); ?>"/>
											</div>
										</div>
										<div class="bdp-typography-sub-cover read_more_text_background">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more text background color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $template_readmorebackcolor = isset( $bdp_settings['template_readmorebackcolor'] ) ? $bdp_settings['template_readmorebackcolor'] : ''; ?>
												<input type="text" name="template_readmorebackcolor" id="template_readmorebackcolor" value="<?php echo esc_attr( $template_readmorebackcolor ); ?>"/>
											</div>
										</div>
										<div class="bdp-typography-sub-cover read_more_button_border_radius_setting">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Border Radius(px)', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more button border radius', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $readmore_button_border_radius = isset( $bdp_settings['readmore_button_border_radius'] ) ? $bdp_settings['readmore_button_border_radius'] : '0'; ?>
												<input type="number" id="readmore_button_border_radius" name="readmore_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $readmore_button_border_radius ); ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
										<div class="bdp-typography-sub-cover read_more_button_border_setting">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Border Style', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more button border type', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content bdp-typography-product-readmore-content">
												<?php $read_more_button_border_style = isset( $bdp_settings['read_more_button_border_style'] ) ? $bdp_settings['read_more_button_border_style'] : 'solid'; ?>
												<select name="read_more_button_border_style" id="read_more_button_border_style">
													<option value="none" <?php selected( $read_more_button_border_style, 'none' ); ?>><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
													<option value="dotted" <?php selected( $read_more_button_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'blog-designer-pro' ); ?></option>
													<option value="dashed" <?php selected( $read_more_button_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'blog-designer-pro' ); ?></option>
													<option value="solid" <?php selected( $read_more_button_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'blog-designer-pro' ); ?></option>
													<option value="double" <?php selected( $read_more_button_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'blog-designer-pro' ); ?></option>
													<option value="groove" <?php selected( $read_more_button_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'blog-designer-pro' ); ?></option>
													<option value="ridge" <?php selected( $read_more_button_border_style, 'ridge' ); ?>><?php esc_html_e( 'Ridge', 'blog-designer-pro' ); ?></option>
													<option value="inset" <?php selected( $read_more_button_border_style, 'inset' ); ?>><?php esc_html_e( 'Inset', 'blog-designer-pro' ); ?></option>
													<option value="outset" <?php selected( $read_more_button_border_style, 'outset' ); ?> ><?php esc_html_e( 'Outset', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
										<div class="bdp-typography-sub-cover full-width read_more_button_border_setting">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Read More Button Border', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more button border', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<div class="bdp-border-wrap">
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_borderleft = isset( $bdp_settings['bdp_readmore_button_borderleft'] ) ? $bdp_settings['bdp_readmore_button_borderleft'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_borderleft" name="bdp_readmore_button_borderleft" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_borderleft ); ?>"  onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_borderleftcolor = isset( $bdp_settings['bdp_readmore_button_borderleftcolor'] ) ? $bdp_settings['bdp_readmore_button_borderleftcolor'] : ''; ?>
																<input type="text" name="bdp_readmore_button_borderleftcolor" id="bdp_readmore_button_borderleftcolor" value="<?php echo esc_attr( $bdp_readmore_button_borderleftcolor ); ?>"/>
															</div>
														</div>
													</div> 
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_borderright = isset( $bdp_settings['bdp_readmore_button_borderright'] ) ? $bdp_settings['bdp_readmore_button_borderright'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_borderright" name="bdp_readmore_button_borderright" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_borderright ); ?>" onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
															<?php $bdp_readmore_button_borderrightcolor = isset( $bdp_settings['bdp_readmore_button_borderrightcolor'] ) ? $bdp_settings['bdp_readmore_button_borderrightcolor'] : ''; ?>
																<input type="text" name="bdp_readmore_button_borderrightcolor" id="bdp_readmore_button_borderrightcolor" value="<?php echo esc_attr( $bdp_readmore_button_borderrightcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_bordertop = isset( $bdp_settings['bdp_readmore_button_bordertop'] ) ? $bdp_settings['bdp_readmore_button_bordertop'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_bordertop" name="bdp_readmore_button_bordertop" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_bordertop ); ?>" onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_bordertopcolor = isset( $bdp_settings['bdp_readmore_button_bordertopcolor'] ) ? $bdp_settings['bdp_readmore_button_bordertopcolor'] : ''; ?>
																<input type="text" name="bdp_readmore_button_bordertopcolor" id="bdp_readmore_button_bordertopcolor" value="<?php echo esc_attr( $bdp_readmore_button_bordertopcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Bottom(px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_borderbottom = isset( $bdp_settings['bdp_readmore_button_borderbottom'] ) ? $bdp_settings['bdp_readmore_button_borderbottom'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_borderbottom" name="bdp_readmore_button_borderbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_borderbottom ); ?>" onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
															<?php $bdp_readmore_button_borderbottomcolor = isset( $bdp_settings['bdp_readmore_button_borderbottomcolor'] ) ? $bdp_settings['bdp_readmore_button_borderbottomcolor'] : ''; ?>
															<input type="text" name="bdp_readmore_button_borderbottomcolor" id="bdp_readmore_button_borderbottomcolor" value="<?php echo esc_attr( $bdp_readmore_button_borderbottomcolor ); ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="bdp-typography-cover product-archive-readmore-hover">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Hover Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-sub-cover read_more_hover_text_color">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more hover text color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $template_readmorehovercolor = isset( $bdp_settings['template_readmorehovercolor'] ) ? $bdp_settings['template_readmorehovercolor'] : ''; ?>
												<input type="text" name="template_readmorehovercolor" id="template_readmorehovercolor" value="<?php echo esc_attr( $template_readmorehovercolor ); ?>"/>
											</div>
										</div>
										<div class="bdp-typography-sub-cover read_more_text_hover_background">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more text hover background color', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<input type="text" name="template_readmore_hover_backcolor" id="template_readmore_hover_backcolor" value="<?php echo ( isset( $bdp_settings['template_readmore_hover_backcolor'] ) && '' != $bdp_settings['template_readmore_hover_backcolor'] ) ? esc_attr( $bdp_settings['template_readmore_hover_backcolor'] ) : ''; ?>"/>
											</div>
										</div>
										<div class="bdp-typography-sub-cover read_more_button_border_radius_setting">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Border Radius(px)', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more hover button border radius', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $readmore_button_hover_border_radius = isset( $bdp_settings['readmore_button_hover_border_radius'] ) ? $bdp_settings['readmore_button_hover_border_radius'] : '0'; ?>
												<input type="number" id="readmore_button_hover_border_radius" name="readmore_button_hover_border_radius" step="1" min="0" value="<?php echo esc_attr( $readmore_button_hover_border_radius ); ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
										<div class="bdp-typography-sub-cover read_more_button_border_setting">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Border Style', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more button hover border type', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content bdp-typography-product-readmore-content">
												<?php $read_more_button_hover_border_style = isset( $bdp_settings['read_more_button_hover_border_style'] ) ? $bdp_settings['read_more_button_hover_border_style'] : 'solid'; ?>
												<select name="read_more_button_hover_border_style" id="read_more_button_hover_border_style">
													<option value="none" <?php selected( $read_more_button_hover_border_style, 'none' ); ?>><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
													<option value="dotted" <?php selected( $read_more_button_hover_border_style, 'dotted' ); ?>><?php esc_html_e( 'Dotted', 'blog-designer-pro' ); ?></option>
													<option value="dashed" <?php selected( $read_more_button_hover_border_style, 'dashed' ); ?>><?php esc_html_e( 'Dashed', 'blog-designer-pro' ); ?></option>
													<option value="solid" <?php selected( $read_more_button_hover_border_style, 'solid' ); ?>><?php esc_html_e( 'Solid', 'blog-designer-pro' ); ?></option>
													<option value="double" <?php selected( $read_more_button_hover_border_style, 'double' ); ?>><?php esc_html_e( 'Double', 'blog-designer-pro' ); ?></option>
													<option value="groove" <?php selected( $read_more_button_hover_border_style, 'groove' ); ?>><?php esc_html_e( 'Groove', 'blog-designer-pro' ); ?></option>
													<option value="ridge" <?php selected( $read_more_button_hover_border_style, 'ridge' ); ?>><?php esc_html_e( 'Ridge', 'blog-designer-pro' ); ?></option>
													<option value="inset" <?php selected( $read_more_button_hover_border_style, 'inset' ); ?>><?php esc_html_e( 'Inset', 'blog-designer-pro' ); ?></option>
													<option value="outset" <?php selected( $read_more_button_hover_border_style, 'outset' ); ?> ><?php esc_html_e( 'Outset', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
										<div class="bdp-typography-sub-cover full-width read_more_button_border_setting">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Read More Button Border', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more hover button border', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<div class="bdp-border-wrap">
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_hover_borderleft = isset( $bdp_settings['bdp_readmore_button_hover_borderleft'] ) ? $bdp_settings['bdp_readmore_button_hover_borderleft'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_hover_borderleft" name="bdp_readmore_button_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_hover_borderleft ); ?>"  onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_hover_borderleftcolor = isset( $bdp_settings['bdp_readmore_button_hover_borderleftcolor'] ) ? $bdp_settings['bdp_readmore_button_hover_borderleftcolor'] : ''; ?>
																<input type="text" name="bdp_readmore_button_hover_borderleftcolor" id="bdp_readmore_button_hover_borderleftcolor" value="<?php echo esc_attr( $bdp_readmore_button_hover_borderleftcolor ); ?>"/>
															</div>
														</div>
													</div> 
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_hover_borderright = isset( $bdp_settings['bdp_readmore_button_hover_borderright'] ) ? $bdp_settings['bdp_readmore_button_hover_borderright'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_hover_borderright" name="bdp_readmore_button_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_hover_borderright ); ?>" onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
															<?php $bdp_readmore_button_hover_borderrightcolor = isset( $bdp_settings['bdp_readmore_button_hover_borderrightcolor'] ) ? $bdp_settings['bdp_readmore_button_hover_borderrightcolor'] : ''; ?>
																<input type="text" name="bdp_readmore_button_hover_borderrightcolor" id="bdp_readmore_button_hover_borderrightcolor" value="<?php echo esc_attr( $bdp_readmore_button_hover_borderrightcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_hover_bordertop = isset( $bdp_settings['bdp_readmore_button_hover_bordertop'] ) ? $bdp_settings['bdp_readmore_button_hover_bordertop'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_hover_bordertop" name="bdp_readmore_button_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_hover_bordertop ); ?>" onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_hover_bordertopcolor = isset( $bdp_settings['bdp_readmore_button_hover_bordertopcolor'] ) ? $bdp_settings['bdp_readmore_button_hover_bordertopcolor'] : ''; ?>
																<input type="text" name="bdp_readmore_button_hover_bordertopcolor" id="bdp_readmore_button_hover_bordertopcolor" value="<?php echo esc_attr( $bdp_readmore_button_hover_bordertopcolor ); ?>"/>
															</div>
														</div>
													</div>
													<div class="bdp-border-wrapper bdp-border-wrapper1">
														<div class="bdp-border-cover bdp-border-label">
																<span class="bdp-key-title">
																	<?php esc_html_e( 'Bottom(px)', 'blog-designer-pro' ); ?>
																</span>
															</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
																<?php $bdp_readmore_button_hover_borderbottom = isset( $bdp_settings['bdp_readmore_button_hover_borderbottom'] ) ? $bdp_settings['bdp_readmore_button_hover_borderbottom'] : '0'; ?>
																<input type="number" id="bdp_readmore_button_hover_borderbottom" name="bdp_readmore_button_hover_borderbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_readmore_button_hover_borderbottom ); ?>" onkeypress="return isNumberKey(event)">
															</div>
														</div>
														<div class="bdp-border-cover">
															<div class="bdp-border-content">
															<?php $bdp_readmore_button_hover_borderbottomcolor = isset( $bdp_settings['bdp_readmore_button_hover_borderbottomcolor'] ) ? $bdp_settings['bdp_readmore_button_hover_borderbottomcolor'] : ''; ?>
															<input type="text" name="bdp_readmore_button_hover_borderbottomcolor" id="bdp_readmore_button_hover_borderbottomcolor" value="<?php echo esc_attr( $bdp_readmore_button_hover_borderbottomcolor ); ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<h3 class="read_more_wrap bdp-table-title read_more_button_border_setting"><?php esc_html_e( 'Read More Button Padding', 'blog-designer-pro' ); ?></h3>
							<li class="read_more_wrap edd_addtocart_button_box_shadow_setting read_more_button_border_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_paddingleft = isset( $bdp_settings['readmore_button_paddingleft'] ) ? $bdp_settings['readmore_button_paddingleft'] : '10'; ?>
											<input type="number" id="readmore_button_paddingleft" name="readmore_button_paddingleft" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingleft ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_paddingright = isset( $bdp_settings['readmore_button_paddingright'] ) ? $bdp_settings['readmore_button_paddingright'] : '10'; ?>
											<input type="number" id="readmore_button_paddingright" name="readmore_button_paddingright" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingright ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_paddingtop = isset( $bdp_settings['readmore_button_paddingtop'] ) ? $bdp_settings['readmore_button_paddingtop'] : '10'; ?>
											<input type="number" id="readmore_button_paddingtop" name="readmore_button_paddingtop" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_paddingbottom = isset( $bdp_settings['readmore_button_paddingbottom'] ) ? $bdp_settings['readmore_button_paddingbottom'] : '10'; ?>
											<input type="number" id="readmore_button_paddingbottom" name="readmore_button_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $readmore_button_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</li>
							<h3 class="read_more_wrap bdp-table-title read_more_button_border_setting"><?php esc_html_e( 'Read More Button Margin', 'blog-designer-pro' ); ?></h3>
							<li class="read_more_wrap edd_addtocart_button_box_shadow_setting read_more_button_border_setting">
								<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_marginleft = isset( $bdp_settings['readmore_button_marginleft'] ) ? $bdp_settings['readmore_button_marginleft'] : 0; ?>
											<input type="number" id="readmore_button_marginleft" name="readmore_button_marginleft" step="1" value="<?php echo esc_attr( $readmore_button_marginleft ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_marginright = isset( $bdp_settings['readmore_button_marginright'] ) ? $bdp_settings['readmore_button_marginright'] : 0; ?>
											<input type="number" id="readmore_button_marginright" name="readmore_button_marginright" step="1" value="<?php echo esc_attr( $readmore_button_marginright ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_margintop = isset( $bdp_settings['readmore_button_margintop'] ) ? $bdp_settings['readmore_button_margintop'] : 0; ?>
											<input type="number" id="readmore_button_margintop" name="readmore_button_margintop" step="1" value="<?php echo esc_attr( $readmore_button_margintop ); ?>"  onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<div class="bdp-boxshadow-cover">
										<div class="bdp-boxshadow-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-boxshadow-content">
											<?php $readmore_button_marginbottom = isset( $bdp_settings['readmore_button_marginbottom'] ) ? $bdp_settings['readmore_button_marginbottom'] : 0; ?>
											<input type="number" id="readmore_button_marginbottom" name="readmore_button_marginbottom" step="1" value="<?php echo esc_attr( $readmore_button_marginbottom ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</li>
							<h3 class="read_more_wrap bdp-table-title read_more_text_typography_setting"><?php esc_html_e( 'Read More Typography Settings', 'blog-designer-pro' ); ?></h3>
							<li class="read_more_wrap read_more_text_typography_setting">
								<div class="bdp-typography-wrapper bdp-typography-wrapper1">
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select read more button font family', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											if ( isset( $bdp_settings['readmore_font_family'] ) && '' != $bdp_settings['readmore_font_family'] ) {
												$readmore_font_family = $bdp_settings['readmore_font_family'];
											} else {
												$readmore_font_family = '';
											}
											?>
											<div class="typo-field">
												<input type="hidden" id="readmore_font_family_font_type" name="readmore_font_family_font_type" value="<?php echo isset( $bdp_settings['readmore_font_family_font_type'] ) ? esc_attr( $bdp_settings['readmore_font_family_font_type'] ) : ''; ?>">
												<div class="select-cover">
													<select name="readmore_font_family" id="readmore_font_family">
														<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
														<?php
														$old_version = '';
														$cnt         = 0;
														foreach ( $font_family as $key => $value ) {
															if ( $value['version'] != $old_version ) {
																if ( $cnt > 0 ) {
																	echo '</optgroup>';
																}
																echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																$old_version = $value['version'];
															}
															echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
															if ( '' != $readmore_font_family && ( str_replace( '"', '', $readmore_font_family ) == str_replace( '"', '', $value['label'] ) ) ) {
																echo ' selected';
															}
															echo '>' . esc_html( $value['label'] ) . '</option>';
															$cnt++;
														}
														if ( count( $font_family ) == $cnt ) {
															echo '</optgroup>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font size for read more button', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
										<?php $readmore_fontsize = isset( $bdp_settings['readmore_fontsize'] ) ? $bdp_settings['readmore_fontsize'] : '14'; ?>
											<div class="grid_col_space range_slider_fontsize" id="readmore_fontsize_slider" data-value="<?php echo esc_attr( $readmore_fontsize ); ?>"></div>
											<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="readmore_fontsize" id="readmore_fontsize" value="<?php echo esc_attr( $readmore_fontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select font weight', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $readmore_font_weight = isset( $bdp_settings['readmore_font_weight'] ) ? $bdp_settings['readmore_font_weight'] : 'normal'; ?>
											<div class="select-cover">
												<select name="readmore_font_weight" id="readmore_font_weight">
													<option value="100" <?php selected( $readmore_font_weight, 100 ); ?>>100</option>
													<option value="200" <?php selected( $readmore_font_weight, 200 ); ?>>200</option>
													<option value="300" <?php selected( $readmore_font_weight, 300 ); ?>>300</option>
													<option value="400" <?php selected( $readmore_font_weight, 400 ); ?>>400</option>
													<option value="500" <?php selected( $readmore_font_weight, 500 ); ?>>500</option>
													<option value="600" <?php selected( $readmore_font_weight, 600 ); ?>>600</option>
													<option value="700" <?php selected( $readmore_font_weight, 700 ); ?>>700</option>
													<option value="800" <?php selected( $readmore_font_weight, 800 ); ?>>800</option>
													<option value="900" <?php selected( $readmore_font_weight, 900 ); ?>>900</option>
													<option value="bold" <?php selected( $readmore_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
													<option value="normal" <?php selected( $readmore_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter line height', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<div class="input-type-number">
												<input type="number" name="readmore_font_line_height" id="readmore_font_line_height" step="0.1" min="0" value="<?php echo isset( $bdp_settings['readmore_font_line_height'] ) ? esc_attr( $bdp_settings['readmore_font_line_height'] ) : '1.5'; ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display italic font style', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $readmore_font_italic = isset( $bdp_settings['readmore_font_italic'] ) ? $bdp_settings['readmore_font_italic'] : '0'; ?>
											<fieldset class="bdp-social-options bdp-display_author buttonset">
												<input id="readmore_font_italic_1" name="readmore_font_italic" type="radio" value="1"  <?php checked( 1, $readmore_font_italic ); ?> />
												<label for="readmore_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="readmore_font_italic_0" name="readmore_font_italic" type="radio" value="0" <?php checked( 0, $readmore_font_italic ); ?> />
												<label for="readmore_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text transform style', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $readmore_font_text_transform = isset( $bdp_settings['readmore_font_text_transform'] ) ? $bdp_settings['readmore_font_text_transform'] : 'none'; ?>
												<div class="select-cover">
													<select name="readmore_font_text_transform" id="readmore_font_text_transform">
														<option <?php selected( $readmore_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $readmore_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $readmore_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $readmore_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $readmore_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
													</select>
												</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text decoration style', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $readmore_font_text_decoration = isset( $bdp_settings['readmore_font_text_decoration'] ) ? $bdp_settings['readmore_font_text_decoration'] : 'none'; ?>
											<div class="select-cover">
												<select name="readmore_font_text_decoration" id="readmore_font_text_decoration">
													<option <?php selected( $readmore_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
													<option <?php selected( $readmore_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
												</select>
											</div>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
											<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter letter spacing', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<div class="input-type-number">
												<input type="number" name="readmore_font_letter_spacing" id="readmore_font_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['readmore_font_letter_spacing'] ) ? esc_attr( $bdp_settings['readmore_font_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="sprecrum_date_color">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Use Readmore Color Selection on Date', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Use readmore color selection on date', 'blog-designer-pro' ); ?></span></span>
									<label>
										<input id="date_color_of_readmore" name="date_color_of_readmore" type="checkbox" value="1" 
										<?php
										if ( isset( $bdp_settings['date_color_of_readmore'] ) ) {
											checked( 1, $bdp_settings['date_color_of_readmore'] );
										}
										?>
										/>
									</label>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdpmedia" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpmedia_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li class="display_feature_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Product Feature Image', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show/Hide product feature image', 'blog-designer-pro' ); ?></span></span>
									<?php $display_feature_image = isset( $bdp_settings['display_feature_image'] ) ? $bdp_settings['display_feature_image'] : '1'; ?>
									<fieldset class="bdp-social-options bdp-display_feature_image buttonset">
										<input id="display_feature_image_1" name="display_feature_image" type="radio" value="1" <?php echo checked( 1, $display_feature_image ); ?> />
										<label for="display_feature_image_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_feature_image_0" name="display_feature_image" type="radio" value="0" <?php echo checked( 0, $display_feature_image ); ?> />
										<label for="display_feature_image_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="easy_timeline_effect_tr display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Products Effect', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select transition effect', 'blog-designer-pro' ); ?></span></span>
									<?php $easy_timeline_effect = isset( $bdp_settings['easy_timeline_effect'] ) ? $bdp_settings['easy_timeline_effect'] : 'default-effect'; ?>
									<select name="easy_timeline_effect" id="easy_timeline_effect">
										<option value="default-effect" <?php echo ( 'default-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Default', 'blog-designer-pro' ); ?></option>
										<option value="slide-down-up-effect" <?php echo ( 'slide-down-up-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Slide Down Up', 'blog-designer-pro' ); ?></option>
										<option value="slide-up-down-effect" <?php echo ( 'slide-up-down-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Slide Up Down', 'blog-designer-pro' ); ?></option>
										<option value="slide-right-left-effect" <?php echo ( 'slide-right-left-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Slide Right Left', 'blog-designer-pro' ); ?></option>
										<option value="slide-left-right-effect" <?php echo ( 'slide-left-right-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Slide Left Right', 'blog-designer-pro' ); ?></option>
										<option value="flip-effect" <?php echo ( 'flip-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Flip Effect', 'blog-designer-pro' ); ?></option>
										<option value="transformation-effect" <?php echo ( 'transformation-effect' === $easy_timeline_effect ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Transformation Eeffect', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="thumbnail_skin_tr display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Thumbnail Skin', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product thumbnail shape', 'blog-designer-pro' ); ?></span></span>
									<?php $thumbnail_skin = ( isset( $bdp_settings['thumbnail_skin'] ) ) ? $bdp_settings['thumbnail_skin'] : 1; ?>
									<fieldset class="bdp-thumbnail_skin buttonset buttonset-hide green" data-hide='1'>
										<input id="thumbnail_skin_0" name="thumbnail_skin" type="radio" value="0" <?php checked( 0, $thumbnail_skin ); ?> />
										<label id="bdp-options-button" for="thumbnail_skin_0" <?php checked( 0, $thumbnail_skin ); ?>><?php esc_html_e( 'Square', 'blog-designer-pro' ); ?></label>
										<input id="thumbnail_skin_1" name="thumbnail_skin" type="radio" value="1" <?php checked( 1, $thumbnail_skin ); ?> />
										<label id="bdp-options-button" for="thumbnail_skin_1" <?php checked( 1, $thumbnail_skin ); ?>><?php esc_html_e( 'Circle', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="blog-grid-height-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Grid Height', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select height of the product', 'blog-designer-pro' ); ?></span></span>
									<?php $blog_grid_height = ( isset( $bdp_settings['blog_grid_height'] ) ) ? $bdp_settings['blog_grid_height'] : 1; ?>
									<fieldset class="buttonset blog_grid_height green">
										<input id="blog_grid_height_0" name="blog_grid_height" type="radio" value="0" <?php checked( 0, $blog_grid_height ); ?> />
										<label id="bdp-options-button" for="blog_grid_height_0" <?php checked( 0, $blog_grid_height ); ?>><?php esc_html_e( 'Full', 'blog-designer-pro' ); ?></label>
										<input id="blog_grid_height_1" name="blog_grid_height" type="radio" value="1" <?php checked( 1, $blog_grid_height ); ?> />
										<label id="bdp-options-button" for="blog_grid_height_1" <?php checked( 1, $blog_grid_height ); ?>><?php esc_html_e( 'Fixed', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="blog-post-grid-height-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Grid Height', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter blog product grid height', 'blog-designer-pro' ); ?></span></span>
									<?php $template_grid_height = ( isset( $bdp_settings['template_grid_height'] ) ) ? $bdp_settings['template_grid_height'] : 300; ?>
									<input type="number" name="template_grid_height" id="template_grid_height" value="<?php echo esc_attr( $template_grid_height ); ?>"/>
								</div>
							</li>
							<li class="blog-gridskin-tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Grid Skin', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select grid skin from available options', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_grid_skin'] = ( isset( $bdp_settings['template_grid_skin'] ) && '' != $bdp_settings['template_grid_skin'] ) ? $bdp_settings['template_grid_skin'] : 'default'; ?>
									<select name="template_grid_skin" id="template_grid_skin">
										<option value="default" 
										<?php
										if ( 'default' === $bdp_settings['template_grid_skin'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Default Skin', 'blog-designer-pro' ); ?>
										</option>
										<option value="repeat" 
										<?php
										if ( 'repeat' === $bdp_settings['template_grid_skin'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Repeat Skin', 'blog-designer-pro' ); ?>
										</option>
										<option class="only_explore" value="reverse" 
										<?php
										if ( 'reverse' === $bdp_settings['template_grid_skin'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Reverse Skin', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="gridcol_space_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Grid column space', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Set spacing between products', 'blog-designer-pro' ); ?></span></span>
									<?php $grid_col_space = ( isset( $bdp_settings['grid_col_space'] ) && '' != $bdp_settings['grid_col_space'] ) ? $bdp_settings['grid_col_space'] : 10; ?>
										<div class="grid_col_space" id="grid_col_spaceInputId" ></div>
										<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="grid_col_space" id="grid_col_spaceOutputId" value="<?php echo esc_attr( $grid_col_space ); ?>" /></div><?php esc_html_e( 'px', 'blog-designer-pro' ); ?>
								</div>
							</li>
							<li class="display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Image Link', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show product image link', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_post_image_link = isset( $bdp_settings['bdp_post_image_link'] ) ? $bdp_settings['bdp_post_image_link'] : '1'; ?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="bdp_post_image_link_1" name="bdp_post_image_link" type="radio" value="1" <?php checked( 1, $bdp_post_image_link ); ?> />
										<label id="bdp-options-button" for="bdp_post_image_link_1" <?php checked( 1, $bdp_post_image_link ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="bdp_post_image_link_0" name="bdp_post_image_link" type="radio" value="0" <?php checked( 0, $bdp_post_image_link ); ?> />
										<label id="bdp-options-button" for="bdp_post_image_link_0" <?php checked( 0, $bdp_post_image_link ); ?>><?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="bdp-image-hover-effect display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Image Hover Effect', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable image hover effect', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_image_hover_effect = isset( $bdp_settings['bdp_image_hover_effect'] ) ? $bdp_settings['bdp_image_hover_effect'] : '0'; ?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="bdp_image_hover_effect_1" name="bdp_image_hover_effect" type="radio" value="1" <?php checked( 1, $bdp_image_hover_effect ); ?> />
										<label id="bdp-options-button" for="bdp_image_hover_effect_1" <?php checked( 1, $bdp_image_hover_effect ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="bdp_image_hover_effect_0" name="bdp_image_hover_effect" type="radio" value="0" <?php checked( 0, $bdp_image_hover_effect ); ?> />
										<label id="bdp-options-button" for="bdp_image_hover_effect_0" <?php checked( 0, $bdp_image_hover_effect ); ?>><?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="bdp-image-hover-effect-tr bdp-image-hover-effect display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Product Image Hover Effect', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select image hover effect', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_image_hover_effect_type = isset( $bdp_settings['bdp_image_hover_effect_type'] ) ? $bdp_settings['bdp_image_hover_effect_type'] : 'zoom_in'; ?>
									<select name="bdp_image_hover_effect_type" id="bdp_image_hover_effect_type">
										<option value="blur" <?php echo ( 'blur' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Blur', 'blog-designer-pro' ); ?></option>
										<option value="flashing" <?php echo ( 'flashing' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Flashing', 'blog-designer-pro' ); ?></option>
										<option value="gray_scale" <?php echo ( 'gray_scale' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Gray Scale', 'blog-designer-pro' ); ?></option>
										<option value="opacity" <?php echo ( 'opacity' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Opacity', 'blog-designer-pro' ); ?></option>
										<option value="sepia" <?php echo ( 'sepia' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Sepia', 'blog-designer-pro' ); ?></option>
										<option value="slide" <?php echo ( 'slide' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Slide', 'blog-designer-pro' ); ?></option>
										<option value="shine" <?php echo ( 'shine' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Shine', 'blog-designer-pro' ); ?></option>
										<option value="shine_circle" <?php echo ( 'shine_circle' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Shine Circle', 'blog-designer-pro' ); ?></option>
										<option value="zoom_in" <?php echo ( 'zoom_in' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Zoom In', 'blog-designer-pro' ); ?></option>
										<option value="zoom_out" <?php echo ( 'zoom_out' === $bdp_image_hover_effect_type ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Zoom Out', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Product Default Image', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product Default Image', 'blog-designer-pro' ); ?></span></span>
									<span class="bdp_default_image_holder">
										<?php
										if ( isset( $bdp_settings['bdp_default_image_src'] ) && '' != $bdp_settings['bdp_default_image_src'] ) {
											echo '<img src="' . esc_url( $bdp_settings['bdp_default_image_src'] ) . '"/>';
										}
										?>
									</span>
									<?php if ( isset( $bdp_settings['bdp_default_image_src'] ) && '' != $bdp_settings['bdp_default_image_src'] ) { ?>
										<input id="bdp-image-action-button" class="button bdp-remove_image_button" type="button" value="<?php esc_attr_e( 'Remove Image', 'blog-designer-pro' ); ?>">
									<?php } else { ?>
										<input class="button bdp-upload_image_button" type="button" value="<?php esc_attr_e( 'Upload Image', 'blog-designer-pro' ); ?>">
									<?php } ?>
									<input type="hidden" value="<?php echo isset( $bdp_settings['bdp_default_image_id'] ) ? esc_attr( $bdp_settings['bdp_default_image_id'] ) : ''; ?>" name="bdp_default_image_id" id="bdp_default_image_id">
									<input type="hidden" value="<?php echo isset( $bdp_settings['bdp_default_image_src'] ) ? esc_attr( $bdp_settings['bdp_default_image_src'] ) : ''; ?>" name="bdp_default_image_src" id="bdp_default_image_src">
								</div>
							</li>
							<li class="bdp_media_size_tr display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Product Media Size', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select size of product media', 'blog-designer-pro' ); ?></span></span>
									<select id="bdp_media_size" name="bdp_media_size">
										<option value="full" <?php echo ( isset( $bdp_settings['bdp_media_size'] ) && 'full' === $bdp_settings['bdp_media_size'] ) ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Original Resolution', 'blog-designer-pro' ); ?></option>
										<?php
										global $_wp_additional_image_sizes;
										$thumb_sizes = array();
										$image_size  = get_intermediate_image_sizes();
										foreach ( $image_size as $s ) {
											$thumb_sizes [ $s ] = array( 0, 0 );
											if ( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ) {
												?>
												<option value="<?php echo esc_attr( $s ); ?>" <?php echo ( isset( $bdp_settings['bdp_media_size'] ) && $bdp_settings['bdp_media_size'] == $s ) ? 'selected="selected"' : ''; ?>> <?php echo esc_html( $s ) . ' (' . esc_html( get_option( $s . '_size_w' ) ) . 'x' . esc_html( get_option( $s . '_size_h' ) ) . ')'; ?> </option>
												<?php
											} else {
												if ( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) ) {
													?>
													<option value="<?php echo esc_attr( $s ); ?>" <?php echo ( isset( $bdp_settings['bdp_media_size'] ) && $bdp_settings['bdp_media_size'] == $s ) ? 'selected="selected"' : ''; ?>> <?php echo esc_html( $s ) . ' (' . esc_html( $_wp_additional_image_sizes[ $s ]['width'] ) . 'x' . esc_html( $_wp_additional_image_sizes[ $s ]['height'] ) . ')'; ?> </option>
													<?php
												}
											}
										}
										?>
										<option value="custom" <?php echo ( isset( $bdp_settings['bdp_media_size'] ) && 'custom' === $bdp_settings['bdp_media_size'] ) ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'Custom Size', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="bdp_media_custom_size_tr display_image_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Add Custom Size', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Enter custom size for product media', 'blog-designer-pro' ); ?></span></span>
									<div class="bdp_media_custom_size_tbl">
										<p> <span class="bdp_custom_media_size_title"><?php esc_html_e( 'Width (px)', 'blog-designer-pro' ); ?> </span> <input type="number" min="1" name="media_custom_width" class="media_custom_width" id="media_custom_width" value="<?php echo ( isset( $bdp_settings['media_custom_width'] ) && '' != $bdp_settings['media_custom_width'] ) ? esc_attr( $bdp_settings['media_custom_width'] ) : ''; ?>" /> </p>
										<p> <span class="bdp_custom_media_size_title"><?php esc_html_e( 'Height (px)', 'blog-designer-pro' ); ?> </span> <input type="number" min="1" name="media_custom_height" class="media_custom_height" id="media_custom_height" value="<?php echo ( isset( $bdp_settings['media_custom_height'] ) && '' != $bdp_settings['media_custom_height'] ) ? esc_attr( $bdp_settings['media_custom_height'] ) : ''; ?>"/> </p>
									</div>
								</div>
							</li>

							<li class="enable_lazy_load">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Enable Lazy Load?', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Lazy Load Image', 'blog-designer-pro' ); ?></span></span>
									<?php
									$enable_lazy_load = 0;
									$enable_lazy_load = isset( $bdp_settings['enable_lazy_load'] ) ? $bdp_settings['enable_lazy_load'] : '1';
									?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="enable_lazy_load_1" name="enable_lazy_load" type="radio" value="1" <?php checked( 1, $enable_lazy_load ); ?> />
										<label id="bdp-options-button" for="enable_lazy_load_1" <?php checked( 1, $enable_lazy_load ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="enable_lazy_load_0" name="enable_lazy_load" type="radio" value="0" <?php checked( 0, $enable_lazy_load ); ?> />
										<label id="bdp-options-button" for="enable_lazy_load_0" <?php checked( 0, $enable_lazy_load ); ?>><?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="enable_lazy_load_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Enable Lazy Load Blurred Image?', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable Lazy Load Blurred Image', 'blog-designer-pro' ); ?></span></span>
									<?php
									$enable_lazy_load_blur_image = 0;
									$enable_lazy_load_blur_image = isset( $bdp_settings['enable_lazy_load_blur_image'] ) ? $bdp_settings['enable_lazy_load_blur_image'] : '1';
									?>
									<fieldset class="buttonset buttonset-hide" data-hide='1'>
										<input id="enable_lazy_load_blur_image_1" name="enable_lazy_load_blur_image" type="radio" value="1" <?php checked( 1, $enable_lazy_load_blur_image ); ?> />
										<label id="bdp-options-button" for="enable_lazy_load_blur_image_1" <?php checked( 1, $enable_lazy_load_blur_image ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="enable_lazy_load_blur_image_0" name="enable_lazy_load_blur_image" type="radio" value="0" <?php checked( 0, $enable_lazy_load_blur_image ); ?> />
										<label id="bdp-options-button" for="enable_lazy_load_blur_image_0" <?php checked( 0, $enable_lazy_load_blur_image ); ?>><?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="enable_lazy_load_setting">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Lazy Load Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Lazy Load Color', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="template_lazy_load_color" id="template_lazy_load_color" value="<?php echo isset( $bdp_settings['template_lazy_load_color'] ) ? esc_attr( $bdp_settings['template_lazy_load_color'] ) : '#000000'; ?>"/>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdpslider" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpslider_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li class="bdp-slider-effect">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Slider Effect', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select effect for slider layout', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_slider_effect'] = ( isset( $bdp_settings['template_slider_effect'] ) ) ? $bdp_settings['template_slider_effect'] : ''; ?>
									<select name="template_slider_effect" id="template_slider_effect">
										<option value="slide" 
										<?php
										if ( 'slide' === $bdp_settings['template_slider_effect'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Slide', 'blog-designer-pro' ); ?>
										</option>
										<option value="fade" 
										<?php
										if ( 'fade' === $bdp_settings['template_slider_effect'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( 'Fade', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="slider_columns_tr">
								<div class="bdp-left">
									<span class="bdp-key-title bdp-key-title2">
										<?php esc_html_e( 'Slider Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Desktop - Above', 'blog-designer-pro' ) . ' 980px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for slider', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_slider_columns'] = ( isset( $bdp_settings['template_slider_columns'] ) ) ? $bdp_settings['template_slider_columns'] : 2; ?>
									<select name="template_slider_columns" id="template_slider_columns">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_slider_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_slider_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_slider_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_slider_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="5" 
										<?php
										if ( '5' === $bdp_settings['template_slider_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '5 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="6" 
										<?php
										if ( '6' === $bdp_settings['template_slider_columns'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '6 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="slider_columns_tr">
								<div class="bdp-left">
									<span class="bdp-key-title bdp-key-title2">
										<?php esc_html_e( 'Slider Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'iPad', 'blog-designer-pro' ) . ' - 720px - 980px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for slider', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_slider_columns_ipad'] = ( isset( $bdp_settings['template_slider_columns_ipad'] ) ) ? $bdp_settings['template_slider_columns_ipad'] : 2; ?>
									<select name="template_slider_columns_ipad" id="template_slider_columns_ipad">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_slider_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_slider_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_slider_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_slider_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="5" 
										<?php
										if ( '5' === $bdp_settings['template_slider_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '5 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="6" 
										<?php
										if ( '6' === $bdp_settings['template_slider_columns_ipad'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '6 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>

							<li class="slider_columns_tr">
								<div class="bdp-left">
									<span class="bdp-key-title bdp-key-title2">
										<?php esc_html_e( 'Slider Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Tablet', 'blog-designer-pro' ) . ' - 480px - 720px</i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for slider', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_slider_columns_tablet'] = ( isset( $bdp_settings['template_slider_columns_tablet'] ) ) ? $bdp_settings['template_slider_columns_tablet'] : 2; ?>
									<select name="template_slider_columns_tablet" id="template_slider_columns_tablet">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_slider_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_slider_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_slider_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_slider_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="5" 
										<?php
										if ( '5' === $bdp_settings['template_slider_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '5 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="6" 
										<?php
										if ( '6' === $bdp_settings['template_slider_columns_tablet'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '6 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>

							<li class="slider_columns_tr">
								<div class="bdp-left">
									<span class="bdp-key-title bdp-key-title2">
										<?php esc_html_e( 'Slider Columns', 'blog-designer-pro' ); ?>
										<?php echo '<br />(<i>' . esc_html__( 'Mobile - Smaller Than', 'blog-designer-pro' ) . ' 480px </i>)'; ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select column for slider', 'blog-designer-pro' ); ?></span></span>
									<?php $bdp_settings['template_slider_columns_mobile'] = ( isset( $bdp_settings['template_slider_columns_mobile'] ) ) ? $bdp_settings['template_slider_columns_mobile'] : 1; ?>
									<select name="template_slider_columns_mobile" id="template_slider_columns_mobile">
										<option value="1" 
										<?php
										if ( '1' == $bdp_settings['template_slider_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '1 Column', 'blog-designer-pro' ); ?>
										</option>
										<option value="2" 
										<?php
										if ( '2' === $bdp_settings['template_slider_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '2 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="3" 
										<?php
										if ( '3' === $bdp_settings['template_slider_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '3 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="4" 
										<?php
										if ( '4' === $bdp_settings['template_slider_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '4 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="5" 
										<?php
										if ( '5' === $bdp_settings['template_slider_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '5 Columns', 'blog-designer-pro' ); ?>
										</option>
										<option value="6" 
										<?php
										if ( '6' === $bdp_settings['template_slider_columns_mobile'] ) {
											?>
											selected="selected"<?php } ?>>
											<?php esc_html_e( '6 Columns', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="slider_scroll_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Slide to Scroll', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select number of slide to scroll', 'blog-designer-pro' ); ?></span></span>
									<?php $template_slider_scroll = isset( $bdp_settings['template_slider_scroll'] ) ? $bdp_settings['template_slider_scroll'] : '1'; ?>
									<select name="template_slider_scroll" id="template_slider_scroll">
										<option value="1" 
										<?php
										if ( '1' == $template_slider_scroll ) {
											?>
											selected="selected"<?php } ?>>1</option>
										<option value="2" 
										<?php
										if ( '2' === $template_slider_scroll ) {
											?>
											selected="selected"<?php } ?>>2</option>
										<option value="3" 
										<?php
										if ( '3' === $template_slider_scroll ) {
											?>
											selected="selected"<?php } ?>>3</option>
									</select>
								</div>
							</li>

							<li class="bdp_slider_navigation">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Slider Navigation', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show slider navigation', 'blog-designer-pro' ); ?></span></span>
									<?php $display_slider_navigation = isset( $bdp_settings['display_slider_navigation'] ) ? $bdp_settings['display_slider_navigation'] : '1'; ?>
									<fieldset class="bdp-social-options bdp-display_slider_navigation buttonset buttonset-hide ui-buttonset">
										<input id="display_slider_navigation_1" name="display_slider_navigation" type="radio" value="1" <?php checked( 1, $display_slider_navigation ); ?> />
										<label for="display_slider_navigation_1" <?php checked( 1, $display_slider_navigation ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_slider_navigation_0" name="display_slider_navigation" type="radio" value="0" <?php checked( 0, $display_slider_navigation ); ?> />
										<label for="display_slider_navigation_0" <?php checked( 0, $display_slider_navigation ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="select_slider_navigation_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Slider Navigation Icon', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select Slider navigation icon', 'blog-designer-pro' ); ?></span></span>
									<?php $slider_navigation = isset( $bdp_settings['navigation_style_hidden'] ) ? $bdp_settings['navigation_style_hidden'] : 'navigation3'; ?>
									<div class="select_button_upper_div ">
										<div class="bdp_select_template_button_div">
											<input type="button" class="button bdp_select_navigation" value="<?php esc_attr_e( 'Select Navigation', 'blog-designer-pro' ); ?>">
											<input style="visibility: hidden;" type="hidden" id="navigation_style_hidden" class="navigation_style_hidden" name="navigation_style_hidden" value="<?php echo esc_attr( $slider_navigation ); ?>" />
										</div>
										<div class="bdp_selected_navigation_image">
											<div class="bdp-dialog-navigation-style slider_controls" >
												<div class="bdp_navigation_image_holder navigation_hidden" >
													<img src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/public/images/navigation/' . esc_attr( $slider_navigation ) . '.png'; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Slider Controls', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show slider control', 'blog-designer-pro' ); ?></span></span>
									<?php $display_slider_controls = isset( $bdp_settings['display_slider_controls'] ) ? $bdp_settings['display_slider_controls'] : '1'; ?>
									<fieldset class="bdp-social-options bdp-display_slider_controls buttonset buttonset-hide ui-buttonset">
										<input id="display_slider_controls_1" name="display_slider_controls" type="radio" value="1" <?php checked( 1, $display_slider_controls ); ?> />
										<label for="display_slider_controls_1" <?php checked( 1, $display_slider_controls ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_slider_controls_0" name="display_slider_controls" type="radio" value="0" <?php checked( 0, $display_slider_controls ); ?> />
										<label for="display_slider_controls_0" <?php checked( 0, $display_slider_controls ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="select_slider_controls_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select Slider Arrow', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select slider arrow icon', 'blog-designer-pro' ); ?></span></span>
									<?php $slider_arrow = isset( $bdp_settings['arrow_style_hidden'] ) ? $bdp_settings['arrow_style_hidden'] : 'arrow1'; ?>
									<div class="select_button_upper_div ">
										<div class="bdp_select_template_button_div">
											<input type="button" class="button bdp_select_arrow" value="<?php esc_attr_e( 'Select Arrow', 'blog-designer-pro' ); ?>">
											<input style="visibility: hidden;" type="hidden" id="arrow_style_hidden" class="arrow_style_hidden" name="arrow_style_hidden" value="<?php echo esc_attr( $slider_arrow ); ?>" />
										</div>
										<div class="bdp_selected_arrow_image">
											<div class="bdp-dialog-arrow-style slider_controls" >
												<div class="bdp_arrow_image_holder arrow_hidden" >
													<img src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/public/images/arrow/' . esc_attr( $slider_arrow ) . '.png'; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="post-slider-thumb">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Post Slider with Thumbnail', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show thumbnail with post slider', 'blog-designer-pro' ); ?></span></span>
									<?php $post_slider_thumb = isset( $bdp_settings['post_slider_thumb'] ) ? $bdp_settings['post_slider_thumb'] : '1'; ?>
									<fieldset class="bdp-social-options bdp-post_slider_thumb buttonset buttonset-hide ui-buttonset">
										<input id="post_slider_thumb_1" name="post_slider_thumb" type="radio" value="1" <?php checked( 1, $post_slider_thumb ); ?> />
										<label for="post_slider_thumb_1" <?php checked( 1, $post_slider_thumb ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="post_slider_thumb_0" name="post_slider_thumb" type="radio" value="0" <?php checked( 0, $post_slider_thumb ); ?> />
										<label for="post_slider_thumb_0" <?php checked( 0, $post_slider_thumb ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="bdp-slider-autoplay">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Slider Autoplay', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show slider autoplay', 'blog-designer-pro' ); ?></span></span>
									<?php $slider_autoplay = isset( $bdp_settings['slider_autoplay'] ) ? $bdp_settings['slider_autoplay'] : '1'; ?>
									<fieldset class="bdp-social-options bdp-slider_autoplay buttonset buttonset-hide ui-buttonset">
										<input id="slider_autoplay_1" name="slider_autoplay" type="radio" value="1" <?php checked( 1, $slider_autoplay ); ?> />
										<label for="slider_autoplay_1" <?php checked( 1, $slider_autoplay ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="slider_autoplay_0" name="slider_autoplay" type="radio" value="0" <?php checked( 0, $slider_autoplay ); ?> />
										<label for="slider_autoplay_0" <?php checked( 0, $slider_autoplay ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>

							<li class="slider_autoplay_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Enter slider autoplay intervals(ms)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter slider autoplay intervals', 'blog-designer-pro' ); ?></span></span>
									<?php $slider_autoplay_intervals = isset( $bdp_settings['slider_autoplay_intervals'] ) ? $bdp_settings['slider_autoplay_intervals'] : '1'; ?>
									<input type="number" id="slider_autoplay_intervals" name="slider_autoplay_intervals" step="1" min="0" value="<?php echo isset( $bdp_settings['slider_autoplay_intervals'] ) ? esc_attr( $bdp_settings['slider_autoplay_intervals'] ) : '3000'; ?>" placeholder="<?php esc_attr_e( 'Enter slider intervals', 'blog-designer-pro' ); ?>" onkeypress="return isNumberKey(event)">
								</div>
							</li>

							<li class="slider_autoplay_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Slider Speed(ms)', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter slider speed', 'blog-designer-pro' ); ?></span></span>
									<?php $slider_speed = isset( $bdp_settings['slider_speed'] ) ? $bdp_settings['slider_speed'] : '300'; ?>
									<input type="number" id="slider_speed" name="slider_speed" step="1" min="0" value="<?php echo isset( $bdp_settings['slider_speed'] ) ? esc_attr( $bdp_settings['slider_speed'] ) : '300'; ?>" placeholder="<?php esc_attr_e( 'Enter slider intervals', 'blog-designer-pro' ); ?>" onkeypress="return isNumberKey(event)">
								</div>
							</li>
							<li class="bdp_3d_number_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Number of Posts in slider', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter Number of posts to be shown in showcase page.', 'blog-designer-pro' ); ?></span></span>
									<?php $number_post = isset( $bdp_settings['bdp_number_post'] ) ? $bdp_settings['bdp_number_post'] : '5'; ?>
									<input type="number" id="bdp_number_post" name="bdp_number_post" step="1" min="0" value="<?php echo isset( $bdp_settings['bdp_number_post'] ) ? esc_attr( $bdp_settings['bdp_number_post'] ) : '5'; ?>" placeholder="<?php esc_attr_e( 'Enter slider distance', 'blog-designer-pro' ); ?>" onkeypress="return isNumberKey(event)">
									<p>
									<strong>Note: </strong>If Template  is "3D-Carousel" then set only odd number ex. 3,5,7,...
									</p>
								</div>
							</li>
							<li class="bdp_3d_image_slider_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Add Custom Size for slider', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color">
										<span class="bdp-tooltips"><?php esc_html_e( 'Enter custom size for 3d slider image', 'blog-designer-pro' ); ?>
										</span>
									</span>
									<div class="bdp_3d_slider_custom_size_tbl">
										<p> <span class="bdp_custom_3d_slider_size_title">
											<?php
											esc_html_e( 'Width', 'blog-designer-pro' );
											echo ' (px)';
											?>
											</span> <input type="number" min="1" name="slider_custom_width" class="slider_custom_width" id="slider_custom_width" value="<?php echo ( isset( $bdp_settings['slider_custom_width'] ) && '' != $bdp_settings['slider_custom_width'] ) ? esc_attr( $bdp_settings['slider_custom_width'] ) : ''; ?>" /></p>
											<p> <span class="bdp_custom_3d_slider_size_title">
											<?php
											esc_html_e( 'Height', 'blog-designer-pro' );
											echo ' (px)';
											?>
										</span> <input type="number" min="1" name="slider_custom_height" class="slider_custom_height" id="slider_custom_height" value="<?php echo ( isset( $bdp_settings['slider_custom_height'] ) && '' != $bdp_settings['slider_custom_height'] ) ? esc_attr( $bdp_settings['slider_custom_height'] ) : ''; ?>"/> </p>
									</div>
								</div>
							</li>
							<li class="bdp_3d_slider_distance_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Distance Between Two Slider', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter distance between two slider', 'blog-designer-pro' ); ?></span></span>
									<?php $slider_distance = isset( $bdp_settings['slider_distance'] ) ? $bdp_settings['slider_distance'] : '120'; ?>
									<input type="number" id="slider_distance" name="slider_distance" step="1" min="0" value="<?php echo isset( $bdp_settings['slider_distance'] ) ? esc_attr( $bdp_settings['slider_distance'] ) : '120'; ?>" placeholder="<?php esc_attr_e( 'Enter slider distance', 'blog-designer-pro' ); ?>" onkeypress="return isNumberKey(event)">
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdpfilter" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpfilter_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li class="date_from_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Date', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select display product date', 'blog-designer-pro' ); ?></span></span>
									<?php
									$dsiplay_date_from = isset( $bdp_settings['dsiplay_date_from'] ) ? $bdp_settings['dsiplay_date_from'] : 'publish';
									?>

									<select name="dsiplay_date_from" id="dsiplay_date_from">
										<option value="publish"  <?php echo selected( 'publish', $dsiplay_date_from ); ?>><?php esc_html_e( 'Publish Date', 'blog-designer-pro' ); ?></option>
										<option value="modify"  <?php echo selected( 'modify', $dsiplay_date_from ); ?>><?php esc_html_e( 'Last Modify Date', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="post_date_format_tr">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Date Format', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product date format', 'blog-designer-pro' ); ?></span></span>
									<?php $post_date_format = isset( $bdp_settings['post_date_format'] ) ? $bdp_settings['post_date_format'] : 'default'; ?>

									<select name="post_date_format" id="post_date_format">
										<option value="default"  <?php echo selected( 'default', $post_date_format ); ?>><?php esc_html_e( 'Default', 'blog-designer-pro' ); ?></option>
										<option value="F j, Y g:i a"  <?php echo selected( 'F j, Y g:i a', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'F j, Y g:i a' ) ); ?></option>
										<option value="F j, Y"  <?php echo selected( 'F j, Y', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'F j, Y' ) ); ?></option>
										<option value="F, Y"  <?php echo selected( 'F, Y', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'F, Y' ) ); ?></option>
										<option value="j F  Y"  <?php echo selected( 'j F  Y', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'j F  Y' ) ); ?></option>
										<option value="g:i a"  <?php echo selected( 'g:i a', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'g:i a' ) ); ?></option>
										<option value="g:i:s a"  <?php echo selected( 'g:i:s a', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'g:i:s a' ) ); ?></option>
										<option value="l, F jS, Y"  <?php echo selected( 'l, F jS, Y', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'l, F jS, Y' ) ); ?></option>
										<option value="M j, Y @ G:i"  <?php echo selected( 'M j, Y @ G:i', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'M j, Y @ G:i' ) ); ?></option>
										<option value="Y/m/d g:i:s A"  <?php echo selected( 'Y/m/d g:i:s A', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'Y/m/d g:i:s A' ) ); ?></option>
										<option value="Y/m/d"  <?php echo selected( 'Y/m/d', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'Y/m/d' ) ); ?></option>
										<option value="d.m.Y"  <?php echo selected( 'd.m.Y', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'd.m.Y' ) ); ?></option>
										<option value="d-m-Y"  <?php echo selected( 'd-m-Y', $post_date_format ); ?>><?php echo esc_attr( get_the_time( 'd-m-Y' ) ); ?></option>
									</select>
								</div>
							</li>

							<li class="archive_blog_order_by">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Blog Order by', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select the order of product', 'blog-designer-pro' ); ?></span></span>
									<?php
									$orderby = '';
									if ( isset( $bdp_settings['bdp_blog_order_by'] ) ) {
										$orderby = $bdp_settings['bdp_blog_order_by'];
									}
									?>
									<select id="bdp_blog_order_by" name="bdp_blog_order_by">
										<option value="rand" <?php echo selected( 'rand', $orderby ); ?>><?php esc_html_e( 'Random', 'blog-designer-pro' ); ?></option>
										<option value="ID" <?php echo selected( 'ID', $orderby ); ?>><?php esc_html_e( 'Product ID', 'blog-designer-pro' ); ?></option>
										<option value="author" <?php echo selected( 'author', $orderby ); ?>><?php esc_html_e( 'Author', 'blog-designer-pro' ); ?></option>
										<option value="title" <?php echo selected( 'title', $orderby ); ?>><?php esc_html_e( 'Product Title', 'blog-designer-pro' ); ?></option>
										<option value="name" <?php echo selected( 'name', $orderby ); ?>><?php esc_html_e( 'Product Slug', 'blog-designer-pro' ); ?></option>
										<option value="date" <?php echo selected( 'date', $orderby ); ?>><?php esc_html_e( 'Publish Date', 'blog-designer-pro' ); ?></option>
										<option value="modified" <?php echo selected( 'modified', $orderby ); ?>><?php esc_html_e( 'Modified Date', 'blog-designer-pro' ); ?></option>
										<option value="meta_value_num" <?php echo selected( 'meta_value_num', $orderby ); ?>><?php esc_html_e( 'Product Likes', 'blog-designer-pro' ); ?></option>
									</select>
									<div class="blg_order">
										<?php
										$order = 'DESC';
										if ( isset( $bdp_settings['bdp_blog_order'] ) ) {
											$order = $bdp_settings['bdp_blog_order'];
										}
										?>
										<fieldset class="buttonset green" data-hide='1'>
											<input id="bdp_blog_order_asc" name="bdp_blog_order" type="radio" value="ASC" <?php checked( 'ASC', $order ); ?> />
											<label id="bdp-options-button" for="bdp_blog_order_asc"><?php esc_html_e( 'Ascending', 'blog-designer-pro' ); ?></label>
											<input id="bdp_blog_order_desc" name="bdp_blog_order" type="radio" value="DESC" <?php checked( 'DESC', $order ); ?> />
											<label id="bdp-options-button" for="bdp_blog_order_desc"><?php esc_html_e( 'Descending', 'blog-designer-pro' ); ?></label>
										</fieldset>
									</div>
								</div>
							</li>
							<li class="orderby_date_display">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Display Year Or Months Wise', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display product year or months wise', 'blog-designer-pro' ); ?></span></span>
									<?php
									$timeline_display_option = '';
									if ( isset( $bdp_settings['timeline_display_option'] ) ) {
										$timeline_display_option = $bdp_settings['timeline_display_option'];
									}
									?>
									<select name="timeline_display_option" id="timeline_display_option">
										<option value="" <?php echo selected( '', $timeline_display_option ); ?>>
											<?php esc_html_e( 'Select Option', 'blog-designer-pro' ); ?>
										</option>
										<option value="display_year" <?php echo selected( 'display_year', $timeline_display_option ); ?>>
											<?php esc_html_e( 'Display Years', 'blog-designer-pro' ); ?>
										</option>
										<option value="display_month" <?php echo selected( 'display_month', $timeline_display_option ); ?>>
											<?php esc_html_e( 'Display Months', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>
							<li class="bdp_post_status">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Product Status', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select product status blog', 'blog-designer-pro' ); ?></span></span>
									<?php $post_status = isset( $bdp_settings['bdp_post_status'] ) ? $bdp_settings['bdp_post_status'] : array( 'publish' ); ?>
									<select id="bdp_post_status" name="bdp_post_status[]" data-placeholder="<?php esc_attr_e( 'Select post status', 'blog-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" >
										<option value="publish" 
										<?php
										if ( @in_array( 'publish', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Publish', 'blog-designer-pro' ); ?></option>
										<option value="pending" 
										<?php
										if ( @in_array( 'pending', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Pending', 'blog-designer-pro' ); ?></option>
										<option value="draft" 
										<?php
										if ( @in_array( 'draft', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Draft', 'blog-designer-pro' ); ?></option>
										<option value="auto-draft" 
										<?php
										if ( @in_array( 'auto-draft', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Auto Draft', 'blog-designer-pro' ); ?></option>
										<option value="future" 
										<?php
										if ( @in_array( 'future', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Future', 'blog-designer-pro' ); ?></option>
										<option value="private" 
										<?php
										if ( @in_array( 'private', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Private', 'blog-designer-pro' ); ?></option>
										<option value="inherit" 
										<?php
										if ( @in_array( 'inherit', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Inherit', 'blog-designer-pro' ); ?></option>
										<option value="trash" 
										<?php
										if ( @in_array( 'trash', $post_status ) ) {
											echo 'selected="selected"'; }
										?>
										><?php esc_html_e( 'Trash', 'blog-designer-pro' ); ?></option>
									</select>
								</div>
							</li>
							<li class="displayorder_backcolor">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Year Or Month Display BackGround Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select background color of year and month option', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="displaydate_backcolor" id="displaydate_backcolor" value="<?php echo isset( $bdp_settings['displaydate_backcolor'] ) ? esc_attr( $bdp_settings['displaydate_backcolor'] ) : '#414a54'; ?>"/>
								</div>
							</li>
							<li class="sticky_post">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Show Sticky Product', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show sticky product', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_sticky = 0;
									if ( isset( $bdp_settings['display_sticky'] ) ) {
										$display_sticky = $bdp_settings['display_sticky'];
									}
									?>
									<fieldset class="bdp-social-options bdp-display_sticky buttonset">
										<input id="display_sticky_1" name="display_sticky" type="radio" value="1" <?php echo checked( 1, $display_sticky ); ?> />
										<label for="display_sticky_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_sticky_0" name="display_sticky" type="radio" value="0" <?php echo checked( 0, $display_sticky ); ?> />
										<label for="display_sticky_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>

									<div class="bdp-setting-description bdp-note">
										<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>:</b>
										<?php
										esc_html_e( 'Sticky Product not count in the number of Product to be displayed in blog layout page.', 'blog-designer-pro' );
										?>
									</div>
								</div>
							</li>

							<li class="label_featured_posts">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Label for featured Products', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter text for featured product label', 'blog-designer-pro' ); ?></span></span>
									<input type="text" name="label_featured_post" id="label_featured_post" value="<?php echo ( isset( $bdp_settings['label_featured_post'] ) ? esc_attr( $bdp_settings['label_featured_post'] ) : '' ); ?>" placeholder="<?php esc_attr_e( 'Enter Label Text', 'blog-designer-pro' ); ?>">
									<div class="bdp-setting-description bdp-note">
										<b class="note"><?php esc_html_e( 'Note', 'blog-designer-pro' ); ?>:</b>
										<?php
										esc_html_e( 'Leave blank to disable label', 'blog-designer-pro' );
										?>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div id="bdppagination" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdppagination_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
						<li class="archive_pagination_type">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Pagination Type', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select pagination type', 'blog-designer-pro' ); ?></span></span>
									<select name="pagination_type" id="pagination_type">
										<option value="no_pagination" <?php echo selected( 'no_pagination', $pagination_type ); ?>>
											<?php esc_html_e( 'No Pagination', 'blog-designer-pro' ); ?>
										</option>
										<option value="paged" <?php echo selected( 'paged', $pagination_type ); ?>>
											<?php esc_html_e( 'Paged', 'blog-designer-pro' ); ?>
										</option>
										<option value="load_more_btn" <?php echo selected( 'load_more_btn', $pagination_type ); ?>>
											<?php esc_html_e( 'Load More Button', 'blog-designer-pro' ); ?>
										</option>
										<option value="load_onscroll_btn" <?php echo selected( 'load_onscroll_btn', $pagination_type ); ?>>
											<?php esc_html_e( 'Load On Page Scroll', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>

							<li class="archive_pagination_template">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Pagination Template', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select pagination template', 'blog-designer-pro' ); ?></span></span>
									<?php $pagination_template = isset( $bdp_settings['pagination_template'] ) ? $bdp_settings['pagination_template'] : 'template-1'; ?>
									<select name="pagination_template" id="pagination_template">
										<option value="template-1" <?php echo selected( 'template-1', $pagination_template ); ?>>
											<?php esc_html_e( 'Template 1', 'blog-designer-pro' ); ?>
										</option>
										<option value="template-2" <?php echo selected( 'template-2', $pagination_template ); ?>>
											<?php esc_html_e( 'Template 2', 'blog-designer-pro' ); ?>
										</option>
										<option value="template-3" <?php echo selected( 'template-3', $pagination_template ); ?>>
											<?php esc_html_e( 'Template 3', 'blog-designer-pro' ); ?>
										</option>
										<option value="template-4" <?php echo selected( 'template-4', $pagination_template ); ?>>
											<?php esc_html_e( 'Template 4', 'blog-designer-pro' ); ?>
										</option>
									</select>
									<div class="bdp-setting-description bdp-setting-pagination">
										<img class="pagination_template_images"src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/public/images/pagination/' . esc_attr( $pagination_template ) . '.png'; ?>">
									</div>
								</div>
							</li>
							<li class="next-button-text">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Next Button Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter text for Next Button', 'blog-designer-pro' ); ?></span></span>
									<?php $next_button_text = ( isset( $bdp_settings['next_button_text'] ) && '' != $bdp_settings['next_button_text'] ) ? $bdp_settings['next_button_text'] : ''; ?>
									<input type="text" name="next_button_text" id="next_button_text" value="<?php echo esc_attr( $next_button_text ); ?>" placeholder="<?php esc_attr_e( 'Enter text for Next button', 'blog-designer-pro' ); ?>">
								</div>
							</li>
							<li class="previous-button-text">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Previous Button Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter text for Previous Button', 'blog-designer-pro' ); ?></span></span>
									<?php $previous_button_text = ( isset( $bdp_settings['previous_button_text'] ) && '' != $bdp_settings['previous_button_text'] ) ? $bdp_settings['previous_button_text'] : ''; ?>
									<input type="text" name="previous_button_text" id="previous_button_text" value="<?php echo esc_attr( $previous_button_text ); ?>" placeholder="<?php esc_attr_e( 'Enter text for Previous button', 'blog-designer-pro' ); ?>">
								</div>
							</li>
							<h3 class="bdp-table-title archive_pagination_template"><?php esc_html_e( 'Pagination Color Settings', 'blog-designer-pro' ); ?></h3>
							<li class="archive_pagination_template">
								<div class="bdp-pagination-wrapper bdp-pagination-wrapper1">
									<div class="bdp-pagination-cover">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_text_color = isset( $bdp_settings['pagination_text_color'] ) ? $bdp_settings['pagination_text_color'] : '#ffffff'; ?>
											<input type="text" name="pagination_text_color" id="pagination_text_color"
												value="<?php echo esc_attr( $pagination_text_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_text_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover bdp-pagination-background-color">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select background color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_background_color = isset( $bdp_settings['pagination_background_color'] ) ? $bdp_settings['pagination_background_color'] : '#777'; ?>
											<input type="text" name="pagination_background_color" id="pagination_background_color"
												value="<?php echo esc_attr( $pagination_background_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_background_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Hover Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select text hover color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_text_hover_color = isset( $bdp_settings['pagination_text_hover_color'] ) ? $bdp_settings['pagination_text_hover_color'] : ''; ?>
											<input type="text" name="pagination_text_hover_color" id="pagination_text_hover_color"
												value="<?php echo esc_attr( $pagination_text_hover_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_text_hover_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover bdp-pagination-hover-background-color">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Hover Background Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select hover background color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_background_hover_color = isset( $bdp_settings['pagination_background_hover_color'] ) ? $bdp_settings['pagination_background_hover_color'] : ''; ?>
											<input type="text" name="pagination_background_hover_color" id="pagination_background_hover_color"
												value="<?php echo esc_attr( $pagination_background_hover_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_background_hover_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Active Text Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select active text color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_text_active_color = isset( $bdp_settings['pagination_text_active_color'] ) ? $bdp_settings['pagination_text_active_color'] : ''; ?>
											<input type="text" name="pagination_text_active_color" id="pagination_text_active_color"
												value="<?php echo esc_attr( $pagination_text_active_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_text_active_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Active Background Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select active background color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_active_background_color = isset( $bdp_settings['pagination_active_background_color'] ) ? $bdp_settings['pagination_active_background_color'] : ''; ?>
											<input type="text" name="pagination_active_background_color" id="pagination_active_background_color"
												value="<?php echo esc_attr( $pagination_active_background_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_active_background_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover bdp-pagination-border-wrap ">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Border Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select border color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_border_color = isset( $bdp_settings['pagination_border_color'] ) ? $bdp_settings['pagination_border_color'] : '#b2b2b2'; ?>
											<input type="text" name="pagination_border_color" id="pagination_border_color"
												value="<?php echo esc_attr( $pagination_border_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_border_color ); ?>"/>
										</div>
									</div>
									<div class="bdp-pagination-cover bdp-pagination-active-border-wrap">
										<div class="bdp-pagination-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Active Border Color', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select active border color', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-pagination-content">
											<?php $pagination_active_border_color = isset( $bdp_settings['pagination_active_border_color'] ) ? $bdp_settings['pagination_active_border_color'] : '#007acc'; ?>
											<input type="text" name="pagination_active_border_color" id="pagination_active_border_color"
												value="<?php echo esc_attr( $pagination_active_border_color ); ?>"
												data-default-color="<?php echo esc_attr( $pagination_active_border_color ); ?>"/>
										</div>
									</div>
								</div>
							</li>

							<li class="loadmore_btn_option archive_loadmore_btn_template">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Button Template', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select load more button template', 'blog-designer-pro' ); ?></span></span>
									<?php $load_more_button_template = isset( $bdp_settings['load_more_button_template'] ) ? $bdp_settings['load_more_button_template'] : 'template-1'; ?>
									<select name="load_more_button_template" id="load_more_button_template">
										<option value="template-1" <?php echo selected( 'template-1', $load_more_button_template ); ?>>
											<?php esc_html_e( 'Template 1', 'blog-designer-pro' ); ?>
										</option>
										<option value="template-2" <?php echo selected( 'template-2', $load_more_button_template ); ?>>
											<?php esc_html_e( 'Template 2', 'blog-designer-pro' ); ?>
										</option>
										<option value="template-3" <?php echo selected( 'template-3', $load_more_button_template ); ?>>
											<?php esc_html_e( 'Template 3', 'blog-designer-pro' ); ?>
										</option>
									</select>
									<div class="bdp-setting-description button-loadmore">
										<img class="load_more_button_template_images"src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/public/images/buttons/' . esc_attr( $load_more_button_template ) . '.png'; ?>">
									</div>
								</div>
							</li>
							<li class="loadmore_btn_option">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Load More Button Text', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter load more button text', 'blog-designer-pro' ); ?></span></span>
									<?php $loadmore_button_text = ( isset( $bdp_settings['loadmore_button_text'] ) && '' != $bdp_settings['loadmore_button_text'] ) ? $bdp_settings['loadmore_button_text'] : esc_html__( 'Load More', 'blog-designer-pro' ); ?>
									<input type="text" name="loadmore_button_text" id="loadmore_button_text" value="<?php echo esc_attr( $loadmore_button_text ); ?>" placeholder="<?php esc_attr_e( 'Enter load more button text', 'blog-designer-pro' ); ?>">
								</div>
							</li>

							<li class="loadmore_btn_option">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Load More Text Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select load more text color', 'blog-designer-pro' ); ?></span></span>
									<?php $loadmore_button_color = ( isset( $bdp_settings['loadmore_button_color'] ) && '' != $bdp_settings['loadmore_button_color'] ) ? $bdp_settings['loadmore_button_color'] : '#ffffff'; ?>
									<input type="text" name="loadmore_button_color" id="loadmore_button_color" value="<?php echo esc_attr( $loadmore_button_color ); ?>"/>
								</div>
							</li>

							<li class="loadmore_btn_option">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Load More Text Background Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select load more button background color', 'blog-designer-pro' ); ?></span></span>
									<?php $loadmore_button_bg_color = ( isset( $bdp_settings['loadmore_button_bg_color'] ) && '' != $bdp_settings['loadmore_button_bg_color'] ) ? $bdp_settings['loadmore_button_bg_color'] : '#444444'; ?>
									<input type="text" name="loadmore_button_bg_color" id="loadmore_button_bg_color" value="<?php echo esc_attr( $loadmore_button_bg_color ); ?>"/>
								</div>
							</li>

							<li class="archive_loader_template">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Loader Type', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select loader type', 'blog-designer-pro' ); ?></span></span>
									<?php $loader_type = isset( $bdp_settings['loader_type'] ) ? $bdp_settings['loader_type'] : 0; ?>
									<select name="loader_type" id="pagination_template">
										<option value="0" <?php echo selected( '0', $loader_type ); ?>>
											<?php esc_html_e( 'Select Default Loader', 'blog-designer-pro' ); ?>
										</option>
										<option value="1" <?php echo selected( '1', $loader_type ); ?>>
											<?php esc_html_e( 'Upload New Loader Image', 'blog-designer-pro' ); ?>
										</option>
									</select>
								</div>
							</li>

							<li class="archive_loader_template default_loader">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Loader Icon', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select loader', 'blog-designer-pro' ); ?></span></span>
									<?php $loader_style_hidden = isset( $bdp_settings['loader_style_hidden'] ) ? $bdp_settings['loader_style_hidden'] : 'circularG'; ?>
									<div class="select_button_upper_div ">
										<div class="bdp_select_template_button_div">
											<input type="button" class="button bdp_select_loader" value="<?php esc_attr_e( 'Select Loader Icon', 'blog-designer-pro' ); ?>">
											<input style="visibility: hidden;" type="hidden" id="loader_style_hidden" class="loader_style_hidden" name="loader_style_hidden" value="<?php echo esc_attr( $loader_style_hidden ); ?>" />
										</div>
										<div class="bdp_selected_loader_image">
											<div class='bdp-dialog-loader-style' >
												<span class="bdp_loader_image_holder loader_hidden" >
													<?php echo wp_kses( $loaders[ $loader_style_hidden ], Bdp_Admin_Functions::args_kses() ); ?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</li>

							<li class="archive_loader_template upload_loader">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Loader Image', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select loader', 'blog-designer-pro' ); ?></span></span>
									<div class="select_button_upper_div ">
										<div class="bdp_select_template_button_div">
											<?php $loader_image_src = ( isset( $bdp_settings['bdp_loader_image_src'] ) && '' != $bdp_settings['bdp_loader_image_src'] ) ? $bdp_settings['bdp_loader_image_src'] : BLOGDESIGNERPRO_URL . '/public/images/loading.gif'; ?>
											<?php if ( '' != $loader_image_src ) { ?>
												<input class="button bdp-remove_upload_image_button" type="button" value="<?php esc_attr_e( 'Remove Image', 'blog-designer-pro' ); ?>">
											<?php } else { ?>
												<input class="button bdp-loader_upload_image_button " type="button" value="<?php esc_attr_e( 'Upload Image', 'blog-designer-pro' ); ?>">
											<?php } ?>
											<input type="hidden" value="<?php echo isset( $bdp_settings['bdp_loader_image_id'] ) ? esc_attr( $bdp_settings['bdp_loader_image_id'] ) : ''; ?>" name="bdp_loader_image_id" id="bdp_loader_image_id">
											<input type="hidden" value="<?php echo esc_attr( $loader_image_src ); ?>" name="bdp_loader_image_src" id="bdp_loader_image_src">
										</div>
										<div class="bdp_selected_loader_image">
											<span class="bdp_loader_image_holder">
												<?php
												if ( '' != $loader_image_src ) {
													echo '<img src="' . esc_url( $loader_image_src ) . '"/>';
												}
												?>
											</span>
										</div>
									</div>
								</div>
							</li>

							<li class="archive_loader_template default_loader">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Choose Loader Icon Color', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select loader icon color', 'blog-designer-pro' ); ?></span></span>
									<?php $loader_color = isset( $bdp_settings['loader_color'] ) ? $bdp_settings['loader_color'] : ''; ?>
									<input type="text" name="loader_color" id="loader_color" value="<?php echo esc_attr( $loader_color ); ?>" data-default-color="<?php echo esc_attr( $loader_color ); ?>"/>
								</div>
							</li>

						</ul>
					</div>
				</div>
				<div id="bdpproductarchivesetting" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpproductsetting_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Sale Tag', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable sale tag', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_sale_tag = '1';
									if ( isset( $bdp_settings['display_sale_tag'] ) ) {
										$display_sale_tag = $bdp_settings['display_sale_tag'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide" data-hide='1'>
										<input id="display_sale_tag_1" name="display_sale_tag" type="radio" value="1" <?php checked( 1, $display_sale_tag ); ?> />
										<label id="bdp-options-button" for="display_sale_tag_1" <?php checked( 1, $display_sale_tag ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_sale_tag_0" name="display_sale_tag" type="radio" value="0" <?php checked( 0, $display_sale_tag ); ?> />
										<label id="bdp-options-button" for="display_sale_tag_0" <?php checked( 1, $display_sale_tag ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp_sale_setting">
								<?php esc_html_e( 'Sale Tag Settings', 'blog-designer-pro' ); ?>
							</h3>
							<li class="bdp_sale_setting">
								<ul>
									<li class="bdp_sale_tagtext_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag text color', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_sale_tagtextcolor = ( isset( $bdp_settings['bdp_sale_tagtextcolor'] ) && '' != $bdp_settings['bdp_sale_tagtextcolor'] ) ? $bdp_settings['bdp_sale_tagtextcolor'] : '';
											?>
											<input type="text" name="bdp_sale_tagtextcolor" id="bdp_sale_tagtextcolor" value="<?php echo esc_attr( $bdp_sale_tagtextcolor ); ?>"/>
										</div>
									</li>
									<li class="bdp_sale_tagtext_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag background color', 'blog-designer-pro' ); ?></span></span>
											<?php

											$bdp_sale_tagbgcolor = ( isset( $bdp_settings['bdp_sale_tagbgcolor'] ) && '' != $bdp_settings['bdp_sale_tagbgcolor'] ) ? $bdp_settings['bdp_sale_tagbgcolor'] : '';
											?>
											<input type="text" name="bdp_sale_tagbgcolor" id="bdp_sale_tagbgcolor" value="<?php echo esc_attr( $bdp_sale_tagbgcolor ); ?>"/>
										</div>
									</li>
									<li class="bdp_sale_tagtext_tr bdp_sale_tagtext_alignment_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Alignment', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag alignment', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_sale_tagtext_alignment = 'left';
											if ( isset( $bdp_settings['bdp_sale_tagtext_alignment'] ) ) {
												$bdp_sale_tagtext_alignment = $bdp_settings['bdp_sale_tagtext_alignment'];
											}
											?>
											<select name="bdp_sale_tagtext_alignment" id="bdp_sale_tagtext_alignment">
											<option value="left-top" <?php echo selected( 'left-top', $bdp_sale_tagtext_alignment ); ?>>
												<?php esc_html_e( 'Left Top', 'blog-designer-pro' ); ?>
											</option>
											<option value="left-bottom" <?php echo selected( 'left-bottom', $bdp_sale_tagtext_alignment ); ?>>
												<?php esc_html_e( 'Left Bottom', 'blog-designer-pro' ); ?>
											</option>
											<option value="right-top" <?php echo selected( 'right-top', $bdp_sale_tagtext_alignment ); ?>>
												<?php esc_html_e( 'Right Top', 'blog-designer-pro' ); ?>
											</option>
											<option value="right-bottom" <?php echo selected( 'right-bottom', $bdp_sale_tagtext_alignment ); ?>>
												<?php esc_html_e( 'Right Bottom', 'blog-designer-pro' ); ?>
											</option>
										</select>
										</div>
									</li>
									<li class="bdp_sale_tagtext_tr bdp_sale_tagtext_alignment_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Angle(0-360 deg)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag angle', 'blog-designer-pro' ); ?></span></span>
											<?php $bdp_sale_tag_angle = isset( $bdp_settings['bdp_sale_tag_angle'] ) ? $bdp_settings['bdp_sale_tag_angle'] : '0'; ?>
											<input type="number" id="bdp_sale_tag_angle" name="bdp_sale_tag_angle" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tag_angle ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</li>
									<li class="bdp_sale_tagtext_tr bdp_sale_tagtext_alignment_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Border Radius(%)', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag border radius', 'blog-designer-pro' ); ?></span></span>
											<?php $bdp_sale_tag_border_radius = isset( $bdp_settings['bdp_sale_tag_border_radius'] ) ? $bdp_settings['bdp_sale_tag_border_radius'] : '0'; ?>
											<input type="number" id="bdp_sale_tag_border_radius" name="bdp_sale_tag_border_radius" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tag_border_radius ); ?>" onkeypress="return isNumberKey(event)">
										</div>
									</li>
									<h3 class="bdp_sale_tagtext_tr bdp_sale_tagtext_padding_setting_tr bdp-table-title"><?php esc_html_e( 'Padding', 'blog-designer-pro' ); ?></h3>
									<li class="bdp_sale_tagtext_tr bdp_sale_tagtext_padding_setting_tr">
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_paddingleft = isset( $bdp_settings['bdp_sale_tagtext_paddingleft'] ) ? $bdp_settings['bdp_sale_tagtext_paddingleft'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_paddingleft" name="bdp_sale_tagtext_paddingleft" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_paddingleft ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_paddingright = isset( $bdp_settings['bdp_sale_tagtext_paddingright'] ) ? $bdp_settings['bdp_sale_tagtext_paddingright'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_paddingright" name="bdp_sale_tagtext_paddingright" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_paddingright ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_paddingtop = isset( $bdp_settings['bdp_sale_tagtext_paddingtop'] ) ? $bdp_settings['bdp_sale_tagtext_paddingtop'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_paddingtop" name="bdp_sale_tagtext_paddingtop" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_paddingbottom = isset( $bdp_settings['bdp_sale_tagtext_paddingbottom'] ) ? $bdp_settings['bdp_sale_tagtext_paddingbottom'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_paddingbottom" name="bdp_sale_tagtext_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
										</div>
									</li>
									<h3 class="bdp_sale_tagtext_tr bdp_sale_tagtext_marging_setting_tr bdp-table-title"><?php esc_html_e( 'Margin', 'blog-designer-pro' ); ?></h3>
									<li class="bdp_sale_tagtext_tr bdp_sale_tagtext_marging_setting_tr">
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_marginleft = isset( $bdp_settings['bdp_sale_tagtext_marginleft'] ) ? $bdp_settings['bdp_sale_tagtext_marginleft'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_marginleft" name="bdp_sale_tagtext_marginleft" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_marginleft ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_marginright = isset( $bdp_settings['bdp_sale_tagtext_marginright'] ) ? $bdp_settings['bdp_sale_tagtext_marginright'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_marginright" name="bdp_sale_tagtext_marginright" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_marginright ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_margintop = isset( $bdp_settings['bdp_sale_tagtext_margintop'] ) ? $bdp_settings['bdp_sale_tagtext_margintop'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_margintop" name="bdp_sale_tagtext_margintop" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_margintop ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_sale_tagtext_marginbottom = isset( $bdp_settings['bdp_sale_tagtext_marginbottom'] ) ? $bdp_settings['bdp_sale_tagtext_marginbottom'] : '5'; ?>
													<input type="number" id="bdp_sale_tagtext_marginbottom" name="bdp_sale_tagtext_marginbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_sale_tagtext_marginbottom ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_sale_tagtext_tr">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Typography Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-wrapper bdp-typography-wrapper1">
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag font family', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_sale_tagfontface'] ) && '' != $bdp_settings['bdp_sale_tagfontface'] ) {
														$bdp_sale_tagfontface = $bdp_settings['bdp_sale_tagfontface'];
													} else {
														$bdp_sale_tagfontface = '';
													}
													?>
													<div class="typo-field">
														<input type="hidden" id="bdp_sale_tagfontface_font_type" name="bdp_sale_tagfontface_font_type" value="<?php echo isset( $bdp_settings['bdp_sale_tagfontface_font_type'] ) ? esc_attr( $bdp_settings['bdp_sale_tagfontface_font_type'] ) : ''; ?>">
														<div class="select-cover">
															<select name="bdp_sale_tagfontface" id="bdp_sale_tagfontface">
																<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
																<?php
																$old_version = '';
																$cnt         = 0;
																foreach ( $font_family as $key => $value ) {
																	if ( $value['version'] != $old_version ) {
																		if ( $cnt > 0 ) {
																			echo '</optgroup>';
																		}
																		echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																		$old_version = $value['version'];
																	}
																	echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																	if ( '' != $bdp_sale_tagfontface && ( str_replace( '"', '', $bdp_sale_tagfontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																		echo ' selected';
																	}
																	echo '>' . esc_html( $value['label'] ) . '</option>';
																	$cnt++;
																}
																if ( count( $font_family ) == $cnt ) {
																	echo '</optgroup>';
																}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag font size', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_sale_tagfontsize'] ) && '' != $bdp_settings['bdp_sale_tagfontsize'] ) {
														$bdp_sale_tagfontsize = $bdp_settings['bdp_sale_tagfontsize'];
													} else {
														$bdp_sale_tagfontsize = 14;
													}
													?>
													<div class="grid_col_space range_slider_fontsize" id="bdp_sale_tagfontsizeInput" ></div>
													<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="bdp_sale_tagfontsize" id="bdp_sale_tagfontsize" value="<?php echo esc_attr( $bdp_sale_tagfontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag font weight', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php $bdp_sale_tag_font_weight = isset( $bdp_settings['bdp_sale_tag_font_weight'] ) ? $bdp_settings['bdp_sale_tag_font_weight'] : 'normal'; ?>
													<div class="select-cover">
														<select name="bdp_sale_tag_font_weight" id="bdp_sale_tag_font_weight">
															<option value="100" <?php selected( $bdp_sale_tag_font_weight, 100 ); ?>>100</option>
															<option value="200" <?php selected( $bdp_sale_tag_font_weight, 200 ); ?>>200</option>
															<option value="300" <?php selected( $bdp_sale_tag_font_weight, 300 ); ?>>300</option>
															<option value="400" <?php selected( $bdp_sale_tag_font_weight, 400 ); ?>>400</option>
															<option value="500" <?php selected( $bdp_sale_tag_font_weight, 500 ); ?>>500</option>
															<option value="600" <?php selected( $bdp_sale_tag_font_weight, 600 ); ?>>600</option>
															<option value="700" <?php selected( $bdp_sale_tag_font_weight, 700 ); ?>>700</option>
															<option value="800" <?php selected( $bdp_sale_tag_font_weight, 800 ); ?>>800</option>
															<option value="900" <?php selected( $bdp_sale_tag_font_weight, 900 ); ?>>900</option>
															<option value="bold" <?php selected( $bdp_sale_tag_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
															<option value="normal" <?php selected( $bdp_sale_tag_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag line height', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
														<input type="number" name="bdp_sale_tag_font_line_height" id="bdp_sale_tag_font_line_height" step="0.1" min="0" value="<?php echo isset( $bdp_settings['bdp_sale_tag_font_line_height'] ) ? esc_attr( $bdp_settings['bdp_sale_tag_font_line_height'] ) : '1.5'; ?>" onkeypress="return isNumberKey(event)" >
													</div>
												</div>
											</div>
											<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display sale tag italic font style', 'blog-designer-pro' ); ?></span></span><?php $bdp_sale_tag_font_italic = isset( $bdp_settings['bdp_sale_tag_font_italic'] ) ? $bdp_settings['bdp_sale_tag_font_italic'] : '0'; ?>
											</div>
											<div class="bdp-typography-content">
												<fieldset class="bdp-social-options bdp-display_author buttonset">
													<input id="bdp_sale_tag_font_italic_1" name="bdp_sale_tag_font_italic" type="radio" value="1"  <?php checked( 1, $bdp_sale_tag_font_italic ); ?> />
													<label for="bdp_sale_tag_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
													<input id="bdp_sale_tag_font_italic_0" name="bdp_sale_tag_font_italic" type="radio" value="0" <?php checked( 0, $bdp_sale_tag_font_italic ); ?> />
													<label for="bdp_sale_tag_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</div>
										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag text transform style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_sale_tag_font_text_transform = isset( $bdp_settings['bdp_sale_tag_font_text_transform'] ) ? $bdp_settings['bdp_sale_tag_font_text_transform'] : 'none'; ?>
													<div class="select-cover">
														<select name="bdp_sale_tag_font_text_transform" id="bdp_sale_tag_font_text_transform">
															<option <?php selected( $bdp_sale_tag_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_sale_tag_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_sale_tag_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_sale_tag_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_sale_tag_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
											</div>
										</div>

										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select sale tag text decoration style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_sale_tag_font_text_decoration = isset( $bdp_settings['bdp_sale_tag_font_text_decoration'] ) ? $bdp_settings['bdp_sale_tag_font_text_decoration'] : 'none'; ?>
												<div class="select-cover">
													<select name="bdp_sale_tag_font_text_decoration" id="bdp_sale_tag_font_text_decoration">
														<option <?php selected( $bdp_sale_tag_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_sale_tag_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_sale_tag_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_sale_tag_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
													</select>
												</div>
											</div>
										</div>
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter sale tag letter spacing', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
														<input type="number" name="bdp_sale_tag_font_letter_spacing" id="bdp_sale_tag_font_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['bdp_sale_tag_font_letter_spacing'] ) ? esc_attr( $bdp_settings['bdp_sale_tag_font_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Product Rating', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable product rating', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_product_rating = '0';
									if ( isset( $bdp_settings['display_product_rating'] ) ) {
										$display_product_rating = $bdp_settings['display_product_rating'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide" data-hide='1'>
										<input id="display_product_rating_1" name="display_product_rating" type="radio" value="1" <?php checked( 1, $display_product_rating ); ?> />
										<label id="bdp-options-button" for="display_product_rating_1" <?php checked( 1, $display_product_rating ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_product_rating_0" name="display_product_rating" type="radio" value="0" <?php checked( 0, $display_product_rating ); ?> />
										<label id="bdp-options-button" for="display_product_rating_0" <?php checked( 1, $display_product_rating ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp_star_rating_setting">
								<?php esc_html_e( 'Star Rating Settings', 'blog-designer-pro' ); ?>
							</h3>
							<li class="bdp_star_rating_setting">
								<ul>
									<li class="bdp_star_rating_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Star Color', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select star rating color', 'blog-designer-pro' ); ?></span></span>
											<?php

											$bdp_star_rating_color = ( isset( $bdp_settings['bdp_star_rating_color'] ) && '' != $bdp_settings['bdp_star_rating_color'] ) ? $bdp_settings['bdp_star_rating_color'] : '';
											?>
											<input type="text" name="bdp_star_rating_color" id="bdp_star_rating_color" value="<?php echo esc_attr( $bdp_star_rating_color ); ?>"/>
										</div>
									</li>
									<li class="bdp_star_rating_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select star background color', 'blog-designer-pro' ); ?></span></span>
											<?php

											$bdp_star_rating_bg_color = ( isset( $bdp_settings['bdp_star_rating_bg_color'] ) && '' != $bdp_settings['bdp_star_rating_bg_color'] ) ? $bdp_settings['bdp_star_rating_bg_color'] : '';
											?>
											<input type="text" name="bdp_star_rating_bg_color" id="bdp_star_rating_bg_color" value="<?php echo esc_attr( $bdp_star_rating_bg_color ); ?>"/>
										</div>
									</li>
									<li class="bdp_star_rating_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Alignment', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon "><span class="bdp-tooltips"><?php esc_html_e( 'Select star rating alignment', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_star_rating_alignment = 'left';
											if ( isset( $bdp_settings['bdp_star_rating_alignment'] ) ) {
												$bdp_star_rating_alignment = $bdp_settings['bdp_star_rating_alignment'];
											}
											?>
											<fieldset class="buttonset green" data-hide='1'>
												<input id="bdp_star_rating_alignment_left" name="bdp_star_rating_alignment" type="radio" value="left" <?php checked( 'left', $bdp_star_rating_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_star_rating_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
												<input id="bdp_star_rating_alignment_center" name="bdp_star_rating_alignment" type="radio" value="center" <?php checked( 'center', $bdp_star_rating_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_star_rating_alignment_center" class="bdp_star_rating_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
												<input id="bdp_star_rating_alignment_right" name="bdp_star_rating_alignment" type="radio" value="right" <?php checked( 'right', $bdp_star_rating_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_star_rating_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<h3 class="bdp_star_rating_tr bdp-table-title"><?php esc_html_e( 'Padding', 'blog-designer-pro' ); ?></h3>
									<li class="bdp_star_rating_tr">
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_paddingleft = isset( $bdp_settings['bdp_star_rating_paddingleft'] ) ? $bdp_settings['bdp_star_rating_paddingleft'] : '0'; ?>
													<input type="number" id="bdp_star_rating_paddingleft" name="bdp_star_rating_paddingleft" step="1" min="0" value="<?php echo esc_attr( $bdp_star_rating_paddingleft ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_paddingright = isset( $bdp_settings['bdp_star_rating_paddingright'] ) ? $bdp_settings['bdp_star_rating_paddingright'] : '0'; ?>
													<input type="number" id="bdp_star_rating_paddingright" name="bdp_star_rating_paddingright" step="1" min="0" value="<?php echo esc_attr( $bdp_star_rating_paddingright ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_paddingtop = isset( $bdp_settings['bdp_star_rating_paddingtop'] ) ? $bdp_settings['bdp_star_rating_paddingtop'] : '0'; ?>
													<input type="number" id="bdp_star_rating_paddingtop" name="bdp_star_rating_paddingtop" step="1" min="0" value="<?php echo esc_attr( $bdp_star_rating_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_paddingbottom = isset( $bdp_settings['bdp_star_rating_paddingbottom'] ) ? $bdp_settings['bdp_star_rating_paddingbottom'] : '0'; ?>
													<input type="number" id="bdp_star_rating_paddingbottom" name="bdp_star_rating_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_star_rating_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
										</div>
									</li>
									<h3 class="bdp_star_rating_tr bdp-table-title"><?php esc_html_e( 'Margin', 'blog-designer-pro' ); ?></h3>
									<li class="bdp_star_rating_tr">
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_marginleft = isset( $bdp_settings['bdp_star_rating_marginleft'] ) ? $bdp_settings['bdp_star_rating_marginleft'] : '0'; ?>
													<input type="number" id="bdp_star_rating_marginleft" name="bdp_star_rating_marginleft" step="1" value="<?php echo esc_attr( $bdp_star_rating_marginleft ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_marginright = isset( $bdp_settings['bdp_star_rating_marginright'] ) ? $bdp_settings['bdp_star_rating_marginright'] : '0'; ?>
													<input type="number" id="bdp_star_rating_marginright" name="bdp_star_rating_marginright" step="1" value="<?php echo esc_attr( $bdp_star_rating_marginright ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_margintop = isset( $bdp_settings['bdp_star_rating_margintop'] ) ? $bdp_settings['bdp_star_rating_margintop'] : '0'; ?>
													<input type="number" id="bdp_star_rating_margintop" name="bdp_star_rating_margintop" step="1" value="<?php echo esc_attr( $bdp_star_rating_margintop ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_star_rating_marginbottom = isset( $bdp_settings['bdp_star_rating_marginbottom'] ) ? $bdp_settings['bdp_star_rating_marginbottom'] : '0'; ?>
													<input type="number" id="bdp_star_rating_marginbottom" name="bdp_star_rating_marginbottom" step="1" value="<?php echo esc_attr( $bdp_star_rating_marginbottom ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Price', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable price', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_product_price = '1';
									if ( isset( $bdp_settings['display_product_price'] ) ) {
										$display_product_price = $bdp_settings['display_product_price'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide" data-hide='1'>
										<input id="display_product_price_1" name="display_product_price" type="radio" value="1" <?php checked( 1, $display_product_price ); ?> />
										<label id="bdp-options-button" for="display_product_price_1" <?php checked( 1, $display_product_price ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_product_price_0" name="display_product_price" type="radio" value="0" <?php checked( 0, $display_product_price ); ?> />
										<label id="bdp-options-button" for="display_product_price_0" <?php checked( 1, $display_product_price ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp_price_setting">
								<?php esc_html_e( 'Price Settings', 'blog-designer-pro' ); ?>
							</h3>
							<li class="bdp_price_setting">
								<ul>
									<li class="bdp_pricetext_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text color', 'blog-designer-pro' ); ?></span></span>
											<?php

											$bdp_pricetextcolor = ( isset( $bdp_settings['bdp_pricetextcolor'] ) && '' != $bdp_settings['bdp_pricetextcolor'] ) ? $bdp_settings['bdp_pricetextcolor'] : '';
											?>
											<input type="text" name="bdp_pricetextcolor" id="bdp_pricetextcolor" value="<?php echo esc_attr( $bdp_pricetextcolor ); ?>"/>
										</div>
									</li>
									<li class="bdp_pricetext_tr bdp_pricetext_alignment_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Alignment', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text alignment', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_pricetext_alignment = 'left';
											if ( isset( $bdp_settings['bdp_pricetext_alignment'] ) ) {
												$bdp_pricetext_alignment = $bdp_settings['bdp_pricetext_alignment'];
											}
											?>
											<fieldset class="buttonset green" data-hide='1'>
												<input id="bdp_pricetext_alignment_left" name="bdp_pricetext_alignment" type="radio" value="left" <?php checked( 'left', $bdp_pricetext_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_pricetext_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
												<input id="bdp_pricetext_alignment_center" name="bdp_pricetext_alignment" type="radio" value="center" <?php checked( 'center', $bdp_pricetext_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_pricetext_alignment_center" class="bdp_pricetext_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
												<input id="bdp_pricetext_alignment_right" name="bdp_pricetext_alignment" type="radio" value="right" <?php checked( 'right', $bdp_pricetext_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_pricetext_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<h3 class="bdp_pricetext_padding_setting_tr bdp-table-title"><?php esc_html_e( 'Padding', 'blog-designer-pro' ); ?></h3>
									<li class="bdp_pricetext_padding_setting_tr">
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_paddingleft = isset( $bdp_settings['bdp_pricetext_paddingleft'] ) ? $bdp_settings['bdp_pricetext_paddingleft'] : '0'; ?>
													<input type="number" id="bdp_pricetext_paddingleft" name="bdp_pricetext_paddingleft" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_paddingleft ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_paddingright = isset( $bdp_settings['bdp_pricetext_paddingright'] ) ? $bdp_settings['bdp_pricetext_paddingright'] : '0'; ?>
													<input type="number" id="bdp_pricetext_paddingright" name="bdp_pricetext_paddingright" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_paddingright ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_paddingtop = isset( $bdp_settings['bdp_pricetext_paddingtop'] ) ? $bdp_settings['bdp_pricetext_paddingtop'] : '0'; ?>
													<input type="number" id="bdp_pricetext_paddingtop" name="bdp_pricetext_paddingtop" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_paddingtop ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_paddingbottom = isset( $bdp_settings['bdp_pricetext_paddingbottom'] ) ? $bdp_settings['bdp_pricetext_paddingbottom'] : '0'; ?>
													<input type="number" id="bdp_pricetext_paddingbottom" name="bdp_pricetext_paddingbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_paddingbottom ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
										</div>
									</li>
									<h3 class="bdp_pricetext_tr bdp_pricetext_marging_setting_tr bdp-table-title"><?php esc_html_e( 'Margin', 'blog-designer-pro' ); ?></h3>
									<li class="bdp_pricetext_tr bdp_pricetext_marging_setting_tr">
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_marginleft = isset( $bdp_settings['bdp_pricetext_marginleft'] ) ? $bdp_settings['bdp_pricetext_marginleft'] : '0'; ?>
													<input type="number" id="bdp_pricetext_marginleft" name="bdp_pricetext_marginleft" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_marginleft ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_marginright = isset( $bdp_settings['bdp_pricetext_marginright'] ) ? $bdp_settings['bdp_pricetext_marginright'] : '0'; ?>
													<input type="number" id="bdp_pricetext_marginright" name="bdp_pricetext_marginright" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_marginright ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_margintop = isset( $bdp_settings['bdp_pricetext_margintop'] ) ? $bdp_settings['bdp_pricetext_margintop'] : '0'; ?>
													<input type="number" id="bdp_pricetext_margintop" name="bdp_pricetext_margintop" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_margintop ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Bottom (px)', 'blog-designer-pro' ); ?>
													</span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_pricetext_marginbottom = isset( $bdp_settings['bdp_pricetext_marginbottom'] ) ? $bdp_settings['bdp_pricetext_marginbottom'] : '0'; ?>
													<input type="number" id="bdp_pricetext_marginbottom" name="bdp_pricetext_marginbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_pricetext_marginbottom ); ?>" onkeypress="return isNumberKey(event)">
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_pricetext_tr bdp_pricetext_typography_setting_tr">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Typography Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-wrapper bdp-typography-wrapper1">
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title"><?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?></span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text font family', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_pricefontface'] ) && '' != $bdp_settings['bdp_pricefontface'] ) {
														$bdp_pricefontface = $bdp_settings['bdp_pricefontface'];
													} else {
														$bdp_pricefontface = '';
													}
													?>
													<div class="typo-field">
														<input type="hidden" id="bdp_pricefontface_font_type" name="bdp_pricefontface_font_type" value="<?php echo isset( $bdp_settings['bdp_pricefontface_font_type'] ) ? esc_attr( $bdp_settings['bdp_pricefontface_font_type'] ) : ''; ?>">
														<div class="select-cover">
															<select name="bdp_pricefontface" id="bdp_pricefontface">
																<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
																<?php
																$old_version = '';
																$cnt         = 0;
																foreach ( $font_family as $key => $value ) {
																	if ( $value['version'] != $old_version ) {
																		if ( $cnt > 0 ) {
																			echo '</optgroup>';
																		}
																		echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																		$old_version = $value['version'];
																	}
																	echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																	if ( '' != $bdp_pricefontface && ( str_replace( '"', '', $bdp_pricefontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																		echo ' selected';
																	}
																	echo '>' . esc_html( $value['label'] ) . '</option>';
																	$cnt++;
																}
																if ( count( $font_family ) == $cnt ) {
																	echo '</optgroup>';
																}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text font size', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_pricefontsize'] ) && '' != $bdp_settings['bdp_pricefontsize'] ) {
														$bdp_pricefontsize = $bdp_settings['bdp_pricefontsize'];
													} else {
														$bdp_pricefontsize = 14;
													}
													?>
													<div class="grid_col_space range_slider_fontsize" id="bdp_pricefontsizeInput" ></div>
													<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="bdp_pricefontsize" id="bdp_pricefontsize" value="<?php echo esc_attr( $bdp_pricefontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text font weight', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php $bdp_price_font_weight = isset( $bdp_settings['bdp_price_font_weight'] ) ? $bdp_settings['bdp_price_font_weight'] : 'normal'; ?>
													<div class="select-cover">
														<select name="bdp_price_font_weight" id="bdp_price_font_weight">
															<option value="100" <?php selected( $bdp_price_font_weight, 100 ); ?>>100</option>
															<option value="200" <?php selected( $bdp_price_font_weight, 200 ); ?>>200</option>
															<option value="300" <?php selected( $bdp_price_font_weight, 300 ); ?>>300</option>
															<option value="400" <?php selected( $bdp_price_font_weight, 400 ); ?>>400</option>
															<option value="500" <?php selected( $bdp_price_font_weight, 500 ); ?>>500</option>
															<option value="600" <?php selected( $bdp_price_font_weight, 600 ); ?>>600</option>
															<option value="700" <?php selected( $bdp_price_font_weight, 700 ); ?>>700</option>
															<option value="800" <?php selected( $bdp_price_font_weight, 800 ); ?>>800</option>
															<option value="900" <?php selected( $bdp_price_font_weight, 900 ); ?>>900</option>
															<option value="bold" <?php selected( $bdp_price_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
															<option value="normal" <?php selected( $bdp_price_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text line height', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
														<input type="number" name="bdp_price_font_line_height" id="bdp_price_font_line_height" step="0.1" min="0" value="<?php echo isset( $bdp_settings['bdp_price_font_line_height'] ) ? esc_attr( $bdp_settings['bdp_price_font_line_height'] ) : '1.5'; ?>" onkeypress="return isNumberKey(event)" >
													</div>
												</div>
											</div>
											<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display price text italic font style', 'blog-designer-pro' ); ?></span></span><?php $bdp_price_font_italic = isset( $bdp_settings['bdp_price_font_italic'] ) ? $bdp_settings['bdp_price_font_italic'] : '0'; ?>
											</div>
											<div class="bdp-typography-content">
												<fieldset class="bdp-social-options bdp-display_author buttonset">
													<input id="bdp_price_font_italic_1" name="bdp_price_font_italic" type="radio" value="1"  <?php checked( 1, $bdp_price_font_italic ); ?> />
													<label for="bdp_price_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
													<input id="bdp_price_font_italic_0" name="bdp_price_font_italic" type="radio" value="0" <?php checked( 0, $bdp_price_font_italic ); ?> />
													<label for="bdp_price_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</div>
										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text transform style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_price_font_text_transform = isset( $bdp_settings['bdp_price_font_text_transform'] ) ? $bdp_settings['bdp_price_font_text_transform'] : 'none'; ?>
													<div class="select-cover">
														<select name="bdp_price_font_text_transform" id="bdp_price_font_text_transform">
															<option <?php selected( $bdp_price_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_price_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_price_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_price_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_price_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
											</div>
										</div>

										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select price text decoration style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_price_font_text_decoration = isset( $bdp_settings['bdp_price_font_text_decoration'] ) ? $bdp_settings['bdp_price_font_text_decoration'] : 'none'; ?>
												<div class="select-cover">
													<select name="bdp_price_font_text_decoration" id="bdp_price_font_text_decoration">
														<option <?php selected( $bdp_price_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_price_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_price_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_price_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
													</select>
												</div>
											</div>
										</div>
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter price text letter spacing', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
														<input type="number" name="bdp_price_font_letter_spacing" id="bdp_price_font_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['bdp_price_font_letter_spacing'] ) ? esc_attr( $bdp_settings['bdp_price_font_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Add To Cart Button', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable add to cart button', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_addtocart_button = '1';
									if ( isset( $bdp_settings['display_addtocart_button'] ) ) {
										$display_addtocart_button = $bdp_settings['display_addtocart_button'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide" data-hide='1'>
										<input id="display_addtocart_button_1" name="display_addtocart_button" type="radio" value="1" <?php checked( 1, $display_addtocart_button ); ?> />
										<label id="bdp-options-button" for="display_addtocart_button_1" <?php checked( 1, $display_addtocart_button ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_addtocart_button_0" name="display_addtocart_button" type="radio" value="0" <?php checked( 0, $display_addtocart_button ); ?> />
										<label id="bdp-options-button" for="display_addtocart_button_0" <?php checked( 0, $display_addtocart_button ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp_cart_button_setting">
								<?php esc_html_e( 'Cart Button Settings', 'blog-designer-pro' ); ?>
							</h3>

							<li class="bdp_cart_button_setting">
								<ul>
									<li class="bdp_add_to_cart_tr cart_button_alignment">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Alignment', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button alignment', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_addtocartbutton_alignment = 'left';
											if ( isset( $bdp_settings['bdp_addtocartbutton_alignment'] ) ) {
												$bdp_addtocartbutton_alignment = $bdp_settings['bdp_addtocartbutton_alignment'];
											}
											?>
											<fieldset class="buttonset green" data-hide='1'>
												<input id="bdp_addtocartbutton_alignment_left" name="bdp_addtocartbutton_alignment" type="radio" value="left" <?php checked( 'left', $bdp_addtocartbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_addtocartbutton_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
												<input id="bdp_addtocartbutton_alignment_center" name="bdp_addtocartbutton_alignment" type="radio" value="center" <?php checked( 'center', $bdp_addtocartbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_addtocartbutton_alignment_center" class="bdp_addtocartbutton_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
												<input id="bdp_addtocartbutton_alignment_right" name="bdp_addtocartbutton_alignment" type="radio" value="right" <?php checked( 'right', $bdp_addtocartbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_addtocartbutton_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<li class="bdp_add_to_cart_tr bdp_padding_0">
										<div class="bdp-typography-wrapper bdp-typography-wrapper1">
											<div class="bdp-typography-cover">
												<h3 class="bdp-table-title"><?php esc_html_e( 'Normal Settings', 'blog-designer-pro' ); ?></h3>
												<div class="bdp-typography-sub-cover bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_addtocart_textcolor = isset( $bdp_settings['bdp_addtocart_textcolor'] ) ? $bdp_settings['bdp_addtocart_textcolor'] : ''; ?>
														<input type="text" name="bdp_addtocart_textcolor" id="bdp_addtocart_textcolor" value="<?php echo esc_attr( $bdp_addtocart_textcolor ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_addtocart_backgroundcolor = isset( $bdp_settings['bdp_addtocart_backgroundcolor'] ) ? $bdp_settings['bdp_addtocart_backgroundcolor'] : ''; ?>
														<input type="text" name="bdp_addtocart_backgroundcolor" id="bdp_addtocart_backgroundcolor" value="<?php echo esc_attr( $bdp_addtocart_backgroundcolor ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Border Radius(px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php
														$display_addtocart_button_border_radius = '0';
														if ( isset( $bdp_settings['display_addtocart_button_border_radius'] ) ) {
															$display_addtocart_button_border_radius = $bdp_settings['display_addtocart_button_border_radius'];
														}
														?>
														<input type="number" id="display_addtocart_button_border_radius" name="display_addtocart_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $display_addtocart_button_border_radius ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-typography-sub-cover full-width bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Border', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<div class="bdp-border-wrap">
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_borderleft = isset( $bdp_settings['bdp_addtocartbutton_borderleft'] ) ? $bdp_settings['bdp_addtocartbutton_borderleft'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_borderleft" name="bdp_addtocartbutton_borderleft" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_borderleft ); ?>"  onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_borderleftcolor = isset( $bdp_settings['bdp_addtocartbutton_borderleftcolor'] ) ? $bdp_settings['bdp_addtocartbutton_borderleftcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_borderleftcolor" id="bdp_addtocartbutton_borderleftcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_borderleftcolor ); ?>"/>
																	</div>
																</div>
															</div> 
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_borderright = isset( $bdp_settings['bdp_addtocartbutton_borderright'] ) ? $bdp_settings['bdp_addtocartbutton_borderright'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_borderright" name="bdp_addtocartbutton_borderright" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_borderright ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_borderrightcolor = isset( $bdp_settings['bdp_addtocartbutton_borderrightcolor'] ) ? $bdp_settings['bdp_addtocartbutton_borderrightcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_borderrightcolor" id="bdp_addtocartbutton_borderrightcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_borderrightcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_bordertop = isset( $bdp_settings['bdp_addtocartbutton_bordertop'] ) ? $bdp_settings['bdp_addtocartbutton_bordertop'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_bordertop" name="bdp_addtocartbutton_bordertop" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_bordertop ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_bordertopcolor = isset( $bdp_settings['bdp_addtocartbutton_bordertopcolor'] ) ? $bdp_settings['bdp_addtocartbutton_bordertopcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_bordertopcolor" id="bdp_addtocartbutton_bordertopcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_bordertopcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Bottom(px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_borderbuttom = isset( $bdp_settings['bdp_addtocartbutton_borderbuttom'] ) ? $bdp_settings['bdp_addtocartbutton_borderbuttom'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_borderbuttom" name="bdp_addtocartbutton_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_borderbuttom ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_borderbottomcolor = isset( $bdp_settings['bdp_addtocartbutton_borderbottomcolor'] ) ? $bdp_settings['bdp_addtocartbutton_borderbottomcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_borderbottomcolor" id="bdp_addtocartbutton_borderbottomcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_borderbottomcolor ); ?>"/>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="bdp-typography-cover">
												<h3 class="bdp-table-title"><?php esc_html_e( 'Hover Settings', 'blog-designer-pro' ); ?></h3>
												<div class="bdp-typography-sub-cover bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_addtocart_text_hover_color = isset( $bdp_settings['bdp_addtocart_text_hover_color'] ) ? $bdp_settings['bdp_addtocart_text_hover_color'] : ''; ?>
														<input type="text" name="bdp_addtocart_text_hover_color" id="bdp_addtocart_text_hover_color" value="<?php echo esc_attr( $bdp_addtocart_text_hover_color ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_addtocart_hover_backgroundcolor = isset( $bdp_settings['bdp_addtocart_hover_backgroundcolor'] ) ? $bdp_settings['bdp_addtocart_hover_backgroundcolor'] : ''; ?>
														<input type="text" name="bdp_addtocart_hover_backgroundcolor" id="bdp_addtocart_hover_backgroundcolor" value="<?php echo esc_attr( $bdp_addtocart_hover_backgroundcolor ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Border Radius(px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php
														$display_addtocart_button_border_hover_radius = '0';
														if ( isset( $bdp_settings['display_addtocart_button_border_hover_radius'] ) ) {
															$display_addtocart_button_border_hover_radius = $bdp_settings['display_addtocart_button_border_hover_radius'];
														}
														?>
														<input type="number" id="display_addtocart_button_border_hover_radius" name="display_addtocart_button_border_hover_radius" step="1" min="0" value="<?php echo esc_attr( $display_addtocart_button_border_hover_radius ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-typography-sub-cover full-width bdp_add_to_cart_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Border', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<div class="bdp-border-wrap">
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_borderleft = isset( $bdp_settings['bdp_addtocartbutton_hover_borderleft'] ) ? $bdp_settings['bdp_addtocartbutton_hover_borderleft'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_hover_borderleft" name="bdp_addtocartbutton_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_borderleft ); ?>"  onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_borderleftcolor = isset( $bdp_settings['bdp_addtocartbutton_hover_borderleftcolor'] ) ? $bdp_settings['bdp_addtocartbutton_hover_borderleftcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_hover_borderleftcolor" id="bdp_addtocartbutton_hover_borderleftcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_borderleftcolor ); ?>"/>
																	</div>
																</div>
															</div> 
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_borderright = isset( $bdp_settings['bdp_addtocartbutton_hover_borderright'] ) ? $bdp_settings['bdp_addtocartbutton_hover_borderright'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_hover_borderright" name="bdp_addtocartbutton_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_borderright ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_borderrightcolor = isset( $bdp_settings['bdp_addtocartbutton_hover_borderrightcolor'] ) ? $bdp_settings['bdp_addtocartbutton_hover_borderrightcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_hover_borderrightcolor" id="bdp_addtocartbutton_hover_borderrightcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_borderrightcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_bordertop = isset( $bdp_settings['bdp_addtocartbutton_hover_bordertop'] ) ? $bdp_settings['bdp_addtocartbutton_hover_bordertop'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_hover_bordertop" name="bdp_addtocartbutton_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_bordertop ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_bordertopcolor = isset( $bdp_settings['bdp_addtocartbutton_hover_bordertopcolor'] ) ? $bdp_settings['bdp_addtocartbutton_hover_bordertopcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_hover_bordertopcolor" id="bdp_addtocartbutton_hover_bordertopcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_bordertopcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Bottom(px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_borderbuttom = isset( $bdp_settings['bdp_addtocartbutton_hover_borderbuttom'] ) ? $bdp_settings['bdp_addtocartbutton_hover_borderbuttom'] : '0'; ?>
																		<input type="number" id="bdp_addtocartbutton_hover_borderbuttom" name="bdp_addtocartbutton_hover_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_borderbuttom ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_addtocartbutton_hover_borderbottomcolor = isset( $bdp_settings['bdp_addtocartbutton_hover_borderbottomcolor'] ) ? $bdp_settings['bdp_addtocartbutton_hover_borderbottomcolor'] : ''; ?>
																		<input type="text" name="bdp_addtocartbutton_hover_borderbottomcolor" id="bdp_addtocartbutton_hover_borderbottomcolor" value="<?php echo esc_attr( $bdp_addtocartbutton_hover_borderbottomcolor ); ?>"/>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_cart_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Padding', 'blog-designer-pro' ); ?>
											</span>
										</div> 
										<div class="bdp-right bdp-border-cover">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Set cart button padding', 'blog-designer-pro' ); ?></span></span>
											<div class="bdp-padding-wrapper bdp-padding-wrapper1 bdp-border-wrap">
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Left-Right (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_addtocartbutton_padding_leftright = isset( $bdp_settings['bdp_addtocartbutton_padding_leftright'] ) ? $bdp_settings['bdp_addtocartbutton_padding_leftright'] : '0'; ?>
														<input type="number" id="bdp_addtocartbutton_padding_leftright" name="bdp_addtocartbutton_padding_leftright" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_padding_leftright ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Top-Bottom (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_addtocartbutton_padding_topbottom = isset( $bdp_settings['bdp_addtocartbutton_padding_topbottom'] ) ? $bdp_settings['bdp_addtocartbutton_padding_topbottom'] : '0'; ?>
														<input type="number" id="bdp_addtocartbutton_padding_topbottom" name="bdp_addtocartbutton_padding_topbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocartbutton_padding_topbottom ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_cart_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Margin', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right bdp-border-cover">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Set cart button margin', 'blog-designer-pro' ); ?></span></span>
											<div class="bdp-padding-wrapper bdp-padding-wrapper1 bdp-border-wrap">
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Left-Right (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_addtocartbutton_margin_leftright = isset( $bdp_settings['bdp_addtocartbutton_margin_leftright'] ) ? $bdp_settings['bdp_addtocartbutton_margin_leftright'] : '0'; ?>
														<input type="number" id="bdp_addtocartbutton_margin_leftright" name="bdp_addtocartbutton_margin_leftright" step="1" value="<?php echo esc_attr( $bdp_addtocartbutton_margin_leftright ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Top-Bottom (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_addtocartbutton_margin_topbottom = isset( $bdp_settings['bdp_addtocartbutton_margin_topbottom'] ) ? $bdp_settings['bdp_addtocartbutton_margin_topbottom'] : '0'; ?>
														<input type="number" id="bdp_addtocartbutton_margin_topbottom" name="bdp_addtocartbutton_margin_topbottom" step="1" value="<?php echo esc_attr( $bdp_addtocartbutton_margin_topbottom ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_cart_tr addtocart_button_box_shadow_setting">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Box Shadow Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'H-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_top_box_shadow = isset( $bdp_settings['bdp_addtocart_button_top_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_top_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_top_box_shadow" name="bdp_addtocart_button_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_top_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'V-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select vertical offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_right_box_shadow = isset( $bdp_settings['bdp_addtocart_button_right_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_right_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_right_box_shadow" name="bdp_addtocart_button_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_right_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Blur (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blur value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_bottom_box_shadow = isset( $bdp_settings['bdp_addtocart_button_bottom_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_bottom_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_bottom_box_shadow" name="bdp_addtocart_button_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_bottom_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Spread (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select spread value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_left_box_shadow = isset( $bdp_settings['bdp_addtocart_button_left_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_left_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_left_box_shadow" name="bdp_addtocart_button_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_left_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover bdp-boxshadow-color">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Color', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select box shadow color', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
														<?php $bdp_addtocart_button_box_shadow_color = isset( $bdp_settings['bdp_addtocart_button_box_shadow_color'] ) ? $bdp_settings['bdp_addtocart_button_box_shadow_color'] : ''; ?>
														<input type="text" name="bdp_addtocart_button_box_shadow_color" id="bdp_addtocart_button_box_shadow_color" value="<?php echo esc_attr( $bdp_addtocart_button_box_shadow_color ); ?>"/>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_cart_tr addtocart_button_hover_box_shadow_setting">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Hover Box Shadow Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'H-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_hover_top_box_shadow = isset( $bdp_settings['bdp_addtocart_button_hover_top_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_hover_top_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_hover_top_box_shadow" name="bdp_addtocart_button_hover_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_hover_top_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'V-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select vertical offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_hover_right_box_shadow = isset( $bdp_settings['bdp_addtocart_button_hover_right_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_hover_right_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_hover_right_box_shadow" name="bdp_addtocart_button_hover_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_hover_right_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Blur (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blur value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_hover_bottom_box_shadow = isset( $bdp_settings['bdp_addtocart_button_hover_bottom_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_hover_bottom_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_hover_bottom_box_shadow" name="bdp_addtocart_button_hover_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_hover_bottom_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Spread (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select spread value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_hover_left_box_shadow = isset( $bdp_settings['bdp_addtocart_button_hover_left_box_shadow'] ) ? $bdp_settings['bdp_addtocart_button_hover_left_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_addtocart_button_hover_left_box_shadow" name="bdp_addtocart_button_hover_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_addtocart_button_hover_left_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover bdp-boxshadow-color">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Color', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select box shadow color', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_addtocart_button_hover_box_shadow_color = isset( $bdp_settings['bdp_addtocart_button_hover_box_shadow_color'] ) ? $bdp_settings['bdp_addtocart_button_hover_box_shadow_color'] : ''; ?>
													<input type="text" name="bdp_addtocart_button_hover_box_shadow_color" id="bdp_addtocart_button_hover_box_shadow_color" value="<?php echo esc_attr( $bdp_addtocart_button_hover_box_shadow_color ); ?>"/>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_cart_tr">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Typography Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-wrapper bdp-typography-wrapper1">
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button font family', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_addtocart_button_fontface'] ) && '' != $bdp_settings['bdp_addtocart_button_fontface'] ) {
														$bdp_addtocart_button_fontface = $bdp_settings['bdp_addtocart_button_fontface'];
													} else {
														$bdp_addtocart_button_fontface = '';
													}
													?>
													<div class="typo-field">
														<input type="hidden" id="bdp_addtocart_button_fontface_font_type" name="bdp_addtocart_button_fontface_font_type" value="<?php echo isset( $bdp_settings['bdp_addtocart_button_fontface_font_type'] ) ? esc_attr( $bdp_settings['bdp_addtocart_button_fontface_font_type'] ) : ''; ?>">
														<div class="select-cover">
															<select name="bdp_addtocart_button_fontface" id="bdp_addtocart_button_fontface">
																<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
																<?php
																$old_version = '';
																$cnt         = 0;
																foreach ( $font_family as $key => $value ) {
																	if ( $value['version'] != $old_version ) {
																		if ( $cnt > 0 ) {
																			echo '</optgroup>';
																		}
																		echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																		$old_version = $value['version'];
																	}
																	echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																	if ( '' != $bdp_addtocart_button_fontface && ( str_replace( '"', '', $bdp_addtocart_button_fontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																		echo ' selected';
																	}
																	echo '>' . esc_html( $value['label'] ) . '</option>';
																	$cnt++;
																}
																if ( count( $font_family ) == $cnt ) {
																	echo '</optgroup>';
																}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button font size', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_addtocart_button_fontsize'] ) && '' != $bdp_settings['bdp_addtocart_button_fontsize'] ) {
														$bdp_addtocart_button_fontsize = $bdp_settings['bdp_addtocart_button_fontsize'];
													} else {
														$bdp_addtocart_button_fontsize = 14;
													}
													?>
													<div class="grid_col_space range_slider_fontsize" id="bdp_addtocart_button_fontsizeInput" ></div>
													<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="bdp_addtocart_button_fontsize" id="bdp_addtocart_button_fontsize" value="<?php echo esc_attr( $bdp_addtocart_button_fontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button font weight', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php $bdp_addtocart_button_font_weight = isset( $bdp_settings['bdp_addtocart_button_font_weight'] ) ? $bdp_settings['bdp_addtocart_button_font_weight'] : 'normal'; ?>
													<div class="select-cover">
														<select name="bdp_addtocart_button_font_weight" id="bdp_addtocart_button_font_weight">
															<option value="100" <?php selected( $bdp_addtocart_button_font_weight, 100 ); ?>>100</option>
															<option value="200" <?php selected( $bdp_addtocart_button_font_weight, 200 ); ?>>200</option>
															<option value="300" <?php selected( $bdp_addtocart_button_font_weight, 300 ); ?>>300</option>
															<option value="400" <?php selected( $bdp_addtocart_button_font_weight, 400 ); ?>>400</option>
															<option value="500" <?php selected( $bdp_addtocart_button_font_weight, 500 ); ?>>500</option>
															<option value="600" <?php selected( $bdp_addtocart_button_font_weight, 600 ); ?>>600</option>
															<option value="700" <?php selected( $bdp_addtocart_button_font_weight, 700 ); ?>>700</option>
															<option value="800" <?php selected( $bdp_addtocart_button_font_weight, 800 ); ?>>800</option>
															<option value="900" <?php selected( $bdp_addtocart_button_font_weight, 900 ); ?>>900</option>
															<option value="bold" <?php selected( $bdp_addtocart_button_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
															<option value="normal" <?php selected( $bdp_addtocart_button_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button line height', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
													<?php
														$display_addtocart_button_line_height = '1.5';
													if ( isset( $bdp_settings['display_addtocart_button_line_height'] ) ) {
														$display_addtocart_button_line_height = $bdp_settings['display_addtocart_button_line_height'];
													}
													?>
													<input type="number" id="display_addtocart_button_line_height" name="display_addtocart_button_line_height" step="1" min="1.5" value="<?php echo esc_attr( $display_addtocart_button_line_height ); ?>" placeholder="<?php esc_attr_e( 'Enter line height', 'blog-designer-pro' ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
											<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display cart button italic font style', 'blog-designer-pro' ); ?></span></span><?php $bdp_addtocart_button_font_italic = isset( $bdp_settings['bdp_addtocart_button_font_italic'] ) ? $bdp_settings['bdp_addtocart_button_font_italic'] : '0'; ?>
											</div>
											<div class="bdp-typography-content">
												<fieldset class="bdp-social-options bdp-display_author buttonset">
													<input id="bdp_addtocart_button_font_italic_1" name="bdp_addtocart_button_font_italic" type="radio" value="1"  <?php checked( 1, $bdp_addtocart_button_font_italic ); ?> />
													<label for="bdp_addtocart_button_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
													<input id="bdp_addtocart_button_font_italic_0" name="bdp_addtocart_button_font_italic" type="radio" value="0" <?php checked( 0, $bdp_addtocart_button_font_italic ); ?> />
													<label for="bdp_addtocart_button_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</div>
										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button text transform style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_addtocart_button_font_text_transform = isset( $bdp_settings['bdp_addtocart_button_font_text_transform'] ) ? $bdp_settings['bdp_addtocart_button_font_text_transform'] : 'none'; ?>
													<div class="select-cover">
														<select name="bdp_addtocart_button_font_text_transform" id="bdp_addtocart_button_font_text_transform">
															<option <?php selected( $bdp_addtocart_button_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtocart_button_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtocart_button_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtocart_button_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtocart_button_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
											</div>
										</div>

										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button text decoration style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_addtocart_button_font_text_decoration = isset( $bdp_settings['bdp_addtocart_button_font_text_decoration'] ) ? $bdp_settings['bdp_addtocart_button_font_text_decoration'] : 'none'; ?>
												<div class="select-cover">
													<select name="bdp_addtocart_button_font_text_decoration" id="bdp_addtocart_button_font_text_decoration">
														<option <?php selected( $bdp_addtocart_button_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_addtocart_button_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_addtocart_button_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_addtocart_button_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
													</select>
												</div>
											</div>
										</div>
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter cart button letter spacing', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number"><input type="number" name="bdp_addtocart_button_letter_spacing" id="bdp_addtocart_button_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['bdp_addtocart_button_letter_spacing'] ) ? esc_attr( $bdp_settings['bdp_addtocart_button_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)"></div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<?php
							if ( class_exists( 'YITH_WCWL' ) ) {
								?>
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Add To Wishlist Button', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable add to wishlist button', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_addtowishlist_button = '0';
									if ( isset( $bdp_settings['display_addtowishlist_button'] ) ) {
										$display_addtowishlist_button = $bdp_settings['display_addtowishlist_button'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide" data-hide='1'>
										<input id="display_addtowishlist_button_1" name="display_addtowishlist_button" type="radio" value="1" <?php checked( 1, $display_addtowishlist_button ); ?> />
										<label id="bdp-options-button" for="display_addtowishlist_button_1" <?php checked( 1, $display_addtowishlist_button ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_addtowishlist_button_0" name="display_addtowishlist_button" type="radio" value="0" <?php checked( 0, $display_addtowishlist_button ); ?> />
										<label id="bdp-options-button" for="display_addtowishlist_button_0" <?php checked( 0, $display_addtowishlist_button ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<h3 class="bdp-table-title bdp_wishlist_button_setting">
								<?php esc_html_e( 'Wishlist Button Settings', 'blog-designer-pro' ); ?>
							</h3>
							<li class="bdp_wishlist_button_setting">
								<ul>
									<li class="bdp_add_to_wishlist_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'DisplayButton on', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Show wishlist button on', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_wishlistbutton_on = '1';
											if ( isset( $bdp_settings['bdp_wishlistbutton_on'] ) ) {
												$bdp_wishlistbutton_on = $bdp_settings['bdp_wishlistbutton_on'];
											}
											?>
											<fieldset class="buttonset green" data-hide='1'>
												<input id="bdp_wishlistbutton_on_same_line" name="bdp_wishlistbutton_on" type="radio" value="1" <?php checked( '1', $bdp_wishlistbutton_on ); ?> />
												<label id="bdp-options-button" for="bdp_wishlistbutton_on_same_line"><?php esc_html_e( 'Same Line', 'blog-designer-pro' ); ?></label>
												<input id="bdp_wishlistbutton_on_next_line" name="bdp_wishlistbutton_on" type="radio" value="2" <?php checked( '2', $bdp_wishlistbutton_on ); ?> />
												<label id="bdp-options-button" for="bdp_wishlistbutton_on_next_line"><?php esc_html_e( 'Next Line', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr cart_wishlist_button_alignment">
										<div class="bdp-left">
											<span class="bdp-key-title"><?php esc_html_e( 'Wrapper Alignment', 'blog-designer-pro' ); ?></span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Select cart button & wishlist button alignment', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_cart_wishlistbutton_alignment = 'left';
											if ( isset( $bdp_settings['bdp_cart_wishlistbutton_alignment'] ) ) {
												$bdp_cart_wishlistbutton_alignment = $bdp_settings['bdp_cart_wishlistbutton_alignment'];
											}
											?>
											<fieldset class="buttonset green" data-hide='1'>
												<input id="bdp_cart_wishlistbutton_alignment_left" name="bdp_cart_wishlistbutton_alignment" type="radio" value="left" <?php checked( 'left', $bdp_cart_wishlistbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_cart_wishlistbutton_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
												<input id="bdp_cart_wishlistbutton_alignment_center" name="bdp_cart_wishlistbutton_alignment" type="radio" value="center" <?php checked( 'center', $bdp_cart_wishlistbutton_alignment ); ?> />
												<label id="bdp-options-button" class="bdp_cart_wishlistbutton_alignment_center" for="bdp_cart_wishlistbutton_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
												<input id="bdp_cart_wishlistbutton_alignment_right" name="bdp_cart_wishlistbutton_alignment" type="radio" value="right" <?php checked( 'right', $bdp_cart_wishlistbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_cart_wishlistbutton_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr wishlist_button_alignment">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Alignment', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right">
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button alignment', 'blog-designer-pro' ); ?></span></span>
											<?php
											$bdp_wishlistbutton_alignment = 'left';
											if ( isset( $bdp_settings['bdp_wishlistbutton_alignment'] ) ) {
												$bdp_wishlistbutton_alignment = $bdp_settings['bdp_wishlistbutton_alignment'];
											}
											?>
											<fieldset class="buttonset green" data-hide='1'>
												<input id="bdp_wishlistbutton_alignment_left" name="bdp_wishlistbutton_alignment" type="radio" value="left" <?php checked( 'left', $bdp_wishlistbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_wishlistbutton_alignment_left"><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></label>
												<input id="bdp_wishlistbutton_alignment_center" name="bdp_wishlistbutton_alignment" type="radio" value="center" <?php checked( 'center', $bdp_wishlistbutton_alignment ); ?> />
												<label id="bdp-options-button" class="bdp_wishlistbutton_alignment_center" for="bdp_wishlistbutton_alignment_center"><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></label>
												<input id="bdp_wishlistbutton_alignment_right" name="bdp_wishlistbutton_alignment" type="radio" value="right" <?php checked( 'right', $bdp_wishlistbutton_alignment ); ?> />
												<label id="bdp-options-button" for="bdp_wishlistbutton_alignment_right"><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr bdp_padding_0">
										<div class="bdp-typography-wrapper bdp-typography-wrapper1">
											<div class="bdp-typography-cover">
												<h3 class="bdp-table-title"><?php esc_html_e( 'Normal Settings', 'blog-designer-pro' ); ?></h3>
												<div class="bdp-typography-sub-cover bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_wishlist_textcolor = isset( $bdp_settings['bdp_wishlist_textcolor'] ) ? $bdp_settings['bdp_wishlist_textcolor'] : ''; ?>
														<input type="text" name="bdp_wishlist_textcolor" id="bdp_wishlist_textcolor" value="<?php echo esc_attr( $bdp_wishlist_textcolor ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_wishlist_backgroundcolor = isset( $bdp_settings['bdp_wishlist_backgroundcolor'] ) ? $bdp_settings['bdp_wishlist_backgroundcolor'] : ''; ?>
														<input type="text" name="bdp_wishlist_backgroundcolor" id="bdp_wishlist_backgroundcolor" value="<?php echo esc_attr( $bdp_wishlist_backgroundcolor ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Border Radius(px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php
														$display_wishlist_button_border_radius = '0';
														if ( isset( $bdp_settings['display_wishlist_button_border_radius'] ) ) {
															$display_wishlist_button_border_radius = $bdp_settings['display_wishlist_button_border_radius'];
														}
														?>
														<input type="number" id="display_wishlist_button_border_radius" name="display_wishlist_button_border_radius" step="1" min="0" value="<?php echo esc_attr( $display_wishlist_button_border_radius ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-typography-sub-cover full-width bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Border', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<div class="bdp-border-wrap">
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_borderleft = isset( $bdp_settings['bdp_wishlistbutton_borderleft'] ) ? $bdp_settings['bdp_wishlistbutton_borderleft'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_borderleft" name="bdp_wishlistbutton_borderleft" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_borderleft ); ?>"  onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_borderleftcolor = isset( $bdp_settings['bdp_wishlistbutton_borderleftcolor'] ) ? $bdp_settings['bdp_wishlistbutton_borderleftcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_borderleftcolor" id="bdp_wishlistbutton_borderleftcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_borderleftcolor ); ?>"/>
																	</div>
																</div>
															</div> 
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_borderright = isset( $bdp_settings['bdp_wishlistbutton_borderright'] ) ? $bdp_settings['bdp_wishlistbutton_borderright'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_borderright" name="bdp_wishlistbutton_borderright" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_borderright ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_borderrightcolor = isset( $bdp_settings['bdp_wishlistbutton_borderrightcolor'] ) ? $bdp_settings['bdp_wishlistbutton_borderrightcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_borderrightcolor" id="bdp_wishlistbutton_borderrightcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_borderrightcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_bordertop = isset( $bdp_settings['bdp_wishlistbutton_bordertop'] ) ? $bdp_settings['bdp_wishlistbutton_bordertop'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_bordertop" name="bdp_wishlistbutton_bordertop" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_bordertop ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_bordertopcolor = isset( $bdp_settings['bdp_wishlistbutton_bordertopcolor'] ) ? $bdp_settings['bdp_wishlistbutton_bordertopcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_bordertopcolor" id="bdp_wishlistbutton_bordertopcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_bordertopcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Bottom(px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_borderbuttom = isset( $bdp_settings['bdp_wishlistbutton_borderbuttom'] ) ? $bdp_settings['bdp_wishlistbutton_borderbuttom'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_borderbuttom" name="bdp_wishlistbutton_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_borderbuttom ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_borderbottomcolor = isset( $bdp_settings['bdp_wishlistbutton_borderbottomcolor'] ) ? $bdp_settings['bdp_wishlistbutton_borderbottomcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_borderbottomcolor" id="bdp_wishlistbutton_borderbottomcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_borderbottomcolor ); ?>"/>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="bdp-typography-cover">
												<h3 class="bdp-table-title"><?php esc_html_e( 'Hover Settings', 'blog-designer-pro' ); ?></h3>
												<div class="bdp-typography-sub-cover bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Text Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_wishlist_text_hover_color = isset( $bdp_settings['bdp_wishlist_text_hover_color'] ) ? $bdp_settings['bdp_wishlist_text_hover_color'] : ''; ?>
														<input type="text" name="bdp_wishlist_text_hover_color" id="bdp_wishlist_text_hover_color" value="<?php echo esc_attr( $bdp_wishlist_text_hover_color ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Background Color', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php $bdp_wishlist_hover_backgroundcolor = isset( $bdp_settings['bdp_wishlist_hover_backgroundcolor'] ) ? $bdp_settings['bdp_wishlist_hover_backgroundcolor'] : ''; ?>
														<input type="text" name="bdp_wishlist_hover_backgroundcolor" id="bdp_wishlist_hover_backgroundcolor" value="<?php echo esc_attr( $bdp_wishlist_hover_backgroundcolor ); ?>"/>
													</div>
												</div>
												<div class="bdp-typography-sub-cover bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
														<?php esc_html_e( 'Border Radius(px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<?php
														$display_wishlist_button_border_hover_radius = '0';
														if ( isset( $bdp_settings['display_wishlist_button_border_hover_radius'] ) ) {
															$display_wishlist_button_border_hover_radius = $bdp_settings['display_wishlist_button_border_hover_radius'];
														}
														?>
														<input type="number" id="display_wishlist_button_border_hover_radius" name="display_wishlist_button_border_hover_radius" step="1" min="0" value="<?php echo esc_attr( $display_wishlist_button_border_hover_radius ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-typography-sub-cover full-width bdp_add_to_wishlist_tr">
													<div class="bdp-typography-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Border', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-typography-content">
														<div class="bdp-border-wrap">
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Left (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_borderleft = isset( $bdp_settings['bdp_wishlistbutton_hover_borderleft'] ) ? $bdp_settings['bdp_wishlistbutton_hover_borderleft'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_hover_borderleft" name="bdp_wishlistbutton_hover_borderleft" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_borderleft ); ?>"  onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_borderleftcolor = isset( $bdp_settings['bdp_wishlistbutton_hover_borderleftcolor'] ) ? $bdp_settings['bdp_wishlistbutton_hover_borderleftcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_hover_borderleftcolor" id="bdp_wishlistbutton_hover_borderleftcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_borderleftcolor ); ?>"/>
																	</div>
																</div>
															</div> 
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Right (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_borderright = isset( $bdp_settings['bdp_wishlistbutton_hover_borderright'] ) ? $bdp_settings['bdp_wishlistbutton_hover_borderright'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_hover_borderright" name="bdp_wishlistbutton_hover_borderright" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_borderright ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_borderrightcolor = isset( $bdp_settings['bdp_wishlistbutton_hover_borderrightcolor'] ) ? $bdp_settings['bdp_wishlistbutton_hover_borderrightcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_hover_borderrightcolor" id="bdp_wishlistbutton_hover_borderrightcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_borderrightcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Top (px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_bordertop = isset( $bdp_settings['bdp_wishlistbutton_hover_bordertop'] ) ? $bdp_settings['bdp_wishlistbutton_hover_bordertop'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_hover_bordertop" name="bdp_wishlistbutton_hover_bordertop" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_bordertop ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_bordertopcolor = isset( $bdp_settings['bdp_wishlistbutton_hover_bordertopcolor'] ) ? $bdp_settings['bdp_wishlistbutton_hover_bordertopcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_hover_bordertopcolor" id="bdp_wishlistbutton_hover_bordertopcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_bordertopcolor ); ?>"/>
																	</div>
																</div>
															</div>
															<div class="bdp-border-wrapper bdp-border-wrapper1">
																<div class="bdp-border-cover bdp-border-label">
																		<span class="bdp-key-title">
																			<?php esc_html_e( 'Bottom(px)', 'blog-designer-pro' ); ?>
																		</span>
																	</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_borderbuttom = isset( $bdp_settings['bdp_wishlistbutton_hover_borderbuttom'] ) ? $bdp_settings['bdp_wishlistbutton_hover_borderbuttom'] : '0'; ?>
																		<input type="number" id="bdp_wishlistbutton_hover_borderbuttom" name="bdp_wishlistbutton_hover_borderbuttom" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_borderbuttom ); ?>" onkeypress="return isNumberKey(event)">
																	</div>
																</div>
																<div class="bdp-border-cover">
																	<div class="bdp-border-content">
																		<?php $bdp_wishlistbutton_hover_borderbottomcolor = isset( $bdp_settings['bdp_wishlistbutton_hover_borderbottomcolor'] ) ? $bdp_settings['bdp_wishlistbutton_hover_borderbottomcolor'] : ''; ?>
																		<input type="text" name="bdp_wishlistbutton_hover_borderbottomcolor" id="bdp_wishlistbutton_hover_borderbottomcolor" value="<?php echo esc_attr( $bdp_wishlistbutton_hover_borderbottomcolor ); ?>"/>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Padding', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right bdp-border-cover">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Set wishlist button padding', 'blog-designer-pro' ); ?></span></span>
											<div class="bdp-padding-wrapper bdp-padding-wrapper1 bdp-border-wrap">
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Left-Right (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_wishlistbutton_padding_leftright = isset( $bdp_settings['bdp_wishlistbutton_padding_leftright'] ) ? $bdp_settings['bdp_wishlistbutton_padding_leftright'] : '10'; ?>
														<input type="number" id="bdp_wishlistbutton_padding_leftright" name="bdp_wishlistbutton_padding_leftright" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_padding_leftright ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Top-Bottom (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_wishlistbutton_padding_topbottom = isset( $bdp_settings['bdp_wishlistbutton_padding_topbottom'] ) ? $bdp_settings['bdp_wishlistbutton_padding_topbottom'] : '10'; ?>
														<input type="number" id="bdp_wishlistbutton_padding_topbottom" name="bdp_wishlistbutton_padding_topbottom" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlistbutton_padding_topbottom ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr">
										<div class="bdp-left">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Margin', 'blog-designer-pro' ); ?>
											</span>
										</div>
										<div class="bdp-right bdp-border-cover">
											<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php esc_html_e( 'Set wishlist button margin', 'blog-designer-pro' ); ?></span></span>
											<div class="bdp-padding-wrapper bdp-padding-wrapper1 bdp-border-wrap">
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Left-Right (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_wishlistbutton_margin_leftright = isset( $bdp_settings['bdp_wishlistbutton_margin_leftright'] ) ? $bdp_settings['bdp_wishlistbutton_margin_leftright'] : '10'; ?>
														<input type="number" id="bdp_wishlistbutton_margin_leftright" name="bdp_wishlistbutton_margin_leftright" step="1" value="<?php echo esc_attr( $bdp_wishlistbutton_margin_leftright ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
												<div class="bdp-padding-cover">
													<div class="bdp-padding-label">
														<span class="bdp-key-title">
															<?php esc_html_e( 'Top-Bottom (px)', 'blog-designer-pro' ); ?>
														</span>
													</div>
													<div class="bdp-padding-content">
														<?php $bdp_wishlistbutton_margin_topbottom = isset( $bdp_settings['bdp_wishlistbutton_margin_topbottom'] ) ? $bdp_settings['bdp_wishlistbutton_margin_topbottom'] : '10'; ?>
														<input type="number" id="bdp_wishlistbutton_margin_topbottom" name="bdp_wishlistbutton_margin_topbottom" step="1" value="<?php echo esc_attr( $bdp_wishlistbutton_margin_topbottom ); ?>"  onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr wishlist_button_box_shadow_setting">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Box Shadow Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'H-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_top_box_shadow = isset( $bdp_settings['bdp_wishlist_button_top_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_top_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_top_box_shadow" name="bdp_wishlist_button_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_top_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'V-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select vertical offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_right_box_shadow = isset( $bdp_settings['bdp_wishlist_button_right_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_right_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_right_box_shadow" name="bdp_wishlist_button_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_right_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Blur (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blur value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_bottom_box_shadow = isset( $bdp_settings['bdp_wishlist_button_bottom_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_bottom_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_bottom_box_shadow" name="bdp_wishlist_button_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_bottom_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Spread (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select spread value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_left_box_shadow = isset( $bdp_settings['bdp_wishlist_button_left_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_left_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_left_box_shadow" name="bdp_wishlist_button_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_left_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover bdp-boxshadow-color">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Color', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select box shadow color', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
														<?php $bdp_wishlist_button_box_shadow_color = isset( $bdp_settings['bdp_wishlist_button_box_shadow_color'] ) ? $bdp_settings['bdp_wishlist_button_box_shadow_color'] : ''; ?>
														<input type="text" name="bdp_wishlist_button_box_shadow_color" id="bdp_wishlist_button_box_shadow_color" value="<?php echo esc_attr( $bdp_wishlist_button_box_shadow_color ); ?>"/>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr wishlist_button_box_hover_shadow_setting">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Hover Box Shadow Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-boxshadow-wrapper bdp-boxshadow-wrapper1">
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'H-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select horizontal offset value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_hover_top_box_shadow = isset( $bdp_settings['bdp_wishlist_button_hover_top_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_hover_top_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_hover_top_box_shadow" name="bdp_wishlist_button_hover_top_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_hover_top_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'V-offset (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select vertical side value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_hover_right_box_shadow = isset( $bdp_settings['bdp_wishlist_button_hover_right_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_hover_right_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_hover_right_box_shadow" name="bdp_wishlist_button_hover_right_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_hover_right_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Blur (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select blur value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_hover_bottom_box_shadow = isset( $bdp_settings['bdp_wishlist_button_hover_bottom_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_hover_bottom_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_hover_bottom_box_shadow" name="bdp_wishlist_button_hover_bottom_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_hover_bottom_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Spread (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select spread value', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_hover_left_box_shadow = isset( $bdp_settings['bdp_wishlist_button_hover_left_box_shadow'] ) ? $bdp_settings['bdp_wishlist_button_hover_left_box_shadow'] : '0'; ?>
													<input type="number" id="bdp_wishlist_button_hover_left_box_shadow" name="bdp_wishlist_button_hover_left_box_shadow" step="1" min="0" value="<?php echo esc_attr( $bdp_wishlist_button_hover_left_box_shadow ); ?>"  onkeypress="return isNumberKey(event)">
												</div>
											</div>
											<div class="bdp-boxshadow-cover bdp-boxshadow-color">
												<div class="bdp-boxshadow-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Color', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select box shadow color', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-boxshadow-content">
													<?php $bdp_wishlist_button_hover_box_shadow_color = isset( $bdp_settings['bdp_wishlist_button_hover_box_shadow_color'] ) ? $bdp_settings['bdp_wishlist_button_hover_box_shadow_color'] : ''; ?>
													<input type="text" name="bdp_wishlist_button_hover_box_shadow_color" id="bdp_wishlist_button_hover_box_shadow_color" value="<?php echo esc_attr( $bdp_wishlist_button_hover_box_shadow_color ); ?>"/>
												</div>
											</div>
										</div>
									</li>
									<li class="bdp_add_to_wishlist_tr">
										<h3 class="bdp-table-title"><?php esc_html_e( 'Typography Settings', 'blog-designer-pro' ); ?></h3>
										<div class="bdp-typography-wrapper bdp-typography-wrapper1">
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Family', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button font family', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_addtowishlist_button_fontface'] ) && '' != $bdp_settings['bdp_addtowishlist_button_fontface'] ) {
														$bdp_addtowishlist_button_fontface = $bdp_settings['bdp_addtowishlist_button_fontface'];
													} else {
														$bdp_addtowishlist_button_fontface = '';
													}
													?>
													<div class="typo-field">
														<input type="hidden" id="bdp_addtowishlist_button_fontface_font_type" name="bdp_addtowishlist_button_fontface_font_type" value="<?php echo isset( $bdp_settings['bdp_addtowishlist_button_fontface_font_type'] ) ? esc_attr( $bdp_settings['bdp_addtowishlist_button_fontface_font_type'] ) : ''; ?>">
														<div class="select-cover">
															<select name="bdp_addtowishlist_button_fontface" id="bdp_addtowishlist_button_fontface">
																<option value=""><?php esc_html_e( 'Select Font Family', 'blog-designer-pro' ); ?></option>
																<?php
																$old_version = '';
																$cnt         = 0;
																foreach ( $font_family as $key => $value ) {
																	if ( $value['version'] != $old_version ) {
																		if ( $cnt > 0 ) {
																			echo '</optgroup>';
																		}
																		echo '<optgroup label="' . esc_attr( $value['version'] ) . '">';
																		$old_version = $value['version'];
																	}
																	echo "<option value='" . esc_attr( str_replace( '"', '', $value['label'] ) ) . "'";
																	if ( '' != $bdp_addtowishlist_button_fontface && ( str_replace( '"', '', $bdp_addtowishlist_button_fontface ) == str_replace( '"', '', $value['label'] ) ) ) {
																		echo ' selected';
																	}
																	echo '>' . esc_html( $value['label'] ) . '</option>';
																	$cnt++;
																}
																if ( count( $font_family ) == $cnt ) {
																	echo '</optgroup>';
																}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Size (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button font size', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php
													if ( isset( $bdp_settings['bdp_addtowishlist_button_fontsize'] ) && '' != $bdp_settings['bdp_addtowishlist_button_fontsize'] ) {
														$bdp_addtowishlist_button_fontsize = $bdp_settings['bdp_addtowishlist_button_fontsize'];
													} else {
														$bdp_addtowishlist_button_fontsize = 14;
													}
													?>
													<div class="grid_col_space range_slider_fontsize" id="bdp_addtowishlist_button_fontsizeInput" ></div>
													<div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="bdp_addtowishlist_button_fontsize" id="bdp_addtowishlist_button_fontsize" value="<?php echo esc_attr( $bdp_addtowishlist_button_fontsize ); ?>" onkeypress="return isNumberKey(event)" /></div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Font Weight', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button font weight', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<?php $bdp_addtowishlist_button_font_weight = isset( $bdp_settings['bdp_addtowishlist_button_font_weight'] ) ? $bdp_settings['bdp_addtowishlist_button_font_weight'] : 'normal'; ?>
													<div class="select-cover">
														<select name="bdp_addtowishlist_button_font_weight" id="bdp_addtowishlist_button_font_weight">
															<option value="100" <?php selected( $bdp_addtowishlist_button_font_weight, 100 ); ?>>100</option>
															<option value="200" <?php selected( $bdp_addtowishlist_button_font_weight, 200 ); ?>>200</option>
															<option value="300" <?php selected( $bdp_addtowishlist_button_font_weight, 300 ); ?>>300</option>
															<option value="400" <?php selected( $bdp_addtowishlist_button_font_weight, 400 ); ?>>400</option>
															<option value="500" <?php selected( $bdp_addtowishlist_button_font_weight, 500 ); ?>>500</option>
															<option value="600" <?php selected( $bdp_addtowishlist_button_font_weight, 600 ); ?>>600</option>
															<option value="700" <?php selected( $bdp_addtowishlist_button_font_weight, 700 ); ?>>700</option>
															<option value="800" <?php selected( $bdp_addtowishlist_button_font_weight, 800 ); ?>>800</option>
															<option value="900" <?php selected( $bdp_addtowishlist_button_font_weight, 900 ); ?>>900</option>
															<option value="bold" <?php selected( $bdp_addtowishlist_button_font_weight, 'bold' ); ?> ><?php esc_html_e( 'Bold', 'blog-designer-pro' ); ?></option>
															<option value="normal" <?php selected( $bdp_addtowishlist_button_font_weight, 'normal' ); ?>><?php esc_html_e( 'Normal', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
												</div>
											</div>

											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Line Height', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button line height', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
													<?php
													$display_wishlist_button_line_height = '1.5';
													if ( isset( $bdp_settings['display_wishlist_button_line_height'] ) ) {
														$display_wishlist_button_line_height = $bdp_settings['display_wishlist_button_line_height'];
													}
													?>
												<input type="number" id="display_wishlist_button_line_height" name="display_wishlist_button_line_height" step="1" min="1.5" value="<?php echo esc_attr( $display_wishlist_button_line_height ); ?>" placeholder="<?php esc_attr_e( 'Enter line height', 'blog-designer-pro' ); ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
											<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
													<?php esc_html_e( 'Italic Font Style', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Display wishlist button italic font style', 'blog-designer-pro' ); ?></span></span><?php $bdp_addtowishlist_button_font_italic = isset( $bdp_settings['bdp_addtowishlist_button_font_italic'] ) ? $bdp_settings['bdp_addtowishlist_button_font_italic'] : '0'; ?>
											</div>
											<div class="bdp-typography-content">
												<fieldset class="bdp-social-options bdp-display_author buttonset">
													<input id="bdp_addtowishlist_button_font_italic_1" name="bdp_addtowishlist_button_font_italic" type="radio" value="1"  <?php checked( 1, $bdp_addtowishlist_button_font_italic ); ?> />
													<label for="bdp_addtowishlist_button_font_italic_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
													<input id="bdp_addtowishlist_button_font_italic_0" name="bdp_addtowishlist_button_font_italic" type="radio" value="0" <?php checked( 0, $bdp_addtowishlist_button_font_italic ); ?> />
													<label for="bdp_addtowishlist_button_font_italic_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
												</fieldset>
											</div>
										</div>
										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Transform', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button text transform style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_addtowishlist_button_font_text_transform = isset( $bdp_settings['bdp_addtowishlist_button_font_text_transform'] ) ? $bdp_settings['bdp_addtowishlist_button_font_text_transform'] : 'none'; ?>
													<div class="select-cover">
														<select name="bdp_addtowishlist_button_font_text_transform" id="bdp_addtowishlist_button_font_text_transform">
															<option <?php selected( $bdp_addtowishlist_button_font_text_transform, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtowishlist_button_font_text_transform, 'capitalize' ); ?> value="capitalize"><?php esc_html_e( 'Capitalize', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtowishlist_button_font_text_transform, 'uppercase' ); ?> value="uppercase"><?php esc_html_e( 'Uppercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtowishlist_button_font_text_transform, 'lowercase' ); ?> value="lowercase"><?php esc_html_e( 'Lowercase', 'blog-designer-pro' ); ?></option>
															<option <?php selected( $bdp_addtowishlist_button_font_text_transform, 'full-width' ); ?> value="full-width"><?php esc_html_e( 'Full Width', 'blog-designer-pro' ); ?></option>
														</select>
													</div>
											</div>
										</div>

										<div class="bdp-typography-cover">
											<div class="bdp-typography-label">
												<span class="bdp-key-title">
												<?php esc_html_e( 'Text Decoration', 'blog-designer-pro' ); ?>
												</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select wishlist button text decoration style', 'blog-designer-pro' ); ?></span></span>
											</div>
											<div class="bdp-typography-content">
												<?php $bdp_addtowishlist_button_font_text_decoration = isset( $bdp_settings['bdp_addtowishlist_button_font_text_decoration'] ) ? $bdp_settings['bdp_addtowishlist_button_font_text_decoration'] : 'none'; ?>
												<div class="select-cover">
													<select name="bdp_addtowishlist_button_font_text_decoration" id="bdp_addtowishlist_button_font_text_decoration">
														<option <?php selected( $bdp_addtowishlist_button_font_text_decoration, 'none' ); ?> value="none"><?php esc_html_e( 'None', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_addtowishlist_button_font_text_decoration, 'underline' ); ?> value="underline"><?php esc_html_e( 'Underline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_addtowishlist_button_font_text_decoration, 'overline' ); ?> value="overline"><?php esc_html_e( 'Overline', 'blog-designer-pro' ); ?></option>
														<option <?php selected( $bdp_addtowishlist_button_font_text_decoration, 'line-through' ); ?> value="line-through"><?php esc_html_e( 'Line Through', 'blog-designer-pro' ); ?></option>
													</select>
												</div>
											</div>
										</div>
											<div class="bdp-typography-cover">
												<div class="bdp-typography-label">
													<span class="bdp-key-title">
														<?php esc_html_e( 'Letter Spacing (px)', 'blog-designer-pro' ); ?>
													</span>
													<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enter wishlist button letter spacing', 'blog-designer-pro' ); ?></span></span>
												</div>
												<div class="bdp-typography-content">
													<div class="input-type-number">
														<input type="number" name="bdp_addtowishlist_button_letter_spacing" id="bdp_addtowishlist_button_letter_spacing" step="1" min="0" value="<?php echo isset( $bdp_settings['bdp_addtowishlist_button_letter_spacing'] ) ? esc_attr( $bdp_settings['bdp_addtowishlist_button_letter_spacing'] ) : '0'; ?>" onkeypress="return isNumberKey(event)">
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<?php if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) { ?>
				<div id="bdpacffieldssetting" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpacffieldssetting_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Display Acf Field', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Show ACF field', 'blog-designer-pro' ); ?></span></span>
									<?php
									$display_acf_field = '0';
									if ( isset( $bdp_settings['display_acf_field'] ) ) {
										$display_acf_field = $bdp_settings['display_acf_field'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide" data-hide='1'>
										<input id="display_acf_field_1" name="display_acf_field" type="radio" value="1" <?php checked( 1, $display_acf_field ); ?> />
										<label id="bdp-options-button" for="display_acf_field_1" <?php checked( 1, $display_acf_field ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="display_acf_field_0" name="display_acf_field" type="radio" value="0" <?php checked( 0, $display_acf_field ); ?> />
										<label id="bdp-options-button" for="display_acf_field_0" <?php checked( 1, $display_acf_field ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="bdp_setting_acf_field">
								<?php
								$post_id = get_posts(
									array(
										'fields'         => 'ids',
										'posts_per_page' => -1,
									)
								);
								$groups  = acf_get_field_groups(
									array(
										'post_id'   => $post_id,
										'post_type' => 'product',
									)
								);
								if ( ! empty( $groups ) ) {
									?>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Select ACF Field', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php esc_html_e( 'Filter post via category', 'blog-designer-pro' ); ?></span></span>
									<?php
									$bdp_acf_field = isset( $bdp_settings['bdp_acf_field'] ) ? $bdp_settings['bdp_acf_field'] : array();

									?>
									<select data-placeholder="<?php esc_attr_e( 'Choose acf field', 'blog-designer-pro' ); ?>" class="chosen-select" multiple style="width:220px;" name="bdp_acf_field[]" id="bdp_acf_field">
										<?php
										foreach ( $groups as $group ) {
											$group_id                                 = $group['ID'];
											$group_title                              = $group['title'];
											$all_acf_data[ $group_id ]                = array();
											$all_acf_data[ $group_id ]['group_id']    = $group_id;
											$all_acf_data[ $group_id ]['group_title'] = $group_title;
											$fields                                   = acf_get_fields( $group_id );
											if ( $fields ) {
												$all_acf_data[ $group_id ]['fields'] = array();
												$val_fields                          = 0;
												foreach ( $fields as $field ) {
													$field_id    = $field['ID'];
													$field_label = $field['label'];
													$field_key   = $field['key'];
													?>
													<option value="<?php echo esc_attr( $field_id ); ?>" 
														<?php
														if ( @is_array( $bdp_acf_field ) && in_array( $field_id, $bdp_acf_field ) ) {
															echo 'selected="selected"';
														}
														?>
													><?php echo esc_html( $field_label ); ?></option>
													<?php
												}
											}
										}
										?>
									</select>
								</div>
								<?php } ?>
							</li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<div id="bdpsocial" class="postbox postbox-with-fw-options" style=<?php echo esc_attr( $bdpsocial_class_show ); ?>>
					<div class="inside">
						<ul class="bdp-settings bdp-lineheight">
							<li>
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Social Share', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable social share link', 'blog-designer-pro' ); ?></span></span>
									<?php
									$social_share = isset( $bdp_settings['social_share'] ) ? $bdp_settings['social_share'] : 1;
									?>
									<fieldset class="bdp-social-options buttonset buttonset-hide" data-hide='1'>
										<input id="social_share_1" name="social_share" type="radio" value="1" <?php checked( 1, $social_share ); ?> />
										<label id="" for="social_share_1" <?php checked( 1, $social_share ); ?>><?php esc_html_e( 'Enable', 'blog-designer-pro' ); ?></label>
										<input id="social_share_0" name="social_share" type="radio" value="0" <?php checked( 0, $social_share ); ?> />
										<label id="" for="social_share_0" <?php checked( 0, $social_share ); ?>> <?php esc_html_e( 'Disable', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="social_share_options">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Social Share Style', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select social share style', 'blog-designer-pro' ); ?></span></span>
									<?php
									$social_style = '1';
									if ( isset( $bdp_settings['social_style'] ) ) {
										$social_style = $bdp_settings['social_style'];
									}
									?>
									<fieldset class="bdp-social-style buttonset buttonset-hide green" data-hide='1'>
										<input id="social_style_0" name="social_style" type="radio" value="0" <?php checked( 0, $social_style ); ?> />
										<label id="bdp-options-button" for="social_style_0" <?php checked( 0, $social_style ); ?>><?php esc_html_e( 'Default', 'blog-designer-pro' ); ?></label>
										<input id="social_style_1" name="social_style" type="radio" value="1" <?php checked( 1, $social_style ); ?> />
										<label id="bdp-options-button" for="social_style_1" <?php checked( 1, $social_style ); ?>><?php esc_html_e( 'Custom', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="social_share_options shape_social_icon">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Shape of Social Icon', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select shape of social icon', 'blog-designer-pro' ); ?></span></span>
									<?php
									$social_icon_style = isset( $bdp_settings['social_icon_style'] ) ? $bdp_settings['social_icon_style'] : 1;
									?>
									<fieldset class="bdp-social-shape buttonset buttonset-hide green" data-hide='1'>
										<input id="social_icon_style_0" name="social_icon_style" type="radio" value="0" nhp-opts-button-hide-below <?php checked( 0, $social_icon_style ); ?> />
										<label id="bdp-options-button" for="social_icon_style_0" <?php checked( 0, $social_icon_style ); ?>><?php esc_html_e( 'Circle', 'blog-designer-pro' ); ?></label>
										<input id="social_icon_style_1" name="social_icon_style" type="radio" value="1" nhp-opts-button-hide-below <?php checked( 1, $social_icon_style ); ?> />
										<label id="bdp-options-button" for="social_icon_style_1" <?php checked( 1, $social_icon_style ); ?>><?php esc_html_e( 'Square', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="social_share_options size_social_icon">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Size of Social Icon', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select size of social icon', 'blog-designer-pro' ); ?></span></span>
									<?php
									$social_icon_size = isset( $bdp_settings['social_icon_size'] ) ? $bdp_settings['social_icon_size'] : '0';
									?>
									<fieldset class="bdp-social-size buttonset buttonset-hide green bdp-social-icon-size" data-hide='1'>
										<input id="social_icon_size_2" name="social_icon_size" type="radio" value="2" <?php checked( 2, $social_icon_size ); ?> />
										<label id="bdp-options-button" for="social_icon_size_2" <?php checked( 2, $social_icon_size ); ?>><?php esc_html_e( 'Extra Small', 'blog-designer-pro' ); ?></label>
										<input id="social_icon_size_1" name="social_icon_size" type="radio" value="1" <?php checked( 1, $social_icon_size ); ?> />
										<label id="bdp-options-button" for="social_icon_size_1" <?php checked( 1, $social_icon_size ); ?>><?php esc_html_e( 'Small', 'blog-designer-pro' ); ?></label>
										<input id="social_icon_size_0" name="social_icon_size" type="radio" value="0" <?php checked( 0, $social_icon_size ); ?> />
										<label id="bdp-options-button" for="social_icon_size_0" <?php checked( 0, $social_icon_size ); ?>><?php esc_html_e( 'Large', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class="social_share_options default_icon_layouts">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Available Icon Themes', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
								<span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-social"><span class="bdp-tooltips"><?php esc_html_e( 'Select icon theme from available icon theme', 'blog-designer-pro' ); ?></span></span>
									<?php
									$default_icon_theme = 1;
									if ( isset( $bdp_settings['default_icon_theme'] ) ) {
										$default_icon_theme = $bdp_settings['default_icon_theme'];
									}
									?>
									<div class="social-share-theme">
										<?php
										for ( $i = 1; $i <= 10; $i++ ) {
											?>
											<div class="social-cover social_share_theme_<?php echo esc_attr( $i ); ?>">
												<label><input type="radio" id="default_icon_theme_<?php echo esc_attr( $i ); ?>" value="<?php echo esc_attr( $i ); ?>" name="default_icon_theme" <?php checked( $i, $default_icon_theme ); ?> />
													<span class="bdp-social-icons facebook-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons twitter-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons linkdin-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons pin-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons whatsup-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons telegram-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons pocket-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons mail-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons reddit-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons digg-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons tumblr-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons skype-icon bdp_theme_wrapper"></span>
													<span class="bdp-social-icons wordpress-icon bdp_theme_wrapper"></span>
												</label>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</li>
							<h3 class="bdp-table-title social_share_options bdp-display-settings bdp-social-share-options">Social Share Links Settings</h3>
							<li class="social_share_options bdp-display-settings bdp-social-share-options">
								<div class="bdp-typography-wrapper">
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Facebook Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable facebook share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											$facebook_link = isset( $bdp_settings['facebook_link'] ) ? $bdp_settings['facebook_link'] : 1;
											?>
											<fieldset class="bdp-social-options bdp-facebook_link buttonset buttonset-hide" data-hide='1'>
												<input id="facebook_link_1" name="facebook_link" type="radio" value="1" <?php checked( 1, $facebook_link ); ?> />
												<label id=""for="facebook_link_1" <?php checked( 1, $facebook_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="facebook_link_0" name="facebook_link" type="radio" value="0" <?php checked( 0, $facebook_link ); ?> />
												<label id="" for="facebook_link_0" <?php checked( 0, $facebook_link ); ?>> <?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
											<label class="social_link_with_count">
												<input id="facebook_link_with_count" name="facebook_link_with_count" type="checkbox" value="1" 
												<?php
												if ( isset( $bdp_settings['facebook_link_with_count'] ) ) {
													checked( 1, $bdp_settings['facebook_link_with_count'] );
												}
												?>
												/>
												<?php esc_html_e( 'Hide Facebook Share Count', 'blog-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Twitter Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable twitter share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											$twitter_link = isset( $bdp_settings['twitter_link'] ) ? $bdp_settings['twitter_link'] : 1;
											?>
											<fieldset class="bdp-social-options bdp-twitter_link buttonset buttonset-hide" data-hide='1'>
												<input id="twitter_link_1" name="twitter_link" type="radio" value="1" <?php checked( 1, $twitter_link ); ?> />
												<label for="twitter_link_1" <?php checked( 1, $twitter_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="twitter_link_0" name="twitter_link" type="radio" value="0" <?php checked( 0, $twitter_link ); ?> />
												<label for="twitter_link_0" <?php checked( 0, $twitter_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Linkedin Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable linkedin share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											$linkedin_link = isset( $bdp_settings['linkedin_link'] ) ? $bdp_settings['linkedin_link'] : 1;
											?>
											<fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
												<input id="linkedin_link_1" name="linkedin_link" type="radio" value="1" <?php checked( 1, $linkedin_link ); ?> />
												<label for="linkedin_link_1" <?php checked( 1, $linkedin_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="linkedin_link_0" name="linkedin_link" type="radio" value="0" <?php checked( 0, $linkedin_link ); ?> />
												<label for="linkedin_link_0" <?php checked( 0, $linkedin_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Pinterest Share link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable pinterest share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php
											$pinterest_link = isset( $bdp_settings['pinterest_link'] ) ? $bdp_settings['pinterest_link'] : 1;
											?>
											<fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
												<input id="pinterest_link_1" name="pinterest_link" type="radio" value="1" <?php checked( 1, $pinterest_link ); ?> />
												<label for="pinterest_link_1" <?php checked( 1, $pinterest_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="pinterest_link_0" name="pinterest_link" type="radio" value="0" <?php checked( 0, $pinterest_link ); ?> />
												<label for="pinterest_link_0" <?php checked( 0, $pinterest_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
											<label class="social_link_with_count">
												<input id="pinterest_link_with_count" name="pinterest_link_with_count" type="checkbox" value="1" 
												<?php
												if ( isset( $bdp_settings['pinterest_link_with_count'] ) ) {
													checked( 1, $bdp_settings['pinterest_link_with_count'] );
												}
												?>
												/>
												<?php esc_html_e( 'Hide Pinterest Share Count', 'blog-designer-pro' ); ?>
											</label>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Show Pinterest on Featured Image', 'blog-designer-pro' ); ?>
											</span>
												<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable pinterest share button on feature image', 'blog-designer-pro' ); ?></span></span>

										</div>
										<div class="bdp-typography-content">
											<label>
												<?php $pinterest_image_share = isset( $bdp_settings['pinterest_image_share'] ) ? $bdp_settings['pinterest_image_share'] : 1; ?>
												<fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
													<input id="pinterest_image_share_1" name="pinterest_image_share" type="radio" value="1" <?php checked( 1, $pinterest_image_share ); ?> />
													<label for="pinterest_image_share_1" <?php checked( 1, $pinterest_image_share ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
													<input id="pinterest_image_share_0" name="pinterest_image_share" type="radio" value="0" <?php checked( 0, $pinterest_image_share ); ?> />
													<label for="pinterest_image_share_0" <?php checked( 0, $pinterest_image_share ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
												</fieldset>
											</label>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Skype Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable skype share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $skype_link = isset( $bdp_settings['skype_link'] ) ? $bdp_settings['skype_link'] : '0'; ?>
											<fieldset class="bdp-social-options bdp-twitter_link buttonset buttonset-hide" data-hide='1'>
												<input id="skype_link_1" name="skype_link" type="radio" value="1" <?php checked( 1, $skype_link ); ?> />
												<label for="skype_link_1" <?php checked( 1, $skype_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="skype_link_0" name="skype_link" type="radio" value="0" <?php checked( 0, $skype_link ); ?> />
												<label for="skype_link_0" <?php checked( 0, $skype_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Pocket Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable pocket share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<?php $pocket_link = isset( $bdp_settings['pocket_link'] ) ? $bdp_settings['pocket_link'] : '0'; ?>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-pocket_link buttonset buttonset-hide" data-hide='1'>
												<input id="pocket_link_1" name="pocket_link" type="radio" value="1" <?php checked( 1, $pocket_link ); ?> />
												<label for="pocket_link_1" <?php checked( 1, $pocket_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="pocket_link_0" name="pocket_link" type="radio" value="0" <?php checked( 0, $pocket_link ); ?> />
												<label for="pocket_link_0" <?php checked( 0, $pocket_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Telegram Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable telegram share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<?php $telegram_link = isset( $bdp_settings['telegram_link'] ) ? $bdp_settings['telegram_link'] : '0'; ?>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-telegram_link buttonset buttonset-hide" data-hide='1'>
												<input id="telegram_link_1" name="telegram_link" type="radio" value="1" <?php checked( 1, $telegram_link ); ?> />
												<label for="telegram_link_1" <?php checked( 1, $telegram_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="telegram_link_0" name="telegram_link" type="radio" value="0" <?php checked( 0, $telegram_link ); ?> />
												<label for="telegram_link_0" <?php checked( 0, $telegram_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Reddit Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable reddit share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<?php $reddit_link = isset( $bdp_settings['reddit_link'] ) ? $bdp_settings['reddit_link'] : '0'; ?>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-reddit_link buttonset buttonset-hide" data-hide='1'>
												<input id="reddit_link_1" name="reddit_link" type="radio" value="1" <?php checked( 1, $reddit_link ); ?> />
												<label for="reddit_link_1" <?php checked( 1, $reddit_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="reddit_link_0" name="reddit_link" type="radio" value="0" <?php checked( 0, $reddit_link ); ?> />
												<label for="reddit_link_0" <?php checked( 0, $reddit_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Digg Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable digg share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<?php $digg_link = isset( $bdp_settings['digg_link'] ) ? $bdp_settings['digg_link'] : '0'; ?>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-reddit_link buttonset buttonset-hide" data-hide='1'>
												<input id="digg_link_1" name="digg_link" type="radio" value="1" <?php checked( 1, $digg_link ); ?> />
												<label for="digg_link_1" <?php checked( 1, $digg_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="digg_link_0" name="digg_link" type="radio" value="0" <?php checked( 0, $digg_link ); ?> />
												<label for="digg_link_0" <?php checked( 0, $digg_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Tumblr Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable tumblr share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<?php $tumblr_link = isset( $bdp_settings['tumblr_link'] ) ? $bdp_settings['tumblr_link'] : '0'; ?>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-tumblr_link buttonset buttonset-hide" data-hide='1'>
												<input id="tumblr_link_1" name="tumblr_link" type="radio" value="1" <?php checked( 1, $tumblr_link ); ?> />
												<label for="tumblr_link_1" <?php checked( 1, $tumblr_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="tumblr_link_0" name="tumblr_link" type="radio" value="0" <?php checked( 0, $tumblr_link ); ?> />
												<label for="tumblr_link_0" <?php checked( 0, $tumblr_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'WordPress Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable WordPress share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<?php $wordpress_link = isset( $bdp_settings['wordpress_link'] ) ? $bdp_settings['wordpress_link'] : '0'; ?>
										<div class="bdp-typography-content">
											<fieldset class="bdp-social-options bdp-wordpress_link buttonset buttonset-hide" data-hide='1'>
												<input id="wordpress_link_1" name="wordpress_link" type="radio" value="1" <?php checked( 1, $wordpress_link ); ?> />
												<label for="wordpress_link_1" <?php checked( 1, $wordpress_link ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="wordpress_link_0" name="wordpress_link" type="radio" value="0" <?php checked( 0, $wordpress_link ); ?> />
												<label for="wordpress_link_0" <?php checked( 0, $wordpress_link ); ?>><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'Share via Mail', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable mail share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $email_link = isset( $bdp_settings['email_link'] ) ? $bdp_settings['email_link'] : 0; ?>
											<fieldset class="bdp-social-options bdp-linkedin_link buttonset">
												<input id="email_link_1" class="bdp-opts-button" name="email_link" type="radio" value="1" <?php checked( 1, $email_link ); ?> />
												<label id="bdp-opts-button" for="email_link_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<label id="bdp-opts-button" for="email_link_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
												<input id="email_link_0" class="bdp-opts-button" name="email_link" type="radio" value="0" <?php checked( 0, $email_link ); ?> />
											</fieldset>
										</div>
									</div>
									<div class="bdp-typography-cover">
										<div class="bdp-typography-label">
											<span class="bdp-key-title">
												<?php esc_html_e( 'WhatsApp Share Link', 'blog-designer-pro' ); ?>
											</span>
											<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable whatsapp share link', 'blog-designer-pro' ); ?></span></span>
										</div>
										<div class="bdp-typography-content">
											<?php $whatsapp_link = isset( $bdp_settings['whatsapp_link'] ) ? $bdp_settings['whatsapp_link'] : '0'; ?>
											<fieldset class="bdp-social-options bdp-whatsapp_link buttonset">
												<input id="whatsapp_link_1" class="bdp-opts-button" name="whatsapp_link" type="radio" value="1" <?php checked( 1, $whatsapp_link ); ?> />
												<label id="bdp-opts-button" for="whatsapp_link_1"><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
												<input id="whatsapp_link_0" class="bdp-opts-button" name="whatsapp_link" type="radio" value="0" <?php checked( 0, $whatsapp_link ); ?> />
												<label id="bdp-opts-button" for="whatsapp_link_0"><?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
											</fieldset>
										</div>
									</div>

								</div>
							</li>
							<li class="social_share_options fb_access_token_div">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Facebook Access Token', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Facebook access token', 'blog-designer-pro' ); ?></span></span>
									<?php
									$facebook_token = '';
									if ( isset( $bdp_settings['facebook_token'] ) ) {
										$facebook_token = $bdp_settings['facebook_token'];
									}
									?>
									<input type="text" name="facebook_token" id="facebook_token" value="<?php echo esc_attr( $facebook_token ); ?>" >
								</div>
							</li>
							<li class="social_share_options mail_share_content">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Mail Share Content', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">

										<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Mail share content', 'blog-designer-pro' ); ?></span></span>
									<?php $mail_subject = ( isset( $bdp_settings['mail_subject'] ) && '' != $bdp_settings['mail_subject'] ) ? $bdp_settings['mail_subject'] : '[post_title]'; ?>
									<input type="text" name="mail_subject" id="mail_subject" value="<?php echo esc_attr( $mail_subject ); ?>" placeholder="<?php esc_attr_e( 'Enter Mail Subject', 'blog-designer-pro' ); ?>">
									<?php
									$settings = array(
										'wpautop'       => true,
										'media_buttons' => true,
										'textarea_name' => 'mail_content',
										'textarea_rows' => 10,
										'tabindex'      => '',
										'editor_css'    => '',
										'editor_class'  => '',
										'teeny'         => false,
										'dfw'           => false,
										'tinymce'       => true,
										'quicktags'     => true,
									);
									if ( isset( $bdp_settings['mail_content'] ) && '' != $bdp_settings['mail_content'] ) {
										$contents = $bdp_settings['mail_content'];
									} else {
										$contents = esc_html__( 'My Dear friends', 'blog-designer-pro' ) . '<br/><br/>' . esc_html__( 'I read one good blog link and I would like to share that same link for you. That might useful for you', 'blog-designer-pro' ) . '<br/><br/>[post_link]<br/><br/>' . esc_html__( 'Best Regards', 'blog-designer-pro' ) . ',<br/>' . esc_html__( 'Blog Designer', 'blog-designer-pro' );
									}

									wp_editor( html_entity_decode( $contents ), 'mail_content', $settings );
									?>
									<div class="div-pre">
										<p> [post_title] => <?php esc_html_e( 'Post Title', 'blog-designer-pro' ); ?> </p>
										<p> [post_link] => <?php esc_html_e( 'Post Link', 'blog-designer-pro' ); ?> </p>
										<p> [post_thumbnail] => <?php esc_html_e( 'Post Featured Image', 'blog-designer-pro' ); ?> </p>
										<p> [sender_name] => <?php esc_html_e( 'Mail Sender Name', 'blog-designer-pro' ); ?> </p>
										<p> [sender_email] => <?php esc_html_e( 'Mail Sender Email Address', 'blog-designer-pro' ); ?> </p>
									</div>
								</div>
							</li>
							<li class="social_share_options mail_share_content">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Remove Reply to email', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right">
									<span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Enable/Disable Replay to email', 'blog-designer-pro' ); ?></span></span>
									<?php
									$reply_to_mail = isset( $bdp_settings['reply_to_mail'] ) ? $bdp_settings['reply_to_mail'] : 0;
									?>
									<fieldset class="bdp-social-options buttonset buttonset-hide" data-hide='1'>
										<input id="reply_to_mail_1" name="reply_to_mail" type="radio" value="1" <?php checked( 1, $reply_to_mail ); ?> />
										<label id="" for="reply_to_mail_1" <?php checked( 1, $reply_to_mail ); ?>><?php esc_html_e( 'Yes', 'blog-designer-pro' ); ?></label>
										<input id="reply_to_mail_0" name="reply_to_mail" type="radio" value="0" <?php checked( 0, $reply_to_mail ); ?> />
										<label id="" for="reply_to_mail_0" <?php checked( 0, $reply_to_mail ); ?>> <?php esc_html_e( 'No', 'blog-designer-pro' ); ?></label>
									</fieldset>
								</div>
							</li>
							<li class ="social_share_options">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Social Share Count Position', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right"><span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select social share count position', 'blog-designer-pro' ); ?></span></span>
									<?php
									$social_count_position = 'bottom';
									if ( isset( $bdp_settings['social_count_position'] ) ) {
										$social_count_position = $bdp_settings['social_count_position'];
									}
									?>
									<div class="typo-field">
										<select name="social_count_position" id="social_sharecount">
											<option value="bottom" <?php echo selected( 'bottom', $social_count_position ); ?>><?php esc_html_e( 'Bottom', 'blog-designer-pro' ); ?></option>
											<option value="right" <?php echo selected( 'right', $social_count_position ); ?>><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></option>
											<option value="top" <?php echo selected( 'top', $social_count_position ); ?>><?php esc_html_e( 'Top', 'blog-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
							<li class="social_share_options social_share_position_option">
								<div class="bdp-left">
									<span class="bdp-key-title">
										<?php esc_html_e( 'Social Share Position', 'blog-designer-pro' ); ?>
									</span>
								</div>
								<div class="bdp-right"><span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php esc_html_e( 'Select social share position', 'blog-designer-pro' ); ?></span></span>
									<?php
									$social_share_position = 'left';
									if ( isset( $bdp_settings['social_share_position'] ) ) {
										$social_share_position = $bdp_settings['social_share_position'];
									}
									?>
									<div class="typo-field">
										<select name="social_share_position" id="social_share_position">
											<option value="left" <?php echo selected( 'left', $social_share_position ); ?>><?php esc_html_e( 'Left', 'blog-designer-pro' ); ?></option>
											<option value="center" <?php echo selected( 'center', $social_share_position ); ?>><?php esc_html_e( 'Center', 'blog-designer-pro' ); ?></option>
											<option value="right" <?php echo selected( 'right', $social_share_position ); ?>><?php esc_html_e( 'Right', 'blog-designer-pro' ); ?></option>
										</select>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div id="popupdiv" class="bdp-template-popupdiv bdp-archive-popupdiv" style="display: none;">
		<?php
		foreach ( $tempate_list as $key => $value ) {
			$classes = explode( ' ', $value['class'] );
			foreach ( $classes as $class ) {
				$all_class[] = $class;
			}
		}
		$count = array_count_values( $all_class );
		?>
		<ul class="bdp_template_tab">
			<li class="current_tab">
				<a href="#all"><?php esc_html_e( 'All', 'blog-designer-pro' ); ?></a>
			</li>
			<li class="">
				<a href="#full-width"><?php echo esc_html__( 'Full Width', 'blog-designer-pro' ) . ' (' . esc_html( $count['full-width'] ) . ')'; ?></a>
			</li>
			<li>
				<a href="#grid"><?php echo esc_html__( 'Grid', 'blog-designer-pro' ) . ' (' . esc_html( $count['grid'] ) . ')'; ?></a>
			</li>
			<li>
				<a href="#masonry"><?php echo esc_html__( 'Masonry', 'blog-designer-pro' ) . ' (' . esc_html( $count['masonry'] ) . ')'; ?></a>
			</li>
			<li>
				<a href="#magazine"><?php echo esc_html__( 'Magazine', 'blog-designer-pro' ) . ' (' . esc_html( $count['magazine'] ) . ')'; ?></a>
			</li>
			<li>
				<a href="#timeline"><?php echo esc_html__( 'Timeline', 'blog-designer-pro' ) . ' (' . esc_html( $count['timeline'] ) . ')'; ?></a>
			</li>
			<li>
				<a href="#slider"><?php echo esc_html__( 'Slider', 'blog-designer-pro' ) . ' (' . esc_html( $count['slider'] ) . ')'; ?></a>
			</li>

			<div class="bdp-blog-template-search-cover">
				<input type="text" class="bdp-template-search" id="bdp-template-search" placeholder="<?php esc_html_e( 'Search Template', 'blog-designer-pro' ); ?>" />
				<span class="bdp-template-search-clear"></span>
			</div>
		</ul>
		<?php
		echo '<div class="bdp-blog-template-cover">';
		foreach ( $tempate_list as $key => $value ) {
			?>
			<div class="template-thumbnail <?php echo esc_attr( $value['class'] ); ?>" <?php echo ( isset( $value['data'] ) && '' != $value['data'] ) ? 'data-value="' . esc_attr( $value['data'] ) . '"' : ''; ?>>
				<div class="template-thumbnail-inner">
					<img src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/admin/images/layouts/' . esc_attr( $value['image_name'] ); ?>" alt="<?php echo esc_attr( $value['template_name'] ); ?>" title="<?php echo esc_attr( $value['template_name'] ); ?>" data-value="<?php echo esc_attr( $key ); ?>">
					<div class="hover_overlay">
						<div class="popup-template-name">
							<div class="popup-select"><a href="#"><?php esc_html_e( 'Select Template', 'blog-designer-pro' ); ?></a></div>
							<div class="popup-view"><a href="<?php echo esc_attr( $value['demo_link'] ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'blog-designer-pro' ); ?></a></div>
						</div>
					</div>
				</div>
				<span class="bdp-span-template-name"><?php echo esc_attr( $value['template_name'] ); ?></span>
			</div>
			<?php
		}
		echo '</div>';
		echo '<h3 class="no-template" style="display: none;">' . esc_html__( 'No template found. Please try again', 'blog-designer-pro' ) . '</h3>';
		?>
	</div>

	<div id="popuploaderdiv" class="bdp-loader-popupdiv bdp-wrapper" style="display: none;">
		<div class="bdp-loader-style-box">
			<?php
			$total_bullets = count( $loaders );
			if ( $total_bullets > 0 ) {
				foreach ( $loaders as $key => $loader_html ) {
					?>
					<div class="bdp-dialog-loader-style <?php echo esc_attr( $key ); ?>">
						<input type="hidden" class="bdp-loader-style-hidden" value="<?php echo esc_attr( $key ); ?>" />
						<div class="bdp-loader-style-html">
							<?php echo wp_kses( $loader_html, Bdp_Admin_Functions::args_kses() ); ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<div id="popupnavifationdiv" class="bdp-navigation-popupdiv bdp-wrapper" style="display: none;">
		<div class="bdp-navigation-style-box">
			<?php
			for ( $i = 1; $i <= 9; $i++ ) {
				?>
				<div class="bdp-navigation-cover navigation<?php echo esc_attr( $i ); ?>">
					<input type="hidden" class="bdp-navigation-style-hidden" value="navigation<?php echo esc_attr( $i ); ?>" />
					<img src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/public/images/navigation/navigation' . esc_attr( $i ) . '.png'; ?>">
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<div id="popuparrowdiv" class="bdp-arrow-popupdiv bdp-wrapper" style="display: none;">
		<div class="bdp-arrow-style-box">
			<?php
			for ( $i = 1; $i <= 6; $i++ ) {
				?>
				<div class="bdp-arrow-cover arrow<?php echo esc_attr( $i ); ?>">
					<input type="hidden" class="bdp-arrow-style-hidden" value="arrow<?php echo esc_attr( $i ); ?>" />
					<img src="<?php echo esc_attr( BLOGDESIGNERPRO_URL ) . '/public/images/arrow/arrow' . esc_attr( $i ) . '.png'; ?>">
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php
