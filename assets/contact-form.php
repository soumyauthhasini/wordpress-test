<form method="POST" id="contactForm som-wp-form" action="<?php echo esc_url(home_url('/'));?>" name="contactForm" class="contactForm">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="label" for="name">Full Name*</label>
        <input type="text" class="form-control" name="name" id="som-wp-name" placeholder="Name">
      </div>
    </div>
    <div class="col-md-6"> 
      <div class="form-group">
        <label class="label" for="email">Email Address</label>
        <input type="email" class="form-control" name="email" id="som-wp-email" placeholder="Email">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="label" for="subject">Subject</label>
        <input type="text" class="form-control" name="subject" id="som-wp-subject" placeholder="Subject">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="label" for="#">Message</label>
        <textarea name="message" class="form-control" id="som-wp-message" cols="30" rows="4" placeholder="Message"></textarea>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <input type="submit" value="Send Message" class="btn btn-primary" id="som-wp-submit">
        <div class="submitting" id="som-wp-status"></div>
      </div>
    </div>
  </div>
</form>