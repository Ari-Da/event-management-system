<?php

class DB {
	static protected $db;

	static function init() {
		try {
			if(is_null(self::$db)) {
				self::$db = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], '');
				self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}

			return self::$db;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			die("\nBad database connection");
		}
	}

	static function get($table, $params) {
		$className = ucfirst($table);
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

			// $stmt->debugDumpParams();
			
			return $data;
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return array();
		}
	}	

	static function set($query, $params, $count = false) {
		$db = self::init();
		try {
			$stmt = $db->prepare($query);
			
			foreach ($params as $key => $value) {
				$stmt->bindValue($key, $value);
			}

			if(!$stmt->execute()) {
				return 0;
			}
			// $stmt->debugDumpParams();

			if($count) {
				return $stmt->rowCount();
			}
			else {
				return $db->lastInsertId();
			}

		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return 0;
		}
	}

	static function startTransaction() {
		try {
			return self::init()->beginTransaction();
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return false;
		}
	}

	static function commitTransaction() {
		try {
			return self::init()->commit();
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return false;
		}
	}

	static function rollTransaction() {
		try {
			return self::init()->rollBack();
		} catch (PDOException $e) {
			// display the error message
			echo $e->getMessage();
			return false;
		}
	}
}

?>