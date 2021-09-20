<?php 

class Upload {
	var $maxsize = 0;
	var $message = "";
	var $newfile = "";
	var $newpath = "";
	
	var $filesize = 0;
	var $filetype = "";
	var $filetype_2 = "";
	var $filename = "";
	var $filetemp;
	var $fileexte;
	
	var $allowed;
	var $blocked;
	var $isimage;
	
	var $isupload;
	
	function Upload() {
		$this->allowed_image = array("image/bmp","image/gif","image/jpeg","image/jpg","image/pjpeg","image/png","image/x-png", );
		$this->allowed_files =array("image/bmp","image/gif","image/jpeg","image/jpg","image/pjpeg","image/png","image/x-png","application/pdf", "application/vnd.ms-excel", "application/vnd.ms-office", "application/vnd.ms-powerpoint" ); // Probando lista de permitidos 
		$this->blocked = array("php","phtml","php3","php4","js","shtml","pl","py","pyw", "htaccess", "html", "js");
		$this->message = "";
		$this->isupload = false;
	}
	function setFile($field, $renombrar, $name_defect = '', $array = false, $i=0) {
		$this->filesize = (($array)?$_FILES[$field]['size'][$i]:$_FILES[$field]['size']);
		$this->filename = (($array)?$_FILES[$field]['name'][$i]:$_FILES[$field]['name']);
		$this->filetemp = (($array)?$_FILES[$field]['tmp_name'][$i]:$_FILES[$field]['tmp_name']);
		// $this->filetype = _mime_content_type2($this->filetemp); 
		if(function_exists('mime_content_type')){
			$this->filetype = mime_content_type($this->filetemp); 
		}else if(class_exists('finfo')){
			$this->filetype = _mime_content_type2($this->filetemp); 
		}else{
			$this->filetype = self::returnMIMEType($this->filename); 
		}		

		$this->fileexte = strtolower(substr($this->filename, strrpos($this->filename, '.')+1));
		$this->newfile = (($renombrar)?substr(md5(uniqid(rand())),0,8).".".$this->fileexte:((!empty($name_defect))?$name_defect:$this->filename)  );
	}
	function setPath($value) {
		$this->newpath = $value;
	}
	function setMaxSize($value) {
		$this->maxsize = $value;	
	}
	function isImage($value) {
		$this->isimage = $value;
	}
	function save() {

		if (is_uploaded_file($this->filetemp)) {
			
			// check if file valid
			if ($this->filename == "") {
				$this->message = "carga_archivos_1";
				$this->isupload = false;
				return false;
			}
			// check max size
			if ($this->maxsize != 0) {
				if ($this->filesize > $this->maxsize*1024) {
					$this->message = "carga_archivos_2";
					$this->isupload = false;
					return false;
				}
			}
			// check if image
			if ($this->isimage) {
				// check dimensions
				if (!getimagesize($this->filetemp)) {
					$this->message = "carga_archivos_3";
					$this->isupload = false;
					return false;	
				}

				// check content type
				if (!in_array($this->filetype, $this->allowed_image)) {
					$this->message = "carga_archivos_4";
					$this->isupload = false;
					return false;
				}

				if (function_exists('exif_imagetype')) {
					// check type
					if (exif_imagetype($this->filetemp) != IMAGETYPE_PNG && exif_imagetype($this->filetemp) != IMAGETYPE_JPEG && exif_imagetype($this->filetemp) != IMAGETYPE_BMP && exif_imagetype($this->filetemp) != IMAGETYPE_GIF)
					{ 
					    $this->message = "carga_archivos_5";
						$this->isupload = false;
						return false;
					}
				}
				
			// check if not image
			}else{
		
				if (!in_array($this->filetype, $this->allowed_files)) {
					$this->message = "carga_archivos_6";
					$this->isupload = false;
					return false;
				}

			}

			// check if file extension is blocked
			if (in_array($this->fileexte, $this->blocked)) {
				$this->message = "carga_archivos_7";
				$this->isupload = false;
				return false;
			}

			
				
			if(move_uploaded_file($this->filetemp, $this->newpath."/".$this->newfile)) {

				$this->message = "carga_archivos_8";
				$this->isupload = true;
				return true;
			}else {

				$this->message ="carga_archivos_9";
				$this->isupload = false;
				return false;
			}
			
			
		} else {
			
			$this->message = "carga_archivos_10";
			$this->isupload = false;
			return false;
		}
	}

	function _mime_content_type2($filename) {
    	$result = new finfo();


    	if (is_resource($result) === true) {
	        return $result->file($filename, FILEINFO_MIME_TYPE);
	    }

	    return false;
	}	

	function returnMIMEType($filename) {
		preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);
		//print_r($fileSuffix);
		switch(strtolower($fileSuffix[1]))
		{
			case "js" :
			return "application/x-javascript";

			case "json" :
			return "application/json";

			case "jpg" :
			case "jpeg" :
			case "jpe" :
			return "image/jpg";

			case "png" :
			case "gif" :
			case "bmp" :
			case "tiff" :
			return "image/".strtolower($fileSuffix[1]);

			case "css" :
			return "text/css";

			case "xml" :
			return "application/xml";

			case "doc" :
			case "docx" :
			return "application/msword";

			case "xls" :
			case "xlt" :
			case "xlm" :
			case "xld" :
			case "xla" :
			case "xlc" :
			case "xlw" :
			case "xll" :
			return "application/vnd.ms-excel";

			case "ppt" :
			case "pps" :
			return "application/vnd.ms-powerpoint";

			case "rtf" :
			return "application/rtf";

			case "pdf" :
			return "application/pdf";

			case "html" :
			case "htm" :
			case "php" :
			return "text/html";

			case "txt" :
			return "text/plain";

			case "mpeg" :
			case "mpg" :
			case "mpe" :
			return "video/mpeg";

			case "mp3" :
			return "audio/mpeg3";

			case "wav" :
			return "audio/wav";

			case "aiff" :
			case "aif" :
			return "audio/aiff";

			case "avi" :
			return "video/msvideo";

			case "wmv" :
			return "video/x-ms-wmv";

			case "mov" :
			return "video/quicktime";

			case "zip" :
			return "application/zip";

			case "tar" :
			return "application/x-tar";

			case "swf" :
			return "application/x-shockwave-flash";

			default :
			if(function_exists("mime_content_type"))
			{
				$fileSuffix = mime_content_type($filename);
			}

			return "unknown/" . trim($fileSuffix[0], ".");
		}
	}
}

?>