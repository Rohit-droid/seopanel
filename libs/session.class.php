<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	   *
 *   sendtogeo@gmail.com   												   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.,                                       *
 *   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 ***************************************************************************/

# class defines all session functions
class Session extends Seopanel{

	# starts session
	public static function startSession(){
		ini_set("session.gc_probability", 100);
		ini_set("session.gc_divisor", 100);
		ini_set("session.gc_maxlifetime", SP_TIMEOUT);
		session_start();
	}
	
	# to set session
	public static function setSession($varName, $varValue){
		$_SESSION[$varName] = $varValue;
	}

	# function read session
	public static function readSession($varName) {
		return $_SESSION[$varName];
	}

	# fucntion to destroy session
	public static function destroySession() {	    
		@Session::setSession('userInfo', "");
		@Session::setSession('lang_code', "");
		@Session::setSession('text', "");
        session_destroy();	    
	}
}
?>