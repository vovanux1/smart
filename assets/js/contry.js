jQuery(document).ready(function() {
jQuery.get( "/geo/sxgeo_sample.php?"+Math.random(), function( data ) {
	if (data){
		jQuery('.geo-'+data).show();
	} else {
		jQuery('.geo-DEF').show(); 
	}
});
});