<?php
/**
 * ImageOptions class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 0.5
 */
class ImageOptions extends CComponent
{
	/**
	 * @property integer the desired width.
	 */
	public $width;
	/**
	 * @property integer the desired height.
	 */
	public $height;
	/**
	 * @property integer the resize percent.
	 */
	public $percent;
	/**
	 * @property string the method to use for resizing.
	 */
	public $resizeMethod;
	/**
	 * @property integer the crop start x-coordinate.
	 */
	public $cropX;
	/**
	 * @property integer the crop start y-coordinate.
	 */
	public $cropY;
	/**
	 * @property integer the width to crop width.
	 */
	public $cropWidth;
	/**
	 * @property integer the height to crop width.
	 */
	public $cropHeight;
	/**
	 * @property string the method to use for cropping.
	 */
	public $cropMethod;
	/**
	 * @property string the direction in which to rotate the image by 90 degrees.
	 */
	public $rotateDirection;
	/**
	 * @property integer the amount of degrees to rotate the image.
	 */
	public $rotateDegrees;
	/**
	 * @property string the method to use when rotating.
	 */
	public $rotateMethod;

	/**
	 * When applied the image is re-sized to the given dimensions.
	 * If either param is set to zero, then that dimension will not be considered as a part of the resize.
	 * @param integer $maxWidth the maximum width.
	 * @param integer $maxHeight the maximum height.
	 */
	public function setResize($maxWidth = 0, $maxHeight = 0)
	{
		$this->width = $maxWidth;
		$this->height = $maxHeight;
		$this->resizeMethod = Image::METHOD_RESIZE;
	}

	/**
	 * When applied the image is re-sized so that the image is as close to the given dimensions as possible,
	 * and then the remaining overflow is cropped (from the center).
	 * @param integer $width the width to crop the image to.
	 * @param integer $height the height to crop the image to.
	 */
	public function setAdaptiveResize($width, $height)
	{
		$this->width = $width;
		$this->height = $height;
		$this->resizeMethod = Image::METHOD_ADAPTIVE_RESIZE;
	}

	/**
	 * When applied the image is re-sized by the given percent uniformly.
	 * @param integer $percent the percent to resize by.
	 */
	public function setResizePercent($percent)
	{
		$this->percent = $percent;
		$this->resizeMethod = Image::METHOD_RESIZE_PERCENT;
	}

	/**
	 * When applied the image is cropped from the given coordinates with the specified width and height.
	 * This is also known as Vanilla-cropping.
	 * @param integer $x the starting x-coordinate.
	 * @param integer $y the starting y-coordinate.
	 * @param integer $width the width to crop with.
	 * @param integer $height the height to crop with.
	 */
	public function setCrop($x, $y, $width, $height)
	{
		$this->cropX = $x;
		$this->cropY = $y;
		$this->cropWidth = $width;
		$this->cropHeight = $height;
		$this->cropMethod = Image::METHOD_CROP;
	}

	/**
	 * When applied the image is cropped from the center with the specified width and height.
	 * @param integer $width the width to crop with.
	 * @param integer $height the height to crop with, if null the height will be the same as the width.
	 */
	public function setCropFromCenter($width, $height = null)
	{
		$this->cropWidth = $width;
		$this->cropHeight = $height;
		$this->cropMethod = Image::METHOD_CROP_CENTER;
	}

	/**
	 * When applied the image is rotated by 90 degrees in the specified direction.
	 * @param string $direction the direction to rotate the image in.
	 */
	public function setRotate($direction = Image::DIRECTION_CLOCKWISE)
	{
		$this->rotateDirection = $direction;
		$this->rotateMethod = Image::METHOD_ROTATE;
	}

	/**
	 * When applied the image is rotated by the specified amount of degrees.
	 * The image is always rotated clock-wise.
	 * @param integer $degrees the amount of degrees.
	 */
	public function setRotateDegrees($degrees)
	{
		$this->rotateDegrees = $degrees;
		$this->rotateMethod = Image::METHOD_ROTATE_DEGREES;
	}

	/**
	 * Converts this objects to an array.
	 * @return array the array representation of the options.
	 */
	public function __toArray()
	{
		$result = array();
		$properties = array(
			'resizeWidth',
			'resizeHeight',
			'resizePercent',
			'resizeMethod',
			'cropX',
			'cropY',
			'cropWidth',
			'cropHeight',
			'cropMethod',
			'rotateDirection',
			'rotateDegrees',
			'rotateMethod',
		);
		foreach ($properties as $name)
			$result[$name] = $this->{$name};
		return $result;
	}

	/**
	 * Creates an image options instance from the given array.
	 * @param array $options the image options.
	 * @return ImageOptions
	 */
	public static function create($options)
	{
		$result = new ImageOptions();
		foreach ($options as $name => $value)
			if (property_exists($result, $name))
				$result->{$name} = $value;
		return $result;
	}
}
