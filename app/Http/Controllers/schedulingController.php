<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\scheduling;
use App\Models\service;
use App\Models\available_datetime;
use DateTimeZone;
use Exception;

class schedulingController extends Controller
{
    //CRUD
    function createScheduling(Request $r){
        try{
            $newScheduling = $this->SchedulingValidation($r);
            if(date_create($newScheduling->scheduled_time) < date_create('now',new DateTimeZone(env('APP_TIMEZONE')))){
                
            }
            available_datetime::destroy($newScheduling->scheduled_time);
            $newScheduling->save();
            return redirect("agendamentos")->with("message","agendamento realizado com sucesso!");
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

            if($schedulingToBeUpdated->scheduled_time != $r->scheduled_time){
                $oldScheduled_time = new available_datetime();                
                $oldScheduled_time->date_time = $schedulingToBeUpdated->scheduled_time;                
                available_datetime::destroy($r->scheduled_time);
                available_datetime::noExpiredAvailableDateTimes();
            }

            return redirect("agendamentos")->with("message","agendamento editado com sucesso!");;
        }catch(Exception $e){
            return back()->withInput(["client_name","scheduled_time","serviceId"])->with("message",$e->getMessage());
        }
    }

    function deleteScheduling(Request $r){
        try{
            $schedulingToDelete = scheduling::findOrFail($r->id);

            if(date_create($schedulingToDelete->scheduled_time) > date_create('now',new DateTimeZone(env('APP_TIMEZONE')))){
                $newAvailableDateTime = new available_datetime();
                $newAvailableDateTime->date_time = $schedulingToDelete->scheduled_time;
                $newAvailableDateTime->save();
            }
            
            $schedulingToDelete->delete();
            return redirect("/agendamentos")->with("message","Deletado com sucesso!");
        }catch(Exception $e){
            return redirect("/agendamentos")->with("message","Erro ao deletar:".$e->getMessage());
        }
    }


    //FORM's
    function formCreateScheduling(Request $r) : View {
        return view("scheduling.createScheduling",[
            "serviceIntentedId"=>$r->serviceIntentedId,
            "services"=> DB::select("SELECT id,name from service;"),
            "datetimes"=> $this->retrieveAvailableDatetime()
        ]);
    }

    function formUpdateScheduling(Request $r){
        try{
            return view("scheduling.updateScheduling",[
                "scheduling"=> scheduling::findOrFail($r->id),
                "services"  => DB::select("SELECT id,name from service;"),
                "datetimes" => $this->retrieveAvailableDatetime()
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

    function retrieveAvailableDatetime(){
        $available_datetimes = agendaController::noExpiredAvailableDateTimes();

        $datestimes = [];

        foreach($available_datetimes as $ad){
            $datestimes[] = date($ad->date_time);
        }

        return $datestimes;
    }

    //VALIDATION
    function SchedulingValidation(Request $r,$scheduling = new scheduling()){
        
            $r->validate([
                "client_name" => "required | min:2",
                "scheduled_time" => "required | date",
                "serviceId" => "required"
            ]);

            if(date_create($r->scheduled_time) < date_create('now',new DateTimeZone(env('APP_TIMEZONE')))){
                throw new Exception("Sinto muito, mas a data pretendida já passou");
            }

            if( isset($scheduling->scheduled_time) && $scheduling->scheduled_time != $r->scheduled_time){
                available_datetime::findOrFail($r->scheduled_time);
            }

            $scheduling->client_name    = $r->client_name;
            $scheduling->scheduled_time = $r->scheduled_time;
            $scheduling->serviceId      = $r->serviceId;

            return $scheduling;
    }
}
