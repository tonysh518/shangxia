<?php 
$pagename="about-page";
include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
				<div class="arrows arrows2 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2><?php echo Yii::t("strings", "about SHANG XIA")?></h2>
				</div>
				<div class="arrows arrows2 detailnext" data-a="page-next"></div>
			</div>
		</div>
		<!-- slide -->
		<div class="slide">
			<div class="slidebox cs-clear">
				<a href="#" class="slideitem"><img src="../SX/images/parisdemo.jpg" width="100%" /></a>
				<a href="#" class="slideitem"><img src="../SX/images/parisdemo.jpg" width="100%" /></a>
				<a href="#" class="slideitem"><img src="../SX/images/parisdemo.jpg" width="100%" /></a>
				<a href="#" class="slideitem"><img src="../SX/images/parisdemo.jpg" width="100%" /></a>
			</div>
			<ul class="slidetab cs-clear">
				<li class="on"></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
		</div>
		<!-- barbg -->
		<div class="barbg"></div>
		<!-- intro -->
		<div class="section ">
			<div class="intro introparis ">
				<h2 class="aboutintrotit"><?php echo Yii::t("strings", "about_brand_story_title")?></h2>
        <?php echo Yii::t("strings", "about_brand_story_desc")?>
				</div>
		</div>
		<!-- related products -->
		<div class="section">
			<div class="products">
				<div class="productstit abouttit">
					<h2><?php echo Yii::t("strings", "about_brand_founder_title")?></h2>
				</div>
				<div class="productscom">
					<div class="productsinfor cs-clear">
						<div class="proinfortxt aboutinfortxt">
							<!-- <h2> </h2> -->
							<p><?php echo Yii::t("strings", "about_brand_founter_desc")?></p>
							<a href="#" class="btn transition-wrap"><span class="transition"><?php echo Yii::t("strings", "Read more")?><br><br><?php echo Yii::t("strings", "Read more")?></span></a>
						</div>
						<div class="proinforpic">
							<div class="slide">
								<div class="slidebox cs-clear">
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
									<img class="slideitem" src="../SX/images/proinfopic.jpg" width="100%" />
								</div>
								<ul class="slidetab">
									<li></li>
									<li class="on"></li>
									<li></li>
									<li></li>
								</ul>
								<!-- 数量改变需要改变css，或者用js来调整slidebox的宽度和slidetab的位置 -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- know how -->
		<div class="section">
			<div class="knowhow">
				<div class="productstit about2tit">
					<h2><?php echo Yii::t("strings", "about_brand_emplee_subject")?></h2>
				</div>
				<div class="knowhowcom ">
					<div class="knowhowitem cs-clear">
						<div class="knowhowintro  knowhowR"><?php echo Yii::t("strings", "about_brand_emplee_one")?></div>
            <div class="knowhowpic  knowhowL"><img src="./images/about_em_1.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear">
						<div class="knowhowintro  knowhowL">
              <?php echo Yii::t("strings" ,"about_brand_emplee_two")?>
            </div>
						<div class="knowhowpic  knowhowR"><img src="./images/about_em_2.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear">
						<div class="knowhowintro  knowhowR">
              <?php echo Yii::t("strings" ,"about_brand_emplee_third")?>
            </div>
						<div class="knowhowpic  knowhowL"><img src="./images/about_em_3.jpg" width="100%" /></div>
					</div>
				</div>
			</div>
		</div>
		<!--  other jobs -->
		<div class="section">
			<div class="products othercraf">
				<div class="productstit jobstit">
					<h2><?php echo Yii::t("strings", "jobs")?></h2>
				</div>
				<div class="productscom jobscom">
					<!--  -->
					<div class="productslist cs-clear">
              <?php foreach (loadJob() as $job): ?>
                <div class="jobsitem">
                    <h3><?php echo $job->title?></h3>
                    <a href="#" class="btn transition-wrap" data-a="pop-jobs"><span class="transition"><?php echo Yii::t("strings", "Read more")?><br><br><?php echo Yii::t("strings", "Read more")?></span></a>
                    <textarea style="display:none;">
                      <div class="popshade"></div>
                      <div class="pop pop1">
                        <div class="popclose" data-a="popclose"></div>
                        <!--  -->
                        <div class="popcon popconabout">
                          <h2><?php echo $job->title?></h2>
                          <div class="popcontxt">
                            <p><?php echo Yii::t("strings", "Reports To")?>: <?php echo $job->report_to?><br /><br /><?php echo Yii::t("strings", "Location")?>: <?php echo $job->location?></p>
                          </div>
      										<h3><?php echo Yii::t("strings", "General Role")?>:</h3>
                          <div class="popcontxt">
                            <p><?php echo $job->general_role?></p>
                          </div>
                          <h3><?php echo Yii::t("strings", "Key Responsibilities")?>:</h3>
                          <div class="popcontxt">
                            <p>
                              <?php echo $job->key_responsibilities?>
                            </p>
                          </div>
                          <h3><?php echo Yii::t("strings", "Requirements & Capabilities")?></h3>
                          <div class="popcontxt">
                            <p> 
                              <?php echo $job->requirements_capabilities?>
                              </p>
                          </div>
                          <a href="mailto:xxx@aaa.com" class="btn popaboutbtn transition-wrap" data-a="pop-jobs"><span class="transition">Apply<br><br>Apply</span></a>
                          <div class="popshare cs-clear">
                            <a href="#" class="popsharef"></a>
                            <a href="#" class="popsharet"></a>
                            <a href="#" class="popsharein"></a>
                            <a href="#" class="popsharewb"></a>
                            <a href="#" class="popsharewx"></a>
                          </div>
                        </div>
                      </div>
                    </textarea>
                </div>
              <?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>	