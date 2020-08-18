<?php

/* Prefixes for Identifiers */

$empid = "EM";
$bookingid = "BK";
$agentid = "AG";
$hotelid = "HT";
$invoiceid = "IN";
$customerid = "CU";
$supplierid = "SP";
$materialid = "MT";
$orderid = "OR";
$poid = "PO";
$equipid = "EQ";
$jobid = "JB";
$collectionid = "CL";
$quoteid = "QU";
$vehicleid = "VH";
$modelc = "MC";

/* ASSIGNMENT IDS PREFIXES */

$asveh = "ASV";
$asjob = "ASJ";
$aspo = "ASP";
$asacc = "ASC";
$asequ = "ASE";


/* Throw the identifiers into an array */

$identifier = array($empid, $bookingid, $agentid, $hotelid, $invoiceid, $customerid, $supplierid, $materialid, $orderid, $poid, $equipid, $jobid, $collectionid, $quoteid, $vehicleid, $modelc, $asveh, $asjob, $aspo, $asacc, $asequ);


$i=0;

foreach ($identifier as $id){

/* Create a new array for each identifier with random entries */

$arrayname = $id.'arr';
$$arrayname = array();

for($i = 0; $i < 20; ++$i) {

$random_number = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) );
$newmem = $id.$random_number;


/* If it's a dupe take one off the counter */

if (in_array($newmem, ${$arrayname})) {
$i = $i-1;
} else {
${$arrayname}[]=$newmem;
}

}
${$arrayname} = array_filter(${$arrayname});
next;
}

/* We now have arrays for each identifier with 20 random strings - array names are in the format EMarr */



/* Random strings to string together later */

$titles = array("Mr","Mrs","Dr","Prof","Rev","Ms");
$fns = array("Susan","Jeff","Peter","Caroline","Emma","Simon","Alex","Nick","Rajesh","Surrinder","Jane","Jess","Andrew","Brad","Betty","Monica","Barney","Robin","Kyle","Stan","Alison","Mindy","Boyd","Lewis","Delroy","Anttirnet", "Carnil", "Estiv", "Halt", "Hoijof", "Laen", "Lisiern", "Berin", "Ton", "Shome", "Regit","Lurin", "Maers", "Musten", "Oanei", "Raesh", "Terio", "Unt", "Ust", "Redik", "James", "Loki", "Tem", "Regot","Josh", "Tom" ,"Jei", "Lioth","Aekkein", "Erna", "Gica", "Iris", "Laen", "Oanei", "Urusla", "Unt", "Zy", "Giny", "Teni", "Tania",
	"Tenisa", "Falish", "Tirs", "Bera", "Boria", "Terkia", "Tronash", "Si", "Gi", "Ti", "Fi", "Di", "Mi", "Peli", "Irnia", "Beth",
   "Riven", "Vi", "Lio", "Nayeli");
$sns = array("Meadows","Peters","Thumb","Collins","Marsh","Mundowski","Shah","Chen","Matthews","Oliver","Bretton","Tomkins","Watts","Howard","Smith","Jones","Tennant","Ling","Gill","Vinekar","Golpeo", "Anorda", "Severnin", "Part", "Kek-vek-loah", "Vaen", "Nerivin", "Haeshi", "Vin-ti-selh",
	"Ver-to", "Vintoret", "Da Teri", "Von Bien", "Maer", "Serisn", "Vintaren", "Bertis", "Tetirit", "Tornet", "Bellabi",
	"Geron", "Tornes", "Gorez", "Lorez", "Gareth");
$firstbit = array("Great", "Big", "Blue", "Black", "Greay", "Nordic", "Rapid", "Shadow", "Violet", "White", "Gold", "Silver",
	"Bronze", "Iron", "Stone", "Water", "Rose", "Cold", "Cor", "Coast", "Bright", "Well", "Butter", "Dork", "Wind", "Orba", "North",
	"Wolf", "South", "East", "West","Main","Bur","Han");

$secondbit = array("shore", "size", "port", "fox", "ham", "mill", "mere", "gate", "bush", "bank", "way", "dedge",
	"keep", "cliff", "row", "mount", "river", "sea", "fall", "flea", "wald", "crest", "wick", "well", "mead");

$street = array("Rd","Street","Crescent","Place","Junction","Pass","Close","Way");	
$country = array("England","Scotland","Wales","Ireland","France","Spain","Italy","Germany");	

$adjs = array("Big","Friendly","Royal","Super","Premiere","Elite");
$compf = array("Green","Gardens","Gardening","Gardeners","Bush","Tree");
$compn = array("Supplies","Material","Solutions","Gifts","Genie","Monkey","Works");
$holsf = array ("Business","Travel","Hotel","Getaway","Wander");
$holsn = array("Destinations","Adventures","Bookings","Breaks","Travels");
$makes = array("JCB","Toyota","Suzuki","Delorian","Stanier","Vauxhall");
$cmodels = array ("Digger","Rover","Carrier","Truck","Micro","Roadster","Loader","Floater","Blocker","Builder","Basher","Climber","Miner");
$uses = array("Maintenance","Trimming","Mowing","Digging","Building","Shrubbery","Hedges","Heavy Duty","Water Features");
$equipna = array ("Decker Dual","Moright","Harvester","Picker","Hoemaster","Strimrite","Shubadubdub","Gardenthing","Clacker","Dimuser","Callywotsit","Drum","Mikamak","Plantpower","Mixitup","Sandali","Cocoder","Sprinkabat","Redone","Growalot","Spodger");
$materials = array("Turf Bag","Shrubs","Cement","Bricks","Wildflower Seeds","Easy-Gro","Compost","Ornate Fountain","String Fencing","Underlay","Fairy Lights","Garden Chair and Table Set","Baby Evergreens","Sand","Plant Pots","Greenhouse Panels","Shed Roofing","Netting","Wooden Fence Post","Rockery Pieces","Decorative Garden Ornaments");

/* STATUS CODES LOOKUP TABLES MANUAL */
echo 'INSERT INTO "GGR"."GG_JOB_STATUS" (job_status_code,job_status_name) VALUES (\'1\',\'Pending\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_STATUS" (job_status_code,job_status_name) VALUES (\'2\',\'Open\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_STATUS" (job_status_code,job_status_name) VALUES (\'3\',\'Complete\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_STATUS" (job_status_code,job_status_name) VALUES (\'4\',\'Cancelled\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_STATUS" (job_status_code,job_status_name) VALUES (\'5\',\'Settled\');<br>';

echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'1\',\'One Off\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'2\',\'Daily\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'3\',\'Weekly\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'4\',\'Fortnightly\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'5\',\'Monthly\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'6\',\'Quarterly\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'7\',\'Bi-Annually\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'8\',\'Annually\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_FREQUENCY" (job_frequency_code,job_frequency_name) VALUES (\'9\',\'Ad-hoc\');<br>';

echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name) VALUES (\'1\',\'Garden Maintenance\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name) VALUES (\'2\',\'Landscaping\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'3\',\'Water Features\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'4\',\'Outhouse Build\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'5\',\'Garden Make-Over\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'6\',\'Tree Surgery\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'7\',\'Clear Out\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'8\',\'Lighting / Electrical\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'9\',\'Seasonal Planting\');<br>';
echo 'INSERT INTO "GGR"."GG_JOB_CATEGORY" (job_category_code,job_category_name)  VALUES (\'10\',\'Special Projects\');<br>';

echo 'INSERT INTO "GGR"."GG_PO_STATUS" (po_status_code,po_status_name)  VALUES (\'1\',\'Unfulfilled\');<br>';
echo 'INSERT INTO "GGR"."GG_PO_STATUS" (po_status_code,po_status_name)  VALUES (\'2\',\'Ready\');<br>';
echo 'INSERT INTO "GGR"."GG_PO_STATUS" (po_status_code,po_status_name)  VALUES (\'3\',\'Fulfilled\');<br>';

echo 'INSERT INTO "GGR"."GG_EMPLOYEE_ROLE" (employee_role_code,employee_role_name)  VALUES (\'1\',\'Gardening\');<br>';
echo 'INSERT INTO "GGR"."GG_EMPLOYEE_ROLE" (employee_role_code,employee_role_name)  VALUES (\'2\',\'Sales\');<br>';
echo 'INSERT INTO "GGR"."GG_EMPLOYEE_ROLE" (employee_role_code,employee_role_name)  VALUES (\'3\',\'Office\');<br>';

echo 'INSERT INTO "GGR"."GG_QUOTE_STATUS" (quote_status_code,quote_status_name)  VALUES (\'1\',\'Calculated\');<br>';
echo 'INSERT INTO "GGR"."GG_QUOTE_STATUS" (quote_status_code,quote_status_name)  VALUES (\'2\',\'Accepted\');<br>';
echo 'INSERT INTO "GGR"."GG_QUOTE_STATUS" (quote_status_code,quote_status_name)  VALUES (\'3\',\'Rejected\');<br>';

echo 'INSERT INTO "GGR"."GG_INVOICE_STATUS" (invoice_status_code,invoice_status_name)  VALUES (\'1\',\'Paid\');<br>';
echo 'INSERT INTO "GGR"."GG_INVOICE_STATUS" (invoice_status_code,invoice_status_name)  VALUES (\'2\',\'Unpaid\');<br>';

echo 'INSERT INTO "GGR"."GG_COLLECTION_STATUS" (collection_status_code,collection_status_name)  VALUES (\'1\',\'Scheduled\');<br>';
echo 'INSERT INTO "GGR"."GG_COLLECTION_STATUS" (collection_status_code,collection_status_name)  VALUES (\'2\',\'Collected\');<br>';


/* SQL main string */

$sqlstr = 'INSERT INTO "GGR".';

/* SQL strings for each entity we are generating script for */

$empidstr = '"GG_EMPLOYEE" (employee_id, title, firstname, surname, telephone, email, employee_role_code) VALUES ';
$bookingidstr = '"GG_ACCOMMODATION" (BOOKING_ID, EMPLOYEE_ID, CHECKIN_DATE, NIGHTS, AGENT_ID, HOTEL_ID) VALUES ';
$agentidstr = '"GG_BOOKING_AGENT" (agent_id, agent_name, street_address, city, postcode, telephone, email) VALUES ';
$hotelidstr = '"GG_HOTEL" (hotel_id, hotel_name, address, city, postcode, telephone, email) VALUES ';
$invoiceidstr = '"GG_INVOICE" (invoice_id, amount, invoice_date, job_id, invoice_status_code) VALUES ';
$customeridstr = '"GG_CUSTOMER" (customer_id, title, firstname, surname, street_address, town, postcode, country, telephone, email) VALUES ';
$supplieridstr = '"GG_SUPPLIER" (supplier_id, supplier_name, address, city, postcode, telephone, email) VALUES ';
$materialidstr = '"GG_MATERIAL" (material_id, supplier_id, material_name, material_cost, lead_time) VALUES ';
$orderidstr = '"GG_ORDER" (order_id, customer_id, order_date) VALUES ';
$poidstr = '"GG_PURCHASE_ORDER" (po_id, material_id, quantity, required_by, po_date, po_status_code) VALUES ';
$equipidsrt = '"GG_EQUIPMENT" (equipment_id, equipment_name, warantee, quantity, used_for) VALUES ';
$jobidstr = '"GG_JOB" (job_id, order_id, location, expected_duration, description, notes, predicted_cost, start_date, end_date, close_date, job_status_code, job_frequency_code, job_category_code) VALUES ';
$collectionidstr = '"GG_COLLECTION" (collection_id,employee_id,po_id,vehicle_id,collection_status_code, date_time) VALUES ';
$quoteidstr = '"GG_QUOTE" (quote_id, quoted_price, qdate, job_id, quote_status_code) VALUES ';
$vehicleidstr = '"GG_VEHICLE" (vehicle_id, MOT_due, regno, tax_due, model_code) VALUES ';
$modelcstr = '"GG_VEHICLE_MODEL" (model_code, make, model_name, capacity, vload) VALUES ';
$asvehstr = '"GG_VEHICLE_ASSIGNMENT" (vehicle_assigment_id, job_id, vehicle_id) VALUES ';
$asjobstr = '"GG_JOB_ASSIGNMENT" (job_assigment_id, job_id, employee_id) VALUES ';
$aspostr = '"GG_PO_ASSIGNMENT" (po_assigment_id, job_id, po_id) VALUES ';
$asaccstr = '"GG_ACCOMMODATION_ASSIGNMENT" (accommodation_assigment_id, job_id, booking_id) VALUES ';
$asequstr = '"GG_EQUIPMENT_ASSIGNMENT" (equipment_assigment_id, job_id, equipment_id) VALUES ';

/* GG_EMPLOYEE */
foreach ($EMarr as $pk ) {
echo $sqlstr;
echo $empidstr;
$firstn = $fns[rand(0, 77)];
echo "('".$pk."', '".$titles[rand(0, 5)]."','".$firstn ."', '".$sns[rand(0, 44)]."','01".rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9)."','".$firstn."@".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)].".com','".rand(1,2)."');";
echo '<br>';
}

/*GG_BOOKING_AGENT */

foreach ($AGarr as $pk ) {
echo $sqlstr;
echo $agentidstr;
echo "('".$pk."', '".$adjs[rand(0, 7)]." ".$holsf[rand(0, 6)]." ".$holsn[rand(0, 4)]."','".rand(1,700)." ".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)]." ".$street[rand(0, 7)]."','".$firstbit[rand(0, 33)].$secondbit[rand(0, 24)]."','".chr(rand(65,90)).rand(1,9).rand(0,9)." ".rand(0,9).chr(rand(65,90)).chr(rand(65,90))."','01".rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9)."','".$fns[rand(0,40)]."@".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)].".com');";
echo '<br>';
}

/*GG_HOTEL */
foreach ($HTarr as $pk ) {
echo $sqlstr;
echo $hotelidstr;
echo "('".$pk."', '".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)]." Hotel','".rand(1,700)." ".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)]." ".$street[rand(0, 7)]."','".$firstbit[rand(0, 33)].$secondbit[rand(0, 24)]."','".chr(rand(65,90)).rand(1,9).rand(0,9)." ".rand(0,9).chr(rand(65,90)).chr(rand(65,90))."','01".rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9)."','".$fns[rand(0,40)]."@".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)].".com');";
echo '<br>';
}

/* GG_ACCOMMODATION */
foreach ($BKarr as $pk ) {
echo $sqlstr;
echo $bookingidstr;
echo "('".$pk."', '".$EMarr[rand(0, 19)]."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."', 'DD/MM/YYYY'), '".rand(1,10)."', '".$AGarr[rand(0, 19)]."', '".$HTarr[rand(0, 19)]."');";
echo '<br>';
}







/*GG_INVOICE */
$i=0;
foreach ($INarr as $pk ) {
$i++;
echo $sqlstr;
echo $invoiceidstr;
echo "('".$pk."', '".rand(200,30000).".".rand(0,9).rand(0,9)."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."', 'DD/MM/YYYY'), '".$JBarr[$i]."','".rand(1,3)."');";
echo '<br>';
}

/* GG_CUSTOMER */
foreach ($CUarr as $pk ) {
echo $sqlstr;
echo $customeridstr;
$firstn = $fns[rand(0, 77)];
echo "('".$pk."', '".$titles[rand(0, 5)]."','".$firstn."', '".$sns[rand(0, 44)]."','".rand(1,700)." ".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)]." ".$street[rand(0, 7)]."','".$firstbit[rand(0, 33)].$secondbit[rand(0, 24)]."','".chr(rand(65,90)).rand(1,9).rand(0,9)." ".rand(0,9).chr(rand(65,90)).chr(rand(65,90))."','".$country[rand(0,7)]."','01".rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9)."','".$firstn."@".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)].".com');";
echo '<br>';
}

/*GG_SUPPLIER */
foreach ($SParr as $pk ) {
echo $sqlstr;
echo $supplieridstr;
echo "('".$pk."', '".$adjs[rand(0, 7)]." ".$compf[rand(0, 6)]." ".$compn[rand(0, 5)]."','".rand(1,700)." ".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)]." ".$street[rand(0, 7)]."','".$firstbit[rand(0, 33)].$secondbit[rand(0, 24)]."','".chr(rand(65,90)).rand(1,9).rand(0,9)." ".rand(0,9).chr(rand(65,90)).chr(rand(65,90))."','01".rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9).rand(0,9).rand(1,9)."','".$fns[rand(0,40)]."@".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)].".com');";
echo '<br>';
}



$i = 0;
/*GG_MATERIAL */
foreach ($MTarr as $pk ) {
$i++;
echo $sqlstr;
echo $materialidstr ;
echo "('".$pk."', '".$SParr[rand(0,19)]."','".$materials[$i]."','".rand(50,500).".".rand(0,9).rand(0,9)."','".rand(1,14)."');";
echo '<br>';
}

/*GG_ORDER */

foreach ($ORarr as $pk ) {
echo $sqlstr;
echo $orderidstr ;
echo "('".$pk."', '".$CUarr[rand(0,19)]."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'));";
echo '<br>';
}

/*GG_PURCHASE_ORDER */

foreach ($POarr as $pk ) {
echo $sqlstr;
echo $poidstr ;
echo "('".$pk."', '".$MTarr[rand(0,19)]."','".rand(1,14)."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'), TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),".rand(1,3).");";
echo '<br>';
}

/*GG_EQUIPMENT */
$i=0;
foreach ($EQarr as $pk ) {
$i++;
echo $sqlstr;
echo $equipidsrt;
echo "('".$pk."','".$equipna[$i]."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),'".rand(1,30)."','".$uses[rand(0,8)]."');";
echo '<br>';
}



/*GG_JOB */

foreach ($JBarr as $pk ) {
echo $sqlstr;
echo $jobidstr;
echo "('".$pk."', '".$ORarr[rand(0,19)]."','".$firstbit[rand(0, 19)].$secondbit[rand(0, 19)]."',utl_raw.cast_to_raw('long description'),'some job notes','".rand(200,30000).".".rand(0,9).rand(0,9)."',TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),'".rand(1,5)."','".rand(1,9)."','".rand(1,10)."');";
echo '<br>';
}


/*GG_COLLECTION */
foreach ($CLarr as $pk ) {
$fif=ceil(rand(0,60)/15)*15;
if ($fif==60 || $fif==0){
	$fif ="00";
}
echo $sqlstr;
echo $collectionidstr;
echo "('".$pk."', '".$EMarr[rand(0,19)]."','".$VHarr[rand(0,19)]."','".$VHarr[rand(0,19)]."','".rand(1,2)."',TO_TIMESTAMP '".rand(2013,2016)."-".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."-".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)." ".rand (10,17).":".$fif."');";
echo '<br>';
}

/*GG_QUOTE */
$i=0;
foreach ($QUarr as $pk ) {
$i++;
echo $sqlstr;
echo $quoteidstr;
echo "('".$pk."', '".rand(200,30000).".".rand(0,9).rand(0,9)."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."', 'DD/MM/YYYY'), '".$JBarr[$i]."','".rand(1,3)."');";
echo '<br>';
}

/*GG_VEHICLE */
foreach ($VHarr as $pk ) {
echo $sqlstr;
echo $vehicleidstr;
echo "('".$pk."', '".$EQarr[rand(0,19)]."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),'".chr(rand(65,90)).chr(rand(65,90)).rand(0,9)." ".chr(rand(65,90)).chr(rand(65,90)).chr(rand(65,90))."', TO_DATE('".str_pad(rand(1,30), 2, '0', STR_PAD_LEFT)."/".str_pad(rand(1,12), 2, '0', STR_PAD_LEFT)."/".rand(2013,2016)."'),'".$MCarr[rand(0,19)]."');";
echo '<br>';
}

/*GG_VEHICLE_MODEL */
foreach ($MCarr as $pk ) {
echo $sqlstr;
echo $modelcstr;
echo "('".$pk."', '".$makes[rand(0,5)]."','".$cmodels[rand(0,12)]."','".rand(0,300)."','".rand(0,300)."');";
echo '<br>';
}


/*GG_VEHICLE_ASSIGNMENT */
foreach ($ASVarr as $pk ) {
echo $sqlstr;
echo $asvehstr;
echo "('".$pk."', '".$JBarr[rand(0, 19)]."','".$VHarr[rand(0, 19)]."');";
echo '<br>';
}

/*GG_JOB_ASSIGNMENT */
foreach ($ASJarr as $pk ) {
echo $sqlstr;
echo $asjobstr;
echo "('".$pk."', '".$JBarr[rand(0, 19)]."','".$EMarr[rand(0, 19)]."');";
echo '<br>';
}

/*GG_PO_ASSIGNMENT */
foreach ($ASParr as $pk ) {
echo $sqlstr;
echo $aspostr;
echo "('".$pk."', '".$JBarr[rand(0, 19)]."','".$POarr[rand(0, 19)]."');";
echo '<br>';
}


/*GG_ACCOMMODATION_ASSIGNMENT*/

foreach ($ASCarr as $pk ) {
echo $sqlstr;
echo $asaccstr;
echo "('".$pk."', '".$JBarr[rand(0, 19)]."','".$BKarr[rand(0, 19)]."');";
echo '<br>';
}

/*GG_EQUIPMENT_ASSIGNMENT*/

foreach ($ASEarr as $pk ) {
echo $sqlstr;
echo $asequstr;
echo "('".$pk."', '".$JBarr[rand(0, 19)]."','".$EQarr[rand(0, 19)]."');";
echo '<br>';
}



?>