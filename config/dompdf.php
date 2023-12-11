<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,
    'public_path' => null,

    'options' => array(
        'convert_entities' => true,

        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'enable_font_subsetting' => false,

        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),

        'allowed_protocols' => [
            "file://" => ["rules" => []],
            "http://" => ["rules" => []],
            "https://" => ["rules" => []]
        ],

        'log_output_file' => null,

        'enable_font_subsetting' => false,

        'pdf_backend' => 'CPDF',

        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'serif',

        // Set encoding and language for Arabic characters
        'font_family' => 'serif',
        'font_size' => '12',
        'font_style' => 'normal',
        'font_weight' => 'normal',
        'word_wrap' => 50,
        'encoding' => 'UTF-8',
        'language' => 'ar',

        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
    ),
);
