<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Picture extends Model
{
    public function storeImage($data)
    {
        try {
            $exist = DB::table('pictures')
                ->select('images')
                ->first();
            if (!empty($exist)) {
                $imageCsv = explode(',', $exist->images);
                $newdata = explode(',', $data['images']);
                $maxCount = max(count($imageCsv), count($newdata));
                $updatedImages = [];
                for ($i = 0; $i < $maxCount; $i++) {
                    $existingImage = isset($imageCsv[$i]) ? $imageCsv[$i] : 'null';
                    $newImage = isset($newdata[$i]) ? $newdata[$i] : 'null';
                    if ($existingImage == 'null' && $newImage == 'null') {
                        $updatedImages[] = 'null';
                    } elseif ($existingImage == 'null' && $newImage != 'null') {
                        $updatedImages[] = $newImage;
                    } elseif ($existingImage != 'null' && $newImage == 'null') {
                        $updatedImages[] = $existingImage;
                    } else {
                        $updatedImages[] = $newImage;
                    }
                }
                $data['images'] = implode(',', $updatedImages);
            }
            $result = DB::table('pictures')
                ->where('id', '=', 1)
                ->update(['images' => $data['images']]);
            return $result;
        } catch (QueryException $e) {
            $this->handleException($e, 'Database error occured');
        } catch (Exception $e) {
            $this->handleException($e, 'An unexpected error occured');
        }
    }

    public function getImage()
    {
        try {
            $data = DB::table('pictures')
                ->select('images')
                ->first();
            return $data;
        } catch (QueryException $e) {
            $this->handleException($e, 'Database error occured');
        } catch (Exception $e) {
            $this->handleException($e, 'An unexpected error occured');
        }
    }

    protected function handleException(Exception $e, $reasone)
    {
        $response = [
            'status' => false,
            'reasone' => $reasone,
            'message' => $e->getMessage(),
        ];

        echo response()->json($response, 200)->getContent();
        die;
    }
}
