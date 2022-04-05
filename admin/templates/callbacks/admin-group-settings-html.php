<?php 
// Grup Settings HTML    

if( empty($group_settings) ) return; ?>
<nav class="mt-3">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <?php
           if(!empty($group_settings['tabs'])){ 
            foreach($group_settings['tabs'] as $tab){ ?>    
                <a class="nav-item nav-link <?php echo ($tab['active'] == true)?'active': ''; ?>" id="<?php echo $tab['id']; ?>" data-toggle="tab" href="#<?php echo $tab['id'];?>_redirect" role="tab" aria-controls="nav-home" aria-selected="true"> 
                   <?php echo $tab['title']; ?> 
                </a>
        <?php } 
        } ?>
      
    </div>
</nav>
<div class="tab-content tab-content-customize" id="nav-tabContent">
    <div class="tab-pane fade show active" id="group_settings_redirect" role="tabpanel" aria-labelledby="group_setting">
        <div class="row">
            <div class="col-sm-6 col-xs-6 form-group">
                <label for="cpt_first_meta_field"><?php echo _e( 'Title Text', 'jem-spow' ); ?></label>
                <input class="form-control" type="text" id="cpt_first_meta_field" placeholder="Enter Title Text" name="cpt_first_meta_field" value="<?php echo esc_attr( $group_settings['textTitle'] ) ?>"   />
            </div>
            <div class="col-sm-6 col-xs-6 form-group">
                <label for="cpt_class_meta_field"><?php echo  _e( 'CSS Class', 'cpt_domain' ) ?></label>
                <input class="form-control" type="text" id="cpt_class_meta_field" placeholder="Enter Css Class" name="cpt_class_meta_field" value="<?php echo esc_attr( $group_settings['textClass'] ); ?>"   />
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="display_settings_redirect" role="tabpanel" aria-labelledby="display_setting">
        <form class="row" action="/action_page.php">
            <div class="col-sm-6">
                <div class="productRuleWrapper mb-4">
                    <h5><?php echo _e( 'Product Display Rules', 'jem-spow' ); ?></h5>
                    <div class="form-group">
                        <label for="group1">Show this group of fields if</label>
                        <div class="form-check">
                            <input <?php echo ($group_settings['productDisplayRule'] == 'incl') ? 'checked' : ''; ?> class="form-check-input" type="radio" name="productDisplayRule" id="productIsIn" value="incl">
                            <label class="form-check-label" for="productIsIn"> Product is in</label>
                        </div>
                        <div class="form-check">
                            <input <?php echo ($group_settings['productDisplayRule'] == 'excl') ? 'checked':''; ?> class="form-check-input" type="radio" name="productDisplayRule" id="productIsNotIn" value="excl">
                            <label class="form-check-label" for="productIsNotIn">Product is not in</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectProduct">Select Products</label>
                        <?php $products = $group_settings['products']; 
                       	    if( !empty( $products ) ) { ?>
                        	<select name="selected_products[]" style="width: 100%" multiple class="form-control" id="selected_products" aria-describedby="selectProduct" placeholder="Selected Product">
                                <option value="">Select Products</option>
                                <?php foreach( $products as $product ){ ?>
                                	<option <?php echo (in_array($product->get_ID(), $group_settings['selected_products'])) ? 'selected=selected' : ''; ?> value="<?php echo $product->get_ID(); ?>">
                                    	<?php echo $product-> get_title(); ?>
                                    </option>
                                <?php }  ?>            
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <div class="productRuleWrapper">
                    <h5>Category Display Rules</h5>
                    <div class="form-group">
                        <label for="group2">Show this group of fields if</label>
                        <div class="form-check">
                            <input <?php echo ($group_settings['categoryDisplayRule'] == 'incl') ? 'checked' : '' ?> class="form-check-input" type="radio" name="categoryDisplayRule" id="productIsIn1" value="incl">
                            <label class="form-check-label" for="productIsIn1"> Product is in </label>
                        </div>
                        <div class="form-check">
                            <input <?php echo ($group_settings['categoryDisplayRule'] == 'excl') ? 'checked' : '' ?> class="form-check-input" type="radio" name="categoryDisplayRule" id="productIsIn2" value="excl">
                            <label class="form-check-label" for="productIsIn2"> Product is not in </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectProduct">Select Products Categoies</label>
                        <?php $products_Categories = $group_settings['products_Categories'];
                        if(!empty($products_Categories)){ ?>
                            <select style="width: 100%" multiple name="selected_terms[]" id="selected_terms">
                                <?php  foreach($products_Categories as $category){ ?>
                                    <option <?php echo (in_array($category->term_id, $group_settings['selected_terms'])) ? "selected=selected" : "" ?> value="<?php echo $category->term_id; ?>">
                                        <?php echo $category->name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="display_logic_redirect" role="tabpanel" aria-labelledby="display_logic">
        <div class="row">
            <div class="col-xl-3 form-group">
                <label for="enable_display" class="jem_label">Enable Display Logic</label>
            </div>    
             <?php 
                $checked =  (isset($group_settings['jem_display_enabled']) && $group_settings['jem_display_enabled'] == 'on') ? 'checked': '';
                $disabled =  (isset($group_settings['jem_display_enabled']) && $group_settings['jem_display_enabled'] == 'off') ? 'disabled': ''; ?>
            <div class="col-xl-2 form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input enabled-check" name="jem_display_enabled"  data-size="lg" id="customSwitch1" <?php echo $checked; ?>>
                    <label class="custom-control-label" for="customSwitch1"></label>
                </div>
            </div>
        </div>
        <div class="row disable-logic">
            <div class="col-xl-4 form-group">
                <div class="form-group">
                    <label for="group1" class="jem_label">Show OR Hide this group?</label>
                     <select name="jem_display_logic_group[show_or]" class="form-control" <?php echo $disabled; ?>>
                        <option value="show" <?php echo ($group_settings['jem_display_logic_group']['show_or'] =='show') ? 'selected': ''; ?> >Show this Group if</option>
                        <option value="hide" <?php echo ($group_settings['jem_display_logic_group']['show_or'] =='hide') ? 'selected': ''; ?> >Hide this Group if</option>
                    </select>
                </div>    
            </div>
        </div>  
        <div class="row disable-logic">
            <div class="col-xl-12">
                <label for="group1" class="jem_label">If these Conditions are true</label>
            </div>
            <div class="col-xl-12 display_logic_field_list">
                <?php 
                if(empty($group_settings['jem_display_logic_group']['fields'])){ ?>
                <div class="row form-group">
                    <div class="col-xl-3">
                        <select name="jem_display_logic_group[fields][0][field]" class="form-control jem_display_fields"  <?php echo $disabled; ?>>
                            <option value="">Fields</option>
                            <?php foreach($group_settings['fieldslist']  as $field){?>
                            <option value="<?php echo $field['field_type']; ?>" ><?php echo get_field_title($field['field_type']); ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col-xl-3">
                        <select name="jem_display_logic_group[fields][0][relation]" class="form-control display_comparision"  <?php echo $disabled; ?>>
                            <option value="">Comparision</option>
                        </select>
                    </div>
                    <div class="col-xl-3 jem_display_logic_value">
                        <input type="text" name="jem_display_logic_group[fields][0][value]" class="form-control jem_display_value">
                    </div>
                    <div class="col-xl-2"> 
                        <select name="jem_display_logic_group[fields][0][and_or]" class="form-control jem_display_andor "  <?php echo $disabled; ?>>
                            <option value="">AND</option>
                            <option value="text_field">OR</option>
                        </select>
                    </div>
                    <div class="col-xl-1">
                        <span class="dashicons dashicons-trash trash-field"></span>
                    </div>
                </div>
            <?php }else{ 
                    $count = 0;
                     $disabled_c = ($disabled == 'disabled') ? true : false;
                     
                    foreach($group_settings['jem_display_logic_group']['fields'] as $fields){ 
                        $value = isset($fields['value']) ? $fields['value'] : '';
                       
                        $conditions = get_fields_conditions( $fields['field'], $value, $count, $disabled_c);
                    ?>
                  <div class="row form-group">
                    <div class="col-xl-3">
                        <select name="jem_display_logic_group[fields][<?php echo $count; ?>][field]" class="form-control jem_display_fields"  <?php echo $disabled; ?>>
                            <option value="">Fields</option>
                            <?php foreach($group_settings['fieldslist']  as $field){?>
                            <option value="<?php echo $field['field_type']; ?>" 
                                <?php echo (isset($fields['field']) && $fields['field'] == $field['field_type']) ? 'selected' : '';?> >
                                <?php echo get_field_title($field['field_type']); ?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col-xl-3">
                        <select name="jem_display_logic_group[fields][<?php echo $count; ?>][relation]" class="form-control display_comparision"  <?php echo $disabled; ?>>
                            <?php if(!empty($conditions)){
                                foreach($conditions as $key => $value){
                                    $select = (isset($fields['relation']) && $fields['relation'] == $key) ? 'selected' : '';
                                     echo '<option value="'.$key.'"'.$select.'>'.$value['title'].'</option>';
                                } 
                            } ?>
                        </select>
                    </div>
                    <div class="col-xl-3 jem_display_logic_value">
                        <?php echo $conditions[$fields['relation']]['value_field']; ?>
                    </div>
                    <div class="col-xl-2"> 
                        <select name="jem_display_logic_group[fields][<?php echo $count; ?>][and_or]" class="form-control jem_display_andor"  <?php echo $disabled; ?>>
                            <option value="and" <?php echo (isset($fields['and_or']) && $fields['and_or'] == 'and') ? 'selected' : '';?> >AND</option>
                            <option value="or" <?php echo (isset($fields['and_or']) && $fields['and_or'] == 'or') ? 'selected' : '';?> >OR</option>
                        </select>
                    </div>
                    <div class="col-xl-1">
                        <span class="dashicons dashicons-trash trash-field <?php echo ($disabled == 'disabled')? 'disabled': 'active' ?>" ></span>
                    </div>
                </div>
                <?php $count++; }
                } ?>
            </div>
        </div>     
        <div class="row disable-logic">
            <div class="col-xl-12 form-group">
                <button type="button" class="btn btn-primary jem_addline_btn" id="jem_addline_btn"  <?php echo $disabled; ?>>Add Line</button>
            </div>    
        </div>      
    </div>    
</div>