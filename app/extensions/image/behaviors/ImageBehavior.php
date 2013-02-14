<?php
/**
 * ImageBehavior class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 1.1.0
 */
class ImageBehavior extends CBehavior
{
	/**
	 * Saves the image for the owner of this behavior.
	 * @param string $name the image name.
	 * @param string $path the path for saving the image.
	 * @param CUploadedFile $file the uploaded file.
	 */
	public function saveImage($file, $name = null, $path = null)
	{
		return Yii::app()->image->save($file, $name, $path);
	}
}
