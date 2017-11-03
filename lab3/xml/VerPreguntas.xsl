<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" omit-xml-declaration="yes" version="1.0" encoding="utf-8" indent="yes"/>

<xsl:template match="assessmentItems">
    <h1 align="center">Preguntas</h1>
    <table border="1">
        <tr>
            <td width="15%">Complejidad</td>
            <td width="2%">Tema</td>
            <td width="10%">Autor</td>
            <td width="10%">Enunciado</td>
            <td width="10%">Respuesta correcta</td>
            <td width="10%">Respuestas incorrectas</td>
        </tr>
        <xsl:for-each select="assessmentItem">
            <tr>
                <td><xsl:value-of select="@complexity" /></td>
                <td><xsl:value-of select="@subject" /></td>
                <td><xsl:value-of select="@author" /></td>
                <td><xsl:value-of select="itemBody" /></td>
                <td><xsl:value-of select="correctResponse/value" /></td>
                <td><xsl:value-of select="incorrectResponses" /></td>
            </tr>
        </xsl:for-each>
    </table>
</xsl:template>
</xsl:stylesheet>