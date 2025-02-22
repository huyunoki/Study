<?php

namespace App\Helpers;

use League\CommonMark\CommonMarkConverter;
use HTMLPurifier;
use HTMLPurifier_Config;

class MarkdownHelper
{
  public static function parseMarkdown($text)
  {
    $converter = new CommonMarkConverter([
      'html_input' => 'escape', // HTML をエスケープ
      'allow_unsafe_links' => false, // 不正なリンクを無効化
    ]);
    return $converter->convertToHtml($text);
  }

  public static function cleanHtml($html)
  {
    $config = HTMLPurifier_Config::createDefault();

    // キャッシュディレクトリを変更（Laravelのstorage内に設定）
    $config->set('Cache.SerializerPath', storage_path('app/htmlpurifier'));

    $purifier = new HTMLPurifier($config);
    return $purifier->purify($html);
  }
}
