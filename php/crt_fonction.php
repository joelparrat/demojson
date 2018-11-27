<?php

class cmmClass
{
	Public $clf;
	Public $lgn;
	Public $prn;
	Public $nom;
	Public $exs;
	Public $adr;
	Public $tlp;
	Public $eml;
	Public $pwd;
	Public $dnm;
	Public $srn;
	Public $srt;
	Public $ape;
	Public $ret;
}

$cmmObj = new cmmClass;
//$obj->lgn="jojo";
//$obj->pwd="12345678";
//$obj->prn="joel";
//$obj->nom="parrat";
//$obj->drt=9;
 
function lectureBDD($str)
{
	$str->ret=false;
	$bdd = mysqli_connect('localhost', 'prospect', 'prospect', 'prospect');
    if (!$bdd)
    {
        echo mysqli_error();
		return false;
    }
	
	$rqt = "";
	$pst = trim(file_get_contents("php://input"));
	$objJSON = json_decode($pst);
	if (!is_object($objJSON))
		return false;

	//if ($objJSON->user'])) && (isset($_POST['pwd'])))
	//$rqt = 'select * from cmm where lgn="'.$objJSON->user.'" and pwd="'.$objJSON->pwd.'"';
	//if ((isset($_POST['lgn'])) && (isset($_POST['pss'])) && (isset($_POST['prn'])) && (isset($_POST['nom'])))
	/*
	$rqt = 'select count clf from cmm';
    $rsl = mysqli_query($bdd, $rqt);
    $vlr = mysqli_fetch_assoc($rsl);
    $clf = (int) $vlr['clf'];
    $clf++;
    */
	$rqt = 'select * from cmm where prn="'.$objJSON->pren.'" and nom="'.$objJSON->nome.'"';
    $rsl = mysqli_query($bdd, $rqt);
    $vlr = mysqli_fetch_assoc($rsl);
    if ($vlr['exs'] == 0)
    {
    	$rqt = 'UPDATE cmm SET lgn="'.$objJSON->util.'", exs=1, adr="'.$objJSON->adre.'", tlp="'.$objJSON->tele.'", eml="'.$objJSON->emai.'", pwd="'.$objJSON->mtp.'", dnm="'.$objJSON->deno.'", srn="'.$objJSON->sirn.'", srt="'.$objJSON->sirt.'", ape="'.$objJSON->nfap.'" WHERE clf='.$vlr["clf"];
    	/*
    	$rqt = 'INSERT INTO cmm (clf, lgn, prn, nom, exs, adr, tlp, eml, pwd, dnm, srn, srt, ape) VALUES ('.$clf.', "'.$objJSON->util.'", "'.$objJSON->pren.'", "'.$objJSON->nome.'", 1, "'.$objJSON->adre.'", "'.$objJSON->tele.'", "'.$objJSON->emai.'", "'.$objJSON->mtp.'", "'.$objJSON->deno.'", "'.$objJSON->sirn.'", "'.$objJSON->sirt.'", "'.$objJSON->nfap.'")';
    	*/
    	$rsl = mysqli_query($bdd, $rqt);
    	$vlr = mysqli_fetch_assoc($rsl);
    }
    else
    	return false;
	mysqli_close($bdd);
	$str->ret = true;
	echo $rqt;
    return true;
}

lectureBDD($cmmObj);
$data = array();
if ($cmmObj->ret)
	$data['success'] = true;
else
	$data['success'] = false;
echo json_encode($data);
 ?>

