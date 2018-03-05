<?php
/**
 * player html file
 * @package Louie
 * @since version 1.0.0
 */
$str = get_option('eaplayer_options');
?>
<div class="player-layer" style="background-color: <?php echo $str['color'];?>">
	<div class="player-container">
		<div class="player-hide-box">
			<section class="player-header">
				<div class="play-title">EA PLAYER @ Album by <span class="album-name"></span></div>
				<div class="player-music-search">
					<form method="get" class="music-search-form" action="<?php echo home_url(); ?>" role="search">
						<span class="ea-icon ea-search"></span>
						<input type="search" name="ms" class="music-search-input" size="26" placeholder="搜索 ..." />
					</form>
				</div>
			</section>
			<section class="player-info">
				<div class="history-record">
					<h4>历史记录 <span>[ 注意：部分数据仅限于当前浏览器 ]</span><span class="empty-history">清空</span></h4>
					<ul class="history-list"></ul>
				</div>
				<div class="current-record">
					<ul class="play-list"></ul>
				</div>
				<div class="lyric-text">
					<div id="lrcWrap" class="lrc-wrap lrc-wrap-open">
						<div id="lrcBox" class="lrc-box">
							<div id="lrc_2"></div>
						</div>
					</div>
					<div class="lyric-script"></div>
				</div>
				<div class="cover-photo">
					<div class="cover-disc"><img src="<?php echo PLAYER_URL.'/images/bg.jpg'; ?>"></div>
				</div>
				<div class="bg-player"></div>
				<div class="bg-player-mask"></div>
			</section>
		</div>
		<div class="player-control">
			<div class="btn-prev ea-icon"><i class="ea-prev"></i></div>
			<div class="btn-play ea-icon"><i class="ea-play"></i></div>
			<div class="btn-next ea-icon"><i class="ea-next"></i></div>
			<div class="player-progress">
				<div class="progress-sider">
					<div class="sider-loaded"></div>
					<div class="sider-pace"></div>
				</div>
				<div class="song-info">
					<span class="song-title"></span>
					<span class="song-artist"></span>
				</div>
			</div>
			<div class="player-timer">00:00/00:00</div>
			<div class="btn-mode ea-icon"><i class="ea-all"></i></div>
			<div class="btn-download ea-icon"><i class="ea-download"></i></div>
			<div class="btn-enlarge ea-icon"><i class="ea-enlarge"></i></div>
			<div class="player-volume ea-icon">
				<div class="volume-mute"><i class="ea-volume"></i></div>
				<div class="volume-sider">
					<div class="sider-pace"></div>
				</div>
			</div>
			<div class="btn-eaplayer">
				<i class="ea-icon ea-right"></i>
			</div>
		</div>
	</div><!-- .player-container ##-->
	<div id="key" data-id="<?php echo $str['mid'] ?>" data-type="<?php echo $str['type'] ?>" data-source="<?php echo $str['source'] ?>" data-api="<?php echo PLAYER_URL; ?>" data-autoplay="<?php echo $str['autoplay']; ?>" data-shuffle="<?php echo $str['shuffle']; ?>" data-search="netease"></div>
	<audio id="audio" type="audio/mpeg"></audio>
</div>