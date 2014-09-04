<?php 
$pagename="about-page";
include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
				<div class="arrows arrows2 detailprev" data-a="page-prev"></div>
				<div class=" detailcon">
					<h2>about SHANG XIA</h2>
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
				<h2 class="aboutintrotit">brand story<br />Renaissance of Chinese Art of Living</h2>
				<p class="">SHANG XIA is a brand for art of living that promises a unique encounter with the heritage of Chinese design and craftsmanship.</p>
				<p>The renowned designer Jiang Qiong Er established SHANG XIA with a mission to create a 21st century lifestyle founded on the finest of Chinese design traditions.</p>
				<p>The SHANG XIA name is simple yet profound. It embodies the concept of “up” and “down” in the continuous flow of energy from past, present and future, transmitting the essence of Chinese culture and its sublime aesthetics.</p>
				<p>Building on 5,000 years of unique inheritance, and in the spirit of dialogue between tradition and modernity, SHANG XIA integrates the warmth, balance and harmony of Chinese grace into all its products.</p>
				<p>SHANG XIA’s collections are comprised of striking furniture, fine decorative objects, exquisite accessories and luxurious garments. Uniquely, SHANG XIA also creates an annual series of limited edition “cultural objects”. These collectibles convey messages of tradition, guardianship and remembrance.</p>
				<p>With flair and exacting attention to detail, SHANG XIA preserves the historical beauty and craftsmanship born of Chinese ingenuity, to provide a simple, elegant 21st century aesthetic.</p>
			</div>
		</div>
		<!-- related products -->
		<div class="section">
			<div class="products">
				<div class="productstit abouttit">
					<h2>founder & artistic director of shang xia</h2>
				</div>
				<div class="productscom">
					<div class="productsinfor cs-clear">
						<div class="proinfortxt aboutinfortxt">
							<!-- <h2> </h2> -->
							<p>As Artistic Director and CEO of SHANG XIA, Ms. Jiang Qiong Er is a Chinese contemporary designer of international reputation infusing the subtlety, beauty and heritage of Chinese culture. Her designs breathe elegance of innovation and imagination. Her international vision and open mind, along with her multi-cultural background, naturally allow her creativity to express itself; preserving and respecting tradition, both Eastern and Western.Jiang Qiong Er was introduced to traditional painting when she was only two and later became a student of famous painter Cheng Shi Fa and calligrapher Han Tian Hong. After graduation from Tong Ji University in Art & Design, she went on to the Decorative Arts School in Paris to further her studies in furniture and interior design.</p>
							<a href="#">Read more</a>
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
					<h2>heritage & encounter</h2>
				</div>
				<div class="knowhowcom ">
					<div class="knowhowitem cs-clear">
						<div class="knowhowintro  knowhowL">Xiu Yin, the 90 year old grandmother From the Republic, to the war To the liberation of new China To the new century Says she, she has had four lives Today, she still radiantly smiles</div>
						<div class="knowhowpic  knowhowR"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear">
						<div class="knowhowintro  knowhowR">Hui Jie, the 65 year old mother From the countryside To the open reform To the frenzy of construction Her life bears the weight of three eras of time  Today, she continues to lightly dance</div>
						<div class="knowhowpic  knowhowL"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
					</div>
					<div class="knowhowitem cs-clear">
						<div class="knowhowintro  knowhowL">Qiong Er, the 33 year old daughter From educational reform To the booming economy To East-West cross cultural exchange She is   fortunate witness to and experiences two styles of life   Today, she carries on the ambition She carries on the ideal</div>
						<div class="knowhowpic  knowhowR"><img src="../SX/images/knowhowpic.jpg" width="100%" /></div>
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
                    <a href="#" data-a="pop-jobs"><?php echo Yii::t("strings", "Read more")?></a>
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
                          <a href="mailto:xxx@aaa.com" class="popaboutbtn">Apply</a>
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