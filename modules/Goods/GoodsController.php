<?php

require __DIR__ . "/../../core/AbstractController.php";
require __DIR__ . "/../../core/ViewModel.php";
require __DIR__ . "/Model.php";

class GoodsController extends AbstractController {
    public function indexAction() {
        $this->form = array(
            "name"      => isset($_REQUEST["name"])      ? $_REQUEST["name"]      : "",
            "producer"  => isset($_REQUEST["producer"])  ? $_REQUEST["producer"]  : "",
            "type"      => isset($_REQUEST["type"])      ? $_REQUEST["type"]      : "",
            "pricefrom" => isset($_REQUEST["pricefrom"]) ? $_REQUEST["pricefrom"] : "",
            "priceto"   => isset($_REQUEST["priceto"])   ? $_REQUEST["priceto"]   : "",
            "datefrom"  => isset($_REQUEST["datefrom"])  ? $_REQUEST["datefrom"]  : "",
            "dateto"    => isset($_REQUEST["dateto"])    ? $_REQUEST["dateto"]    : "",
            "pageid"    => isset($_REQUEST["pageid"])    ? $_REQUEST["pageid"]    : "1",
            "sortBy"    => isset($_REQUEST["sortBy"])    ? $_REQUEST["sortBy"]    : "regdate desc"
        );

        try {
            $this->model = new Model($this->config);
            $this->pageCount = $this->model->getCount($this->form);
            $this->pageId = $this->model->adjustPageId($this->form["pageid"], $this->pageCount);
            $this->rows = $this->model->getlist($this->form, $this->pageId);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return new ViewModel(array(
            "form" => $this->form,
            "model" => $this->model,
            "pageCount" => $this->pageCount,
            "pageId" => $this->pageId,
            "rows" => $this->rows,
            "colnames" => $this->config["colnames"]),
                   "../layouts/main.php"
        );
    }
}