<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('cake.generic');
            echo $this->Html->css('jquery-ui/redmond/jquery-ui');
            echo $this->Html->css('yaml/cakespore');
            echo "<!--[if lte IE 7]>";
            echo $this->Html->css('yaml/patches/cakespore');
            echo "<![endif]-->";
            echo $this->Html->script('jquery/jquery.min.js');
            echo $this->Html->script('jquery-ui/jquery-ui.min.js');
            // ajax manager
            echo $this->Html->script('jquery-ui/plugin/jquery.ajaxmanager.js');

            echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div class="page_margins">
            <div class="page">
                <div id="header">
                    <div id="topnav">
                        <!-- start: skip link navigation -->
                        <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
                        <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
                        <!-- end: skip link navigation --><a href="#">Login</a> | <a href="#">Contact</a> | <a href="#">Imprint</a>
                    </div>
                </div>
                <div id="nav">
                    <!-- skiplink anchor: navigation -->
                    <a id="navigation" name="navigation"></a>
                    <div class="hlist">
                    <!-- main navigation: horizontal list -->
                        <ul>
                            <li class="active"><strong>Button 1</strong></li>
                            <li><a href="#">Button 2</a></li>
                            <li><a href="#">Button 3</a></li>
                            <li><a href="#">Button 4</a></li>
                            <li><a href="#">Button 5</a></li>
                        </ul>
                    </div>
                </div>
                <div id="teaser">
                    <p>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</p>
                    <p>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</p>
                </div>
                <div id="main">
                    <div id="col1">
                        <div id="col1_content" class="clearfix">
                            <!-- add your content here -->
                            <?php                             
                            echo $this->element('accordion');
                            ?>
                        </div>
                    </div>
                    <div id="col3">
                        <div id="col3_content" class="clearfix">
                            <!-- add your content here -->
                            <?php echo $this->Session->flash(); ?>
                            <?php echo $this->Session->flash('auth'); ?>

                            <?php echo $content_for_layout; ?>
                        </div>
                        <!-- IE Column Clearing -->
                        <div id="ie_clearing"> &#160; </div>
                    </div>
                </div>
                <!-- begin: #footer -->
                <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
                </div>
            </div>
        </div>

    </body>
</html>
