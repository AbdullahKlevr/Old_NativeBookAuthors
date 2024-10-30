<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/story.php.
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
if ( isset( $bdp_settings['enable_lazy_load'] ) && 1 == $bdp_settings['enable_lazy_load'] ) {
	add_filter( 'wp_get_attachment_image_attributes', 'lazyload_images_modify_post_thumbnail_attr', 11, 5 );

}

global $post;
$format          = get_post_format( $post->ID );
$line_col_bottom = 'line-col-bottom-secound';
$date_class      = 'date-icon-rights';
$entity_content  = 'entity-content-right';
$curv_line       = 'line-col-left';
$year_class      = 'right-year';
$eding_class     = 'right_ending';
if ( 0 != $alter_class % 2 ) {
	$line_col_bottom = 'line-col-top';
	$date_class      = 'date-icon-left';
	$entity_content  = 'entity-content-left';
	$curv_line       = 'line-col-right';
	$year_class      = 'left-year';
	$eding_class     = 'left_ending';
}

$image_hover_effect = '';
if ( isset( $bdp_settings['bdp_image_hover_effect'] ) && 1 == $bdp_settings['bdp_image_hover_effect'] ) {
	$image_hover_effect = ( isset( $bdp_settings['bdp_image_hover_effect_type'] ) && '' != $bdp_settings['bdp_image_hover_effect_type'] ) ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
$display_filter_by = ( isset( $bdp_settings['display_filter_by'] ) && ! empty( $bdp_settings['display_filter_by'] ) ) ? $bdp_settings['display_filter_by'] : '';
$category          = '';
if ( ! empty( $display_filter_by ) ) {
	$category_detail = wp_get_post_terms( $post->ID, $display_filter_by );
	if ( ! empty( $category_detail ) ) {
		foreach ( $category_detail as $cd ) {
			$category .= $cd->slug . ' ';
		}
	}
}
?>
<div class="blog_template bdp_blog_template story blog-wrap yearly-info bdp_blog_single_post_wrapp <?php echo esc_attr( $category ); ?>">
	<?php
	do_action( 'bdp_before_post_content' );
	$this_year = get_the_date( 'Y' );
	if ( 0 == $prev_year || $prev_year == $this_year ) {
		$prev_year = $this_year;
	} else {
		$prev_year = '';
	}
	?>
	<div class="<?php echo esc_attr( $line_col_bottom ); ?>">
		<?php
		$display_story_year = isset( $bdp_settings['display_story_year'] ) ? $bdp_settings['display_story_year'] : 1;
		if ( 1 == $display_story_year ) {
			if ( 0 != $prev_year ) {
				?>
				<span class="year-number <?php echo esc_attr( $year_class ); ?>">
					<?php echo esc_html( $prev_year ); ?>
				</span>
				<?php
			}
		}
		?>
	</div>
	<?php
	global $wp_query;
	$story_ending_text = isset( $bdp_settings['story_ending_text'] ) ? $bdp_settings['story_ending_text'] : '';
	$story_ending_link = isset( $bdp_settings['story_ending_link'] ) ? $bdp_settings['story_ending_link'] : '';
	if ( $wp_query->current_post + 1 == $wp_query->post_count && '' != $story_ending_text && 'no_pagination' === $bdp_settings['pagination_type'] ) {
		?>
		<span class="startup ending <?php echo esc_attr( $eding_class ); ?>">
			<span>
				<?php if ( '' != $story_ending_link ) { ?>
					<a href="<?php echo esc_url( $story_ending_link ); ?>"><?php echo esc_html( $story_ending_text ); ?></a>
					<?php
				} else {
					echo esc_attr( $story_ending_text );
				}
				?>
			</span>
		</span>
	<?php } ?>
	<?php
	$story_startup_text = isset( $bdp_settings['story_startup_text'] ) ? $bdp_settings['story_startup_text'] : '';
	if ( 1 == $alter_class && '' != $story_startup_text ) {
		?>
		<span class="startup"><span><?php echo esc_attr( $story_startup_text ); ?></span></span>
		<?php
	}
	?>
	<div class="post_hentry">
		<?php
		$display_date = isset( $bdp_settings['display_date'] ) ? $bdp_settings['display_date'] : 1;
		$ar_year      = get_the_time( 'Y' );
		$ar_month     = get_the_time( 'm' );
		$ar_day       = get_the_time( 'd' );

		if ( 1 == $display_date ) {
			?>
			<div class="date-icon date-icon-arrow-bottom <?php echo esc_attr( $date_class ); ?>">
				<?php echo get_the_date( 'n/j' ); ?>
				<div class="dote dote-bottom">
					<span></span><span></span><span></span>
				</div>
			</div>
		<?php } ?>
		<div class="entity-content animateblock 
		<?php
		echo esc_attr( $entity_content );
		echo ' ';
		echo ( isset( $bdp_settings['post_loop_alignment'] ) && '' != $bdp_settings['post_loop_alignment'] ) ? esc_attr( $bdp_settings['post_loop_alignment'] ) : 'default';
		?>
		">
			<?php
			$label_featured_post = ( isset( $bdp_settings['label_featured_post'] ) && '' != $bdp_settings['label_featured_post'] ) ? $bdp_settings['label_featured_post'] : '';
			if ( '' != $label_featured_post && is_sticky() ) {
				?>
				<div class="label_featured_post"><?php echo esc_attr( $label_featured_post ); ?></div> 
				<?php
			}
			?>
			<div class="blog_post_wrap
			<?php
			echo ( ! Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ) && ! has_post_thumbnail() && '' === $bdp_settings['bdp_default_image_id'] ) ? 'no-post-media' : '';
			echo ' ';
			echo ( isset( $bdp_settings['post_loop_alignment'] ) && '' != $bdp_settings['post_loop_alignment'] ) ? esc_attr( $bdp_settings['post_loop_alignment'] ) : 'default';
			?>
			">
				<h2 class="blog_header">
					<?php
					$bdp_post_title_link = isset( $bdp_settings['bdp_post_title_link'] ) ? $bdp_settings['bdp_post_title_link'] : 1;
					if ( 1 == $bdp_post_title_link ) {
						?>
						<a href="<?php esc_url( the_permalink() ); ?>">
						<?php } ?>
						<?php
						echo esc_html( get_the_title() );
						if ( 1 == $bdp_post_title_link ) {
							?>
						</a>
					<?php } ?>
				</h2>
				<?php
				if ( Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ) || has_post_thumbnail() || ( isset( $bdp_settings['bdp_default_image_id'] ) && '' != $bdp_settings['bdp_default_image_id'] ) ) {
					?>
					<div class="post-media 
					<?php
					echo esc_attr( get_post_format() );
					echo ' ';
					echo ( isset( $bdp_settings['thumbnail_skin'] ) && 1 == $bdp_settings['thumbnail_skin'] ) ? 'circle' : 'square';
					?>
					">
						<?php
						if ( Bdp_Utility::get_first_embed_media( $post->ID, $bdp_settings ) ) {
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
								?>
								</div>
								<?php
						} else {
							$post_thumbnail      = 'thumbnail';
							$thumbnail           = Bdp_Posts::get_the_thumbnail( $bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID );
							$bdp_post_image_link = ( isset( $bdp_settings['bdp_post_image_link'] ) && 0 == $bdp_settings['bdp_post_image_link'] ) ? false : true;
							if ( ! empty( $thumbnail ) ) {
								echo '<figure class="' . esc_attr( $image_hover_effect ) . '">';
								echo ( $bdp_post_image_link ) ? '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="deport-img-link">' : '';
								echo wp_kses( apply_filters( 'bdp_post_thumbnail_filter', $thumbnail, $post->ID ), Bdp_Admin_Functions::args_kses() );
								echo ( $bdp_post_image_link ) ? '</a>' : '';
								if ( class_exists( 'woocommerce' ) && 'product' === $bdp_settings['custom_post_type'] ) {
									if ( isset( $bdp_settings['display_sale_tag'] ) && 1 == $bdp_settings['display_sale_tag'] ) {
										$bdp_sale_tagtext_alignment = ( isset( $bdp_settings['bdp_sale_tagtext_alignment'] ) && '' != $bdp_settings['bdp_sale_tagtext_alignment'] ) ? $bdp_settings['bdp_sale_tagtext_alignment'] : 'left-top';
										echo '<div class="bdp_woocommerce_sale_wrap ' . esc_attr( $bdp_sale_tagtext_alignment ) . '">';
										do_action( 'bdp_woocommerce_sale_tag' );
										echo '</div>';
									}
								}
								echo '</figure>';
							}
						}
						?>
					</div>
					<?php
				}
				if ( isset( $bdp_settings['custom_post_type'] ) && 'product' === $bdp_settings['custom_post_type'] ) {
					do_action( 'bdp_woocommerce_product_details_function', $bdp_settings, $post->ID );
				}
				if ( isset( $bdp_settings['custom_post_type'] ) && 'download' === $bdp_settings['custom_post_type'] ) {
					do_action( 'bdp_easy_digital_download_product_details_function', $bdp_settings, $post->ID );
				}
				?>
				<div class="post_content">
					<?php
					echo wp_kses( Bdp_Posts::get_content( $post->ID, $bdp_settings, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'] ), Bdp_Admin_Functions::args_kses() );
					$read_more_on   = isset( $bdp_settings['read_more_on'] ) ? $bdp_settings['read_more_on'] : 2;
					$read_more_link = isset( $bdp_settings['read_more_link'] ) ? $bdp_settings['read_more_link'] : 1;
					$link_behaviour = isset( $bdp_settings['link_behaviour'] ) ? $bdp_settings['link_behaviour'] : 'self';
					if ( 'new' == $link_behaviour ) {
						$link_behaviour = '_blank';
					} elseif ( 'self' == $link_behaviour ) {
						$link_behaviour = '_SELF';
					}
					if ( 1 == $bdp_settings['rss_use_excerpt'] && 1 == $read_more_link ) {
						$readmoretxt = '' != $bdp_settings['txtReadmoretext'] ? $bdp_settings['txtReadmoretext'] : esc_html__( 'Read More', 'blog-designer-pro' );
						$post_link   = get_permalink( $post->ID );
						if ( isset( $bdp_settings['post_link_type'] ) && 1 == $bdp_settings['post_link_type'] ) {
							$post_link = ( isset( $bdp_settings['custom_link_url'] ) && '' != $bdp_settings['custom_link_url'] ) ? $bdp_settings['custom_link_url'] : get_permalink( $post->ID );
						}
						if ( 2 == $read_more_on ) {
							echo '<div class="read-more">';
						}
						echo '<a class="more-tag" href="' . esc_url( $post_link ) . '" target="' . esc_html( $link_behaviour ) . '">' . esc_html( $readmoretxt ) . ' </a>';
						if ( 2 == $read_more_on ) {
							echo '</div>';
						}
					}
					?>
				</div>
				<?php
				$display_author        = $bdp_settings['display_author'];
				$display_comment_count = $bdp_settings['display_comment_count'];
				if ( 1 == $display_author || 1 == $display_comment_count || ( isset( $bdp_settings['display_postlike'] ) && 1 == $bdp_settings['display_postlike'] ) ) {
					?>
					<div class="post-metadata">
						<?php
						if ( 1 == $display_author ) {
							$author_link = ( isset( $bdp_settings['disable_link_author'] ) && 1 == $bdp_settings['disable_link_author'] ) ? false : true;
							?>
							<span class="author">
								<span class="link-lable"><?php esc_html_e( 'Written by', 'blog-designer-pro' ); ?>&nbsp;</span>
								<?php
								echo ( ! $author_link ) ? '<span class="author-inner">' : '';
								echo wp_kses( Bdp_Author::get_post_auhtors( $post->ID, $bdp_settings ), Bdp_Admin_Functions::args_kses() );
								echo ( ! $author_link ) ? '</span>' : '';
								?>
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
					<?php
				}
				?>

				<div class="blog_footer">
					<div class="footer_meta">
						<?php
						$custom_post_type = $bdp_settings['custom_post_type'];
						if ( 'post' === $custom_post_type ) {
							if ( isset( $bdp_settings['display_category'] ) && 1 == $bdp_settings['display_category'] ) {
								$categories_list = get_the_category_list( ', ' );
								$categories_link = ( isset( $bdp_settings['disable_link_category'] ) && 1 == $bdp_settings['disable_link_category'] ) ? true : false;
								?>
								<span class="category-link <?php echo ( $categories_link ) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
									<?php
									if ( $categories_link ) {
										$categories_list = wp_strip_all_tags( $categories_list );
									}
									if ( $categories_list ) :
										?>
										<span class="link-lable"> <i class="fas fa-folder"></i> <?php esc_html_e( 'Category', 'blog-designer-pro' ); ?>:&nbsp; </span>
										<?php
										echo ' '. wp_kses( $categories_list, Bdp_Admin_Functions::args_kses() );
										$show_sep = true;
									endif;
									?>
								</span>
								<?php
							}
							if ( isset( $bdp_settings['display_tag'] ) && 1 == $bdp_settings['display_tag'] ) {
								$tags_list = get_the_tag_list( '', ', ' );
								$tag_link  = ( isset( $bdp_settings['disable_link_tag'] ) && 1 == $bdp_settings['disable_link_tag'] ) ? true : false;
								if ( $tag_link ) {
									$tags_list = wp_strip_all_tags( $tags_list );
								}
								if ( $tags_list ) :
									?>
									<div class="tags <?php echo ( $tag_link ) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
										<span class="link-lable"> <i class="fas fa-bookmark"></i> <?php esc_html_e( 'Tags', 'blog-designer-pro' ); ?>:&nbsp; </span>
										<?php
										echo wp_kses( $tags_list, Bdp_Admin_Functions::args_kses() );
										$show_sep = true;
										?>
									</div>
									<?php
								endif;
							}
						} else {
							$taxonomy_names = get_object_taxonomies( $bdp_settings['custom_post_type'], 'objects' );
							$taxonomy_names = apply_filters( 'bdp_hide_taxonomies', $taxonomy_names );
							foreach ( $taxonomy_names as $taxonomy_single ) {
								$taxonomy = $taxonomy_single->name;
								$sep      = 1;
								if ( isset( $bdp_settings[ 'display_taxonomy_' . $taxonomy ] ) && 1 == $bdp_settings[ 'display_taxonomy_' . $taxonomy ] ) {
									$term_list     = wp_get_post_terms( get_the_ID(), $taxonomy, array( 'fields' => 'all' ) );
									$taxonomy_link = ( isset( $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy ] ) && 1 == $bdp_settings[ 'disable_link_taxonomy_' . $taxonomy ] ) ? false : true;
									if ( isset( $taxonomy ) ) {
										if ( isset( $term_list ) && ! empty( $term_list ) ) {
											?>
											<span class="category-link <?php echo ( $taxonomy_link ) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
												<span class="link-lable"> <i class="fas fa-folder"></i> <?php echo esc_attr( $taxonomy_single->label ); ?>:&nbsp; </span>
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
											<?php
										}
									}
								}
							}
						}
						if ( Bdp_Template_Acf::is_acf_plugin() ) {
							if ( isset( $bdp_settings['display_acf_field'] ) && 1 == $bdp_settings['display_acf_field'] ) {
								echo '<div class="bdp_acf_field">';
								do_action( 'bdp_after_blog_post_content_data', $bdp_settings, $post->ID );
								echo '</div>';
							}
						}
						?>
					</div>
					<?php Bdp_Utility::get_social_icons( $bdp_settings ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="<?php echo esc_attr( $curv_line ); ?>"></div>
	<?php do_action( 'bdp_after_post_content' ); ?>
</div>
<?php
do_action( 'bdp_separator_after_post' );
