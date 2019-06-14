jQuery(document).ready( function($){

	var mediaUploader;

	$('#upload-pic').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader ){
			mediaUploader.open();
			return;
		}

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture'
			},
			multiple: false
		});

    mediaUploader.on('select',function(){
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#profile-picture').val(attachment.url);
      $('#profile-picture-preview').css('background-image','url('+attachment.url+')');
    });

    mediaUploader.open();

	});
	$("#remove-pic").on('click',function(e) {
		e.preventDefault();
		var answer = confirm("Are You Sure Want To Delete The Image?");
		if(answer){
			$('#profile-picture').val('');
			$('.sidebar-options').submit();
		}
		return;
	})

});
