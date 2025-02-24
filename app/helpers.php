<?php

use League\CommonMark\CommonMarkConverter;

if (! function_exists('markdownToHtml')) {
  function markdownToHtml($markdown)
  {
    if (empty($markdown)) { // ✅ NULL または空文字ならデフォルト値をセット
      $markdown = "内容がありません。";
    }

    $converter = new CommonMarkConverter();
    return $converter->convertToHtml($markdown);
  }
}
