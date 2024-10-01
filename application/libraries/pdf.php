<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php'; // If using Composer



use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf {
    public function __construct() {
        // Set options to enable Unicode
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Required if loading remote fonts
        $options->set('isFontSubsettingEnabled', true);
        $options->set('defaultFont', 'NotoSansGujarati'); // Set default font

        parent::__construct($options);
    }
}

