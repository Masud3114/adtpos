<?php
require_once("../systems/DB_Class/db_ config.php");
require_once("../systems/asset_class/_dcomn_cls.php");
if(isset($_GET[qfld]))
	{	
	$_GET[qfld]=@mysql_real_escape_string($_GET[qfld]);
	$sql_cmd="SELECT demp_info.e_num, demp_info.e_joindt, dxdesig.desig_num, dxdept.dept_num
	from demp_info
	LEFT JOIN dxdesig ON demp_info.desig_cod=dxdesig.desig_cod
	LEFT JOIN dxdept ON demp_info.dept_cod=dxdept.dept_cod
	where demp_info.e_id ='$_GET[qfld]'";
	$sql_rslt = $cmncls->sqlqry($sql_cmd);
	$emp_info = @mysql_fetch_assoc($sql_rslt);

	echo "Name: ".$emp_info[e_num]."<br />Department: ".$emp_info[dept_num]."<br />Designation: ".$emp_info[desig_num]."<br />Joining Date: ".date('d-M-Y',strtotime($emp_info[e_joindt]));
	
	}
	
if( $_SERVER['REQUEST_METHOD'] == 'POST')
	{
	if($_POST[fld_name]=='dcmpny_cod')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dcmpny_cod, dcmpny_num FROM dcmpny_info where dcmpny_num like '%$value%' AND sts='1' order by dcmpny_num ASC LIMIT 15");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dcmpny_cod], 
				"label" => $row[dcmpny_cod]."-".$row[dcmpny_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='dcus_cod')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dcus_cod, dcus_num FROM dcus_info where dcus_num like '%$value%' AND sts='1' order by dcus_num ASC LIMIT 15");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dcus_cod], 
				"label" => $row[dcus_cod]."-".$row[dcus_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='dsft_cod')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dsft_cod,dsft_num FROM dshift_info where dsft_num like '%$value%' or  dsft_cod like '%$value%'AND sts='1' order by dsft_num ASC LIMIT 15");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dsft_cod], 
				"label" => $row[dsft_cod]."-".$row[dsft_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='dept_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dept_cod,dept_num FROM dxdept where dept_num like '%$value%' OR dept_cod like '%$value%' AND sts='1' order by dept_num ASC LIMIT 15");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dept_cod], 
				"label" => $row[dept_cod]."-".$row[dept_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='secson_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT secson_cod,secson_num FROM dxsecson where secson_num like '%$value%' OR secson_cod like '%$value%' AND sts='1' order by secson_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[secson_cod], 
				"label" => $row[secson_cod]."-".$row[secson_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='se_id' || $_POST[fld_name]=='e_id'|| $_POST[fld_name]=='e_ids')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_id,e_num FROM demp_info where e_num like '%$value%' OR e_id like '%$value%' AND sts='1' order by e_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_id], 
				"label" => $row[e_id]." - ".$row[e_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='frm_tim' || $_POST[fld_name]=='to_tim')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		for($i = 0; $i<24; $i++)
			{
				$i = sprintf('%02d',$i);
				for($j = 0; $j < 60; $j = $j+5)
					{	
					$j = sprintf('%02d',$j);
					$sct_time .= $i.":".$j.":"."00,";
					}
					
			}	
		$sct_time = substr($sct_time,0,-1);
		$words = explode(',',$sct_time);
		foreach ($words as $word)
			{
			if (strpos($word, $value) === 0)
				{
				$found[] = array(
					"value" => $word,
				);
				if (count($found) >= 10)
					break;
				}
			}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='pycod_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT pycod_cod,pycod_num FROM dxpycod where pycod_num like '%$value%' OR pycod_cod like '%$value%' AND sts='1' order by pycod_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[pycod_cod], 
				"label" => $row[pycod_cod]." - ".$row[pycod_num],
				);
				}
		echo json_encode($found);
		
		}
		
	else if($_POST[fld_name]=='e_ctgry')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT empcat_cod,empcat_num FROM dempcat_info where empcat_num like '%$value%' OR empcat_cod like '%$value%' AND sts='1' order by empcat_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[empcat_cod], 
				"label" => $row[empcat_cod]." - ".$row[empcat_num],
				);
				}
		echo json_encode($found);		
		}
	else if($_POST[fld_name]=='e_rnk')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT emprnk_cod,emprnk_num FROM demprnk_info where emprnk_num like '%$value%' OR emprnk_cod like '%$value%' AND sts='1' order by emprnk_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[emprnk_cod], 
				"label" => $row[emprnk_cod]." - ".$row[emprnk_num],
				);
				}
		echo json_encode($found);		
		}
	else if($_POST[fld_name]=='desig_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT desig_cod,desig_num FROM dxdesig where desig_num like '%$value%' OR desig_cod like '%$value%' AND sts='1' order by desig_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[desig_cod], 
				"label" => $row[desig_cod]." - ".$row[desig_num],
				);
				}
		echo json_encode($found);
		
		}
	else if($_POST[fld_name]=='lin_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT lin_cod,lin_num FROM dx_line where lin_num like '%$value%' OR lin_cod like '%$value%' AND sts='1' order by lin_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[lin_cod], 
				"label" => $row[lin_cod]." - ".$row[lin_num],
				);
				}
		echo json_encode($found);
		
		}
	else if($_POST[fld_name]=='dsft_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dsft_cod,dsft_num FROM dx_line where dsft_num like '%$value%' OR dsft_cod like '%$value%' AND sts='1' order by dsft_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dsft_cod], 
				"label" => $row[dsft_cod]." - ".$row[dsft_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='pyscl_cod')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT pyscl_cod,pyscl_num FROM dxpyscl where pyscl_num like '%$value%' OR pyscl_cod like '%$value%' AND sts='1' order by pyscl_num ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[pyscl_cod], 
				"label" => $row[pyscl_cod]." - ".$row[pyscl_num],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_pfcat')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_pfcat FROM pf_policy where e_pfcat like '%$value%' group by e_pfcat order by e_pfcat ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_pfcat], 
				"label" => $row[e_pfcat],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_pavill')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_pavill FROM demp_info where e_pavill like '%$value%' group by e_pavill order by e_pavill ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_pavill], 
				"label" => $row[e_pavill],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_grad')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_grad FROM demp_info where e_grad like '%$value%' group by e_grad order by e_grad ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_grad], 
				"label" => $row[e_grad],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_papo')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_papo FROM demp_info where e_papo like '%$value%' group by e_papo order by e_papo ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_papo], 
				"label" => $row[e_papo],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_paps')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_paps FROM demp_info where e_paps like '%$value%' group by e_paps order by e_paps ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_paps], 
				"label" => $row[e_paps],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_padrstc')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_padrstc FROM demp_info where e_padrstc like '%$value%' group by e_padrstc order by e_padrstc ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_padrstc], 
				"label" => $row[e_padrstc],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='e_pacntry')
		{
		$found = array();		
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT e_pacntry FROM demp_info where e_pacntry like '%$value%' group by e_pacntry order by e_pacntry ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[e_pacntry], 
				"label" => $row[e_pacntry],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='ref_company')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT ref_company FROM demp_replc where ref_company like '%$value%' group by ref_company order by ref_company ASC LIMIT 30");
		while($row=@mysql_fetch_array($sql_res))
			{
			$found[] = array(
			"value" => $row[ref_company], 
			"label" => $row[ref_company],
			);
			$prv_val.="'".$row[ref_company]."',";
			$prv_val=substr($prv_val,0,-1);
			if($prv_val!=NULL && $prv_val!='')
				{
				$prv_val="and ref_company not in ($prv_val)";
				}
			else
				{
				$prv_val='';
				}
			}
		$sql_res=$cmncls->sqlqry("SELECT ref_company FROM demp_dplmnt where ref_company like '%$value%' $prv_val group by ref_company order by ref_company ASC LIMIT 30");
		while($row=@mysql_fetch_array($sql_res))
			{
			$found[] = array(
			"value" => $row[ref_company], 
			"label" => $row[ref_company],
			);
			}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='ref_subject')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT ref_subject FROM demp_replc where ref_subject like '%$value%' group by ref_subject order by ref_subject ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[ref_subject], 
				"label" => $row[ref_subject],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='dep_ref')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dep_ref FROM demp_dplmnt where dep_ref like '%$value%' group by dep_ref order by dep_ref ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dep_ref], 
				"label" => $row[dep_ref],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='ref_location')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT ref_location FROM demp_dplmnt where ref_location like '%$value%' group by ref_location order by ref_location ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[ref_location], 
				"label" => $row[ref_location],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='dep_subject')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT dep_subject FROM demp_dplmnt where dep_subject like '%$value%' group by dep_subject order by dep_subject ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[dep_subject], 
				"label" => $row[dep_subject],
				);
				}
		echo json_encode($found);
		}
	else if($_POST[fld_name]=='item_cod' || $_POST[fld_name]=='item_cod[]')
		{
		$found = array();
		$value = trim($_POST['term']);
		$value =@mysql_real_escape_string($value);
		$sql_res=$cmncls->sqlqry("SELECT item_cod, item_name FROM item_info 
		where item_cod like '%$value%' or item_name like '%$value%' 
		group by item_cod order by item_name ASC LIMIT 30");
			while($row=@mysql_fetch_array($sql_res))
				{
				$found[] = array(
				"value" => $row[item_cod], 
				"label" => $row[item_name],
				);
				}
		echo json_encode($found);
		}
	}
?>
