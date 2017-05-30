<?php

class Picture {
	public $image_name = '';
	public $path = '';
	public $all_path = '';
	public $ext = '';
	
	public function __construct(){}
	
	public function upload_multiple($pic, $location){
		$pic_arr = Utilities::reArrayFiles($pic);
		$arr =[];
		foreach($pic_arr as $picture){
			$arr[] = $this->upload($picture, $location);
		}
		return $arr;
	}
	public function upload_m($pic, $fileName, $location) {
		$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); 
		$end = explode(".", $fileName);
		$this->ext = $fileExt = end($end);
		$this->image_name = $fileName = 'IMG'. time()."_".rand().".".$fileExt;
		$path = $location. $fileName;
		move_uploaded_file($pic, $path);
		$this->path = $path;
		return $path;
	}
	public function upload($pic, $location) {
		$fileName = $pic["name"];
		$fileTmpLoc = $pic["tmp_name"];
		$fileType = $pic["type"]; 
		$fileSize = $pic["size"]; 
		$fileErrorMsg = $pic["error"]; 
		$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); 
		$end = explode(".", $fileName);
		$this->ext = $fileExt = end($end);
		$this->image_name = $fileName = 'IMG'. time()."_".rand().".".$fileExt;
		// START PHP Image Upload Error Handling --------------------------------------------------
		if (!$fileTmpLoc) { 
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit();
		} else if($fileSize > 15242880) { // if file size is larger than 15 Megabytes
			echo "ERROR: Your file was larger than 5 Megabytes in size.";
			unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			exit();
		} else if (!preg_match("/.(gif|jpg|png)$/i", $fileName) ) {
			 // This condition is only if you wish to allow uploading of specific file types    
			 echo "ERROR: Your image was not .gif, .jpg, or .png.";
			 unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
			 exit();
		} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
			echo "ERROR: An error occured while processing the file. Try again.";
			exit();
		}
		// END PHP Image Upload Error Handling ----------------------------------------------------
		// Place it into your "uploads" folder mow using the move_uploaded_file() function
		$path = $location . $fileName;
		$moveResult = move_uploaded_file($fileTmpLoc, $path);
		// Check to make sure the move result is true before continuing
		if ($moveResult != true) {
			echo "ERROR: File not uploaded. Try again.";
			exit();
		}
		$this->path = $path;
		return $path;
	}
	
	/*
	*@target - location for the file to resize
	*@newcopy - loaction of the new resize file
	*@w - the width to resize to
	*@h - height of the file to resize to
	*@ext - file extention
	*/
	public  function resize($target, $newcopy, $w, $h, $ext) {
		list($w_orig, $h_orig) = getimagesize($target);
		$scale_ratio = $w_orig/$h_orig;
		if (($w/$h)<$scale_ratio){
			$w = $h *$scale_ratio;
		}else{
			$h = $w /$scale_ratio;
		}
		$img = "";
		if ($ext == "gif"){
			$img = imagecreatefromgif($target);
		}else if($ext == "png"){
			$img = imagecreatefrompng($target);
		}else{
			$img = imagecreatefromjpeg($target);
		}
		$tci = imagecreatetruecolor($w, $h);
		imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
		//imagejpeg($tci, $newcopy, 80);
		if ($ext == "gif"){ 
			imagegif($tci, $newcopy);
		} else if($ext =="png"){ 
			imagepng($tci, $newcopy);
		} else { 
			imagejpeg($tci, $newcopy, 85);
		}
		return $newcopy;
	}
	
	/*
	*@target - location for the file to crop
	*@newcopy - loaction of the new croped file
	*@w - the width to crop to
	*@h - height of the file to crop to
	*@ext - file extention
	*/
	public function crop($target, $newcopy, $w, $h, $ext) {
		list($w_orig, $h_orig) = getimagesize($target);
		$src_x = ($w_orig/2)-($w/2);
		$src_y = ($h_orig/2)-($h/2);
		$img = "";
		if ($ext == "gif"){
			$img = imagecreatefromgif($target);
		}else if($ext == "png"){
			$img = imagecreatefrompng($target);
		}else{
			$img = imagecreatefromjpeg($target);
		}
		$tci = imagecreatetruecolor($w, $h);
		imagecopyresampled($tci, $img, 0, 0, $src_x, $src_y, $w, $h, $w, $h);
		//imagejpeg($tci, $newcopy, 85);
		if ($ext == "gif"){ 
			imagegif($tci, $newcopy);
		} else if($ext =="png"){ 
			imagepng($tci, $newcopy);
		} else { 
			imagejpeg($tci, $newcopy, 85);
		}
		return $newcopy;
	}
	
	public function watermark($target, $wtrmrk_file, $newcopy, $ext, $avi=false) { 
		$watermark = imagecreatefrompng($wtrmrk_file); 
		imagealphablending($watermark, false); 
		imagesavealpha($watermark, true); 
		$img = "";
		//$img = imagecreatefromjpeg($target);
		if ($ext == "gif"){
			$img = imagecreatefromgif($target);
		}else if($ext == "png"){
			$img = imagecreatefrompng($target);
		}else{
			$img = imagecreatefromjpeg($target);
		}
		$img_w = imagesx($img); 
		$img_h = imagesy($img); 
		$wtrmrk_w = imagesx($watermark); 
		$wtrmrk_h = imagesy($watermark);
		// $dst_x = $dst_y = 0;
		$dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
		$dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
		if($avi){
			$dst_x = ($img_w * 0.75) - ($wtrmrk_w / 2); 
			$dst_y = ($img_h * 0.85) - ($wtrmrk_h / 2); 
		}
		
		imagecopy($img, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h); 
		//imagejpeg($img, $newcopy, 100);
		if ($ext == "gif"){ 
			imagegif($img, $newcopy);
		} else if($ext =="png"){ 
			imagepng($img, $newcopy);
		} else { 
			imagejpeg($img, $newcopy, 100);
		}
		imagedestroy($img); 
		imagedestroy($watermark); 
		return $wtrmrk_file;
	}
	
}