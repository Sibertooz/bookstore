<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    public function __construct(string $string, string $string1, string $string2, bool $true, string $string3, bool $false) { parent::__construct(); }
}