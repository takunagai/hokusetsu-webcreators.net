<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php twentyfourteen_post_thumbnail(); ?>
	<div class="entry-content">


<!-- 追加 -->
<?php //WP Queryのパラメーター : http://wpdocs.sourceforge.jp/Class_Reference/WP_Query#Parameters
$args = array(
  //'category_name' => 'hoge',//カテゴリースラッグ。複数はカンマ区切り。除外はマイナス付ける
  'post_type' => 'schedule',//ポストタイプ名。post（デフォルト）、page、revision、attachment、カスタム投稿タイプ名（functions.phpで設定した名前）

  //カスタム分類のサンプル
  //'tax_query' => array(//genreカスタム分類(custom taxonomy)の "jazz" に分類（ターム）された投稿のみを取得。上行の post_type とセットで
  //  array(
  //    'taxonomy' => 'genre',
  //    'field' => 'slug',
  //    'terms' => 'jazz'
  //  )
  //)

  //カスタムフィールドのサンプル
  //'post_type' => 'product',//product投稿タイプで、featured（カスタムフィールド）というメタキーが "yes" という値を持つ投稿を取得
  //'meta_query' => array(
  //  array(
  //    'key' => 'featured',
  //    'value' => 'yes',
  //  )
  //)

  //'tag' => 'tag_slug',//タグ
  //'name' => 'page_slug',//ページ
  //'author_name' => 'rami',//投稿者名
  //'post_status' =>'draft',//投稿ステータス。publish（デフォルト）、pending'、draft、auto-draft、future、private、inherit、trash
  'posts_per_page' => 10,//取得記事件数。-1で全件表示
  //'paged' => 6,//6ページ目を表示。/現在のページから表示：$page = get_query_var('page'); query_posts('paged=$page');/オフセット：query_posts('posts_per_page=5&offset=1');
  //'nopaging' => true,//ページネーションをオフにして全件表示
  'orderby' => 'date',//指定条件で並べる。ID、author、title、date、modified、parent、comment_count、rand（ランダム）、menu_order、meta_value、meta_value_num
  'order' => 'ASC',//降順 DESC。昇順は ASC。上行とセットで、日付降順
  //'meta_key' => 'color',//カスタムフィールドキー
  //'meta_value' => 'blue',//カスタムフィールドの値。上行とセットでcolorがblueの記事のみ取得
  //その他、先頭固定投稿引数の表示・非表示や、日時引数、変数を与える など、Codexを参照
);
$myposts = get_posts($args);
?>
<?php if($myposts)://★★このif文ありで動くか要検証 ?>
	<h2>勉強会のスケジュール</h2>
  <?php foreach($myposts as $post) : setup_postdata($post); ?>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	日時：<?php echo esc_html( get_field('date')) . ' ' . esc_html( get_field('time')); ?><br />
	場所：<?php echo esc_html( get_field('place')); ?>
	<p><?php the_excerpt(); ?></p>
  <?php endforeach; ?>
  <?php wp_reset_postdata(); ?>
<?php else: ?>
  <p>記事がありません。</p>
<?php endif; ?>
<!-- /追加 -->


<?php if (have_posts()) : ?>
	<h2>活動報告</h2>
	<ul>
  <?php while (have_posts()) : the_post(); ?>
	  <li><?php the_time('Y年n月j日'); ?> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php endwhile; ?>
  </ul>
<?php else: ?>
  <p>記事がありません。</p>
<?php endif; ?>


	<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>
	<!-- /.entry-content -->
	</div>
<!-- #post-## -->
</article>


		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
