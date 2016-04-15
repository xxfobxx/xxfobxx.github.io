<?php

class FileBrowser {
	public function __construct() {}
	public function Run() { if(!php_Boot::$skip_constructor) {
		$map = php_Web::getParams();
		$query = $map->get("q");
		$directory = "img";
		if($query === "2") {
			$directory = "img2";
		}
		if($query === "3") {
			$directory = "img3";
		}
		$arr = sys_FileSystem::readDirectory($directory);
		$master = new _hx_array(array());
		{
			$_g = 0;
			while($_g < $arr->length) {
				$fileName = $arr[$_g];
				++$_g;
				$fullPath = _hx_string_or_null($directory) . "/" . _hx_string_or_null($fileName);
				$master->push($fullPath);
				unset($fullPath,$fileName);
			}
		}
		$this->PrintHeader();
		$this->PrintJavascript($master);
		$this->PrintHTML();
		$this->PrintImage();
		$this->PrintFooter();
	}}
	public function PrintHTML() {
		php_Lib::hprint("<br>File Image Browser. Use <left> <right> or click image.<br>");
		php_Lib::hprint("<br>Additional Directories: ");
		php_Lib::hprint("<a href=\"index.php?q=1\">img1</a> ");
		php_Lib::hprint("<a href=\"index.php?q=2\">img2</a> ");
		php_Lib::hprint("<a href=\"index.php?q=3\">img3</a> ");
		php_Lib::hprint("<br>");
	}
	public function PrintImage() {
		php_Lib::hprint("<a href=# onclick=\"NextIndex(1)\">");
		php_Lib::hprint("<img id=\"MainImage\">");
		php_Lib::hprint("</a><br>\x0A");
	}
	public function PrintHeader() {
		php_Lib::hprint("<html><body onload=\"Refresh()\" onKeyDown=\"OnKeyDown(event)\">");
	}
	public function PrintFooter() {
		php_Lib::hprint("</body></html>");
	}
	public function PrintJavascript($arr) {
		php_Lib::hprint("\x0A<script>\x0Avar master = [");
		{
			$_g1 = 0;
			$_g = $arr->length;
			while($_g1 < $_g) {
				$i = $_g1++;
				php_Lib::hprint("\"" . _hx_string_or_null($arr[$i]) . "\"");
				if($i !== $arr->length - 1) {
					php_Lib::hprint(", ");
				}
				unset($i);
			}
		}
		php_Lib::hprint("];\x0A");
		php_Lib::hprint("var currIndex = Math.floor(Math.random() * master.length);");
		php_Lib::hprint("function Refresh(){ document.getElementById('MainImage').src = master[currIndex];}\x0A");
		php_Lib::hprint("function NextIndex(i){ currIndex = (currIndex + i + master.length) % master.length; Refresh(); }");
		php_Lib::hprint("function OnKeyDown(event){ if(event.keyCode == 37) NextIndex(-1); if(event.keyCode == 39) NextIndex(1);}");
		php_Lib::hprint("</script>\x0A");
	}
	function __toString() { return 'FileBrowser'; }
}
