<?php
if ($printout) {
    echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>' . $LDDocsUtilReport . '</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
    echo '<html><body>';
    ?>
    <DIV align="center">
        <h2><?php echo $LDDocsUtilReport; ?><?php echo ' as From: ' . $startdate . ' To: ' . @formatDate2Local($enddate, "dd/mm/yyyy"); ?></h1>
            <p><?php echo $LDCreationTime; ?><?php
                echo date("F j, Y, g:i a");
                ?></p>
    </DIV>
    <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
        <tr> 
            <?php
            echo '<td><b>' . 'Serial No:' . '</td>';
            echo '<td><b>' . $LDDoctor . '</td>';
            echo '<td><b>' . $LDTotalPatients . '</td>';
            echo '<td><b>' . $LDAmountperPatient . '</td>';
            echo '<td><b>' . $LDTotalAmount . '</td>';
      ?>
        </tr>

        <?php
        $data = array();
        while ($row = $db_docs_patients->FetchRow()) {
            $data['docs_list'][] = $row;
        }
        $count1 = count($data['docs_list']);
        $patient_total = 0;
        $amount_total = 0;
        //print_r($data['docs_list']);
        for ($i = 0; $i < $count1; $i++) {
            $patient_total = $patient_total + $data['docs_list'][$i]['no_of_patients'];
//                                    $amount_doc_total = 1;
            $amount_doc_total = number_format($amount_per_person * $data['docs_list'][$i]['no_of_patients'], 2);
            ?>
            <tr>
                <?php
                //echo '<td>' . @formatDate2Local($data['docs_list'][$i]['date'], "dd/mm/yyyy") . '</td>';
                echo '<td align="center">' . $serial = $i + 1 . '</td>';
                echo '<td>' . $data['docs_list'][$i]['name'] . '</td>';
                echo '<td align="center">' . $data['docs_list'][$i]['no_of_patients'] . '</td>';
                echo '<td align="center">' . number_format($_GET['amount_per_person'], 2) . '</td>';
                echo '<td align="center">' . $amount_doc_total . '</td>';
//                echo '<td></td>';
                ?>
            </tr>
            <?php
        }
        ?>

        <tr> 
            <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
            <?php
            echo '<td></td>';

            echo '<td align="center">' . $patient_total . '</td>';

            echo '<td></td>';

            echo '<td align="center">' . number_format($patient_total * $amount_per_person, 2) . '</td>';

            ?>


        </tr>  
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
                urlholder = "./docs_util_report.php?printout=TRUE&start=<?php echo $startdate; ?>&end=<?php echo $enddate; ?>&amount_per_person=<?php echo $amount_per_person; ?>";
                testprintout = window.open(urlholder, "printout", "width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
                window.testprintout.moveTo(0, 0);
            }
            function patientsList(doctor) {
//                alert(doctor);
                urlholder = "./docs_util_report_patients.php?doctor=" + doctor + "&start=<?php echo $startdate; ?>&end=<?php echo $enddate; ?>";
                patientswin = window.open(urlholder, "patientslist", "width=1020,height=600,menubar=yes,resizable=yes,scrollbars=yes");
                window.patientswin.moveTo(0, 0);
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
                                <td width="302" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDDocsUtilReport; ?></font></td>
                                <td width="408" align=right bgcolor="#99ccff">
                                    <a href="javascript: history.back();"><img src="../../gui/img/control/blue_aqua/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)" ></a>
                                    <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>
                                    <a href="<?php echo $root_path; ?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this, 1)" onMouseOut="hilite(this, 0)"></a>  
                                </td>
                            </tr>
                        </table>	

                        <!-- END HEAD OF HTML CONTENT -->

                        <form name="form1" method="post" action=""></p>
                            <?php require_once($root_path . $top_dir . 'include/inc_gui_timeframe_date_docs_util.php'); ?>
                            <p><br>

                                <br>
                            </p>
                            <DIV align="center">
                                <h2><?php echo $LDDocsUtilReport; ?><?php echo 'From: ' . $_POST['date_from'] . ' ' . '00:00:00 ' . 'To: ' . @formatDate2Local($enddate, "dd/mm/yyyy") . ' ' . '23:59:59'; ?></h1>
                                    <p><?php echo $LDCreationTime; ?><?php
                                        echo date("F j, Y, g:i a");
                                        ?></p>
                            </DIV>
                            <table border="1" cellspacing="0" cellpadding="2" align="center" bgcolor=#ffffdd>
                                <tr> 
                                    <?php
                                    echo '<td><b>' . 'Serial No:' . '</td>';
                                    echo '<td><b>' . $LDDoctor . '</td>';
                                    echo '<td><b>' . $LDTotalPatients . '</td>';
                                    echo '<td><b>' . $LDAmountperPatient . '</td>';
                                    echo '<td><b>' . $LDTotalAmount . '</td>';
                                    echo '<td><b>' . $LDOptionsTittle . '</td>';
                                    ?>
                                </tr>

                                <?php
                                $data = array();
                                while ($row = $db_docs_patients->FetchRow()) {
                                    $data['docs_list'][] = $row;
                                }
                                $count1 = count($data['docs_list']);
                                $patient_total = 0;
                                $amount_total = 0;
                                //print_r($data['docs_list']);
                                for ($i = 0; $i < $count1; $i++) {
                                    $patient_total = $patient_total + $data['docs_list'][$i]['no_of_patients'];
//                                    $amount_doc_total = 1;
                                    $amount_doc_total = number_format($amount_per_person * $data['docs_list'][$i]['no_of_patients'], 2);
                                    ?>
                                    <tr>
                                        <?php
                                        //echo '<td>' . @formatDate2Local($data['docs_list'][$i]['date'], "dd/mm/yyyy") . '</td>';
                                        echo '<td align="center">' . $serial = $i + 1 . '</td>';
                                        echo '<td>' . $data['docs_list'][$i]['name'] . '</td>';
                                        echo '<td align="center">' . $data['docs_list'][$i]['no_of_patients'] . '</td>';
                                        echo '<td align="center">' . number_format($amount_per_person, 2) . '</td>';
                                        echo '<td align="center">' . $amount_doc_total . '</td>';
                                        $doctor = $data['docs_list'][$i]['doctor'];
                                        echo "<td><a href=\"javascript:patientsList('$doctor');\">Open List</a></td>";
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>

                                <tr> 
                                    <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
                                    <?php
                                    echo '<td></td>';

                                    echo '<td align="center">' . $patient_total . '</td>';

                                    echo '<td></td>';

                                    echo '<td align="center">' . number_format($patient_total * $cons_charge, 2) . '</td>';


                                    echo '<td></td>';

                                    ?>


                                </tr>  
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