<?php
class AdodbPdoShim {
    private PDO $pdo;
    public function __construct(PDO $pdo){ $this->pdo = $pdo; }
    public function Execute($sql){
        $stmt = $this->pdo->prepare($sql);
        try {
            $ok = $stmt->execute();
        } catch (PDOException $e) {
            // Auto add NULL status/history if missing for legacy inserts without those fields
            if (preg_match('/^\s*INSERT/i',$sql)) {
                $msg = $e->getMessage();
                $patch = false;
                if (strpos($msg, "Field 'status' doesn't have a default value") !== false && strpos($sql,'status')===false) {
                    $sql = preg_replace('/\(([^)]+)\)\s+VALUES\s*\(([^)]+)\)/','($1,`status`) VALUES ($2,\'\')',$sql,1);
                    $patch = true;
                }
                if (strpos($msg, "Field 'modify_id' doesn't have a default value") !== false && strpos($sql,'modify_id')===false) {
                    $sql = preg_replace('/\(([^)]+)\)\s+VALUES\s*\(([^)]+)\)/','($1,`modify_id`) VALUES ($2,\'system\')',$sql,1);
                    $patch = true;
                }
                if (strpos($msg, "Field 'history' doesn't have a default value") !== false && strpos($sql,'history')===false) {
                    $sql = preg_replace('/\(([^)]+)\)\s+VALUES\s*\(([^)]+)\)/','($1,`history`) VALUES ($2,\'auto\')',$sql,1);
                    $patch = true;
                }
                if($patch){
                    $stmt = $this->pdo->prepare($sql);
                    $ok = $stmt->execute();
                } else {
                    throw $e;
                }
            } else {
                throw $e;
            }
            } else {
                throw $e;
            }
        }
        if (!$ok) return false;
        if (preg_match('/^\s*SELECT/i', $sql)) {
            return new AdodbPdoResultShim($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
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
