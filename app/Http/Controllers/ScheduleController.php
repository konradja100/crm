<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Work_Hour;

class ScheduleController extends Controller
{
    public function setScheduleGet()
    {
        return view('schedule.setSchedule');
    }
    public function setSchedulePost(Request $request)
    {
        $number_of_week = $request->show_schedule;
        $request->session()->put('number_of_week', $number_of_week);
        $request->session()->put('year', $request->schedule_year);
        $schedule_analitics = $this->setWeekDays($number_of_week,$request);
        return view('schedule.setSchedule')
            ->with('number_of_week',$number_of_week)
            ->with('schedule_analitics',$schedule_analitics);
    }
    public function viewScheduleGet()
    {
        return view('schedule.viewSchedule');
    }
    public function viewSchedulePost(Request $request)
    {
        if ($request->show_schedule == "Wybierz") {
            return view('schedule.viewSchedule');
        }
        $number_of_week = $request->show_schedule;
        $year = $request->year;
        $year = explode('.',$year);
        $year = $year[0];
        $query = DB::table('users')
            ->leftjoin("schedule", function ($join) use ($number_of_week,$year) {
                $join->on("schedule.id_user", "=", "users.id")
                    ->where("schedule.week_num", "=", $number_of_week)
                    ->orderBy('users.last_name')
                    ->where("schedule.year", "=", $year);
            })
            ->select(DB::raw(
                'schedule.*,
                time_to_sec(`monday_stop`)-time_to_sec(`monday_start`) as sec_monday,
                time_to_sec(`tuesday_stop`)-time_to_sec(`tuesday_start`) as sec_tuesday,
                time_to_sec(`wednesday_stop`)-time_to_sec(`wednesday_start`) as sec_wednesday,
                time_to_sec(`thursday_stop`)-time_to_sec(`thursday_start`) as sec_thursday,
                time_to_sec(`friday_stop`)-time_to_sec(`friday_start`) as sec_friday,
                time_to_sec(`saturday_stop`)-time_to_sec(`saturday_start`) as sec_saturday,
                time_to_sec(`sunday_stop`)-time_to_sec(`sunday_start`) as sec_sunday,
                users.id as id_user,
                users.first_name as user_first_name,
                users.last_name as user_last_name
                '))
            ->where('users.department_info_id',Auth::user()->department_info_id)
            ->where('users.status_work', '=', 1)
            ->wherein('users.user_type_id',[1,2])
            ->orderBy('users.last_name')
            ->get();

        return view('schedule.viewSchedule')
            ->with('number_of_week',$number_of_week)
            ->with('schedule_user',$query);
    }

    public function datatableShowUserSchedule(Request $request)
    {
        $number_week =  $request->session()->get('number_of_week');
        $year = $request->year;
        $request->session()->put('year', $year);
        $query = DB::table('users')
            ->leftjoin("schedule", function ($join) use ($number_week,$year) {
                $join->on("schedule.id_user", "=", "users.id")
                    ->where("schedule.week_num", "=", $number_week)
                    ->where("schedule.year", "=", $year);
            })
            ->select(DB::raw(
                'schedule.*,
                users.id as id_user,
                users.first_name as user_first_name,
                users.last_name as user_last_name,
                users.private_phone as user_phone
                '))
            ->wherein('users.user_type_id',[1,2])
            ->where('users.status_work', '=', 1)
            ->where('users.department_info_id',Auth::user()->department_info_id);
        return datatables($query)->make(true);
    }

    public function saveSchedule(Request $request)
    {
        $start_hours = $request->start_hours;
        $stop_hours = $request->stop_hours;
        $reasons = $request->reasons;
        $id_user = $request->id_user;
        for($i=0;$i<7;$i++)
        {
            if($start_hours[$i] == 'null')
                $start_hours[$i] = null;
            if($stop_hours[$i] == 'null')
                $stop_hours[$i] = null;
            if($start_hours[$i] == null && $start_hours[$i] == null && $reasons[$i] == null)
                $reasons[$i] = 'Wolne';
            else if($start_hours[$i] != null && $start_hours[$i] != null)
                $reasons[$i] = null;
        }
        $number_week =  $request->session()->get('number_of_week');
        $year = $request->session()->get('year');
        $schedule_id = $request->schedule_id;
        $dayOfWeekArray= array('monday' ,'tuesday','wednesday','thursday','friday','saturday','sunday');
        if($schedule_id == 'null')
        {
            $schedule = new Schedule();
            $schedule->id_user = $id_user;
            $schedule->id_manager = Auth::user()->id;
        }else{
            $schedule = Schedule::find($schedule_id);
            $schedule->id_manager_edit = Auth::user()->id;
        }
            $schedule->year = $year;
            $schedule->week_num = $number_week;

            $schedule->monday_start = $start_hours[0];
            $schedule->monday_stop = $stop_hours[0];
            $schedule->monday_comment =  $reasons[0];

            $schedule->tuesday_start = $start_hours[1];
            $schedule->tuesday_stop = $stop_hours[1];
            $schedule->tuesday_comment =  $reasons[1];

            $schedule->wednesday_start = $start_hours[2];
            $schedule->wednesday_stop = $stop_hours[2];
            $schedule->wednesday_comment =  $reasons[2];

            $schedule->thursday_start = $start_hours[3];
            $schedule->thursday_stop = $stop_hours[3];
            $schedule->thursday_comment =  $reasons[3];

            $schedule->friday_start = $start_hours[4];
            $schedule->friday_stop = $stop_hours[4];
            $schedule->friday_comment =  $reasons[4];

            $schedule->saturday_start = $start_hours[5];
            $schedule->saturday_stop = $stop_hours[5];
            $schedule->saturday_comment =  $reasons[5];

            $schedule->sunday_start = $start_hours[6];
            $schedule->sunday_stop = $stop_hours[6];
            $schedule->sunday_comment =  $reasons[6];

            $schedule->save();

        return $schedule;
    }
    //*************Custom Function*************
    private function getStartAndEndDate($week, $year) {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
    }
    private function setWeekDays($number_week,$request)
    {
        $dayOfWeekArray= array('monday' ,'tuesday','wednesday','thursday','friday','saturday','sunday');
        $query = DB::table('schedule');
        $sql = '';
        for($j=0;$j<count($dayOfWeekArray);$j++) {
            for ($i = 8; $i < 21; $i++) {
                if ($i < 10) {
                    if($i == 9)
                    {
                        $czas_plus = $i+1;
                        $czas = '0' . $i;
                    }else {
                        $czas_plus = '0' . $i + 1;
                        $czas = '0' . $i;
                    }
                } else
                {
                    $czas = $i;
                    $czas_plus = $i+1;
                }

                if ($j + 1 == count($dayOfWeekArray) && $i == 20) {
                    $sql .='sum(CASE WHEN Hour(CAST("'.$czas .':00:00" as Time))
                      >= Hour(schedule.'.$dayOfWeekArray[$j].'_start) and Hour(CAST("' . $czas_plus . ':00:00" as Time))
                      <= Hour(schedule.'.$dayOfWeekArray[$j].'_stop) THEN 1 ELSE 0 END) as  "'.$dayOfWeekArray[$j].$i.'"';

                } else {
                    $sql .='sum(CASE WHEN Hour(CAST("'.$czas .':00:00" as Time))
                      >= Hour(schedule.'.$dayOfWeekArray[$j].'_start) and Hour(CAST("' . $czas_plus . ':00:00" as Time))
                      <= Hour(schedule.'.$dayOfWeekArray[$j].'_stop) THEN 1 ELSE 0 END) as "'.$dayOfWeekArray[$j].$i.'",';
                }
            }
        }
        $query->select(DB::raw($sql))
          ->join('users','users.id','schedule.id_user')
          ->where('week_num',$number_week)
          ->where('year',$request->session()->get('year'))
          ->where('users.department_info_id',Auth::user()->department_info_id);

        return $query->get();
    }

    public function timesheetGet() {

        return view('schedule.timesheet');
    }

    public function timesheetPost(Request $request) {
        $date_start = $request->timesheet_date_start;
        $date_stop = $request->timesheet_date_stop;

        $hours = DB::table('work_hours')
            ->select(DB::raw('
                first_name,
                last_name,
                rate,
                SUM(success) as user_success,
                SUM(time_to_sec(accept_stop) - time_to_sec(accept_start)) / 3600 as user_sum
            '))
            ->join('users', 'users.id', '=', 'work_hours.id_user')
            ->whereBetween('work_hours.date', [$date_start, $date_stop])
            ->whereIn('users.user_type_id', [1,2])
            ->whereIn('work_hours.status', [4,5])
            ->where('users.department_info_id', '=', Auth::user()->department_info_id)
            ->groupBy('users.id')
            ->orderBy('users.last_name')
            ->get();

        return view('schedule.timesheet')
            ->with('date_start', $date_start)
            ->with('date_stop', $date_stop)
            ->with('hours', $hours);
    }

    public function timesheetCadreGet() {
        return view('schedule.timesheetCadre');
    }

    public function timesheetCadrePost(Request $request) {
        $date_start = $request->timesheet_date_start;
        $date_stop = $request->timesheet_date_stop;

        $hours = DB::table('work_hours')
            ->select(DB::raw('
                first_name,
                last_name,
                SUM(time_to_sec(accept_stop) - time_to_sec(accept_start)) / 3600 as user_sum
            '))
            ->join('users', 'users.id', '=', 'work_hours.id_user')
            ->whereNotIn('users.user_type_id', [1,2])
            ->whereBetween('work_hours.date', [$date_start, $date_stop])
            ->whereIn('work_hours.status', [4,5])
            ->groupBy('users.id')
            ->orderBy('users.last_name')
            ->get();

            return view('schedule.timesheetCadre')
                ->with('date_start', $date_start)
                ->with('date_stop', $date_stop)
                ->with('hours', $hours);
    }

}
