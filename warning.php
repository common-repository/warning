<?php
/*
Plugin Name: Warning
Plugin URI:
Description: Show warning for category or post
Version: 1.0
Author: Re4DeR
Author URI: http://re4der.info/
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



function warning() {


$message = get_option('warning_message');

$category = get_the_category();

$category = $category[0]->cat_ID ;

$show_in = get_option('category_with_warning');

$alert_confirm = alert;




if ($category ==$show_in) { ?>

<script>

var alertmessage="<?php echo $message; ?>"

//Alert only once per browser session (0=no, 1=yes)
var once_per_session=1


function get_cookie(Name) {
  var search = Name + "="
  var returnvalue = "";
  if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search)
    if (offset != -1) { // if cookie exists
      offset += search.length
      // set index of beginning of value
      end = document.cookie.indexOf(";", offset);
      // set index of end of cookie value
      if (end == -1)
         end = document.cookie.length;
      returnvalue=unescape(document.cookie.substring(offset, end))
      }
   }
  return returnvalue;
}

function alertornot(){
if (get_cookie('alerted')==''){
loadalert()
document.cookie="alerted=yes"
}
}

function loadalert(){
alert(alertmessage)
}

if (once_per_session==0)
loadalert()
else
alertornot()

</script>



<?php } else { ?>
<?php }


}


function my_plugin_menu() {
  add_options_page('My Plugin Options', 'Warning', 8, 'your-unique-identifier', 'my_plugin_options');
}

function my_plugin_options() {   ?>
<div class="wrap">
<h2>Your Plugin Name</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">ID of category with warning (include all post in category)</th>
<td><input type="text" name="category_with_warning" value="<?php echo get_option('category_with_warning'); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Warning message</th>
<td><textarea name="warning_message" cols="40" rows="10" ><?php echo get_option('warning_message'); ?></textarea>I am sorry but you cant use "enter" here. Use \n instead  </td>

</tr>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="category_with_warning, warning_message" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>

<?php }




add_action('admin_menu', 'my_plugin_menu');
add_action('wp_footer', 'warning');


?>