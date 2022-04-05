 jQuery(document).ready(function($){
    //Click handler - you might have to bind this click event another way
    $('input#publish, input#save-post').click(function(){
        tinyMCE.triggerSave();
        var data2 = $('form.save_jem').serializeArray();
        data2.push({action: 'save_jem_fields'});
        jQuery.post(ajaxurl, data2, function(response) {
            var opt = '<option value=publish>Publish</option>';
            $('#post_status').prepend(opt);
            $('#post_status').val('publish');
            $('form#post').submit();
        });
    return false;
    });
});