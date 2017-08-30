<?php
// Initialize session
//session_start();
//echo 'x1';
//$user = "oscarlu";
//$password = "11073839";
//echo $user;



function authenticate($user, $password) {
	if(empty($user) || empty($password)) return false;
	//echo 'x2';
	// Active Directory server
	$ldap_host = "nexcom.com.tw";

	// Active Directory DN
	$ldap_dn = "OU=NHQ,DC=nexcom,DC=com,DC=tw";

	// Active Directory user group
	$ldap_user_group = "WebUsers";

	// Active Directory manager group
	$ldap_manager_group = "BenDon system";

	// Domain, for purposes of constructing $user
	$ldap_usr_dom = '@nexcom.com.tw';
	//echo 'y2';
	// connect to active directory
	$ldap = ldap_connect($ldap_host)or die("cannot connect to $ldap_host");
//echo 'ya';
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
//echo 'yb';
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	//echo 'x3';
	if ($ldap) { // binding to ldap server 
    $ldapbind = @ldap_bind($ldap, $user.$ldap_usr_dom, $password); 
    // verify binding 
	
	//echo "x4";
	
    if ($ldapbind) { 
        $filter = "(sAMAccountName=$user)";
        $result = @ldap_search($ldap, $ldap_dn, $filter);

        if($result==false) echo "verify failed1";
        else {
			
            //echo "verify successed"; 
            //取出帳號的所有資訊
            $entries = ldap_get_entries($ldap, $result);
			return true;	
        }
    }
	// verify user and password
	else {
		// invalid name or password
		return false;}
	}
}
//authenticate($user, $password);
?>
