<?php
/**
 * Is a class to save remote images, and change the type of image.
 * @author Juan Chaves, juan.cha63@gmail.com
 * Copyright (C) 2017 Juan Chaves
 * This program is free software; distributed under the artistic license.
 */
class SaveAndConvertImg {
	
	public $patch;
	public $url;
	public $name;
	public $convert;
	public $filename;
	
    /**
     * Method public ReturnImage.
     * @return Method private _load_image 
     */
    public function ReturnImage() {
		
        return $this->_load_image();
		
    }
   
    /**
     * Method private _load_image.
     * @return Download and convert a remote image to a local folder.
     */
    private function _load_image() {
		//patch image
		$this->filename = $this->patch . '/' . $this->name . '.' . $this->convert;
		//image url
		$img = $this->url;
		//image upload
		$imageString = file_get_contents($img);
		
		//it's gif
		if($this->convert === 'gif') {

			$convert = 1;
		//it's jpg	
		} else if($this->convert === 'jpg') {
			
			$convert = 2;			
		//it's png	
		} else if($this->convert === 'png') {
			
			$convert = 3;	
			
		}
		//saved successfully
		if($convert) {
			//image type
			$get_type = exif_imagetype($img);
			//no need to modify
			if($get_type === $convert) {
				if(file_put_contents($this->filename, $imageString)) {
	
					return 'image ' . $this->convert . ' uploaded correctly';
				
				} else {
					
					return 'image ' . $this->convert . ' upload failed!';
					
				}
			//switch to png	
			} else if($convert === 3) {

				return $this->_convert_image_png();

			//switch to jpg
			} else if($convert === 2) {

				return $this->_convert_image_jpg();			

			//switch to gif	
			} else if($convert === 1) {
				
				return $this->_convert_image_gif();

			}
			
		} else {
			
			return 'image upload failed!';
			
		}
		
    }
	
    /**
     * Method private _convert_image_png.
     * @return convert a remote image to a local folder.
     */
    private function _convert_image_png() {	

		if(imagepng(imagecreatefromstring(file_get_contents($this->url)), $this->filename)) {
			
			return 'image ' . $this->convert . ' uploaded and convert correctly';
		
		} else {
			
			return 'image upload and convert failed!';
			
		}
		
	}
	
    /**
     * Method private _convert_image_jpg.
     * @return convert a remote image to a local folder.
     */
    private function _convert_image_jpg() {	

		if(imagejpeg(imagecreatefromstring(file_get_contents($this->url)), $this->filename)) {
			
			return 'image ' . $this->convert . ' uploaded and convert correctly';
		
		} else {
			
			return 'image upload and convert failed!';
			
		}
		
	}
	
    /**
     * Method private _convert_image_gif.
     * @return convert a remote image to a local folder.
     */
    private function _convert_image_gif() {	

		if(imagegif(imagecreatefromstring(file_get_contents($this->url)), $this->filename)) {
			
			return 'image ' . $this->convert . ' uploaded and convert correctly';
		
		} else {
			
			return 'image upload and convert failed!';
			
		}
		
	}
		
}

//Example
$load= new SaveAndConvertImg();
//path to save the image. do not put the last slash
$load->patch = './img';
//copy image source path
$load->url = 'https://www.google.es/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png';
//name of the copy
$load->name = 'logo_google';
//type of image to convert - jpg gif png
$load->convert = 'jpg';
echo $load->ReturnImage();

?>