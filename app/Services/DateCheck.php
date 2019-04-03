<?php

namespace App\Service;

class DateCheck
{
    public function isValid($strDate, $strFormate = 'd\m\Y',$str_timezone = false){
        $data = \DateTime::createFromFormat($strFormate,$strDate);
        if($data && (int) $data->format('Y') < 1900){
            return "invalid date";
        }
        return $data && \DateTime::getLastErrors()['warning_count'] == 0 && \DateTime::getLastErrors()['error_count'] ==0;
    }
}