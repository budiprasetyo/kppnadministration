<?php
/*
 * m_base.php
 * 
 * Copyright 2012 metamorph <metamorph@Cyber-Station>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */



class M_base
{

	/**
	 * Constructor of class M_base.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	// function for checking data existence
	public function dataCheck($field_name,$table_name)
	{
		$queryCek	= mysql_query("SELECT $field_name FROM $table_name LIMIT 1");
		$resultCek	= mysql_num_rows($queryCek);
		return $resultCek;
	}
	
}
