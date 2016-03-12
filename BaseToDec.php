<?php

/**
 * Class for converting a base b (2 <= b <= 62) to base-10.
 */
class BaseToDec {
  // Array of all 62 characters at our disposal: 0-9, A-Z, a-z
  private $chars;
  
  public function __construct() {
    $this->chars = array_flip(array_merge(range(0, 9), range('A', 'Z'), range('a', 'z')));
  }

  function convertToDec($base, $input) {
    $input = (string) $input;
    $decimal_index = strpos($input, '.');
    if ($decimal_index === false) {
      $decimal_index = strlen($input);
    }
    // $decimal_index is equal to the length of characters before the decimal point
    // therefore, the left-most digit stands for the value $base^($decimal_index-1)
    $exponent = $decimal_index - 1;
    $result = 0;
    for ($i = 0; $i < strlen($input); ++$i) {
      if ($input[$i] === '.') {
	    continue;
	  }
      $result += $this->digitToValue($input[$i]) * pow($base, $exponent);
	  --$exponent;
    }
    return $result;
  }

  private function digitToValue($char) {
	return $this->chars[$char];
  }
}