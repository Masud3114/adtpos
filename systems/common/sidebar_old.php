<?PHP
if(defined('BASEPATH')){ ?>
		<section>
			<!-- Left Sidebar -->
			<aside id="leftsidebar" class="sidebar">
				<!-- User Info -->
				<div class="user-info">
					<div class="image">
						<img src="images/user.png" width="50" height="50" alt="User" />
					</div>
					<div class="info-container">
						<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome</div>
						<div class="email"><?php echo $_SESSION['user_name']?></div>
					</div>
				</div>
				<!-- #User Info -->
				<!-- Menu -->
				<?php
				$menu_list=array(
					'prdct_info'	=>array(
							'entry'		=>array('item_info'),
							'setup'		=>array('store_info','cat_info','type_info','brand_info','color_info','size_info','unit_info'),
							'report'	=>array('prdc_list')
							),
					'sales'	=>array(
							'entry'		=>array('cus_info','invoice_info','invoice_process','invoice_print','cus_queryentry','cus_query')
							),
					'stock'	=>array(
							'entry'		=>array('item_entry','issue_entry','receive_entry','prch_trn'),
							'report'	=>array('stock_report','item_list','item_ledger')
							),
					'email_recever'	=>array('email_recever'),
					'cmp_info'			=>array('address_info','about_us','about_team','msn_vsn','our_valus'),
					'sinup'	=>array('sinup'),
					'systems_module'	=>array('systems_module')
				);
				
				function is_in_array($needle, $haystack, $strict = false) {
					if(is_array($haystack)){
						foreach ($haystack as $item) {
							if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && is_in_array($needle, $item, $strict))) {
								return true;
							}
						}
					}
					return false;
				}
				if(!is_in_array($_GET['pg'],$menu_list) && !is_in_array($_GET['pgr'],$menu_list)){
					$nave_sts=true;
				}else{
					$nave_sts=true;
				}
				?>
				<div class="menu">
					<ul class="list">
						<li class="header">MAIN NAVIGATION</li>
						<li class="<?php if(is_in_array($_GET['pg'],$menu_list['prdct_info'])){ echo 'active'; } ?>">
							<a href="javascript:void(0);" class="menu-toggle">
								<i class="material-icons">add_shopping_cart</i>
								<span>Product Information</span>
							</a>
							<ul class="ml-menu">
								<li class="<?php if($menu_list['prdct_info']['0']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=item_info">
										<i class="material-icons">spa</i>
										<span>Product Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['1']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=store_info">
										<i class="material-icons">store_mall_directory</i>
										<span>Store Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['2']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=cat_info">
										<i class="material-icons">toys</i>
										<span>Category Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['3']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=type_info">
										<i class="material-icons">bubble_chart</i>
										<span>Type Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['4']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=brand_info">
										<i class="material-icons">airplay</i>
										<span>Brand Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['5']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=color_info">
										<i class="material-icons">color_lens</i>
										<span>Color Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['6']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=size_info">
										<i class="material-icons">equalizer</i>
										<span>Size Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['prdct_info']['7']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=unit_info">
										<i class="material-icons">games</i>
										<span>Unit Entry</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="<?php if(is_in_array($_GET['pg'],$menu_list['CRM']) || is_in_array($_GET['pgr'],$menu_list['CRM'])){ echo 'active'; } ?>">
							<a href="javascript:void(0);" class="menu-toggle">
								<i class="material-icons">account_box</i>
								<span>Sales</span>
							</a>
							<ul class="ml-menu">
								<li class="sub_menu <?php if($menu_list['CRM']['entry']['0']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=cus_info">
										<i class="material-icons">verified_user</i>
										<span>Customer Info</span>
									</a>
								</li>
								<li class="<?php if($menu_list['CRM']['entry']['1']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=invoice_info">
										<i class="material-icons">payment</i>
										<span>Customer Invoice Info</span>
									</a>
								</li>
								<li class="<?php if($menu_list['CRM']['entry']['2']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=invoice_process">
										<i class="material-icons">autorenew</i>
										<span>Invoice Process</span>
									</a>
								</li>
								<li class="<?php if($menu_list['CRM']['entry']['3']==$_GET['pgr']){ echo 'active'; } ?>">
									<a href="?pgr=invoice_print">
										<i class="material-icons">print</i>
										<span>Invoice Print</span>
									</a>
								</li>
								<li class="<?php if($menu_list['CRM']['entry']['4']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=cus_queryentry">
										<i class="material-icons">contact_mail</i>
										<span>Customer Query Entry</span>
									</a>
								</li>
								<li class="<?php if($menu_list['CRM']['entry']['5']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=cus_query">
										<i class="material-icons">query_builder</i>
										<span>Customer Query</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="<?php if(is_in_array($_GET['pg'],$menu_list['stock'])){ echo 'active'; } ?>">
							<a href="javascript:void(0);" class="menu-toggle">
								<i class="material-icons">store</i>
								<span>Inventory</span>
							</a>
							<ul class="ml-menu">
								<li class="<?php if($menu_list['stock']['entry']['1']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=issue_entry">
										<i class="material-icons">shop</i>
										<span>Issue Item</span>
									</a>
								</li>
								<li class="<?php if($menu_list['stock']['entry']['2']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=receive_entry">
										<i class="material-icons">shopping_basket</i>
										<span>Receive Item</span>
									</a>
								</li>
								<li class="<?php if($menu_list['stock']['entry']['3']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=prch_trn">
										<i class="material-icons">shopping_cart</i>
										<span>Purchase Item</span>
									</a>
								</li>
								<li class="<?php if(is_in_array($_GET['pgr'], $menu_list['stock']['report'])){ echo 'active'; } ?>">
									<a href="javascript:void(0);" class="menu-toggle">
									<i class="material-icons">print</i>
									<span>Report</span>
									</a>
									<ul class="ml-menu">
										<li class="sub_menu <?php if($menu_list['stock']['report']['0']==$_GET['pgr']){ echo 'active'; } ?>">
											<a href="index.php?pgr=stock_report">Stock Report</a>
										</li>
										<li class="<?php if($menu_list['stock']['report']['1']==$_GET['pgr']){ echo 'active'; } ?>">
											<a href="index.php?pgr=item_list">Item List</a>
										</li>
										<li class="<?php if($menu_list['stock']['report']['2']==$_GET['pgr']){ echo 'active'; } ?>">
											<a href="index.php?pgr=item_ledger">Item Ledger</a>
										</li>
										<li class="<?php if($menu_list['stock']['report']['3']==$_GET['pgr']){ echo 'active'; } ?>">
											<a href="index.php?pgr=under_limit">Under Limit Item</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="<?php if(is_in_array($_GET['pg'],$menu_list['accounts']) || is_in_array($_GET['pgr'],$menu_list['accounts'])){ echo 'active'; } ?>">
							<a href="javascript:void(0);" class="menu-toggle">
								<i class="material-icons">devices</i>
								<span>Accounts</span>
							</a>
							<ul class="ml-menu">
								<li class="sub_menu <?php if($menu_list['accounts']['entry']['0']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">verified_user</i>
										<span>Balance Sheet</span>
									</a>
								</li>
								<li class="<?php if($menu_list['accounts']['entry']['1']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">payment</i>
										<span>Asset Management</span>
									</a>
								</li>
								<li class="<?php if($menu_list['accounts']['entry']['2']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">autorenew</i>
										<span>Liabilities</span>
									</a>
								</li>
								<li class="<?php if($menu_list['accounts']['entry']['3']==$_GET['pgr']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">print</i>
										<span>Revenues</span>
									</a>
								</li>
								<li class="<?php if($menu_list['accounts']['entry']['4']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">contact_mail</i>
										<span>Expenses</span>
									</a>
								</li>
								<li class="<?php if($menu_list['accounts']['entry']['5']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">query_builder</i>
										<span>Income Statement</span>
									</a>
								</li>
								<li class="<?php if($menu_list['accounts']['entry']['5']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="#">
										<i class="material-icons">query_builder</i>
										<span>Statement Cash Flow</span>
									</a>
								</li>
							</ul>
						</li>
						<li >
							<a href="javascript:void(0);" class="menu-toggle">
								<i class="material-icons">business</i>
								<span>Company Information</span>
							</a>
							<ul class="ml-menu">
								<li class="<?php if($menu_list['cmp_info']['0']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=address_info">
										<i class="material-icons">my_location</i>
										<span>Address Information</span>
									</a>
								</li>
								<li class="<?php if($menu_list['cmp_info']['1']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=about_us">
										<i class="material-icons">business_center</i>
										<span>About Company</span>
									</a>
								</li>
								<li class="<?php if($menu_list['cmp_info']['2']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=about_team">
										<i class="material-icons">people</i>
										<span>Team Information</span>
									</a>
								</li>
								<li class="<?php if($menu_list['cmp_info']['3']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=msn_vsn">
										<i class="material-icons">mood</i>
										<span>Mission & Vision</span>
									</a>
								</li>
								<li class="<?php if($menu_list['cmp_info']['4']==$_GET['pg']){ echo 'active'; } ?>">
									<a href="?pg=our_valus">
										<i class="material-icons">star</i>
										<span>Company Values</span>
									</a>
								</li>
							</ul>
						</li>
						
						<li class="<?php if(is_in_array($_GET['pg'],$menu_list['sinup'])){ echo 'active'; } ?>">
							<a href="?pg=sinup">
								<i class="material-icons">account_box</i>
								<span>Sign up user</span>
							</a>
						</li>
						<li class="<?php if(is_in_array($_GET['pg'],$menu_list['systems_module'])){ echo 'active'; } ?>">
							<a href="?pg=systems_module">
								<i class="material-icons">account_box</i>
								<span>System Modules</span>
							</a>
						</li>
					</ul>
				</div>
				<!-- #Menu -->
				<!-- Footer -->
				<div class="legal">
					<div class="copyright">
						&copy; 2017 <a href="javascript:void(0);">MAYA APPS</a>.
					</div>
					<div class="version">
						<b>Version: </b> 2.0.4
					</div>
				</div>
				<!-- #Footer -->
			</aside>
			<!-- #END# Left Sidebar -->
		</section>
		<section class="content">
			<div class="container-fluid">
	<?PHP
}else{
	echo "Directory access is forbidden";
	exit;
}
?>