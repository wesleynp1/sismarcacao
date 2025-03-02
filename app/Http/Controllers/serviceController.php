<?php

namespace App\Http\Controllers;

use App\Models\service;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class serviceController extends Controller
{
    function createService(Request $r){

        try{
            $r->validate([
                'name' => 'required',
                'price' => 'required',
                'image' => 'image',
                'description' =>''
            ]);
            
            if($r->price=='0.00' || $r->name=="")throw new Exception("Valores inválidos");
            

            $service = new service();
            if(isset($r->image)){
                $this->checkImageSize($r->image);
                $service->image = $this->saveImage($r);
            }  

            $service->name = $r->name;
            $service->description = $r->description;
            $service->price = floatval($r->price);         

            $service->save();
            
            return redirect("/");
        }catch(Exception $e){
            return back()->withInput(["name","price","image","description"])->with("message",$e->getMessage());
        }
    }
    
    function readServices(Request $r) : View{
        return view("services",["services" => service::all()]);
    }

    /* 
    *Save a image and return it's path
    */
    function saveImage(Request $r) : string{
        if($r->has("image")){
            $pathImage = "img/services/";
            $nameImage = time() . "." . $r->image->extension();

            $r->image->move(env("PUBLIC_FOLDER") . $pathImage , $nameImage);            
        }

        return $pathImage . $nameImage;
    }

    /* 
    *Check it's size
    */
    function checkImageSize($fileImage){
        //CONFERE TAMANHO DA image
        $sizeImage = getimagesize($fileImage);
        if($sizeImage[0]>1080 || $sizeImage[1]>1080){
            throw new Exception("Tamanho de imagem não permitido");
        }
    }
}
