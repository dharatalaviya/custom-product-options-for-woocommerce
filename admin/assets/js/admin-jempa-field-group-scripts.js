var $ = jQuery.noConflict();

jQuery(document).ready(function ($) {


    //Set up the click events etc
    initClickHandlers();

    //TODO This all needs refactoring
    //=========== SELECTED FIELDS CONTAINER ===========//
    
    $("#jem-selected-fields-container").sortable({
        placeholder: 'jem-fields-selected-placeholder',
        revert: true,
        helper: 'clone',
        update: function (event, ui) {
            addFieldToSelectedFields(ui);
        }
    });

    //=========== Draggable js===========//
    jQuery("#sortable").disableSelection();
    jQuery(".jem-field-draggable").draggable({
        connectToSortable: "#jem-selected-fields-container",
        //helper: "clone",
        helper: function (event) {

            //$(".jem_display_fields").append("<option>"+$(this).attr('data-slug')+"</option>");
    
            var li = $(event.target).closest("li");

            return $(li).clone().css({
                width: $(li).width()
            })
        },
        revert: "invalid"
    });
    jQuery('ul#jem-selected-fields-container li').draggable('destroy');

    renameSelectedFields();

    jQuery('#selected_products').select2();
    jQuery('#selected_terms').select2();
    jQuery(document).on('click', '.edit_fields', function(){
        return false;
    });
    jQuery('.detect_input_label').keyup(function(){
        jQuery(this).parent().parent().parent().parent().find('.changing_lbl').text(jQuery(this).val());
       });
    jQuery(document).on('click', '.add_row', function(){
        var tbc = jQuery('.clone_tobe').html();
        jQuery('.clonned_items').prepend('<div class="cloned">'+tbc+'</div>');
        renameRadioOptions();
        return false;
    });
    jQuery(document).on('click', '.cloz', function(){
        var r = confirm("Are you sure?");
        if(r)
        {
           // alert('yes')
           jQuery(this).parent().parent().fadeOut('slow').remove();
        }
        renameRadioOptions();
        return false;
    });
    jQuery('.jem-clone-field').click(function(){
        var li = jQuery(this).parent().parent().parent();
        var $clone = li.clone();
        $clone.find('input[data-jem-field-name="unique_name"]').val('');
        $clone.insertAfter(li);
        renameSelectedFields();
        return false;
    });

    jQuery('#customSwitch1').click(function(){
        if($(this).prop("checked") == false){
            $(".disable-logic").find("input, select, textarea, button, label").prop('disabled',true);
            $(".trash-field").addClass("disabled");
            $(".trash-field").removeClass("active");
        }
        else{
            $(".disable-logic").find("input, select, textarea, button, label").prop('disabled',false);
            $(".trash-field").removeClass("disabled");
            $(".trash-field").addClass("active");
        }
    });

    jQuery('#jem_addline_btn').click(function(){
        var fielddata = jQuery(".display_logic_field_list .row").last();
        var count = jQuery(".display_logic_field_list .row").length;
        
        var clone = fielddata.clone();
        clone.find('input[type=text], select').val('');
        clone.find('.jem_display_fields').attr('name', "jem_display_logic_group[fields]["+count+"][field]");
        clone.find('.display_comparision').attr('name', "jem_display_logic_group[fields]["+count+"][relation]");
        clone.find('.jem_display_value').attr('name', "jem_display_logic_group[fields]["+count+"][value]");
        clone.find('.jem_display_andor').attr('name', "jem_display_logic_group[fields]["+count+"][and_or]");
        clone.appendTo(".display_logic_field_list");
    });
    
    jQuery(document).on('change', '.jem_display_fields', function(){
        var field_type = jQuery(this).find(':selected').val();
        var fields_condition = fields_conditions[field_type];
        var comparision = $(this).parent().parent().find('.display_comparision');
        comparision.attr('data-fieldtype', field_type);
        if(fields_condition != ''){
            comparision.empty();
            $.each(fields_condition, function(key, value){       
                comparision.append('<option value="'+key+'">'+value['title']+'</option>');
            });
            comparision.prop("selectedIndex", 0).change();
        }
    });

    jQuery(document).on('change', '.display_comparision', function(){    
        var valuefield = $(this).find(':selected').val();
        var fieldtype = $(this).attr('data-fieldtype');
        $(this).parent().parent().find('.jem_display_logic_value').html(fields_conditions[fieldtype][valuefield]['value_field']);
        renamedisplayLogicSelectedFields();
        if(fields_conditions[fieldtype][valuefield]['add_js'] == 'datepicker'){
            $( ".jem_datepicker" ).datepicker();    
        }else if(fields_conditions[fieldtype][valuefield]['add_js'] == 'colorpicker'){
             $('.jem_colorpicker').wpColorPicker();
        }
        
    });
    $('.jem_colorpicker').wpColorPicker();
    $( ".jem_datepicker" ).datepicker();    
    jQuery(document).on('click', '.trash-field.active', function(){
        var r = confirm("Are you sure?");
        if(r)
        {
           // alert('yes')
           jQuery(this).parent().parent().fadeOut('slow').remove();
            renamedisplayLogicSelectedFields();
        }

        return false;
    });
}); //END Document Ready


/**
 * Turns on all the click handlers
 * We try and keep them in one place for clarity
 */
function initClickHandlers() {

    //When the header on a selected field is clicked
    $("#jem-selected-fields-container").on("click", ".jem-field-header", function () {
        selectedFieldHeaderClicked(this);
    });

    //When the DELETE FIELD icon is clicked
    $("#jem-selected-fields-container").on("click", ".jem-delete-field", function (e) {
        deleteFieldIconClicked(e, this);
    });

}
/**
 * Handles when a field is dropped on the selected fields...
 * @param ui
 */
function addFieldToSelectedFields(ui) {


    //Add the selected class so it gets displayed correctly!
    $(ui.item).addClass('jem-field-selected');

    //Go through each selected block and renumber the fields
    renameSelectedFields();
 
}

function renamedisplayLogicSelectedFields(){
    var count = 0;
    $('.jem_display_fields').each( function(){
        $(this).attr('name', 'jem_display_logic_group[fields]['+count+'][field]');
        count++;
    });
    
    var count = 0;
    $('.display_comparision').each( function(){
        $(this).attr('name', 'jem_display_logic_group[fields]['+count+'][relation]');
        count++;
    });
    
    var count = 0;
    $('.jem_display_value').each( function(){
        $(this).attr('name', 'jem_display_logic_group[fields]['+count+'][value]');
        count++;
    });
    
    var count = 0;
    $('.jem_display_andor').each( function(){
        $(this).attr('name', 'jem_display_logic_group[fields]['+count+'][and_or]');
        count++;
    });
}

/**
 * Renames the selected fields
 */
function renameSelectedFields(){
    $('#jem-selected-fields-container .jem-field-draggable').each(function (i) {
        $(this).find('.jem-field').each(function () {
            var jem_field_name = jQuery(this).data('jem-field-name');
        
            jem_field_name = "jem_fields[" + i + "][" + jem_field_name + "]";
            
            $(this).attr("name", jem_field_name);

            var edid = jQuery(this).attr('id');
            
            if(jQuery(this).hasClass('jem-wpeditor'))                   //initialised wp editor using jquery
            {
                $(this).attr("id", edid+'_'+i);
                wp.editor.initialize(
                    edid+'_'+i,
                    { 
                      tinymce: { 
                        wpautop:true, 
                        plugins : 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview', 
                        toolbar1: 'formatselect bold italic | bullist numlist | blockquote | alignleft aligncenter alignright | link unlink | wp_more | spellchecker' 
                      }, 
                      quicktags: true 
                    }
                  );
            }
        })
    });

}
/**
 *
 * @param header - which header is being clicked
 */
function selectedFieldHeaderClicked(header) {

    //Get the content field and toggle the show/hide
    var inside = $(header).next('.jem-field-inside');

    //$(inside).toggle(500);
   // $(inside).toggleClass("jem-hide");
   $(inside).slideToggle('slow');

}

/**
 * The delete icon on a selected field is clicked
 * @param e event
 * @param icon
 */
function deleteFieldIconClicked(e, icon) {

    //Stop the propagation
    e.stopPropagation();
    e.preventDefault();

    //Pop up a modal confirming we want to delete
    showConfirmModal(
        function () {
            deleteSelectedField(icon);
        },
        function () { /**do nothing **/
        }
    );

}

/**
 * Shows the confirm modal and returns true or false
 * depending on what the user pressed
 *
 * This is pretty slick - I made it so it is reusable amongst projects
 * Pass in 2 callbacks for yes and cancel
 */
function showConfirmModal(callbackYes, callbackCancel){

    //attach the handler
    var mc = $('#modalConfirm');

    $(mc).on('hide.bs.modal', function () {
        var activeElement = $(document.activeElement);

        //Cancel?
        if(activeElement.context.id == "modalCancel") {
            callbackCancel();
        } else {
            //must be a yes
            callbackYes();
        }

        //detach click handler
        $(mc).off('hide.bs.modal');
    });

    //Show it
    $(mc).modal();


}

/**
 * Deletes a selected field & renames fields
 * @param icon
 */
function deleteSelectedField(icon){

    //get the item to delete - the li element
    var li = $(icon).closest('li');

    //and delete it!
    $(li).remove();

    //And rename the fields
    renameSelectedFields();
}
 