<?php
	function resizepic($filename,$dst_w,$dst_h){

		list($src_w,$src_h,$imagetype) = getimagesize($filename);
		$mime = image_type_to_mime_type($imagetype);
		$createFun=str_replace("/", "createfrom", $mime);
		$outFun=str_replace("/", null, $mime);
		$src_img=$createFun($filename);
		$dst_img=imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresized($dst_img, $src_img, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
		$outFun($dst_img,$filename);//$outFun($dst_img,'test.jpeg');
		imagedestroy($src_img);
		imagedestroy($dst_img);
	}
?>