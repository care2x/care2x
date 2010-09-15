<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
* Class for access authentication rout�nes.
* Extends the class "Core".
* Note this class should be instantiated only after a "$db" adodb  connector object has been established by an adodb instance
* @package care_api
*/
class Access extends Core {
	/**
	* Users table name
	* @var string
	*/
	var $tb_user='care_users';
	/**
	* Users table name
	* @var string
	*/
	var $tb_role='care_user_roles';	
	/**
	* Holder for user data in associative array
	* @var array
	*/
	var $user=array();
	/**
	* Holder for role data in associative array
	* @var array
	*/
	var $role=array();
	/**
	* Allowed areas in hieararchical order
	* @var array
	*/
	var $allowedareas=array();
	/**
	* Allowed department id
	* @var int
	*/
	var $dept_nr;
	/**
	* User's registration status.
	* FALSE = unknown.
	* TRUE = known.
	* @var boolean
	*/
	var $usr_status=FALSE;
	/**
	* Flags if the "all" permission type is permitted.
	* Default is TRUE.
	* @var boolean
	*/
	var $permit_type_all=TRUE;
	/**
	* Password status.
	* FALSE = wrong password.
	* TRUE = correct password.
	* @var boolean
	*/
	var $pw_status=FALSE;
	/**
	* The access permission status.
	* FALSE = locked.
	* TRUE = access allowed.
	* @var boolean
	*/
	var $lock_status=FALSE;
	/**
	* Internal buffer for the login id (username)
	*/
	var $login_id;
	/**
	* Constructor. If login and password are passed as parameters, the access data are immediately loaded.
	*
	* For example:
	*
	* <code>
	* $user =  & new Access('Smith','Cocapabana');
	* if( $user->isKnown() && $user->hasValidPassword && $user->isNotLocked()){
	* ...
	* }
	* </code>
	*
	* @param string Login name
	* @param string Password
	* @access public
	* @return boolean
	*/
	function Access($login='',$pw=''){
		$this->coretable=$this->tb_user;
		$this->login_id =$login;
		if(!empty($login)&&!empty($pw)){
			return $this->loadAccess($login,$pw);
		}
	}
	/**
	 * Loads the role data
	 *
	 * @param int $id the id of the selected role
	 * @return boolean
	 */
	function roleAccess($id){
		$this->coretable=$tb_role;
		return $this->loadRole($id);
	}	
	/**
	* Loads the user data and checks its access status. 
	* Use if login and password were not passed during construction OR if a new access data is to be loaded using the same object instance.
	*
	* For example:
	*
	* <code>
	* $user =  & new Access;
	* ....
	* $user->loadAccess('Smith','Cocapabana');
	* if( $user->isKnown() && $user->hasValidPassword && $user->isNotLocked()){
	* ...
	* }
	* </code>
	*
	* @param string Login name
	* @param string Password
	* @access public
	* @return boolean
	*/
	function loadAccess($login='',$pw=''){
		/**
		* @global ADODB-db-link
		*/
		global $db;
		# Reset all status
		$this->pw_status=FALSE;
		$this->lock_status=FALSE;
		if(empty($login)){
			if(!empty($this->login)) $login=$this->login;
				else return FALSE;
		}
		if(empty($pw)){
			if(!empty($this->pw)) $pw=$this->pw;
				else return FALSE;
		}
		$this->sql="SELECT name,login_id,password, permission, lockflag, dept_nr FROM $this->tb_user WHERE login_id ='".addslashes($login)."'";
		if ($result=$db->Execute($this->sql)) {
		    if ($this->rec_count=$result->RecordCount()) {
		       $this->user=$result->FetchRow();
			   $this->usr_status=TRUE; # User is known
			   if($this->user['password']==md5($pw)) $this->pw_status=TRUE; # Password is valid
			   if((int)$this->user['lockflag'])  $this->lock_status=TRUE; # Access is locked
			   return TRUE;
			}else{
				$usr_status=FALSE;
				return FALSE;
			}
		}else{
			$usr_status=FALSE;
			return FALSE;
		}
	}
	/**
	 * Loads the role Status
	 *
	 * @param int $id Role ID
	 * @return boolean
	 */
	function loadRole($id){
		/**
		* @global ADODB-db-link
		*/
		global $db;
		# Reset all status
		if(empty($id)){
			return FALSE;
		}
		$this->sql="SELECT role_name, id, permission FROM $this->tb_role WHERE id ='".$id."'";
		if ($result=$db->Execute($this->sql)) {
		    if ($this->rec_count=$result->RecordCount()) {
		       $this->role=$result->FetchRow();
			   return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	/**
	* Returns the password status of the user
	* @access public
	* @return boolean  TRUE = password valid, else FALSE = invalid password
	*/
	function hasValidPassword(){
		return $this->pw_status;
	}
	/**
	* Returns the user  status of the user whether he is registered user or not.
	* @access public
	* @return boolean  TRUE = is registered as user, else FALSE = invalid user
	*/
	function isKnown(){
		return $this->usr_status;
	}
	/**
	* Returns the user permission "is locked?" status.
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @return boolean TRUE = User permissionis locked, else FALSE = user unknown or unregisted
	*/
	function isLocked(){
		return $this->lock_status;
	}
	/**
	* Returns the permission "is not locked?" status. A negation of isLocked() method.
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @return boolean FALSE = User permission is locked, else TRUE = permission is locked
	*/
	function isNotLocked(){
		return !$this->lock_status;
	}
	/**
	* Returns the user's registered name.
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @return string
	*/
	function Name(){
		return $this->user['name'];
	}
	/**
	* Returns the user's login name ( login username ).
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @return string
	*/
	function LoginName(){
		return $this->user['login_id'];
	}
	/**
	* Returns the permission areas of the user. No interpretation is returned.
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @return string
	*/
	function PermissionAreas(){
		return $this->user['permission'];
	}
	/**
	* Returns the permission dept of the user. No interpretation is returned.
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @return string
	*/
	function PermittedDepartment(){
		return unserialize($this->user['dept_nr']);
	}	
	/**
	* Checks if the user is permitted in a given protected area.
	*
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @param string The area to be checked.
	* @return string
	*/
	function isPermitted($area=''){
		if(empty($area)) return false;
		return (stristr($this->user['permission'],$area));
	}
	/**
	* Sets the allowed hierarchical areas.
	*
	* @param array The allowed areas in hierarchy.
	* @access public
	* @return string
	*/
	function setAllowedAreas($areas=''){
		if($areas){
			$this->allowedareas=$areas;
			return TRUE;
		}else{
			return FALSE;
		}
	}
	/**
	* Checks if the user is permitted in the group of protected areas.
	*
	* This checks also whether the user is permitted in the area due to its role or position in the privilege hierarchy.
	* The group of areas must be set first with the "setAllowedAreas()" method.
	* Use only after the access data was loaded by the constructor or loadAccess() method.
	* @access public
	* @param string The area to be checked.
	* @return string
	*/
	function isPermittedInGroup($user_area=''){
		if(empty($user_area)){
			return FALSE;
		}else{
			if(ereg('System_Admin', $user_area)){  // if System_admin return true
	   			return TRUE;
			}elseif(in_array('no_allow_type_all', $this->allowedareas)){ // check if the type "all" is blocked, if so return false
	     			return FALSE;
			}elseif($this->permit_type_all && ereg('_a_0_all', $user_area)){ // if type "all" , return true
				return TRUE;
			}else{                                                                  // else scan the permission
				for($j=0;$j<sizeof($this->allowedareas);$j++){
					if(ereg($this->allowedareas[$j],$user_area)) return TRUE;
				}
			}
			return FALSE;           // otherwise the user has no access permission in the area, return false
		}
	}
	/**
	*  Checks the  data if user exists based on his username (login id)
	*
	* @public
	* @param string Username or login id
	* @return mixed adodb record or boolean FALSE
	*/
	function UserExists($login_id){
		global $db;
		if(!empty($login_id)) $this->login_id=$login_id;
			elseif(empty($this->login_id)) return FALSE;

		$this->sql="SELECT * FROM care_users WHERE login_id='".addslashes($this->login_id)."'";

		if ($this->res['_ud']=$db->Execute($this->sql)) {
			if ($this->res['_ud']->RecordCount()) {
				$this->user = $this->res['_ud']->FetchRow();
				$this->lock_status = $this->user['lockflag'];
				return TRUE;
			} else {
				$this->usr_status=FALSE;
				return false;
			}
		} else {
			$this->usr_status=FALSE;
			return false;
		}
	}
	/**
	*  Checks the  data if role exists based on his id
	*
	* @public
	* @param int role id
	* @return mixed adodb record or boolean FALSE
	*/
	function roleExists($id){
		global $db;
		if(empty($id)) return FALSE;

		$this->sql="SELECT * FROM care_user_roles WHERE id='".$id."'";

		if ($this->res['_ud']=$db->Execute($this->sql)) {
			if ($this->res['_ud']->RecordCount()) {
				$this->role = $this->res['_ud']->FetchRow();
				return TRUE;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	/**
	*  Checks the  data if role exists based on his name
	*
	* @public
	* @param int role name
	* @return mixed adodb record or boolean FALSE
	*/
	function roleExistsByName($roleName){
		global $db;
		if(empty($roleName)) return FALSE;

		$this->sql="SELECT * FROM care_user_roles WHERE role_name='".$roleName."'";
		if ($this->res['_ud']=$db->Execute($this->sql)) {
			if ($this->res['_ud']->RecordCount()) {
				$this->role = $this->res['_ud']->FetchRow();
				return TRUE;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}	
	/**
	*  Changes the lock status of the user
	*
	* @private
	* @param boolean
	* @return boolean
	*/
	function _changelock($newlockflag=0){
		$this->sql="UPDATE $this->tb_user SET lockflag='$newlockflag' WHERE login_id='$this->login_id'";
		return $this->Transact($this->sql);
	}
	/**
	*  Locks access permission of the user
	*
	* @public
	* @return boolean
	*/
	function Lock(){
		return $this->_changelock(1);
	}
	/**
	*  UNlocks access permission of the user
	*
	* @public
	* @return boolean
	*/
	function UnLock(){
		return $this->_changelock(0);
	}
	/**
	*  Deletes the user if exists based on his username (login id)
	*
	* @public
	* @param string Username or login id
	* @return mixed adodb record or boolean FALSE
	*/
	function Delete($login_id){
		global $db;
		if(!empty($login_id)) $this->login_id=$login_id;
			elseif(empty($this->login_id)) return FALSE;

		$this->sql="DELETE FROM $this->tb_user  WHERE login_id='$this->login_id'";

		if ($this->Transact($this->sql)) {
			$this->user = NULL;
			$this->allowedareas = NULL;
			$this->usr_status=FALSE;
			$this->pw_status=FALSE;
			$this->lock_status=FALSE;
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/**
	*  Deletes the role if exists based on his role id
	*
	* @public
	* @param id role id=
	* @return mixed adodb record or boolean FALSE
	*/
	function roleDelete($id){
		global $db;
		if(empty($id)) return FALSE;

		$this->sql="DELETE FROM $this->tb_role  WHERE id=$id";
		if ($this->Transact($this->sql)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	/**
	 * Loads all the active roles
	 *
	 * @return ADODB
	 */
	function loadAllRoles(){
		global $db;
		# Reset all status
		$this->sql="SELECT * FROM $this->tb_role";
		if ($result=$db->Execute($this->sql)) {
		    if ($this->rec_count=$result->RecordCount()) {
		       return $result->GetArray();;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}
?>
