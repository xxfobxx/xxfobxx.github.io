package;
import php.Lib;
import php.Web;
import sys.FileSystem;
class FileBrowser
{

	public function new() 
	{
		
	}
	
	public function Run():Void
	{
		var map:Map<String,String> = Web.getParams();
		var query:String = map['q'];
		var directory:String = "img";
		if (query == '2')
			directory = "img2";
		if (query == '3')
			directory = "img3";
		
		var arr:Array<String> = FileSystem.readDirectory(directory);
		var master:Array<String> = new Array();
		for (fileName in arr)
		{
			var fullPath:String = directory + "/" + fileName;
			master.push(fullPath);
		}
		
		PrintHeader();
		PrintJavascript(master);
		PrintHTML();
		PrintImage();
		PrintFooter();
	}
	public function PrintHTML():Void
	{
		Lib.print("<br>File Image Browser. Use <left> <right> or click image.<br>");
		Lib.print("<br>Additional Directories: ");
		Lib.print("<a href=\"index.php?q=1\">img1</a> ");
		Lib.print("<a href=\"index.php?q=2\">img2</a> ");
		Lib.print("<a href=\"index.php?q=3\">img3</a> ");
		Lib.print("<br>");
	}
	
	public function PrintImage():Void
	{
		Lib.print("<a href=# onclick=\"NextIndex(1)\">");
		Lib.print("<img id=\"MainImage\">");
		Lib.print("</a><br>\n");
	}
	
	public function PrintHeader():Void
	{
		Lib.print("<html><body onload=\"Refresh()\" onKeyDown=\"OnKeyDown(event)\">");
	}
	
	public function PrintFooter():Void
	{
		Lib.print("</body></html>");
	}
	
	public function PrintJavascript(arr:Array<String>):Void
	{
		Lib.print("\n<script>\nvar master = [");
		for (i in 0 ... arr.length)
		{
			Lib.print("\"" + arr[i] + "\"");
			
			if (i != arr.length - 1)
				Lib.print (", ");
		}
		Lib.print ("];\n");
		Lib.print ("var currIndex = Math.floor(Math.random() * master.length);");
		Lib.print ("function Refresh(){ document.getElementById('MainImage').src = master[currIndex];}\n");
		Lib.print ("function NextIndex(i){ currIndex = (currIndex + i + master.length) % master.length; Refresh(); }");
		Lib.print ("function OnKeyDown(event){ if(event.keyCode == 37) NextIndex(-1); if(event.keyCode == 39) NextIndex(1);}");
		Lib.print ("</script>\n");
	}
	
}