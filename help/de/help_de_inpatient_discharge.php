<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "$x3 - $x2" ?></b></font>

<p><font size=2 face="verdana,arial" >
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie entlasse ich einen Patienten?</b></font>
<ul>
<b>Schritt 1: </b>Überzeugen Sie sich davon, dass das richtige Entlassungsdatum und die korrekte Uhrzeit
              eingegeben wurden.<br>
<b>Schritt 2: </b>Wählen Sie durch Klick auf den entsprechenden Knopf die Art der Entlassung aus.<br>
	<ul><br>

		<img src="../help/en/img/en_discharge_types.png" border=0 width=366 height=167>

	</ul><p>
<b>Schritt 3: </b>Tragen Sie eventuelle Bemerkungen zur Entlassung im Feld
             "<span style="background-color:yellow" > Bemerkungen: </span>" ein, falls vorhanden. <br>
<b>Schritt 4: </b>Tragen Sie Ihren Namen im Feld
              "<span style="background-color:yellow" > Pflegekraft: <input type="text" name="a" size=20 maxlength=20></span>"
			  ein, falls das Feld leer ist. <br>
<b>Schritt 5: </b>Aktivieren Sie das Feld "
              <span style="background-color:yellow" ><input type="checkbox" name="d" value="d"> Ja, ich bin sicher. Patient entlassen! </span>" field. <br>
<b>Schritt 6: </b>Mit Klick auf den Button <input type="button" value="discharge"> wird die Entlassung ausgelöst.<p>
<b>Schritt 7: </b>Durch Klick auf <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">
              gelangen Sie wieder zurück zum (neuen) Belegungsplan der Station.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich habe versucht, den <input type="button" value="Entlassen">-Knopf anzuklicken, aber es tat sich nichts. Wieso?</b></font>
<ul> <b>Achtung:</b> Die angeführte Checkbox muss aktiviert (angekreuzt) sein wie hier zu sehen: <br>
 " <span style="background-color:yellow" ><input type="checkbox" name="d" value="d" checked> Ja, ich bin sicher. Patient entlassen! </span>". <p>
		<b>Schritt : </b>Bitte klicken Sie auf die Checkbox, falls sie nicht aktiviert (angekreuzt) ist.<p>
</ul>
  <b>Anmerkung: </b>Wenn Sie den Vorgang abbrechen möchten, ohne die Entlassung auszulösen, klicken Sie
  auf den <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle">-Button.</ul>
