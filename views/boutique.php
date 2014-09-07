<?php 
if (isset($_GET["key"])) {
  require_once 'common/inc.php';
  $boutique = BoutiqueContentAR::model()->loadByAddressKey($_GET["key"]);
  if (!$boutique || $boutique->type != BoutiqueContentAR::model()->type) {
    exit(header("Location: /index.php"));
  }
}
else {
  exit(header("Location: /index.php"));
}

$pagename="boutique-page";
include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section intoview-effect" data-effect="fadeup">
			<div class="detail cs-clear">
				<div class="arrows arrows2 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo $boutique->title?></h2>
				</div>
				<div class="arrows arrows2 detailnext" data-a="page-next"></div>
			</div>
		</div>
		<!-- slide -->
    <?php if ($boutique->boutique_slide): ?>
      <div class="slide intoview-effect" data-effect="fadeup">
        <div class="slidebox cs-clear">
          <?php foreach ($boutique->boutique_slide as $image): ?>
            <a href="javascript:void(0)" class="slideitem"><img src="<?php echo $image?>" width="100%" /></a>
          <?php endforeach;?>
        </div>
        <ul class="slidetab cs-clear">
          <?php foreach ($boutique->boutique_slide as $index => $image): ?>
            <li class="<?php if ($index == 0) echo "on";?>"></li>
          <?php endforeach;?>
        </ul>
        <!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
      </div>
    <?php endif;?>
		<!-- barbg -->
		<div class="barbg"></div>
		<!-- intro -->
		<div class="section ">
			<div class="intro introparis">
				<h2 class="intoview-effect" data-effect="fadeup"><?php echo $boutique->info_title?></h2>
        <p class="intoview-effect" data-effect="fadeup"><?php echo $boutique->body?></p>
      </div>
		</div>
		<!-- parislist -->
		<div class="section">
			<div class="parislist cs-clear">
				<a href="javascript:void(0)" class="parisitem intoview-effect" data-effect="fadeup">
					<img src="/images/parisdemo1.jpg" width="100%" alt="">
				</a>
				<a href="javascript:void(0)" class="parisitem intoview-effect" data-effect="fadeup">
					<img src="/images/parisdemo1.jpg" width="100%" alt="">
				</a>
				<a href="javascript:void(0)" class="parisitem marginR0 intoview-effect" data-effect="fadeup">
					<img src="/images/parisdemo1.jpg" width="100%" alt="">
				</a>
			</div>
		</div>
		<!-- find us -->
		<div class="section">
			<div class="products findus">
				<div class="productstit intoview-effect" data-effect="fadeup">
					<h2><?php echo Yii::t("strings", "find us")?></h2>
				</div>

				<!-- store -->
				<div class="section store cs-clear">
					<div class="storechoose storechoose2 intoview-effect" data-effect="fadeup">
						<?php echo $boutique->address?>
					</div>
					<div class="storemap intoview-effect" data-map="<?php echo $boutique->latlng?>" data-effect="fadeup">
						<img src="/images/findus.jpg" width="100%" />
					</div>
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>