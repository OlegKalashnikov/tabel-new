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
                $sheet->getStyle('AC2:AH2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $sheet->mergeCells('AI2:AJ2')->setBorder('AI2:AJ2', 'thin');
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
                $sheet->getStyle('AC3:AH3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $sheet->mergeCells('AI3:AJ3')->setBorder('AI3:AJ3', 'thin');
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
                $sheet->getStyle('AC4:AH4')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $sheet->mergeCells('AI4:AJ4')->setBorder('AI4:AJ4', 'thin');
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

                $sheet->mergeCells('AI5:AJ5')->setBorder('AI5:AJ5', 'thin');
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
                $sheet->getStyle('AC6:AH6')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $sheet->mergeCells('AI6:AJ6')->setBorder('AI6:AJ6', 'thin');
                $sheet->cell('AI6', function ($cell){
                    $cell->setValue('');
                });

                $sheet->mergeCells('AA7:AH7');
                $sheet->cell('AA7', function ($cell){
                    $cell->setValue('Дата формирования документа');
                });
                $sheet->getStyle('AA7:AH7')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $sheet->mergeCells('AI7:AJ7')->setBorder('AI7:AJ7', 'thin');
                $sheet->cell('AI7', function ($cell){
                    $date = Carbon::now()->format('Y-m-d');
                    $cell->setValue("$date");
                });
                $sheet->mergeCells('A9:A10');
                $sheet->cell('A9', function($cell){
                    $cell->setValue('№ п/п');
                });
                $sheet->getStyle('A9:A10')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $sheet->mergeCells('B9:B10');
                $sheet->cell('B9', function($cell){
                    $cell->setValue('Фамилия, имя, отчество');
                });
                $sheet->getStyle('B9:B10')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $sheet->mergeCells('C9:C10');
                $sheet->cell('C9', function($cell){
                    $cell->setValue('Должность');
                });
                $sheet->getStyle('C9:C10')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $sheet->mergeCells('D9:AH9');
                $sheet->cell('D9', function ($cell){
                    $cell->setValue("Отметки о явках и неявках на работу по числам месяца");
                });
                $sheet->getStyle('D9:AH9')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->mergeCells('AI9:AO9');
                $sheet->cell('AI9', function ($cell){
                    $cell->setValue("Итого отработано за месяц");
                });
                $sheet->getStyle('AI9:AO9')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->mergeCells('AP9:AR9');
                $sheet->cell('AP9', function ($cell){
                    $cell->setValue("Совмещение");
                });
                $sheet->getStyle('AP9:AR9')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
                $sheet->getStyle('AI10')->getAlignment()->setTextRotation(90);

                $sheet->cell('AJ10', function ($cell){
                    $cell->setValue("отработано часов");
                });
                $sheet->getStyle('AJ10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AK10', function ($cell){
                    $cell->setValue("ночные");
                });
                $sheet->getStyle('AK10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AL10', function ($cell){
                    $cell->setValue("ночные ургентные");
                });
                $sheet->getStyle('AL10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AM10', function ($cell){
                    $cell->setValue("выходные");
                });
                $sheet->getStyle('AM10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AN10', function ($cell){
                    $cell->setValue("праздничные");
                });
                $sheet->getStyle('AN10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AO10', function ($cell){
                    $cell->setValue("вредность");
                });
                $sheet->getStyle('AO10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AP10', function ($cell){
                    $cell->setValue("%");
                });
                $sheet->getStyle('AP10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AQ10', function ($cell){
                    $cell->setValue("отработано часов");
                });
                $sheet->getStyle('AQ10')->getAlignment()->setTextRotation(90);
                $sheet->cell('AR10', function ($cell){
                    $cell->setValue("период работы");
                });
                $sheet->getStyle('AR10')->getAlignment()->setTextRotation(90);


                /*Заполнение данными из БД*/
                $date = Carbon::create(null, $excel_month);
                $coundDay = $date->daysInMonth;
                $tmp_data = Timetable::where('user_id', $user_id)->where('department_id', $department_id)->whereBetween('date',[$date->firstOfMonth()->format('Y-m-d'), $date->lastOfMonth()->format('Y-m-d') ])->get();
                foreach($tmp_data as $value){
                    $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_days;
                    $data_schedules[$value->my_employee_id][$value->date][] = $value->number_of_hours;
                }

                $style_border = array(
                    'borders' => array(
                        'allborders' => array(
                            'style'=>\PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'rgb'=>'696969'
                            )
                        )
                    )
                );

                $ptr = 1;
                $cell_ptr = 11; //начало данных
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getStyle("A10")->getAlignment()->setWrapText(true);
                $sheet->getColumnDimension('B')->setWidth(23);
                $sheet->getColumnDimension('C')->setWidth(23);
                /**/
                $sheet->getColumnDimension('D')->setWidth(6);
                $sheet->getColumnDimension('E')->setWidth(6);
                $sheet->getColumnDimension('F')->setWidth(6);
                $sheet->getColumnDimension('G')->setWidth(6);
                $sheet->getColumnDimension('H')->setWidth(6);
                $sheet->getColumnDimension('I')->setWidth(6);
                $sheet->getColumnDimension('J')->setWidth(6);
                $sheet->getColumnDimension('K')->setWidth(6);
                $sheet->getColumnDimension('L')->setWidth(6);
                $sheet->getColumnDimension('M')->setWidth(6);
                $sheet->getColumnDimension('N')->setWidth(6);
                $sheet->getColumnDimension('O')->setWidth(6);
                $sheet->getColumnDimension('P')->setWidth(6);
                $sheet->getColumnDimension('Q')->setWidth(6);
                $sheet->getColumnDimension('R')->setWidth(6);
                $sheet->getColumnDimension('S')->setWidth(6);
                $sheet->getColumnDimension('T')->setWidth(6);
                $sheet->getColumnDimension('U')->setWidth(6);
                $sheet->getColumnDimension('V')->setWidth(6);
                $sheet->getColumnDimension('W')->setWidth(6);
                $sheet->getColumnDimension('X')->setWidth(6);
                $sheet->getColumnDimension('Y')->setWidth(6);
                $sheet->getColumnDimension('Z')->setWidth(6);
                $sheet->getColumnDimension('AA')->setWidth(6);
                $sheet->getColumnDimension('AB')->setWidth(6);
                $sheet->getColumnDimension('AC')->setWidth(6);
                $sheet->getColumnDimension('AD')->setWidth(6);
                $sheet->getColumnDimension('AE')->setWidth(6);
                $sheet->getColumnDimension('AF')->setWidth(6);
                $sheet->getColumnDimension('AG')->setWidth(6);
                $sheet->getColumnDimension('AH')->setWidth(6);

                /**/
                $sheet->getColumnDimension('AI')->setWidth(5);
                $sheet->getColumnDimension('AJ')->setWidth(7);
                $sheet->getColumnDimension('AK')->setWidth(5);
                $sheet->getColumnDimension('AL')->setWidth(5);
                $sheet->getColumnDimension('AM')->setWidth(5);
                $sheet->getColumnDimension('AN')->setWidth(5);
                $sheet->getColumnDimension('AO')->setWidth(5);
                $sheet->getColumnDimension('AP')->setWidth(5);
                $sheet->getColumnDimension('AQ')->setWidth(5);
                $sheet->getColumnDimension('AR')->setWidth(12);
                //$sheet->getStyle('A9:AR10')->applyFromArray($style_border);
                foreach($data_schedules as $key => $data_schedule){
                    $sheet->cell("A$cell_ptr", function ($cell) use($ptr){
                        $cell->setValue("$ptr");
                    });
                    $sheet->cell("B$cell_ptr", function ($cell) use($key){
                        $employee = Schedule::schedule_my_employee($key);
                        $cell->setValue("$employee");
                    });
                    $sheet->getStyle("B$cell_ptr")->getAlignment()->setWrapText(true);
                    $sheet->cell("C$cell_ptr", function ($cell) use($key){
                        $position = Schedule::schedule_my_employee_position($key);
                        $cell->setValue("$position");
                    });
                    $sheet->getStyle("C$cell_ptr")->getAlignment()->setWrapText(true);
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
                    $sheet->getStyle("AR$cell_ptr")->getAlignment()->setWrapText(true);
                    $ptr++;
                    $cell_ptr++;
                }
                $border_cell = $cell_ptr - 1;
                $sheet->getStyle('A9:AR'.$border_cell)->applyFromArray($style_border);
            });
        })->export('xls');
    }
}
