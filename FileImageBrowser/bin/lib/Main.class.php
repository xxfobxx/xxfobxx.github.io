<?php

class Main {
	public function __construct(){}
	static function main() {
		$Fs = new FileBrowser();
		$Fs->Run();
	}
	function __toString() { return 'Main'; }
}
