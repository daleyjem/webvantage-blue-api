<?php

namespace com\daleyjem\util {

	class Trace {

		public static function trace($str) {
			echo '<pre>';
			print_r($str);
			echo '</pre>';
		}

		public static function traceFile($str, $append = false, $file = null) {
			if ($file == null) $file = $_SERVER['DOCUMENT_ROOT'] . '/tmp/trace.txt';
			$flags = 0;
			if ($append) $flags = FILE_APPEND;
			file_put_contents($file, $str, $flags);
		}

	}

}