// ** I18N

// Calendar SQ language
// Author: Gjergj Sheldija
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Calendar._DN = new Array
("Diele",
 "Hene",
 "Marte",
 "Merkure",
 "Enjte",
 "Premte",
 "shtune",
 "Diele");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("Die",
 "Hen",
 "Mar",
 "Mer",
 "Enj",
 "Pre",
 "sht",
 "Die");

// full month names
Calendar._MN = new Array
("Janar",
 "Shkurt",
 "Mars",
 "Prill",
 "Maj",
 "Qershor",
 "Korrik",
 "Gusht",
 "Shtator",
 "Tetor",
 "Nentor",
 "Dhjetor");

// short month names
Calendar._SMN = new Array
("Jan",
 "Shku",
 "Mar",
 "Pri",
 "Maj",
 "Qer",
 "Korr",
 "Gush",
 "Sht",
 "Tet",
 "Nen",
 "Dhj");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "Rreth kalendarit";

Calendar._TT["ABOUT"] =
"Zgjedhja e dates:\n" +
"- Perdor \xab, \xbb butonat per te zgjedhur vitin\n" +
"- Perdor " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " butonat per te zgjedhur muajin\n" ;
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Zgjedhja e ores:\n" +
"- Kliko mbi cdonjeren prej fushave per ta shtuar\n" +
"- ose Shift-click per ta zbritura ate\n" +
"- ose klik dhe terheq per me shpejt.";

Calendar._TT["PREV_YEAR"] = "Nje vit prapa (mbaj per menu)";
Calendar._TT["PREV_MONTH"] = "Nje muaj prapa (mbaj per menu)";
Calendar._TT["GO_TODAY"] = "Sot";
Calendar._TT["NEXT_MONTH"] = "Nje muaj para (mbaj per menu)";
Calendar._TT["NEXT_YEAR"] = "Nje vit para (mbaj per menu)";
Calendar._TT["SEL_DATE"] = "Zgjidh daten";
Calendar._TT["DRAG_TO_MOVE"] = "Terhiq per te spostuar";
Calendar._TT["PART_TODAY"] = " (sot)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "Trego %s te parat";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "Mbyll";
Calendar._TT["TODAY"] = "Sot";
Calendar._TT["TIME_PART"] = "(Shift-)Click or drag to change value";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%a, %b %e";

Calendar._TT["WK"] = "jv";
Calendar._TT["TIME"] = "Ora:";
