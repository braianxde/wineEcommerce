<?php
namespace Common;

use SQLite3;

class dbWine extends SQLite3 {
    function __construct() {
        $this->open('Phinx/db/wineDatabase.db');
    }
}
?>