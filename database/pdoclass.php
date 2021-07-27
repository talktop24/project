<?php
	class iPDO{
		public $connect;
	    function __construct($database_type='mysql')
	    {
	        try {
		        // MS SQL
		        if ($database_type == 'mssql'){
			        $host_name = '127.0.0.1';
			        $database = 'db';
			        $username_connect = 'sa';
			        $password_connect = 'pppp';
					//$this->connect = new PDO('dblib:host=' . $host_name .':1433;dbname=' . $database , $username_connect, $password_connect  );							        
					$dsn = "sqlsrv:server=" . $host_name . ";Database=BOT";
					$this->connect = new PDO ($dsn, "sa", "ppp");

					$this->connect->setAttribute(PDO::ATTR_TIMEOUT ,6000);
					//$sql = "set CHARACTER SET utf8";
					
			         
		        }

		        if ($database_type == 'mysql'){
			        $host_name = 'localhost';
			        $database = 'db';
			        $username_connect = 'user';
			        $password_connect = '@=1234'; 

			        $this->connect = new PDO('mysql:host=' . $host_name .';charset=utf8;dbname=' . $database , $username_connect, $password_connect);
					$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "set CHARACTER SET utf8";
					$tr = $this->run($sql);
				}
				
				if ($database_type == 'oracle'){
					$host_name = 'xxxx';
			        $database = 'PWACIS';
			        $username_connect = 'user';
			        $password_connect = 'ppp';
			        $this->connect = new PDO('oci:dbname=' . $host_name . ';charset=UTF8', $username_connect, $password_connect);
					$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				}
			} catch (PDOException $e) {
			    echo "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}

	    }
	    function transaction(){
			$this->connect->beginTransaction();
		}

		function commit(){
			$this->connect->commit();
		}

		function rollback(){
			$this->connect->rollBack();
		}

	    function run($sql)
	    {	
		    try{
			    $re = $this->connect->prepare($sql);
				$re->execute();
			    return $re;		    
		        
			} catch (PDOException $e) {
			    print "Error!: $sql " . $e->getMessage() . "<br/>";
			    die();
			}
		}
		
		function query($sql){
			try{
				$re = $this->connect->prepare($sql);				
				$re->execute();
				$results = $re->fetchAll(PDO::FETCH_OBJ);
			    return $results;		    
			} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
		}
	    
	    function fetch($re){
		    return $re->fetch(PDO::FETCH_ASSOC);
	    }
	    
	    function find($table,$cond='',$order_by=''){
		    $sql = "select * from $table ";
	        if (trim ($cond) != '') {
	            $sql .= " where $cond ";
	        }
	        if (trim ($order_by) != '') {
	            $sql .= " order by $order_by";
	        }
	        $re = $this->run ($sql);
	        return $re;
		}
		
	    function search($table,$cond='',$order_by=''){
		    $sql = "select * from $table ";
	        if (trim ($cond) != '') {
	            $sql .= " where $cond ";
	        }
	        if (trim ($order_by) != '') {
	            $sql .= " order by $order_by";
	        }
			try{
				$re = $this->connect->prepare($sql);				
				$re->execute();
				$results = $re->fetchAll(PDO::FETCH_OBJ);
			    return $results;		    
			} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
			
		}
		
		function set_json($re){
			$json = array();
			while ($r = $this->fetch($re)) {
				$json[] = $r;
			}
			$js = json_encode($json);
			return json_decode($js);
		}

		function insert ($table, $value) // value เขียนแบบ json
	    {
		    try {
		        $field = "";
				$qq = '';
				$dta = json_decode($value);
				$ar = array();
		        foreach($dta as $key => $vale) {
					$field .= "$key,";
					$qq .= "?,";
					array_push($ar, addslashes($vale) );
				}
				$field = substr($field, 0, -1);
				$qq = substr($qq, 0, -1);
				$sql = "insert into $table ($field) values ($qq)";
				
				$stmt = $this->connect->prepare($sql);
				$stmt->execute($ar);
	        } catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
	    }
	    
	    function update($table,$value,$id){
		    if ($id == 0) {
            	$this->insert ($table, $value);
        	}else{
		        try {
			        $field = "";
					$val = "";
					$ar = array();
					$qq = '';
			        $dta = json_decode($value);
			        foreach($dta as $key => $vale) {
						$val .= "$key = ?,";
						array_push($ar, addslashes($vale) );
					}
					$val = substr($val, 0, -1);
					$sql = "update $table set $val where id = $id";
					$stmt = $this->connect->prepare($sql);
					$stmt->execute($ar);
		        } catch (PDOException $e) {
				    print "Error!: " . $e->getMessage() . "<br/>";
				    die();
				}
        	}
		}

	    function delete ($table, $id)
	    {
	        $sql = "delete from $table where id = $id";
	        $this->connect->exec($sql); 
		}
		
	    function select_db($db_name){
		    try {
		    	$this->connect->query("use $db_name");
			} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
	    }
	    
	    function val($table,$field,$id){
		    $sql = "select $field from $table where id = $id";
	        $re = $this->run ($sql);
	        $r = $this->fetch ($re);
	        return $r["$field"];
	    }
	    
	    function rows($re){
		    return $re->rowCount();
		}
		
		function record($table,$id){
			$sql = "select * from $table where id = $id";
			$re = $this->run($sql);
			if ($this->rows($re) > 0){
				$r = $this->fetch($re);
				$ret = json_encode($r);
				$jso = json_decode($ret);
			}else{
				$js = array();
				$ret = json_encode($js);
				$jso = json_decode($ret);
			}
			return $jso;
		}

		function close(){
			$this->connect = NULL;
		}
	}