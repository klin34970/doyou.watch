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
                            <li class="active">
                                <a href=""><?php echo $language->get('Video'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->
				
				<!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <div class="row" id="blog-single">

                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

                            <div class="panel panel-default panel-blog rounded shadow">
                                <div class="panel-body">
									<span class="pull-right"><button class="btn btn-primary switch"><?php echo $language->get('Turn off the light'); ?></button></span>
                                    <h3 class="blog-title"><?php echo utf8_decode($video->title); ?></h3>
									<ul class="blog-meta">
										<li><?php echo $language->get('By'); ?>: <a href="/providers/<?php echo strtolower($video->domain); ?>"><?php echo $video->domain; ?></a></li>
										<li><?php echo $video->date; ?></li>
										<li><?php echo $language->get('Views'); ?>: <?php echo $video->views; ?></li>
									</ul>
                                    <div class="blog-img">
                                        <iframe class="video-player" scrolling="no" frameborder="0" width="100%" height="500" src="<?php echo $video->url; ?>"></iframe>
                                    </div>
									<div class="pull-left">
										<!-- VOTE SYSTEM AND OTHERS -->
									</div>
                                </div><!-- panel-body -->
                            </div><!-- panel-blog -->

                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <div class="blog-sidebar">


                                <div class="panel panel-theme shadow">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $language->get('Categories'); ?></h3>
                                    </div>
                                    <div class="panel-body no-padding">
                                        <div class="list-group no-margin">
											<?php foreach(explode(', ', $video->categories) as $cat) : ?>
												<a href="/categories/<?php echo strtolower($cat); ?>" class="list-group-item"><?php echo $cat; ?></a>
											<?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-theme shadow">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><?php echo $language->get('Tags'); ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-inline blog-tags">
											<?php foreach(explode(' ', $video->tags) as $tag) : ?>
												<li>
													<a href="/search?keywords=<?php echo $tag; ?>"><i class="fa fa-tags"></i> <?php echo $tag; ?></a>
												</li>
											<?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                            </div><!-- blog-sidebar -->
                        </div>

                    </div><!-- row -->

                </div><!-- /.body-content -->
                <!--/ End body content -->