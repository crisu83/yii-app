<?php
/**
 * ConfigBuilder class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

/**
 * Helper for building application configurations.
 */
class ConfigBuilder
{
	/**
	 * Builds a configuration from the given array.
	 * @param array $array the configuration parts.
	 * @return array the configuration.
	 */
	public static function build($array)
	{
		$result = array();
		if (!is_array($array))
			$array = array($array);
		foreach ($array as $config)
		{
			if (is_string($config))
			{
				if (!file_exists($config))
					continue;
				$config = require($config);
			}
			$result = CMap::mergeArray($result, $config);
		}
		return $result;
	}
}
