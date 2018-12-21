<?php
if(!function_exists('btn'))
{
	function btn($url, $class = null, $type = null, $attr = null)
	{
		switch ($type) {
			case 'view':
				$btn = '<a class="'.$class.'" href="'.$url.'" '.$attr.'> <i class="ace-icon fa fa-search-plus bigger-130"></i> </a>';
				break;

			case 'edit':
				$btn = '<a class="'.$class.'" href="'.$url.'" '.$attr.'> <i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </a>';
				break;

			default:
				$btn = '<a class="btn_delete '.$class.'" href="'.$url.'" '.$attr.'> <i class="ace-icon fa fa-trash-o bigger-130"></i> </a>';
				break;
		}
        return $btn;
	}
}

if(!function_exists('dropdownOption'))
{
	function dropdownOption($table, $id, $title, $where = null, $orderby = null, $add_other = null)
	{
		$sql = "select ".$id." as id, ".$title." as title from ".$table." where 1 = 1 and deleted_at is null ";
		$where = ($where)?' and '.$where:'';
		$sql .= $where;
		$orderby = ($orderby)?' order by '.$orderby:'  order by '.$id.' asc';
		$sql .= $orderby;

		$option = \DB::select($sql);
		$rs = array();
		foreach ($option as $key => $value) {
			$rs[$value->id] = $value->title;
		}
		if ($add_other) {
			$rs['other'] = 'อื่นๆ';
		}
		return $rs;
	}
}

if(!function_exists('autoNumber')) {
	function AutoNumber($obj)
	{
		if(is_object($obj) && method_exists($obj, 'currentPage')) {
			static $i;
			return (($obj->currentPage()-1)*$obj->perPage())+(++$i);
		}
	}
}
