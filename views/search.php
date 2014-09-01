<?php 
if( !isset( $_GET['type'] ) ){
	$_GET['type'] = 'all';
}
include_once 'common/header.php';?>
		<!-- detail -->
		<div class="section ">
			<div class="detail cs-clear">
					<h2 class="">search：<?php echo $_GET['s']; ?></h2>
			</div>
		</div>
		<!-- search nav -->
		<div class="searchnav ">
			<div class="searchnavcom cs-clear">
				<a href="./search.php?s=<?php echo $_GET['s']; ?>&type=all" class="<?php if($_GET['type'] == 'all'){echo 'on';} ?>">all</a>
				<a href="./search.php?s=<?php echo $_GET['s']; ?>&type=collection" class="<?php if($_GET['type'] == 'collection'){echo 'on';} ?>">collection</a>
				<a href="./search.php?s=<?php echo $_GET['s']; ?>&type=craft" class="<?php if($_GET['type'] == 'craft'){echo 'on';} ?>">craft</a>
			</div>
		</div>
		<!-- searchlist -->
		<div class="section">
			<div class="products searchlist">
				<!--  -->
				<div class="">
					<ul class="piclist cs-clear">
						<li class="piclistitem searchpicitem">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem marginR0">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem marginR0">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
						<li class="piclistitem searchpicitem marginR0">
							<a href="">
								<img src="../SX/images/colldemo6.jpg" width="100%" />
								<p><span>bridge</span></p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!--  -->
<?php include_once 'common/footer.php';?>