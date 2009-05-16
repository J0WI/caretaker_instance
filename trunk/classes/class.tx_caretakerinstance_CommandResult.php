<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Christopher Hlubek (hlubek@networkteam.com)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * The Command Result encapsulates the result of a Command execution.
 * 
 * @author Christopher Hlubek <hlubek@networkteam.com>
 * @package		TYPO3
 * @subpackage	tx_caretakerinstance
 */
class tx_caretakerinstance_CommandResult {
	
	/**
	 * @var boolean Status of the Command execution
	 */
	protected $status;
	
	/**
	 * @var array of tx_caretakerinstance_OperationResult
	 */
	protected $operationResults;
	
	/**
	 * @var string The message of the command execution
	 */
	protected $message;
	
	/**
	 * Create a new Command Result object
	 *
	 * @param boolean $status TRUE iff exection was successful
	 * @param array of tx_caretakerinstance_OperationResult $operationResults The results of the executed operations
	 * @param string $message An optional message for errors
	 */
	public function __construct($status, $operationResults = array(), $message = '') {
		$this->status = $status;
		$this->operationResults = $operationResults;
		$this->message = $message;
	}
	
	/**
	 * @return TRUE iff the execution of the whole command was successful
	 */
	public function isSuccessful() {
		return $this->status === TRUE;
	}
	
	/**
	 * @return array of tx_caretakerinstance_OperationResult The results of the operations
	 */
	public function getOperationResults() {
		return $this->operationResults;
	}

	/**
	 * @return string An optional error message
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 * @return string JSON represantion of the Command Result
	 */
	public function toJson() {
		$results = array();
		foreach ($this->operationResults as $result) {
			$results[] = $result->toArray();
		}
		
		$array = array(
			'status' => $this->status,
			'results' => $results,
			'message' => $this->message
		);
		
		return json_encode($array);
	}
}
?>