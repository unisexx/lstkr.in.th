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
        $sessionID = Session::getId();

		if($_GET['productType'] == 'sticker'){

            // หาแถวใน sticker_view เพื่อหาว่า session_id นี้มีแล้วหรือยัง
            $stickerView = new StickerView;
            $stickerView = $stickerView
                            ->select('id')
							->where('sticker_id',$_GET['productID'])
                            ->where('session_id',$sessionID)
                            ->where('type','sticker')
                            ->first();
            
            // ถ้าไม่มีแถวนี้มาก่อนเลย ให้ insert เพิ่มเข้าไปอีก 1 แถวปัจจุบัน
            if (empty($stickerView->id))
            {
                DB::table('sticker_views')->insert(
                    [
                        'sticker_id' => $_GET['productID'], 
                        'session_id' => $sessionID,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'type' => 'sticker',
                        'created' => date("Y-m-d H:i:s"),
                    ]
                );
            }

            // upated threedays ในเทเบิ้ล stickers
            DB::statement("UPDATE stickers SET threedays = (SELECT COUNT(id) total FROM sticker_views WHERE sticker_id =" . $_GET['productID'] . " AND created > NOW() - interval 3 DAY) where sticker_code = " . $_GET['productID']);

		} elseif ($_GET['productType'] == 'theme') {

            // หาแถวใน sticker_view เพื่อหาว่า session_id นี้มีแล้วหรือยัง
            $stickerView = new StickerView;
            $stickerView = $stickerView
                            ->select('id')
							->where('sticker_id',$_GET['productID'])
                            ->where('session_id',$sessionID)
                            ->where('type','theme')
                            ->first();
            
            // ถ้าไม่มีแถวนี้มาก่อนเลย ให้ insert เพิ่มเข้าไปอีก 1 แถวปัจจุบัน
            if (empty($stickerView->id))
            {
                DB::table('sticker_views')->insert(
                    [
                        'sticker_id' => $_GET['productID'], 
                        'session_id' => $sessionID,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'type' => 'theme',
                        'created' => date("Y-m-d H:i:s"),
                    ]
                );
            }

            // upated threedays ในเทเบิ้ล stickers
            DB::statement("UPDATE themes SET threedays = (SELECT COUNT(id) total FROM sticker_views WHERE sticker_id =" . $_GET['productID'] . " AND created > NOW() - interval 3 DAY) where id = " . $_GET['productID']);

        } elseif ($_GET['productType'] == 'emoji') {

            // หาแถวใน sticker_view เพื่อหาว่า session_id นี้มีแล้วหรือยัง
            $stickerView = new StickerView;
            $stickerView = $stickerView
                            ->select('id')
							->where('product_code',$_GET['productID'])
                            ->where('session_id',$sessionID)
                            ->where('type','emoji')
                            ->first();
            
            // ถ้าไม่มีแถวนี้มาก่อนเลย ให้ insert เพิ่มเข้าไปอีก 1 แถวปัจจุบัน
            if (empty($stickerView->id))
            {
                DB::table('sticker_views')->insert(
                    [
                        'product_code' => $_GET['productID'], 
                        'session_id' => $sessionID,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'type' => 'emoji',
                        'created' => date("Y-m-d H:i:s"),
                    ]
                );
            }

            // upated threedays ในเทเบิ้ล stickers
            DB::statement("UPDATE emojis SET threedays = (SELECT COUNT(id) total FROM sticker_views WHERE product_code = '" . $_GET['productID'] . "' AND created > NOW() - interval 3 DAY) where emoji_code = '" . $_GET['productID']. "'");

        }
	}
}
