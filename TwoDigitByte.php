<?php

// idea: we only deal with 0-9 and some other symbols
// We only require 4 bits to represent them -> 2^4 = 16 possibilities
// A byte has 8 bits so we just "cram" two digits into each byte

class TwoDigitByte implements CompressionMethod {

  const PADDING = 15;
  
  private static $codes = [
    '.' => 10,
    '-' => 11,
    'E' => 12,
    '+' => 13
  ];

  function compress($str) {
    $str = (string) $str;
    $result = "";
    $byte = 0x0;
    for ($i = 0; $i < strlen($str); $i += 2) {
      $first_code = $this->charToCode($str[$i]);
      $second_code = ($i + 1 < strlen($str)) 
        ? $this->charToCode($str[$i + 1])
        : self::PADDING;
      
      $result .= chr($first_code << 4 | $second_code);
    }
    return $result;
  }

  function decompress($str) {
    $str = (string) $str;
    $result = "";
    for ($i = 0; $i < strlen($str); ++$i) {
      $digit = ord($str[$i]);
      $first_code  = $digit >> 4;
      $second_code = $digit & 0x0F;
      $result .= $this->codeToChar($first_code) 
               . $this->codeToChar($second_code);
    }
    return $result;
  }
  
  // Converts a character to its numeric code
  private function charToCode($char) {
    if (preg_match('/\\d/', $char)) {
      return (int) $char;
    } else if (isset(self::$codes[$char])) {
      return self::$codes[$char];
    }
    throw new Exception('Unknown character "' . htmlspecialchars($char) . '"');
  }

  // Converts a code to the character it stands for
  private function codeToChar($code) {
    if ($code < 10) {
      return (string) $code;
    } else if ($code === self::PADDING) {
      return '';
    }

    $key = array_search($code, self::$codes);
    if ($key === false) {
      throw new Exception('Unknown code "' . htmlspecialchars($code) . '"');
    }
    return $key;
  }

}