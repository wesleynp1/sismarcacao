<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\scheduling;
use App\Models\service;
use Exception;
use Illuminate\Support\Facades\DB;

class schedulingController extends Controller
{
    //CRUD
    function createScheduling(Request $r){
        try{
            $this->SchedulingValidation($r)->save();
            return redirect("agendamentos");
        }catch(Exception $e){
            return back()->withInput(["name","scheduled_time","serviceId"])->with("message",$e->getMessage());
        }
    }
    
    function readScheduling() : View{

        $schedulings = DB::select("SELECT scheduling.id,scheduled_time,created_at,client_name,service.name as service_name from scheduling inner join service where scheduling.serviceId=service.id ORDER BY scheduled_time DESC;");

        foreach ($schedulings as $scheduling){
            $scheduling->scheduled_time = date_create($scheduling->scheduled_time);

        }

        return view("scheduling.listScheduling",["schedules" => $schedulings]);
    }

    function updateScheduling(Request $r){
        try{
            $schedulingToBeUpdated = scheduling::findOrFail($r->id);
            $this->SchedulingValidation($r,$schedulingToBeUpdated)->save();
            return redirect("agendamentos");
        }catch(Exception $e){
            return back()->withInput(["client_name","scheduled_time","serviceId"])->with("message",$e->getMessage());
        }
    }

    function deleteScheduling(Request $r){
        if(scheduling::destroy($r->id)){
            return redirect("/agendamentos")->with("message","Deletado com sucesso!");;
        }else{
            return redirect("/agendamentos")->with("message","Erro ao deletar");
        }
    }


    //FORM's
    function formCreateScheduling() : View {
        $services = DB::select("SELECT id,name from service;");
        return view("scheduling.createScheduling",["services"=>$services]);
    }

    function formUpdateScheduling(Request $r){
        try{
            return view("scheduling.updateScheduling",[
                "scheduling"=>scheduling::findOrFail($r->id),
                "services" => DB::select("SELECT id,name from service;")
            ]);
        }catch(Exception $e){
            return back();
        }
    }

    function formDeleteScheduling(Request $r){
        try{
            $schedulingForDeleting = scheduling::findOrFail($r->id);
            $schedulingForDeleting->service_name = service::findOrFail($schedulingForDeleting->serviceId)->name;
            return view("scheduling.deleteScheduling",["scheduling"=> $schedulingForDeleting]);
        }catch(Exception $e){
            return back();
        }
    }

    //VALIDATION
    function SchedulingValidation(Request $r,$scheduling = new scheduling()){
        
            $r->validate([
                "client_name" => "required | min:2",
                "scheduled_time" => "required | date",
                "serviceId" => "required"
            ]);

            $scheduling->client_name    = $r->client_name;
            $scheduling->scheduled_time = $r->scheduled_time;
            $scheduling->serviceId      = $r->serviceId;

            return $scheduling;
    }
}
