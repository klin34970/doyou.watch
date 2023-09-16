            <aside id="sidebar-left" class="sidebar-circle">

                <!-- Start left navigation - menu -->
                <ul class="sidebar-menu">

					<?php echo $menu->getProfile($user); ?>

                    <?php echo $menu->getMenuHome($user); ?>

					<?php echo $menu->getMenuCategories($user); ?>
					
					<?php echo $menu->getMenuProviders($user); ?>
					
					<?php echo $menu->getMenuMembers($user); ?>

                </ul><!-- /.sidebar-menu -->
                <!--/ End left navigation - menu -->

                <!-- Start left navigation - footer -->
                <div class="sidebar-footer hidden-xs hidden-sm hidden-md">
                    
                    <a id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen">
						<i class="fa fa-desktop">
						</i>
					</a>
					<?php echo $menu->buttonLogout($user); ?>
                </div><!-- /.sidebar-footer -->
                <!--/ End left navigation - footer -->

            </aside><!-- /#sidebar-left -->
            <!--/ END SIDEBAR LEFT -->