<?php

class cmmClass
{
	Public $clf;
	Public $lgn;
	Public $pwd;
	Public $drt;
	Public $mss;
	Public $ret;
}
$cmmObj = new cmmClass;
 
function lectureBDD($str)
{
	$str->ret=-1;
	$str->mss="Veuillez vous identifier ...";
	$bdd = mysqli_connect('localhost', 'gstflm', 'gstflm', 'gstflm');													// ouverture de la base
	if (!$bdd)
	{
		$str->mss = mysqli_connect_error();
		$str->ret=-2;
		return false;
	}
	
	$pst = trim(file_get_contents("php://input"));																		// lecture du post
	$objJSON = json_decode($pst);
	if (!is_object($objJSON))
	{
		mysqli_close($bdd);
		$str->mss = "Erreur objet JSON";
		$str->ret=-3;
		return false;
	}

	$rqt = 'select drt from usr where lgn="'.$objJSON->lgn.'" and pwd="'.$objJSON->pwd.'"';
    $rsl = mysqli_query($bdd, $rqt);
    $vlr = mysqli_fetch_assoc($rsl);
	mysqli_close($bdd);

    if ($rsl->num_rows == 0)
	{
		$str->ret = 3;
		$str->mss="Utilisateur inconnu ...";
	}
    else if ($rsl->num_rows == 1)
	{
		$str->drt=$vlr['drt'];
		if ($str->drt == 9)
		{
			$str->ret = 0;
			$str->mss="Controle total ...";
		}
		else if ($str->drt == 0)
		{
			$str->ret = 2;
			$str->mss="Acces inderdit ...";
		}
		else
		{
			$str->ret = 1;
			$str->mss="Acces autorise ...";
		}
	}
	
    return true;
}

lectureBDD($cmmObj);
echo json_encode($cmmObj);
 ?>

