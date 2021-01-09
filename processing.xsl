<!--Created by: Ahmed Ali | 101383139
Description: This page displays the processing xsl-->
<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"> 
<xsl:output method="html" indent="yes"/>
    <xsl:template match="/items">

    <table>
    <thead>
     <tr>
    <th scope="col">Item Number</th>
    <th scope="col">Name</th>
    <th scope="col">Price</th>
    <th scope="col">QTY Available</th>
    <th scope="col">QTY On-Hold</th>
    <th scope="col">QTY Sold</th>
    </tr>
    </thead>

    <xsl:for-each select="item">

        <tr>
        <td> <xsl:value-of select="number"/></td>
        <td><xsl:value-of select="name"/> </td>
        <td><xsl:value-of select="price"/></td>
        <td> <xsl:value-of select="qty"/></td>
        <td> <xsl:value-of select="onhold"/></td>
        <td> <xsl:value-of select="sold"/></td>
        </tr>

    
    </xsl:for-each>

    <tr>
    <td> <input id="button" type="button" value="Process" onclick="clearSold()"/></td>
    </tr>

    </table>
     

    

    </xsl:template>

</xsl:stylesheet>