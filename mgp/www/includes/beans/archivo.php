<?php
include_once 'common/cfile.php';

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
    
    static function saveFormFiles($tic_nro) {
         global $primary_db, $sess;
         $err = array();
         if( !isset($_POST['cfile_op']) )
            return $err;
             
         foreach($_POST['cfile_op'] as $ix=>$op) {
            if($op==='A') {
                $params = array(
                    'doc_code'      => 'ticket:'.$tic_nro,
                    'doc_name'      => $_POST['m_cfile']['doc_name'][$ix],
                    'doc_storage'   => $_POST['m_cfile']['doc_storage'][$ix],
                    'doc_mime'      => $_POST['m_cfile']['doc_mime'][$ix],
                    'doc_size'      => $_POST['m_cfile']['doc_size'][$ix],
                    'doc_note'      => $_POST['m_cfile']['doc_note'][$ix],
                    'use_code'      => $sess->getUserId(),
                    'doc_extension' => pathinfo($_POST['m_cfile']['doc_name'][$ix], PATHINFO_EXTENSION),
                );
                $sql = "insert into doc_documents(doc_code, doc_storage, doc_name, doc_tstamp, doc_mime, doc_size, acl_code, use_code, doc_extension, doc_version, doc_note, doc_deleted, doc_public) 
                                           values(':doc_code:',':doc_storage:',':doc_name:',NOW(),':doc_mime:',':doc_size:',null, ':use_code:',':doc_extension:', '1', ':doc_note:', null, 'Y')";

                $primary_db->do_execute($sql, $err, $params);
                
                //Muevo el archivo al storage definitivo
                $f = new _CFile();
                $f->m_original_file = $params['doc_name'];
                $f->m_hashed_file = $params['doc_storage'];
                
                $msg = $f->save('ticket:'.$tic_nro);
                if( $msg!=='' ) {
                    $err[] = $msg;
                }
            }
        }
        
        return $err;
    }
}