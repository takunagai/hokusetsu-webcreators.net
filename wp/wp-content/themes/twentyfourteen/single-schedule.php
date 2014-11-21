<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php twentyfourteen_post_thumbnail(); ?>

				<header class="entry-header">

					<?php the_post(); ?>

					<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
					<?php //the_post_thumbnail('medium'); ?>
					<p><?php the_excerpt(); ?></p>

					<table border="1">
					  <tr>
					    <th style="width: 3em;">日時</th>
					    <td><?php echo esc_html( get_field('date')) . ' ' . esc_html( get_field('time')); ?></td>
					  </tr>
					  <tr>
					    <th>場所</th>
					    <td><a href="<?php echo esc_html( get_field('place_url')) ?>" target="_blank"><?php echo esc_html( get_field('place')); ?></a><br></td>
					  </tr>
					  <tr>
					    <th>会費</th>
					    <td><?php echo esc_html( get_field('price')); ?></td>
					  </tr>
					</table>

					<div class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' ); ?>
					</div>

				</header>



				<div class="entry-content">

					<?php the_content(); ?>

					<h3>対象者</h3>
					<?php echo get_field('target'); ?>

					<?php
					if ($reports = get_field('reports')) {
						echo '<h3>この勉強会のレポート</h3>\n';
						echo $reports;
					}
					?>
				</div>



				<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
			</article><!-- #post-## -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
