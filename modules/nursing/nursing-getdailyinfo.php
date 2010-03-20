<?php
error_reporting (E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR);

require ('./roots.php');
require ($root_path . 'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('date_time.php');

define('LANG_FILE', 'nursing.php');
$local_user='ck_pflege_user';
require_once ($root_path . 'include/inc_front_chain_lang.php');
require_once ($root_path . 'include/inc_config_color.php'); // load color preferences

$thisfile  =basename(__FILE__);
/* Create charts object */
require_once ($root_path . 'include/care_api_classes/class_charts.php');
$charts_obj=new Charts;

switch ($winid)
    {
    case "diag_ther_dailyreport":
        $title        =$LDDailyDiagTher;

        $element      =diag_ther_dailyreport;
        $notes_type_nr=7;
        break;

    case "kg_atg_etc":
        $title        =$LDPtAtgEtcTxt;

        $element      ="kg_atg_etc";
        $notes_type_nr=8;
        break;

    case "diet":
        $title        =$LDDiet;

        $element      ="diet";
        $sformat      =1;
        $notes_type_nr=23;
        break;

    case "anticoag_dailydose":
        $title        =$LDAntiCoagTxt;

        $element      ="anticoag_dailydose";
        $sformat      =1;
        $notes_type_nr=10;
        break;

    case "iv_needle":
        $title        =$LDIvPort;

        $element      ="iv_needle";
        $sformat      =1;
        $notes_type_nr=9;
        break;
    }

//$dbtable='care_nursing_station_patients_curve';

/* Load date formatter */
require_once ($root_path . 'include/inc_date_format_functions.php');

if ($mode == 'save' && $sformat && (trim($short_notes) == ''))
    $mode='';

if ($mode == 'save' && !$sformat && (trim($notes) == ''))
    $mode='';

if ($mode == 'save')
    {
    $_POST['encounter_nr']  =$pn;
    $_POST['date']          =date('Y-m-d', mktime(0, 0, 0, $mo, $dy, $yr));
    $_POST['personell_name']=$_SESSION['sess_user_name'];

    if ($charts_obj->saveChartNotesFromArray($_POST, $notes_type_nr))
        {
        header ("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dystart=$dystart&dyname=$dyname&sformat=$sformat");
        }
    }
else
    { // end of if(mode==save)
    $count     =0;
    $chartnotes=$charts_obj->getDayChartNotes($pn, $notes_type_nr, date('Y-m-d', mktime(0, 0, 0, $mo, $dy, $yr)));

    if (is_object($chartnotes))
        {
        $count=$chartnotes->RecordCount();
        include_once ($root_path . 'include/inc_editor_fx.php');
        include_once ($root_path . 'include/inc_date_format_functions.php');
        }
    }

# Set the input name
if ($sformat)
    {
    $input_name='short_notes';
    }
else
    {
    $input_name='notes';
    }
?>

<?php
html_rtl ($lang);
?>

<HEAD>
    <?php echo setCharSet(); ?>

    <TITLE><?php echo "$title $LDInputWin" ?></TITLE>

<?php
require ($root_path . 'include/inc_js_gethelp.php');
require ($root_path . 'include/inc_css_a_hilitebu.php');
?>

<script language = "javascript">
    <!-- 


    function resetinput()
        {
        document.infoform.reset();
        }

    function pruf(d)
        {
        if (d.<?php echo $input_name; ?>.value == "")
            return false;

        else
            return true
        }

    function parentrefresh()
        {
        window.opener.location.href = "nursing-station-patientdaten-kurve.php?sid=<?php echo "
        $sid & lang = $lang & edit = $edit & station = $station & pn = $pn & tag = $dystart & kmonat = $monstart & jahr
            = $yrstart & tagname = $dyname
        " ?>&nofocus=1";
        }

    function sethilite(d)
        {
        d.focus();
        d.value = d.value + "*";
        d.focus();
        }

    function endhilite(d)
        {
        d.focus();
        d.value = d.value + "**";
        d.focus();
        }
    //-->
</script>

<STYLE type = text/css>
    div.box
        {
        border:       double;
        border-width: thin;
        width:        100%;
        border-color: black;
        }
</style>
</HEAD>

<BODY bgcolor = "#99ccff"
      TEXT = "#000000"
      LINK = "#0000FF"
      VLINK = "#800080"
      topmargin = "0"
      marginheight = "0"
      onLoad = "<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); document.infoform.<?php echo $input_name; ?>.focus();">
    <table border = 0 width = "100%">
        <tr>
            <td><b><font face = verdana,arial size = 5 color = maroon>

                <?php
                echo $title . '<br><font size=4>';
                echo $LDFullDayName[$dyidx] . ' (' . formatDate2Local(date('Y-m-d', mktime(0, 0, 0, $mo, $dy, $yr)),
                                                                      $date_format) . ')</font>';
                ?>

                </font></b>
            </td>

            <td align = "right"
                valign = "top"><a href = "javascript: gethelp('nursing_feverchart_xp.php', '<?php echo $winid ?>',
                                                              '',                          '',
                                                              '<?php echo $title ?>')"><img <?php echo
    createLDImgSrc($root_path, 'hilfe-r.gif', '0') ?>

                <?php
                if ($cfg['dhtml'])
                    echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';
                ?>

                </a><a href = "javascript: window.close()"><img <?php echo
    createLDImgSrc($root_path, 'close2.gif', '0') ?>

                <?php
                if ($cfg['dhtml'])
                    echo 'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';
                ?>

                </a>

                </nobr>
            </td>
        </tr>
    </table>

    <font face = verdana,arial size = 3>

    <form name = "infoform" action = "<?php echo $thisfile ?>" method = "post" onSubmit = "return pruf(this)">
        <font face = verdana,arial size = 2>

        <?php
        if ($count)
            {
            $tbg       ='background="' . $root_path . 'gui/img/common/' . $theme_com_icon . '/tableHeaderbg3.gif"';
        ?>

            <table border = 0 cellpadding = 4 cellspacing = 1 width = 100%>
                <tr bgcolor = "#f6f6f6">
                    <td <?php echo $tbg; ?>><FONT SIZE = -1 FACE = "Arial" color = "#000066"><?php echo $LDTime; ?></td>

                    <td <?php echo
    $tbg; ?>><FONT SIZE = -1 FACE = "Arial" color = "#000066"><?php echo $LDCurrentEntry; ?></td>

                    <td <?php echo
    $tbg; ?>><FONT SIZE = -1 FACE = "Arial" color = "#000066"><?php echo $LDCreatedBy; ?></td>
                </tr>

            <?php
                $toggle=0;

                while ($row=$chartnotes->FetchRow())
                    {
                    if ($toggle)
                        $bgc='#efefef';
                    else
                        $bgc='#f0f0f0';

                    $toggle=!$toggle;
                    //if(!empty($row['short_notes'])) $bgc='yellow';

            ?>

                    <tr bgcolor = "<?php echo $bgc; ?>" valign = "top">
                        <td><FONT SIZE = 1 FACE = "Arial">
                    <?php
                            if ($row['time'])
                                echo $row['time'];
                    ?></td>

                        <td><FONT SIZE = -1 FACE = "Arial" color = "#000033">

                    <?php
                            if (!$sformat && !empty($row['notes']))
                                echo deactivateHotHtml(nl2br($row['notes']));

                            elseif ($sformat && !empty($row['short_notes']))
                                echo '[ ' . deactivateHotHtml($row['short_notes']) . ' ]';
                    ?>
                        </td>

                        <td><FONT SIZE = 1 FACE = "Arial">
                    <?php
                            if ($row['personell_name'])
                                echo $row['personell_name'];
                    ?></td>
                    </tr>

            <?php
                    }
            ?>
            </table>

        <?php
            }

        if ($sformat)
            {
            echo $LDSFormatPrompt
        ?>

            <p>
            <input type = "text" name = "short_notes" value = "<?php echo $short_notes ?>" size = 16 maxlength = 16>

        <?php
            }
        else
            {
        ?>

            <p>
            <font face = verdana,arial size = 2><b><?php echo $LDEntryPrompt ?>:</b>

            <br></font>

            <textarea cols = "16" rows = "10" name = "notes" wrap = "physical"><?php echo $notes ?></textarea>

            <br>
            &nbsp;<a href = "javascript: sethilite(document.infoform.notes)"><img <?php echo
    createComIcon($root_path, 'hilite-s.gif', '0') ?>></a>
            <a href = "javascript: endhilite(document.infoform.notes)"><img <?php echo
    createComIcon($root_path, 'hilite-e.gif', '0') ?>></a>

        <?php
            }
        ?>

        <input type = "hidden" name = "sid" value = "<?php echo $sid ?>">
        <input type = "hidden" name = "lang" value = "<?php echo $lang ?>">
        <input type = "hidden" name = "winid" value = "<?php echo $winid ?>">
        <input type = "hidden" name = "station" value = "<?php echo $station ?>">
        <input type = "hidden" name = "yr" value = "<?php echo $yr ?>">
        <input type = "hidden" name = "mo" value = "<?php echo $mo ?>">
        <input type = "hidden" name = "dy" value = "<?php echo $dy ?>">
        <input type = "hidden" name = "dystart" value = "<?php echo $dystart ?>">
        <input type = "hidden" name = "monstart" value = "<?php echo $monstart ?>">
        <input type = "hidden" name = "yrstart" value = "<?php echo $yrstart ?>">
        <input type = "hidden" name = "dyname" value = "<?php echo $dyname ?>">
        <input type = "hidden" name = "dyidx" value = "<?php echo $dyidx ?>">
        <input type = "hidden" name = "pn" value = "<?php echo $pn ?>">
        <input type = "hidden" name = "edit" value = "<?php echo $edit ?>">
        <input type = "hidden" name = "sformat" value = "<?php echo $sformat ?>">
        <input type = "hidden" name = "mode" value = "save">

        <p>
        <input type = "image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>> &nbsp;&nbsp;
        <!-- <a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
         -->
        &nbsp;&nbsp;

        <?php
        if ($saved):
        ?>

        <a href = "javascript: window.close()"><img <?php echo
    createLDImgSrc($root_path, 'close2.gif', '0') ?>alt = "<?php echo $LDClose ?>"></a>

        <?php
        else:
        ?>

        <a href = "javascript: window.close()"><img <?php echo
    createLDImgSrc($root_path, 'cancel.gif', '0') ?>border = "0" alt = "<?php echo $LDClose ?>"> </a>

        <?php
        endif
        ?>
    </form>
</BODY>

</HTML>