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
            
            echo $this->Html->script('jquery/jquery-1.4.4.min.js');
            echo $this->Html->script('jquery/ui/jquery-ui-1.8.9.custom.min.js');

            echo $scripts_for_layout;
        ?>
		<script type="text/javascript">
			$(document).ready(function() {
				//accordion
				$("#accordion").accordion();
				
				//login click
				$(".signin").click(function(e) {
					e.preventDefault();
					$("fieldset#signin_menu").toggle();
					$(".signin").toggleClass("menu-open");
				});
				//login fade out
				$("fieldset#signin_menu").mouseup(function() {
					return false
				});
				$(document).mouseup(function(e) {
					if($(e.target).parent("a.signin").length==0) {
						$(".signin").removeClass("menu-open");
						$("fieldset#signin_menu").hide();
					}
				});
				
				//flash message
				setTimeout(function(){
					$(".flash").fadeOut("slow", function () {
					$(".flash").remove();}); }, 2000);
			});
		</script>
    </head>
    <body>
        <div class="page_margins">
            <div class="page">
				<div id="content">
					<div id="topnav">
						<a href="#"><?php echo $authRealname; ?></a> | <?php echo $html->link('Logout','/users/logout') ?> | <a href="#">Contact</a>
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
                    <p>"This is teaser line, which is explain briefly what module you use"</p>
                    <p>"Another line for teaser line..."</p>
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
