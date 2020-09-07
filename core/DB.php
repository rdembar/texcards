<?php

/**
 * DB class: interacts with database
 */

class DB {
    private static $_instance;
    private $_mysqli; 
    
    private function __construct() {
        $this->_mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);      
    }
    
    /*
     * Get instance of self
     *
     * @return DB
     */
    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    
    /**
     * Given sql statement, queries database
     *
     * @param string $sql
     */
    public function query($sql) {
        $this->_mysqli->query($sql);
    }
    
    /**
     * Given table name and array of column => entry
     * pairs to insert, inserts given values into table
     *
     * @param string $table
     * @param array $values
     */
    public function insert($table, $values) {
        $cols = implode(", ", array_keys($values));
        
        $vals = [];
        // Put quotation marks around values
        foreach ($values as $val) {
            $vals[] = "'".$val."'";
        }
        
        $this->_mysqli->query("INSERT INTO ".$table." (".$cols.") VALUES (".implode(", ", $vals).");");
    }
    
    /**
     * Get specified rows from table
     *
     * @param string $table
     * @param array $conditions in column => entry format (if not given, selects all rows)
     * @return array
     */
    public function get_rows($table, $conditions = []) {
        // Turn conditions into array and format
        $cond = [];
        foreach($conditions as $k => $v) {
            $cond[] = $k." = '".$v."'";
        }
                
        // Query database
        $where = $conditions == [] ? "" : " WHERE ";
        $result = $this->_mysqli->query("SELECT * FROM ".$table.$where.implode(", ", $cond).";");
                                        
        
        // Save result of query as array and return
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return (count($arr) == 1) ? $arr[0] : $arr;
    }
    
    /**
     * Get specified columns from table
     *
     * @param string $table
     * @param array or string $columns
     * @return array
     */
    public function get_cols($table, $columns = []) {
        // Fetch data
        $col = $columns == [] ? "*" : (is_array($columns) ? implode(", ", $columns) : $columns);
        $result = $this->_mysqli->query("SELECT ".$col." FROM ".$table.";");
        
        // Save result as array and return
        $arr = [];
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return (count($arr) == 1) ? $arr[0] : $arr;
    }
    
    /**
     * Given a table, array of column => entry pairs, and row id
     * updates entries in given row to match given entries
     *
     * @param string $table
     * @param array $values
     * @param int $id
     */
    public function update($table, $values, $id) {
        $vals = [];
        foreach($values as $k => $v) {
            $vals[] = $k." = '".$v."'";
        }
        
        $this->_mysqli->query("UPDATE ".$table." SET ".implode(", ", $vals)." WHERE id = ".$id.";");
    }
    
    /**
     * Given a table and a row id, deletes that row
     *
     * @param string $table
     * @param int $id
     */
    public function delete($table, $id) {
        $this->_mysqli->query("DELETE FROM ".$table." WHERE id = ".$id.";");
    }
}