jQuery(document).ready(function($){
    var custom_uploader;
    $('.upload').click(function(e) {
        var id = $(this).attr('id');
        $('input[name="currentOption"]').val(id);
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose File',
            button: {
                text: 'Choose File'
            },
            multiple: false,
            library: {
                    type: [ 'application/*']
            },
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var currentOption = $('input[name="currentOption"]').val();
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('input[name="'+currentOption+'"]').val(attachment.url);
            $('#'+currentOption).parent().find('.edit-file').html(attachment.filename);
            $('#'+currentOption).parent().find('.filename').removeClass('hide');
            $('#'+currentOption).parent().find('#id').val(attachment.id);
            $('#'+currentOption).parent().find('#manual-url').val('').attr('disabled','disabled');
            $('#'+currentOption).addClass('hide');
        });
        custom_uploader.on('open',function() {
            var currentOption = $('input[name="currentOption"]').val();
            // On open, get the id from the hide input
            // and select the appropiate images in the media manager
            var selection =  custom_uploader.state().get('selection');
            imageId = $('#'+currentOption).parent().find('#id').val();
            // console.log(imageId);
            if(imageId.length > 0) {
              attachment = wp.media.attachment(imageId);
              attachment.fetch();
              selection.add( attachment ? [ attachment ] : [] );
            }
        });
        //Open the uploader dialog
        custom_uploader.open();
    });

    $('.edit-file').click(function(e) {
        var cls = $(this).data('class');
        $('input[name="currentOption"]').val(cls);
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose File',
            button: {
                text: 'Choose File'
            },
            multiple: false,
            library: {
                    type: [ 'application/*']
            },
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var currentOption = $('input[name="currentOption"]').val();
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('input[name="'+currentOption+'"]').val(attachment.url);
            $('#'+currentOption).parent().find('.edit-file').html(attachment.filename);
            $('#'+currentOption).parent().find('.filename').removeClass('hide');
            $('#'+currentOption).parent().find('#id').val(attachment.id);
            $('#'+currentOption).parent().find('#manual-url').val('').attr('disabled','disabled');
            $('#'+currentOption).addClass('hide');
        });
        custom_uploader.on('open',function() {
            var currentOption = $('input[name="currentOption"]').val();
            // On open, get the id from the hide input
            // and select the appropiate images in the media manager
            var selection =  custom_uploader.state().get('selection');
            imageId = $('#'+currentOption).parent().find('#id').val();
            if(imageId.length > 0) {
              attachment = wp.media.attachment(imageId);
              attachment.fetch();
              selection.add( attachment ? [ attachment ] : [] );
            }
        });
        //Open the uploader dialog
        custom_uploader.open();
    });

    $('.fa-remove').click(function(){
        $(this).parent().addClass('hide');
        $(this).parent().parent().find('#id').val('');
        $(this).parent().parent().find('#title').val('');
        $(this).parent().parent().find('#url').val('');
        $(this).parent().parent().find('.upload').removeClass('hide');
        $(this).parent().parent().find('#manual-url').removeAttr('disabled');
    });
});