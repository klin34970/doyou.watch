			<!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-picture-o"></i><?php echo $language->get('Title Content'); ?><span><?php echo $language->get('Title Sub Content'); ?></span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label"><?php echo $language->get('You are here'); ?>:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="/"><?php echo $language->get('Home'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
							<li>
                                <a href=""><?php echo $language->get('Categories'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">
                                <a href=""><?php echo $language->get('Videos'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row">
                        <div class="col-md-12">
						<?php echo Errors::display($error); ?>
						<?php echo Session::message('message'); ?>
							
                            <div class="pull-right">

								<!-- Start right navigation -->
								<ul class="nav navbar-nav navbar-right">
								
									<!-- Start order -->
									<li class="dropdown navbar-order">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<span class="btn btn-danger btn-sm">
												<span class="hidden-xs hidden-sm"><?php echo $language->get('Order by'); ?></span>
												<span class="caret"></span>
											</span>
										</a>
										<!-- Start dropdown menu -->
										<ul class="dropdown-menu animated flipInX">
											<li>
												<a href="?order=nw">
													<i class="fa fa-calendar"></i>
													<?php echo $language->get('Newest'); ?>
												</a>
											</li>
											<li>
												<a href="?order=mw">
													<i class="fa fa-eye"></i>
													<?php echo $language->get('Most Viewed'); ?>
												</a>
											</li>
											<li>
												<a href="?order=lg">
													<i class="fa fa-clock-o"></i>
													<?php echo $language->get('Longest'); ?>
												</a>
											</li>
										</ul>
										<!--/ End dropdown menu -->
									</li><!-- /.navbar-order -->
									<!--/ End order -->

								</ul><!-- /.navbar-right -->
								<!--/ End right navigation -->
					
					
                            </div>
							
                            <div class="clearfix"></div>
                        </div>
                    </div>

			
                    <ul id="gallery">
					
						<?php foreach($videos as $video) : ?>
						
							<li class="mix <?php echo strtolower(explode(', ', $video->categories)[0]); ?>">
								<div class="gallery-item rounded shadow">
									<a href="/video/<?php echo $video->domain;?>/<?php echo Url::generateSafeSlug($video->title);?>/<?php echo $video->video_id;?>" class="gallery-img">
										<img src="<?php echo $video->thumbnail; ?>" class="img-responsive full-width" alt="..." />
									</a>
									<div class="gallery-details">
										<div class="gallery-summary">
											<p>
												<a class="btn-title" href="/video/<?php echo $video->domain;?>/<?php echo Url::generateSafeSlug($video->title);?>/<?php echo $video->video_id;?>" class="gallery-img">		
													<?php echo utf8_decode($video->title); ?>
												</a>
											</p>
										</div>
									</div>
									<div class="gallery-author">
										<div class="media">
											<div class="media-body">
												<h4 class="media-heading text-capitalize">
													<a class="btn-categories" href="/categories/<?php echo strtolower(str_replace('/', '-', explode(', ', $video->categories)[0])); ?>">
														<?php echo ucfirst(explode(', ', $video->categories)[0]); ?>
													</a>
												</h4>
												<br>
												<span class="pull-left btn-details">
													<a href="/providers/<?php echo $video->domain; ?>"><i class="fa fa-feed"></i> <?php echo $video->domain; ?></a> 
													| <i class="fa fa-clock-o"></i> <?php echo gmdate('H:i:s', $video->duration); ?> 
													| <i class="fa fa-eye"></i> <?php echo $video->views; ?>
												</span>
												<br>
											</div>
										</div>
									</div>
								</div><!-- /.gallery-item -->
							</li>
						
						<?php endforeach; ?>
						
                    </ul>
                    
                    
					
					<div class="text-center">
						<?php echo $pageLinks; ?>
					</div>

                </div><!-- /.body-content -->
                <!--/ End body content -->

