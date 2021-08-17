<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\ImageHelper;
use App\Helpers\SearchImage;
use App\Http\Controllers\Controller;
use App\ImageChild;
use App\ImageUsageName;
use App\imageUsageSubCategorie;
use App\ImageUsagPrice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Image;

class ImageController extends Controller {
    public function get_image_metas(Request $request) {
        $image = $request->file("image");
        $metas = ImageHelper::read_metas($image);
        return response()->json(['data' => $metas], 200);
    }

    public function create_thumbnail($image, $name, $width, $height){

        if($height < $width) {
            $size = $height;
            $x = floor(($width - $size)/2);
            $y = 0;
        } else {
            $size = $width;
            $y = floor(($height - $size)/2);
            $x = 0;
        }

        $name = ImageHelper::cropImage($image, $x, $y, $size, $size, $name, "images/uploaded_images/thumbnails");

        return config('app.url').'/public/images/uploaded_images/thumbnails/'.$name;
    }

    public function upload_image(Request $request) {
       
        ini_set("memory_limit",-1);
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'height' => 'required',
            'width' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $image = $request->file("image");
        $contributor = $request["contributor"];
        $masterId = $request["masterId"];
        $is_portfolio = 0;
        try{
            $width = $request["width"];
            $height = $request["height"];
            $medium_width = floor($width*0.8);
            $medium_height = floor($height*0.8);
            $small_width = floor($width*0.5);
            $small_height = floor($height*0.5);
            $name = time().$image->getClientOriginalName();
            $destinaionPath = public_path("images/uploaded_images");
            $image->move($destinaionPath, $name);
            $imagePath = $destinaionPath.'/'.$name;

            if($request["metas"]) {
                $metas = json_decode($request["metas"]);
                ImageHelper::addMetaToImage($imagePath, $metas);
            }

            $thumbnail_url = $this->create_thumbnail($imagePath, $name, $request['width'], $request['height']);
            $medium_url = ImageHelper::resize_image($imagePath, $medium_width, $medium_height, $name, "images/uploaded_images/medium");
            $medium_url = config('app.url')."/public/images/uploaded_images/medium/".$medium_url;
            $small_url = ImageHelper::resize_image($imagePath, $small_width, $small_height, $name, "images/uploaded_images/small");
            $small_url = config('app.url')."/public/images/uploaded_images/small/".$small_url;
            // db saving
            $image_url = config('app.url').'/public/images/uploaded_images/'.$name;

            if(Auth::user()->user_type == 1 && Auth::user()->is_confirm == 0) {
               $is_portfolio = 1;
            }
            if(Auth::user()->user_type == 1) {
               $status = 0;
            }

            if(!$masterId) {
                $masterImage = DB::table('all_images_masters')->insertGetId([
                    'user_id' => $contributor
                ]);
            } else {
                $masterImage = $masterId;
            }

                $imageChildId = ImageChild::create([
                        'master_id' => $masterImage,
                        'image_name' => $name,
                        'user_id' => $contributor,
                        'height' => $request['height'],
                        'width' => $request['width'],
                        "specific_people" => $request['specificPeople'],
                        'location' => $request['location'],
                        'author' => isset($metas->Author) ? $metas->Author : "",
                        'country' => isset($metas->Country) ? $metas->Country : "",
                        'city' => isset($metas->City) ? $metas->City : "",
                        'state' => isset($metas->State) ? $metas->State : "",
                        'postal_code' => isset($metas->PostalCode) ? $metas->PostalCode : "",
                        'phone' => isset($metas->Phone) ? $metas->Phone : "",
                        'email' => isset($metas->Email) ? $metas->Email : "",
                        'caption' => isset($metas->Caption) ? $metas->Caption : "",
                        'website' => isset($metas->Website) ? $metas->Website : "",
                        'headline' => isset($metas->Headline) ? $metas->Headline : "",
                        'title' => isset($metas->Title) ? $metas->Title : "",
                        'copy_right' => isset($metas->Copyright) ? $metas->Copyright : "",
                        'keywords' => isset($metas->Keywords) ? $metas->Keywords : "",
                        'category'=>$request["category"],
                        'sub_category'=> isset($request["subCategory"]) ? $request["subCategory"] : null,
                        'orientation' => isset($request["orientation"]) ? $request["orientation"] : null,
                        'no_people' => isset($request["people"]) ? $request["people"] : null,
                        'people_composition' => isset($request["composition"]) ? $request["composition"] : null,
                        'image_main_url' => $image_url,
                        'medium_url' => $medium_url,
                        'small_url' => $small_url,
                        'thumbnail_url' => $thumbnail_url,
                        'is_portfolio' => $is_portfolio,
                        'status' => $status
                    ])->id;
                    $imageUsagePriceItem =[
                        ['image_id'=>$imageChildId, 'usage_purpose'=>1,'price'=>100],
                        ['image_id'=>$imageChildId, 'usage_purpose'=>2,'price'=>100],
                        ['image_id'=>$imageChildId, 'usage_purpose'=>3,'price'=>130],
                        ['image_id'=>$imageChildId, 'usage_purpose'=>4,'price'=>140],
                        ['image_id'=>$imageChildId, 'usage_purpose'=>5,'price'=>130],
                        ['image_id'=>$imageChildId, 'usage_purpose'=>6,'price'=>250],
                    ];
                $imageUsagePrice = ImageUsagPrice::insert($imageUsagePriceItem);

        } catch (\Throwable $e) {
            return response()->json(["data" => $masterId, "errors" => $e->getMessage()], 500);
        }
        return response()->json(['data' => $masterImage], 200);
    }

    public function imageList() {
        return view('backEnd.patients.image_list');
    }

    public function image_list_all() {
        $images = ImageChild::where('id', '>', 1)->paginate(10);
        $total_images = ImageChild::where('id', '>', 1)->get();
       
        return view('backEnd.images.index', compact('images', 'total_images'));
    }
    
    public function imageUsageNameMap($imageUsageNames)
    {
        $imageUsageNameArray = array();
        foreach($imageUsageNames as $item)
        {
            $imageUsageNameMap[$item['id']] = $item['name'];
        }
        return $imageUsageNameMap;
    }

    public function getAllImages() {
        $images = ImageChild::all();
        return response()->json($images);
    }

    public function deleteImage(Request $request) {

        $imageId = $request->imageId;
        $image = ImageChild::find($imageId);
        $deleted = $image->delete();
        return response()->json(['data' => $deleted]);
    }

    public function deleteBulkImage(Request $request)
    {
        $imageIds = json_decode($request["imageIds"]);
        ImageChild::whereIn('id', $imageIds)->delete();

        return response()->json(['status' => 200], 200);
    }

    public function imageDetails($id) {
        $image = ImageChild::find($id);
        $imageUsageNames = ImageUsageName::all()->toArray();

        $imageUsagePrice = ImageUsagPrice::where('image_id', $image->id)->get();
  
        return response()->json(['data'=> $image,"imageUsagePrice" => $imageUsagePrice], 200);
    }

    public function updateImage(Request $request, $id) {
        $image = ImageChild::find($id);
        $imageName = $image->image_name;
        ImageHelper::addMetaToImage(public_path("images/uploaded_images/${imageName}"), [
            'Author' => $request->author
        ]);
        $image = $image->update([
            'author'=>$request->author,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'email'=>$request->email,
            'city'=>$request->city,
            'state'=>$request->state,
            'title'=>$request->title,
            'caption'=>$request->caption,
            'website'=>$request->website,
            'headline'=>$request->headline,
            'keywords'=>$request->keywords,
            'copy_right'=>$request->copy_right,
            'postal_code'=>$request->postal_code,
            'orientation' => $request->orientation,
            'no_people' => $request->no_people,
            'people_composition' => $request->people_composition,
            'specific_people' => $request->specific_people,
            'location' => $request->location

        ]);
        return response()->json(['data'=>$image], 200);
    }

    public function searchImage(Request $request)
    {
        $search = $request->input('search_key');

        $searchKeyWords = explode(" ", $search);

        $searchKeyWords = array_filter($searchKeyWords, function($elm) {
            return strlen($elm) > 2;
        });

        foreach ($searchKeyWords as $value){
            if(!isset($searchQuery)) {
                $searchQuery = ImageChild::where('keywords', 'like', '%' . $value . '%');
            } else {
                $searchQuery = $searchQuery->orWhere('keywords', 'like', '%' . $value . '%');
            }
        };

        $images = $searchQuery->paginate(20);

        $categories = Category::all();
        $photographers = User::where('user_type', 1)->get();
        return view('filter', compact('images', 'categories', 'photographers'));
    }

    public function searchImageData(Request $request){
        $searchImage = new SearchImage();

        $images = $searchImage->searchImage($request);

        $categories = Category::all();
        $photographers = User::where('user_type', 1)->get();
        return view('backEnd.images.index', compact('images', 'categories', 'photographers'));
    }

    public function updateImagePrice(Request $request)
    {
     
        $imageId = $request->imageId;
        $imagePriceList = json_decode($request->priceList);
 
        foreach($imagePriceList as $key=>$price) {
            $index = $key + 1;
            $updateImagePriceList = ImageUsagPrice::where('image_id', $imageId)->where('usage_purpose', $index)->first();
    
            if(isset($updateImagePriceList))
            {
                $updateImagePriceList->price = $price;
                $updateImagePriceList->save();

            }
            else
            {
                $updateImagePriceList = new ImageUsagPrice();
                $updateImagePriceList->image_id = $imageId;
                $updateImagePriceList->usage_purpose = $index;
                $updateImagePriceList->usage_purpose = $index;
                $updateImagePriceList->price = $price;
                $updateImagePriceList->save();
            }

        }

        return response()->json(['data'=>$imagePriceList], 200);
    }

    public function imageUsagesSubCategory(Request $request)
    {
        $getImageUsagesSubCategories = imageUsageSubCategorie::where('category_id',$request->cat_id)->get(['id','sub_cat_name','price'])->toArray();
        $getImageUsagesSubCategories = json_encode($getImageUsagesSubCategories);
        return $getImageUsagesSubCategories;
    }

    public function pending_image_list() {
        $images = ImageChild::where('id', '>', 1)->where('status',0)->paginate(10);
        $total_images = ImageChild::where('id', '>', 1)->where('status',0)->get();
       
        return view('backEnd.pending_images.index', compact('images', 'total_images'));
    }
}
