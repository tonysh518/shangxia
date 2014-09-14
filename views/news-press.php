<?php include_once 'common/header.php';?>
		<!-- newscrumbs -->
		<div class="section intoview-effect" data-effect="fadeup" style="opacity: 1; margin-top: 0px;">
			<div class="detail cs-clear">
				<div class="arrows arrows3 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo Yii::t("strings", "PRESS")?></h2>

					<a href="#" title="" class="press-lock btn btn-white transition-wrap"><span class="transition">&nbsp;&nbsp;<?php echo Yii::t("strings", "Press access")?><br/><br/>&nbsp;&nbsp;<?php echo Yii::t("strings", "Press access")?></span></a>
				</div>
				<div class="arrows arrows3 detailnext" data-a="page-next"></div>
			</div>
		</div>

		<!-- older news -->
		<div class="section">
			<div class="products">
				<div class="productscom slide" data-auto="false">
          <?php $years = loadPressYears();?>
					<div class="newsoldertime intoview-effect" data-effect="fadeup">
						<ul class="slidetab">
            <?php foreach ($years as $index =>  $year): ?>
              <li data-year="<?php echo $year["year"]?>" class="<?php if ($index == count($years)-1) echo "on"?>"><?php echo $year["year"]?></li>
            <?php endforeach;?>
            			</ul>
					</div>
          
          <?php $first_year = array_shift($years);?>
          <?php $presses = PressContentAR::model()->getListWithYear($first_year["year"]);?>
					<!--  -->
					<div class="productslist cs-clear slidebox" style="margin-left:<?php echo -(count( $presses )-1) * 100 . '%'; ?>">>
						<div data-year="" class="cs-clear slideitem">
            <?php foreach ($presses as $year => $press): ?>
              <a href="#" data-year="<?php echo date("Y", strtotime($press->publish_date))?>" data-a="show-pop" data-d="press=1" class="prolistitem newsitem intoview-effect" data-effect="fadeup">
                <img src="<?php echo $press->press_image?>" width="100%" />
                <p><?php echo $press->title?><br /><span class="date"><?php echo date("Y M d", strtotime($press->publish_date))?></span></p>
              </a>
              <textarea style="display:none;">
              	<div class="picoperate cs-clear">
                    <a href="#" class="picopsized" data-a="picopsized"></a>
                    <a href="#" class="picopsizeup" data-a="picopsizeup"></a>
                    <a href="<?php echo $press->master_image?>" class="picopdown" target="_blank"></a>
                </div>
                <div class="pic-press">
                	<img src="<?php echo $press->master_image?>" width="100%" style="margin:0 auto;">
                </div>
              </textarea>
            <?php endforeach;?>
            			</div>
					</div>
					<a href="#" style="margin-bottom:150px;" title="" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "Load more")?><br/><br/><?php echo Yii::t("strings", "Load more")?></span></a>
					<!--  -->
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>


