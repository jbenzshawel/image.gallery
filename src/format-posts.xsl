<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
 xmlns:dc="http://purl.org/dc/elements/1.1/" 
 xmlns:media="http://search.yahoo.com/mrss/"
 xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

 <xsl:output method="html" />
	<xsl:template match="/">  
		<xsl:for-each select="rss/channel/item" >
			<xsl:if test="position() > $after" >
				<!--POST-->
				<ul class="post">
					<xsl:variable name="postLink" select="link" />
					<li><a href="{$postLink}" target="_blank"><xsl:value-of select="title"/></a></li>
					<xsl:variable name="descriptionCheck" select="description" />
					<xsl:if test="not(contains($descriptionCheck, 'img'))">
						<li><img src="http://placehold.it/75x75" /></li>
					</xsl:if>
					<xsl:if test="contains($descriptionCheck, 'gifs')">
						<li><img src="http://placehold.it/75x75" /></li>
					</xsl:if>
					<li><xsl:value-of select="description" disable-output-escaping="yes"/></li>
					<!--<li><xsl:number value="positon()" format="1." /></li>-->
				</ul>
			</xsl:if>
		</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>