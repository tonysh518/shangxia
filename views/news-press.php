<?php include_once 'common/header.php';?>
		<!-- newscrumbs -->
		<div class="section intoview-effect" data-effect="fadeup" style="opacity: 1; margin-top: 0px;">
			<div class="detail cs-clear">
				<div class="arrows arrows3 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo Yii::t("strings", "PRESS")?></h2>
					<div class="press-lock"><?php echo Yii::t("strings", "Press access")?></div>
				</div>
				<div class="arrows arrows3 detailnext" data-a="page-next"></div>
			</div>
		</div>

		<!-- older news -->
		<div class="section">
			<div class="products">
				<div class="productscom">
          <?php $presses = loadPressWithYearGroup();?>
          <?php $years = array_keys($presses);?>
					<div class="newsoldertime intoview-effect" data-effect="fadeup">
            <?php foreach ($years as $index =>  $year): ?>
              <a href="<?php if ($index == 0) echo "on"?>"><?php echo $year?></a>
            <?php endforeach;?>
					</div>
					<!--  -->
					<div class="productslist cs-clear">
            <?php foreach ($presses as $year => $press): ?>
              <a href="#" data-a="pop-press-item" data-press="<?php echo $press->master_image?>" class="prolistitem newsitem intoview-effect" data-effect="fadeup">
                <img src="<?php echo $press->press_image?>" width="100%" />
                <p><?php echo $press->title?><br /><span class="date"><?php echo date("Y M d", strtotime($press->publish_date))?></span></p>
              </a>
            <?php endforeach;?>
					</div>
					<!--  -->
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>


