<?php
    class crud
    {
        private $array;
        public function getInsert($insert)
        {
            return $insert;
        }
        public function getdelete($delete)
        {
            return $delete;
        }
        public function getUpdate($update)
        {
            return $update;
        }
        /*name	
        nif	
        birthDate	
        sex	
        status	
        qtdSon
        studentLevel	
        profition	
        address	howToMetedTheCompany	
        createdAt	
        updatedAt*/
        public function Insert($n, $N, $b, $s, $S, $qtd, $Sl, $p, $a, $buttom)
        {
           global $pdo;
            if(isset($_POST[''.$buttom.'']))
            {
                $sql = $pdo->prepare("INSERT INTO person VALUES(:n, :N, :b, :s, :S, :qtd, :Sl, :p, :a)");
                $sql->bindParam(":n", $n);
                $sql->bindParam(":N", $N);
                $sql->bindParam(":b", $b);
                $sql->bindParam(":s", $s);
                $sql->bindParam(":S", $S);
                $sql->bindParam(":qtd", $qtd);
                $sql->bindParam(":Sl", $Sl);
                $sql->bindParam(":p", $p);
                $sql->bindParam(":a", $a);
                $sql->execute();
                if($sql->rowCount() > 0)
                {   
                    return true;
                }
                else
                {
                    return false;    
                }
            }
        }
    }
?>