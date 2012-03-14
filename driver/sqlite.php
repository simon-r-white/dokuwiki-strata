<?php
/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Brend Wanders <b.wanders@utwente.nl>
 */
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once(DOKU_PLUGIN.'stratastorage/driver/driver.php');

/**
 * The base class for database drivers.
 */
class plugin_strata_driver_sqlite extends plugin_strata_driver {

    public function ci($val='?') {
        return "$val COLLATE NOCASE";
    }

    public function orderBy($val, $asc=true) {
        $order = $asc ? 'ASC' : 'DESC';
        // Sort first on numeric prefix and then on full string
        return "CAST($val AS NUMERIC) $order, $val $order";
    }

    public function isInitialized() {
        return $this->_db->query("SELECT count(*) FROM sqlite_master WHERE name = 'data'")->fetchColumn() != 0;
    }
}
