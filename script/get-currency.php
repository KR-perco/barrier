<?
if($request = curl_init()) {
	curl_setopt($request, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));
	curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($request);
	$xml = new SimpleXMLElement($response);
	foreach ($xml->Valute as $val) {
		if ($val->CharCode != 'EUR') {
			continue;
		}
		$euro = (double) str_replace(',', '.', $val->Value);
		file_put_contents('/home/d/dc178435/barrier.perco.ru/public_html/db/prices.php', '<? $square3Price = \'' . number_format(905, 0, ',', ' ') . '\'; $square43Price = \'' . number_format(920, 0, ',', ' ') . '\'; $round3Price = \'' . number_format(874, 0, ',', ' ') . '\'; $round43Price = \'' . number_format(886, 0, ',', ' ') . '\'; $square3PriceRubles = \'' . number_format(round(905 * $euro), 0, ',', ' ') . '\'; $square43PriceRubles = \'' . number_format(round(920 * $euro), 0, ',', ' ') . '\'; $round3PriceRubles = \'' . number_format(round(874 * $euro), 0, ',', ' ') . '\'; $round43PriceRubles = \'' . number_format(round(886 * $euro), 0, ',', ' ') . '\';');
	}
}