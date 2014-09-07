<?php 
if( !isset( $_GET['type'] ) ){
	$_GET['type'] = 'all';
}
include_once 'common/header.php';

$results = searchWithKeyword($_GET["s"]);
?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
					<h2 class="">search：<?php echo $_GET['s']; ?></h2>
			</div>
		</div>
		<!-- search nav -->
		<div class="searchnav ">
			<div class="searchnavcom cs-clear">
				<a href="/search.php?s=<?php echo $_GET['s']; ?>&type=all" class="<?php if($_GET['type'] == 'all'){echo 'on';} ?>">all</a>
				<a href="/search.php?s=<?php echo $_GET['s']; ?>&type=collection" class="<?php if($_GET['type'] == 'collection'){echo 'on';} ?>">collection</a>
				<a href="/search.php?s=<?php echo $_GET['s']; ?>&type=craft" class="<?php if($_GET['type'] == 'craft'){echo 'on';} ?>">craft</a>
			</div>
		</div>
		<!-- searchlist -->
		<div class="section">
			<div class="products searchlist">
				<!--  -->
				<div class="">
					<ul class="piclist cs-clear">
            <?php foreach ($results as $item): ?>
              <li class="piclistitem searchpicitem" data-type="<?php echo $item->type?>">
                <a href="/<?php echo $item->type == "collection" ? "collections": "craft"?>.php?id=<?php echo $item->cid?>">
                  <img src="<?php echo makeThumbnail($item->thumbnail_image)?>" width="100%" />
                  <p><span><?php echo $item->title?></span></p>
                </a>
              </li>
            <?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>