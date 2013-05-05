<?php

class archivo {
    public $doc_storage;
    public $doc_name;
    public $doc_note;
    
    static function factory($tic_nro) {
        global $primary_db;
        $archivos = array();
        $rs = $primary_db->do_execute("select doc_storage,doc_name,doc_note from doc_documents where doc_code='ticket:{$tic_nro}'");
        while($row=$primary_db->_fetch_row($rs)){
            $arch = new archivo();
            $arch->doc_name = $row['doc_name'];
            $arch->doc_note = $row['doc_note'];
            $arch->doc_storage = $row['doc_storage'];
            
            $archivos[] = $arch;
        }
        
        return $archivos;
    }
}