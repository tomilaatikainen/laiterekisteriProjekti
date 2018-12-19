<?php
	require_once("db.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	check_session();
	
	global $conn;
	//error_log("Poitaoigaosgoaisgs:". $_POST["LAITE_ID"]);
	if(isset($_POST['poista']))
	{
		
		$laiteid = $_POST["LAITE_ID"];
		
		try{
		$stmt = $conn->prepare("DELETE FROM laite WHERE LAITE_ID='$laiteid'");
		$stmt->execute();
		}
		catch(PDOException $e)
		{	
			//error_log("Error in poista: " . $e->getMessage());
			
			try{
			$stmt2 = $conn->prepare
			("UPDATE varaus SET STATUS='poistettu' WHERE LAITE_ID='$laiteid'");
			$stmt2->execute();
			
			
			$stmt3 = $conn->prepare
			("UPDATE laite SET STATUS='poistettu' WHERE LAITE_ID='$laiteid'");
			$stmt3->execute();
			}
			
			
			catch(PDOException $e)
			{
				error_log("Error statusten muuttamisessa: " . $e->getMessage());
			}
			
			
		}
		
		/*echo"<script type='text/javascript'>alert('Laite merkattu poistetuksi');
			location='adminlaite.php';
			</script>";*/
	}
		
?>