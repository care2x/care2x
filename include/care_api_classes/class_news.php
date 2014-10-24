<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  News methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 1.0.08
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class News extends Core {
	/**
	* Table name for news articles
	* @var string
	*/
	var $tb='care_news_article'; // table name
	/**
	* Buffer for sql query results.
	* @var adodb record object
	*/
	var $result;
	/**
	* Buffer for row returned by adodb's FetchRow() method
	* @var array
	*/
	var $row;
	/**
	* Universal buffer
	* @var mixed
	*/
	var $buffer;
	/**
	* Healine numbers
	* @var array
	*/
	var $headnrs=array();
	
	/**
	* Constructor
	*/
	function News(){
		$this->coretable=$this->tb;
	}
	/**
	* Gets a news item based on its primary key number.
	*
	* @param int  Record key number
	* @param string  Field name whose content should be fetched
	* @return mixed string or boolean
	*/			
	function getItem($nr=0,$item='')  {
	    global $db;
	
	    if(!$nr||empty($item)) return false;

	    if ($this->result=$db->Execute("SELECT $item FROM $this->tb WHERE nr='$nr'")) {
		    if ($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row[$item];
			} else {
			    return false;
			}
		} else {
		    return false;
		}
	}
	/**
	* Gets the title of the news based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getTitle($nr=0) {

	    if ($this->buffer=$this->getItem($nr,'title')) return $this->buffer;
			return false;
	}
	/**
	* Gets the preface (leading summary) of the news based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getPreface($nr=0) {

	    if ($this->buffer=$this->getItem($nr,'preface')) return $this->buffer;
			return false;
	}
	/**
	* Gets the body of the news based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getBody($nr) {

	    if ($this->buffer=$this->getItem($nr,'body')) return $this->buffer;
			return false;
	}
	/**
	* Gets the author of the news based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getAuthor($nr) {

	    if ($this->buffer=$this->getItem($nr,'author')) return $this->buffer;
			return false;
	}
	/**
	* Gets the publication date of the news based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getPublishDate($nr) {

	    if ($this->buffer=$this->getItem($nr,'publish_date')) return $this->buffer;
			return false;
	}
	/**
	* Gets submission date of the news based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getSubmitDate($nr) {

	    if ($this->buffer=$this->getItem($nr,'submit_date')) return $this->buffer;
			return false;
	}
	/**
	* Gets file extension (mime type) of the image accompanying the news article based on its primary key number.
	*
	* @param int  Record's key number
	* @return mixed string or boolean
	*/			
	function getPicMime($nr) {

	    if ($this->buffer=$this->getItem($nr,'pic_mime')) return $this->buffer;
			return false;
	}
	/**
	* Gets  the news article based on its primary key number.
	*
	* The returned array contains the news data with the following index keys:
	* - nr = record's primary number
	* - title = news title
	* - preface = news preface or leading summary
	* - body = article body
	* - pic_mime = image file extension (mime type)
	* - art_num = layout order number 1 - 5
	* - author = author
	* - publish_date = publication date
	* - submit_date = submission date
	*
	* @param int  Record's key number
	* @return mixed array or boolean
	*/			
	function getNews($nr) {
	    global $db;

	    //$this->sql="SELECT nr,title,preface,body,pic_mime,art_num,author,publish_date,submit_date FROM $this->tb WHERE nr=$nr";
	    $this->sql="SELECT * FROM $this->tb WHERE nr=$nr";
		//echo $this->sql;

	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
			    return false;
			}
		} else {
		    return false;
		}
	}
	/**
	* Gets  news articles of a department for preview purposes.
	*
	* The returned array contains the news data with the following index keys:
	* - nr = record's primary number
	* - title = news title
	* - preface = news preface or leading summary
	* - body = article body
	* - pic_mime = image file extension (mime type)
	*
	* @param int  Department number. e.g. 1 = news headlines
	* @param int  Number or articles returned
	* @return mixed 2 dimensional array or boolean
	*/			
	function getHeadlinesPreview($dept_nr=0,$count) {
	    global $db, $sql_LIKE;
		
		$i=1;
		$today=date('Y-m-d');
	
		$str_sql="SELECT nr,title,preface,body,pic_mime,pic_file FROM ".$this->tb." WHERE dept_nr=".$dept_nr;
						
		$stat_pending=" AND status<>'pending'";
		$order_by_desc=" ORDER BY create_time DESC";

		for($i=1;$i<=$count;$i++) 
		{
		    $sql=$str_sql." AND art_num='".$i."'";
		    $publish_when=" AND publish_date $sql_LIKE  '".$today."'";
            if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
		 	    $sql.=$publish_when.$stat_pending;
            } else {
		        $sql.=$publish_when;
		    }
		  
		    $this->sql=$sql.$order_by_desc;

			if($this->result=$db->Execute($this->sql)) {
			    if($this->rec_count=$this->result->RecordCount()) {
				    $this->buffer[$i]=$this->result->FetchRow();
					$this->headnrs[$i]=$this->buffer[$i]['nr'];
				} else {
				 
				    // if no file found get the last entry
				    $sql=$str_sql." AND art_num='".$i."'";
				    $publish_when=" AND publish_date<'".$today."'";
                  
				    if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
					    $sql.=$publish_when.$stat_pending;
                    } else {
					    $sql.=$publish_when;
				    }									
				
				    $this->sql=$sql.$order_by_desc;
			  			
				    if($this->result=$db->Execute($this->sql)) {
					    if($this->rec_count=$this->result->RecordCount()) {
						    $this->buffer[$i]=$this->result->FetchRow();
							$this->headnrs[$i]=$this->buffer[$i]['nr'];
					    }
				   }
			    }
			}
		}
		
		if(!empty($this->buffer)) return $this->buffer;
		    else return false;
	}
	/**
	* Gets  archived news articles of a department.
	*
	* The returned adodb record object containts rows of arrays sorted in descending creation time. 
	* Each array contains the news data with the following index keys:
	* - nr = record's primary number
	* - title = news title
	* - preface = news preface or leading summary
	* - author = author
	* - publish_date = publication date
	* - submit_date = submission date
	*
	* @param int  Department number. e.g. 1 = news headlines
	* @param array Headlines preview record numbers
	* @return mixed adodb record object or boolean
	*/			
	function getArchiveList($dept_nr=0,&$heads) {
	    global $db;
	    
		if(!$dept_nr) return false;
		
		/* Now set the sql query for article # 5 or the achived news */
        $this->sql="SELECT nr,title,preface,author,publish_date,submit_date FROM $this->tb WHERE dept_nr=".$dept_nr;
       
	   while(list($x,$v)=each($this->headnrs)) {
            $this->sql.=' AND nr<>'.$v;
        }
		
		$this->sql.=" OR (dept_nr=$dept_nr AND art_num=5)";

        if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
           $this->sql.=" AND status<>'pending'";
        }
		 
        $this->sql.=" ORDER BY create_time DESC";
		 
		//echo $sql_archive;
	    if($this->res['gal']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gal']->RecordCount())  return $this->res['gal'];
			    else return false;
	    }
	}
	/**
	* Gets department news articles' information.
	*
	* The returned adodb record object contains rows of arrays sorted in descending creation time. 
	* Each array contains the news data with the following index keys:
	* - nr = record's primary number
	* - title = news title
	* - author = author
	* - publish_date = publication date
	* - submit_date = submission date
	*
	* @param int  Department number. e.g. 1 = news headlines
	* @return mixed adodb record object or boolean
	*/			
	function getList($dept_nr=0) {
	    global $db;
	    
		if(!$dept_nr) return false;
		
        $sql_archive="SELECT nr,title,author,publish_date,submit_date FROM $this->tb WHERE dept_nr=".$dept_nr;
					
        if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
           $sql_archive.=" AND status<>'pending'";
        }
		 
        $sql_archive.=" ORDER BY create_time DESC";
		  							
	    if($this->result=$db->Execute($sql_archive)) {
            if($this->result->RecordCount())  return $this->result;
			    else return false;
	    }
	}
	/**
	* Gets department's news information with preface text and image.
	*
	* The returned adodb record object contains rows of arrays sorted in descending creation time. 
	* Each array contains the news data with the following index keys:
	* - nr = record's primary number
	* - title = news title
	* - preface = news preface or leading summary
	* - pic_mime = image file extension (mime type)
	* - author = author
	* - publish_date = publication date
	* - submit_date = submission date
	*
	* The insert ID will be returned when save is successful, else FALSE.
	*
	* @param int  Department number. e.g. 1 = news headlines
	* @return mixed integer or boolean
	*/			
	function getShortPreviewList($dept_nr=0) {
	    global $db;
	    
		if(!$dept_nr) return false;
		
        $sql_archive="SELECT nr,title,preface,pic_mime,author,publish_date,submit_date FROM $this->tb WHERE dept_nr=".$dept_nr;
					
        if(defined('MODERATE_NEWS') && (MODERATE_NEWS==1)) {
           $sql_archive.=" AND status<>'pending'";
        }
		 
        $sql_archive.=" ORDER BY create_time DESC";
		  							
	    if($this->result=$db->Execute($sql_archive)) {
            if($this->result->RecordCount())  return $this->result;
			    else return false;
	    }
	}
	/**
	* Saves news article.
	*
	*  The news article and supporting data must be passed by reference with an associative array.
	* The data must be packed in the array with the following index keys:
	* - category = category number
	* - title = news title
	* - preface = news preface or leading summary
	* - body =  news body
	* - pic_mime = image file extension (mime type)
	* - art_num = article layout (order) number, 1 - 5
	* - author = author
	* - publish_date = publication date
	*
	* @param int  Department number. e.g. 1 = news headlines
	* @return mixed adodb record object or boolean
	*/			
	function saveNews($dept_nr=0, &$news) {
	    global $db, $lang, $_SESSION, $dbtype;
	    //$db->debug=true;
	    # Seed random gen
	    srand();
	    $imgfname=rand();
	    $ts=date('YmdHis');
		if(!$dept_nr){
			$this->sql="No department number supplied!";
			$this->error_msg=$this->sql;
			return FALSE;
		}else{
				
			$this->sql="INSERT INTO $this->tb
						(	
						    lang,
							dept_nr,
							category,
							title,
							preface,
							body,
							pic_mime,
							art_num,
							pic_file,
							author,
							submit_date,
							publish_date,
							modify_id,
							create_id,
							create_time
							) VALUES 
						(	
							'".$lang."',
							'".$dept_nr."',
							'".addslashes($news['category'])."',
							'".addslashes($news['title'])."',
							'".addslashes($news['preface'])."',
							'".addslashes($news['body'])."',
							'".$news['pic_mime']."',
							'".$news['art_num']."',
							'".$imgfname."',
							'".$news['author']."',
							'".date('Y-m-d H:i:s')."',
							'".$news['publish_date']."',
							'".$_SESSION['sess_user_name']."',
							'".$_SESSION['sess_user_name']."',
							".$ts."
							)";
			//echo $this->sql."<p>";
			if($this->result=$this->Transact($this->sql)) {
				$pk =  $db->Insert_ID();
				return $this->LastInsertPK('nr',$pk);
			} else {return false;}

		}
	}
	
}
?>
