<?php
if (!function_exists('clean_url')) {
	function clean_url($text)
	{
		setlocale(LC_ALL, "Thai");
		$text = strtolower($text);
		$code_entities_match = array(' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
		$code_entities_replace = array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		$text = @ereg_replace('(--)+', '', $text);
		$text = @ereg_replace('(-)$', '', $text);
		return $text;
	}
}

if (!function_exists('generateUniqueSlug')) {
	function generateUniqueSlug($title)
	{
		//and here you put all your logic that solve the problem
		$temp = clean_url($title, '-');
		if (!App\Models\Page::all()->where('slug', $temp)->isEmpty()) {
			$i = 1;
			$newslug = $temp . '-' . $i;
			while (!App\Models\Page::all()->where('slug', $newslug)->isEmpty()) {
				$i++;
				$newslug = $temp . '-' . $i;
			}
			$temp = $newslug;
		}
		return $temp;
	}
}

if (!function_exists('getUrlFromText')) {
	function getUrlFromText($text)
	{
		// $text = 'width: 122px; height: 140px; background-image:url(https://stickershop.line-scdn.net/stickershop/v1/sticker/2428/android/sticker.png;compress=true); background-size: 122px 140px;';
		preg_match('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $matches);
		// print_r($matches);
		return $matches[0];
	}
}

if (!function_exists('deleteDuplicate')) {
	function deleteDuplicate()
	{
		DB::unprepared('delete n1 
        from
            stickers n1,
            stickers n2 
        where
            n1.id > n2.id 
            and n1.sticker_code = n2.sticker_code');
	}
}

if(!function_exists('convert_line_coin_2_money'))
{
	function convert_line_coin_2_money($coin)
	{
		$bath = array('250'=>'150','200'=>'120','150'=>'90','100'=>'60','50'=>'30','2'=>'1');
		return @$bath[$coin];
	}
}

if(!function_exists('th_2_coin'))
{
	function th_2_coin($bath){
		$coin = array('1'=>'2','30'=>'50','60'=>'100','90'=>'150','120'=>'200','150'=>'250');
		return $coin[$bath];
	}
}
