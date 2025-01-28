<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;

class MyController extends Controller
{
    protected $Picture;

    public function __construct()
    {
        $this->Picture = new Picture;
    }

    public function picture()
    {
        $data = $this->Picture->getImage();
        if (!empty($data)) {
            $imageCsv['data'] = explode(',', $data->images);
        } else {
            $imageCsv['data'] = [];
        }
        return view('picture', $imageCsv);
    }

    public function send_picture(Request $request)
    {
        $validatedData = $request->validate([
            'image1' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'image2' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
            'image3' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        

        $data = [
            'image1' => $request->image1 != '' ? $request->image1->getClientOriginalName() : 'null',
            'image2' => $request->image2 != '' ? $request->image2->getClientOriginalName() : 'null',
            'image3' => $request->image3 != '' ? $request->image3->getClientOriginalName() : 'null',
        ];
        $imageCsv = implode(',', $data);

        $allimages = [
            'images' => $imageCsv,
        ];

        $result = $this->Picture->storeImage($allimages);

        if ($result) {
            $imagedata = [
                $request->file('image1'),
                $request->file('image2'),
                $request->file('image3'),
            ];

            foreach ($imagedata as $image) {
                if ($image != null) {
                    $filename = $image->getClientOriginalName();
                    $image->move(public_path('images'), $filename);
                }
            }

            session()->flash('success', 'Images Successfull uploads!');
            $response = [
                'status' => true,
                'message' => 'Files uploaded successfully!',
            ];
        } else {
            session()->flash('error', 'Something was wrong!');
            $response = [
                'status' => false,
                'message' => 'Files not uploaded!',
            ];
        }

        return response()->json($response, 200);
    }
}
