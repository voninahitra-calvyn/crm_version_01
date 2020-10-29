<?php
/**
 * Created by PhpStorm.
 * User: Valandrainy
 * Date: 24/09/2020
 * Time: 22:51
 */

namespace App\Http\Controllers;


use App\Event;
use ICal\ICal;

class Service
{
    public $datecalendar = [];

    public static function parseDay(){
        $date = new \DateTime();
       $year = $date->format('Y');
        $list=[];
        $month = 12;
        $year = $year;
        for ($i=1; $i<=$month; $i++){

            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $i, $d, $year);
                if (date('m', $time)==$i)
                    $list[]=date('Y-m-d-D', $time);
            }
        }
        return $list;
    }
    public static function parseIcs($adresse,$client){
        $datecalendar = [];
        try {
                $ical = new ICal($adresse, array(
                    // $ical = new ICal('basicraoult.ics', array(
                    // $ical = new ICal('basictest.ics', array(
                    'defaultSpan'                 => 2,     // Default value
                    // 'defaultTimeZone'             => 'UTC',
                    'defaultTimeZone'             => 'UTC',
                    'defaultWeekStart'            => 'MO',  // Default value
                    'disableCharacterReplacement' => false, // Default value
                    'filterDaysAfter'             => null,  // Default value
                    'filterDaysBefore'            => null,  // Default value
                    'skipRecurrence'              => false, // Default value
                ));
                $events = $ical->events();
                $calcrmetier[] = null;
                $calgoogle[] = null;
                foreach ($events as $event){

                    $dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
                    $dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
                   $stCmp = $ical->iCalDateToDateTime($event->dtstart_array[3])->add(new \DateInterval('P1D'));
                    if ($stCmp!=$dtend) {
                        $tz = new \DateTimeZone('Europe/Paris');
                        $dtstart->setTimezone($tz);
                        $dtend->setTimezone($tz);
                    }
                    $dtstart = \Carbon\Carbon::parse($dtstart);

                    $dtend = \Carbon\Carbon::parse($dtend);
                    $datecalendar [] = [
                        'googleuid' => $event->dtstart_array[3].'_'.$event->uid.'_'.$client->prenom.$client->nom,
                        'client_priv' => $client->prenom.' '.$client->nom,
                        'adresse_details' => '',
                        'note_details' =>'',
                        'title' => 'Indisponible',
                        'titleDetails' => $event->summary,
                        'start'=>$dtstart->format('Y-m-d H:i:s'),
                        'end'=>$dtend->format('Y-m-d H:i:s'),
                        'backgroundColor' => '#f39c12',
                        'borderColor' => '#f39c12'
                    ];

                    //dd($agenda);
                    //$agenda->save();
                }

            } catch (\Exception $e) {
              return "agenda invalid";
            }
            return  $datecalendar;
    }

    public static function parseAgendaPrive($client){
        $datecalendar = [];
        $calendarGoogle = [];
        $calendarOutlook = [];
        if ($client){
            // echo $cli->prenom.' '.$cli->nom.' / '.$cli->agendapriv.'<br/>';
            /************** AJOUT EVENNEMENT CALENDRIER ***************************/
            if ($client->agendaoutlook){
                $adresse = $client->agendaoutlook;
                $infoLien = pathinfo($adresse);
                $extension = $infoLien['extension'];
                if ($extension=='ics'){
                    $calendarOutlook=self::parseIcs($adresse,$client);
                    }
             } 
            if ($client->agendapriv){
                $adresse = $client->agendapriv;
                $infoLien = pathinfo($adresse);
                $extension = $infoLien['extension'];
                if ($extension=='ics'){
                    $calendarGoogle=self::parseIcs($adresse,$client);
                    }
             }
               
        }
         $datecalendar = array_merge($calendarGoogle,$calendarOutlook);   
        return $datecalendar;

    }
    public static function parseAgendaAdmin($client){
        $datecalendar = [];
        if ($client && $client->agendaprivadmin){
            // echo $cli->prenom.' '.$cli->nom.' / '.$cli->agendapriv.'<br/>';
            /************** AJOUT EVENNEMENT CALENDRIER ***************************/
            $adresse = $client->agendaprivadmin;
            $infoLien = pathinfo($adresse);
            $extension = $infoLien['extension'];
            if ($extension=='ics'){
                try {
                    $ical = new ICal($adresse, array(
                        // $ical = new ICal('basicraoult.ics', array(
                        // $ical = new ICal('basictest.ics', array(
                        'defaultSpan'                 => 2,     // Default value
                        // 'defaultTimeZone'             => 'UTC',
                        'defaultTimeZone'             => 'UTC',
                        'defaultWeekStart'            => 'MO',  // Default value
                        'disableCharacterReplacement' => false, // Default value
                        'filterDaysAfter'             => null,  // Default value
                        'filterDaysBefore'            => null,  // Default value
                        'skipRecurrence'              => false, // Default value
                    ));
                    $events = $ical->events();
                    //dd($events);

                    $calcrmetier[] = null;
                    $calgoogle[] = null;
                    foreach ($events as $event){
                      //dd($ical->iCalDateToDateTime($event->dtend_array[3]));


                        $dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
                        $dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
                       $stCmp = $ical->iCalDateToDateTime($event->dtstart_array[3])->add(new \DateInterval('P1D'));
                        if ($stCmp!=$dtend) {
                            $tz = new \DateTimeZone('Europe/Paris');
                            $dtstart->setTimezone($tz);
                            $dtend->setTimezone($tz);
                        }
                        $dtstart = \Carbon\Carbon::parse($dtstart);

                        $dtend = \Carbon\Carbon::parse($dtend);
                        $datecalendar [] = [
                            'googleuid' => $event->dtstart_array[3].'_'.$event->uid.'_'.$client->prenom.$client->nom,
                            'client_priv' => $client->prenom.' '.$client->nom,
                            'adresse_details' => '',
                            'note_details' =>'',
                            'title' => 'Indisponible',
                            'titleDetails' => $event->summary,
                            'start'=>$dtstart->format('Y-m-d H:i:s'),
                            'end'=>$dtend->format('Y-m-d H:i:s'),
                            'backgroundColor' => '#f39c12',
                            'borderColor' => '#f39c12'
                        ];

                        //dd($agenda);
                        //$agenda->save();
                    }
                } catch (\Exception $e) {
                    die($e);
                }
            }
        }

        return $datecalendar;

    }
    public static function parseEventToArray($event){
        $datecalendar=[];
        if ($event){
            foreach ($event as $evt){
                $datecalendar [] = [
                    'id'=>$evt->_id,
                    'googleuid' => null,
                    'client_priv' => $evt->client_priv,
                    'adresse_details' => $evt->adresse_details,
                    'note_details' =>$evt->note_details,
                    'title' => $evt->title,
                    'titleDetails' => $evt->titre_details,
                    'start'=>$evt->start,
                    'end'=>$evt->end,
                    'backgroundColor' => $evt->backgroundColor,
                    'borderColor' => $evt->borderColor
                ];
            }
        }
        return $datecalendar;
    }

    public static function setArrayCalendar($hoursPlages,$dayLabel, $item){
        $datecalendar = [];
        if ($hoursPlages){
            foreach ($hoursPlages as $day){
                $start = str_replace("-$dayLabel"," $day[0]:00",$item);
                $start = \Carbon\Carbon::parse($start);
                $start = $start->format('yy-m-d H:i:s');

                $end = str_replace("-$dayLabel"," $day[1]:00",$item);
                $end = \Carbon\Carbon::parse($end);
                $end = $end->format('yy-m-d H:i:s');

                $datecalendar [] = [
                    'googleuid' => '',
                    'client_priv' => '',
                    'adresse_details' => '',
                    'note_details' =>'',
                    'title' => 'Indisponible',
                    'titleDetails' => 'Indisponible',
                    'start'=>$start,
                    'end'=>$end,
                    'backgroundColor' => '#f39c12',
                    'borderColor' => '#f39c12'
                ];
            }
        }
        return $datecalendar;
    }

    public static function parseAgendaPlage($hoursPlage){
        $datecalendar = [];
        $parse = self::parseDay();
        if($hoursPlage) {
            foreach ($parse as $item) {
                $dayLabel = substr($item, 11);
                switch ($dayLabel) {
                    case "Mon":
                      $datecalendar = array_merge($datecalendar,self::setArrayCalendar($hoursPlage['lundi'], $dayLabel, $item));
                        break;

                    case "Tue":
                        $datecalendar = array_merge($datecalendar,self::setArrayCalendar($hoursPlage['mardi'], $dayLabel, $item));
                        break;

                    case "Wed":
                        $datecalendar = array_merge($datecalendar,self::setArrayCalendar($hoursPlage['mercredi'], $dayLabel, $item));
                        break;

                    case "Thu":
                        $datecalendar = array_merge($datecalendar,self::setArrayCalendar($hoursPlage['jeudi'], $dayLabel, $item));
                        break;

                    case "Fri":
                        $datecalendar = array_merge($datecalendar,self::setArrayCalendar($hoursPlage['vendredi'], $dayLabel, $item));
                        break;

                    case "Sat":
                        $datecalendar = array_merge($datecalendar,self::setArrayCalendar($hoursPlage['samedi'], $dayLabel, $item));
                        break;

                    case "Sun":
                        $datecalendar = array_merge($datecalendar, self::setArrayCalendar($hoursPlage['dimanche'], $dayLabel, $item));
                        break;

                    default:
                        break;
                }
            }
        }

        return $datecalendar;

    }

}