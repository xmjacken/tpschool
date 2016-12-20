<?php
namespace app\index\controller;
use think\Controller;

class LdapController extends Controller
{
	public function index()
	{
		// using ldap bind
		//$ldaprdn  = 'uid=USERNAME,cn=users,dc=HOSTNAME,dc=DOMAIN,dc=com';     // ldap rdn or dn
		//$ldappass = 'PASSWORD';  // associated password
		$ldaprdn  = 'jklai';
		$ldappass = 'xltl6095';  // associated password
		
		// connect to ldap server
		// $ldapconn = ldap_connect("HOSTNAME.DOMAIN.com")
		$ldapconn = ldap_connect("192.168.100.1")
		or die("Could not connect to LDAP server.");
		
		// Set some ldap options for talking to
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
		ldap_set_option ($ldapconn, LDAP_OPT_TIMELIMIT,5);
		ldap_set_option($ldapconn, LDAP_OPT_NETWORK_TIMEOUT, 5);
		
		if ($ldapconn) {
		
			// binding to ldap server
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
		
			// verify binding
			if ($ldapbind) {
				echo "LDAP bind successful...\n";
			} else {
				echo "LDAP bind failed...\n";
			}		
		}
		
	function ldaplogin($username,$password) {
		
		$ldaprdn  = $username;
		$ldappass = $password;  // associated password
		
		// connect to ldap server
		// $ldapconn = ldap_connect("HOSTNAME.DOMAIN.com")
		$ldapconn = ldap_connect("192.168.100.1")
		or die("Could not connect to LDAP server.");
		
		// Set some ldap options for talking to
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
		ldap_set_option ($ldapconn, LDAP_OPT_TIMELIMIT,5);
		ldap_set_option($ldapconn, LDAP_OPT_NETWORK_TIMEOUT, 5);
		
		if ($ldapconn) {
		
			// binding to ldap server
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
		
			// verify binding
			if ($ldapbind) {
				//echo "LDAP bind successful...\n";
				session('teacherId',$ldaprdn);
				return true;
			} else {
				//echo "LDAP bind failed...\n";
				return false;
			}
		}		
		
		}
	}
}