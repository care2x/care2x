<?php
class AdodbPdoShim {
    private PDO $pdo;
    public function __construct(PDO $pdo){ $this->pdo = $pdo; }
    public function Execute($sql){
        $stmt = $this->pdo->prepare($sql);
        $ok = $stmt->execute();
        if (!$ok) return false;
        if (preg_match('/^\s*SELECT/i', $sql)) {
            return new AdodbPdoResultShim($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        // for UPDATE/INSERT/DELETE return true like ADODB
        return true;
    }
    public function SelectLimit($sql, $maxrows= -1, $offset= -1){
        $sql .= ' LIMIT '.(int)$maxrows.' OFFSET '.(int)$offset;
        return $this->Execute($sql);
    }
    public function BeginTrans(){ $this->pdo->beginTransaction(); }
    public function CommitTrans(){ $this->pdo->commit(); }
    public function RollbackTrans(){ if($this->pdo->inTransaction()) $this->pdo->rollBack(); }
    public function Insert_ID(){ return $this->pdo->lastInsertId(); }
}
class AdodbPdoResultShim {
    private array $rows;
    private int $pos = 0;
    public function __construct(array $rows){ $this->rows = array_values($rows); }
    public function RecordCount(){ return count($this->rows); }
    public function FetchRow(){
        if ($this->pos >= count($this->rows)) return false;
        return $this->rows[$this->pos++];
    }
}
