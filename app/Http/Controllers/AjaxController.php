<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use App\Models\StickerView;

use DB;
use Session;

class AjaxController extends Controller
{
    public function getUpdateviewcount()
	{

        if(is_numeric($_GET['productID'])){

            $sessionID = Session::getId();

            // หาแถวใน sticker_view เพื่อหาว่า session_id นี้มีแล้วหรือยัง
            $stickerView = new StickerView;
            $stickerView = $stickerView
                            ->select('id')
                            ->where('sticker_id',$_GET['productID'])
                            ->where('session_id',$sessionID)
                            ->where('type',$_GET['productType'])
                            ->first();
            
            // ถ้าไม่มีแถวนี้มาก่อนเลย ให้ insert เพิ่มเข้าไปอีก 1 แถวปัจจุบัน
            if (empty($stickerView->id))
            {
                DB::table('sticker_views')->insert(
                    [
                        'sticker_id' => $_GET['productID'], 
                        'session_id' => $sessionID,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'type' => $_GET['productType'],
                        'created' => date("Y-m-d H:i:s"),
                    ]
                );
            }

            if($_GET['productType'] == 'sticker'){
                $column = 'sticker_code';
            }elseif($_GET['productType'] == 'theme'){
                $column = 'id';
            }elseif($_GET['productType'] == 'emoji'){
                $column = 'id';
            }

            // upated threedays ในเทเบิ้ล stickers
            DB::statement("UPDATE ".$_GET['productType']."s SET updated_at = '".date("Y-m-d H:i:s")."', threedays = (SELECT COUNT(id) total FROM sticker_views WHERE sticker_id =" . $_GET['productID'] . " AND created > NOW() - interval 3 DAY) where ".$column." = " . $_GET['productID']);

        }

	}
}
