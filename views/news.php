<?php include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section intoview-effect" data-effect="fadeup">
			<div class="detail cs-clear">
				<div class="arrows arrows2 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo Yii::t("strings", "shang xia news")?></h2>
				</div>
				<div class="arrows arrows2 detailnext" data-a="page-next"></div>
			</div>
		</div>
		<!-- related products -->
		<div class="section intoview-effect" data-effect="fadeup">
			<div class="picinfor cs-clear">
				
          <?php $news = loadFirstNews();?>
          <?php if ($news): ?>
	          	<div class="picinfortxt">
		            <h2><?php echo $news->title?></h2>
		            <h3 style="text-transform:uppercase;"><?php echo date("Y M d", strtotime($news->date))?></h3>
		            <div class="body">
		              <?php echo $news->body?>
		            </div>
	            </div>
				<div class="picinforpic">
            <?php if ($news->news_slide_image):?>
					<div class="slide">
						<div class="slidebox cs-clear">
              <?php foreach($news->news_slide_image as $image): ?>
                <img class="slideitem" src="<?php echo $image?>" width="100%" />
              <?php endforeach;?>
						</div>
            <?php endif;?>
            <?php if ($news->news_slide_image):?>
						<ul class="slidetab">
              <?php foreach($news->news_slide_image as $index => $image): ?>
							<li class="<?php if ($index == 0) echo "on"?>"></li>
              <?php endforeach;?>
						</ul>
            <?php endif;?>
						<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
					</div>
				</div>
        	<?php endif;?>
				<!--  -->
			</div>
		</div>
		<!-- older news -->
		<div class="section intoview-effect" data-effect="fadeup">
			<div class="products">
				<div class="productstit othercraftit intoview-effect" data-effect="fadeup">
					<h2><?php echo Yii::t("strings", "older news")?></h2>
				</div>
        <?php $newsList = NewsContentAR::model()->getList(3);?>
				<div class="productscom intoview-effect" data-effect="fadeup">
					<!--  -->
					<ul class="normalbox cs-clear">
            <?php foreach($newsList as $key => $news): ?>
              <li class="productslist cs-clear slideitem" data-id="<?php echo $news->cid?>">
                  <a href="#" class="prolistitem newsitem" data-a="show-news">
                    <img src="<?php echo $news->thumbnail?>" width="100%" />
                    <p><?php echo $news->title?><br /><span class="date"><?php echo date("Y M d", strtotime($news->date))?></span></p>
                    <textarea style="display:none;">
                    	<?php if ($news): ?>
				          	<div class="picinfortxt">
					            <h2><?php echo $news->title?></h2>
					            <h3 style="text-transform:uppercase;"><?php echo date("Y M d", strtotime($news->date))?></h3>
					            <div class="body">
					              <?php echo $news->body?>
					            </div>
				            </div>
							<div class="picinforpic">
			            <?php if ($news->news_slide_image):?>
								<div class="slide">
									<div class="slidebox cs-clear">
			              <?php foreach($news->news_slide_image as $image): ?>
			                <img class="slideitem" src="<?php echo $image?>" width="100%" />
			              <?php endforeach;?>
									</div>
			            <?php endif;?>
			            <?php if ($news->news_slide_image):?>
									<ul class="slidetab">
			              <?php foreach($news->news_slide_image as $index => $image): ?>
										<li class="<?php if ($index == 0) echo "on"?>"></li>
			              <?php endforeach;?>
									</ul>
			            <?php endif;?>
									<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
								</div>
							</div>
			        	<?php endif;?>
                    </textarea>
                  </a>
              </li>
            <?php endforeach;?>
					</ul>
				</div>
				<!--  -->
				<div class="newsolderbtn intoview-effect" data-effect="fadeup" data-margin-top="50">
					<a data-a="nav-link" href="/news-detail.php" title="" class="transition-wrap"><span class="transition"><?php echo Yii::t("strings", "View all news")?><br/><br/><?php echo Yii::t("strings", "View all news")?></span></a>
				</div>
			</div>
		</div>
		<!-- SHANG XIA EVENTS -->
		<div class="section">
			<div class="products">
				<div class="productstit intoview-effect" data-effect="fadeup">
					<h2>SHANG XIA EVENTS</h2>
				</div>
				<div class="productscom newsnvents">
					<!--  -->
					<img src="/images/newsdemo3.jpg" class="intoview-effect" data-effect="fadeup" width="100%" alt="">
					<h3 class="intoview-effect" data-effect="fadeup">shang xia maison opening </h3>
					<h4  class="productscom-desc intoview-effect" data-effect="fadeup">2014 SEP 09</h4>
					<p  class="productscom-desc intoview-effect" data-effect="fadeup"><i>This aurum, the SHANG XIA, maision will be opened on Hua Hai Road, Shanghai.<br />A new journey ....     <a class="more" href="#">Read more &gt;</a> </i></p>
					<a data-a="nav-link" href="/news-events.php" title="" class="btn transition-wrap intoview-effect" data-effect="fadeup"><span class="transition">View all events<br/><br/>View all events</span></a>
				</div>
			</div>
		</div>
		<!-- press -->
		<div class="section">
			<div class="products press">
				<div class="productstit intoview-effect" data-effect="fadeup">
					<h2><?php echo Yii::t("strings", "Press");?></h2>
				</div>
				<div class="productscom js-horizontal-slide" data-num="4">
					<?php $presses = PressContentAR::model()->getList(10); ?>
					<?php if( count( $presses ) > 3 ){ ?>
					<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
					<?php } ?>
					<!--  -->
					<div class="slide-con">
						<div class="productslist cs-clear slide-con-inner">
              <?php foreach( $presses as $press): ?>
                <a class="prolistitem pressitem intoview-effect" data-a="show-pop" data-d="press=1" data-effect="fadeup" href="#">
                  <img src="/images/newsdemo4.jpg" width="100%" />
                  <p>
                  	<?php echo $press->title?><br />
                  	<span class="date"><?php echo date("M Y", strtotime($press->publish_date))?></span>
                  </p>
                </a>
                <textarea style="display:none;">
	              	<div class="picoperate cs-clear">
	                    <a href="#" class="picopsized" data-a="picopsized"></a>
	                    <a href="#" class="picopsizeup" data-a="picopsizeup"></a>
	                    <a href="<?php echo $press->master_image?>" class="picopdown" target="_blank"></a>
	                </div>
	                <div class="pic-press">
	                	<img src="<?php echo $press->master_image?>" alt="" width="100%" style="margin:0 auto;">
	                </div>
	            </textarea>
              <?php endforeach;?>
						</div>
					</div>
					<?php if( count( $presses ) > 3 ){ ?>
					<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
					<?php } ?>
					<!--  -->
					<div class="newsolderbtn intoview-effect" data-effect="fadeup">
						<a href="/news-press.php" title="" class="transition-wrap"><span class="transition"><?php echo Yii::t("strings", "View all  press articles")?><br/><br/><?php echo Yii::t("strings", "View all  press articles")?></span></a>
					</div>
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>
