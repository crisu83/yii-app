<?php
/**
 * ImageController class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since 0.5
 */
class ImageController extends CController
{
	/**
	 * Creates and renders a new version of a specific image.
	 * @param integer $id the image id.
	 * @param string $version the name of the image version.
	 * @throws CHttpException if the requested version is not defined.
	 */
	public function actionCreate($id, $version)
	{
		$image = Yii::app()->image;
		if (isset($image->versions[$version]))
		{
			$thumb = $image->createVersion($id, $version);
			$thumb->render();
		}
		else
			throw new CHttpException(404, 'Failed to create image! Version is unknown.');
	}
}
