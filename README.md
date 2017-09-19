# Save-And-Convert-Img-PHP
Is a class to save remote images, and change the type of image.
Download and convert at the same time a remote file, convert:
PNG to JPG
PNG to GIF
GIF to JPG
GIF to PNG
JPG to GIF
JPG to PNG
<pre>
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
</pre>
