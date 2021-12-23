<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="xml" indent="yes"/>

<xsl:template match="node()|@*">
  <xsl:copy>
    <xsl:apply-templates select="node()|@*"/>
  </xsl:copy>
</xsl:template>

<xsl:template match="@nazwa">
   <xsl:attribute name="name">
      <xsl:value-of select="."/>
   </xsl:attribute>
</xsl:template>
<xsl:template match="@NLocation">
   <xsl:attribute name="lat">
      <xsl:value-of select="."/>
   </xsl:attribute>
</xsl:template>
<xsl:template match="@ELocation">
   <xsl:attribute name="lng">
      <xsl:value-of select="."/>
   </xsl:attribute>
</xsl:template>


</xsl:stylesheet>