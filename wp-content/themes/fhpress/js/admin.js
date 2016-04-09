jQuery(document).ready(function($) {
	if( $('.dropzone').length > 0 ){
		var shareThumbUpload = new Dropzone('.dropzone', { url: "/wp-content/themes/fhpress/theme-functions/file-upload.php" });
	
		Dropzone.autoDiscover = false;
	
		shareThumbUpload.on('success', function( file, response ) {
			$('#share_thumb').val(response);
			$('.dz-message').html('image upload successful!');
		});
	}
});