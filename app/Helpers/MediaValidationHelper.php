<?php
// app/Helpers/MediaValidationHelper.php
namespace App\Helpers; // Use uppercase 'Helpers'

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile; // Import the UploadedFile class

use Illuminate\Support\Facades\Storage;


class MediaValidationHelper
{

    // not used : 
    public static function validateImage(UploadedFile $imageFile)
    {
        $validator = Validator::make(['image' => $imageFile], [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:100000',
            // Adjust max file size and allowed image types as needed
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $imagePath = $imageFile->store('images', 'public');

        return ['success' => true, 'imagePath' => $imagePath];
    }

    // not used : 
    public static function validateVideo(UploadedFile $videoFile)
    {
        $validator = Validator::make(['video' => $videoFile], [
            'video' => 'required|file|mimes:mp4,mpeg|max:1048576',
            // Adjust max file size as needed
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        return ['success' => true];
    }


    // exam questions num convert to arabic (1 --> ) : 
    public static function convertToArabic($number)
    {
        $arabicNumerals = [
            1 => '١',
            2 => '٢',
            3 => '٣',
            4 => '٤',
            5 => '٥',
            6 => '٦',
            7 => '٧',
            8 => '٨',
            9 => '٩',
            10 => '١٠',
            11 => '١١',
            12 => '١٢',
            13 => '١٣',
            14 => '١٤',
            15 => '١٥',
            16 => '١٦',
            17 => '١٧',
            18 => '١٨',
            19 => '١٩',
            20 => '٢٠',
            21 => '٢١',
            22 => '٢٢',
            23 => '٢٣',
            24 => '٢٤',
            25 => '٢٥',
            26 => '٢٦',
            27 => '٢٧',
            28 => '٢٨',
            29 => '٢٩',
            30 => '٣٠',
            31 => '٣١',
            32 => '٣٢',
            33 => '٣٣',
            34 => '٣٤',
            35 => '٣٥',
            36 => '٣٦',
            37 => '٣٧',
            38 => '٣٨',
            39 => '٣٩',
            40 => '٤٠',
            41 => '٤١',
            42 => '٤٢',
            43 => '٤٣',
            44 => '٤٤',
            45 => '٤٥',
            46 => '٤٦',
            47 => '٤٧',
            48 => '٤٨',
            49 => '٤٩',
            50 => '٥٠',
            51 => '٥١',
            52 => '٥٢',
            53 => '٥٣',
            54 => '٥٤',
            55 => '٥٥',
            56 => '٥٦',
            57 => '٥٧',
            58 => '٥٨',
            59 => '٥٩',
            60 => '٦٠',
            61 => '٦١',
            62 => '٦٢',
            63 => '٦٣',
            64 => '٦٤',
            65 => '٦٥',
            66 => '٦٦',
            67 => '٦٧',
            68 => '٦٨',
            69 => '٦٩',
            70 => '٧٠',
            71 => '٧١',
            72 => '٧٢',
            73 => '٧٣',
            74 => '٧٤',
            75 => '٧٥',
            76 => '٧٦',
            77 => '٧٧',
            78 => '٧٨',
            79 => '٧٩',
            80 => '٨٠',
            81 => '٨١',
            82 => '٨٢',
            83 => '٨٣',
            84 => '٨٤',
            85 => '٨٥',
            86 => '٨٦',
            87 => '٨٧',
            88 => '٨٨',
            89 => '٨٩',
            90 => '٩٠',
            91 => '٩١',
            92 => '٩٢',
            93 => '٩٣',
            94 => '٩٤',
            95 => '٩٥',
            96 => '٩٦',
            97 => '٩٧',
            98 => '٩٨',
            99 => '٩٩',
            100 => '١٠٠'
        ];
        if ($number >= 1 && $number <= 100) {
            return $arabicNumerals[$number];
        } else {
            return $number; // Return the original number if out of range
        }
    }


    // exam answers convert to arabic (a --> أ) :
    public static function formatValue($value)
    {
        if (is_numeric($value)) {
            return number_format($value, 0, '.', ',');
        } elseif ($value === 'a') {
            return '(أ)';
        } elseif ($value === 'b') {
            return '(ب)';
        } elseif ($value === 'c') {
            return '(جـ)';
        } elseif ($value === 'd') {
            return '(د)';
        } elseif ($value === 'a2') {
            return '(أ)' . html_entity_decode('&#x00A0;&#x00A0;') . 'درجتان';
        } elseif ($value === 'b2') {
            return '(ب)' . html_entity_decode('&#x00A0;&#x00A0;') . 'درجتان';
        } elseif ($value === 'c2') {
            return '(جـ)' . html_entity_decode('&#x00A0;&#x00A0;') . 'درجتان';
        } elseif ($value === 'd2') {
            return '(د)' . html_entity_decode('&#x00A0;&#x00A0;') . 'درجتان';
        } else {
            return $value;
        }
    }

    // exam answers convert to arabic (a --> أ) :
    public static function formatValueEN($value)
    {
        if (is_numeric($value)) {
            return number_format($value, 0, '.', ',');
        } elseif ($value === 'a') {
            return '(a)';
        } elseif ($value === 'b') {
            return '(b)';
        } elseif ($value === 'c') {
            return '(c)';
        } elseif ($value === 'd') {
            return '(d)';
        } elseif ($value === 'a2') {
            return '(a)' . html_entity_decode('&#x00A0;&#x00A0;') . '2 marks';
        } elseif ($value === 'b2') {
            return '(b)' . html_entity_decode('&#x00A0;&#x00A0;') . '2 marks';
        } elseif ($value === 'c2') {
            return '(c)' . html_entity_decode('&#x00A0;&#x00A0;') . '2 marks';
        } elseif ($value === 'd2') {
            return '(d)' . html_entity_decode('&#x00A0;&#x00A0;') . '2 marks';
        } else {
            return $value;
        }
    }

    // student videos (mp4 or mkv) : 
    public static function getVideoInfo($week, $section, $user_grade)
    {
        $videoName = "week{$week}sec{$section}.mp4";
        $videoName2 = "week{$week}sec{$section}.mkv";
        $videoPath = asset("mrchemistry/storage/app/public/videos/{$user_grade}/{$videoName}");
        $videoPath2 = asset("mrchemistry/storage/app/public/videos/{$user_grade}/{$videoName2}");
        $videoExists = Storage::exists("public/videos/{$user_grade}/{$videoName}");
        $videoExists2 = Storage::exists("public/videos/{$user_grade}/{$videoName2}");

        return [
            'videoName' => $videoName,
            'videoName2' => $videoName2,
            'videoPath' => $videoPath,
            'videoPath2' => $videoPath2,
            'videoExists' => $videoExists,
            'videoExists2' => $videoExists2,
        ];
    }


    // course buy (student page), format lecture names :
    public static function formatFileName($fileName)
    {
        // Extract numbers from the file name
        preg_match_all('/\d+/', $fileName, $matches);

        // Check if we have at least two numbers (week and lecture)
        if (count($matches[0]) >= 2) {
            $week = 'Week ' . $matches[0][0];
            $lecture = 'Lecture ' . $matches[0][1];
            return $week . ', ' . $lecture;
        }

        // If the format doesn't match, return the original name
        return $fileName;
    }


    // reports maek repsonse (not used) : 
    public static function displayResponse($mark, $statment)
    {
        if (isset($mark)) {
            $mark = (float) $mark; // Convert to float if it's a string
            if ($mark >= 90) {
                echo '<h2>ممتاز</h2>';
            } elseif ($mark >= 70) {
                echo '<h2>جيد جدا</h2>';
            } elseif ($mark >= 50) {
                echo '<h2>جيد</h2>';
            } else {
                echo "<h2>$statment</h2>";
            }
        } else {
            echo '<h2>غائب</h2>';
        }
    }
    // $columnTotals["week{$i}sec4"]

}
