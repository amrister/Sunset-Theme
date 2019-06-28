<?php
/*
	@package Sunset-theme
  This Template is for Conact Form
*/
?>

<div class="container">
  <div class="m-auto">
    <div class="sunset-contact-form">
      <form class="form" action="sunset-contact.php" method="post" id="js-ContactForm" data-url="<?php echo admin_url('admin-ajax.php');?>" >
        <div class="form-group">
          <input class="form-control" type="text" name="name" id="name" value="" placeholder="Your Name" >
          <small class="user-error-msg">Your Name is Required</small>
        </div>
        <div class="form-group">
          <input class="form-control" type="email" name="email" id="email" value="" placeholder="Your Email" >
          <small class="user-error-msg">Your Email is Required</small>
        </div>
        <div class="form-group">
          <textarea class="form-control" type="text" name="message" id="message" value="" placeholder="Your Message" ></textarea>
          <small class="user-error-msg">Your Message is Required</small>
        </div>
        <input type="submit" value="submit" class="btn btn-dark">
        <div class="feedbacks">
          <p class="valid-feedback">Perfect, Mesaage send successfully!</p>
          <p class="processing-feedback">Handling Request ...</p>
          <p class="invalid-feedback">Error!, Something went wrong, Please try again later</p>
        </div>
      </form>
    </div>
  </div>
</div>
