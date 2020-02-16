<?php

class DB {
	static protected $db;

	static function init() {
		try {
			self::$db = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], '');
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return self::$db;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			die("\nBad database connection");
		}
	}

	static function get($table, $params) {
		$className = strtoupper($table);
		include_once 'classes/' . $className . '.class.php';

		$data = array();
		$allNulls = true;

		try {
			$select = "SELECT ";
			$where = "WHERE ";

			foreach ($params as $key => $value) {
				$select .= $key . ",";
				if($value !== null) {
					$where .= $key . " = :" . $key . " AND ";
					$allNulls = false;
				}
			}

			$select = trim($select, ",");
			$select .= " FROM " . $table;
			$where = trim($where, " AND ");
			$query = ($allNulls) ? $select : $select . " " . $where;

			$stmt = self::init()->prepare($query);

			foreach ($params as $key => $value) {
				if($value !== null) {
					$stmt->bindValue($key, $value);
				}
			}

			$stmt->execute();

			$stmt->setFetchMode(PDO::FETCH_CLASS, $className);

			while($d = $stmt->fetch()) {
				$data[] = $d;
			}
			
			return $data;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}	
}

?>