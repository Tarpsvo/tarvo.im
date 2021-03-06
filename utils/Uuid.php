<?php
/**
 * UUID class
 *
 * The following class generates VALID RFC 4122 COMPLIANT
 * Universally Unique IDentifiers (UUID) version 3, 4 and 5.
 *
 * UUIDs generated validates using OSSP UUID Tool, and output
 * for named-based UUIDs are exactly the same. This is a pure
 * PHP implementation.
 *
 * @author Andrew Moore
 * @link http://www.php.net/manual/en/function.uniqid.php#94959
 */

class UUID {
    const NAMESPACE_DNS = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

	public static function v5($namespace, $name) {
		if(!self::is_valid($namespace)) return false;
		$nhex = str_replace(array('-','{','}'), '', $namespace);
		$nstr = '';
		for($i = 0; $i < strlen($nhex); $i+=2)
		{
			$nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
		}
		$hash = sha1($nstr . $name);
		return sprintf('%08s-%04s-%04x-%04x-%12s',
		substr($hash, 0, 8),
		substr($hash, 8, 4),
		(hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
		(hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
		substr($hash, 20, 12)
		);
	}

	public static function is_valid($uuid) {
		return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
                      '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
	}
}
