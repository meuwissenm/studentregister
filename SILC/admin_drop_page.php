<?php
include_once('functions.php');

do_html_header("Admin drop course for student");

show_admin_menu();
?>
<hr>
<?php
admin_drop_form();

do_html_footer();

?>