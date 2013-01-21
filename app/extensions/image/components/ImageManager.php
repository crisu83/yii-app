<?php
/**
 * ImageManager class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @version 2.0.0
 */

require_once(dirname(__FILE__).'/../lib/phpthumb/ThumbLib.inc.php'); // Yii::import() will not work in this case.

/**
 * Provides easy image manipulation with the help of the excellent PHP Thumbnailer library.
 * @see http://phpthumb.gxdlabs.com/
 */
class ImageManager extends CApplicationComponent
{
	/**
	 * PhpThumb options that are passed to the ThumbFactory.
	 * Default values are the following:
	 *
	 * <code>
	 * array(
	 *     'resizeUp' => false,
	 *     'jpegQuality' => 100,
	 *     'correctPermissions' => false,
	 *     'preserveAlpha' => true,
	 *     'alphaMaskColor'    => array(255, 255, 255),
	 *     'preserveTransparency' => true,
	 *     'transparencyMaskColor' => array(0, 0, 0),
	 * );
	 * </code>
	 *
	 * @var array factory options
	 */
	public $thumbOptions = array();
	/**
	 * @var string base URL.
	 */
	public $baseUrl;
	/**
	 * @var string relative path where to store images.
	 */
	public $imagePath = 'files/images/';
	/**
	 * @var string name of the folder to store original images in.
	 */
	public $originalDir = 'originals';
	/**
	 * @var string name of the folder to store versioned images in.
	 */
	public $versionDir = 'versions';
	/**
	 * @var array image versions configurations.
	 */
	public $versions = array();
	/**
	 * @var string base path.
	 */
	protected $_basePath;
	/**
	 * @var string path to the original images.
	 */
	protected $_originalBasePath;
	/**
	 * @var string path to the versioned images.
	 */
	protected $_versionBasePath;

	private static $_thumbOptions = array(); // needed for the static factory-method
	private static $_imagePath;

	/**
	 * Initializes the component.
	 */
	public function init()
	{
		if (Yii::getPathOfAlias('image') === false)
			Yii::setPathOfAlias('image', dirname(__FILE__).'/..');

		Yii::import('image.components.*');
		Yii::import('image.models.Image');

		self::$_thumbOptions = $this->thumbOptions;
		self::$_imagePath = $this->getImagePath(true);

		if ($this->baseUrl === null)
			$this->baseUrl = Yii::app()->request->baseUrl;

		parent::init();
	}

	/**
	 * Returns the URL for a specific image.
	 * @param string $id the image id.
	 * @param string $version the name of the image version.
	 * @param boolean $absolute whether or not to get an absolute URL.
	 * @return string|boolean the URL or false the version is invalid.
	 */
	public function getUrl($id, $version, $absolute = false)
	{
		if (isset($this->versions[$version]))
		{
			$image = $this->load($id);
			$path = $this->getVersionPath($version, $absolute).$image->getPath().$this->resolveFileName($image);
			return $this->baseUrl.'/'.$path;
		}
		else
			return false;
	}

	/**
	 * Saves a new image.
	 * @param CUploadedFile $file the uploaded image.
	 * @param CActiveRecord $owner the owner model.
	 * @param string $name the image name. Available since 1.2.0
	 * @param string $path the path to save the file to. Available since 1.2.1.
	 * @return Image the image model.
	 * @throws CException if saving the image fails.
	 */
	public function save($file, $name = null, $path = null)
	{
		$trx = Yii::app()->db->beginTransaction();

		try
		{
			$image = new Image();
			$image->extension = strtolower($file->getExtensionName());
			$image->filename = $file->getName();
			$image->byteSize = $file->getSize();
			$image->mimeType = $file->getType();
			$image->createTime = new CDbExpression('NOW()');

			if (empty($name))
			{
				$name = $file->getName();
				$name = substr($name, 0, strrpos($name, '.'));
			}

			$image->name = $this->normalizeString($name);

			if ($path !== null)
				$image->path = trim($path, '/');

			if ($image->save() === false)
				throw new CException(__CLASS__.': Failed to save image! Record could not be saved.');

			$path = $this->resolveImagePath($image);

			if (!file_exists($path) && !$this->createDirectory($path))
				throw new CException(__CLASS__.': Failed to save image! Directory could not be created.');

			$path .= $this->resolveFileName($image);

			if ($file->saveAs($path) === false)
				throw new CException(__CLASS__.': Failed to save image! File could not be saved.');

			$trx->commit();
			return $image;
		}
		catch (CException $e)
		{
			$trx->rollback();
			throw $e;
		}
	}

	/**
	 * Creates a new version of a specific image.
	 * @param integer $id the image id.
	 * @param string $version the image version.
	 * @return ThumbBase
	 * @throws CException if creating the image version fails.
	 */
	public function createVersion($id, $version)
	{
		if (isset($this->versions[$version]))
		{
			$image = $this->load($id);

			if ($image != null)
			{
				$fileName = $this->resolveFileName($image);
				$thumb = self::thumbFactory($this->resolveImagePath($image).$fileName);
				$options = ImageOptions::create($this->versions[$version]);
				$thumb->applyOptions($options);
				$path = $this->resolveImageVersionPath($image, $version);

				if (!file_exists($path) && !$this->createDirectory($path))
					throw new CException(__CLASS__.': Failed to create version! Directory could not be created.');

				$path .= $fileName;

				return $thumb->save($path);
			}
			else
				throw new CException(__CLASS__.': Failed to create version! Image could not be found.');
		}
		else
			throw new CException(__CLASS__.': Failed to create version! Version is unknown.');
	}

	/**
	 * Deletes a specific image.
	 * @param integer $id the image id.
	 * @return boolean whether the image was deleted.
	 * @throws CException if the image cannot be deleted.
	 */
	public function delete($id)
	{
		/** @var Image $image */
		$image = Image::model()->findByPk($id);

		if ($image instanceof Image)
		{
			$deleted = true;

			$path = $this->resolveImagePath($image).$this->resolveFileName($image);

			if ($image->delete() === false)
				throw new CException(__CLASS__.': Failed to delete image! Record could not be deleted.');

			if (file_exists($path) !== false && unlink($path) === false)
				throw new CException(__CLASS__.': Failed to delete image! File could not be deleted.');

			foreach ($this->versions as $version => $config)
				$deleted = $deleted && $this->deleteVersion($image, $version);

			return $deleted;
		}
		else
			throw new CException(__CLASS__.': Failed to delete image! Record could not be found.');
	}

	/**
	 * Deletes a specific image version.
	 * @param Image $image the image model.
	 * @param string $version the image version.
	 * @return boolean whether the image was deleted.
	 * @throws CException if the image cannot be deleted.
	 */
	protected function deleteVersion($image, $version)
	{
		if (isset($this->versions[$version]))
		{
			$path = $this->resolveImageVersionPath($image, $version).$this->resolveFileName($image);

			if (file_exists($path) !== false && unlink($path) === false)
				throw new CException(__CLASS__.': Failed to delete the image version! File could not be deleted.');

			return true;
		}
		else
			throw new CException(__CLASS__.': Failed to delete image version! Version is unknown.');
	}

	/**
	 * Loads a thumb of a specific image.
	 * @param integer $id the image id.
	 * @return ThumbBase
	 */
	public function loadThumb($id)
	{
		$image = $this->load($id);

		if ($image !== null)
		{
			$fileName = $this->resolveFileName($image);
			$thumb = self::thumbFactory($this->resolveImagePath($image).$fileName);
			return $thumb;
		}
		else
			return null;
	}

	/**
	 * Loads a specific image model.
	 * @param integer $id the image id.
	 * @return Image
	 */
	public function load($id)
	{
		return Image::model()->findByPk($id);
	}

	/**
	 * Returns the original image file name.
	 * @param Image $image the image model.
	 * @return string the file name.
	 */
	protected function resolveFileName($image)
	{
		return $image->name.'-'.$image->id.'.'.$image->extension;
	}

	/**
	 * Returns the path to a specific image.
	 * @param Image $image the image model.
	 * @return string the path.
	 */
	protected function resolveImagePath($image)
	{
		return $this->getOriginalPath(true).$image->getPath();
	}

	/**
	 * Returns the path to a specific image version.
	 * @param Image $image the image model.
	 * @param string $version the image version.
	 * @return string the path.
	 */
	protected function resolveImageVersionPath($image, $version)
	{
		return $this->getVersionPath($version, true).$image->getPath();
	}

	/**
	 * Returns the images path.
	 * @param boolean $absolute whether or not the path should be absolute.
	 * @return string the path.
	 */
	protected function getImagePath($absolute = false)
	{
		$path = '';

		if ($absolute === true)
			$path .= $this->getBasePath();

		return $path.$this->imagePath;
	}

	/**
	 * Returns the version specific path.
	 * @param string $version the name of the image version.
	 * @param boolean $absolute whether or not the path should be absolute.
	 * @return string the path.
	 */
	protected function getVersionPath($version, $absolute = false)
	{
		$path = $this->getVersionBasePath($absolute).$version.'/';

		// Might be a new version so we need to create the path if it doesn't exist.
		if ($absolute && !file_exists($path))
			$this->createDirectory($path);

		return $path;
	}

	/**
	 * Returns the path to the original images.
	 * @param boolean $absolute whether or not the path should be absolute.
	 * @return string the path.
	 */
	protected function getOriginalPath($absolute = false)
	{
		$path = '';

		if ($absolute === true)
			$path .= $this->getBasePath();

		if ($this->_originalBasePath !== null)
			$path .= $this->_originalBasePath;
		else
			$path .= $this->_originalBasePath = $this->getImagePath().$this->originalDir.'/';

		return $path;
	}

	/**
	 * Returns the path to the versioned images.
	 * @param boolean $absolute whether or not the path should be absolute.
	 * @return string the path.
	 */
	protected function getVersionBasePath($absolute = false)
	{
		$path = '';

		if ($absolute === true)
			$path .= $this->getBasePath();

		if ($this->_versionBasePath !== null)
			$path .= $this->_versionBasePath;
		else
			$path .= $this->_versionBasePath = $this->getImagePath().$this->versionDir.'/';

		return $path;
	}

	/**
	 * Returns the base path.
	 * @return string the path.
	 */
	protected function getBasePath()
	{
		if ($this->_basePath !== null)
			return $this->_basePath;
		else
			return $this->_basePath = Yii::getPathOfAlias('webroot').'/';
	}

	/**
	 * Creates the specified directory.
	 * @param string $path the directory path.
	 * @param integer $mode the file mode.
	 * @param boolean $recursive allows the creation of nested directories.
	 * @return boolean whether or not the directory was created.
	 * @since 1.2.1
	 */
	protected function createDirectory($path, $mode = 0777, $recursive = true)
	{
		return mkdir($path, $mode, $recursive);
	}

	/**
	 * Normalizes the given string by replacing special characters. �=>a, �=>e, �=>o, etc.
	 * @param string $string the text to normalize.
	 * @return string the normalized string.
	 * @since 1.2.0
	 */
	protected function normalizeString($string)
	{
		$string = str_replace(str_split('-/\?%*:|"<>. '), '', $string);
		$string = preg_replace('/&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);/i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
		$string = preg_replace('/&.+;/', '', $string);
		return $string;
	}

	/**
	 * Creates a new image.
	 * @param string $filePath the image file path.
	 * @return ImageThumb
	 */
	protected static function thumbFactory($filePath)
	{
		$phpThumb = PhpThumbFactory::create($filePath, self::$_thumbOptions);
		return new ImageThumb($phpThumb);
	}
}
