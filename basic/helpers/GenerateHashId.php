<?php

namespace app\helpers;

class GenerateHashId {
	public static function gene() {
		$part1 = uniqid();
		$part2 = uniqid();
		$part3 = uniqid();
		$part4 = uniqid();
		$part5 = uniqid();

		return $part1 . "-" . substr($part2, -4, 4) . "-" . substr($part3, -4, 4) . "-" . substr($part4, -4, 4) . "-" . $part5;
	}
}