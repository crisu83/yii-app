<?php
/**
 * ImageThumb class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @since 0.5
 */

/**
 * Wraps the ThumbBase object to provide extended oop-functionality.
 * @see http://phpthumb.gxdlabs.com/
 */
class ImageThumb extends CComponent
{
	const TYPE_GIF = 'GIF';
	const TYPE_JPG = 'JPG';
	const TYPE_PNG = 'PNG';

	/**
	 * @var ThumbBase the PhpThumb object.
	 */
	private $_thumb;

	/**
	 * Creates a new thumbnail.
	 * @param ThumbBase $thumb the PhpThumb object.
	 */
	public function __construct($thumb)
	{
		$this->_thumb = $thumb;
	}

	/**
	 * Applies the given options onto the image.
	 * @param ImageOptions $options the image options.
	 * @throws CException if options cannot be applied.
	 */
	public function applyOptions($options)
	{
		if (isset($options->width, $options->height) || isset($options->resizeMethod))
		{
			if (!isset($options->resizeMethod))
				$options->resizeMethod = Image::METHOD_RESIZE;

			switch ($options->resizeMethod)
			{
				case Image::METHOD_RESIZE:
					if (isset($options->width, $options->height))
						$this->resize($options->width, $options->height);
					break;

				case Image::METHOD_ADAPTIVE_RESIZE:
					if (isset($options->width, $options->height))
						$this->adaptiveResize($options->width, $options->height);
					break;

				case Image::METHOD_RESIZE_PERCENT:
					if (isset($options->percent))
						$this->resizePercent($options->percent);
					break;

				default:
					throw new CException('Failed to resize image! Resize method is unknown.');
			}
		}

		if (isset($options->cropMethod))
		{
			switch ($options->cropMethod)
			{
				case Image::METHOD_CROP:
					if (isset($options->cropX, $options->cropY, $options->cropWidth, $options->cropHeight))
						$this->crop($options->cropX, $options->cropY, $options->cropWidth, $options->cropHeight);
					break;

				case Image::METHOD_CROP_CENTER:
					if (isset($options->cropWidth, $options->cropHeight))
						$this->cropFromCenter($options->cropWidth, $options->cropHeight);
					break;

				default:
					throw new CException('Failed to crop image! Crop method is unknown.');
			}
		}

		if (isset($options->rotateMethod))
		{
			switch ($options->rotateMethod)
			{
				case Image::METHOD_ROTATE:
					if (isset($options->rotateDirection))
						$this->rotate($options->rotateDirection);
					break;

				case Image::METHOD_ROTATE_DEGREES:
					if (isset($options->rotateDegrees))
						$this->rotateDegrees($options->rotateDegrees);
					break;

				default:
					throw new CException('Failed to rotate image! Rotate method is unknown.');
			}
		}
	}

	/**
	 * Re-sizes the image to the given dimensions.
	 * If either param is set to zero, then that dimension will not be considered as a part of the resize.
	 * @param integer $maxWidth the maximum width.
	 * @param integer $maxHeight the maximum height.
	 * @return ImageThumb
	 */
	public function resize($maxWidth = 0, $maxHeight = 0)
	{
		$this->_thumb = $this->_thumb->resize($maxWidth, $maxHeight);
		return $this;
	}

	/**
	 * Re-sizes the image so that it is as close to the given dimensions as possible,
	 * and then crops the remaining overflow (from the center).
	 * @param integer $width the width to crop the image to.
	 * @param integer $height the height to crop the image to.
	 * @return ImageThumb
	 */
	public function adaptiveResize($width, $height)
	{
		$this->_thumb = $this->_thumb->adaptiveResize($width, $height);
		return $this;
	}

	/**
	 * Re-sizes the image by the given percent uniformly.
	 * @param integer $percent the percent to resize by.
	 * @return ImageThumb
	 */
	public function resizePercent($percent)
	{
		$this->_thumb = $this->_thumb->resizePercent($percent);
		return $this;
	}

	/**
	 * Crops the image from the given coordinates with the specified width and height.
	 * This is also known as Vanilla-cropping.
	 * @param integer $x the starting x-coordinate.
	 * @param integer $y the starting y-coordinate.
	 * @param integer $width the width to crop with.
	 * @param integer $height the height to crop with.
	 * @return ImageThumb
	 */
	public function crop($x, $y, $width, $height)
	{
		$this->_thumb = $this->_thumb->crop($x, $y, $width, $height);
		return $this;
	}

	/**
	 * Crops the image from the center with the specified width and height.
	 * @param integer $width the width to crop with.
	 * @param integer $height the height to crop with, if null the height will be the same as the width.
	 * @return ImageThumb
	 */
	public function cropFromCenter($width, $height = null)
	{
		$this->_thumb = $this->_thumb->cropFromCenter($width, $height);
		return $this;
	}

	/**
	 * Rotates the image by 90 degrees in the specified direction.
	 * @param string $direction the direction to rotate the image in.
	 * @return ImageThumb
	 */
	public function rotate($direction = Image::DIRECTION_CLOCKWISE)
	{
		$this->_thumb = $this->_thumb->rotateImage($direction);
		return $this;
	}

	/**
	 * Rotates the image by the specified amount of degrees.
	 * The image is always rotated clock-wise.
	 * @param integer $degrees the amount of degrees.
	 * @return ImageThumb
	 */
	public function rotateDegrees($degrees)
	{
		$this->_thumb = $this->_thumb->rotateImageNDegrees($degrees);
		return $this;
	}

	/**
	 * Saves the image.
	 * @param string $path the path where to save the image.
	 * @param string $extension the file extension.
	 * @return ImageThumb
	 */
	public function save($path, $extension = null)
	{
		$this->_thumb = $this->_thumb->save($path, $extension);
		return $this;
	}

	/**
	 * Renders the image.
	 */
	public function render()
	{
		$this->_thumb->show();
	}
}
