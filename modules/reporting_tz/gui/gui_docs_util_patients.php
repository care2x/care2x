<?php
if ($printout) {
    echo '<head>';
    ?>
    <script language="javascript"> this.window.print();</script>
    <title><?php echo $LDDocsUtilReport ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <style type="text/css">
        .printout{
            font-size: 13px;
        }
    </style>
    </head>
    <html><body>

            <DIV align="center">
                <h2>Doctor &nbsp;<?php echo $doc_name . '\'s'; ?>&nbsp;Patients Attendance List<?php echo ' From: ' . @formatDate2Local($startdate, "dd/mm/yyyy") . ' To: ' . @formatDate2Local($enddate, "dd/mm/yyyy"); ?></h1>
                    <p><?php echo $LDCreationTime; ?><?php
                        echo date("F j, Y, g:i a");
                        ?></p>
            </DIV>
            <table class="printout" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                <tr> 
                    <?php
                    echo '<td><b>' . 'Serial No:' . '</td>';
                    echo '<td><b>' . $LDEncounterDate . '</td>';
                    echo '<td><b>' . $LDPatientName . '</td>';
                    echo '<td><b>' . $LDSex2 . '</b></td>';
                    echo '<td><b>' . $LDFileNo . '</td>';
                    echo '<td><b>' . $LDDiagnosisCode . '</td>';
                    echo '<td><b>' . $LDPrescriptions . '</td>';
                    echo '<td><b>' . $LDLabTest . '</td>';
                    echo '<td><b>' . $LDPatientNotes . '</td>';
                    ?>
                </tr>

                <?php
//                                $data = array();
//Get the detailed list of patients and assign to $data
                while ($row_patients_dets = $db_patients_qry->FetchRow()) {
                    $data['patient_dets'][] = $row_patients_dets;
                }

                $patient_total = 0;

                //Iterate through patient list and get other details
                for ($i = 0; $i < count($data['patient_dets']); $i++) {
                    $patient_total += 1;
                    $encounter_no = $data['patient_dets'][$i]['encounter_nr'];

                    //get all the diagnosis done to patient
                    $diagnosis_qry = "SELECT ICD_10_code from care_tz_diagnosis
                                                  WHERE encounter_nr = '$encounter_no'";
                    $db_diagnosis = $db->Execute($diagnosis_qry);

                    while ($row_diagnosis = $db_diagnosis->FetchRow()) {
                        $data['diagnosis'][] = $row_diagnosis;
                    }

                    //get all the prescriptions done to patient
                    $prescr_qry = "SELECT article from care_encounter_prescription
                                                  WHERE encounter_nr = '$encounter_no'
                                                  AND drug_class != 'labtest'";
                    $db_prescr = $db->Execute($prescr_qry);

                    while ($row_prescr = $db_prescr->FetchRow()) {
                        $data['prescription'][] = $row_prescr;
                    }

                    //get all the lab tests done to patient
                    $lab_qry = "SELECT article from care_encounter_prescription
                                                  WHERE encounter_nr = '$encounter_no'
                                                  AND drug_class = 'labtest'";
                    $db_lab = $db->Execute($lab_qry);

                    while ($row_lab = $db_lab->FetchRow()) {
                        $data['lab'][] = $row_lab;
                    }

                    //Get the largest of diagnosis, prescriptions and labtest
                    $rows = max(count($data['diagnosis']), count($data['prescription']), count($data['lab']));

                    for ($r = 0; $r < $rows; $r++) {
                        if ($r == 0) {
                            echo '<tr>';
                            echo '<td align="center">' . $serial = $i + 1 . '</td>';
                            echo '<td align="center">' . @formatDate2Local($data['patient_dets'][$i]['encounter_date'], "dd/mm/yyyy") . '</td>';
                            echo '<td>' . $data['patient_dets'][$i]['name_first'] . ' ' .
                            $data['patient_dets'][$i]['name_2'] . ' ' . $data['patient_dets'][$i]['name_last'] . '</td>';
                            echo '<td align="center">' . strtoupper($data['patient_dets'][$i]['sex']) . '</td>';
                            echo '<td align="center">' . $data['patient_dets'][$i]['selian_pid'] . ' / ' . $data['patient_dets'][$i]['pid'] . '</td>';
                            //Start of diagnosis, prescription and labtests
                            if (count($data['diagnosis']) > 0) {
                                $diag_code = $data['diagnosis'][$r]['ICD_10_code'];
                                echo '<td align="center">';
                                echo "<a href=\"#\" onclick=\"get_ICD_descr('$diag_code');\">" . $diag_code . ' </a>';
                                echo '</td>';
                            } else {
                                echo '<td align="center">';
                                echo '-';
                                echo '</td>';
                            }
                            if (count($data['prescription']) > 0) {
                                echo '<td align="center">';
                                echo $data['prescription'][$r]['article'];
                                echo '</td>';
                            } else {
                                echo '<td align="center">';
                                echo '-';
                                echo '</td>';
                            }
                            if (count($data['lab']) > 0) {
                                echo '<td align="center">';
                                echo $data['lab'][$r]['article'] . ' ';
                                echo '</td>';
                            } else {
                                echo '<td align="center">';
                                echo '-';
                                echo '</td>';
                            }
                            //End of diagnosis, prescription and labtests
                            echo '<td align="center">';
                            if ($data['patient_dets'][$i]['notes'] == '') {
                                echo '-';
                            } else {
                                echo $data['patient_dets'][$i]['notes'];
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                        //End of first row
                        elseif ($r > 0) {              //print other patients'row(s)
                            echo '<tr>';
                            echo '<td></td><td></td><td></td><td></td><td></td>';
                            if (count($data['diagnosis']) > 0 && $r <= count($data['diagnosis'])) {
                                $diag_code = $data['diagnosis'][$r]['ICD_10_code'];
                                echo '<td align="center">';
                                echo "<a href=\"#\" onclick=\"get_ICD_descr('$diag_code');\">" . $diag_code . ' </a>';
                                echo '</td>';
                            } else {
                                echo '<td align="center">';
                                echo '-';
                                echo '</td>';
                            }
                            if (count($data['prescription']) > 0 && $r <= count($data['prescription'])) {
                                echo '<td align="center">';
                                echo $data['prescription'][$r]['article'];
                                echo '</td>';
                            } else {
                                echo '<td align="center">';
                                echo '-';
                                echo '</td>';
                            }
                            if (count($data['lab']) > 0 && $r <= count($data['lab'])) {
                                echo '<td align="center">';
                                echo $data['lab'][$r]['article'];
                                echo '</td>';
                            } else {
                                echo '<td align="center">';
                                echo '-';
                                echo '</td>';
                            }
                            echo '<td align="center">';
//                                                echo '-';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    //Empty patient's data
                    unset($data['diagnosis']);
                    unset($data['prescription']);
                    unset($data['lab']);
                }
                ?>

            </table>
            <?php
            exit();
        }
        ?>





        <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
    <HTML>
        <HEAD>
            <TITLE><?php echo $LDReportingModule; ?></TITLE>
            <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
            <meta name="Author" content="Moye Masenga">
            <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

            <script language="javascript" >

                function gethelp(x, s, x1, x2, x3, x4)
                {
                    if (!x)
                        x = "";
                    urlholder = "../../main/help-router.php?sid=<?php echo sid; ?>&lang=$lang&helpidx=" + x + "&src=" + s + "&x1=" + x1 + "&x2=" + x2 + "&x3=" + x3 + "&x4=" + x4;
                    helpwin = window.open(urlholder, "helpwin", "width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
                    window.helpwin.moveTo(0, 0);
                }
                function printOut()
                {
                    urlholder = "./docs_util_report_patients.php?doctor=<?php echo $doctor; ?>&printout=TRUE&start=<?php echo $startdate; ?>&end=<?php echo $enddate; ?>";
                    testprintout = window.open(urlholder, "printout", "width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                    window.testprintout.moveTo(0, 0);
                }

<?php require($root_path . 'include/inc_checkdate_lang.php'); ?>

            </script> 

            <script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
            <script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
            <script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
            <script src="<?php print $root_path; ?>/include/_jquery.js" language="javascript"></script> 

            <link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
            <script language="javascript" src="../../js/hilitebu.js"></script>

            <STYLE TYPE="text/css">
                A:link  {color: #000066;}
                A:hover {color: #cc0033;}
                A:active {color: #cc0000;}
                A:visited {color: #000066;}
                A:visited:active {color: #cc0000;}
                A:visited:hover {color: #cc0033;}
            </style>
            <script language="JavaScript">

                function popPic(pid, nm) {

                    if (pid != "")
                        regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid; ?>&lang=$lang&pid=" + pid + "&nm=" + nm, "regpicwin", "toolbar=no,scrollbars,width=180,height=250");

                }

                function get_ICD_descr(code) {
                    urlholder = "<?php echo $root_path; ?>modules/reporting_tz/icd_code_descr.php?icd_code=" + code;
                    var Request = new XMLHttpRequest();

                    Request.open("GET", urlholder, false);
                    Request.send();

                    if (Request.status === 200) {
                        alert(Request.responseText);
                    } else {
                        alert("Error!");
                    }
                }
            </script> 
        </HEAD>

        <BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

            <!-- START HEAD OF HTML CONTENT -->


            <table width=100% border=0 cellspacing=0 height=100%>
                <tbody class="main">

                    <tr>

                        <td  valign="top" align="middle" height="35">
                            <table cellspacing="0"  class="titlebar" border=0>
                                <tr valign=top  class="titlebar" >
                                    <td width="302" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php // echo $LDDocsUtilReport;                                                                                                                                      ?></font></td>
                                    <td width="408" align=right bgcolor="#99ccff">
    <!--                                    <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)" ></a>
                                        <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>
                                        <a href="<?php // echo $root_path;                                                                                                                                      ?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>  -->
                                    </td>
                                </tr>
                            </table>	

                            <!-- END HEAD OF HTML CONTENT -->

                            <form name="form1" method="post" action=""></p>
                                <DIV align="center">
                                    <h2>Doctor &nbsp;<?php echo $doc_name . '\'s'; ?>&nbsp;Patients Attendance List<?php echo ' From: ' . @formatDate2Local($startdate, "dd/mm/yyyy") . ' To: ' . @formatDate2Local($enddate, "dd/mm/yyyy"); ?></h1>
                                        <p><?php echo $LDCreationTime; ?><?php
                                            echo date("F j, Y, g:i a");
                                            ?></p>
                                </DIV>
                                <table border="1" cellspacing="0" cellpadding="2" align="center" bgcolor=#ffffdd>
                                    <tr> 
                                        <?php
                                        echo '<td><b>' . 'Serial No:' . '</td>';
                                        echo '<td><b>' . $LDEncounterDate . '</td>';
                                        echo '<td><b>' . $LDPatientName . '</td>';
                                        echo '<td><b>' . $LDSex2 . '</b></td>';
                                        echo '<td><b>' . $LDFileNo . '</td>';
                                        echo '<td><b>' . $LDDiagnosisCode . '</td>';
                                        echo '<td><b>' . $LDPrescriptions . '</td>';
                                        echo '<td><b>' . $LDLabTest . '</td>';
                                        echo '<td><b>' . $LDPatientNotes . '</td>';
                                        ?>
                                    </tr>

                                    <?php
//                                $data = array();
//Get the detailed list of patients and assign to $data
                                    while ($row_patients_dets = $db_patients_qry->FetchRow()) {
                                        $data['patient_dets'][] = $row_patients_dets;
                                    }

                                    $patient_total = 0;

//Iterate through patient list and get other details
                                    for ($i = 0; $i < count($data['patient_dets']); $i++) {
                                        $patient_total += 1;
                                        $encounter_no = $data['patient_dets'][$i]['encounter_nr'];

                                        //get all the diagnosis done to patient
                                        $diagnosis_qry = "SELECT ICD_10_code from care_tz_diagnosis
                                                  WHERE encounter_nr = '$encounter_no'";
                                        $db_diagnosis = $db->Execute($diagnosis_qry);

                                        while ($row_diagnosis = $db_diagnosis->FetchRow()) {
                                            $data['diagnosis'][] = $row_diagnosis;
                                        }

                                        //get all the prescriptions done to patient
                                        $prescr_qry = "SELECT article from care_encounter_prescription
                                                  WHERE encounter_nr = '$encounter_no'
                                                  AND drug_class != 'labtest'";
                                        $db_prescr = $db->Execute($prescr_qry);

                                        while ($row_prescr = $db_prescr->FetchRow()) {
                                            $data['prescription'][] = $row_prescr;
                                        }

                                        //get all the lab tests done to patient
                                        $lab_qry = "SELECT article from care_encounter_prescription
                                                  WHERE encounter_nr = '$encounter_no'
                                                  AND drug_class = 'labtest'";
                                        $db_lab = $db->Execute($lab_qry);

                                        while ($row_lab = $db_lab->FetchRow()) {
                                            $data['lab'][] = $row_lab;
                                        }

                                        //Get the largest of diagnosis, prescriptions and labtest
                                        $rows = max(count($data['diagnosis']), count($data['prescription']), count($data['lab']));

                                        for ($r = 0; $r < $rows; $r++) {
                                            if ($r == 0) {
                                                echo '<tr>';
                                                echo '<td align="center">' . $serial = $i + 1 . '</td>';
                                                echo '<td align="center">' . @formatDate2Local($data['patient_dets'][$i]['encounter_date'], "dd/mm/yyyy") . '</td>';
                                                echo '<td>' . $data['patient_dets'][$i]['name_first'] . ' ' .
                                                $data['patient_dets'][$i]['name_2'] . ' ' . $data['patient_dets'][$i]['name_last'] . '</td>';
                                                echo '<td align="center">' . strtoupper($data['patient_dets'][$i]['sex']) . '</td>';
                                                echo '<td align="center">' . $data['patient_dets'][$i]['selian_pid'] . ' / ' . $data['patient_dets'][$i]['pid'] . '</td>';
                                                //Start of diagnosis, prescription and labtests
                                                if (count($data['diagnosis']) > 0) {
                                                    $diag_code = $data['diagnosis'][$r]['ICD_10_code'];
                                                    echo '<td align="center">';
                                                    echo "<a href=\"#\" onclick=\"get_ICD_descr('$diag_code');\">" . $diag_code . ' </a>';
                                                    echo '</td>';
                                                } else {
                                                    echo '<td align="center">';
                                                    echo '-';
                                                    echo '</td>';
                                                }
                                                if (count($data['prescription']) > 0) {
                                                    echo '<td align="center">';
                                                    echo $data['prescription'][$r]['article'];
                                                    echo '</td>';
                                                } else {
                                                    echo '<td align="center">';
                                                    echo '-';
                                                    echo '</td>';
                                                }
                                                if (count($data['lab']) > 0) {
                                                    echo '<td align="center">';
                                                    echo $data['lab'][$r]['article'] . ' ';
                                                    echo '</td>';
                                                } else {
                                                    echo '<td align="center">';
                                                    echo '-';
                                                    echo '</td>';
                                                }
                                                //End of diagnosis, prescription and labtests
                                                echo '<td align="center">';
                                                if ($data['patient_dets'][$i]['notes'] == '') {
                                                    echo '-';
                                                } else {
                                                    echo $data['patient_dets'][$i]['notes'];
                                                }
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            //End of first row
                                            elseif ($r > 0) {              //print other patients'row(s)
                                                echo '<tr>';
                                                echo '<td></td><td></td><td></td><td></td><td></td>';
                                                if (count($data['diagnosis']) > 0 && $r <= count($data['diagnosis'])) {
                                                    $diag_code = $data['diagnosis'][$r]['ICD_10_code'];
                                                    echo '<td align="center">';
                                                    echo "<a href=\"#\" onclick=\"get_ICD_descr('$diag_code');\">" . $diag_code . ' </a>';
                                                    echo '</td>';
                                                } else {
                                                    echo '<td align="center">';
                                                    echo '-';
                                                    echo '</td>';
                                                }
                                                if (count($data['prescription']) > 0 && $r <= count($data['prescription'])) {
                                                    echo '<td align="center">';
                                                    echo $data['prescription'][$r]['article'];
                                                    echo '</td>';
                                                } else {
                                                    echo '<td align="center">';
                                                    echo '-';
                                                    echo '</td>';
                                                }
                                                if (count($data['lab']) > 0 && $r <= count($data['lab'])) {
                                                    echo '<td align="center">';
                                                    echo $data['lab'][$r]['article'];
                                                    echo '</td>';
                                                } else {
                                                    echo '<td align="center">';
                                                    echo '-';
                                                    echo '</td>';
                                                }
                                                echo '<td align="center">';
//                                                echo '-';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                        //Empty patient's data
                                        unset($data['diagnosis']);
                                        unset($data['prescription']);
                                        unset($data['lab']);
                                    }
                                    ?>

                                </table>
                                <p>&nbsp; </p>

                            </form>			  
                            <a href="javascript:printOut()"><img border=0 src=<?php echo $root_path; ?>/gui/img/common/default/billing_print_out.gif></a><br>									  
                            <br><br><br>  <br><br><br>						  


                            <!-- START BOTTIOM OF HTML CONTENT --->
                            <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
                                <tr>
                                    <td align="center">
                                        <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
                                            <tr>
                                                <td>
                                                    <div class="copyright">
                                                        <script language="JavaScript">
                                                            <!-- Script Begin
                                                        function openCreditsWindow() {

                                                                urlholder = "../../language/$lang/$lang_credits.php?lang=$lang";
                                                                creditswin = window.open(urlholder, "creditswin", "width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

                                                            }
                                                            //  Script End -->
                                                        </script>


                                                        <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
                                                        <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
                                                        <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
                                                        <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

                                                    </div>
                                                </td>
                                            <tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- START BOTTIOM OF HTML CONTENT --->

                            </BODY>
