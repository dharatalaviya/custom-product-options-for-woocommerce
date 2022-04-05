<?php 
// Available Fields HTML 
if(empty($available_fieldslist)) return; ?>
<div id="jem-field-draggable-wrapper">
    <ul id="available-fields-ul">
        <?php foreach ($available_fieldslist as $availablefields) { ?>
            <li class="jem-field-draggable" data-slug="<?php echo $availablefields['slug']; ?>">
                <div class="jem-field-header d-flex justify-content-between">
                    <span>
                        <i class="fa <?php echo $availablefields['icon']?>" aria-hidden="true"></i>
                        <?php echo _e($availablefields['title'], 'jem-cpow'); ?>
                    </span>
                    <span class="jem-field-inside">
                        <a href="" class="text-white btn-link p-1 edit_fields">
                            <i class="fa fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="text-white btn-link p-1 jem-delete-field">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="text-white btn-link p-1 jem-clone-field">
                            <i class="fa fa-clone" aria-hidden="true"></i>
                         </a>
                    </span>
                </div>
                <div class="jem-field-inside jem-field-textbox">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <input type="hidden" data-jem-field-name="field_type" class="jem-field" value="<?php echo $availablefields['slug']; ?>">
                            <input type="checkbox" class="jem-field form-check-input" data-jem-field-name="required">
                            <label class="form-check-label" for="exampleCheck1"><?php _e('Required', 'jem-cpow'); ?></label>
                        </div>
                        <?php 
                        if(!empty($availablefields['fields']) && is_array($availablefields['fields'])){
                            foreach ($availablefields['fields'] as $key => $value) { ?>
                                <div class="<?php echo  $value['classes']; ?>">
                                    <label><?php _e($value['label'], 'jem-cpow'); ?></label>
                                    <?php if ($value['type'] == 'textarea') { ?>
                                        <textarea data-jem-field-name="<?php echo $value['field_name']; ?>" class="jem-field form-control" placeholder="<?php echo $value['placeholder']; ?>"></textarea>
                                    <?php } elseif ($value['type'] == 'wp_editor') {
                                        $content = '';
                                        $editor_id = $value['field_name']; ?>
                                        <textarea id="jemwpeditor" data-jem-field-name="<?php echo $value['field_name']; ?>" class="jem-wpeditor jem-field form-control" placeholder="<?php echo $value['placeholder']; ?>"></textarea>
                                    <?php } elseif ($value['type'] == 'options_list') { ?>
                                        <textarea data-jem-field-name="<?php echo $value['field_name']; ?>" class="jem-field form-control" placeholder="<?php echo $value['placeholder']; ?>"></textarea>
                                    <?php } elseif ($value['type']== 'header_field') {
                                        $headings = array('h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6'); ?>
                                        <select class="jem-field form-control" data-jem-field-name="<?php echo $value['field_name']; ?>">
                                            <option value=""><?php echo $value['placeholder']; ?></option>
                                            <?php foreach ($headings as $ar => $heading) { ?>
                                                <option value="<?php echo $ar; ?>"><?php echo $heading; ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input type="<?php echo $value['type']; ?>" data-jem-field-name="<?php echo $value['field_name']; ?>" class="jem-field form-control" placeholder="<?php echo $value['placeholder']; ?>">
                                    <?php } ?>
                                </div>
                            <?php
                            }     
                        }  ?>
                    <div class="hidden_textbox">
                        <input type="hidden" name="jem_field_type[][jem_text_type]" class="form-control">
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>