
<?php
if (isset($_GET["name"])) {
  require_once 'common/inc.php';
  if (array_search($_GET["name"], ProductContentAR::getType()) === FALSE) {
    exit(header("Location: /index.php"));
  }
}
else {
  exit(header("Location: /index.php"));
}?>

  <?php include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
				<div class="arrows arrows2 detailprev"></div>
				<div class=" detailcon">
					<h2><?php echo Yii::t("strings", "SHANG XIA ". $_GET["name"])?></h2>
				</div>
				<div class="arrows arrows2 detailnext"></div>
			</div>
		</div>
		<!-- slide -->
		<div class="banner">
			<img src="/photo/collection-apparels.jpg" width="100%" />
		</div>
		<!-- barbg -->
		<div class="barbg"></div>
		<!-- apparel -->
	<div class="collpiclist cs-clear">
		<div class="collarrows collarrowsprev"></div>
		<!--  -->
		<div class="section">
			<div class="products ">
				<div class="productstit collpictit_app">
					<h2 style="width: 600px;margin-left: -300px;bottom: -40px;">the sound of tea COLLECTION<span>2010-2011</span></h2>					
				</div>	
				<!--  -->
				<div class="">
					<ul class="piclist cs-clear">
						<li class="piclistitem collpicitem">
							<img src="/images/colldemo2.jpg" width="100%" />
							<p><span class="collicon">architecture</span></p>
						</li>
						<li class="piclistitem collpicitem">
							<img src="/images/colldemo2.jpg" width="100%" />
							<p><span>architecture</span></p>
						</li>
						<li class="piclistitem collpicitem marginR0">
							<img src="/images/colldemo2.jpg" width="100%" />
							<p><span>architecture</span></p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--  -->
		<div class="collarrows collarrowsnext"></div>
	</div>
		<!-- jewelry -->

	<div class="collpiclist cs-clear" style="position:relative">
		<div class="collarrows collarrowsprev"></div>
		<!--  -->
		<div class="section">
			<div class="products ">
				<div class="productstit ">
					<h2><?php echo Yii::t("strings", "TIMELESS COLLECTIONS")?></h2>
				</div>	
				<!--  -->
				<div class="products-wrap js-horizontal-slide intoview-effect" data-effect="fadeup" data-num="3">
					<div class="collarrows collarrowsprev" data-a="collarrowsprev"></div>
					<div class="slide-con">
						<ul class="slide-con-inner piclist cs-clear">
							<li class="piclistitem collpicitem">
								<img src="/images/colldemo3.jpg" width="100%" />
								<p><span>view</span></p>
							</li>
							<li class="piclistitem collpicitem">
								<img src="/images/colldemo3.jpg" width="100%" />
								<p><span>view</span></p>
							</li>
							<li class="piclistitem collpicitem marginR0">
								<img src="/images/colldemo3.jpg" width="100%" />
								<p><span>view</span></p>
							</li>
						</ul>
					</div>
					<div class="collarrows collarrowsnext" data-a="collarrowsnext"></div>
				</div>
			</div>
		</div>
		<!--  -->
		<div class="collarrows collarrowsnext"></div>
	</div>

<?php include_once 'common/footer.php';?>