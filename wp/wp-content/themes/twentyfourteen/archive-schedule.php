<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 class="entry-title">勉強会のスケジュール 一覧</h1>
				<ul>
					<li><a href="#not-yet">今後の勉強会スケジュール 一覧</a></li>
					<li><a href="#done">過去の勉強会 一覧</a></li>
				</ul>
			</header><!-- .page-header -->

			<div class="entry-content">


		<!-- * * * * * * * * * * * * * * 今後のスケジュール一覧 * * * * * * * * * * * * * * -->
		<!-- 注) 現状、極力 functions.php を触らないようにしてるので、該当記事抽出に pre_get_posts() は使わず if文で処理した -->
		<?php if (have_posts()) : ?>
			<h2 id="not-yet">今後の勉強会スケジュール 一覧</h2>
		  <?php while (have_posts()) : the_post(); ?>
		  <?php
		    $status = get_field('status');
		    if($status !== '終了') :
		  ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p>
		    日時：<?php $weekday = array('日','月','火','水','木','金','土'); $date = get_field('date'); echo date('n/j(', strtotime($date)) . $weekday[date('w', strtotime($date))] . ') ' . esc_html( get_field('time')); ?><br />
			  場所：<?php echo esc_html( get_field('place')); ?><br>
		    [<?php echo esc_attr( $post->post_name ); ?>] <?php echo $status; ?>
		  </p>
			<p><?php the_excerpt(); ?></p>
		  <?php endif; ?>
		  <?php endwhile; ?>
		  <?php twentyfourteen_paging_nav();// Previous/next page navigation. ?>
		<?php else: ?>
		  <?php get_template_part( 'content', 'none' );//<p>記事がありません。</p> ?>
		<?php endif; ?>
		<!-- * * * * * * * * * * * * * * /今後のスケジュール一覧 * * * * * * * * * * * * * * -->


		<hr>


		<!-- * * * * * * * * * * * * * * 過去の勉強会一覧 * * * * * * * * * * * * * * -->
		<?php
		$args = array(
		  'post_type' => 'schedule',
		  'posts_per_page' => -1,
		  'orderby' => 'date',
		  'order' => 'ASC',
		  'meta_key' => 'status',//カスタムフィールドキー
		  'meta_value' => '終了',//カスタムフィールドの値
		);
		$myposts = get_posts($args);
		?>

		<?php if($myposts): ?>
			<h2 id="done">過去の勉強会 一覧</h2>
		  <?php foreach($myposts as $post) : setup_postdata($post); ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p>
		    日時：<?php $weekday = array('日','月','火','水','木','金','土'); $date = get_field('date'); echo date('n/j(', strtotime($date)) . $weekday[date('w', strtotime($date))] . ') ' . esc_html( get_field('time')); ?><br />
			  場所：<?php echo esc_html( get_field('place')); ?><br>
		    [<?php echo esc_attr( $post->post_name ); ?>] <?php echo esc_html( get_field('status')); ?>
		  </p>
			<p><?php the_excerpt(); ?></p>
		  <?php endforeach; ?>
		  <?php wp_reset_postdata(); ?>
		<?php else: ?>
		  <p>記事がありません。</p>
		<?php endif; ?>
		<!-- * * * * * * * * * * * * * * /過去の勉強会一覧 * * * * * * * * * * * * * * -->


			<!-- /.entry-content -->
			</div>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
