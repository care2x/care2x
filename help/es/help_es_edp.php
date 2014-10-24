<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<font face="Verdana, Arial" size=3 color="#0000cc"> <b> Procesamiento electrónico 
de datos  
<?php
	if($x1=='edit') $x1='update';
	switch($src)
	{
	case "access": 
		switch($x1)
						{
							case "": print "Creando los derechos de acceso";
												break;
							case "save": print "Se ha guardado el nuevo derecho de acceso";
												break;
							case "list": print "Derechos de acceso existentes";
												break;
							case "update": print "Editando un derecho de acceso existente";
												break;
							case "lock":  if($x2=="0") print "Locking"; else print "Desbloqueando"; print  " un derecho existente";
												break;
							case "delete": print "Eliminando un derecho de acceso";
												break;
						}
						break;
	}


 ?>
</b></font> 
<form action="#" >
  <?php if($src=="access") : ?>
  <?php if($x1=="") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">�Cómo se crea un nuevo derecho 
  de acceso?</font></b> </font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Escriba 
    el nombre completo de la persona, o departmento, clinica, etc en el campo"<span style="background-color:yellow" > 
    Nombre </span>".<br>
    <b>Paso 2: </b>Escriba el nombre de usuario en el campo "<span style="background-color:yellow" > 
    Nombe de Usuario</span>" . </font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota:</b> No se 
      permiten espacios para el nombre de usuario. </font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 3: </b>Escriba 
      la contraseña para el usuario en el campo "<span style="background-color:yellow" > 
      Contraseña</span>" .<br>
      <b>Paso 4: </b>Seleccione las areas donde el usuario tendrá permisos de 
      acceso en el campo "<span style="background-color:yellow" > Area # </span>". 
      </font>
    <p> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Nota:</b> Un usuario 
      puede tener un máximo de 10 areas de acceso (Area 1 a 10). </font>
    <p> 
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Ya ingresé todos los datos ¿Como salvar 
  los permisos de acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en el botón 
    <input type="button" value="Salvar">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($x1=="save") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  El nuevo acceso está salvado ahora. �Como creo otro acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    al botón 
    <input type="button" value="Crear un nuevo usuario">
    .<br>
    <b>Paso 2: </b>Aparecerá la misma forma.<br>
    <b>Paso 3: </b>Siga las instrucciones de crear un nuevo acceso.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como puedo ver la lista de todos los derechos de 
  acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Dé clic 
    en el botón 
    <input type="button" value="Lista actual de derechos de acceso">
    .<br>
    <b>Paso 2: </b>Se mostrará la lista actual de derechos de acceso<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($x1=="list") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  Los botones <img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> 
  y<img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> ¿que 
  significan y que hacen?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','padlock.gif','0','absmiddle') ?>> 
    = Los derechos de acceso para este usuario están bloqueados o congelados. 
    No puede tener acceso a las areas a las que tenía acceso.<br>
    <img <?php echo createComIcon('../','arrow-gr.gif','0','absmiddle') ?>> = 
    El acceso de este usuario está libre. Podrá entrar a las areas permitidas 
    previamente para él.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> Las opciones"C","L", and "D", or "U" </b></font></font><font color="#990000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>¿que 
  significan y que hacen?</b></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>C: </b> = Cambiar o 
    editar los datos de acceso del usuario.<br>
    <b>L: </b> = Cierra los derechos de acceso del usuario.<br>
    <b>D: </b> = Borra el acceso a ese usuario.<br>
    <b>U: </b> = Libera los derechos de acceso de un usuario (Actualmente cerrados).<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como cambiar o editar los datos de acceso del usuario?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a la opcion "<span style="background-color:yellow" > 
    C </span>" correspondiente al usuario.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como cerrar los derechos de acceso del usuario?</b> 
  </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a la opcion "<span style="background-color:yellow" > 
    L</span>" correspondiente al usuario.<br>
    <br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como Liberar los derechos de acceso de un usuario 
  (Actualmente cerrados)</b>? </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a la opcion "<span style="background-color:yellow" > 
    U</span>" correspondiente al usuario.<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> �Como borrar el acceso a ese usuario?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Dé clic a la opcion "<span style="background-color:yellow" > 
    D</span>" correspondiente al usuario.<br>
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($x1=="update") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  ¿Como editar algun derecho de acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Edite la 
    información.<br>
    <b>Paso 2: </b>Dé clic en el botón 
    <input type="button" value="Salvar">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si decide no editar dé 
    clic al botón
    <input type="button" value="Cancelar">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  <?php endif;?>
  <?php if($x1=="delete") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b> 
  �Como borrar los derechos de acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Si usted 
    esta seguro de borrarlo ,<br>
    dé clic al botón 
    <input type="button" value="Si, Estoy bien seguro. Borrar este derecho de acceso.">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si decide no borrar dé 
    clic al botón 
    <input type="button" value="Cancelar">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  <?php endif;?>
  <?php if($x1=="lock") : ?>
  <img <?php echo createComIcon('../','frage.gif','0') ?>> 
  <font color="#990000"><b> ¿Cómo 
  <?php if($x2=="0") print "lock"; else print "unlock"; ?>
  un derecho de acceso?</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b>Paso 1: </b>Si está 
    seguro de querer 
    <?php if($x2=="0") print "lock"; else print "unlock"; ?>
    el derecho de acceso,<br>
    dé clic al botón 
    <input type="button" value="Si, Estoy seguro.">
    .<br>
    </font>
  </ul>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
  <font color="#990000"><b> Nota:</b> </font></font> 
  <ul>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Si usted decide no 
    <?php if($x2=="0") print "lock"; else print "unlock"; ?>
    dé clic al botón
    <input type="button" value="No. Regresar.">
    .</font><br>
</ul>
	
	<?php endif;?>		
<?php endif;?>	

	</form>

