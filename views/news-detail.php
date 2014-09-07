<?php include_once 'common/header.php';?>

    <?php $news = loadFirstNews();?>
		<!-- newscrumbs -->
		<div class="newscrumbs">
			<p><a href="<?php echo "/news.php"?>"><?php echo Yii::t("strings", "News")?></a> > <?php echo Yii::t("strings", "SHORT NEWS")?></p>
		</div>
		<!-- related products -->
	<div class="collpiclist cs-clear">
		<div class="collarrows newsarrowsprev" data-a="page-prev"></div>
		<!--  -->
		<div class="section">
			<div class="picinfor cs-clear">
					<div class="picinfortxt">
							<h2><?php echo $news->title?></h2>
              <h3><?php echo date("Y M d", strtotime($news->date))?></h3>
              <?php echo $news->body?>
							</div>
					<div class="picinforpic">
							<div class="slide">
								<div class="slidebox cs-clear">
                  <?php foreach ($news->news_slide_image as $slide_image):?>
                    <img class="slideitem" src="<?php echo $slide_image?>" width="100%" />
                  <?php endforeach;?>
								</div>
								<ul class="slidetab">
                  <?php foreach ($news->news_slide_image as $index => $slide_image):?>
                    <li class="<?php if ($index == 0) echo "on"?>"></li>
                  <?php endforeach;?>
								</ul>
								<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
							</div>
					</div>
					<!--  -->
			</div>
		</div>
		<!--  -->
		<div class="collarrows newsarrowsnext" data-a="page-next"></div>
	</div>
		<!-- older news -->
		<div class="section">
			<div class="products">
				<div class="productstit othercraftit">
					<h2><?php echo Yii::t("strings", "older news")?></h2>
				</div>
        <?php $groupedNews = loadNewsWithYearGroup()?>
				<div class="productscom">
					<div class="newsoldertime">
            <?php foreach ($groupedNews as $year => $news): ?>
              <a href="javascript:void(0)"><?php echo $year?></a>
            <?php endforeach;?>
					</div>
					<!--  -->
					<div class="productslist cs-clear">
            <?php foreach ($groupedNews as $year => $newslist): ?>
              <?php foreach ($newslist as $news): ?>
                <div class="prolistitem newsitem" data-year="<?php echo $year?>" data-id="<?php echo $news->cid?>">
                  <img src="<?php echo $news->thumbnail?>" width="100%" />
                  <p><?php echo $news->title?><br /><?php echo date("Y M d", strtotime($news->date))?></p>
                </div>
              <?php endforeach;?>
            <?php endforeach;?>
					</div>
					<!--  -->
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>


