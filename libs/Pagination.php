<?php
/*
* SET NUMBER OF ROWS AND PAGE NUMBER
* GET PAGE LIMIT FOR THE SQL
* GET PAGINATION CONTROLLS
*/
class Pagination {
	private $num_rows =  '';
	private $page_num = '';
	public $page_rows = 10;
	public $link = '';
	public $pagenation_ = '';
	public function __construct($n_rows, $p_num){
		$this->num_rows =  $n_rows;
		$this->page_num = $p_num;
		$this->setLink();
	}
	public function setLink($link = 'apartments/page/'){
		$this->link = URL . $link;
	}
	public function getPageLimit(){
		//$this->num_rows IS THE TOTAL NUMBER OF ROWS FROM THE QUERY ($this->db->this->num_rows)
		$last = ceil($this->num_rows / $this->page_rows);
		if($last <1){
			$last = 1;
		}
		if($this->page_num <1){
			$this->page_num = 1;
		}else if($this->page_num > $last){
			$this->page_num = $last;
		}
		$limit = ' LIMIT ' . ($this->page_num - 1) * $this->page_rows . ','. $this->page_rows;
		
		return $limit;
	}
	public function pageControl(){
		return $this->pageCntrl();
	}
	public function pageCntrl(){
		$centerleft = $nextbtn = $previousbnt = $centerright = $center = '';
		$last = ceil($this->num_rows / $this->page_rows);
		if($last <1){
			$last = 1;
		}
		if($last != 1 ){
			if($this->page_num >1){
				$previous = $this->page_num - 1;
				$previousbnt = '<span><a href="'.$this->link.$previous.'">BACK</a></span>';
			
				for($i = $this->page_num - 4; $i < $this->page_num; $i++){
					if($i > 0){
						$centerleft	.= '<span><a href="'.$this->link.$i.'">'.$i.'</a></span>';
					}
				}
			}else{
				$previousbnt = '<span>BACK</span>';
			}
			$center = '<span>'.$this->page_num .'</span>';
			for($i = $this->page_num + 1; $i <= $last; $i++){
				$centerright .= '<span><a href="'.$this->link.$i.'">'.$i.'</a></span>';
				if($i > $this->page_num +4){
					break;
				}
			}
			if($this->page_num != $last){
				$next = $this->page_num + 1;
				$nextbtn = '<span><a href="'.$this->link.$next.'">NEXT</a></span>';
			}else {
				$nextbtn = '<span>NEXT</span>';
			}
		} 
		return  $previousbnt . $centerleft . $center . $centerright . $nextbtn; 
	}
}