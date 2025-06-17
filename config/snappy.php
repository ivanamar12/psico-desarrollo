<?php

return [
  /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    */

  'pdf' => [
    'enabled' => true,
    'binary'  => env('WKHTML_PDF_BINARY', '/usr/bin/wkhtmltopdf'),
    'timeout' => false,
    'options' => [],
    'env'     => [],
  ],

  'image' => [
    'enabled' => true,
    'binary'  => env('WKHTML_IMG_BINARY', '/usr/bin/wkhtmltoimage'),
    'timeout' => false,
    'options' => [],
    'env'     => [],
  ],
];
