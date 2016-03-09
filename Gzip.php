<?php

class Gzip implements CompressionMethod {

  function compress($str) {
    return gzencode($str);
  }

  function decompress($input) {
    return gzdecode($input);
  }

}