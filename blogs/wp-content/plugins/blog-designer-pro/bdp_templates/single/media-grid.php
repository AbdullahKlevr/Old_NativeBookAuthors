<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/media-grid.php.
 *
 * @link       https://www.solwininfotech.com/
 * @since      2.3
 *
 * @package    Blog_Designer_PRO
 * @subpackage Blog_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'bd_single_design_format_function', 'bdp_single_media_grid_template', 10, 1 );
if ( ! function_exists( 'bdp_single_media_grid_template' ) ) {

	/**
	 * Add html for media grid template
	 *
	 * @global object $post
	 * @param array $bdp_settings settings.
	 * @return void
	 */
	function bdp_single_media_grid_template( $bdp_settings ) {
		if ( isset( $bdp_settings['enable_lazy_load'] ) && 1 == $bdp_settings['enable_lazy_load'] ) {
			add_filter( 'wp_get_attachment_image_attributes', 'lazyload_images_modify_post_thumbnail_attr', 11, 5 );
		}
		global $post;
		$post_type         = get_post_type( $post->ID );
		$bdp_all_post_type = array( 'product', 'download' );
		$no_image          = 'no_image_post';
		if ( isset( $bdp_settings['display_thumbnail'] ) && 1 == $bdp_settings['display_thumbnail'] && has_post_thumbnail() ) {
			$no_image = '';
		}
		?>
		<div class="blog_template bdp_blog_template media-grid">
			<?php
			do_action( 'bdp_before_single_post_content' );
			?>
			<div class="bdp-post-image <?php echo esc_html( $no_image ); ?>">
				<?php
				if ( isset( $bdp_settings['display_thumbnail'] ) && 1 == $bdp_settings['display_thumbnail'] && has_post_thumbnail() ) {
					if ( 'product' === $post_type ) {
						if ( isset( $bdp_settings['pinterest_image_share'] ) && 1 == $bdp_settings['pinterest_image_share'] && isset( $bdp_settings['social_share'] ) && 1 == $bdp_settings['social_share'] ) {
							echo wp_kses( Bdp_Utility::pinterest( $post->ID ), Bdp_Admin_Functions::args_kses() );
						}
						do_action( 'bdp_woocommerce_show_product_images', $bdp_settings, $post->ID );
					} else {
						$single_post_image = Bdp_Posts::get_the_single_post_thumbnail( $bdp_settings, get_post_thumbnail_id(), get_the_ID() );
						echo wp_kses( apply_filters( 'bdp_single_post_thumbnail_filter', $single_post_image, get_the_ID() ), Bdp_Admin_Functions::args_kses() );
						if ( isset( $bdp_settings['pinterest_image_share'] ) && 1 == $bdp_settings['pinterest_image_share'] && isset( $bdp_settings['social_share'] ) && 1 == $bdp_settings['social_share'] ) {
							echo wp_kses( Bdp_Utility::pinterest( $post->ID ), Bdp_Admin_Functions::args_kses() );
						}
					}
				}
				?>
				<?php
				if ( 'product' === $post_type ) {
					if ( isset( $bdp_settings['display_category'] ) && 1 == $bdp_settings['display_category'] ) {
						?>
						<span class="category-link">
							<?php
							$categories_list = get_the_category_list( ', ' );
							$categories_link = ( isset( $bdp_settings['disable_link_category'] ) && 1 == $bdp_settings['disable_link_category'] ) ? true : false;
							if ( $categories_link ) {
								$categories_list = wp_strip_all_tags( $categories_list );
							}
							if ( $categories_list ) :
								echo ' '. wp_kses( $categories_list, Bdp_Admin_Functions::args_kses() );
							endif;
							?>
						</span>
						<?php
					}
				}
				?>
			</div>
			<?php
			if ( in_array( $post_type, $bdp_all_post_type ) ) {
				$bdp_tax_cat = '';
				if ( 'product' === $post_type ) {
					$bdp_tax_cat = 'product_cat';
				} elseif ( 'download' === $post_type ) {
					$bdp_tax_cat = 'download_category';
				}
				if ( '' != $bdp_tax_cat && isset( $bdp_settings[ 'display_taxonomy_' . $bdp_tax_cat ] ) && 1 == $bdp_settings[ 'display_taxonomy_' . $bdp_tax_cat ] ) {
					$categories_link    = ( isset( $bdp_settings[ 'disable_link_taxonomy_' . $bdp_tax_cat ] ) && 1 == $bdp_settings[ 'disable_link_taxonomy_' . $bdp_tax_cat ] ) ? false : true;
					$product_categories = wp_get_post_terms( $post->ID, $bdp_tax_cat, array( 'hide_empty' => 'false' ) );
					$sep                = 1;
					?>
					<div class="product-category-wrap">
					<span class="category-link <?php echo ( $categories_link ) ? 'bdp-no-links' : 'bdp-has-links'; ?>">
						<?php
						foreach ( $product_categories as $category ) {
							if ( 1 != $sep ) {
								?>
								<span class="seperater"><?php echo ', '; ?></span>
								<?php
							}
							echo ( $categories_link ) ? '<a href="' . esc_url( get_term_link( $category->term_id ) ) . '">' : '';
							echo esc_html( $category->name );
							echo ( $categories_link ) ? '</a>' : '';
							$sep++;
						}
						?>
					</span>
						</div>
					<?php
				}
			}
			?>
			<div class="content-container <?php echo esc_attr( $no_image ); ?>">
				<div class="shadow-box"></div>
				<div class="content-inner">
					<?php
					$display_title = ( isset( $bdp_settings['display_title'] ) && '' != $bdp_settings['display_title'] ) ? $bdp_settings['display_title'] : 1;
					if ( 1 == $display_title ) {
						?>
						<h1 class="post-title entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
						<?php
					}
					?>
					<?php
					$center       = '';
					$social_share = ( isset( $bdp_settings['social_share'] ) && 0 == $bdp_settings['social_share'] ) ? false : true;
					if ( ( ! isset( $bdp_settings['facebook_link_with_count'] ) || ! isset( $bdp_settings['pinterest_link_with_count'] ) ) &&
							( 'bottom' === $bdp_settings['social_count_position'] || 'top' === $bdp_settings['social_count_position'] ) ) {
						$center = 'set_center_div';
					}
					if ( 1 == $bdp_settings['display_author'] || 1 == $bdp_settings['display_date'] || 1 == $bdp_settings['display_comment'] || ( $social_share && ( ( 1 == $bdp_settings['facebook_link'] ) || ( 1 == $bdp_settings['twitter_link'] ) || ( 1 == $bdp_settings['linkedin_link'] ) || ( isset( $bdp_settings['email_link'] ) && 1 == $bdp_settings['email_link'] ) || ( 1 == $bdp_settings['pinterest_link'] ) || ( isset( $bdp_settings['telegram_link'] ) && 1 == $bdp_settings['telegram_link'] ) || ( isset( $bdp_settings['pocket_link'] ) && 1 == $bdp_settings['pocket_link'] ) || ( isset( $bdp_settings['skype_link'] ) && 1 == $bdp_settings['skype_link'] ) || ( isset( $bdp_settings['telegram_link'] ) && 1 == $bdp_settings['telegram_link'] ) || ( isset( $bdp_settings['reddit_link'] ) && 1 == $bdp_settings['reddit_link'] ) || ( isset( $bdp_settings['digg_link'] ) && 1 == $bdp_settings['digg_link'] ) || ( isset( $bdp_settings['tumblr_link'] ) && 1 == $bdp_settings['tumblr_link'] ) || ( isset( $bdp_settings['wordpress_link'] ) && 1 == $bdp_settings['wordpress_link'] ) || ( 1 == $bdp_settings['whatsapp_link'] ) ) ) ) {
						?>
						<div class="entry-meta <?php echo esc_attr( $center ); ?>">
							<div class="metabox-upper">
								<?php
								if ( isset( $bdp_settings['display_author'] ) && 1 == $bdp_settings['display_author'] ) {
									$author_link = ( isset( $bdp_settings['disable_link_author'] ) && 1 == $bdp_settings['disable_link_author'] ) ? false : true;
									?>
									<span>
										<span class="post-author <?php echo ( $author_link ) ? 'bdp-has-links' : 'bdp-no-links'; ?>">
											<?php
											echo '<span class="link-lable">' . esc_html__( 'Posted By ', 'blog-designer-pro' ) . '</span>';
											echo wp_kses( Bdp_Author::get_post_auhtors( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() );
											?>
										</span>
									</span>
									<?php
								}
								if ( isset( $bdp_settings['display_date'] ) && 1 == $bdp_settings['display_date'] ) {
									?>
									<span class="link-lable">
										<?php
										$date_format = ( isset( $bdp_settings['post_date_format'] ) && 'default' !== $bdp_settings['post_date_format'] ) ? $bdp_settings['post_date_format'] : get_option( 'date_format' );
										$bdp_date    = ( isset( $bdp_settings['dsiplay_date_from'] ) && 'modify' === $bdp_settings['dsiplay_date_from'] ) ? apply_filters( 'bdp_date_format', get_post_modified_time( $date_format, $post->ID ), $post->ID ) : apply_filters( 'bdp_date_format', get_the_time( $date_format, $post->ID ), $post->ID );
										$ar_year     = get_the_time( 'Y' );
										$ar_month    = get_the_time( 'm' );
										$ar_day      = get_the_time( 'd' );
										$date_link   = ( isset( $bdp_settings['disable_link_date'] ) && 1 == $bdp_settings['disable_link_date'] ) ? false : true;
										if ( 1 == $bdp_settings['display_date'] && 1 == $bdp_settings['display_author'] ) {
											esc_html_e( 'On', 'blog-designer-pro' );
											echo ' ';
										} elseif ( 1 == $bdp_settings['display_date'] && 0 == $bdp_settings['display_author'] ) {
											esc_html_e( 'Posted On', 'blog-designer-pro' );
											echo ' ';
										}
										?>

										<time datetime="" class="datetime">
											<?php
											echo ( 'product' !== $post_type && $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : '';
											echo esc_html( $bdp_date );
											echo ( 'product' !== $post_type && $date_link ) ? '</a>' : '';
											?>
										</time>
									</span>
									<?php
								}
								if ( isset( $bdp_settings['display_comment'] ) && 1 == $bdp_settings['display_comment'] ) {
									?>
									<span class="metacomments">
										<i class="fas fa-comments"></i>
										<?php
										if ( isset( $bdp_settings['disable_link_comment'] ) && 1 == $bdp_settings['disable_link_comment'] ) {
											comments_number( '0', '1', '%' );
										} else {
											comments_popup_link( '0', '1', '%' );
										}
										?>
									</span>
									<?php
								}
								if ( isset( $bdp_settings['display_postlike'] ) && 1 == $bdp_settings['display_postlike'] ) {
									echo do_shortcode( '[likebtn_shortcode]' );
								}
								?>
							</div>
							<?php
							if ( is_single() ) {
								do_action( 'bdp_social_share_text', $bdp_settings );
							}
							Bdp_Utility::get_social_icons( $bdp_settings );
							?>
						</div>
						<?php
					}
					if ( 'product' === $post_type ) {
						do_action( 'bdp_woocommerce_meta_data', $bdp_settings, $post->ID );
					}
					if ( 'download' === $post_type && isset( $bdp_settings['display_download_price'] ) && 1 == $bdp_settings['display_download_price'] ) {
						do_action( 'bdp_edd_single_download_price', $post->ID );
					}
					?>
					<div class="post_content entry-content">
						<?php
						do_action( 'bdp_single_post_content_data', $bdp_settings, $post->ID );
						if ( 'download' === $post_type && isset( $bdp_settings['display_edd_addtocart_button'] ) && 1 == $bdp_settings['display_edd_addtocart_button'] ) {
							do_action( 'bdp_edd_single_download_cart_button', $post->ID );
						}
						?>
					</div>
					<?php
					if ( Bdp_Template_Acf::is_acf_plugin() ) {
						if ( isset( $bdp_settings['display_acf_field'] ) && 1 == $bdp_settings['display_acf_field'] ) {
							echo '<div class="bdp_acf_field">';
							do_action( 'bdp_after_single_post_content_data', $bdp_settings, $post->ID );
							echo '</div>';
						}
					}
					?>
					<?php
					if ( in_array( $post_type, $bdp_all_post_type ) ) {
						$taxonomy_names = get_object_taxonomies( $post_type, 'objects' );
						$taxonomy_names = apply_filters( 'bdp_hide_taxonomies', $taxonomy_names );
						foreach ( $taxonomy_names as $taxonomy_single ) {
							$taxonomy = $taxonomy_single->name;
							$sep      = 1;
							if ( isset( $bdp_settings[ 'display_taxonomy_' . $taxonomy ] ) && 1 == $bdp_settings[ 'display_taxonomy_' . $taxonomy ] ) {
								$term_list            = wp_get_post_terms( get_the_ID(), $taxonomy, array( 'fields' => 'all' ) );
								$taxonomy_link        = ( isset( $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy ] ) && 1 == $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy ] ) ? false : true;
								$bdp_exclude_taxonomy = array( 'product_cat', 'download_category' );
								if ( isset( $taxonomy ) && ! in_array( $taxonomy, $bdp_exclude_taxonomy ) ) {
									if ( isset( $term_list ) && ! empty( $term_list ) ) {
										?>
										<div class="tags <?php echo ( $taxonomy_link ) ? 'bdp-no-links' : 'bdp-has-links'; ?>">
											<span class="link-lable"><i class="fas fa-tags"></i>&nbsp;<?php echo esc_html( $taxonomy_single->label ); ?>&nbsp;:&nbsp;</span>
											<?php
											foreach ( $term_list as $term_nm ) {
												if ( 1 != $sep ) {
													?>
													<span class="seperater"><?php echo ', '; ?></span>
													<?php
												}
												$term_link = get_term_link( $term_nm );
												echo ( $taxonomy_link ) ? '<a href="' . esc_url( $term_link ) . '">' : '';
												echo esc_html( $term_nm->name );
												echo ( $taxonomy_link ) ? '</a>' : '';
												$sep++;
											}
											?>
										</div>
										<?php
									}
								}
							}
						}
					} else {
						if ( isset( $bdp_settings['display_tag'] ) && 1 == $bdp_settings['display_tag'] ) {
							?>
							<div class="metadatabox">
							<?php
							$tags_list = get_the_tag_list( '', ', ' );
							$tag_link  = ( isset( $bdp_settings['disable_link_tag'] ) && 1 == $bdp_settings['disable_link_tag'] ) ? true : false;
							if ( $tag_link ) {
								$tags_list = wp_strip_all_tags( $tags_list );
							}
							if ( $tags_list ) :
								?>
									<div class="tags <?php echo ( $tag_link ) ? 'bdp-no-links' : 'bdp-has-links'; ?>">
										<i class="fas fa-tags"></i>
									<?php echo wp_kses( $tags_list, Bdp_Admin_Functions::args_kses() ); ?>
									</div>
									<?php
								endif;
							?>
							</div>
							<?php
						}
					}

					?>
				</div>
			</div>
			<?php do_action( 'bdp_after_single_post_content' ); ?>
		</div>
		<?php
		add_action( 'bdp_author_detail', array( 'Bdp_Author', 'display_author_image' ), 5, 2 );
		add_action( 'bdp_author_detail', array( 'Bdp_Author', 'display_author_content_cover_start' ), 10, 2 );
		add_action( 'bdp_author_detail', array( 'Bdp_Author', 'display_author_name' ), 15, 4 );
		add_action( 'bdp_author_detail', array( 'Bdp_Author', 'display_author_biography' ), 20, 2 );
		add_action( 'bdp_author_detail', array( 'Bdp_Author', 'display_author_social_links' ), 25, 4 );
		add_action( 'bdp_author_detail', array( 'Bdp_Author', 'display_author_content_cover_end' ), 30, 2 );
		add_action( 'bdp_related_post_detail', array( 'Bdp_Posts', 'related_post_title' ), 5, 4 );
		add_action( 'bdp_related_post_detail', array( 'Bdp_Posts', 'related_post_item' ), 10, 9 );
	}
}
