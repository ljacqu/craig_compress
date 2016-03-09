<?php

interface CompressionMethod {

  function compress($str);

  function decompress($str);

}