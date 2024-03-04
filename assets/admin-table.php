<h2>Contact List Table</h2>
<p>Note:- Use short code "contact_form_wp". (Key:- contact_form_wp)</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email ID</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php

    global $wpdb;
  
    $table_name = $wpdb->prefix.'contact_form_table';
    $result = $wpdb->get_results ( "SELECT * FROM $table_name" );
  
    foreach ( $result as $print ){
?>
    <tr>
      <td scope="row"><?php echo $print->id; ?></td>
      <td><?php echo $print->full_name; ?></td>
      <td><?php echo $print->email_id; ?></td>
      <td><?php echo $print->user_subject; ?></td>
      <td><?php echo $print->user_message; ?></td>
      <td><a class="btn btn-danger delete-som-record" href="<?php echo esc_url(home_url('/'));?>" data-id="<?=$print->id; ?>">Deleted</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>