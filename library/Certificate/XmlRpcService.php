<?php

class Certificate_Md5Service
{
    public function toMd5($string)
    {
        return md5($string);
    }
}