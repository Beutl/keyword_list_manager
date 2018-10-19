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
}    //KeywordListManager

//KeywordListManager::doRemoveLines();

if (isset($_POST['toRemove'])) {
	$toRemoveItems = $_POST['toRemove'];
	$toRemoveItems = str_replace("\n", '<br />', $toRemoveItems);
	$toRemoveItemsArr = explode('<br />', $toRemoveItems);
	//var_dump($toRemoveItemsArr);

	$removeFromItems = $_POST['removeFrom'];
	$removeFromItems = str_replace("\n", '<br />', $removeFromItems);
	$removeFromItemsArr = explode('<br />', $removeFromItems);
	//var_dump($removeFromItemsArr);
	/*
	$removeFrom = $_POST['removeFrom'];
	$removeFrom = str_replace("\n", '<br />', $toRemoveItems);
	echo json_encode(KeywordListManager::doRemoveLines_v2($toRemoveItemsArr, $toRemoveFromArray));
	*/
	echo json_encode(KeywordListManager::doRemoveLines_v2($toRemoveItemsArr, $removeFromItemsArr));
}