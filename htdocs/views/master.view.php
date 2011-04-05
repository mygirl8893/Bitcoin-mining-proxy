<?php

require_once(dirname(__FILE__) . '/../mvc.inc.php');

abstract class MasterView
    extends ViewBase
    implements IHtmlView
{
    protected abstract function renderBody();

    protected function getTitle()
    {
        die('No page title set.');
    }

    public function renderHtmlHeaders()
    {
    }

    protected function displayNoticeList($key)
    {
        $notices = get_tempdata($key);

        if (count($notices) == 0) {
            return;
        }

?>
    <ul class="<?php echo_html($key) ?>">
    <?php foreach ($notices as $notice) { ?>
        <li><?php echo_html($notice) ?></li>
    <?php } ?>
    </ul>
<?php

    }

    public function renderHtml()
    {
        echo '<?xml version="1.0" encoding="UTF-8" ?>';

        if (!isset($this->viewdata['title'])) {
            $title = $this->getTitle();
        } else {
            $title = $this->viewdata['title'];
        }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo_html($title) ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo_html(make_url('/assets/style.css')) ?>" />
    </head>
    <body>
        <h1><?php echo_html($title) ?></h1>

        <ul id="navmenu">
            <li><a href="<?php echo_html(make_url('/admin/')) ?>"><img src="<?php echo_html(make_url('/assets/icons/report.png')) ?>" /> Dashboard</a></li>
            <li><a href="<?php echo_html(make_url('/admin/workers.php')) ?>"><img src="<?php echo_html(make_url('/assets/icons/cog.png')) ?>" /> Workers</a></li>
        </ul>

<?php
    $this->displayNoticeList('errors');
    $this->displayNoticeList('info');

    $this->renderBody();
?>

    </body>
</html>

<?php
    }
}
