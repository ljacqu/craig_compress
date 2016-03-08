<?php

class Receiver {

  function consume($input) {
    echo '<br />Received ' . gzdecode($input);
  }


}