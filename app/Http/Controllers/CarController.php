<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Models\CarMark;
use App\Models\CarModel;
use App\Models\Car;
use Storage;
class CarController extends Controller
{
    //


    public function index()
    {
        $cars = Car::all();
        //$cars = Car::with('models')->all()->get();

        //dd($cars->model->mark->mark);
        return view('ManageCars.all_cars',compact( 'cars'));
    }
    public function create()
    {
        $car_marks = CarMark::all();

        return view( 'ManageCars.add_car',compact( 'car_marks'));
    }

    public function setAvailable()
    {
        $id_car = request()->input( 'id_car');
        $available = request()->input( 'available') == "true" ? 1:0;
        //dd( request()->input());
        Car::where('id', $id_car)->update([ 'available'=>$available]);
        return 'done';
    }

    public function editCar($id_car,$action)
    {
        $car = Car::where('id', $id_car)->first();
        if( $action == "edit"){
            $car_marks = CarMark::all();
            $car_models = CarModel::where('mark_id', $car->model->mark_id)->get()->toArray();
            return view( "ManageCars.edit_car", compact('car', 'car_marks', 'car_models'));
        }elseif( $action == "show"){
            $car->paths_images = $this->getImages( $car->paths_images);
            //dd( $car->paths_images);
            $car->type_car = trans('translate.'.$car->type_car);
            $car->available = ( $car->available == 1)? trans('translate.yes'): trans('translate.no');
            return view("ManageCars.show_car", compact('car'));
        }

    }
    public function update(CarRequest $request,$id_car)
    {
        $data = [
                "model_id" => $request->input("model_id"),
                "registration_number" =>  $request->input("registration_number"),
                "number_places" =>  $request->input("number_places"),
                "number_cylinder" =>  $request->input("number_cylinder"),
                "color" =>  $request->input("color"),
                "type_car" =>  $request->input("type_car"),
                "purchaseDate" =>  $request->input("purchaseDate"),
                "available" =>  $request->input("available"),
                "description" =>  $request->input("description"),
        ];
         Car::where('id', $id_car)->update( $data);
         session()->flash('car_updated_succeed', trans('translate.car_updated_succeed'));
        return redirect(url('all_cars'));
    }

    public function store( CarRequest $request)
    {
        Car::create( $request->input());
        session()->flash('car_add_succeed', trans('translate.car_add_succeed'));
        return redirect(url('all_cars'));
    }

    public function getModelsCars($mark_id)
    {
        $car_models = CarModel::where( 'mark_id', $mark_id)->get();
        return  $car_models->toArray();
    }

    public function Add_Imgs_Car()
    {
        return view( 'ManageCars.add_images_to_car');
    }

    public function Add_Imgs_Car_post( Request $request)
    {
        $car = Car::find( $request->input('id_car'));
        $paths_images = $car->paths_images;
        $count = 0;
        if( $paths_images != null){
            $images = explode('|', $paths_images);
            $count = count( array_filter($images));
        }
        if( $count < 5){
             foreach( $request->file('file') as $file){
            $extension = $file->extension();
            $imageName = time().'.'.$extension;
            $paths_images = $imageName.'|'. $paths_images;
            Storage::putFileAs('public/uploads/cars',$file, $imageName);

        }
        $car->paths_images = $paths_images;
        $car->save();
        }
        $paths_images = $this->getImages( $paths_images);
        //dd( json_encode( $paths_images));

        return json_encode($paths_images);
    }

    public function Delete_Imgs_Car()
    {
        $id_car = request('id_car');
        $imageName = request('id');

        $car = Car::find( $id_car);
        $paths_images = $car->paths_images;
        $imagesTmp = explode('|', $paths_images);
        $images  = array_filter( $imagesTmp);
        $paths_imagesNew = '';
        foreach ( $images as $img) {
            if($img != $imageName){
                $paths_imagesNew = $img.'|'. $paths_imagesNew;
            }
        }
        $car->paths_images = $paths_imagesNew;
        $car->save();


        Storage::delete('public/uploads/cars/'. $imageName);
        return   $paths_imagesNew;
    }


    public function getImages( $paths_images){
        $Images = new \stdClass();
        if ($paths_images != null) {
            $images = explode('|', $paths_images);
            $images = array_filter($images);

            $images = array_filter($images);
            $j = 1;
            foreach ($images as $img) {
                $Images->{"image" . $j} =  $img;
                $j++;
            }
            $count = 5 - substr_count($paths_images, '|');
            if ($count != 0) {
                for ($i = 0; $i < $count; $i++) {
                    $Images->{"image" . $j} =  'empty-image.png';
                    $j++;
                }
            }
        } else {
            for ($i = 1; $i < 6; $i++) {
                $Images->{"image" . $i} =  'empty-image.png';
            }
        }
        return  $Images;
    }

}
