{:form}
<table border="1" width="500" align="center">
   <caption>{:FORMNAME}</caption>
{:action="dbform_null,select,insert,update,delete,cancel"}
   <tr>
      <td width="100">Search:</td>
      <td width="300">{:FIELD="dbform_searchid"}</td>
      <td width="100">{:button="select"}</td>
   </tr>
   <tr>
      <td colspan="3">&nbsp;{:status}</td>
   </tr>
{:end action}
   <tr>
      <td colspan="3" align="center">
{:action="dbform_null,select,insert,update,delete,cancel"}
      <!--  {:BUTTON="new"}-->
{:end action}
{:ACTION="select,insert,update"}
         {:BUTTON="update"}
     <!-- {:button="delete"}-->
{:END ACTION}
{:ACTION="new"}
         {:button="insert"}
         {:button="cancel"}
{:END ACTION}
      </td>
   </tr>
{:ACTION="new,insert,select,update"}
{:EACH FIELD}
   <tr>
      <td width="100">{:fieldname}</td>
      <td width="400" colspan="2">{:field style="color: green;"}</td>
   </tr>
{:END FIELD}
{:end action}
</table>
{:hidden}

</form>