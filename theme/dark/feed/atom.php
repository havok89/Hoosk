<?php header('Content-Type: '.$ctype.'; charset='.$charset); ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'."\n"; ?>
<feed xmlns="http://www.w3.org/2005/Atom"<?php foreach($namespaces as $n) echo " ".$n; ?>>
    <title type="text"><?php echo $channel['title'] ?></title>
    <subtitle type="html"><![CDATA[<?php echo $channel['description'] ?>]]></subtitle>
    <link href="<?php echo $channel['link'] ?>"></link>
    <id><?php echo $channel['link'] ?></id>
    <link rel="alternate" type="text/html" href="<?php echo $channel['link'] ?>" ></link>
    <link rel="self" type="application/atom+xml" href="<?php echo $channel['link'] ?>" ></link>
    <?php if (!empty($channel['logo'])) : ?>
    <logo><?php echo $channel['logo'] ?></logo>
    <?php endif; ?>
    <?php if (!empty($channel['icon'])) : ?>
    <icon><?php echo $channel['icon'] ?></icon>
    <?php endif; ?>
        <updated><?php echo $channel['pubdate'] ?></updated>
        <?php foreach($items as $item) : ?>
        <entry>
            <author>
                <name><?php echo $item['author'] ?></name>
            </author>
            <title type="text"><?php echo $item['title'] ?></title>
            <link rel="alternate" type="text/html" href="<?php echo $item['link'] ?>"></link>
            <id><?php echo $item['link'] ?></id>
            <summary type="html"><![CDATA[<?php echo $item['description'] ?>]]></summary>
            <content type="html"><![CDATA[<?php echo $item['content'] ?>]]></content>
            <updated><?php echo $item['pubdate'] ?></updated>
        </entry>
        <?php endforeach; ?>
</feed>