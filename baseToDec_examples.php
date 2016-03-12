<?php
require 'BaseToDec.php';

$examples = [
  new Ex(62, 'fhe', 160310),
  new Ex(62, 'yTh', 232481),
  new Ex(62, 'Gr7', 64797),
  new Ex(62, 'akTc', 8758468),
  new Ex(62, 'a2Px.qeW', 8589105.849236),
  new Ex(16, 'A2F.C6',  2607.77340),
  new Ex(2, '10101101011', 1387),
  new Ex(36, 'Z9PT.F', 1645553.4155)
];

$baseToDec = new BaseToDec();

echo '<table><tr><th>Base</th><th>Input</th><th>Output</th><th>Expected</th></tr>';

foreach ($examples as $example) {
  echo "\n" . '<tr><td>' . $example->base . '</td><td>' . $example->value . '</td>';
  echo '<td>' . $baseToDec->convertToDec($example->base, $example->value) . '</td>';
  echo '<td>' . $example->expectedDec . '</td></tr>';
}
echo '</table>';


class Ex {

  public $base;
  public $value;
  public $expectedDec;

  function __construct($base, $value, $expectedDec) {
    $this->base = $base;
	$this->value = $value;
	$this->expectedDec = $expectedDec;
  }
}