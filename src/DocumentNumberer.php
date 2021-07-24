<?php

namespace Yeeraf\DocumentNumberer;


use Yeeraf\DocumentNumberer\Models\DocumentNumber;

class DocumentNumberer
{
    protected $prefix;
    protected $suffix;
    protected $padString;
    protected $padLength;
    protected $padType;
    protected $autoExtend;

    protected $currentDocumentNumber;

    public function __construct()
    {
        $this->prefix = \Carbon\Carbon::today()->format("ym");
        $this->suffix = "";
        $this->padLength = 6;
        $this->padString = "0";
        $this->padType = "left";
        $this->autoExtend = true;
    }

    public function generate()
    {
        $dn = $this->getCurrentDocumentNumber();

        return  $dn->prefix . $this->createRunningnumber($dn) . $dn->suffix;
    }

    public function prefix(string $prefix)
    {
        $this->prefix = $prefix ?? $this->prefix;

        return $this;
    }

    public function suffix(string $suffix)
    {
        $this->suffix = $suffix ?? $this->suffix;

        return $this;
    }

    public function padLength(string $padLength)
    {
        $this->padLength = $padLength ?? $this->padLength;

        return $this;
    }

    public function padString(string $padString)
    {
        $this->padString = $padString ?? $this->padString;

        return $this;
    }

    public function padType(string $padType)
    {
        $this->padType = $padType  == 'right' ? 'right' : 'left';

        return $this;
    }

    public function autoExtend(bool $autoExtend = true)
    {
        $this->autoExtend = $autoExtend === true ? true : false;

        return $this;
    }


    public function getCurrentDocumentNumber(): DocumentNumber
    {
        $dn = DocumentNumber::firstOrCreate(
            [
                "prefix" => $this->prefix,
                "suffix" => $this->suffix,
                "pad_length" => $this->padLength,
                "pad_string" => $this->padString,
                "pad_type" => $this->padType === "right" ? "right" : 'left',
            ],
            [
                "current_number" => 0,
            ]
        );

        $dn->increment('current_number');

        return $dn;
    }


    public  function createRunningnumber($dn): string
    {
        $padType =  $dn->pad_type === "right" ? STR_PAD_RIGHT : STR_PAD_LEFT;

        $generated = str_pad(
            $dn->current_number,
            $dn->pad_length,
            $dn->pad_string,
            $padType
        );

        if (!$this->autoExtend &&  strlen($generated) > (int) $dn->pad_length) {
            // dd(strlen($generated), (int) $dn->pad_length);
            throw new \Exception("running number lenght go over pad lenght", 1);
        }

        return $generated;
    }
}
