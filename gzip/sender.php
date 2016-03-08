<?php

$test_numbers = [
  18.4500, 66.1000, 123456789098765432123456789
];

require 'Receiver.php';

$receiver = new Receiver();


foreach ($test_numbers as $test_number) {
  $compressed = gzencode($test_number);
  echo "<hr />Sending $test_number <span style='font-size: 0.75em'>(compressed to $compressed)</span>";
  $receiver->consume($compressed);
}