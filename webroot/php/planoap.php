<tr><td id="tdcenter" colspan="2">Plano de Aplica��o Detalhado</td></tr>
<%
While !QRYPLANOAP->(eof())
%>
<tr>
<td><%=Capital(alltrim(QRYPLANOAP->NMNATUREZA))%></td>
<td id="tdgray">R$ <%=Transform(QRYPLANOAP->VL_TOTAL,"@E 999,999,999,999.99")%> ( <%=Capital(alltrim(QRYPLANOAP->TXDESCRICA))%> )</td>
</tr>
<%
	QRYPLANOAP->(DbSkip())
Enddo
%>
