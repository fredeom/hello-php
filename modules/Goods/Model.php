<?php

class Model {
    public function __construct($config) {
        $this->config = $config;
        $this->conn = new PDO("mysql:host=" . $config["dbhost"] . ";dbname=" . $config["dbname"],
                              $config["dbusername"], $config["dbuserpass"]);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function prepareSql($form) {
        $filter = "";
        $filterParams = array();
        foreach ($this->config["colnames"] as $name) {
            if (!empty($form[$name])) {
                $filterParams[]="%" . $form["name"] . "%";
                $filter .= " and $name like ?";
            }
        }
        if ("" . intval($form["pricefrom"]) == $form["pricefrom"]) {
            $filter .= " and price >= " . $form["pricefrom"];
        }
        if ("" . intval($form["priceto"]) == $form["priceto"]) {
            $filter .= " and price <= " . $form["priceto"];
        }
        if (!empty($form["datefrom"])) {
            $filter .= " and regdate >= '" .$form["datefrom"] . "'";
        }
        if (!empty($form["dateto"])) {
            $filter .= " and regdate < '" . date('Y-m-d',strtotime("+1 day", strtotime($form["dateto"]))) . "'";
        }
        if (!empty($filter)) $filter = " WHERE" . substr($filter, 4);

        return array(
            "SELECT * FROM " . $this->config["gentablename"] . $filter . " " . "ORDER BY " . $form["sortBy"],
            $filterParams);
    }

    public function getCount($form) {
        $sqlWithFilters = $this->prepareSql($form);
        $stmt = $this->conn->prepare($sqlWithFilters[0]);
        $stmt->execute($sqlWithFilters[1]);
        $row_count = $stmt->rowCount();
        $pageCount = ceil($row_count / $this->config["rowsperpage"]);
        if ($pageCount == 0) $pageCount = 1;
        return $pageCount;
    }

    public function adjustPageId($pageId, $pageCount) {
        $pageId = intval($pageId);
        if ($pageId < 1) $pageId = 1; else if ($pageId > $pageCount) $pageId = $pageCount;
        return $pageId;
    }

    public function getList($form, $pageId) {
        $sqlWithFilters = $this->prepareSql($form);
        $sql = $sqlWithFilters[0];
        $sql = $sql . " LIMIT " . (($pageId - 1) * $this->config["rowsperpage"]) . ", " . $this->config["rowsperpage"];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($sqlWithFilters[1]);
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $list = array();
        foreach ($stmt->fetchAll() as $k => $v) {
            $row = array();
            foreach ($v as $nk => $nv) {
                if ($nk != "id") {
                    $row []= $nv;
                }
            }
            $list []= $row;
        }
        return $list;
    }
}