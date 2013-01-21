<?php
/**
 * Image active record class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since 0.5
 */

/**
 * This is the model class for table "Image".
 *
 * The followings are the available columns in table 'Image':
 * @property integer $id
 * @property string $created
 * @property string $name
 * @property string $path
 * @property string $extension
 * @property string $filename
 * @property string $mimeType
 * @property integer $byteSize
 */
class Image extends CActiveRecord
{
	const METHOD_RESIZE = 'resize';
	const METHOD_RESIZE_PERCENT = 'resizePercent';
	const METHOD_ADAPTIVE_RESIZE = 'adaptiveResize';
	const METHOD_CROP = 'crop';
	const METHOD_CROP_CENTER = 'cropFromCenter';
	const METHOD_ROTATE = 'rotate';
	const METHOD_ROTATE_DEGREES = 'rotateDegrees';

	const DIRECTION_CLOCKWISE = 'CW';
	const DIRECTION_COUNTER_CLOCKWISE = 'CCW';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className the class name.
	 * @return Image the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('extension, filename, byteSize, mimeType', 'required'),
			array('byteSize', 'numerical', 'integerOnly' => true),
			array('name, path, extension, filename, mimeType', 'length', 'max' => 255),
			array('id, name, path, extension, filename, byteSize, mimeType, created', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * Renders this image.
	 * @param string $version the image version to render.
	 * @param string $alt the alternative text.
	 * @param array $htmlOptions the html options.
	 */
	public function render($version, $alt = '', $htmlOptions = array())
	{
		$src = $this->getUrl($version);
		echo CHtml::image($src, $alt, $htmlOptions);
	}

	/**
	 * Returns the URL to the given image version.
	 * @param string $version the image version.
	 * @return string|boolean the URL or false if the version is invalid.
	 */
	public function getUrl($version)
	{
		return Yii::app()->image->getUrl($this->id, $version);
	}

	/**
	 * @return string the path for this image.
	 */
	public function getPath()
	{
		return isset($this->path) ? $this->path.'/' : '';
	}

	/**
	 * @return string the image file name.
	 */
	public function resolveFilename()
	{
		return $this->name.'.'.$this->extension;
	}
}
