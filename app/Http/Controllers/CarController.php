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
    
    public function editCar($id_car)
    {
        $car = Car::where('id',$id_car)->first();
        $car_marks = CarMark::all();
        $car_models = CarModel::where('mark_id',$car->model->mark_id)->get()->toArray();
        /*
        foreach ($car_models as $key => $value) {
            print_r($value);
            echo '<br>';
           //echo $value .'  key => '.$key;
        }
        dd($car_models[0]['id']);*/
        return view('ManageCars.edit_car', compact('car', 'car_marks', 'car_models'));
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
        $extension = $request->file('file')[0]->extension();
        $imageName = time().'.'.$extension;
        $file =  $request->file('file')[0];
        Storage::putFileAs('public/uploads',$file, $imageName);
        return $imageName;
    }

    public function Delete_Imgs_Car()
    {
        $imageName = request('id');
        Storage::delete('public/uploads/'. $imageName);
        return 'ok';
    }

}
