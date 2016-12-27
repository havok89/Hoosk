<?php header('Content-Type: '.$ctype.'; charset='.$charset); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/"<?php foreach($namespaces as $n) echo " ".$n; ?>>
    <channel>
        <title><?php echo $channel['title'] ?></title>
        <link><![CDATA[<?php echo $channel['link'] ?>]]></link>
        <description><?php echo $channel['description'] ?></description>
        <atom:link href="<?php echo $channel['link'] ?>" rel="self"></atom:link>
        <?php if (!empty($channel['logo'])) : ?>
        <image>
            <url><?php echo $channel['logo'] ?></url>
            <title><?php echo $channel['title'] ?></title>
            <link><?php echo $channel['link'] ?></link>
        </image>
        <?php endif; ?>
        <lastBuildDate><?php echo $channel['pubdate'] ?></lastBuildDate>
        <?php foreach($items as $item) : ?>
        <item>
            <title><?php echo $item['title'] ?></title>
            <link><?php echo $item['link'] ?></link>
            <guid isPermaLink="true"><?php echo $item['link'] ?></guid>
            <description><![CDATA[<?php echo $item['description'] ?>]]></description>
            <?php if (!empty($item['content'])) : ?>
            <content:encoded><![CDATA[<?php echo $item['content'] ?>]]></content:encoded>
            <?php endif; ?>
            <dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/"><?php echo $item['author'] ?></dc:creator>
            <pubDate><?php echo $item['pubdate'] ?></pubDate>
            <?php if (!empty($item['enclosure'])) : ?>
            <enclosure
            <?php foreach ($item['enclosure'] as $k => $v) : ?>
            <?php echo $k.'="'.$v.'" ' ?>
            <?php endforeach; ?>
            />
            <?php endif; ?>
            <?php if (!empty($item['media:content'])) : ?>
            <media:content
            <?php foreach ($item['media:content'] as $k => $v) : ?>
            <?php echo $k.'="'.$v.'" ' ?>
            <?php endforeach; ?>
            />
            <?php endif; ?>
            <?php if (!empty($item['media:thumbnail'])) : ?>
            <media:thumbnail
            <?php foreach ($item['media:thumbnail'] as $k => $v) : ?>
            <?php $k.'="'.$v.'" ' ?>
            <?php endforeach; ?>
            />
            <?php endif; ?>
            <?php if (!empty($item['media:title'])) : ?>
            <media:title type="plain"><?php echo $item['media:title'] ?></media:title>
            <?php endif; ?>
            <?php if (!empty($item['media:description'])) : ?>
            <media:description type="plain"><?php echo $item['media:description'] ?></media:description>
            <?php endif; ?>
            <?php if (!empty($item['media:keywords'])) : ?>
            <media:keywords><?php echo $item['media:title'] ?></media:keywords>
            <?php endif; ?>
            <?php if (!empty($item['media:rating'])) : ?>
            <media:rating><?php echo $item['media:rating'] ?></media:rating>
            <?php endif; ?>
            <?php if (!empty($item['creativeCommons:license'])) : ?>
            <creativeCommons:license><?php echo $item['creativeCommons:license'] ?></creativeCommons:license>
            <?php endif; ?>
        </item>
        <?php endforeach; ?>
    </channel>
</rss>