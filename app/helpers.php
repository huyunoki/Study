<?php

use League\CommonMark\CommonMarkConverter;

if (! function_exists('markdownToHtml')) {
  function markdownToHtml($markdown)
  {
    $converter = new CommonMarkConverter();
    return $converter->convertToHtml($markdown);
  }
}
