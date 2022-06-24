<?php header("Content-type: application/xml; charset=utf-8") ?>
<?= '<?xml version="1.0" encoding="UTF-8"?>' ?> 


<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<?php foreach ($pages as $page):?>

    <url>
        <loc><?= $protocol.$_SERVER['SERVER_NAME'].'/'.$page->getSlug() ?></loc>
        <lastmod><?= $page->getDateUpdate() ?></lastmod>
        <priority>1.00</priority>
    </url>
   
<?php endforeach;?>

</urlset>