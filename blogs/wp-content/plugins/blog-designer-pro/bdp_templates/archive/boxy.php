<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/boxy.php.
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

add_action( 'bd_archive_design_format_function', 'bdp_archive_boxy_template', 10, 1 );
if ( ! function_exists( 'bdp_archive_boxy_template' ) ) {

	/**
	 * Add html for boxy template
	 *
	 * @param array $bdp_settings settings.
	 * @global object $post
	 * @return void
	 */
	function bdp_archive_boxy_template( $bdp_settings ) {
		if ( isset( $bdp_settings['enable_lazy_load'] ) && 1 == $bdp_settings['enable_lazy_load'] ) {
			add_filter( 'wp_get_attachment_image_attributes', 'lazyload_images_modify_post_thumbnail_attr', 11, 5 );

		}
		global $post;
		$post_type         = get_post_type( $post->ID );
		$col_class         = Bdp_Template::column_class( $bdp_settings );
		$bdp_all_post_type = array( 'product', 'download' );

		$class_name = 'blog_template bdp_blog_template boxy blog_masonry_item ';
		if ( '' != $col_class ) {
			$class_name .= ' ' . $col_class;
		}
		$image_hover_effect = '';
		if ( isset( $bdp_settings['bdp_image_hover_effect'] ) && 1 == $bdp_settings['bdp_image_hover_effect'] ) {
			$image_hover_effect = ( isset( $bdp_settings['bdp_image_hover_effect_type'] ) && '' != $bdp_settings['bdp_image_hover_effect_type'] ) ? $bdp_settings['bdp_image_hover_effect_type'] : '';
		}
		?>
		<div class="<?php echo esc_html( $class_name ); ?>">
			<?php do_action( 'bdp_before_archive_post_content' ); ?>
			<div class="post_hentry">
				<?php
				$label_featured_post = ( isset( $bdp_settings['label_featured_post'] ) && '' != $bdp_settings['label_featured_post'] ) ? $bdp_settings['label_featured_post'] : '';
				if ( '' != $label_featured_post && is_sticky() ) {
					?>
					<div class="label_featured_post"><span><?php echo esc_html( $label_featured_post ); ?></span></div> 
					<?php
				}
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
							<div class="post-category">
								<span class="category-link<?php echo ( $categories_link ) ? ' categories_link' : ''; ?>">
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
							</span></div>
						<?php
					}
				} else {
					if ( isset( $bdp_settings['display_category'] ) && 1 == $bdp_settings['display_category'] ) {
						$categories_link = ( isset( $bdp_settings['disable_link_category'] ) && 1 == $bdp_settings['disable_link_category'] ) ? true : false;
						?>
						<div class="post-category">
							<span class="category-link<?php echo ( $categories_link ) ? ' categories_link' : ''; ?>">
								<?php
								$categories_list = get_the_category_list( ', ' );
								if ( $categories_link ) {
									$categories_list = wp_strip_all_tags( $categories_list );
								}
								if ( $categories_list ) :
									echo ' '. wp_kses( $categories_list, Bdp_Admin_Functions::args_kses() );
									$show_sep = true;
								endif;
								?>
							</span>
						</div>
						<?php
					}
				}

				?>
				<div class="blog_header">
					<h2>
						<?php
						$bdp_post_title_link = isset( $bdp_settings['bdp_post_title_link'] ) ? $bdp_settings['bdp_post_title_link'] : 1;
						if ( 1 == $bdp_post_title_link ) {
							?>
							<a href="<?php the_permalink(); ?>">
							<?php } ?>
							<?php
							echo wp_kses( get_the_title(), Bdp_Admin_Functions::args_kses() );
							if ( 1 == $bdp_post_title_link ) {
								?>
							</a>
						<?php } ?>
					</h2>
				</div>
				<div class="post-media">
					<?php
					if ( Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ) && 1 == $bdp_settings['rss_use_excerpt'] ) {
						?>
						<div class="bdp-post-image post-video">
							<?php
							if ( 'quote' === get_post_format() ) {
								if ( has_post_thumbnail() ) {
									$post_thumbnail = 'full';
									$thumbnail      = Bdp_Posts::get_the_thumbnail( $bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
									echo wp_kses( apply_filters( 'bdp_post_thumbnail_filter', $thumbnail, $post->ID ), Bdp_Admin_Functions::args_kses() );
									echo '<div class="upper_image_wrapper">';
									echo wp_kses( Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() );
									echo '</div>';
								}
							} elseif ( 'link' === get_post_format() ) {
								if ( has_post_thumbnail() ) {
									$post_thumbnail = 'full';
									$thumbnail      = Bdp_Posts::get_the_thumbnail( $bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
									echo wp_kses( apply_filters( 'bdp_post_thumbnail_filter', $thumbnail, $post->ID ), Bdp_Admin_Functions::args_kses() );
									echo '<div class="upper_image_wrapper bdp_link_post_format">';
									echo wp_kses( Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() );
									echo '</div>';
								}
							} else {
								echo wp_kses( Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() );
							}
							$display_date   = $bdp_settings['display_date'];
							$display_author = $bdp_settings['display_author'];
							if ( 1 == $display_author || 1 == $display_date || 1 == $bdp_settings['display_postlike'] || 1 == $bdp_settings['display_comment_count'] ) {
								$no_image = ( ! has_post_thumbnail() && '' == $bdp_settings['bdp_default_image_id'] ) ? 'no_image_post' : '';
								?>
								<div class="post-metadata <?php echo esc_attr( $no_image ); ?>">
									<?php
									if ( 1 == $display_author ) {
										$author_link = ( isset( $bdp_settings['disable_link_author'] ) && 1 == $bdp_settings['disable_link_author'] ) ? false : true;
										?>
										<span class="author <?php echo ( $author_link ) ? 'bdp_has_link' : 'bdp-no-kink'; ?>">
											<span class="link-lable"> <?php esc_html_e( 'Written by ', 'blog-designer-pro' ); ?> </span>
											<?php echo wp_kses( Bdp_Author::get_post_auhtors( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() ); ?>
										</span>
										<?php
									}
									if ( 1 == $display_date ) {
										$date_link = ( isset( $bdp_settings['disable_link_date'] ) && 1 == $bdp_settings['disable_link_date'] ) ? false : true;
										?>
										<span class="post-date">&nbsp;
											<?php
											esc_html_e( 'on', 'blog-designer-pro' );
											$date_format = ( isset( $bdp_settings['post_date_format'] ) && 'default' !== $bdp_settings['post_date_format'] ) ? $bdp_settings['post_date_format'] : get_option( 'date_format' );
											$ar_year     = get_the_time( 'Y' );
											$ar_month    = get_the_time( 'm' );
											$ar_day      = get_the_time( 'd' );

											echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : ''
											?>
											<span class="month"><?php echo esc_html( isset( $bdp_settings['dsiplay_date_from'] ) && 'modify' === $bdp_settings['dsiplay_date_from'] ) ? esc_html( get_post_modified_time( 'M d' ) ) : esc_html( get_the_time( 'M d' ) ); ?></span>
											<span class="year"><?php echo esc_html( isset( $bdp_settings['dsiplay_date_from'] ) && 'modify' === $bdp_settings['dsiplay_date_from'] ) ? esc_html( get_post_modified_time( 'Y' ) ) : esc_html( get_the_time( 'Y' ) ); ?></span> <?php echo '</a>'; ?>
										</span>
										<?php
									}
									if ( 1 == $bdp_settings['display_comment_count'] ) {
										?>
										<span class="post-comment">
											<?php
											if ( isset( $bdp_settings['disable_link_comment'] ) && 1 == $bdp_settings['disable_link_comment'] ) {
												comments_number( esc_html__( 'No Comments', 'blog-designer-pro' ), '1 ' . esc_html__( 'comment', 'blog-designer-pro' ), '% ' . esc_html__( 'comments', 'blog-designer-pro' ) );
											} else {
												comments_popup_link( esc_html__( 'Leave a Comment', 'blog-designer-pro' ), esc_html__( '1 comment', 'blog-designer-pro' ), '% ' . esc_html__( 'comments', 'blog-designer-pro' ), 'comments-link', esc_html__( 'Comments are off', 'blog-designer-pro' ) );
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
							<?php } ?>
						</div>
						<?php
					} else {
						?>
						<div class="bdp-post-image">
							<?php
							$no_image       = '';
							$post_thumbnail = 'full';
							$thumbnail      = Bdp_Posts::get_the_thumbnail( $bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
							if ( ! empty( $thumbnail ) ) {
								echo '<figure class="' . esc_attr( $image_hover_effect ) . '">';
								?>
								<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
									<?php echo wp_kses( apply_filters( 'bdp_post_thumbnail_filter', $thumbnail, $post->ID ), Bdp_Admin_Functions::args_kses() ); ?>
								</a>
								<?php
								if ( isset( $bdp_settings['pinterest_image_share'] ) && 1 == $bdp_settings['pinterest_image_share'] && isset( $bdp_settings['social_share'] ) && 1 == $bdp_settings['social_share'] ) {
									?>
									<div class="bdp-pinterest-share-image">
										<?php
										$img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
										?>
										<a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . esc_url( get_permalink( $post->ID ) ) . '&media=' . esc_attr( $img_url ); ?>"></a>
									</div>
									<?php
								}
								if ( 'product' === $post_type && isset( $bdp_settings['display_sale_tag'] ) && 1 == $bdp_settings['display_sale_tag'] ) {
									$bdp_sale_tagtext_alignment = ( isset( $bdp_settings['bdp_sale_tagtext_alignment'] ) && '' != $bdp_settings['bdp_sale_tagtext_alignment'] ) ? $bdp_settings['bdp_sale_tagtext_alignment'] : 'left-top';
									echo '<div class="bdp_woocommerce_sale_wrap ' . esc_attr( $bdp_sale_tagtext_alignment ) . '">';
									do_action( 'bdp_woocommerce_sale_tag' );
									echo '</div>';
								}
								echo '</figure>';
							} else {
								$no_image = 'no_image_post';
							}
							$display_date   = $bdp_settings['display_date'];
							$display_author = $bdp_settings['display_author'];
							if ( 1 == $display_author || 1 == $display_date || 1 == $bdp_settings['display_comment_count'] || 1 == $bdp_settings['display_postlike'] ) {
								?>
								<div class="post-metadata <?php echo esc_attr( $no_image ); ?>">
									<?php
									if ( 1 == $display_author ) {
										$author_link = ( isset( $bdp_settings['disable_link_author'] ) && 1 == $bdp_settings['disable_link_author'] ) ? false : true;
										?>
										<span class="author">
											<?php
											esc_html_e( 'Written by ', 'blog-designer-pro' );
											echo wp_kses( Bdp_Author::get_post_auhtors( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() );
											?>
										</span>
										<?php
									}
									if ( 1 == $display_date ) {
										$date_link = ( isset( $bdp_settings['disable_link_date'] ) && 1 == $bdp_settings['disable_link_date'] ) ? false : true;
										?>
										<span class="post-date">&nbsp;
											<?php
											esc_html_e( 'on', 'blog-designer-pro' );
											$date_format = ( isset( $bdp_settings['post_date_format'] ) && 'default' !== $bdp_settings['post_date_format'] ) ? $bdp_settings['post_date_format'] : get_option( 'date_format' );
											$ar_year     = get_the_time( 'Y' );
											$ar_month    = get_the_time( 'm' );
											$ar_day      = get_the_time( 'd' );

											echo ( $date_link ) ? '<a href="' . esc_url( get_day_link( $ar_year, $ar_month, $ar_day ) ) . '">' : ''
											?>
											<span class="month"><?php echo esc_html( isset( $bdp_settings['dsiplay_date_from'] ) && 'modify' === $bdp_settings['dsiplay_date_from'] ) ? esc_html( get_post_modified_time( 'M d' ) ) : esc_html( get_the_time( 'M d' ) ); ?></span>
											<span class="year"><?php echo esc_html( isset( $bdp_settings['dsiplay_date_from'] ) && 'modify' === $bdp_settings['dsiplay_date_from'] ) ? esc_html( get_post_modified_time( 'Y' ) ) : esc_html( get_the_time( 'Y' ) ); ?></span> <?php echo '</a>'; ?>
										</span>
										<?php
									}
									if ( 1 == $bdp_settings['display_comment_count'] ) {
										?>
										<span class="post-comment">
											<?php
											if ( isset( $bdp_settings['disable_link_comment'] ) && 1 == $bdp_settings['disable_link_comment'] ) {
												comments_number( esc_html__( 'No Comments', 'blog-designer-pro' ), '1 ' . esc_html__( 'comment', 'blog-designer-pro' ), '% ' . esc_html__( 'comments', 'blog-designer-pro' ) );
											} else {
												comments_popup_link( esc_html__( 'Leave a Comment', 'blog-designer-pro' ), esc_html__( '1 comment', 'blog-designer-pro' ), '% ' . esc_html__( 'comments', 'blog-designer-pro' ), 'comments-link', esc_html__( 'Comments are off', 'blog-designer-pro' ) );
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
							<?php } ?>
						</div>
					<?php } ?>
				</div>
				<?php
				if ( 'product' === $post_type ) {
					do_action( 'bdp_woocommerce_product_details_function', $bdp_settings, $post->ID );
				}
				if ( 'download' === $post_type ) {
					do_action( 'bdp_easy_digital_download_product_details_function', $bdp_settings, $post->ID );
				}
				?>
				<div class="post_summary_outer">
					<div class="post_content">
						<div class="post_content-inner">
							<?php
							echo wp_kses( Bdp_Posts::get_content( $post->ID, $bdp_settings, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'] ), Bdp_Admin_Functions::args_kses() );
							$read_more_link = isset( $bdp_settings['read_more_link'] ) ? $bdp_settings['read_more_link'] : 1;
							if ( 1 == $read_more_link && 1 == $bdp_settings['rss_use_excerpt'] ) {
								$read_more_on   = isset( $bdp_settings['read_more_on'] ) ? $bdp_settings['read_more_on'] : 2;
								$readmoretxt    = '' != $bdp_settings['txtReadmoretext'] ? $bdp_settings['txtReadmoretext'] : esc_html__( 'Read More', 'blog-designer-pro' );
								$post_link      = get_permalink( $post->ID );
								$link_behaviour = isset( $bdp_settings['link_behaviour'] ) ? $bdp_settings['link_behaviour'] : 'self';
								if ( 'new' == $link_behaviour ) {
									$link_behaviour = '_blank';
								} elseif ( 'self' == $link_behaviour ) {
									$link_behaviour = '_SELF';
								}
								if ( isset( $bdp_settings['post_link_type'] ) && 1 == $bdp_settings['post_link_type'] ) {
									$post_link = ( isset( $bdp_settings['custom_link_url'] ) && '' != $bdp_settings['custom_link_url'] ) ? $bdp_settings['custom_link_url'] : get_permalink( $post->ID );
								}
								if ( 1 == $read_more_on ) {
									echo '<a class="more-tag" href="' . esc_url( $post_link ) . '" target="' . esc_html( $link_behaviour ) . '">' . esc_html( $readmoretxt ) . ' </a>';
								} else {
									?>
									<div class="read-more">
										<?php echo '<a class="more-tag" href="' . esc_url( $post_link ) . '" target="' . esc_html( $link_behaviour ) . '"><i class="fas fa-link"></i>' . esc_html( $readmoretxt ) . ' </a>'; ?>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="blog_footer">
					<?php
					if ( in_array( $post_type, $bdp_all_post_type ) ) {
						$taxonomy_names = get_object_taxonomies( $post_type, 'objects' );
						$taxonomy_names = apply_filters( 'bdp_hide_taxonomies', $taxonomy_names );
						foreach ( $taxonomy_names as $taxonomy ) {
							$sep = 1;
							if ( 1 == $bdp_settings[ 'display_taxonomy_' . $taxonomy->name ] ) {
								$term_list            = wp_get_post_terms( get_the_ID(), $taxonomy->name, array( 'fields' => 'all' ) );
								$taxonomy_link        = ( isset( $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy->name ] ) && 1 == $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy->name ] ) ? false : true;
								$bdp_exclude_taxonomy = array( 'product_cat', 'download_category' );
								if ( isset( $taxonomy->name ) && ! in_array( $taxonomy->name, $bdp_exclude_taxonomy ) ) {
									if ( isset( $term_list ) && ! empty( $term_list ) ) {
										?>
										<div class="post-category custom-post-category">
											<span class="link-lable"><i class="fas fa-bookmark"></i> <?php echo esc_html( $taxonomy->label ); ?>:&nbsp;</span>
											<span class="category-link<?php echo ( $taxonomy_link ) ? '' : ' categories_link'; ?>">
												<?php
												foreach ( $term_list as $term_nm ) {
													$term_link = get_term_link( $term_nm );
													if ( 1 != $sep ) {
														?>
														<span class="seperater"><?php echo ', '; ?></span>
														<?php
													}
													echo ( $taxonomy_link ) ? '<a href="' . esc_url( $term_link ) . '">' : '';
													echo esc_html( $term_nm->name );
													echo ( $taxonomy_link ) ? '</a>' : '';
													$sep++;
												}
												?>
											</span>
										</div>
										<?php
									}
								}
							}
						}
					} else {
						if ( isset( $bdp_settings['display_tag'] ) && 1 == $bdp_settings['display_tag'] ) {
							?>
							<?php
							$tags_list = get_the_tag_list( '', ', ' );
							$tag_link  = ( isset( $bdp_settings['disable_link_tag'] ) && 1 == $bdp_settings['disable_link_tag'] ) ? true : false;
							if ( $tag_link ) {
								$tags_list = wp_strip_all_tags( $tags_list );
							}
							if ( $tags_list ) :
								?>
								<div class="footer_meta">
									<div class="tags<?php echo ( $tag_link ) ? ' tag_link' : ''; ?>">
										<span class="link-lable"> <i class="fas fa-bookmark"></i> <?php esc_html_e( 'Tags', 'blog-designer-pro' ); ?>:&nbsp; </span>
										<?php
										echo wp_kses( $tags_list, Bdp_Admin_Functions::args_kses() );
										$show_sep = true;
										?>
									</div>
								</div>
								<?php
							endif;
							?>
							<?php
						}
					}
					if ( Bdp_Template_Acf::is_acf_plugin() ) {
						if ( isset( $bdp_settings['display_acf_field'] ) && 1 == $bdp_settings['display_acf_field'] ) {
							echo '<div class="bdp_acf_field">';
							do_action( 'bdp_after_blog_post_content_data', $bdp_settings, $post->ID );
							echo '</div>';
						}
					}
					Bdp_Utility::get_social_icons( $bdp_settings );
					?>
				</div>
			</div>
			<?php do_action( 'bdp_after_archive_post_content' ); ?>
		</div>
		<?php
		do_action( 'bdp_archive_separator_after_post' );
	}
}