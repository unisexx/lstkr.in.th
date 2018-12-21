<?php

if(!function_exists('logs')) {
    function logs($menu, $description) {
        if(Auth::check()) {
            $user = Auth::user();
            $data = [
                'ip' => request()->ip(),
                'user_id' => "$user->id",
                'name' => $user->name,
                'menu' => $menu,
                'description' => $description,
                // 'created_at' => Carbon::now('Asia/Bangkok')
            ];
            return App\Models\Logs::create($data);
        }
    }
}

if(!function_exists('chkChangeLogs')) {
    function chkChangeLogs($db_data, $new_data)
    {
        $data = '';
        $new_data_key = '';
        $new_data_value = '';
        $table_comment = $db_data->table_comment();
        foreach ($table_comment as $key => $comment) {

            $db_data_value = @$db_data->{$key};

            if (is_array($new_data)) {
                $new_data_key = @$new_data[$key];
                $new_data_value = @$new_data[$key];
            } else if (is_object($new_data)) {
                $new_data_key = @$new_data->{$key};
                $new_data_value = @$new_data->{$key};
            }

            $chk_comment = explode('#', $comment);
            $comment_text = @$chk_comment[0];
            if (count($chk_comment) > 1) {
                if (@$chk_comment[1] == 'date' && $db_data_value && $db_data_value != '0000-00-00 00:00:00' && $db_data_value != '0000-00-00') {
                    $db_data_value = date('Y-m-d', strtotime($db_data_value));
                }
            } // if (count($chk_comment) > 1)

            if ($new_data_key && $db_data_value !=  $new_data_value) {

                $db_data_value = (empty($db_data_value))? 'NULL' : $db_data_value;

                $comment_chk_format = explode('-', @$chk_comment[1]);
                if (@$comment_chk_format[0] == 'number_format') {
                    $comment_chk_format[1] = (!empty($comment_chk_format[1])) ? $comment_chk_format[1]*1 : '';
                    if (is_int(@$comment_chk_format[1])) {
                        $db_data_value = number_format($db_data_value, $comment_chk_format[1]);
                        $new_data_value = number_format($new_data_value, $comment_chk_format[1]);
                    } else {
                        $db_data_value = number_format($db_data_value);
                        $new_data_value = number_format($new_data_value);
                    }
                } else if (count($comment_chk_format) > 1) {
                    $table = @$comment_chk_format[0];
                    $table_value = @$comment_chk_format[1];
                    $commnet_chk_other_whrer = explode('/', $comment_chk_format[2]);
                    $table_where = @$commnet_chk_other_whrer[0];

                    if (!empty($db_data_value) && $db_data_value != "NULL") {
                        $data_old = \DB::table($table)->select($table_value.' as chk_value')
                                    ->where(function($qry) use($commnet_chk_other_whrer) {
                                        foreach ($commnet_chk_other_whrer as $key => $value) {
                                            if ($key > 0) {
                                                $chk_value = explode(':', $value);
                                                (!empty($chk_value[0]) && !empty($chk_value[1]))?$qry->where($chk_value[0], $chk_value[1]):null;
                                            }
                                        }
                                    })
                                    ->where($table_where, $db_data_value)->first();
                        $db_data_value = @$data_old->chk_value;
                    } else {
                        $db_data_value = '-';
                    }

                    if (!empty($new_data_value) && $new_data_value != "NULL") {
                        $data_new = \DB::table($table)->select($table_value.' as chk_value')
                                    ->where(function($qry) use($commnet_chk_other_whrer) {
                                        foreach ($commnet_chk_other_whrer as $key => $value) {
                                            if ($key > 0) {
                                                $chk_value = explode(':', $value);
                                                (!empty($chk_value[0]) && !empty($chk_value[1]))?$qry->where($chk_value[0], $chk_value[1]):null;
                                            }
                                        }
                                    })
                                    ->where($table_where, $new_data_value)->first();
                        $new_data_value = @$data_new->chk_value;
                    } else {
                        $new_data_value = '-';
                    }

                }

                $data .= $comment_text.' เปลี่ยนข้อมูลจาก : '.$db_data_value.' [เป็น] '.$new_data_value.' <br />';
            }
        }
        return $data;
    }
}

if(!function_exists('logDetail')) {
    function logDetail($obj, $req, $id = null)
    {
        $text = null;
        foreach($obj->getLogLabels() as $key => $item) {
            $extra = null;
            $param = [];
            @list($name, $extra) = explode('#', $item);
            if($extra) $param = explode('-', $extra);
            if(!empty($param)) {
                if($id) $oldValue = logValue($param, $req, $key, $obj->{$key});
                $newValue = logValue($param, $req, $key);
            }else{
                if($id) $oldValue = $obj->{$key};
                $newValue = $req->input($key);
            }
            if($id) {
                if($req->input($key) && $oldValue != $newValue) $text .= "\r\n$name : $oldValue [เป็น] $newValue";
            }else{
                if($req->input($key)) $text .= "\r\n$name : ".$newValue;
            }
        }
        return $text;
    }
}

if(!function_exists('logValue')) {
    function logValue($param, $req, $key, $oldVal = null)
    {
        $val = $oldVal ?: $req->input($key);
        switch($param[0]) {
            case 'select' : $result = \DB::table($param[1])->where('id', $val)->first()->{$param[2]}; break;
            case 'checkbox' : $result = empty($val) ? $param[2] : $param[1]; break;
            case 'number' : if(is_numeric($val)){ $dot = empty($param[1]) ? 0 : $param[1]; $result = number_format($val, $dot); }else{ $result = $val; } break;
            case 'date' : $result = DBToDate($val); break;
        }
        return $result;
    }
}

if(!function_exists('logPerm')) {
    function logPerm($req, $id = null)
    {
        $reqPerms = $req;
        $userPerms = $id ? \App\Role::find($id)->perms()->lists('id')->all() : [];
        $diffId = array_merge(array_diff($userPerms, $reqPerms),array_diff($reqPerms, $userPerms));
        $permNames = \App\Models\Perm::whereHas('permissions', function($q) use($diffId) {
            $q->whereIn('id', $diffId);
        })->lists('name', 'id')->all();

        $text = "\r\n-- สิทธิ์การใช้งาน --";
        foreach(\App\Permission::whereIn('id', $diffId)->orderBy('id')->get() as $p) {
            $condition = (in_array($p->id, $userPerms)) ? "ลดสิทธิ์" : "เพิ่มสิทธิ์";
            $text .= "\r\n".$permNames[$p->perm_id]." $condition : $p->display_name";
        }
        return $diffId ? $text : null;
    }
}

if(!function_exists('chkChangeLogs2')) {
    function chkChangeLogs2($title = null, $db_data, $new_data, $id = null)
    {
        if(empty($id)) { // add
            $log = null;
            foreach($db_data->table_comment() as $f => $i) {
                if(!empty($new_data->{$f})) {
                    if(strpos($i, '#')) { # มีการอ้างอิงจากตารางอื่น
                        $i = explode('#', $i); #table_comment.
                        $field['title'] = $i[0];
                        if($i[1] == 'number_format') { #number_format
                            $field['value'] = number_format($new_data->{$f});
                        } else if($i[1] == 'date') {
                            $field['value'] = Carbon\Carbon::createFromFormat('Y-m-d',$new_data->{$f})->addYear(543)->format('d/m/Y');
                        } else {
                            $iExp = explode('-', $i[1]); #field attribute
                           if(strpos($iExp[2], '/')) { # เป็นข้อมูล option ที่ถูกดึงมาจากตารางอื่น
                                $cond = explode('/', $iExp[2]);
                                $cond = explode(':',end($cond));
                                echo $iExp[0].'/'.$iExp[1].'/'.$cond[0].'/'.$cond[1];
                                dd();
                                $field['value'] = DB::table($iExp[0])->select($iExp[1].' as title')->where($cond[0], '=', $cond[1])->first()->title;
                            } else {
                                $field['value'] = DB::table($iExp[0])->select($iExp[1].' as title')->where($iExp[2], '=', $new_data->{$f})->first()->title;
                            }
                        }
                    } else {
                        $field['title'] = $i;
                        $field['value'] = $new_data->{$f};
                    }
                    $log .= 'เพิ่มข้อมูล '.$field['title'].' : '.$field['value'].'<br>';
                }
            }
            logs($title, 'เพิ่ม'.$title.' <br>'.$log);
        } else { // updtae
            $log = chkChangeLogs($db_data::find($id), $new_data);
            if(!empty($log))
                logs($title, 'แก้ไข'.$title.' <br>'.$log);
        }
    }
}
