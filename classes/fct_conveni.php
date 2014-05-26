<?php

require_once ('fct_franja_horari.php');

class fct_conveni {
    public $uuid;
    public $codi = '';
    public $data_inici;
    public $data_final;
    public $horari;

    public function __construct($data) {

        if (isset($data->uuid)) {
            $this->uuid = $data->uuid;
        }
        if (isset($data->codi)) {
            $this->codi = $data->codi;
        }
        if (isset($data->data_inici)) {
            $this->data_inici =  $data->data_inici;
        }
        if (isset($data->data_final)) {
            $this->data_final = $data->data_final;
        }
        $arrayhorari = array();
        if (isset($data->horari)) {
            foreach ($data->horari as $horari) {
                $arrayhorari[] = new fct_franja_horari($horari);
            }
            $this->horari = $arrayhorari;
        }
    }

    public function hores_dia($dia) {
        $hores = 0.0;
        foreach ($this->horari as $franja) {
            if ($franja->dia == $dia) {
                $hores += $franja->hores();
            }
        }
        return $hores;
    }

    public function uuid() {

        $octets = array();

        for ($n = 0; $n < 16; $n++) {
            $octets[] = mt_rand(0, 255);
        }

        $octets[8] = ($octets[8] | 0x80) & 0xbf; // variant ISO/IEC 11578:1996
        $octets[6] = ($octets[6] & 0x0f) | 0x40; // version 4 (random)

        return sprintf('%02x%02x%02x%02x-%02x%02x-%02x%02x-%02x%02x'
                       .'-%02x%02x%02x%02x%02x%02x',
                       $octets[0], $octets[1], $octets[2], $octets[3],
                       $octets[4], $octets[5], $octets[6], $octets[7],
                       $octets[8], $octets[9], $octets[10], $octets[11],
                       $octets[12], $octets[13], $octets[14], $octets[15]);

    }

}