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
                                <a href=""><?php echo $language->get('Members'); ?></a>
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
                        </div>
                    </div>

					<div class="row">
					
					<?php foreach($members as $member) : ?>
                    
                    <div class="col-lg-3 col-md-3 col-sm-4">

                        <div class="panel rounded shadow">
                            <div class="panel-body">
                                <div class="inner-all">
                                    <ul class="list-unstyled">
                                        <li class="text-center">
                                            <img class="img-circle img-bordered-primary" src="<?php echo Url::templatePath() . $member->avatar; ?>" alt="<?php echo $member->realname; ?>">
                                        </li>
                                        <li class="text-center">
                                            <h4 class="text-capitalize"><?php echo $member->realname; ?></h4>
                                            <p class="text-muted text-capitalize">
												<?php echo $this->language->get('profile_'.$member->gender); ?>
												<br>
												<?php echo $this->language->get('Looking for: ');?><?php echo $this->language->get(implode(', ', $register->getLookingforLabel($member->lookingfor))); ?>
											</p>
                                        </li>
                                        <li>
											<?php if((strtotime(date('Y-m-d H:i:s')) - strtotime($member->activity)) <= 300) : ?>
												<span class="btn btn-success text-center btn-block"><?php echo $this->language->get('ONLINE'); ?></span>
											<?php else : ?>
												<span class="btn btn-danger text-center btn-block">
													<?php echo $this->language->get('OFFLINE'); ?>
													<?php echo $register->dateDisconnected($member->activity); ?>
												</span>
											<?php endif; ?>
                                            
                                        </li>
                                        <li><br/></li>
                                        <li>
                                            <div class="btn-group-vertical btn-block">
                                                <a href="/members?id=<?php echo $member->id; ?>" class="btn btn-default"><i class="fa fa-sign-out pull-right"></i><?php echo $this->language->get('View Profile'); ?></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.panel -->
					
					</div>
		
					<?php endforeach; ?>
						
					</div>
					
					
					<div class="text-center">
						<?php echo $pageLinks; ?>
					</div>

                </div><!-- /.body-content -->
                <!--/ End body content -->

