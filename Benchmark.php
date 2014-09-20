<?php
class Benchmark {

	private $timestamps=array();

	function __construct()	{
	}
	
	public function mark($name){
		$this->timestamps[]= array($name,microtime(true));
	}
	
	public function getTimestampsAsHtmlComment(){
		$total = $this->timestamps[count($this->timestamps)-1][1]-$this->timestamps[0][1];
		$html="\n<!--\n";
		$last = -1;
		foreach ($this->timestamps as $t){
			if ($last>0){
				$val = round($t[1] - $last,3);
				$prc = round(($val/$total)*100);
				$html.="$t[0] - $val - $prc%\n";
			} else {
				$html.="$t[0] - 0\n";
			}
			$last = $t[1];
		}
		$html.="Total - ".round($total,3)."\n";
		$html.="-->\n";
		return $html;
	}
}
?>
