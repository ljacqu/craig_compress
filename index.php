<?php
$test_numbers = [
  18.4500, 66.1000, 123456789098765432123456789
];

require 'CompressionMethod.php';
require 'Gzip.php';
require 'TwoDigitByte.php';

$compression_methods = [
  new Gzip(), new TwoDigitByte()
];


// Start table header
?>
<table>
 <tr>
   <th>Number</th>
<?php
foreach (array_map('get_class', $compression_methods) as $name) {
  printf('<th>%s in</th><th>%s out</th>', $name, $name);
}
?>
 </tr>

<?php
// Apply compression methods
foreach ($test_numbers as $number) {
  echo "\n<tr><td>{$number}</td>";
  foreach ($compression_methods as $method) {
    $compression = $method->compress($number);
    echo '<td>' . $compression . '</td><td>' . $method->decompress($compression) . '</td>';
  }
  echo '</tr>';
}

echo '</table>';

