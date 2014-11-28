<?php
error_reporting(E_ALL);

class Comparator {
		
	private  $text;
	private  $DFA=array();	
	private  $pattern;
	private  $altPatron;
		
	function __construct($seq, $pattern){	
		$this->text =$seq;
		$this->pattern=$pattern;
		//echo "<pre>";var_dump($this->pattern->sequence);echo "</pre>";
		//echo "<pre>";var_dump($this->text->sequence);echo "</pre>";
		$this->buildDFA();
	}
	
	public function getIndex(){
						
		return 	$str=$this->searchPattern($this->text);		
		 
	}	
		
	public function buildDFA(){	
		 $M = strlen($this->pattern->sequence);//
		 $R = 256; //caracteres
		//$dfa=array(array());
		//int[][] dfa = new int[R][M];		
		//this->dfa[pattern.charAt(0)][0] = 1;
		 $dfa[0][0]=0;
		for ($i=0; $i <$R ; $i++) { 
			for ($j=0; $j <$M; $j++) { 
				$dfa[$i][$j]=0;
			}
		}

		$dfa[ord(substr($this->pattern->sequence,0,1))][0]=1;
		
		for ($X=0, $j=1; $j<$M ; $j++) { 
			for ($c=0; $c<$R ; $c++) { 				
					$dfa[$c][$j]=$dfa[$c][$X];				
					//echo ord(substr($this->pattern->sequence,$j,1));
					$dfa[ord(substr($this->pattern->sequence,$j,1))][$j]=$j+1;
					$X=$dfa[ord(substr($this->pattern->sequence,$j,1))][$X];
			}			
		}
/*
		for (int X = 0, j = 1; j < M; j++)
		{
			for (int c = 0; c < R; c++)
				dfa[c][j] = dfa[c][X];
				dfa[pattern.charAt(j)][j] = j+1;
				X = dfa[pattern.charAt(j)][X];
		}

*/

		$this->DFA=$dfa;	
		//var_dump($this->DFA);
	}
		
	private function searchPattern($txt)
	{ 
		$g=0;	$str="";
		$N=strlen($txt->sequence);
		$M=strlen($this->pattern->sequence);
		
		for ($i=0, $state=0; $i <$N && $state<$M; $i++) { 
				$state=$this->DFA[ord(substr($txt->sequence,$i,1))][$state];
				if ($state==$M) {
					$g=abs($i-$N-1);
					$str[]=$g;
					$state=0;
				}
		}				
		return $str;


	private function preSearch()
	{ 

		$sp=$this->pattern;		
		$replacements[]= array('R'=>array('G','A'));
		$replacements[]= array('Y'=>array('T','C'));
		$replacements[]= array('K'=>array('G','T'));
		$replacements[]= array('M'=>array('A','C'));			
		$replacements[]= array('S'=>array('G','S'));
		$replacements[]= array('W'=>array('A','T'));
		$replacements[]= array('B'=>array('G','C','T'));
		$replacements[]= array('D'=>array('A','G','T'));
		$replacements[]= array('H'=>array('A','C','T'));
		$replacements[]= array('V'=>array('A','C','G'));
		$replacements[]= array('N'=>array('A','G','T','C'));		
		$jj=0;
		while ($jj < 11) {			
			$stt[]=preg_replace($replacements[$jj], $replacements, $sp);
		}		

	}



		/*for (i = 0, state = 0; i < N && state < M; i++)
		{
			state = this.DFA[txt.charAt(i)][state];
			if (state == M)
			{
				g=Math.abs(i - M);
				str+=String.valueOf(g)+", ";				
				state=0;
			}							
		}*/
		
	}
	
	public function getSequence() {
		return $this->text;
	}
	
	public function setSequence($x){	
		$this->text=$x;		
	}
	

	public function getPattern() {
		return $this->pattern;
	}
	
	public function setPattern($x){
		$this->pattern=$x;		
	}
}

?>
	