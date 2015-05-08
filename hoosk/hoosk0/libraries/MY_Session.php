<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *	Native Session using Memcached
 *
 *	Another session library extension that uses Native PHP session
 *	mechanism instead of the original Codeigniter cookie-based way.
 *	It also takes memcached as the session data storage, which will
 *	boost the performance of your app.
 *
 *
 *	@package    CodeIgniter
 *	@subpackage Libraries
 *	@category   Libraries
 *	@author     Saturn <yangg.hu@gmail.com>
 *	@license    The MIT license
 *	@link       https://github.com/cnsaturn/codeigniter-my-session
 */

// Set session configs...
new Cache_Session_Handler;
session_start();

Class MY_Session Extends CI_Session
{
	/**
	 * Session Constructor
	 *
	 * The constructor runs the session routines automatically
	 * whenever the class is instantiated.
	 */
	public function __construct($params = array())
	{
		parent::__construct($params);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the current session data if it exists
	 *
	 * @access	public
	 * @return	bool
	 */
	public function sess_read()
	{
		// Fetch the cookie
		$session = $_SESSION;

		// Is the session data we unserialized an array with the correct format?
		if ( ! is_array($session) OR ! isset($session['session_id']) OR ! isset($session['ip_address']) OR ! isset($session['user_agent']) OR ! isset($session['last_activity']))
		{
			log_message('debug', 'A session was not found.');
			$this->sess_destroy(FALSE);
			return FALSE;
		}

		// Is the session current?
		if (($session['last_activity'] + $this->sess_expiration) < $this->now)
		{
			$this->sess_destroy(FALSE);
			return FALSE;
		}

		// Does the IP Match?
		if ($this->sess_match_ip == TRUE AND $session['ip_address'] != $this->CI->input->ip_address())
		{
			$this->sess_destroy(FALSE);
			return FALSE;
		}

		// Does the User Agent Match?
		if ($this->sess_match_useragent == TRUE AND trim($session['user_agent']) != trim(substr($this->CI->input->user_agent(), 0, 120)))
		{
			$this->sess_destroy(FALSE);
			return FALSE;
		}

		// Session is valid!
		$this->userdata = $session;
		unset($session);

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Write the session data
	 *
	 * @access	public
	 * @return	void
	 */
	public function sess_write()
	{
		// set the custom userdata, the session data we will set in a second
		$_SESSION = array();
		foreach($this->userdata as $key => $val)
		{
			$_SESSION[$key] = $val;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	public function sess_create()
	{
		if(session_id() == '')
		{
			session_start();
		}

		$_SESSION['session_id']		= session_id();
		$_SESSION['ip_address']		= $this->CI->input->ip_address();
		$_SESSION['user_agent']		= substr($this->CI->input->user_agent(), 0, 120);
		$_SESSION['last_activity']	= $this->now;

		$this->userdata = $_SESSION;
	}

	// --------------------------------------------------------------------

	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	public function sess_update()
	{
		// We only update the session every five minutes by default
		if(($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now)
		{
			return;
		}

		// Regenerate session id
		session_regenerate_id();

		// Update the session data in the session data array
		$this->userdata['session_id'] = session_id();
		$this->userdata['last_activity'] = $this->now;
	}

	// --------------------------------------------------------------------

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	public function sess_destroy($destroy = TRUE)
	{
		session_unset();
		session_regenerate_id();

		if($destroy)
		{
			session_destroy();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Does nothing for native sessions
	 *
	 * @access public
	 * @return void
	 */
	public function _sess_gc(){}
}

// Customize the PHP Session handler
// @see http://php.net/manual/en/function.session-set-save-handler.php
class Cache_Session_Handler
{
	private $_lifetime = 0;
	private $_CI;

	public function __construct()
	{
		session_name(config_item('sess_cookie_name'));

		session_set_save_handler(
			array($this, "open"),
			array($this, "close"),
			array($this, "read"),
			array($this, "write"),
			array($this, "destroy"),
			array($this, "gc")
		);

		// Ref the 'CI' super global object
		$this->_CI = & get_instance();

		if( ! $this->_CI->load->is_loaded('cache'))
		{
			// Make sure your 2.0+ CI Cache driver library is loaded
			// and set as the primary cache solution
			$this->_CI->load->driver(
				'cache',
				array('adapter' => 'memcached', 'backup' => 'file'
			));
		}
	}

	public function open()
	{
		$this->_lifetime = ini_get('session.gc_maxlifetime');
		if($this->_lifetime <= config_item('sess_expiration'))
		{
			$this->_lifetime = config_item('sess_expiration');
		}

		return TRUE;
	}

	public function read($id)
	{
		return $this->_CI->cache->get("sess_{$id}");
	}

	public function write($id, $data)
	{
		return $this->_CI->cache->replace("sess_{$id}", $data, $this->_lifetime);
	}

	public function destroy($id)
	{
		return $this->_CI->cache->delete("sess_{$id}");
	}

	public function gc()
	{
		return TRUE;
	}

	public function close()
	{
		return TRUE;
	}

	public function __destruct()
	{
		session_write_close();
	}
}