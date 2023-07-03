<?php 
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller 
{
    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL, $clickMenu = TRUE)
	{
        $header = BASE_DIR."application/views/templates/header.php";
		if ($clickMenu == FALSE) {
			$nav = BASE_DIR."application/views/templates/nav_disabled.php";
		} else {
			$nav = BASE_DIR."application/views/templates/sidebar.php";
		}
		$topbar = BASE_DIR."application/views/templates/topbar.php";
		$footer = BASE_DIR."application/views/templates/footer.php";
		$scripts = BASE_DIR."application/views/templates/scripts.php";

		$content = BASE_DIR."application/views/".$viewName.".php";
		$content_view_script = BASE_DIR."application/views/".$viewName."_script.php";
		if(file_exists($content_view_script)){
			$content_script = $content_view_script;
		} else {
			$content_script = BASE_DIR."application/views/content_script.php";
		}
		
		/*---------------- PHP Custom Scripts ---------
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC. */ 
		$data = json_decode(json_encode($headerInfo), True);
		
		$page_title = $data['page_title'];
		$active = $pageInfo['active'];

		include($header);

		?>
		    <!-- Page Wrapper -->
			<div id="wrapper">
		<?php

		if($page_title != 'Lock Screen') {
			
			include($nav);
		}
		?>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

		<?php include($topbar); ?>
			
			<!-- MAIN CONTENT -->
			
            	<div class="content container-fluid">
				
				<?php 
					include($content);  
				?>
				<!-- END MAIN CONTENT -->			
				
				<!-- /#right-panel -->
				
				
				<!-- FOOTER -->
				<?php include($footer); ?>
				<!-- END FOOTER -->
				</div>
				<!-- End of Main Content --> 
				</div>
			</div>
        <!-- End of Content Wrapper -->

    	</div>
    <!-- End of Page Wrapper -->
		<?php
		include($scripts); 
		//include content scripts
		include($content_script);
		?>
		
	</body>
	</html>

		<?php
    } 

	function loadViewsAdmin($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL, $clickMenu = TRUE)
    {
        $header = BASE_DIR."application/views/templatesAdm/header.php";
		if ($clickMenu == FALSE) {
			$nav = BASE_DIR."application/views/templatesAdm/nav_disabled.php";
		} else {
			$nav = BASE_DIR."application/views/templatesAdm/sidebar.php";
		}
		$topbar = BASE_DIR."application/views/templatesAdm/topbar.php";
		$footer = BASE_DIR."application/views/templatesAdm/footer.php";
		$scripts = BASE_DIR."application/views/templatesAdm/scripts.php";

		$content = BASE_DIR."application/views/".$viewName.".php";
		$content_view_script = BASE_DIR."application/views/".$viewName."_script.php";
		if(file_exists($content_view_script)){
			$content_script = $content_view_script;
		} else {
			$content_script = BASE_DIR."application/views/content_script.php";
		}
		
		/*---------------- PHP Custom Scripts ---------
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC. */ 
		$data = json_decode(json_encode($headerInfo), True);
		
		$page_title = $data['page_title'];
		$active = $pageInfo['active'];

		include($header);

		?>
		    <!-- Page Wrapper -->
			<div id="wrapper">
		<?php

		if($page_title != 'Lock Screen') {
			
			include($nav);
		}
		?>
		<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

		<?php include($topbar); ?>
			
			<!-- MAIN CONTENT -->
			
            	<div class="content container-fluid">
				
				<?php 
					include($content);  
				?>
				<!-- END MAIN CONTENT -->			
				
				<!-- /#right-panel -->
				
				
				<!-- FOOTER -->
				<?php include($footer); ?>
				<!-- END FOOTER -->
				</div>
				<!-- End of Main Content --> 
				</div>
			</div>
        <!-- End of Content Wrapper -->

    	</div>
    <!-- End of Page Wrapper -->
		<?php
		include($scripts); 
		//include content scripts
		include($content_script);
		?>
		
	</body>
	</html>

		<?php
    } 
}