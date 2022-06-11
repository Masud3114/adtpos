			<?php 
			$sdate=date('Y-m-')."01";
			$ldate=date('Y-m-t');
			$sql_cmd="SELECT count(demp_info.e_id) as ttl_emp, 'Total Active Worker' as slide_caption
			from demp_info
			where demp_info.dcmpny_cod='COMP-0001' and demp_info.e_sts='active'
			union
			SELECT count(demp_info.e_id) as ttl_emp, 'Passport Expire' as slide_caption
			from demp_info
			where demp_info.dcmpny_cod='COMP-0001' and demp_info.e_sts='active' 
			and  demp_info.e_pspexprdt <=DATE_FORMAT(NOW(),'Y%-%m-%d') AND demp_info.e_pspexprdt!='0000-00-00'
			union
			select count(e_id) as ttl_emp, 'Work Permit Expire' as slide_caption
			from demp_dplmnt
			where replc_date <=DATE_FORMAT(NOW(),'%Y-%m-%d')
			union
			select count(dcusqry_info.dcus_qryno) as ttl_emp, 'Last Customer Query' as slide_caption
			from dcusqry_info
			where dcusqry_info.dcus_qrydate between DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-%d') AND DATE_FORMAT(NOW(),'%Y-%m-%d')";
			$query=$cmncls->sqlqry($sql_cmd);
			//echo $sql_cmd;
			$slno=0;
			while($row=@mysql_fetch_array($query)){
				if($slno==0){
					$echo_val.='<div class="col-md-3 col-sm-6">
									<a href="index.php?pgr=emp_list" class="btn bg-pink" style="padding:0px; width:100%;"> 
										<div class="info-box bg-pink hover-expand-effect" style="margin-bottom: 5px;">
											<div class="icon">
												<i class="material-icons">person_add</i>
											</div>
											<div class="content">
												<div class="text">'.$row[slide_caption].'</div>
												<div class="number count-to">'.$row[ttl_emp].'</div>
											</div>
										</div>
										View Details
									</a>
								</div>';
				}else if($slno==1){
					$echo_val.='<div class="col-md-3 col-sm-6">
									<a href="index.php?pg=psp_expr" class="btn bg-cyan" style="padding:0px; width:100%;">
										<div class="info-box bg-cyan hover-expand-effect" style="margin-bottom: 5px;">
											<div class="icon">
												<i class="material-icons">help</i>
											</div>
											<div class="content">
												<div class="text">'.$row[slide_caption].'</div>
												<div class="number count-to">'.$row[ttl_emp].'</div>
											</div>
										</div>
										View Details
									</a>
								</div>';
				}else if($slno==2){
					$echo_val.='<div class="col-md-3 col-sm-6">
									<a href="index.php?pg=prmt_expr" class="btn bg-cyan" style="padding:0px; width:100%;">
										<div class="info-box bg-light-green hover-expand-effect" style="margin-bottom: 5px;">
											<div class="icon">
												<i class="material-icons">forum</i>
											</div>
											<div class="content">
												<div class="text">'.$row[slide_caption].'</div>
												<div class="number count-to">'.$row[ttl_emp].'</div>
											</div>
										</div>
										View Details
									</a>
								</div>';
				}else if($slno==3){
					$echo_val.='<div class="col-md-3 col-sm-6">
									<a href="index.php?pg=cus_query" class="btn bg-cyan" style="padding:0px; width:100%;">
										<div class="info-box bg-orange hover-expand-effect" style="margin-bottom: 5px;">
											<div class="icon">
												<i class="material-icons">contact_mail</i>
											</div>
											<div class="content">
												<div class="text">'.$row[slide_caption].'</div>
												<div class="number count-to">'.$row[ttl_emp].'</div>
											</div>
										</div>
										View Details
									</a>
								</div>';
				}
				$slno++;
			}
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="block-header">
						<h2>DASHBOARD</h2>
					</div>
					<!-- Widgets -->
					<div class="row clearfix">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="info-box bg-pink hover-expand-effect">
								<div class="icon">
									<i class="material-icons">playlist_add_check</i>
								</div>
								<div class="content">
									<div class="text">NEW TASKS</div>
									<div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="info-box bg-cyan hover-expand-effect">
								<div class="icon">
									<i class="material-icons">help</i>
								</div>
								<div class="content">
									<div class="text">NEW TICKETS</div>
									<div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="info-box bg-light-green hover-expand-effect">
								<div class="icon">
									<i class="material-icons">forum</i>
								</div>
								<div class="content">
									<div class="text">NEW COMMENTS</div>
									<div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="info-box bg-orange hover-expand-effect">
								<div class="icon">
									<i class="material-icons">person_add</i>
								</div>
								<div class="content">
									<div class="text">NEW VISITORS</div>
									<div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- #END# Widgets -->
					<div class="row clearfix">
						<!-- Task Info -->
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
							<div class="card">
								<div class="header">
									<h2>TASK INFOS</h2>
									<ul class="header-dropdown m-r--5">
										<li class="dropdown">
											<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
												<i class="material-icons">more_vert</i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:void(0);">Action</a></li>
												<li><a href="javascript:void(0);">Another action</a></li>
												<li><a href="javascript:void(0);">Something else here</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class="body">
									<div class="table-responsive">
										<table class="table table-hover dashboard-task-infos">
											<thead>
												<tr>
													<th>#</th>
													<th>Task</th>
													<th>Status</th>
													<th>Manager</th>
													<th>Progress</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>Task A</td>
													<td><span class="label bg-green">Doing</span></td>
													<td>John Doe</td>
													<td>
														<div class="progress">
															<div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td>Task B</td>
													<td><span class="label bg-blue">To Do</span></td>
													<td>John Doe</td>
													<td>
														<div class="progress">
															<div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td>3</td>
													<td>Task C</td>
													<td><span class="label bg-light-blue">On Hold</span></td>
													<td>John Doe</td>
													<td>
														<div class="progress">
															<div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td>4</td>
													<td>Task D</td>
													<td><span class="label bg-orange">Wait Approvel</span></td>
													<td>John Doe</td>
													<td>
														<div class="progress">
															<div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
														</div>
													</td>
												</tr>
												<tr>
													<td>5</td>
													<td>Task E</td>
													<td>
														<span class="label bg-red">Suspended</span>
													</td>
													<td>John Doe</td>
													<td>
														<div class="progress">
															<div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- #END# Task Info -->
						<!-- Browser Usage -->
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<div class="card">
								<div class="header">
									<h2>BROWSER USAGE</h2>
									<ul class="header-dropdown m-r--5">
										<li class="dropdown">
											<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
												<i class="material-icons">more_vert</i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:void(0);">Action</a></li>
												<li><a href="javascript:void(0);">Another action</a></li>
												<li><a href="javascript:void(0);">Something else here</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class="body">
									<div id="donut_chart" class="dashboard-donut-chart"></div>
								</div>
							</div>
						</div>
						<!-- #END# Browser Usage -->
					</div>
				</div>
			</div>