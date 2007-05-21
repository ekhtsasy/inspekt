<?php
/**
 * Inspekt Input - main source file
 *
 * @author Chris Shiflett <chris@shiflett.org>
 * @author Ed Finkler <coj@funkatron.com>
 *
 * @package Inspekt
 */

/**
 * require main Inspekt file
 */
require_once 'Inspekt.php';

/**
 * @package Inspekt
 * @todo support retrieving a key deeper than the first level
 */
class Inspekt_Input
{
	/**
	 * The raw source data.  Although tempting, NEVER EVER EVER access the data
	 * directly using this property!
	 *
	 * @var array
	 */
	var $_source = NULL;


	/**
     * Takes an array and wraps it inside an object.  If $strict is not set to
     * FALSE, the original array will be destroyed, and the data can only be
     * accessed via the object's accessor methods
     *
     * @param array $source
     * @param boolean $strict
     * @return Inspekt_Input
     */
	function Inspekt_Input(&$source, $strict = TRUE)
	{
		if (!is_array($source)) {
			Inspekt_Error::raiseError('$source is not an array', E_USER_ERROR);
		}

		$this->_source = $source;

		if ($strict) {
			$source = NULL;
		}
	}

	/**
     * Returns only the alphabetic characters in value.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function getAlpha($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::getAlpha($this->_source[$key]);
	}

	/**
     * Returns only the alphabetic characters and digits in value.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function getAlnum($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::getAlnum($this->_source[$key]);
	}

	/**
     * Returns only the digits in value. This differs from getInt().
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function getDigits($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::getDigits($this->_source[$key]);
	}

	/**
     * Returns dirname(value).
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function getDir($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::getDir($this->_source[$key]);
	}

	/**
     * Returns (int) value.
     *
     * @param mixed $key
     * @return int
     *
     * @tag filter
     */
	function getInt($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::getInt($this->_source[$key]);
	}

	/**
     * Returns realpath(value).
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function getPath($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::getPath($this->_source[$key]);
	}

	/**
     * Returns value.
     *
     * @param string $key
     * @return mixed
     *
     * @tag filter
     */
	function getRaw($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return $this->_source[$key];
	}

	/**
     * Returns value if every character is alphabetic or a digit,
     * FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testAlnum($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isAlnum($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if every character is alphabetic, FALSE
     * otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testAlpha($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isAlpha($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is greater than or equal to $min and less
     * than or equal to $max, FALSE otherwise. If $inc is set to
     * FALSE, then the value must be strictly greater than $min and
     * strictly less than $max.
     *
     * @param mixed $key
     * @param mixed $min
     * @param mixed $max
     * @param boolean $inclusive
     * @return mixed
     *
     * @tag validator
     */
	function testBetween($key, $min, $max, $inc = TRUE)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isBetween($this->_source[$key], $min, $max, $inc)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid credit card number format. The
     * optional second argument allows developers to indicate the
     * type.
     *
     * @param mixed $key
     * @param mixed $type
     * @return mixed
     *
     * @tag validator
     */
	function testCcnum($key, $type = NULL)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isCcnum($this->_source[$key], $type)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns $value if it is a valid date, FALSE otherwise. The
     * date is required to be in ISO 8601 format.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testDate($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isDate($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if every character is a digit, FALSE otherwise.
     * This is just like isInt(), except there is no upper limit.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testDigits($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isDigits($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid email format, FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testEmail($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isEmail($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid float value, FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testFloat($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isFloat($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is greater than $min, FALSE otherwise.
     *
     * @param mixed $key
     * @param mixed $min
     * @return mixed
     *
     * @tag validator
     */
	function testGreaterThan($key, $min = NULL)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isGreaterThan($this->_source[$key], $min)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid hexadecimal format, FALSE
     * otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testHex($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isHex($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid hostname, FALSE otherwise.
     * Depending upon the value of $allow, Internet domain names, IP
     * addresses, and/or local network names are considered valid.
     * The default is HOST_ALLOW_ALL, which considers all of the
     * above to be valid.
     *
     * @param mixed $key
     * @param integer $allow bitfield for HOST_ALLOW_DNS, HOST_ALLOW_IP, HOST_ALLOW_LOCAL
     * @return mixed
     *
     * @tag validator
     */
	function testHostname($key, $allow = ISPK_HOST_ALLOW_ALL)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isHostname($this->_source[$key], $allow)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid integer value, FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testInt($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isInt($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid IP format, FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testIp($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isIp($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is less than $max, FALSE otherwise.
     *
     * @param mixed $key
     * @param mixed $max
     * @return mixed
     *
     * @tag validator
     */
	function testLessThan($key, $max = NULL)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isLessThan($this->_source[$key], $max)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is one of $allowed, FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testOneOf($key, $allowed = NULL)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isOneOf($this->_source[$key], $allowed)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid phone number format, FALSE
     * otherwise. The optional second argument indicates the country.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testPhone($key, $country = 'US')
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isPhone($this->_source[$key], $country)) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it matches $pattern, FALSE otherwise. Uses
     * preg_match() for the matching.
     *
     * @param mixed $key
     * @param mixed $pattern
     * @return mixed
     *
     * @tag validator
     */
	function testRegex($key, $pattern = NULL)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isRegex($this->_source[$key], $pattern)) {
			return $this->_source[$key];
		}

		return FALSE;
	}


	/**
	 * Enter description here...
	 *
	 * @param unknown_type $key
	 * @return unknown
	 *
	 * @tag validator
	 */
	function testUri($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isUri($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value if it is a valid US ZIP, FALSE otherwise.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag validator
     */
	function testZip($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		if (Inspekt::isZip($this->_source[$key])) {
			return $this->_source[$key];
		}

		return FALSE;
	}

	/**
     * Returns value with all tags removed.
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function noTags($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::noTags($this->_source[$key]);
	}

	/**
     * Returns basename(value).
     *
     * @param mixed $key
     * @return mixed
     *
     * @tag filter
     */
	function noPath($key)
	{
		if (!$this->keyExists($key)) {
			return false;
		}
		return Inspekt::noPath($this->_source[$key]);
	}

	/**
     * Checks if a key exists
     *
     * @param mixed $key
     * @return bool
     */
	function keyExists($key)
	{
		return array_key_exists($key, $this->_source);
	}

}
