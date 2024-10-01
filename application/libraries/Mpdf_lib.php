<?php
use Mpdf\Mpdf;

class Mpdf_lib {
    public function __construct() {
        // Correct path to the vendor directory
        $autoload_path = FCPATH . 'vendor/autoload.php';
        if (!file_exists($autoload_path)) {
            die('Autoload file not found at ' . $autoload_path);
        }
        require_once $autoload_path;
    }
    
    public function get_mpdf($config = []) {
        return new Mpdf($config);
    }
}
