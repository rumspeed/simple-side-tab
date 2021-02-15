<?php

/**
 * This file is used for inline styles that are added to the <head>
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */
?>

<style type='text/css'>
/* START Styles Simple Side Tab v<?php echo SIMPLE_SIDE_TAB_VERSION ?> */
#rum_sst_tab {
    font-family:<?php echo $this->settings->font_family; ?>;
    top:<?php echo $this->settings->pixels_from_top; ?>px;
    background-color:<?php echo $this->settings->tab_color; ?>;
    color:<?php echo $this->settings->text_color; ?>;
    border-style:solid;
    border-width:0px;
}

#rum_sst_tab:hover {
    background-color: <?php echo $this->settings->hover_color; ?>;
<?php
    if ( $this->settings->text_shadow ) {
        if ( $this->settings->left_right == 'left' ) {
echo '	-moz-box-shadow:    -3px 3px 5px 2px #ccc;' . "\n";
echo '	-webkit-box-shadow: -3px 3px 5px 2px #ccc;' . "\n";
echo '	box-shadow:         -3px 3px 5px 2px #ccc;' . "\n";
            } else {
echo '	-moz-box-shadow:    -3px -3px 5px 2px #ccc;' . "\n";
echo '	-webkit-box-shadow: -3px -3px 5px 2px #ccc;' . "\n";
echo '	box-shadow:         -3px -3px 5px 2px #ccc;' . "\n";			
        }
    }
?>
}
.rum_sst_contents {
    position:fixed;
    margin:0;
    padding:6px 13px 8px 13px;
    text-decoration:none;
    text-align:center;
    font-size:15px;
    font-weight:<?php echo $this->settings->get_font_weight(); ?>;
    border-style:solid;
    display:block;
    z-index:100000;
}
.rum_sst_left {
    left:-2px;
    cursor: pointer;
    -webkit-transform-origin:0 0;
    -moz-transform-origin:0 0;
    -o-transform-origin:0 0;
    -ms-transform-origin:0 0;
    -webkit-transform:rotate(270deg);
    -moz-transform:rotate(270deg);
    -ms-transform:rotate(270deg);
    -o-transform:rotate(270deg);
    transform:rotate(270deg);
    -moz-border-radius-bottomright:10px;
    border-bottom-right-radius:10px;
    -moz-border-radius-bottomleft:10px;
    border-bottom-left-radius:10px;
}
.rum_sst_right {
    right:-1px;
    cursor: pointer;
    -webkit-transform-origin:100% 100%;
    -moz-transform-origin:100% 100%;
    -o-transform-origin:100% 100%;
    -ms-transform-origin:100% 100%;
    -webkit-transform:rotate(-90deg);
    -moz-transform:rotate(-90deg);
    -ms-transform:rotate(-90deg);
    -o-transform:rotate(-90deg);
    transform:rotate(-90deg);
    -moz-border-radius-topright:10px;
    border-top-right-radius:10px;
    -moz-border-radius-topleft:10px;
    border-top-left-radius:10px;
}
.rum_sst_right.less-ie-9 {
    right:-120px;
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
}
.rum_sst_left.less-ie-9 {
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
/* END Styles Simple Side Tab */
</style>
