<?php
/*
Plugin Name: Picasa Upload
Plugin URI: http://wordpress.org/extend/plugins/picasa-upload/
Description: integrierter Upload zu Picasa Web beim verfassen von Artikel
Version: 0.6
Author: Pascal
Author URI: http://www.pascal90.de
Plugin URI: http://www.pascal90.de/2011/09/picasa-upload-wordpress-plugin/
*/

//laedt picasa in wordpress
function picasa_upload_scripts() {?> 
<script src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">

    // picker erstellen
    google.setOnLoadCallback(createPicker);
	//picker laden auf deutsch
    google.load('picker', '1', {'language':'de'});

    // Picasa Web Upload+Auswahl aus Alben
    function createPicker() {
        var picker = new google.picker.PickerBuilder().
			addView(google.picker.ViewId.PHOTO_UPLOAD).
            addView(google.picker.ViewId.PHOTOS).
			setSize(600,500).
			setTitle("Bild hochladen/ausw\u00e4hlen").
            setCallback(pickerCallback).
            build();
        picker.setVisible(true);
    }

    //picasa Daten einfügen
    function pickerCallback(data) {
		//
        var pw_imageurl = ((data.action == google.picker.Action.PICKED) ? data.docs[0].thumbnails[3].url : '');
		var pw_linkurl = ((data.action == google.picker.Action.PICKED) ? data.docs[0].thumbnails[4].url : '');
		
        //Datei in URL
		document.getElementById('src').value=pw_imageurl;
		document.getElementById('url').value=pw_linkurl;
		addExtImage.getImageData();//wp funktion für gültiges Bild ausführen. 
		
    }
    </script>
<?php  
} 
//script hinzufügen, wenn Bild und von url
if(!empty($_GET['tab'])&&$_GET['tab']=='type_url')
{
	add_action( 'admin_print_scripts-media-upload-popup','picasa_upload_scripts' ); 
}
?>