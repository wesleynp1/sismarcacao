<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\available_datetime;
use App\Models\scheduling;
use Exception;

class agendaController extends Controller
{
    function agenda(){
        
        $availableDatetimes = available_datetime::all();
        $scheduledDatetimes = scheduling::all("scheduled_time");

        $arrayAvailableDatetimes = [];

        foreach($availableDatetimes as $availableDatetime){
            $arrayAvailableDatetimes[] = date_create($availableDatetime->date_time);
        }

        $arrayscheduledDatetimes = [];

        foreach($scheduledDatetimes as $scheduledDatetime){
            $arrayscheduledDatetimes[] = date_create($scheduledDatetime->scheduled_time);
        }

        
        return view("agenda.agenda",[
            "availableDatetimes"=>$arrayAvailableDatetimes, 
            "scheduledDatetimes"=>$arrayscheduledDatetimes
        ]);
    }

    function saveAgenda(){
        return view("agenda.agenda",["datetimes"=>available_datetime::all()]);
    }

    function makeAvailableForm(){
        $availableDatetimes = available_datetime::all();
        $scheduledDatetimes = scheduling::all("scheduled_time");

        $arrayAvailableDatetimes = [];

        foreach($availableDatetimes as $availableDatetime){
            $arrayAvailableDatetimes[] = date_create($availableDatetime->date_time);
        }

        $arrayscheduledDatetimes = [];

        foreach($scheduledDatetimes as $scheduledDatetime){
            $arrayscheduledDatetimes[] = date_create($scheduledDatetime->scheduled_time);
        }
        
        return view("agenda.makeAvailable",[
            "availableDatetimes"=>$arrayAvailableDatetimes,
            "scheduledDatetimes"=>$arrayscheduledDatetimes
        ]);
    }

    
    function makeAvailable(Request $r){
        array_map( function($newDate){
            available_datetime::create(['date_time'=>date_create($newDate)]);
        } ,     
        $r->input('newAvailableDatetime'));        

        return redirect("agenda");
    }

    function makeUnavailable(Request $r){
        try{
            array_map( function($dateToDelete){
                $availableDatetimeToDelete =  available_datetime::findOrFail(date_create($dateToDelete));
                $availableDatetimeToDelete->delete();
            },
            $r->input('datesToUnavailable'));

            return redirect("agenda")->with("message","Operação bem sucedida!");
        }catch(Exception $e){
            return redirect("agenda")->with("message","Operação mau sucedida: " . $e->getMessage());
        }
        
    }
}
