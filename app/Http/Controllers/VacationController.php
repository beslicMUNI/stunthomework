<?php

namespace App\Http\Controllers;

use App\User;
use App\Vacation;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class VacationController extends Controller
{
    //
    public function index(){
        return view('vacations.index');
    }

    public function store(Request $request){
        $user = Auth::user();
        $user = User::find($user->id);
        $dateFrom = $request->date_from;
        $dateTo = $request-> date_to;

        if($dateFrom >= $dateTo || $dateFrom < now()){
            return 'put correct dates!';
        }

        // checking if somebody from same position is already on vacation on same dates
         $positionid = $user->positionid;     

        
        $overlapingvacations = Vacation::whereBetween('date_from', [$dateFrom, $dateTo])
        ->orWhereBetween('date_to', [$dateFrom, $dateTo])->get();

        // return var_dump($overlapingvacations);

       // return $overlapingvacations;

        if(!empty($overlapingvacations)){       
            foreach ($overlapingvacations as $ov) {               
                if($ov->user->positionid == $positionid) {
                    return 'Somebody from same position is already on vacation';
                }
            }
        } 

        $fromFormated = new DateTime($dateFrom);
        $toFormated = new DateTime($dateTo);
        $startDate = new DateTime($user->started_at);  
        $currentDate = new DateTime(now());

        $daysAsked = $toFormated->diff($fromFormated)->d + 1;
        

        

        if($user->contract_type === 'limited'){

            
            $currentYearBegining = $currentDate->setDate(now()->year, 1, 1);                      

            if($startDate > $currentYearBegining){
                $fullmonths = now()->diff($startDate)->m;               
                
            } else {
                $fullmonths = now()->diff($currentYearBegining)->m;                
            }
            $daysAvailable = round((20/12)*$fullmonths);

            if($daysAsked > $daysAvailable){
                return 'not ok';
            }
            return 'ok';            

            
        
            // else unlimited
        } else {

            // ako je prvi odmor ove godine. prebaci nove u stare,  dodaj 20 novih dana, i koristi stare ako ih ima
            
            if($this->isItFirstVacationInThisYear($user)){
                $user->old_days_available = $user->days_available;
                $user->days_available = 20;
                $user->save();
            }
            // ako nije prvi odmor, dani su vec prebaceni, i samo koristi sta moze

            if ($daysAsked > ($user->old_days_available + $user->days_available)){
                return 'no enough available days';
            } else {
                                          
                $this->insertVacation($daysAsked, $request);
            }

            // if($toFormated > $currentDate->setDate(now()->year, 6, 30)){
            //     // return 'no more old vacation';  because user asked for vacation after June 30th
            //     $daysAvailable = 20;
            //     $daysUsedThisYear = 0;
            //     $thisYearVacations = Vacation::where('userid', $user->id)->whereYear('date_to', now()->year)->get();
            //     // return $thisYearVacations;
            //     foreach ($thisYearVacations as $tyv) {
            //         # code...
            //         $tyvDateFrom = new DateTime($tyv->date_from);
            //         $tyvDateTo = new DateTime($tyv->date_to);
            //         $daysUsedThisYear += $tyvDateTo->diff($tyvDateFrom)->d +1;                    
            //     }
            //    //  return $daysUsedThisYear;   
            //    $daysAvailable -= $daysUsedThisYear;
            //    return $daysAvailable;
                
           
            
            if(now()->diff($startDate)->y >= 1){

            }
        }
    }

    public function isItFirstVacationInThisYear($user){
        $thisYearVacations = Vacation::where('userid', $user->id)->whereYear('date_from', now()->year)->get();

        //return var_dump($thisYearVacations);

        if(($thisYearVacations)) {
             return false;
        }
        return true;

    }

    public function insertVacation($daysAsked, $request){
        $user2 = Auth::user();
        $user = User::where('id', $user2->id)->first();
        $oldDays = $user->old_days_available;
        // return var_dump($user);
        if($daysAsked <= $oldDays){
            $user->old_days_available -= $daysAsked;                        
        } else {
            $daysAsked = $daysAsked - $user->old_days_available;
            $user->old_days_available = 0;
            $user->days_available -= $daysAsked;            
        }
        $user->save();
        

        $vacation = new Vacation();
        $data = $request->only($vacation->getFillable());
        $vacation->fill($data);
        $vacation->userid = $user->id;

        if($vacation->save()){
            echo('vacation saved');
        } else {
            return 'vacation not saved';
        }
    }
}
