<?php
/**
 * Created by PhpStorm.
 * User: Vincent Sy
 * Date: 10/25/2018
 * Time: 12:06 AM
 */

$handler = new Handler($_POST['rules'], $_POST['inputText']);
echo json_encode($handler->doAction());

class Handler
{
	private $_RULES;

	private $_INPUT_TEXT;

	private $_OUTPUT_TEXT;

	public function __construct($rules = array(), $inputText = "")
	{
		$this->_RULES = $rules;
		$this->_INPUT_TEXT = (string) $inputText;
		$this->_OUTPUT_TEXT = (string) $inputText;
	}    //__construct

	public function doAction()
	{
		$this->doRemoveDuplicateLines();

		$this->doTextCaseActions();

		$this->doSpaceActions();

		$this->doLineBreakActions();

		$this->doSortActions();

		$this->doShowLines();

		$this->doRemoveLines();

		return $this->_OUTPUT_TEXT;
	}    //doAction


	/**
	 * Will do update of string to uppercase or lowercase, will update words to start uppercase
	 */
	private function doTextCaseActions()
	{
		switch ($this->_RULES['textCase']) {
			default:
				break;    //do nothing
			case 0;
				break;    //do nothing
			case 1:
				$tempOutputText = $this->getOutputText();
				$this->setOutputText(strtolower($tempOutputText));
				break;
			case 2:
				$tempOutputText = $this->getOutputText();
				$this->setOutputText(strtoupper($tempOutputText));
				break;
			case 3:
				$tempOutputText = $this->getOutputText();
				$this->setOutputText(ucwords($tempOutputText));
				break;
		}
	}    //doTextCaseActions

	/**
	 * Will do removal of space/whitespaces
	 */
	private function doSpaceActions()
	{
		switch ($this->_RULES['space']) {
			default:
				break;    //do nothing
			case 0;
				break;    //do nothing
			case 1:
				$tempOutputText = $this->getOutputText();
				//$this->setOutputText(trim(preg_replace('/\s+/', '', $tempOutputText)));	//removes all whitespaces including linebreaks
				$this->setOutputText(str_replace(' ', '', $tempOutputText));
				break;
		}
	}    //doSpaceActions

	/**
	 * Will do removal of linebreaks
	 */
	private function doLineBreakActions()
	{
		switch ($this->_RULES['lineBreak']) {
			default:
				break;    //do nothing
			case 0;
				break;    //do nothing
			case 1:
				$tempOutputText = $this->getOutputText();
				$this->setOutputText(trim(preg_replace('/\r|\n/', '', $tempOutputText)));
				break;
		}
	}    //doSpaceActions

	/**
	 * Will do sorting of texts
	 */
	private function doSortActions()
	{
		switch ($this->_RULES['sort']) {
			default:
				break;    //do nothing
			case 0;
				break;    //do nothing
			case 1:
				$tempOutputText = $this->getOutputText();
				$tempArr = explode("\n", $tempOutputText);
				sort($tempArr);
				$tempOutputText = implode("\n", $tempArr);
				$this->setOutputText($tempOutputText);
				break;
			case 2:
				$tempOutputText = $this->getOutputText();
				$tempArr = explode("\n", $tempOutputText);
				rsort($tempArr);
				$tempOutputText = implode("\n", $tempArr);
				$this->setOutputText($tempOutputText);
				break;
		}
	}    //doSortActions

	/**
	 * Will do removing of duplicates
	 */
	private function doRemoveDuplicateLines()
	{
		if ('true' === $this->_RULES['removeDuplicateLines']) {
			$tempOutputText = $this->getOutputText();
			$tempArr = explode("\n", $tempOutputText);
			$newArr = array();
			foreach ($tempArr as $item) {
				if (!in_array($item, $newArr)) {
					$newArr[] = $item;
				}
			}
			$tempOutputText = implode("\n", $newArr);
			$this->setOutputText($tempOutputText);
		}
	}    //doRemoveDuplicateLines

	/**
	 * Will display lines matching criteria for word/character count
	 */
	private function doShowLines()
	{
		if (is_numeric($this->_RULES['show']['wordCount'])) {
			$tempOutputText = $this->getOutputText();
			$tempArr = explode("\n", $tempOutputText);
			$newArr = array();
			foreach ($tempArr as $item) {
				//check word count
				if (count(preg_split('/\s+/', $item)) == $this->_RULES['show']['wordCount'] && !in_array($item, $newArr)) {
					$newArr[] = $item;
				}
			}
			$tempOutputText = implode("\n", $newArr);
			$this->setOutputText($tempOutputText);
		}

		if (is_numeric($this->_RULES['show']['characterCount'])) {
			$tempOutputText = $this->getOutputText();
			$tempArr = explode("\n", $tempOutputText);
			$newArr = array();
			foreach ($tempArr as $item) {
				//check character count
				if (strlen((string) $item) == $this->_RULES['show']['characterCount'] && !in_array($item, $newArr)) {
					$newArr[] = $item;
				}
			}
			$tempOutputText = implode("\n", $newArr);
			$this->setOutputText($tempOutputText);
		}
	}    //doShowLines

	/**
	 * Will remove lines matching criteria for word/character count
	 */
	private function doRemoveLines()
	{
		if (is_numeric($this->_RULES['remove']['wordCount'])) {
			$tempOutputText = $this->getOutputText();
			$tempArr = explode("\n", $tempOutputText);
			$newArr = array();
			foreach ($tempArr as $item) {
				//check word count
				if (count(preg_split('/\s+/', $item)) == $this->_RULES['remove']['wordCount']) {
					continue;
				}
				if (!in_array($item, $newArr)) {
					$newArr[] = $item;
				}
			}
			$tempOutputText = implode("\n", $newArr);
			$this->setOutputText($tempOutputText);
		}

		if (is_numeric($this->_RULES['remove']['characterCount'])) {
			$tempOutputText = $this->getOutputText();
			$tempArr = explode("\n", $tempOutputText);
			$newArr = array();
			foreach ($tempArr as $item) {
				//check character count
				if (strlen((string) $item) == $this->_RULES['remove']['characterCount']) {
					continue;
				}
				if (!in_array($item, $newArr)) {
					$newArr[] = $item;
				}
			}
			$tempOutputText = implode("\n", $newArr);
			$this->setOutputText($tempOutputText);
		}
	}    //doRemoveLines

	private function setOutputText($outputText)
	{
		$this->_OUTPUT_TEXT = (string) $outputText;
	}    //setOutputText

	private function getOutputText()
	{
		return $this->_OUTPUT_TEXT;
	}    //getOutputText

}    //Handler