<?php

namespace App\Http\Controllers;

use App\UserData;
use Carbon\Carbon;

class ChartsController extends Controller
{
    public function sortData(){
       $first_date = UserData::min('created_at');
       $last_date = UserData::max('created_at');

       //get the number of weeks
       $weeks = Carbon::parse($first_date)->diffInWeeks(Carbon::parse($last_date));

        $date_to_compare = Carbon::parse($first_date);
        $data_for_each_week = [];
        //now for each week add data in the array
        for($i=0;$i<$weeks;$i++){
            $week = $i+1;
           //add 7 days to the first day in the records
          $date_to_compare =Carbon::parse($date_to_compare)->addWeek();
           $dataforweek = UserData::where('created_at','<',$date_to_compare)->get()->groupBy('onboarding_perentage');
           $data_for_each_week["week".$week] = $dataforweek;
       }
        return $data_for_each_week;
    }

    public function prepareDataForChart(){
        $data = $this->sortData();
        $sorted_data = [];
        //get the total number of users in order to get percentages
        $totalRecords = count(UserData::all());
        if(count($data)){
            //here we get the key i.e the value we set our week indicator to be
            foreach ($data as $period => $dataForEachWeek){
                //then we get the number
                $datas = [];
                $datas []= ['x'=>0,'y'=>100];
                $keys = [];
                foreach ($dataForEachWeek as $key2=>$grouped){
                    $keys[] = $key2;
                }
                sort($keys);
                //in order to get data sorted in ascending order, we first get the keys then get the values using the keys
                foreach ($keys as $en_boarding_percentage){
                    //here we get the number of users with this en_boarding percentage(key)
                    $user_count = count($dataForEachWeek[$en_boarding_percentage]);
                    //percentage of users with this en_boarding_percentage rounded to the nearest 10's
                    $percentage = ceil(($user_count/$totalRecords)*100);
                        $datas[] =['x'=>$en_boarding_percentage,'y'=>$percentage];
                }
                $sorted_data[] = ["name"=>$period,'data'=>$datas];
            }
        }
        //return the data to the chart
         return response()->json($sorted_data);
    }
}
