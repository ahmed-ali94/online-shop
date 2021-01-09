<!--Created by: Ahmed Ali | 101383139
Description: This page displays the confirm purschase table -->
<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:exsl="http://exslt.org/common">  <!-- Using an extension fuction called node-set whcih can perform the calculation easily -->
<xsl:output method="html" indent="yes"/>
    <xsl:template match="/items">
     
    <xsl:variable name="purchaseTotal">

     <xsl:for-each select="//item[onhold > 0]">

          <total>

              <xsl:value-of select="price * onhold" />

          </total>

     </xsl:for-each>

</xsl:variable>

    
    Your purchase has been confirmed and the total amount due to pay is : $<xsl:value-of select="sum(exsl:node-set($purchaseTotal)/total)"/> <br />
    

    </xsl:template>

</xsl:stylesheet>