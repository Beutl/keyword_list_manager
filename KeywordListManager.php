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


		/*
		if (is_dir($execDirectory)) {
			if ($dh = opendir($execDirectory)) {
				while (($execFile = readdir($dh)) !== false) {
					$fileType = substr(strrchr($execDirectory . "/" . $execFile, "."), 1);
					if ($fileType === "txt") {
						$lines = file($execDirectory . "/" . $execFile, FILE_IGNORE_NEW_LINES);
						$file = fopen("translated_csv/" . str_replace($fileType, 'csv', $execFile),"w");
						foreach ($lines as $line) {
							try {
								echo 'Word: ' . $line;
								$ch = curl_init("https://cxl-services.appspot.com/proxy?url=https://translation.googleapis.com/language/translate/v2/detect?" . http_build_query(array('q'=>$line)));
								if ($ch === false) {
									throw new Exception('failed to initialize');
								}

								curl_setopt($ch, CURLOPT_HEADER, 0);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								$output = curl_exec($ch);
								// Check the return value of curl_exec(), too
								if ($output === false) {
									throw new Exception(curl_error($ch), curl_errno($ch));
								}

								curl_close($ch);
								$decoded = json_decode($output, true);

								$language = $decoded['data']['detections'][0][0]['language'];

								echo '	Language: ' . $language . '<br>';

								$lineToWrite = $line . ',' . $language;
								fputcsv($file,explode(',',$lineToWrite));

							} catch (Exception $e) {
								echo 'Exception: ' . $e->getMessage();
							}
						}
						fclose($file);
					}
				}
			}
			closedir($dh);
		}
		*/
	}
}    //KeywordListManager

KeywordListManager::doRemoveLines();