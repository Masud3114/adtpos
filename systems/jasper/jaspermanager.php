<?php
// Systems Author: Maya Apps
// By: Md. Masud Mia 
// Systems Engineer @ Maya IT Solutions
//define("REPORT_BASE",str_replace("\\", "/", SERVER_ROOT));
//Report File Extenssion
//define("REPORT_EXTENSION",".jrxml");

class jasper_manager{
	//declarers all systems variable//
	private $java_systems=null;
	private $java_class=null;
	private $driver_manager=null;
	private $db_connection=null;
	private $viewer=null;
	private $report=null;
	private $fillManager=null;
	private $PrintManager=null;
	private $compileManager=null;
	private $params=null;
	private $emptyDataSource=null;
	private $runmanager=null;
	private $jasperPrint=null;
	private $input_path=null;
	private $outputPath=null;
	private $report_name=null;
	private $exporter=null;
	private $report_type=".jasper";
	
	public function __construct($report_name,$report_ext="jrxml"){
		require_once(REPORT_SERVER);
		$this->report_name=$report_name;
		$this->set_report_type(".".$report_ext);
		$this->java_systems = new JavaClass('java.lang.System');
		$this->java_class = new JavaClass("java.lang.Class");
		$this->java_class->forName("com.mysql.jdbc.Driver");
		$this->driver_manager = new JavaClass("java.sql.DriverManager");
		$this->db_connection = $this->driver_manager->getConnection("jdbc:mysql://localhost:3306/".DB_NAME."?user=".DB_USER."&password=".DB_PASS);
		$this->input_path=JASPER_PATH.'/'.$this->report_name.$this->report_type;
		$this->fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
		$this->runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");
		$this->params = new Java("java.util.HashMap");
	}
	public function __destruct(){
		unset($this->java_systems);
		unset($this->java_class);
		unset($this->driver_manager);
		unset($this->fillManager);
		unset($this->PrintManager);
		unset($this->runmanager);
		unset($this->params);
		unset($this->compileManager);
		unset($this->viewer);
		unset($this->exporter);
		unset($exporterXLS);
		unset($JRExporterParameter);
		unset($exporterDOC);
	}
	public function render_report($type_of_output="pdf",$prams=NULL){
		switch ($type_of_output){
			case 'print':
				$this->run_report_toprint($prams);
				break;
			case 'pdf':
				$this->run_report_topdf($prams);
				break;
			case 'html':
				$this->run_report_tohtml($prams);
				break;
			case 'xls':
				$this->run_report_toxls($prams);
				break;
			case 'csv':
				$this->run_report_tocsv($prams);
				break;
			case 'doc';
				$this->run_report_todoc($prams);
				break;
		}
		return $this->outputPath;
	}
	private function set_parameters($prameter){
		if($prameter!=NULL || !empty($prameter)){
			if(is_array($prameter)){
				foreach ($prameter as $key => $value) {
					$this->params->put($key, $value);
				}
			}else{
				die("Selected Parameter should be array!");
			}
		}
	}
	private function set_report_type($report_extenssion=null){
		$this->report_type=$report_extenssion;
	}
	public function DownloadFile($file) { // $file = include path
		if(file_exists($file)) {
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if($ext==='pdf'){
				$Content_Type=$ext;
				$Disposition="inline";
			}else{
				$Content_Type="octet-stream";
				$Disposition="attachment";
			}
			header('Content-Description: File Transfer');
			header('Content-Type: application/'.$Content_Type);
			header('Content-Disposition: '.$Disposition.'; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			register_shutdown_function('unlink', $this->outputPath);
		}

	}
	private function run_report_toprint($prameter=NULL){
		$this->set_parameters($prameter);
		$this->PrintManager = new JavaClass("net.sf.jasperreports.engine.JasperPrintManager");
		//$this->compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
		//$this->report = $this->compileManager->compilereport($this->input_path);
		$this->jasperPrint = $this->fillManager->fillReportToFile($this->input_path, $this->params, $this->db_connection);
		if($this->jasperPrint){
			 $this->PrintManager->printReport($this->jasperPrint, true);
		}
	}
	private function run_report_topdf($prameter=NULL){
		$this->set_parameters($prameter);
		if($this->report_type==".jrxml"){
			$this->compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
			//$this->viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
			$this->report = $this->compileManager->compilereport($this->input_path);
			//$this->emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");
			$this->jasperPrint = $this->fillManager->fillReport($this->report, $this->params, $this->db_connection);
			
			$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.pdf';
			$this->exporter= new Java("net.sf.jasperreports.engine.export.JRPdfExporter");
			$this->exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$this->jasperPrint);
			$this->exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$this->outputPath);
			$this->exporter->exportReport();
		}else{
			$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.pdf';
			$this->runmanager->runReportToPdfFile($this->input_path,$this->outputPath,$this->params,$this->db_connection);
		}
		$this->DownloadFile($this->outputPath);
		//header("Content-type: application/pdf");
		//header("Content-Disposition: inline; filename=".$this->report_name.".pdf");
		//readfile($this->outputPath);
		//register_shutdown_function('unlink', $this->outputPath);
	}
	private function run_report_tohtml($prameter=NULL){
		$this->set_parameters($prameter);
		if($this->report_type==".jrxml"){
			$this->compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
			$this->viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
			$this->report = $this->compileManager->compilereport($this->input_path);
			$this->jasperPrint = $this->fillManager->fillReport($this->report, $this->params, $this->db_connection);
			$this->exporter= new Java("net.sf.jasperreports.engine.export.JRHtmlExporter");
			$this->exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$this->jasperPrint);
			$this->exporter->exportReport();
			$this->viewer->viewReport($this->jasperPrint,false);
			
			$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.pdf';
			$this->exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$this->outputPath);
		}else{
			$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.html';
			readfile($this->runmanager->runReportTohtmlFile($this->input_path,$this->params,$this->db_connection));
		}
		//header("Content-type: application/html");
		//header("Content-Disposition: inline; filename=".$this->report_name.".html");
		//readfile($this->outputPath);
	}
	private function run_report_toxls($prameter=NULL){
		$this->set_parameters($prameter);
		$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.xls';
		$fillReport =$this->fillManager->fillReport($this->input_path, $this->params, $this->db_connection);
		$exporterXLS = new Java ('net.sf.jasperreports.engine.export.JRXlsExporter');
		$JRExporterParameter  =  new Java ('net.sf.jasperreports.engine.JRExporterParameter');
		$exporterXLS->setParameter($JRExporterParameter->JASPER_PRINT, $fillReport);
		$exporterXLS->setParameter($JRExporterParameter->OUTPUT_FILE_NAME, $this->outputPath);
		$exporterXLS->exportReport();
	}
	private function run_report_tocsv($prameter=NULL){
		$this->set_parameters($prameter);
		$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.csv';
		$this->exporter= new Java("net.sf.jasperreports.engine.export.JRCsvExporter");
		$this->exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$this->jasperPrint);
		$this->exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$this->outputPath);
		$this->exporter->exportReport();
	}
	private function run_report_todoc($prameter=NULL){
		$this->set_parameters($prameter);
		$this->outputPath =JASPER_OUTPUT.'export/'.$this->report_name.'.docx';
		$fillReport =$this->fillManager->fillReport($this->input_path, $this->params, $this->db_connection);
		$exporterDOC = new Java ('net.sf.jasperreports.engine.export.ooxml.JRDocxExporter');
		$JRExporterParameter  =  new Java ('net.sf.jasperreports.engine.JRExporterParameter');
		$exporterDOC->setParameter($JRExporterParameter->JASPER_PRINT, $fillReport);
		$exporterDOC->setParameter($JRExporterParameter->OUTPUT_FILE_NAME, $this->outputPath);
		$exporterDOC->exportReport();
	}
}
?>