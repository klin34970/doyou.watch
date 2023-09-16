<?php

namespace Helpers;

class Modal
{
	
	public static function smallPopUp($id, $title, $body)
	{
		echo 
				'
					<div id="'.$id.'" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;"> 
						<div class="modal-dialog modal-sm"> 
							<div class="modal-content"> 
							<div class="modal-header"> 
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button> 
								<h4 class="modal-title" id="mySmallModalLabel">'.$title.'</h4> 
							</div> 
								<div class="modal-body">'.$body.'</div> 
							</div> 
						</div> 
					</div>
					<script>
						$("#'.$id.'").modal()
					</script>
				';
	}
}


