			<!-- START @PAGE CONTENT -->
            <section id="page-content"> 


                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-picture-o"></i><?php echo $language->get('Title Content Register'); ?><span><?php echo $language->get('Title Sub Content Register'); ?></span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label"><?php echo $language->get('You are here'); ?>:</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="/"><?php echo $language->get('Home'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">
                                <a href=""><?php echo $language->get('Register'); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->
				
                <!-- Start body content -->
                <div class="body-content animated fadeIn">

					<div class="row">
						<div class="col-md-offset-3 col-md-5">

							<?php echo Errors::display($error); ?>
							<?php echo Session::message('message'); ?>
							
							<!-- Register form -->
							<form class="sign-up form-horizontal rounded shadow no-overflow" action="" method="post">
								<div class="sign-header">
									<div class="form-group">
										<div class="sign-text">
											<span><?php echo $language->get('Create a new account'); ?></span>
										</div>
									</div>
								</div>
								<div class="sign-body">
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<select class="form-control" name="gender">
												<option <?php if(isset($session['gender']) && $session['gender'] == 'Men') echo 'selected'; ?> value="Men"><?php echo $language->get('I\'m a Men'); ?></option>
												<option <?php if(isset($session['gender']) && $session['gender'] == 'Women') echo 'selected'; ?> value="Women"><?php echo $language->get('I\'m a Women'); ?></option>
												<option  <?php if(isset($session['gender']) && $session['gender'] == 'Couple') echo 'selected'; ?>value="Couple"><?php echo $language->get('We are a Couple'); ?></option>
											</select>
											<span class="input-group-addon"><i class="fa fa-intersex"></i></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4"><?php echo $language->get('Looking for :'); ?></label>
										<div class="col-sm-8">
											<div class="ckbox ckbox-theme inline mr-10">
												<input <?php if(isset($session['lookingformen']) && $session['lookingformen'] != '') echo 'checked'; ?> id="male" name="lookingformen" type="checkbox" value="1">
												<label for="male"><?php echo $language->get('Men'); ?></label>
											</div>
											<div class="ckbox ckbox-theme inline">
												<input <?php if(isset($session['lookingforwomen']) && $session['lookingforwomen'] != '') echo 'checked'; ?> id="female" type="checkbox" name="lookingforwomen" value="2">
												<label for="female"><?php echo $language->get('Women'); ?></label>
											</div>
											<div class="ckbox ckbox-theme inline">
												<input <?php if(isset($session['lookingforcouple']) && $session['lookingforcouple'] != '') echo 'checked'; ?> id="couple" type="checkbox" name="lookingforcouple" value="4">
												<label for="couple"><?php echo $language->get('Couple'); ?></label>
											</div>
										</div>
									</div>			
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="text" name="username" class="form-control" placeholder="<?php echo $language->get('Username'); ?>" value="<?php if(isset($session['username']) && $session['username'] != '') echo $session['username']; ?>">
											<span class="input-group-addon"><i style="width: 15px;" class="fa fa-user"></i></span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="text" name="realname" class="form-control" placeholder="<?php echo $language->get('Realname'); ?>" value="<?php if(isset($session['realname']) && $session['realname'] != '') echo $session['realname']; ?>">
											<span class="input-group-addon"><i style="width: 15px;" class="fa fa-user"></i></span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input style="font-size: 13px;" name="age" class="form-control input-mask" placeholder="<?php echo $language->get('Age'); ?>" data-inputmask="'alias': 'date'" value="<?php if(isset($session['age']) && $session['age'] != '') echo $session['age']; ?>">
											<span class="input-group-addon"><i style="width: 15px;" class="fa fa-calendar"></i></span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $language->get('Password'); ?>">
											<span class="input-group-addon"><i style="width: 15px;" class="fa fa-lock"></i></span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="password" name="password2" class="form-control" placeholder="<?php echo $language->get('Confirm password'); ?>">
											<span class="input-group-addon"><i style="width: 15px;" class="fa fa-check"></i></span>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group input-group-lg rounded no-overflow">
											<input type="email" name="email" class="form-control" placeholder="<?php echo $language->get('Your email'); ?>" value="<?php if(isset($session['email']) && $session['email'] != '') echo $session['email']; ?>">
											<span class="input-group-addon"><i style="width: 15px;" class="fa fa-envelope"></i></span>
										</div>
									</div>
								</div>
								<div class="sign-footer">
									<div class="form-group">
										<div class="callout callout-info no-margin">
											<p class="text-muted">
											<?php echo $language->get('To confirm and activate your new account, we will need to send the activation code to your e-mail'); ?>
											</p>
										</div>
									</div>
									<div class="form-group">
										<div class="ckbox ckbox-theme">
											<input <?php if(isset($session['tos']) && $session['tos'] != '') echo 'checked'; ?> id="term-of-service" name="tos" value="1" type="checkbox">
											<label for="term-of-service" class="rounded"><?php echo $language->get('I agree with'); ?> <a href="#"><?php echo $language->get('Term Of Service'); ?></a></label>
										</div>
										<div class="ckbox ckbox-theme">
											<input <?php if(isset($session['newsletter']) && $session['newsletter'] != '') echo 'checked'; ?> id="newsletter" name="newsletter" value="1" type="checkbox">
											<label for="newsletter" class="rounded"><?php echo $language->get('Send me newsletter'); ?></label>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded"><?php echo $language->get('Sign Up'); ?></button>
									</div>
								</div>
								
								<input type="hidden" name="csrfToken" value="<?php echo $csrfToken; ?>" />
								
							</form>
							<!--/ Register form -->

							<!-- Content text -->
							<p class="text-muted text-center sign-link"><?php echo $language->get('Already have an account?'); ?> <a href="/signin"> <?php echo $language->get('Sign in here'); ?></a></p>
							<!--/ Content text -->

						</div>
					</div>

                </div><!-- /.body-content -->
                <!--/ End body content -->