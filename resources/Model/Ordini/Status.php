<?php
/**
 * Description of Status
 * Get Status based on date (inizio and fine)
 * 
 * @author gullo
 */
class Model_Ordini_Status {
    
    const STATUS_PIANIFICATO = "Pianificato";
    const STATUS_APERTO = "Aperto";
    const STATUS_CHIUSO = "Chiuso";
    const STATUS_ARCHIVIATO = "Archiviato";
    
    private $_inizio;
    private $_fine;
    private $_archiviato;
    
    function __construct($inizio, $fine, $a) {
        $this->_inizio = $inizio;
        $this->_fine = $fine;
        $this->_archiviato = $a;
        
    }
    
    function getStatus() {
        
        if($this->_archiviato != "S") {
            $startObj = new Zend_Date($this->_inizio, "y-MM-dd HH:mm:ss");
            $endObj = new Zend_Date($this->_fine, "y-MM-dd HH:mm:ss");
            
            $timestampNow = Zend_Date::now()->toString("U");
            
            if( $timestampNow < $startObj->toString("U") ) {
                return self::STATUS_PIANIFICATO;
                
            } else if(
                $timestampNow >= $startObj->toString("U") &&
                $timestampNow <= $endObj->toString("U")
                    ) {
                return self::STATUS_APERTO;
                
            } else if( $timestampNow > $endObj->toString("U") ) {
                return self::STATUS_CHIUSO;
            }
            
        } else {
            return self::STATUS_ARCHIVIATO;
        }
    }

    
    /*
    VERIFICHE STATI
 */   
    function is_Pianificato() {
        return ($this->getStatus() == self::STATUS_PIANIFICATO);
    }
    function is_Aperto() {
        return ($this->getStatus() == self::STATUS_APERTO);
    }
    function is_Chiuso() {
        return ($this->getStatus() == self::STATUS_CHIUSO);
    }
    function is_Archiviato() {
        return ($this->getStatus() == self::STATUS_ARCHIVIATO);
    }
    

    /*
    PERMESSI STATI
 */   

    function can_ModificaProdotti() {
        return ( $this->is_Pianificato() ) ? true : false;
    }
    
}