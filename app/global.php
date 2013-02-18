<?php
/**
 * global.php file.
 * Global shorthand functions for commonly used Yii methods.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * Returns the application instance.
 * @return CWebApplication
 */
function app()
{
	return Yii::app();
}

/**
 * Returns the application parameter with the given name.
 * @param $name
 * @return mixed
 */
function param($name)
{
	return isset(Yii::app()->params[$name]) ? Yii::app()->params[$name] : null;
}

/**
 * Returns the web user instance for the logged in user.
 * @return CWebUser
 */
function user()
{
	return Yii::app()->getUser();
}

/**
 * Returns the client script instance.
 * @return CClientScript
 */
function cs()
{
	return Yii::app()->getClientScript();
}

/**
 * Returns the main database connection.
 * @return CDbConnection
 */
function db()
{
	return Yii::app()->getDb();
}

/**
 * Returns the request instance.
 * @return CHttpRequest
 */
function request()
{
	return Yii::app()->getRequest();
}

/**
 * Returns the formatter instance.
 * @return CFormat
 */
function format()
{
	return Yii::app()->getFormat();
}

/**
 * Translates the given string using Yii::t().
 * @param $category
 * @param $message
 * @param array $params
 * @param string $source
 * @param string $language
 * @return string
 */
function t($category, $message, $params = array(), $source = null, $language = null)
{
	return Yii::t($category, $message, $params, $source, $language);
}

/**
 * Returns the base URL for the given URL.
 * @param string $url
 * @return string
 */
function bu($url = '')
{
	static $baseUrl;
	if (!isset($baseUrl)) {
		$baseUrl = Yii::app()->request->baseUrl;
	}
	return $baseUrl . '/' . ltrim($url, '/');
}

/**
 * Returns whether the logged in user has access to the given operation.
 * @param $operation
 * @param array $params
 * @param bool $allowCaching
 * @return mixed
 */
function checkAccess($operation, $params = array(), $allowCaching = true)
{
	return Yii::app()->user->checkAccess($operation, $params, $allowCaching);
}

/**
 * Escapes the given string using CHtml::encode().
 * @param $text
 * @return string
 */
function e($text)
{
	return CHtml::encode($text);
}

/**
 * Returns the given text as purified HTML.
 * @param $text
 * @return string
 */
function purify($text)
{
	static $purifier;
	if (!isset($purifier)) {
		$purifier = new CHtmlPurifier;
	}
	return $purifier->purify($text);
}

/**
 * Returns the given markdown text as purified HTML.
 * @param $text
 * @return string
 */
function md($text)
{
	static $parser;
	if ($parser === null) {
		$parser = new MarkdownParser;
	}
	return $parser->safeTransform($text);
}

/**
 * Creates an image tag using CHtml::image().
 * @param $src
 * @param string $alt
 * @param array $htmlOptions
 * @return string
 */
function img($src, $alt = '', $htmlOptions = array())
{
	return CHtml::image($src, $alt, $htmlOptions);
}

/**
 * Creates a link to the given url using CHtml::link().
 * @param $text
 * @param string $url
 * @param array $htmlOptions
 * @return string
 */
function l($text, $url = '#', $htmlOptions = array())
{
	return CHtml::link($text, $url, $htmlOptions);
}

/**
 * Creates a relative URL using CUrlManager::createUrl().
 * @param $route
 * @param array $params
 * @param string $ampersand
 * @return mixed
 */
function url($route, $params = array(), $ampersand = '&')
{
	return Yii::app()->urlManager->createUrl($route, $params, $ampersand);
}

/**
 * Creates an absolute URL using CUrlManager::createAbsoluteUrl().
 * @param $route
 * @param array $params
 * @param string $ampersand
 * @return mixed
 */
function absUrl($route, $params = array(), $ampersand = '&')
{
	return Yii::app()->urlManager->createAbsoluteUrl($route, $params, $ampersand);
}

/**
 * Encodes the given object using CJSON::encode().
 * @param $var
 * @return string
 */
function je($var)
{
	return CJSON::encode($var);
}

/**
 * Decodes the given JSON string using CJSON::decode().
 * @param $str
 * @param bool $useArray
 * @return mixed
 */
function jd($str, $useArray = true)
{
	return CJSON::decode($str, $useArray);
}

/**
 * Dumps the given variable using CVarDumper::dumpAsString().
 * @param mixed $var
 * @param int $depth
 * @param bool $highlight
 */
function dump($var, $depth = 10, $highlight = true)
{
	echo CVarDumper::dumpAsString($var, $depth, $highlight);
}