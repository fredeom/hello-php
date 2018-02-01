<?php
//namespace Product\Model;
//
//class ProductFilter {
//    public $name;
//    public $producer;
//    public $type;
//    public $pricefrom;
//    public $priceto;
//    public $datefrom;
//    public $dateto;
//    public function exchangeArray ($data = []) {
//        $this->name      = empty($data["name"])      ? "" : $data["name"     ];
//        $this->producer  = empty($data["producer"])  ? "" : $data["producer" ];
//        $this->type      = empty($data["type"])      ? "" : $data["type"     ];
//        $this->pricefrom = empty($data["pricefrom"]) ? "" : $data["pricefrom"];
//        $this->priceto   = empty($data["priceto"])   ? "" : $data["priceto"  ];
//        $this->datefrom  = empty($data["datefrom"])  ? "" : $data["datefrom" ];
//        $this->dateto    = empty($data["dateto"])    ? "" : $data["dateto"   ];
//    }
//    public function getArrayCopy() { return get_object_vars($this); }
//}