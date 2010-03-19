<?php
/**
* @package care_api
*/
/**
*  Pagination methods. 
*
* Handles the pagination of search results or lists with large number of returned rows.
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Paginator {
	/**
	* Maximum number of rows displayed. User configurable.
	* @var int
	*/
	var $max_nr=20;  
	/**
	* Current first row index
	* @var string
	*/
	var $csx=0; 
	/**
	* Total available data count
	* @var string
	*/
	var $tcount=0; 
	/**
	* Number of rows of resulting block
	* @var string
	*/
	var $blkcount=0;
	/**
	* This page name
	* @var string
	*/
	var $page='';
	/**
	* Internal searchkey
	* @var string
	*/
	var $skey='';
	/**
	* Database table field to be sorted
	* @var string
	*/
	var $sort_item='';
	/**
	* Sort direction, default is ascending
	* @var string
	*/
	var $sort_dir;
	/**
	* Root path of the module calling this object
	* @var string
	*/
	var $rootpath;
	/**
	* Constructor
	* @param int Index of the first row
	* @param string Forward filename or url
	* @param string Search keyword (reference)
	* @param string Root path
	* @param string Field name to sort
	* @param string Sort direction
	*/
	function Paginator($x=0,$fwdfile,&$sk,$rootpath,$oitem,$odir) {	
		if(empty($x)) $this->csx=0;
			else $this->csx=$x;
		$this->page=$fwdfile;
		$this->skey=strtr($sk,' ','+');
		$this->rootpath=$rootpath;
		$this->sort_item=$oitem;
		$this->sort_dir=$odir;
	}	
	/**
	* Sets the total number of rows of resulting data block.
	* @param int Total rows in a block count
	*/
	function setTotalBlockCount($c=0){
		$this->blkcount=$c;
	}
	/**
	* Sets the total number  of available rows in the table.
	* @param int Total available rows in the table
	*/
	function setTotalDataCount($c=0){
		$this->tcount=$c;
	}
	/**
	* Creates and returns the "previous" block link.
	* @access public
	* @param string URL link text in local language
	* @param string Additional url GET variables and values
	* @return string Complete URL link to "previous" block
	*/
	function makePrevLink($txt='',$append=''){
		if (!$this->csx){
			return '';
		}else{
			$x=$this->prevIndex();
			if(empty($txt)) $txt='Previous';
			//return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&searchkey='.$this->skey.'&pgx='.$x.'&totalcount='.$this->tcount.'"><< '.$txt.'</a>';
			return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&pgx='.$x.'&totalcount='.$this->tcount.'&oitem='.$this->sort_item.'&odir='.$this->sort_dir.$append.'"><< '.$txt.'</a>';
		}
	}
	/**
	* Creates and returns the "Next" block link.
	* @access public
	* @param string URL link text in local language
	* @param string Additional url GET variables and values
	* @return string Complete URL link to "Next" block
	*/
	function makeNextLink($txt='',$append=''){
		$x=$this->nextIndex();
		if ($x){
			if(empty($txt)) $txt='Next';
			//return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&searchkey='.$this->skey.'&pgx='.$x.'&totalcount='.$this->tcount.'">'.$txt.' >></a>';
			return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&pgx='.$x.'&totalcount='.$this->tcount.'&oitem='.$this->sort_item.'&odir='.$this->sort_dir.$append.'">'.$txt.' >></a>';
		}else{
			return '';
		}
	}
	/**
	* Returns the start index of the  previous block's row.
	* @access private
	* @return int
	*/
	function prevIndex(){
		$b=$this->csx-$this->max_nr;
		if($b>0) return $b;
			else return 0;
	}
	/**
	* Returns the start index of the  next block's row.
	* @access private
	* @return int
	*/
	function nextIndex(){
		$b=$this->csx+$this->max_nr;
		if($b<$this->tcount) return $b;
			else return 0;
	}
	/**
	* returns the maximal number of rows allowed for a block
	* @access public
	* @return int
	*/
	function MaxCount(){
		return $this->max_nr;
	}
	/**
	* Sets the maximal number of rows allowed for a block.
	* @access public
	* @param int Maximum number or returned rows
	* @return int
	*/
	function setMaxCount($max){
		if($max) {
			$this->max_nr=$max;
			return TRUE;
		}else{
			return FALSE;
		}
	}
	/**
	* Returns the index of the first row of the block.
	* @access public
	* @return int
	*/
	function BlockStartIndex(){
		return $this->csx;
	}
	/**
	* Returns the real block start number. Returns start index + 1.
	* @access public
	* @return int
	*/
	function BlockStartNr(){
		return $this->csx+1;
	}
	/**
	* Returns the real block end number.
	* @access public
	* @return int
	*/
	function BlockEndNr(){
		if($this->nextIndex()){
			return $this->csx+$this->max_nr;
		}else{
			if($this->blkcount==1) return $this->csx+1;
				else return $this->csx+$this->blkcount;
		}
	}
	/**
	* Returns a link for sorting.
	* @access public
	* @deprec Prefer to use the <var>makeSortLink()</var> method
	* @param string Text to display as link
	* @param string Field name to sort
	* @param string Sort direction. Defaults to 'ASC' = ascending.
	* @param boolean Flags to show or hide the direction arrow icon.
	* @param string Additional GET variables and values to be added to the URL link in this format: "&variable1=value1&variable2=value2"
	* @return string Complete URL link for sorting the rows
	*/
	function SortLink($txt,$item,$dir,$flag=FALSE,$append=''){
		if(empty($txt)) $txt='Sort';
		
		if(empty($dir)){
			if($this->sort_dir=='ASC') $dir='DESC';
				else $dir='ASC';
		}else{
			if($dir=='ASC') $dir='DESC';
				else $dir='ASC';
		}
		if($flag){
			if($dir=='ASC'){
				$img = '<img '.createComIcon($this->rootpath,'arrow_red_dwn_sm.gif','0').'>';
			}else{
				$img ='<img '.createComIcon($this->rootpath,'arrow_red_up_sm.gif','0').'>';
			}
		}else{
			$img='&nbsp;';
		}
			return '<a href="'.$this->page.URL_APPEND.'&mode=paginate&pgx='.$this->csx.'&totalcount='.$this->tcount.'&oitem='.$item.'&odir='.$dir.$append.'">'.$img.$txt.'</a>';
	}
	/**
	* Creates a link for sorting, improved version of SortLink().
	* @access public
	* @param string Text to display as link
	* @param string Field name to sort
	* @param string Previous field name used for sorting
	* @param string Sort direction. Defaults to 'ASC' = ascending.
	* @param string Additional GET variables and values to be added to the URL link in this format: "&variable1=value1&variable2=value2"
	* @return string Complete URL link for sorting the rows
	*/
	function makeSortLink($txt,$item,$oitem,$odir,$append){
		if($item==$oitem) $flag=TRUE;
			else $flag=FALSE;
		return $this->SortLink($txt,$item,$odir,$flag,$append);
	}
	/**
	* Sets the sort order field name.
	* @param string Field name to sort
	*/
	function setSortItem($item){
		$this->sort_item=$item;
	}
	/**
	* Sets the order direction.
	* @param string Sort direction. Defaults to 'ASC' = ascending.
	*/
	function setSortDirection($dir){
		$this->sort_dir=$dir;
	}
}
?>
