<?php
/**
 * Created by PhpStorm.
 * User: severine
 * Date: 09/05/18
 * Time: 21:50
 */

namespace WCS\CoavBundle\Service\Import;


class convertCsvToArrayService
{

    public function convert($filename)
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 150)) !== FALSE) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }

}