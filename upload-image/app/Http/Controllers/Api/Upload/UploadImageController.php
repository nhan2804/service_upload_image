<?php

namespace App\Http\Controllers\Api\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Imagick;
use PNGMetadata\PNGMetadata;
use Image;
use Illuminate\Support\Str;
use App\Http\Requests\UploadedFile;
use Validator;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $random = Str::random(100);

        return $random;
        $path = public_path() . '/image/pic9.png';
        $path2 = public_path() . '/image/wm.png';
        $img = Image::make($path)->fit(2000, 2000)->blur(1)->insert($path2);

        return $img->response('jpg');


        $im = new Imagick();
        // dd($im);
        if (!extension_loaded('imagick')) {
            echo 'Imagick not installed';
        } else {
            echo "have imagick";
        }
        phpinfo();
        $start = microtime(true);

        $png_metadata = new PNGMetadata($path);
        echo ($png_metadata);
        // return getimagesize($path);
        $fp = fopen($path, 'rb');

        if (!$fp) {
            echo 'Error: Unable to open image for reading';
            exit;
        }


        $image_name = $path;

        //read all the image attributes
        $exif = exif_read_data($image_name, 0, true);
        echo $exif === false ? "No header data found.<br />\n" : "Image contains headers\n";


        //print the name of the image
        echo "Image Name:" . $image_name . "\n\n";

        //iterate trough the image to list all the attributes
        foreach ($exif as $key => $section) {
            echo "###############   Section Name :" . $key . " #############\n </br>";
            foreach ($section as $name => $val) {
                echo "$key.$name: $val\n";
            }
            echo "\n";
        }
        // print_r(exif_read_data($fp));
        // $imagedata = file_get_contents($path);
        // // alternatively specify an URL, if PHP settings allow
        // $base64 = base64_encode($imagedata);
        // return substr($base64, 100, 100);
        // return $time_elapsed_secs = (microtime(true) - $start);
        // return
        //     date("H:i:s", $time_elapsed_secs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['file' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:65536',];
        $messages = ['file.mimes' => "Phải là ảnh có dạng png,jpg,AI,PS", 'file.image' => "Phải là ảnh", 'file.required' => "Vui lòng thêm ảnh"];

        if (!$request->hasFile("file")) {
            return response()->json(["message" => "Có lỗi xảy ra,vui lòng thử lại"], 400);
        }
        $files = $request->file;
        $watermark = public_path() . '/image/wm.png';
        $thumb =  public_path() . '/thumbnail';

        $count_file = count($files);
        $arr = array();
        $total = 0;
        $message = "";
        $i = 0;
        $has_png = false;
        $arr_type = [];

        foreach ($files as $file) {
            $type = $file->getClientOriginalExtension();
            if ($type == 'png') {
                $has_png = true;
            }
            array_push($arr_type, $type);
        }
        if ($this->array_has_dupes($arr_type)) return response()->json(["message" => "Có nhiều loại file trùng nhau"], 400);
        if (!$has_png) return response()->json(["message" => "Phải có ít nhất là file png"], 400);

        foreach ($files as $file) {
            $validator = Validator::make(array('file' => $file), $rules, $messages);
            if ($validator->passes()) {
                $random = Str::random(100);
                $random1 = Str::random(20);

                $filename = $file->getClientOriginalName();
                $path_thumb = $thumb . "/" . $random1 . $filename;
                $img = Image::make($file)->fit(800, 600)->blur(1)->insert($watermark)->save($path_thumb);

                $destinationPath = public_path() . '/upload/';
                $upload_success = $file->move($destinationPath, $random . $filename);

                if ($upload_success && $img) {
                    $total++;
                    $base64_img = base64_encode(file_get_contents($destinationPath . $random . $filename));
                    $middle = Str::length($base64_img) / 2;
                    $base64 =  substr($base64_img, $middle, 300);
                    $arr[$i] = array(
                        'raw' => $destinationPath . $random . $filename,
                        'thumbnail' => $path_thumb,
                        'status' => "SUCCESS",
                        'type' => $file->getClientOriginalExtension(),
                        'base64' => $base64
                    );
                }
            } else {
                $message = "Phải là ảnh có dạng png,jpg,AI,PS ,";
            }
            $i++;
        }

        $data = [
            "data" => $arr,
            "messaage" => $message,
            "status" => "SUCCESS",
            "total_file" => $count_file,
            'file_uploaded' => $total
        ];
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function array_has_dupes($array)
    {
        return count($array) !== count(array_unique($array));
    }
}
