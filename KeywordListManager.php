<?php

set_time_limit(1000);
ob_implicit_flush(true);
ob_end_flush();

/**
 * Created by PhpStorm.
 * User: enteng
 * Date: 10/13/2018
 * Time: 7:14 PM
 */
class KeywordListManager
{
	public static function getFileContents($directory, $fileName, $fileTypes = array("txt"))
	{
		$contents = "";
		if (is_dir($directory)) {
			if ($dh = opendir($directory)) {
				while (($file = readdir($dh)) !== false) {
					$fileType = substr(strrchr($directory . "/" . $fileName, "."), 1);
					if (in_array($fileType, $fileTypes)) {
						$contents = file($directory . "/" . $fileName, FILE_IGNORE_NEW_LINES);
					}
				}
			}
			closedir($dh);
		}

		return $contents;
	}

	public static function doRemoveLines()
	{
		$execDirectory = 'text_files';
		$wordsToRemoveFileName = 'to_remove.txt';
		$wordsToRemove = self::getFileContents($execDirectory, $wordsToRemoveFileName);

		$wordsToRemoveFromFilename = 'remove_from.txt';
		$wordsToRemoveFrom = self::getFileContents($execDirectory, $wordsToRemoveFromFilename);
		$convertedFile = fopen("converted_text_files/" . 'converted_' . $wordsToRemoveFromFilename, "w");
		foreach ($wordsToRemoveFrom as $wordsToRemoveFromItem) {
			$toRemove = explode(' ', trim($wordsToRemoveFromItem));
			if (count($toRemove) > 0 && in_array($toRemove[0], $wordsToRemove)) {
				continue;
			}

			fwrite($convertedFile, $wordsToRemoveFromItem);
		}
		fclose($convertedFile);
	}

	public static function doRemoveLines_v2($toRemoveItems, $wordsToRemoveFrom)
	{
		$newString = "";
		foreach ($wordsToRemoveFrom as $wordsToRemoveFromItem) {
			$toRemove = explode(' ', trim($wordsToRemoveFromItem));
			if (count($toRemove) > 0 && in_array($toRemove[0], $toRemoveItems)) {
				continue;
			}
			$newString .= $wordsToRemoveFromItem . "\n";
		}

		return $newString;
	}

	public static function doRemoveLine($toRemoveItems, $wordsToRemoveFrom)
	{
		$newString = "";
		foreach ($wordsToRemoveFrom as $wordsToRemoveFromItem) {
			$toRemove = explode(' ', trim($wordsToRemoveFromItem));
			if (count($toRemove) > 0 && in_array($toRemove[0], $toRemoveItems)) {
				continue;
			}

			if (strpos($toRemoveItems, $wordsToRemoveFromItem)) {
				continue;
			}
			$newString .= $wordsToRemoveFromItem . "\n";
		}

		return $newString;
	}

	public static function doPhraseCheck($toRemovePhrase, $wordsToRemoveFromPhrase, $chkOne = false, $chkTwo = false, $chkThree = false)
	{
		$newString = "";
		foreach ($wordsToRemoveFromPhrase as $wordsToRemoveFromPhraseItem) {
			/*
			if (in_array($wordsToRemoveFromPhraseItem, $toRemovePhrase)) {
				continue;
			}
			*/

			//will remove starting words that match
			//aaa
			//aaa bbb
			//will remove aaa bbb
			$found = false;
			foreach ($toRemovePhrase as $toRemovePhraseItem) {
				if ($chkOne === 'true' ||
					$chkTwo === 'true' ||
					$chkThree === 'true') {
					if ($chkOne === 'true') {
						//check whole line
						//echo 'check 1!'  . '<br>';
						//echo '$wordsToRemoveFromPhraseItem: ' . $wordsToRemoveFromPhraseItem . '<br>';
						//echo '$toRemovePhraseItem: ' . $toRemovePhraseItem . '<br>';
						if (strcmp($wordsToRemoveFromPhraseItem, $toRemovePhraseItem) == 0) {
							//echo 'found!'  . '<br>';
							$found = true;
							break;
						}
					}

					if ($chkTwo === 'true') {
						//echo 'check 2!'  . '<br>';
						//echo '$wordsToRemoveFromPhraseItem: ' . $wordsToRemoveFromPhraseItem . '<br>';
						//echo '$toRemovePhraseItem: ' . $toRemovePhraseItem . '<br>';
						if (strpos($wordsToRemoveFromPhraseItem, $toRemovePhraseItem) !== false) {
							//echo 'found! '  . strpos($wordsToRemoveFromPhraseItem, $toRemovePhraseItem) . '<br>';
							$found = true;
							break;
						}
					}

					if ($chkThree === 'true') {
						//echo 'check 3!'  . '<br>';
						//echo '$wordsToRemoveFromPhraseItem: ' . $wordsToRemoveFromPhraseItem . '<br>';
						//echo '$toRemovePhraseItem: ' . $toRemovePhraseItem . '<br>';
						if (strpos($wordsToRemoveFromPhraseItem, $toRemovePhraseItem) !== false) {
							//echo 'found! '  . strpos($wordsToRemoveFromPhraseItem, $toRemovePhraseItem) . '<br>';
							$found = true;
							break;
						}
					}
				} else {
					$toRemovePhraseItem = '/\b'.$toRemovePhraseItem.'\b/';
					preg_match(strtolower($toRemovePhraseItem), strtolower($wordsToRemoveFromPhraseItem), $match, PREG_OFFSET_CAPTURE);
					if (isset($match[0])) {
						$found = true;
						break;
					}
				}
			}
			if (!$found) {
				if (!empty($wordsToRemoveFromPhraseItem)) {
					$newString .= $wordsToRemoveFromPhraseItem . "\n";
				}
			}
		}

		return $newString;
	}    //doPhraseCheck

}    //KeywordListManager

//KeywordListManager::doRemoveLines();

if (isset($_POST['toRemove'])) {
	$toRemoveItems = $_POST['toRemove'];
	$toRemoveItems = str_replace("\n", '<br />', $toRemoveItems);
	$toRemoveItemsArr = explode('<br />', $toRemoveItems);

	$removeFromItems = $_POST['removeFrom'];
	$removeFromItems = str_replace("\n", '<br />', $removeFromItems);
	$removeFromItemsArr = explode('<br />', $removeFromItems);
	echo json_encode(KeywordListManager::doPhraseCheck($toRemoveItemsArr, $removeFromItemsArr, $_POST['chkOne'], $_POST['chkTwo'], $_POST['chkThree']));
}