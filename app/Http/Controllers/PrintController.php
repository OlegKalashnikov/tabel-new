<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Timetable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PrintController extends Controller
{
    public function printTimetable($department_id, $month){
//        $user_id = Auth::user()->id;
//        $author = User::where('id', $user_id)->value('name');
        Excel::create('Timetable', function ($excel) use($month, $department_id){
            $user_id = Auth::user()->id;
            $author = User::where('id', $user_id)->value('login');
            $count_day = Carbon::create(null, $month, 01)->daysInMonth;
            $excel_month = $month;
            $excel->setCreator($author);
            $excel->sheet('График', function ($sheet) use($user_id, $excel_month, $department_id, $count_day){
                $sheet->mergeCells('A1:AB1');
                $sheet->cell('A1', function ($cell){
                    $cell->setValue('Табель № ____________________');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('AI1:AJ1');
                $sheet->cell('AI1', function ($cell){
                    $cell->setValue('Коды');
                });

                $sheet->mergeCells('A2:AB2');
                $sheet->cell('A2', function ($cell){
                    $cell->setValue('учета использования рабочего времени');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('AC2:AH2');
                $sheet->cell('AC2', function ($cell){
                    $cell->setValue('Форма по ОКУД');
                });

                $sheet->mergeCells('AI2:AJ2');
                $sheet->cell('AI2', function ($cell){
                    $cell->setValue('504421');
                });

                $sheet->mergeCells('A3:AB3');
                $sheet->cell('A3', function ($cell) use($excel_month){
                    Carbon::setLocale('ru');
                    $m = Carbon::create(null, $excel_month)->format('M');
                    $y = Carbon::create(null, $excel_month)->format('Y');
                    $cell->setValue("за период $m $y г.");
                    $cell->setAlignment('center');
                });

                $sheet->mergeCells('AC3:AH3');
                $sheet->cell('AC3', function ($cell){
                    $cell->setValue('Дата');
                });

                $sheet->mergeCells('AI3:AJ3');
                $sheet->cell('AI3', function ($cell){
                    $cell->setValue('');
                });

                $sheet->mergeCells('A4:AB4');
                $sheet->cell('A4', function ($cell){
                    $cell->setValue("Учреждение КГБУЗ \"Городская больница №10, г. Барнаул\"");
                    $cell->setAlignment('center');
                });

                $sheet->mergeCells('AC4:AH4');
                $sheet->cell('AC4', function ($cell){
                    $cell->setValue('по ОКПО');
                });

                $sheet->mergeCells('AI4:AJ4');
                $sheet->cell('AI4', function ($cell){
                    $cell->setValue('');
                });

                $sheet->mergeCells('A5:AB5');
                $sheet->cell('A5', function ($cell) use($department_id){
                    $dep_name = Schedule::department_name($department_id);
                    $cell->setValue("Структурное подразделение $dep_name");
                    $cell->setAlignment('center');
                });

                $sheet->mergeCells('AC5:AH5');
                $sheet->cell('AC5', function ($cell){
                    $cell->setValue('');
                });

                $sheet->mergeCells('AI5:AJ5');
                $sheet->cell('AI5', function ($cell){
                    $cell->setValue('');
                });

                $sheet->mergeCells('A6:AB6');
                $sheet->cell('A6', function ($cell){
                    $cell->setValue("Вид табеля первичный");
                    $cell->setAlignment('center');
                });

                $sheet->mergeCells('AC6:AH6');
                $sheet->cell('AC6', function ($cell){
                    $cell->setValue('Номер корректировки');
                });

                $sheet->mergeCells('AI6:AJ6');
                $sheet->cell('AI6', function ($cell){
                    $cell->setValue('');
                });

                $sheet->mergeCells('AA7:AH7');
                $sheet->cell('AA7', function ($cell){
                    $cell->setValue('Дата формирования документа');
                });

                $sheet->mergeCells('AI7:AJ7');
                $sheet->cell('AI7', function ($cell){
                    $date = Carbon::now()->format('Y-m-d');
                    $cell->setValue("$date");
                });
                $sheet->mergeCells('A9:A10');
                $sheet->cell('A9', function($cell){
                    $cell->setValue('№п/п');
                });
                $sheet->mergeCells('B9:B10');
                $sheet->cell('B9', function($cell){
                    $cell->setValue('Фамилия, имя, отчество');
                });
                $sheet->mergeCells('C9:C10');
                $sheet->cell('C9', function($cell){
                    $cell->setValue('Должность');
                });
                $sheet->mergeCells('D9:AH9');
                $sheet->cell('D9', function ($cell){
                    $cell->setValue("Отметки о явках и неявках на работу по числам месяца");
                });
                $sheet->mergeCells('AI9:AO9');
                $sheet->cell('AI9', function ($cell){
                    $cell->setValue("Итого отработано за месяц");
                });
                $sheet->mergeCells('AP9:AR9');
                $sheet->cell('AP9', function ($cell){
                    $cell->setValue("Совмещение");
                });

                /**/
                $sheet->cell('D10', function ($cell){
                    $cell->setValue("1");
                });
                $sheet->cell('E10', function ($cell){
                    $cell->setValue("2");
                });
                $sheet->cell('F10', function ($cell){
                    $cell->setValue("3");
                });
                $sheet->cell('G10', function ($cell){
                    $cell->setValue("4");
                });
                $sheet->cell('H10', function ($cell){
                    $cell->setValue("5");
                });
                $sheet->cell('I10', function ($cell){
                    $cell->setValue("6");
                });
                $sheet->cell('J10', function ($cell){
                    $cell->setValue("7");
                });
                $sheet->cell('K10', function ($cell){
                    $cell->setValue("8");
                });
                $sheet->cell('L10', function ($cell){
                    $cell->setValue("9");
                });
                $sheet->cell('M10', function ($cell){
                    $cell->setValue("10");
                });
                $sheet->cell('N10', function ($cell){
                    $cell->setValue("11");
                });
                $sheet->cell('O10', function ($cell){
                    $cell->setValue("12");
                });
                $sheet->cell('P10', function ($cell){
                    $cell->setValue("13");
                });
                $sheet->cell('Q10', function ($cell){
                    $cell->setValue("14");
                });
                $sheet->cell('R10', function ($cell){
                    $cell->setValue("15");
                });
                $sheet->cell('S10', function ($cell){
                    $cell->setValue("16");
                });
                $sheet->cell('T10', function ($cell){
                    $cell->setValue("17");
                });
                $sheet->cell('U10', function ($cell){
                    $cell->setValue("18");
                });
                $sheet->cell('V10', function ($cell){
                    $cell->setValue("19");
                });
                $sheet->cell('W10', function ($cell){
                    $cell->setValue("20");
                });
                $sheet->cell('X10', function ($cell){
                    $cell->setValue("21");
                });
                $sheet->cell('Y10', function ($cell){
                    $cell->setValue("22");
                });
                $sheet->cell('Z10', function ($cell){
                    $cell->setValue("23");
                });
                $sheet->cell('AA10', function ($cell){
                    $cell->setValue("24");
                });
                $sheet->cell('AB10', function ($cell){
                    $cell->setValue("25");
                });
                $sheet->cell('AC10', function ($cell){
                    $cell->setValue("26");
                });
                $sheet->cell('AD10', function ($cell){
                    $cell->setValue("27");
                });
                $sheet->cell('AE10', function ($cell){
                    $cell->setValue("28");
                });
                $sheet->cell('AF10', function ($cell){
                    $cell->setValue("29");
                });
                $sheet->cell('AG10', function ($cell){
                    $cell->setValue("30");
                });
                $sheet->cell('AH10', function ($cell){
                    $cell->setValue("31");
                });
                /**/
                $sheet->cell('AI10', function ($cell){
                    $cell->setValue("Дни явок");
                });
                $sheet->cell('AJ10', function ($cell){
                    $cell->setValue("отработано часов");
                });
                $sheet->cell('AK10', function ($cell){
                    $cell->setValue("ночные");
                });
                $sheet->cell('AL10', function ($cell){
                    $cell->setValue("ночные ургентные");
                });
                $sheet->cell('AM10', function ($cell){
                    $cell->setValue("выходные");
                });
                $sheet->cell('AN10', function ($cell){
                    $cell->setValue("праздничные");
                });
                $sheet->cell('AO10', function ($cell){
                    $cell->setValue("вредность");
                });
                $sheet->cell('AP10', function ($cell){
                    $cell->setValue("%");
                });
                $sheet->cell('AQ10', function ($cell){
                    $cell->setValue("отработано часов");
                });
                $sheet->cell('AR10', function ($cell){
                    $cell->setValue("период работы");
                });


                /*Заполнение данными из БД*/
                $date = Carbon::create(null, $excel_month);
                $coundDay = $date->daysInMonth;
                $tmp_data = Timetable::where('user_id', $user_id)->where('department_id', $department_id)->whereBetween('date',[$date->firstOfMonth()->format('Y-m-d'), $date->lastOfMonth()->format('Y-m-d') ])->get();
                foreach($tmp_data as $value){
                    $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_days;
                    $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_hours;
                }
                $ptr = 1;
                $cell_ptr = 11; //начало данных
                foreach($data_schedules as $key => $data_schedule){
                    $sheet->cell("A$cell_ptr", function ($cell) use($ptr){
                        $cell->setValue("$ptr");
                    });
                    $sheet->cell("B$cell_ptr", function ($cell) use($key){
                        $employee = Schedule::schedule_my_employee($key);
                        $cell->setValue("$employee");
                    });
                    $sheet->cell("C$cell_ptr", function ($cell) use($key){
                        $position = Schedule::schedule_my_employee_position($key);
                        $cell->setValue("$position");
                    });
                    $ptr_date = 0;
                    foreach($data_schedules[$key] as $date => $value){
                        $arr_cell = ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH'];
                        $sheet->cell("$arr_cell[$ptr_date]$cell_ptr", function ($cell) use($value){
                            $cell->setValue("$value[1]");
                        });
                        $ptr_date++;
                    }

                    $sheet->cell("AI$cell_ptr", function ($cell) use($key, $department_id, $excel_month){
                        $quantity = Timetable::quantity($key, $department_id, $excel_month);
                            $cell->setValue("$quantity");
                    });

                    $sheet->cell("AJ$cell_ptr", function ($cell) use($key, $department_id, $excel_month){
                        $worked_out = Timetable::worked_out($key, $department_id, $excel_month);
                        $cell->setValue("$worked_out");
                    });

                    $sheet->cell("AP$cell_ptr", function ($cell) use($key, $department_id, $excel_month){
                        $combination = Timetable::combination($key, $excel_month, 1);
                        $cell->setValue("$combination");
                    });
                    $sheet->cell("AQ$cell_ptr", function ($cell) use($key, $department_id, $excel_month){
                        $combination = Timetable::combination($key, $excel_month, 2);
                        $cell->setValue("$combination");
                    });
                    $sheet->cell("AR$cell_ptr", function ($cell) use($key, $department_id, $excel_month){
                        $combination = Timetable::combination($key, $excel_month, 3);
                        $cell->setValue("$combination");
                    });
                    $ptr++;
                    $cell_ptr++;


                }
            });
        })->export('xls');
    }
}
