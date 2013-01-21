<?php
/**
 * BootstrapFilter class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since 2.1.0
 */

/**
 * Bootstrap filter that allows loading Bootstrap CSS and JavaScript on specific actions.
 * Thanks to Antonio Ramirez for implementing a similar filter in YiiBooster.
 */
class BootstrapFilter extends CFilter
{
	/**
	 * @var boolean whether Bootstrap core CSS should be registered.
	 */
	public $coreCss = true;
	/**
	 * @var boolean whether Bootstrap responsive CSS should be registered.
	 */
	public $responsiveCss = true;
	/**
	 * @var boolean whether Yii specific Bootstrap CSS should be registered.
	 */
	public $yiiCss = true;
	/**
	 * @var boolean whether Bootstrap JavaScript plugins should be registered.
	 */
	public $enableJS = true;

	/**
	 * Performs the pre-action filtering.
	 * @param CFilterChain $filterChain the filter chain that the filter is on.
	 * @return boolean whether the filtering process should continue and the action
	 * should be executed.
	 */
	protected function preFilter($filterChain)
	{
		/* @var Bootstrap $bootstrap */
		if (($bootstrap = Yii::app()->getComponent('bootstrap')) !== null)
		{
			if ($this->coreCss)
				$bootstrap->registerCoreCss();

			if ($this->responsiveCss)
				$bootstrap->registerResponsiveCss();

			if ($this->yiiCss)
				$bootstrap->registerYiiCss();

			if ($this->enableJS)
				$bootstrap->registerCoreScripts();
		}
		return true;
	}
}
