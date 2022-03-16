<?php


class DB
{

    protected	$db_name	= 'testdb';
    protected	$db_prefix	= '';
    protected	$db_user	= 'root';
    protected	$db_pass	= '';
    protected	$db_host	= 'localhost';
    public		$mysqli		= null;

    public function connection()
    {
        $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        $this->mysqli->set_charset('utf8mb4');
        return $this;
    }

    public function processRowSet($rowSet, $singleRow = false)
    {
        $resultArray = array();
        while($row = $rowSet->fetch_assoc())
            array_push($resultArray, $row);
        if(count($resultArray) == 1 && !$singleRow)
            return $resultArray[0];
        return $resultArray;
    }


    public function select($table, $where, $multiple = false, $order = null, $what = "*")
    {
        $sql = "SELECT " . $what . " FROM " . $this->db_prefix. "$table " . (!empty($where) ? " where $where" : '') .(!empty($oder)  ? " ORDER BY $order": '');
        var_dump($sql);
        $result = $this->mysqli->query($sql);

        if(!$result || $result->num_rows == 0) {
            return false;
        }

        return $this->processRowSet($result, $multiple);
    }
}