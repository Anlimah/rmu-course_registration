<?php

require_once('general_handler.php');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class AdminHandler extends GeneralHandler
{

	public function getSettingsID()
	{
		return $this->getID("SELECT `id` FROM `settings` WHERE `using` = 1");
	}

	public function getSettingsStatus()
	{
		$sql = "SELECT `later_date` FROM `setted` WHERE `set_later` = 1";
		$result = $this->getData($sql);

		if ($result != 0) {
			$remaining_days = strtotime($result[0]["later_date"]) - strtotime(date("Y-m-d"));
			$remaining_days = round((($remaining_days / 24) / 60) / 60);
			return $remaining_days;
		} else {
			return $this->getSettingDueStatus();
		}
	}

	public function getSettingDueStatus()
	{
		$sql = "SELECT `end_date` FROM `settings` WHERE `using` = 1";
		$result = $this->getData($sql);

		if ($result != 0) {
			$remaining_days = strtotime($result[0]["end_date"]) - strtotime(date("Y-m-d"));
			$remaining_days = round((($remaining_days / 24) / 60) / 60);
			return $remaining_days;
		}
		return 0;
	}

	public function setLater()
	{
		$date = date("Y-m-d");
		$date = strtotime($date);
		$date = strtotime("+7 day", $date);
		$date = date("Y-m-d", $date);
		$sql = "UPDATE `setted` SET `set_later` = 1, `later_date` =:d WHERE `id` = 1";
		$result = $this->inputData($sql, array(':d' => $date));
		if ($result == 1) {
			return '[{"success":"ok' . $result . '"}]';
		}
		return '[{"error":"error' . $result . '"}]';
	}

	public function getAcademicYears()
	{
		return $this->getData("SELECT * FROM `academic_year`");
	}

	public function getSemesters()
	{
		return $this->getData("SELECT * FROM `semester`");
	}

	public function getPrograms()
	{
		return $this->getData("SELECT * FROM `program`");
	}

	public function addAcademicYear($start, $end)
	{
		$sql = "INSERT INTO `academic_year`(`start`, `end`) VALUES(:s, :e)";
		if ($this->inputData($sql, array(":s" => $start, ":e" => $end))) {
			return '[{"success":"Successfully added academic year!"}]';
		} else {
			return '[{"error":"Failed to add an academic year!"}]';
		}
	}

	public function addAProgram($program)
	{
		$sql = "INSERT INTO `academic_year`(`program`) VALUES(:p)";
		if ($this->inputData($sql, array(":s" => $program))) {
			return '[{"success":"Successfully added program!"}]';
		} else {
			return '[{"error":"Failed to add a program!"}]';
		}
	}

	private function getSetIDByAcaAndSem($acaid, $semid)
	{
		$sql = "SELECT `id` FROM `settings` WHERE `acaid` = :a AND `semid` = :s";
		return $this->getID($sql, array(':a' => $acaid, ':s' => $semid));
	}

	private function addQRCodesFromSettingsSetup()
	{
		$results = $this->getData("SELECT * FROM `students` WHERE `deleted` = 0 AND `done` = 0 AND `type` = 2");
		if (!empty($results)) {
			$set = $this->getSettingsID();
			foreach ($results as $key => $data) {
				$permit = $this->genCode();
				$sql = "INSERT INTO `secret_codes` (`sid`, `set`, `permit`, `qr_code`)
						VALUES(:i, :s, :p, :q)";
				$params = array(
					':i' => $data["id"],
					':s' => $set,
					':p' => $permit,
					':q' => sha1($permit)
				);
				$this->inputData($sql, $params);
			}
		}
		return 1;
	}

	private function addQRCodesFromDataUploads($user_id)
	{
		$permit = $this->genCode();
		$sql = "INSERT INTO `secret_codes` (`sid`, `set`, `permit`, `qr_code`)
				VALUES(:i, :s, :p, :q)";
		$params = array(
			':i' => $user_id,
			':s' => $this->getSettingsID(),
			':p' => $permit,
			':q' => sha1($permit)
		);
		return $this->inputData($sql, $params);
	}


	public function checkUser($index, $password)
	{
		$sql = "SELECT `id`, `type` FROM `students` 
				WHERE `index` = :i AND `password` = :p AND `deleted` = 0";
		$params = array(':i' => $index, ':p' => sha1($password));
		return $this->getData($sql, $params);
	}

	private function getProgramIdByName($program)
	{
		$sql = "SELECT `id` FROM `program` WHERE `program` LIKE '%$program%'";
		return $this->getID($sql, array(':p' => $program));
	}

	public function getAllStudent($i)
	{
		$sql = "";
		if ($i == 1) {
			//get not deleted students
			$sql .= "SELECT s.`id`, s.`index`, p.`program`, 
				s.`fname`, s.`mname`, s.`lname`, f.`bal` 
				FROM `students` AS s, `finance` AS f, `program` AS p 
				WHERE s.`type` = 2 AND s.`deleted` = 0 
				AND s.`id` = f.`sid` AND s.`pid` = p.`id`";
		} else {
			//get deleted students
			$sql .= "SELECT s.`id`, s.`index`, p.`program`, 
				s.`fname`, s.`mname`, s.`lname`, f.`bal` 
				FROM `students` AS s, `finance` AS f, `program` AS p 
				WHERE s.`type` = 2 AND s.`deleted` = 1 
				AND s.`id` = f.`sid` AND s.`pid` = p.`id`";
		}

		return $this->getData($sql);
	}

	//get one student data(uses student db id)
	public function getStudentData($user)
	{
		$sql = "SELECT s.`id`, s.`index`, s.`fname`, s.`mname`, s.`lname`, 
				f.`bill`, f.`balBF`, f.`bal`, f.`paid`, s.`pid`, p.`program` 
				FROM `students` AS s, `finance` AS f, `program` AS p 
				WHERE s.`id` = f.`sid` AND s.`id` = :u AND s.`pid` = p.`id` 
				AND s.`type` = 2 AND s.`deleted` = 0";
		$params = array(':u' => $user);
		return $this->getData($sql, $params);
	}

	private function checkNewStudent($index)
	{
		$sql = "SELECT `id` FROM `students` WHERE `index`=:i AND `type`=2";
		$params = array(':i' => $index);
		return $this->getID($sql, $params);
	}

	private function addNewStudentDetails($i, $f, $m, $l, $p)
	{
		$sql1 = "INSERT INTO `students`(`index`, `fname`, `mname`, `lname`, `pid`)  
				VALUES(:i, :f, :m, :l, :p)";
		$params = array(':i' => $i, ':f' => $f, ':m' => $m, ':l' => $l, ':p' => $p);
		$this->inputData($sql1, $params);

		return $this->checkNewStudent($i);
	}

	private function getThreshold()
	{
		$sql = "SELECT `tres_type`, `threshold` FROM `settings` 
				WHERE `using` = 1 AND `due_days` > 0";
		return $this->getData($sql);
	}

	public function getFinanceStatus($balance)
	{
		$result = $this->getThreshold();
		if ($result != 0) {
			if ($result[0]["tres_type"] == "amount") {
				if ($balance > $result[0]["threshold"]) {
					return "Owing";
				} elseif ($balance <= $result[0]["threshold"]) {
					return "Eligible";
				}
			}
		} else {
			return "Owing";
		}
	}

	private function addNewStudentFinance($id)
	{
		//$status = $this->getFinanceStatus(0);
		$sql = "INSERT INTO `finance`(`sid`, `set`) VALUES(:i, :s)";
		$params = array(':i' => $id, ':s' => $this->getSettingsID());
		return $this->inputData($sql, $params);
	}

	public function addNewStudentData($i, $f, $m, $l, $p)
	{
		if ($this->getSettingDueStatus() == 0) {
			return '[{"error":"No semester has been set! To set a semester, go to Settings > Semester Setup"}]';
		} else {
			$user = $this->addNewStudentDetails($i, $f, $m, $l, $p);
			if ($user) {
				if ($this->addNewStudentFinance($user)) {
					return '[{"success":"Successfully added new student\'s data!"}]';
				} else {
					return '[{"success":"Successfully added new student\'s personal details only!"}]';
				}
			} else {
				return '[{"error":"Was unable to add new student\'s data!"}]';
			}
		}
	}

	public function editStudentDetails($i, $f, $m, $l, $p, $id)
	{
		$sql = "UPDATE `students` SET 
				`pid` = :p, `index` = :i, `fname` = :f, `mname` = :m, `lname` = :l 
				WHERE `id`=:id";
		$params = array(':p' => $p, ':i' => $i, ':f' => $f, ':m' => $m, ':l' => $l, ":id" => $id);
		return $this->inputData($sql, $params);
	}

	public function editStudentFinance($balbf, $bill, $paid, $id)
	{
		$sql = "UPDATE `finance` SET 
				`balBF` = :bf, `bill` = :bi, `paid` = :p  
				WHERE  `sid` = :si AND `set` = :se";
		//$status = $this->getFinanceStatus(floatval($bal));
		$params = array(
			':bi' => $bill,
			':bf' => $balbf,
			':p' => $paid,
			':si' => $id,
			':se' => $this->getSettingsID()
		);
		return $this->inputData($sql, $params);
	}

	public function addNewStudentFinanceRaw($balbf, $bill, $paid, $id)
	{
		$sql = "INSERT INTO `finance`(`sid`, `set`, `balBF`, `bill`, `paid`) 
				VALUES(:si, :se, :bf, :bi, :p)";

		$params = array(
			':si' => $id,
			':se' => $this->getSettingsID(),
			':bf' => $balbf,
			':bi' => $bill,
			':p' => $paid
		);
		return $this->inputData($sql, $params);
	}

	public function editStudentData($i, $f, $m, $l, $p, $id)
	{
		if ($this->getSettingDueStatus() == 0) {
			return '[{"error":"No semester has been set! To set a semester, go to Settings > Semester Setup"}]';
		}

		if ($this->editStudentDetails($i, $f, $m, $l, $p, $id) == 1) {
			//if ($this->editStudentFinance($p, $ba, $id) == 1) {
			return '[{"success":"Successfully updated this student\'s data!"}]';
			/*} else {
				return '[{"success":"Successfully updated this student\'s personal details only!"}]';
			}*/
		} else {
			return '[{"error":"Update failed! Was unable to update this student\'s data"}]';
		}
	}

	public function deleteStudentData($user)
	{
		if ($this->getSettingDueStatus() == 0) {
			return '[{"error":"No semester has been set! To set a semester, go to Settings > Semester Setup"}]';
		}
		$sql = "UPDATE `students` SET `deleted` = 1 WHERE `id`=:i";
		$params = array(':i' => $user);
		$result = $this->inputData($sql, $params);
		if ($result) {
			return '[{"success":"Student data successfully deleted!"}]';
		} else {
			return '[{"error":"Unable to delete student data!"}]';
		}
	}

	// Restores a deleted student's data
	public function restoreStudentData($user)
	{
		if ($this->getSettingDueStatus() == 0) {
			return '[{"error":"No semester has been set! To set a semester, go to Settings > Semester Setup"}]';
		}
		$sql = "UPDATE `students` SET `deleted` = 0 WHERE `id`=:i";
		$params = array(':i' => $user);
		$result = $this->inputData($sql, $params);
		if ($result != 0 || !empty($result)) {
			return '[{"success":"Student data successfully restored!"}]';
		} else {
			return '[{"error":"Unable to restore student data!"}]';
		}
	}

	public function getDeletedStudents()
	{
		$sql = "SELECT * FROM `students` WHERE `deleted` = 1";
		$result = $this->getData($sql);
		if ($result != 0 || !empty($result)) {
			return $result;
		} else {
			return '[{"error":"No deleted student data!"}]';
		}
	}

	public function getExcelDataIntoDB($targetPath, $startRow = 1, $endRow = 0)
	{
		require_once('../vendor/autoload.php');
		$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadSheet = $Reader->load($targetPath);
		$excelSheet = $spreadSheet->getActiveSheet();
		$spreadSheetArray = $excelSheet->toArray();
		if ($endRow == 0) {
			$endRow = count($spreadSheetArray);
		}
		if ($startRow > 1) {
			$startRow -= 1;
		}/* else {
			if ($startRow < $endRow) {
				$endRow = $endRow - $startRow;
			} else {
				return 0;
			}

		}*/
		//echo "<script>alert('Transfering excel data into database...')</script>";

		$count = 0;
		for ($i = $startRow; $i <= $endRow - 1; $i++) {
			//$stdID = $spreadSheetArray[$i][1]; 
			$index = $spreadSheetArray[$i][2];

			$p = strtolower(substr($index, 0, 3));
			$program = $this->getProgramIdByName($p);

			$names = explode(" ", $spreadSheetArray[$i][3]);
			$mname = "";
			if (count($names) > 2) {
				$fname = str_replace(",", "", $names[0]);
				$mname = $names[1];
				$lname = $names[2];
			} else {
				$fname = str_replace(",", "", $names[0]);
				$lname = $names[1];
			}

			$balBF = $spreadSheetArray[$i][4];
			$bill = $spreadSheetArray[$i][5];
			$paid = $spreadSheetArray[$i][6];

			$sql = "SELECT `id` FROM `students` WHERE `index` = :i";
			$param = array(":i" => $index);
			$id = $this->getID($sql, $param);

			if ($id != 0 || !empty($id)) {
				$u_id = $this->editStudentFinance($balBF, $bill, $paid, $id);
				if ($u_id != 0 || !empty($u_id)) {
					$count += 1;
					continue;
				}
			} else {
				$uid = $this->addNewStudentDetails($index, $fname, $mname, $lname, $program);
				if ($uid != 0 || !empty($uid)) {
					$a = $this->addNewStudentFinanceRaw($balBF, $bill, $paid, $uid);
					if ($a != 0 || !empty($a)) {
						if ($this->addQRCodesFromDataUploads($uid)) {
							$count += 1;
							continue;
						}
					}
				}
			}
		}

		echo "<script>alert('Successfully transfered " . $count . " excel data into DB')</script>";
		return 1;
	}

	public function searchForStudent($key)
	{
		if (!empty($key)) {
			$sql = "SELECT s.`id`, s.`index`, s.`fname`, s.`mname`, s.`lname`, f.`bal` 
				FROM `students` AS s, `finance` AS f WHERE s.`id` = f.`sid` AND s.`index` LIKE :k";
			$users = $this->getData($sql, array(":k" => "%" . $key . "%"));

			if ($users != 0) {
				return json_encode($users);
			} else {
				return '[{"error":"No match found!"}]';
			}
		}
	}

	public function getDataStats($status)
	{
		$sql = "";
		if ($status == "Students") {
			$sql .= "SELECT s.`id`, s.`index`, s.`fname`, s.`mname`, s.`lname` 
					FROM `students` AS s, `finance` AS f 
					WHERE s.`id` = f.`sid`";
		} else {
			$sql .= "SELECT s.`id`, s.`index`, s.`fname`, s.`mname`, s.`lname` 
					FROM `students` AS s, `finance` AS f 
					WHERE s.`id` = f.`sid` AND `status`=:s";
		}
		$param = array(":s" => $status);
		return $this->getData($sql, $param);
	}

	private function updateUserPassw($user_id, $password)
	{
		$sql = "UPDATE `students` SET 
				`password` = :p 
				WHERE `id`=:i";
		$params = array(':i' => $user_id, ':p' => sha1($password));
		return $this->inputData($sql, $params);
	}

	public function resetUserPassw($user_id, $current_pw, $new_pw)
	{
		$sql = "SELECT `id` FROM students WHERE `password`=:c AND `id`=:u";
		$id = $this->getID($sql, array(":c" => sha1($current_pw), ":u" => $user_id));
		if ($id) {
			$rslt = $this->updateUserPassw($id, $new_pw);
			if ($rslt) {
				return '[{"success":"Password changed successfully!"}]';
			}
		} else {
			return '[{"error":"Incorrect pawword: password reset failed!"}]';
		}
	}

	private function updateCILTStudents()
	{
		if ($this->getTotalData("SELECT * FROM `students` WHERE deleted = 0 AND `done` = 0 AND `pid` = 1")) {
			$this->inputData("UPDATE `students` SET `done` = 1 WHERE `pid` = 1");
		}
		return 1;
	}

	private function updateDILTStudents()
	{
		if ($this->getTotalData("SELECT * FROM `students` WHERE deleted = 0 AND `done` = 0 AND `pid` = 2")) {
			$this->inputData("UPDATE `students` SET `done` = 1 WHERE `sem` = 2 AND `pid` = 2");
			$this->inputData("UPDATE `students` SET `sem` = 2 WHERE `sem` = 1 AND `pid` = 2");
		}
		return 1;
	}

	private function updateADILTStudents()
	{
		if ($this->getTotalData("SELECT * FROM `students` WHERE deleted = 0 AND `done` = 0 AND `pid` = 3")) {
			$this->inputData("UPDATE `students` SET `done` = 1 WHERE `sem` = 3 AND `pid` = 3");
			$this->inputData("UPDATE `students` SET `sem` = 3 WHERE `sem` = 2 AND `pid` = 3");
			$this->inputData("UPDATE `students` SET `sem` = 2 WHERE `sem` = 1 AND `pid` = 3");
		}
		return 1;
	}

	public function setupSemester($aca, $semid, $start_date, $end_date, $t_hold, $overwrite, $t_type)
	{
		$thresh_type = "";
		if ($t_type == 1) {
			$thresh_type = "amount";
		} else {
			$thresh_type = "percent";
		}

		if ($overwrite == 2) {
			$sql = "UPDATE `settings` SET `acaid` = :a, `semid` = :sm, 
					`start_date` = :sd, `end_date` = :ed, 
					`threshold` = :t, `tres_type` = :tt WHERE `using` = 1 AND `due_days` > 0";
			$params = array(
				':a' => $aca, ':sm' => $semid,
				':sd' => $start_date, ':ed' => $end_date,
				':t' => $t_hold, ':tt' => $thresh_type
			);
			if ($this->getData($sql, $params)) {
				return '[{"success":"Semester settings successfully overwritten!"}]';
			} else {
				return '[{"error":"An error was encountered while overwriting settings!"}]';
			}
		} else {
			if ($this->getSettingDueStatus() > 0) {
				return '[{"continue":"Failed to setup the semester! A semester is already set"}]';
			} else {
				$this->getData("UPDATE `settings` SET `using` = 0");
				$sql = "INSERT INTO `settings`(`acaid`, `semid`, `start_date`, `end_date`, `threshold`, `tres_type`, `using`) 
						VALUES(:a, :sm, :sd, :ed, :t, :tt, :u)";
				$params = array(
					':a' => $aca, ':sm' => $semid,
					':sd' => $start_date, ':ed' => $end_date,
					':t' => $t_hold, ':tt' => $thresh_type, ':u' => 1
				);

				if ($this->inputData($sql, $params)) {
					if ($this->inputData("UPDATE `setted` SET `set_later` = 0 WHERE `id` = 1")) {
						if ($this->updateCILTStudents()) {
							if ($this->updateDILTStudents()) {
								if ($this->updateADILTStudents()) {
									$res = $this->addQRCodesFromSettingsSetup();
									if ($res) {
										return '[{"success":"Semester successfully set!"}]';
									} else {
										return '[{"error":"' . $res . 'Failed to setup the semester! - level 3"}]';
									}
								} else {
									return '[{"error":"Failed to setup the semester! - level 4"}]';
								}
							} else {
								return '[{"error":"Failed to setup the semester! - level 5"}]';
							}
						} else {
							return '[{"error":"Failed to setup the semester! - level 6"}]';
						}
					} else {
						return '[{"error":"Failed to setup the semester! - level 1"}]';
					}
				} else {
					return '[{"error":"Failed to setup the semester! - level 2"}]';
				}
			}
		}
	}

	public function getReportData($proid, $acaid, $semid, $bal_status)
	{
		$sql = "SELECT s.index, s.fullname, f.bal, c.permit, p.program, sem.semester, a.academic_year 
				FROM students AS s, finance AS f, settings AS t, secret_codes AS c, 
				academic_year AS a, semester AS sem, program AS p 
				WHERE s.id = f.sid AND s.pid = p.id 
				AND c.sid = s.id AND t.acaid = a.id 
				AND t.semid = sem.id AND t.id = f.set 
				AND t.id = c.set AND t.id = :setid 
				AND sem.id = :semid AND a.id = :acaid";

		if ($bal_status == "Eligible") {
			$sql .= " AND f.bal <= t.threshold";
		} elseif ($bal_status == "Owing") {
			$sql .= " AND f.bal > t.threshold";
		} elseif ($bal_status == "Owed") {
			$sql .= " AND f.bal < 0";
		}

		$setid = $this->getSetIDByAcaAndSem($acaid, $semid);

		$params = array(
			":setid" => $setid,
			":semid" => $semid,
			":acaid" => $acaid
		);

		if ($proid != 0) {
			$sql .= " AND p.id = :p";
			$params[":p"] = $proid;
		}

		return $this->getData($sql, $params);
	}


	public function getStudentBySettings($acaid, $semid, $progid)
	{
		$sql = "SELECT s.index, s.`id`,  s.`fname`, s.`mname`, s.`lname`, f.bal, p.program 
				FROM students AS s, finance AS f, settings AS t, 
				academic_year AS a, semester AS sem, program AS p 
				WHERE s.id = f.sid AND s.pid = p.id 
				AND t.acaid = a.id AND t.semid = sem.id AND t.id = f.set
				AND t.id = :setid AND sem.id = :semid AND a.id = :acaid 
				AND p.id = :progid AND s.`type` = 2 AND s.`deleted` = 0";

		$setid = $this->getSetIDByAcaAndSem($acaid, $semid);
		$params = array(
			":setid" => $setid,
			":acaid" => $acaid,
			":semid" => $semid,
			":progid" => $progid
		);

		if ($progid != 0) {
			$sql .= " AND p.id = :p";
			$params[":p"] = $progid;
		}

		return $this->getData($sql, $params);
	}

	public function setCodes()
	{
		$departure_code = $this->genCode(10);
		$arrival_code = $this->genCode(10);
		$sql = "INSERT INTO `major_codes`(`departure`, `arrival`) VALUES(:d, :a)";
		$params = array(":d" => sha1($departure_code), ":a" => sha1($arrival_code));
		return $this->inputData($sql, $params);
	}
}
