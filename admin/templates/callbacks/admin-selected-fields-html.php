<?php // Selected fields HTML ?>

<form class='save_jem' action='<?php echo admin_url('admin-post.php'); ?>' method='post'>
 	<input type='hidden' class='jem-field' name='post_id' value='<?php echo get_the_ID() ?>'>
    <input type='hidden' name='action' value='jem_save_fields'>
     <div>
        <ul id="jem-selected-fields-container">
            <?php 
            if (!empty($selected_fields)) {
                foreach ($selected_fields as $key => $field) { ?>
                   	<li class="jem-field-draggable jem-field-selected <?php echo $key; ?>">
            			<div class="jem-field-header d-flex justify-content-between">
	                        <span>
	                            <i class="fa <?= $field['icon']; ?>" aria-hidden="true"></i>
	                            <?php  echo _e($field['title'], 'jem-cpow'); ?>
	                        </span>
	                        <span class="jem-field-inside">
	                            <a href="" class="text-white btn-link p-1 edit_fields">																																																																
	                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	                            </a>
	                            <a href="#" class="text-white btn-link p-1 jem-delete-field">
	                                <i class="fa fa-trash-o" aria-hidden="true"></i>
	                            </a>
	                            <a href="#" class="text-white btn-link p-1 jem-clone-field">
	                                <i class="fa fa-clone" aria-hidden="true"></i>
	                            </a>
	                        </span>
            			</div>
            			<?php if(!empty($field['tabs'])){ ?>
	            			<div class="jem-field-inside jem-field-textbox jem-hide">
	            				<nav class="mt-3">
							    <div class="nav nav-tabs" id="nav-tab" role="tablist">
							       <?php foreach($field['tabs'] as $tab){ ?>
							        <a class="nav-item nav-link <?php echo (isset($tab['active']) && $tab['active'] == 'true')?'active':'';?>" id="fields-tab-<?php echo $field['unique_name']; ?>" data-toggle="tab" href="#<?php echo $tab['id']."_".$field['unique_name']; ?>" role="tab" aria-controls="nav-home" aria-selected="true"> 
							        	<?php _e( $tab['name'], 'jem-spow' ); ?> 
							        </a>
							    <?php } ?>
							    </div>
								</nav>
								 <?php foreach($field['tabs'] as $tab){ ?>
								 <div class="tab-pane fade <?php echo (isset($tab['active']) && $tab['active']=='true')?'show active':'';?>" id="<?php echo $tab['id']."_".$field['unique_name']; ?>" role="tabpanel" aria-labelledby="<?php echo $tab['id']; ?>">
		                			<div class="row">
						                <div class="form-group col-sm-12">
		                				    <input type="hidden" data-jem-field-name="field_type" class="jem-field"
		                               value="<?php echo $key; ?>">
						                    <?php 
						                    if (!$field['hide_require'] && $tab['id'] =='basic_settings') { ?>
						                        <input <?php echo $field['required_checked']; ?> type="checkbox" class="jem-field form-check-input" data-jem-field-name="required">
						                            <label class="form-check-label" for="exampleCheck1">
						                                <?php _e('Required', 'jem-cpow'); ?></label>
						                    <?php } ?>
		                    			</div>
		                     			<?php foreach ($tab['fields'] as $fd) { ?>
		                    				<div class="<?php echo $fd['classes']; ?>">
									            <label><?php _e($fd['label'], 'jem-cpow'); ?></label>
									            <?php 
									            $fd['data'] = true;
									            echo jem_cpow_get_fields($fd); ?>
			        						</div>
		                     			<?php } ?>
					                    <div class="hidden_textbox">
					                        <input value="<?php echo $field['unique_name']; ?>" type="hidden" name="jem_field_type[][jem_text_type]"
					                               class="form-control">
					                    </div>
					                </div>
					            </div>
					            <div class="tab-pane fade" id="price_tab_<?php echo $field['unique_name']; ?>" role="tabpanel" aria-labelledby="display_setting">
					            </div>	
					             <div class="tab-pane fade" id="conditional_tab_<?php echo $field['unique_name']; ?>" role="tabpanel" aria-labelledby="display_setting">
					            </div> 
			       		<?php } ?>
			       		</div>
			       	<?php } ?>
        			</li>
                <?php }
            } ?>
        </ul>
    </div>
</form>
<!-- Now render our modal. Alert before deleting field group --> 
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo __('Are you sure','jem-cpow');?></h5>
      </div>
      <div class="modal-body"><?php echo __('Please confirm you wish to delete this item', 'jem-cpow'); ?></div>
      <div class="modal-footer">
        <button id="modalCancel" type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __('Cancel','jem-cpow'); ?></button>
        <button id="modalConfirm" type="button" class="btn btn-danger" data-dismiss="modal"><?php echo __('Delete','jem-cpow'); ?></button>
      </div>
    </div>
  </div>
</div>
<!--Modal: modalConfirmDelete-->