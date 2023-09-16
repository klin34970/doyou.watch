			<!-- START @PAGE CONTENT -->
            <section id="page-content"> 


                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-picture-o"></i><?php echo $language->get('Title Content Change password'); ?><span><?php echo $language->get('Title Sub Content Change password'); ?></span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label"><?php echo $language->get('You are here'); ?>:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="/"><?php echo $language->get('Home'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">
                                <a href=""><?php echo $language->get('Change password'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->
				
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

					<div class="row">
						<div class="col-md-offset-4 col-md-4">
							<?php echo Errors::display($error); ?>
							<?php echo Session::message('message'); ?>
						   <!-- Login form -->
							<form class="change-password form-horizontal shadow rounded no-overflow" action="" method="post">
								<div class="sign-header">
									<div class="form-group">
										<div class="sign-text">
											<span><?php echo $language->get('Change Password'); ?></span>
										</div>
									</div><!-- /.form-group -->
								</div><!-- /.sign-header -->
								<div class="sign-body">
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="password" class="form-control input-sm" placeholder="<?php echo $language->get('Current password'); ?>" name="password" required="required">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										</div>
									</div><!-- /.form-group -->
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="password" class="form-control input-sm" placeholder="<?php echo $language->get('New password'); ?>" name="newPassword" required="required">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										</div>
									</div><!-- /.form-group -->
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="password" class="form-control input-sm" placeholder="<?php echo $language->get('New password again'); ?>" name="verPassword" required="required">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										</div>
									</div><!-- /.form-group -->
								</div><!-- /.sign-body -->
								<div class="sign-footer">
									<div class="form-group">
										<button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded" id="login-btn"><?php echo $language->get('Save'); ?></button>
									</div><!-- /.form-group -->
								</div><!-- /.sign-footer -->
								<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>" />
							</form><!-- /.form-horizontal -->
							<!--/ Login form -->

						</div>
					</div>

                </div><!-- /.body-content -->
                <!--/ End body content -->
