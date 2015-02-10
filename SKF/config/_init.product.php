<?php

////////////////////////////////////////////////////////////////////
// ID_PRODUCT_TYPE_PILLAR
////////////////////////////////////////////////////////////////////

// tracciato importazione di controllo

$import_product_type_pillar = array();

$import_product_type_pillar[] = 'code';
$import_product_type_pillar[] = 'code_id';
$import_product_type_pillar[] = 'load';
$import_product_type_pillar[] = 'pull_load';
$import_product_type_pillar[] = 'bending';
$import_product_type_pillar[] = 'speed';
$import_product_type_pillar[] = 'section';
$import_product_type_pillar[] = 'stroke';
$import_product_type_pillar[] = 'retracted_length_push';
$import_product_type_pillar[] = 'retracted_length_pull';
$import_product_type_pillar[] = 'voltage';
$import_product_type_pillar[] = 'power';
$import_product_type_pillar[] = 'current';
$import_product_type_pillar[] = 'duty_cycle_intermittent';
$import_product_type_pillar[] = 'duty_cycle_short';
$import_product_type_pillar[] = 'ambient_temp';
$import_product_type_pillar[] = 'type_of_protection';
$import_product_type_pillar[] = 'type_of_control';
$import_product_type_pillar[] = 'weight';
$import_product_type_pillar[] = 'footprint';
$import_product_type_pillar[] = 'certificato';
$import_product_type_pillar[] = 'optional_e';
$import_product_type_pillar[] = 'optional_p';
$import_product_type_pillar[] = 'application_medi';
$import_product_type_pillar[] = 'application_auto';
$import_product_type_pillar[] = 'application_buil';
$import_product_type_pillar[] = 'application_offi';
$import_product_type_pillar[] = 'application_heal';
$import_product_type_pillar[] = 'image';
$import_product_type_pillar[] = 'file_pdf';
$import_product_type_pillar[] = 'file_drawing';
$import_product_type_pillar[] = 'link';

define('IMPORT_PRODUCT_TYPE_PILLAR', serialize($import_product_type_pillar));


// filtro selezione application

$filter_application_product_type_pillar = array();

$filter_application_product_type_pillar['auto'] = 'Pillar.application.Automation';
$filter_application_product_type_pillar['buil'] = 'Pillar.application.Building Automation';
$filter_application_product_type_pillar['heal'] = 'Pillar.application.Healthcare';
$filter_application_product_type_pillar['medi'] = 'Pillar.application.Medical';
$filter_application_product_type_pillar['offi'] = 'Pillar.application.Office / Home automation';

// x file pot //
$var_tmp = __('Pillar.application.Automation', true);
$var_tmp = __('Pillar.application.Building Automation', true);
$var_tmp = __('Pillar.application.Healthcare', true);
$var_tmp = __('Pillar.application.Medical', true);
$var_tmp = __('Pillar.application.Office / Home automation', true);
// x file pot //

define('FILTER_APPLICATION_PRODUCT_TYPE_PILLAR', serialize($filter_application_product_type_pillar));


// filtro selezione load

$filter_load_product_type_pillar = array();

$filter_load_product_type_pillar['800'] = 'Pillar.load.800 N';
$filter_load_product_type_pillar['1000'] = 'Pillar.load.1000 N';
$filter_load_product_type_pillar['1500'] = 'Pillar.load.1500 N';
$filter_load_product_type_pillar['1650'] = 'Pillar.load.1650 N';
$filter_load_product_type_pillar['1800'] = 'Pillar.load.1800 N';
$filter_load_product_type_pillar['2000'] = 'Pillar.load.2000 N';
$filter_load_product_type_pillar['2500'] = 'Pillar.load.2500 N';
$filter_load_product_type_pillar['3000'] = 'Pillar.load.3000 N';
$filter_load_product_type_pillar['4000'] = 'Pillar.load.4000 N';

// x file pot //
$var_tmp = __('Pillar.load.800 N', true);
$var_tmp = __('Pillar.load.1000 N', true);
$var_tmp = __('Pillar.load.1500 N', true);
$var_tmp = __('Pillar.load.1650 N', true);
$var_tmp = __('Pillar.load.1800 N', true);
$var_tmp = __('Pillar.load.2000 N', true);
$var_tmp = __('Pillar.load.2500 N', true);
$var_tmp = __('Pillar.load.3000 N', true);
$var_tmp = __('Pillar.load.4000 N', true);
// x file pot //

define('FILTER_LOAD_PRODUCT_TYPE_PILLAR', serialize($filter_load_product_type_pillar));


// filtro selezione bending

$filter_bending_product_type_pillar = array();

$filter_bending_product_type_pillar['120'] = 'Pillar.bending.120';
$filter_bending_product_type_pillar['210'] = 'Pillar.bending.210';
$filter_bending_product_type_pillar['450'] = 'Pillar.bending.450';
$filter_bending_product_type_pillar['480'] = 'Pillar.bending.480';
$filter_bending_product_type_pillar['500'] = 'Pillar.bending.500';
$filter_bending_product_type_pillar['900'] = 'Pillar.bending.900';
$filter_bending_product_type_pillar['1000'] = 'Pillar.bending.1000';
$filter_bending_product_type_pillar['2100'] = 'Pillar.bending.2100';
$filter_bending_product_type_pillar['2800'] = 'Pillar.bending.2800';

// x file pot //
$var_tmp = __('Pillar.bending.120', true);
$var_tmp = __('Pillar.bending.210', true);
$var_tmp = __('Pillar.bending.450', true);
$var_tmp = __('Pillar.bending.480', true);
$var_tmp = __('Pillar.bending.500', true);
$var_tmp = __('Pillar.bending.900', true);
$var_tmp = __('Pillar.bending.1000', true);
$var_tmp = __('Pillar.bending.2100', true);
$var_tmp = __('Pillar.bending.2800', true);
// x file pot //

define('FILTER_BENDING_PRODUCT_TYPE_PILLAR', serialize($filter_bending_product_type_pillar));


// filtro selezione speed

$filter_speed_product_type_pillar = array();

$filter_speed_product_type_pillar['-1|0'] = 'Pillar.speed.No motor';
$filter_speed_product_type_pillar['0|12'] = 'Pillar.speed.1 - 12 mm/s';
$filter_speed_product_type_pillar['12|15'] = 'Pillar.speed.13 - 15 mm/s';
$filter_speed_product_type_pillar['15|30'] = 'Pillar.speed.16 - 30 mm/s';
$filter_speed_product_type_pillar['30|35'] = 'Pillar.speed.31 - 35 mm/s';
/*
$filter_speed_product_type_pillar['1'] = '1 - 12 mm/s';
$filter_speed_product_type_pillar['13'] = '13 - 15 mm/s';
$filter_speed_product_type_pillar['16'] = '16 - 30 mm/s';
$filter_speed_product_type_pillar['31'] = '31 - 35 mm/s';
*/

// x file pot //
$var_tmp = __('Pillar.speed.No motor', true);
$var_tmp = __('Pillar.speed.1 - 12 mm/s', true);
$var_tmp = __('Pillar.speed.13 - 15 mm/s', true);
$var_tmp = __('Pillar.speed.16 - 30 mm/s', true);
$var_tmp = __('Pillar.speed.31 - 35 mm/s', true);
// x file pot //

define('FILTER_SPEED_PRODUCT_TYPE_PILLAR', serialize($filter_speed_product_type_pillar));


// filtro selezione stroke

$filter_stroke_product_type_pillar = array();

/*
$filter_stroke_product_type_pillar['0|500'] = '1 - 500 mm';
$filter_stroke_product_type_pillar['500|600'] = '501 - 600 mm';
$filter_stroke_product_type_pillar['600|700'] = '601 - 700 mm';
$filter_stroke_product_type_pillar['700|'] = '> 700 mm';
*/
$filter_stroke_product_type_pillar['1'] = 'Pillar.stroke.1 - 500 mm';
$filter_stroke_product_type_pillar['501'] = 'Pillar.stroke.501 - 600 mm';
$filter_stroke_product_type_pillar['601'] = 'Pillar.stroke.601 - 700 mm';
$filter_stroke_product_type_pillar['701'] = 'Pillar.stroke.> 700 mm';

// x file pot //
$var_tmp = __('Pillar.stroke.1 - 500 mm', true);
$var_tmp = __('Pillar.stroke.501 - 600 mm', true);
$var_tmp = __('Pillar.stroke.601 - 700 mm', true);
$var_tmp = __('Pillar.stroke.> 700 mm', true);
// x file pot //

define('FILTER_STROKE_PRODUCT_TYPE_PILLAR', serialize($filter_stroke_product_type_pillar));


// filtro selezione voltage

$filter_voltage_product_type_pillar = array();

$filter_voltage_product_type_pillar['0'] = 'Pillar.voltage.No motor';
$filter_voltage_product_type_pillar['24'] = 'Pillar.voltage.24 VDC';
$filter_voltage_product_type_pillar['120'] = 'Pillar.voltage.120 VAC';
$filter_voltage_product_type_pillar['230'] = 'Pillar.voltage.230 VAC';
$filter_voltage_product_type_pillar['500'] = 'Pillar.voltage.Multivoltage';

// x file pot //
$var_tmp = __('Pillar.voltage.No motor', true);
$var_tmp = __('Pillar.voltage.24 VDC', true);
$var_tmp = __('Pillar.voltage.120 VAC', true);
$var_tmp = __('Pillar.voltage.230 VAC', true);
$var_tmp = __('Pillar.voltage.Multivoltage', true);
// x file pot //

define('FILTER_VOLTAGE_PRODUCT_TYPE_PILLAR', serialize($filter_voltage_product_type_pillar));


// filtro selezione optional

$filter_optional_product_type_pillar = array();

$filter_optional_product_type_pillar['e'] = 'Pillar.optional.Encoder feedback';
$filter_optional_product_type_pillar['p'] = 'Pillar.optional.Potentiometer feedback';

// x file pot //
$var_tmp = __('Pillar.optional.Encoder feedback', true);
$var_tmp = __('Pillar.optional.Potentiometer feedback', true);
// x file pot //

define('FILTER_OPTIONAL_PRODUCT_TYPE_PILLAR', serialize($filter_optional_product_type_pillar));


// filtro selezione footprint

$filter_footprint_product_type_pillar = array();

$filter_footprint_product_type_pillar['80'] = 'Pillar.footprint.80';
$filter_footprint_product_type_pillar['95'] = 'Pillar.footprint.95';
$filter_footprint_product_type_pillar['130'] = 'Pillar.footprint.130';
$filter_footprint_product_type_pillar['170'] = 'Pillar.footprint.170';
$filter_footprint_product_type_pillar['220'] = 'Pillar.footprint.220';
$filter_footprint_product_type_pillar['230'] = 'Pillar.footprint.230';
$filter_footprint_product_type_pillar['270'] = 'Pillar.footprint.270';
$filter_footprint_product_type_pillar['402'] = 'Pillar.footprint.402';
$filter_footprint_product_type_pillar['500'] = 'Pillar.footprint.500';
$filter_footprint_product_type_pillar['1340'] = 'Pillar.footprint.1340';

// x file pot //
$var_tmp = __('Pillar.footprint.80', true);
$var_tmp = __('Pillar.footprint.95', true);
$var_tmp = __('Pillar.footprint.130', true);
$var_tmp = __('Pillar.footprint.170', true);
$var_tmp = __('Pillar.footprint.220', true);
$var_tmp = __('Pillar.footprint.230', true);
$var_tmp = __('Pillar.footprint.270', true);
$var_tmp = __('Pillar.footprint.402', true);
$var_tmp = __('Pillar.footprint.500', true);
$var_tmp = __('Pillar.footprint.1340', true);
// x file pot //

define('FILTER_FOOTPRINT_PRODUCT_TYPE_PILLAR', serialize($filter_footprint_product_type_pillar));


// filtro selezione certificato

$filter_certificato_product_type_pillar = array();

$filter_certificato_product_type_pillar['1'] = 'Pillar.certificato.si';
$filter_certificato_product_type_pillar['0'] = 'Pillar.certificato.no';

// x file pot //
$var_tmp = __('Pillar.certificato.si', true);
$var_tmp = __('Pillar.certificato.no', true);
// x file pot //

define('FILTER_CERTIFICATO_PRODUCT_TYPE_PILLAR', serialize($filter_certificato_product_type_pillar));



////////////////////////////////////////////////////////////////////
// ID_PRODUCT_TYPE_LINEAR
////////////////////////////////////////////////////////////////////

// tracciato importazione di controllo

$import_product_type_linear = array();

$import_product_type_linear[] = 'code';
$import_product_type_linear[] = 'code_id';
$import_product_type_linear[] = 'load';
$import_product_type_linear[] = 'pull_load';
$import_product_type_linear[] = 'speed';
$import_product_type_linear[] = 'stroke';
$import_product_type_linear[] = 'retracted_length';
$import_product_type_linear[] = 'voltage';
$import_product_type_linear[] = 'power_consumption';
$import_product_type_linear[] = 'current_consumption';
$import_product_type_linear[] = 'duty';
$import_product_type_linear[] = 'ambient_temp';
$import_product_type_linear[] = 'type_of_protection';
$import_product_type_linear[] = 'weight';
$import_product_type_linear[] = 'certificato';
$import_product_type_linear[] = 'optional_e';
$import_product_type_linear[] = 'optional_p';
$import_product_type_linear[] = 'optional_t';
$import_product_type_linear[] = 'optional_w';
$import_product_type_linear[] = 'optional_l';
$import_product_type_linear[] = 'optional_u';
$import_product_type_linear[] = 'optional_i';
$import_product_type_linear[] = 'optional_s';
$import_product_type_linear[] = 'application_auto';
$import_product_type_linear[] = 'application_medi';
$import_product_type_linear[] = 'application_fobe';
$import_product_type_linear[] = 'application_pupa';
$import_product_type_linear[] = 'application_oilg';
$import_product_type_linear[] = 'application_buil';
$import_product_type_linear[] = 'application_offh';
$import_product_type_linear[] = 'application_sola';
$import_product_type_linear[] = 'application_heal';
$import_product_type_linear[] = 'application_stee';
$import_product_type_linear[] = 'application_offi';
$import_product_type_linear[] = 'image';
$import_product_type_linear[] = 'file_pdf';
$import_product_type_linear[] = 'file_drawing';
$import_product_type_linear[] = 'link';
$import_product_type_linear[] = 'verify_performance';
$import_product_type_linear[] = 'self_locking';

define('IMPORT_PRODUCT_TYPE_LINEAR', serialize($import_product_type_linear));


// filtro selezione application

$filter_application_product_type_linear = array();

$filter_application_product_type_linear['auto'] = 'Linear.application.Automation/Handling';
$filter_application_product_type_linear['buil'] = 'Linear.application.Building Automation';
$filter_application_product_type_linear['fobe'] = 'Linear.application.Food & Beverage';
$filter_application_product_type_linear['heal'] = 'Linear.application.Healthcare';
$filter_application_product_type_linear['medi'] = 'Linear.application.Medical';
$filter_application_product_type_linear['offh'] = 'Linear.application.Off-Highway';
$filter_application_product_type_linear['offi'] = 'Linear.application.Office / Home automation';
$filter_application_product_type_linear['oilg'] = 'Linear.application.Oil & Gas';
$filter_application_product_type_linear['pupa'] = 'Linear.application.Pulp & Paper';
$filter_application_product_type_linear['sola'] = 'Linear.application.Solar';
$filter_application_product_type_linear['stee'] = 'Linear.application.Steel/Heavy Industry';

// x file pot //
$var_tmp = __('Linear.application.Automation/Handling', true);
$var_tmp = __('Linear.application.Building Automation', true);
$var_tmp = __('Linear.application.Food & Beverage', true);
$var_tmp = __('Linear.application.Healthcare', true);
$var_tmp = __('Linear.application.Medical', true);
$var_tmp = __('Linear.application.Off-Highway', true);
$var_tmp = __('Linear.application.Office / Home automation', true);
$var_tmp = __('Linear.application.Oil & Gas', true);
$var_tmp = __('Linear.application.Pulp & Paper', true);
$var_tmp = __('Linear.application.Solar', true);
$var_tmp = __('Linear.application.Steel/Heavy Industry', true);
// x file pot //

define('FILTER_APPLICATION_PRODUCT_TYPE_LINEAR', serialize($filter_application_product_type_linear));


// filtro selezione load

$filter_load_product_type_linear = array();

$filter_load_product_type_linear['120'] = 'Linear.load.120 N';
$filter_load_product_type_linear['240'] = 'Linear.load.240 N';
$filter_load_product_type_linear['500'] = 'Linear.load.500 N';
$filter_load_product_type_linear['600'] = 'Linear.load.600 N';
$filter_load_product_type_linear['750'] = 'Linear.load.750 N';
$filter_load_product_type_linear['1000'] = 'Linear.load.1000 N';
$filter_load_product_type_linear['1200'] = 'Linear.load.1200 N';
$filter_load_product_type_linear['1500'] = 'Linear.load.1500 N';
$filter_load_product_type_linear['2000'] = 'Linear.load.2000 N';
$filter_load_product_type_linear['2500'] = 'Linear.load.2500 N';
$filter_load_product_type_linear['3000'] = 'Linear.load.3000 N';
$filter_load_product_type_linear['3500'] = 'Linear.load.3500 N';
$filter_load_product_type_linear['4000'] = 'Linear.load.4000 N';
$filter_load_product_type_linear['4500'] = 'Linear.load.4500 N';
$filter_load_product_type_linear['6000'] = 'Linear.load.6000 N';
$filter_load_product_type_linear['8000'] = 'Linear.load.8000 N';
$filter_load_product_type_linear['10000'] = 'Linear.load.10000 N';
$filter_load_product_type_linear['12000'] = 'Linear.load.12000 N';
$filter_load_product_type_linear['15000'] = 'Linear.load.15000 N';
$filter_load_product_type_linear['20000'] = 'Linear.load.20000 N';
$filter_load_product_type_linear['25000'] = 'Linear.load.25000 N';
$filter_load_product_type_linear['30000'] = 'Linear.load.30000 N';
$filter_load_product_type_linear['50000'] = 'Linear.load.50000 N';

// x file pot //
$var_tmp = __('Linear.load.120 N', true);
$var_tmp = __('Linear.load.240 N', true);
$var_tmp = __('Linear.load.500 N', true);
$var_tmp = __('Linear.load.600 N', true);
$var_tmp = __('Linear.load.750 N', true);
$var_tmp = __('Linear.load.1000 N', true);
$var_tmp = __('Linear.load.1200 N', true);
$var_tmp = __('Linear.load.1500 N', true);
$var_tmp = __('Linear.load.2000 N', true);
$var_tmp = __('Linear.load.2500 N', true);
$var_tmp = __('Linear.load.3000 N', true);
$var_tmp = __('Linear.load.3500 N', true);
$var_tmp = __('Linear.load.4000 N', true);
$var_tmp = __('Linear.load.4500 N', true);
$var_tmp = __('Linear.load.6000 N', true);
$var_tmp = __('Linear.load.8000 N', true);
$var_tmp = __('Linear.load.10000 N', true);
$var_tmp = __('Linear.load.12000 N', true);
$var_tmp = __('Linear.load.15000 N', true);
$var_tmp = __('Linear.load.20000 N', true);
$var_tmp = __('Linear.load.25000 N', true);
$var_tmp = __('Linear.load.30000 N', true);
$var_tmp = __('Linear.load.50000 N', true);
// x file pot //

define('FILTER_LOAD_PRODUCT_TYPE_LINEAR', serialize($filter_load_product_type_linear));


// filtro selezione speed

$filter_speed_product_type_linear = array();

$filter_speed_product_type_linear['0|5'] = 'Linear.speed.1 - 5 mm/s';
$filter_speed_product_type_linear['5|10'] = 'Linear.speed.6 - 10 mm/s';
$filter_speed_product_type_linear['10|15'] = 'Linear.speed.11 - 15 mm/s';
$filter_speed_product_type_linear['15|20'] = 'Linear.speed.16 - 20 mm/s';
$filter_speed_product_type_linear['20|30'] = 'Linear.speed.21 - 30 mm/s';
$filter_speed_product_type_linear['30|50'] = 'Linear.speed.31 - 50 mm/s';
$filter_speed_product_type_linear['50|100'] = 'Linear.speed.51 - 100 mm/s';
$filter_speed_product_type_linear['100|200'] = 'Linear.speed.101 - 200 mm/s';
$filter_speed_product_type_linear['200|500'] = 'Linear.speed.201 - 500 mm/s';
$filter_speed_product_type_linear['500|1000'] = 'Linear.speed.501 - 1000 mm/s';
$filter_speed_product_type_linear['1000|'] = 'Linear.speed.> 1000 mm/s';
/*
$filter_speed_product_type_linear['1'] = '1 - 5 mm/s';
$filter_speed_product_type_linear['6'] = '6 - 10 mm/s';
$filter_speed_product_type_linear['11'] = '11 - 15 mm/s';
$filter_speed_product_type_linear['16'] = '16 - 20 mm/s';
$filter_speed_product_type_linear['21'] = '21 - 30 mm/s';
$filter_speed_product_type_linear['31'] = '31 - 50 mm/s';
$filter_speed_product_type_linear['51'] = '51 - 100 mm/s';
$filter_speed_product_type_linear['101'] = '101 - 200 mm/s';
$filter_speed_product_type_linear['201'] = '201 - 500 mm/s';
$filter_speed_product_type_linear['501'] = '501 - 1000 mm/s';
$filter_speed_product_type_linear['1001'] = '> 1000 mm/s';
*/

// x file pot //
$var_tmp = __('Linear.speed.1 - 5 mm/s', true);
$var_tmp = __('Linear.speed.6 - 10 mm/s', true);
$var_tmp = __('Linear.speed.11 - 15 mm/s', true);
$var_tmp = __('Linear.speed.16 - 20 mm/s', true);
$var_tmp = __('Linear.speed.21 - 30 mm/s', true);
$var_tmp = __('Linear.speed.31 - 50 mm/s', true);
$var_tmp = __('Linear.speed.51 - 100 mm/s', true);
$var_tmp = __('Linear.speed.101 - 200 mm/s', true);
$var_tmp = __('Linear.speed.201 - 500 mm/s', true);
$var_tmp = __('Linear.speed.501 - 1000 mm/s', true);
$var_tmp = __('Linear.speed.> 1000 mm/s', true);

// x file pot //

define('FILTER_SPEED_PRODUCT_TYPE_LINEAR', serialize($filter_speed_product_type_linear));


// filtro selezione stroke

$filter_stroke_product_type_linear = array();

/*
$filter_stroke_product_type_linear['0|200'] = '1 - 200 mm';
$filter_stroke_product_type_linear['200|300'] = '201 - 300 mm';
$filter_stroke_product_type_linear['300|400'] = '301 - 400 mm';
$filter_stroke_product_type_linear['400|500'] = '401 - 500 mm';
$filter_stroke_product_type_linear['500|600'] = '501 - 600 mm';
$filter_stroke_product_type_linear['600|700'] = '601 - 700 mm';
$filter_stroke_product_type_linear['700|800'] = '701 - 800 mm';
$filter_stroke_product_type_linear['800|1000'] = '801 - 1000 mm';
$filter_stroke_product_type_linear['1000|'] = '> 1000 mm';
*/
$filter_stroke_product_type_linear['1'] = 'Linear.stroke.1 - 200 mm';
$filter_stroke_product_type_linear['201'] = 'Linear.stroke.201 - 300 mm';
$filter_stroke_product_type_linear['301'] = 'Linear.stroke.301 - 400 mm';
$filter_stroke_product_type_linear['401'] = 'Linear.stroke.401 - 500 mm';
$filter_stroke_product_type_linear['501'] = 'Linear.stroke.501 - 600 mm';
$filter_stroke_product_type_linear['601'] = 'Linear.stroke.601 - 700 mm';
$filter_stroke_product_type_linear['701'] = 'Linear.stroke.701 - 800 mm';
$filter_stroke_product_type_linear['801'] = 'Linear.stroke.801 - 1000 mm';
$filter_stroke_product_type_linear['1001'] = 'Linear.stroke.> 1000 mm';

// x file pot //
$var_tmp = __('Linear.stroke.1 - 200 mm', true);
$var_tmp = __('Linear.stroke.201 - 300 mm', true);
$var_tmp = __('Linear.stroke.301 - 400 mm', true);
$var_tmp = __('Linear.stroke.401 - 500 mm', true);
$var_tmp = __('Linear.stroke.501 - 600 mm', true);
$var_tmp = __('Linear.stroke.601 - 700 mm', true);
$var_tmp = __('Linear.stroke.701 - 800 mm', true);
$var_tmp = __('Linear.stroke.801 - 1000 mm', true);
$var_tmp = __('Linear.stroke.> 1000 mm', true);
// x file pot //

define('FILTER_STROKE_PRODUCT_TYPE_LINEAR', serialize($filter_stroke_product_type_linear));


// filtro selezione duty

$filter_duty_product_type_linear = array();

$filter_duty_product_type_linear['0|25'] = 'Linear.duty.1 - 25%';
$filter_duty_product_type_linear['25|70'] = 'Linear.duty.26 - 70%';
$filter_duty_product_type_linear['70|100'] = 'Linear.duty.71 - 100%';

// x file pot //
$var_tmp = __('Linear.duty.1 - 25%', true);
$var_tmp = __('Linear.duty.26 - 70%', true);
$var_tmp = __('Linear.duty.71 - 100%', true);

// x file pot //

define('FILTER_DUTY_PRODUCT_TYPE_LINEAR', serialize($filter_duty_product_type_linear));


// filtro selezione voltage

$filter_voltage_product_type_linear = array();

$filter_voltage_product_type_linear['0'] = 'Linear.voltage.No motor';
$filter_voltage_product_type_linear['12'] = 'Linear.voltage.12 VDC';
$filter_voltage_product_type_linear['24'] = 'Linear.voltage.24 VDC';
$filter_voltage_product_type_linear['36'] = 'Linear.voltage.36 VDC';
$filter_voltage_product_type_linear['110'] = 'Linear.voltage.110 VAC';
$filter_voltage_product_type_linear['230'] = 'Linear.voltage.230 VAC';
$filter_voltage_product_type_linear['400'] = 'Linear.voltage.400 VAC';

// x file pot //
$var_tmp = __('Linear.voltage.No motor', true);
$var_tmp = __('Linear.voltage.12 VDC', true);
$var_tmp = __('Linear.voltage.24 VDC', true);
$var_tmp = __('Linear.voltage.36 VDC', true);
$var_tmp = __('Linear.voltage.110 VAC', true);
$var_tmp = __('Linear.voltage.230 VAC', true);
$var_tmp = __('Linear.voltage.400 VAC', true);
// x file pot //

define('FILTER_VOLTAGE_PRODUCT_TYPE_LINEAR', serialize($filter_voltage_product_type_linear));


// filtro selezione optional

$filter_optional_product_type_linear = array();

$filter_optional_product_type_linear['e'] = 'Linear.optional.Encoder feedback';
$filter_optional_product_type_linear['p'] = 'Linear.optional.Potentiometer feedback';
$filter_optional_product_type_linear['s'] = 'Linear.optional.Limit switches';
$filter_optional_product_type_linear['i'] = 'Linear.optional.I-shape';
$filter_optional_product_type_linear['u'] = 'Linear.optional.U-shape';
$filter_optional_product_type_linear['l'] = 'Linear.optional.L-shape';
$filter_optional_product_type_linear['w'] = 'Linear.optional.Water resistant';
$filter_optional_product_type_linear['t'] = 'Linear.optional.Extended temperature range';

// x file pot //
$var_tmp = __('Linear.optional.Encoder feedback', true);
$var_tmp = __('Linear.optional.Potentiometer feedback', true);
$var_tmp = __('Linear.optional.Limit switches', true);
$var_tmp = __('Linear.optional.I-shape', true);
$var_tmp = __('Linear.optional.U-shape', true);
$var_tmp = __('Linear.optional.L-shape', true);
$var_tmp = __('Linear.optional.Water resistant', true);
$var_tmp = __('Linear.optional.Extended temperature range', true);
// x file pot //

define('FILTER_OPTIONAL_PRODUCT_TYPE_LINEAR', serialize($filter_optional_product_type_linear));


// filtro selezione certificato

$filter_certificato_product_type_linear = array();

$filter_certificato_product_type_linear['1'] = 'Linear.certificato.si';
$filter_certificato_product_type_linear['0'] = 'Linear.certificato.no';

// x file pot //
$var_tmp = __('Linear.certificato.si', true);
$var_tmp = __('Linear.certificato.no', true);
// x file pot //

define('FILTER_CERTIFICATO_PRODUCT_TYPE_LINEAR', serialize($filter_certificato_product_type_linear));


// filtro selezione self_locking

$filter_self_locking_product_type_linear = array();

$filter_self_locking_product_type_linear['1'] = 'Linear.self_locking.si';
$filter_self_locking_product_type_linear['0'] = 'Linear.self_locking.no';

// x file pot //
$var_tmp = __('Linear.self_locking.si', true);
$var_tmp = __('Linear.self_locking.no', true);
// x file pot //

define('FILTER_SELF_LOCKING_PRODUCT_TYPE_LINEAR', serialize($filter_self_locking_product_type_linear));




////////////////////////////////////////////////////////////////////
// ID_PRODUCT_TYPE_ROTARY
////////////////////////////////////////////////////////////////////

// tracciato importazione di controllo

$import_product_type_rotary = array();

$import_product_type_rotary[] = 'code';
$import_product_type_rotary[] = 'code_id';
$import_product_type_rotary[] = 'load';
$import_product_type_rotary[] = 'speed';
$import_product_type_rotary[] = 'size';
$import_product_type_rotary[] = 'voltage';
$import_product_type_rotary[] = 'optional_e';
$import_product_type_rotary[] = 'optional_m';
$import_product_type_rotary[] = 'optional_x';
$import_product_type_rotary[] = 'optional_t';
$import_product_type_rotary[] = 'optional_o';
$import_product_type_rotary[] = 'application_auto';
$import_product_type_rotary[] = 'application_oilg';
$import_product_type_rotary[] = 'application_cars';
$import_product_type_rotary[] = 'application_sola';
$import_product_type_rotary[] = 'application_heal';
$import_product_type_rotary[] = 'image';
$import_product_type_rotary[] = 'file_pdf';
$import_product_type_rotary[] = 'file_drawing';
$import_product_type_rotary[] = 'link';

define('IMPORT_PRODUCT_TYPE_ROTARY', serialize($import_product_type_rotary));


// filtro selezione application

$filter_application_product_type_rotary = array();

$filter_application_product_type_rotary['auto'] = 'Rotary.application.Automation';
$filter_application_product_type_rotary['cars'] = 'Rotary.application.Automotive';
$filter_application_product_type_rotary['heal'] = 'Rotary.application.Healthcare';
$filter_application_product_type_rotary['oilg'] = 'Rotary.application.Oil & Gas';
$filter_application_product_type_rotary['sola'] = 'Rotary.application.Solar';

// x file pot //
$var_tmp = __('Rotary.application.Automation', true);
$var_tmp = __('Rotary.application.Automotive', true);
$var_tmp = __('Rotary.application.Healthcare', true);
$var_tmp = __('Rotary.application.Oil & Gas', true);
$var_tmp = __('Rotary.application.Solar', true);
// x file pot //

define('FILTER_APPLICATION_PRODUCT_TYPE_ROTARY', serialize($filter_application_product_type_rotary));


// filtro selezione load

$filter_load_product_type_rotary = array();

$filter_load_product_type_rotary['18'] = 'Rotary.load.18 N';
$filter_load_product_type_rotary['19'] = 'Rotary.load.19 N';
$filter_load_product_type_rotary['22'] = 'Rotary.load.22 N';
$filter_load_product_type_rotary['34'] = 'Rotary.load.34 N';
$filter_load_product_type_rotary['38'] = 'Rotary.load.38 N';
$filter_load_product_type_rotary['40'] = 'Rotary.load.40 N';
$filter_load_product_type_rotary['53'] = 'Rotary.load.53 N';
$filter_load_product_type_rotary['55'] = 'Rotary.load.55 N';
$filter_load_product_type_rotary['60'] = 'Rotary.load.60 N';
$filter_load_product_type_rotary['70'] = 'Rotary.load.70 N';
$filter_load_product_type_rotary['100'] = 'Rotary.load.100 N';
$filter_load_product_type_rotary['105'] = 'Rotary.load.105 N';

// x file pot //
$var_tmp = __('Rotary.load.18 N', true);
$var_tmp = __('Rotary.load.19 N', true);
$var_tmp = __('Rotary.load.22 N', true);
$var_tmp = __('Rotary.load.34 N', true);
$var_tmp = __('Rotary.load.38 N', true);
$var_tmp = __('Rotary.load.40 N', true);
$var_tmp = __('Rotary.load.53 N', true);
$var_tmp = __('Rotary.load.55 N', true);
$var_tmp = __('Rotary.load.60 N', true);
$var_tmp = __('Rotary.load.70 N', true);
$var_tmp = __('Rotary.load.100 N', true);
$var_tmp = __('Rotary.load.105 N', true);
// x file pot //

define('FILTER_LOAD_PRODUCT_TYPE_ROTARY', serialize($filter_load_product_type_rotary));


// filtro selezione speed

$filter_speed_product_type_rotary = array();

$filter_speed_product_type_rotary['0|13'] = 'Rotary.speed.1 - 13 deg/s';
$filter_speed_product_type_rotary['13|30'] = 'Rotary.speed.14 - 30 deg/s';
$filter_speed_product_type_rotary['30|58'] = 'Rotary.speed.31 - 58 deg/s';
$filter_speed_product_type_rotary['58|110'] = 'Rotary.speed.59 - 110 deg/s';
/*
$filter_speed_product_type_rotary['1'] = '1 - 13 deg/s';
$filter_speed_product_type_rotary['14'] = '14 - 30 deg/s';
$filter_speed_product_type_rotary['31'] = '31 - 58 deg/s';
$filter_speed_product_type_rotary['59'] = '59 - 110 deg/s';
*/

// x file pot //
$var_tmp = __('Rotary.speed.1 - 13 deg/s', true);
$var_tmp = __('Rotary.speed.14 - 30 deg/s', true);
$var_tmp = __('Rotary.speed.31 - 58 deg/s', true);
$var_tmp = __('Rotary.speed.59 - 110 deg/s', true);
// x file pot //

define('FILTER_SPEED_PRODUCT_TYPE_ROTARY', serialize($filter_speed_product_type_rotary));


// filtro selezione voltage

$filter_voltage_product_type_rotary = array();

$filter_voltage_product_type_rotary['12'] = 'Rotary.voltage.12 VDC';
$filter_voltage_product_type_rotary['24'] = 'Rotary.voltage.24 VDC';
$filter_voltage_product_type_rotary['90'] = 'Rotary.voltage.90 VDC';
$filter_voltage_product_type_rotary['120'] = 'Rotary.voltage.120 VAC';
$filter_voltage_product_type_rotary['230'] = 'Rotary.voltage.230 VAC';

// x file pot //
$var_tmp = __('Rotary.voltage.12 VDC', true);
$var_tmp = __('Rotary.voltage.24 VDC', true);
$var_tmp = __('Rotary.voltage.90 VDC', true);
$var_tmp = __('Rotary.voltage.120 VAC', true);
$var_tmp = __('Rotary.voltage.230 VAC', true);
// x file pot //

define('FILTER_VOLTAGE_PRODUCT_TYPE_ROTARY', serialize($filter_voltage_product_type_rotary));


// filtro selezione optional

$filter_optional_product_type_rotary = array();

$filter_optional_product_type_rotary['e'] = 'Rotary.optional.Encoder feedback';
$filter_optional_product_type_rotary['m'] = 'Rotary.optional.Mechanical endstops';
$filter_optional_product_type_rotary['x'] = 'Rotary.optional.Internal endswitches';
$filter_optional_product_type_rotary['t'] = 'Rotary.optional.Extended temperature range';
$filter_optional_product_type_rotary['o'] = 'Rotary.optional.Optional handcrank';

// x file pot //
$var_tmp = __('Rotary.optional.Encoder feedback', true);
$var_tmp = __('Rotary.optional.Mechanical endstops', true);
$var_tmp = __('Rotary.optional.Internal endswitches', true);
$var_tmp = __('Rotary.optional.Extended temperature range', true);
$var_tmp = __('Rotary.optional.Optional handcrank', true);
// x file pot //

define('FILTER_OPTIONAL_PRODUCT_TYPE_ROTARY', serialize($filter_optional_product_type_rotary));



////////////////////////////////////////////////////////////////////
// ID_PRODUCT_TYPE_CONTROL
////////////////////////////////////////////////////////////////////

// tracciato importazione di controllo

$import_product_type_control = array();

$import_product_type_control[] = 'code';
$import_product_type_control[] = 'code_id';
$import_product_type_control[] = 'motor';
$import_product_type_control[] = 'operating_device_ports';
$import_product_type_control[] = 'battery_ports';
$import_product_type_control[] = 'limit_switch_ports';
$import_product_type_control[] = 'single_fault_safety';
$import_product_type_control[] = 'encoder_processing';
$import_product_type_control[] = 'input';
$import_product_type_control[] = 'frequency';
$import_product_type_control[] = 'input_current_max';
$import_product_type_control[] = 'standby_power';
$import_product_type_control[] = 'output_voltage';
$import_product_type_control[] = 'output';
$import_product_type_control[] = 'duty_cycle_intermittent';
$import_product_type_control[] = 'duty_cycle_short_time';
$import_product_type_control[] = 'ambient_temperature';
$import_product_type_control[] = 'humidity';
$import_product_type_control[] = 'type_of_protection';
$import_product_type_control[] = 'approvals';
$import_product_type_control[] = 'weight_without_battery';
$import_product_type_control[] = 'functionality_b';
$import_product_type_control[] = 'functionality_z';
$import_product_type_control[] = 'functionality_p';
$import_product_type_control[] = 'functionality_c';
$import_product_type_control[] = 'application_auto';
$import_product_type_control[] = 'application_hoof';
$import_product_type_control[] = 'application_medi';
$import_product_type_control[] = 'application_buil';
$import_product_type_control[] = 'application_heal';
$import_product_type_control[] = 'image';
$import_product_type_control[] = 'file_pdf';
$import_product_type_control[] = 'file_drawing';
$import_product_type_control[] = 'link';

define('IMPORT_PRODUCT_TYPE_CONTROL', serialize($import_product_type_control));


// filtro selezione application

$filter_application_product_type_control = array();

$filter_application_product_type_control['auto'] = 'Control.application.Automation';
$filter_application_product_type_control['buil'] = 'Control.application.Building Automation';
$filter_application_product_type_control['hoof'] = 'Control.application.Home / Office';
$filter_application_product_type_control['heal'] = 'Control.application.Healthcare';
$filter_application_product_type_control['medi'] = 'Control.application.Medical';

// x file pot //
$var_tmp = __('Control.application.Automation', true);
$var_tmp = __('Control.application.Building Automation', true);
$var_tmp = __('Control.application.Home / Office', true);
$var_tmp = __('Control.application.Healthcare', true);
$var_tmp = __('Control.application.Medical', true);
// x file pot //

define('FILTER_APPLICATION_PRODUCT_TYPE_CONTROL', serialize($filter_application_product_type_control));


// filtro selezione motor

$filter_motor_product_type_control = array();

$filter_motor_product_type_control['1'] = 'Control.motor.1';
$filter_motor_product_type_control['2'] = 'Control.motor.2';
$filter_motor_product_type_control['3'] = 'Control.motor.3';
$filter_motor_product_type_control['4'] = 'Control.motor.4';
$filter_motor_product_type_control['5'] = 'Control.motor.5';
$filter_motor_product_type_control['6'] = 'Control.motor.6';

// x file pot //
$var_tmp = __('Control.motor.1', true);
$var_tmp = __('Control.motor.2', true);
$var_tmp = __('Control.motor.3', true);
$var_tmp = __('Control.motor.4', true);
$var_tmp = __('Control.motor.5', true);
$var_tmp = __('Control.motor.6', true);
// x file pot //

define('FILTER_MOTOR_PRODUCT_TYPE_CONTROL', serialize($filter_motor_product_type_control));


// filtro selezione output

$filter_output_product_type_control = array();

$filter_output_product_type_control['3'] = 'Control.output.up to 24 VDC/ 3 A @ 10%';
$filter_output_product_type_control['7'] = 'Control.output.up to 24 VDC/ 7 A @ 10%';
$filter_output_product_type_control['9'] = 'Control.output.up to 24 VDC/ 9 A @ 10%';
$filter_output_product_type_control['10'] = 'Control.output.up to 24 VDC/ 10 A @ 10%';
$filter_output_product_type_control['11'] = 'Control.output.up to 24 VDC/ 11 A @ 10%';
$filter_output_product_type_control['18'] = 'Control.output.up to 24 VDC/ 18 A @ 10%';
$filter_output_product_type_control['30'] = 'Control.output.up to 24 VDC/ 30 A @ 10%';
$filter_output_product_type_control['120'] = 'Control.output.up to 120 VAC/ x A';
$filter_output_product_type_control['230'] = 'Control.output.up to 230 VAC/ x A';

// x file pot //
$var_tmp = __('Control.output.up to 24 VDC/ 3 A @ 10%', true);
$var_tmp = __('Control.output.up to 24 VDC/ 7 A @ 10%', true);
$var_tmp = __('Control.output.up to 24 VDC/ 9 A @ 10%', true);
$var_tmp = __('Control.output.up to 24 VDC/ 10 A @ 10%', true);
$var_tmp = __('Control.output.up to 24 VDC/ 11 A @ 10%', true);
$var_tmp = __('Control.output.up to 24 VDC/ 18 A @ 10%', true);
$var_tmp = __('Control.output.up to 24 VDC/ 30 A @ 10%', true);
$var_tmp = __('Control.output.up to 120 VAC/ x A', true);
$var_tmp = __('Control.output.up to 230 VAC/ x A', true);
// x file pot //

define('FILTER_OUTPUT_PRODUCT_TYPE_CONTROL', serialize($filter_output_product_type_control));


// filtro selezione input

$filter_input_product_type_control = array();

$filter_input_product_type_control['24'] = 'Control.input.24 VDC';
$filter_input_product_type_control['120'] = 'Control.input.120 VAC';
$filter_input_product_type_control['230'] = 'Control.input.230 VAC';

// x file pot //
$var_tmp = __('Control.input.24 VDC', true);
$var_tmp = __('Control.input.120 VAC', true);
$var_tmp = __('Control.input.230 VAC', true);
// x file pot //

define('FILTER_INPUT_PRODUCT_TYPE_CONTROL', serialize($filter_input_product_type_control));


// filtro selezione functionality

$filter_functionality_product_type_control = array();

$filter_functionality_product_type_control['b'] = 'Control.functionality.Basic Function';
$filter_functionality_product_type_control['c'] = 'Control.functionality.Battery operation';
$filter_functionality_product_type_control['p'] = 'Control.functionality.Potentiometer processing';
$filter_functionality_product_type_control['z'] = 'Control.functionality.Syncronous movement';

// x file pot //
$var_tmp = __('Control.functionality.Basic Function', true);
$var_tmp = __('Control.functionality.Battery operation', true);
$var_tmp = __('Control.functionality.Potentiometer processing', true);
$var_tmp = __('Control.functionality.Syncronous movement', true);
// x file pot //

define('FILTER_FUNCTIONALITY_PRODUCT_TYPE_CONTROL', serialize($filter_functionality_product_type_control));



////////////////////////////////////////////////////////////////////
// IMPORT_PRODUCT_TYPE_ACCESSORY
////////////////////////////////////////////////////////////////////

// tracciato importazione di controllo

$import_product_type_accessory = array();

$import_product_type_accessory[] = 'code';
$import_product_type_accessory[] = 'power';
$import_product_type_accessory[] = 'channels';
$import_product_type_accessory[] = 'type_of_protection';
$import_product_type_accessory[] = 'colour';
$import_product_type_accessory[] = 'img';
$import_product_type_accessory[] = 'file_pdf';
$import_product_type_accessory[] = 'file_drawing';
$import_product_type_accessory[] = 'link';

define('IMPORT_PRODUCT_TYPE_ACCESSORY', serialize($import_product_type_accessory));



////////////////////////////////////////////////////////////////////
// IMPORT_PRODUCT_TYPE_ASSOCIATION
////////////////////////////////////////////////////////////////////

// tracciato importazione di controllo

$import_product_type_association = array();

$import_product_type_association[] = 'product_code_from';
$import_product_type_association[] = 'product_line_from';
$import_product_type_association[] = 'product_code_to';
$import_product_type_association[] = 'product_line_to';

define('IMPORT_PRODUCT_TYPE_ASSOCIATION', serialize($import_product_type_association));


?>