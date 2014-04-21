<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

widget_css();


$icon_url = widget_data_url( $widget_config['code'], 'icon' );

$file_headers = @get_headers($icon_url);

if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $icon_url = null;
}

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = bo_table(1);

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 5;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
		
$title_query = "SELECT bo_subject FROM ".$g5['board_table']." WHERE bo_table = '".$_bo_table."'";
$title = cut_str(db::result( $title_query ),10,"...");
?>


<div class='withcenter_latest'>
	<div class='title'>
		<div  class='top-title'>
		<? if ( $icon_url ) echo "<img class='x-latest-withcenter-icon' src='".$icon_url."'/>"; ?>
		<a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$_bo_table?>"><?=$title?></a>
		</div>
		<a class='more_btn' href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?=$_bo_table?>"><img src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/more_btn.gif' /></a>
		<div style='clear: both;'></div>
	</div>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
			<img class='dot' src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/dot.gif' />
			<div class='subject'>
				<a href='<?=$list[$i]['url']?>'><?=$list[$i]['subject']?></a>			
			</div>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
			<li>
				<img class='dot' src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/dot.gif' />
				<div class='subject'>
					<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=5'>사이트 만들기 안내</a>
				</div>
			</li>
			<li>
				<img class='dot' src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/dot.gif' />
				<div class='subject'>
					<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=4'>블로그 만들기</a>
				</div>
			</li>
			<li>
				<img class='dot' src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/dot.gif' />
				<div class='subject'>
					<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=3'>커뮤니티 사이트 만들기</a>
				</div>
			</li>
			<li>
				<img class='dot' src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/dot.gif' />
				<div class='subject'>
					<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=2'>여행사 사이트 만들기</a>
				</div>
			</li>
			<li>
				<img class='dot' src='<?=x::url()?>/widget/<?=$widget_config['name']?>/img/dot.gif' />
				<div class='subject'>
					<a href='http://www.philgo.net/bbs/board.php?bo_table=help&wr_id=1'>(모바일)홈페이지, 스마트폰 앱</a>
				</div>
			</li>
    <?php }  ?>
    </ul>
</div>