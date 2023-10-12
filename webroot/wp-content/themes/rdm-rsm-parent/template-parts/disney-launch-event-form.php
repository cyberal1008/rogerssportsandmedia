<div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/styles/event-form.css"> 
    <div id="successMsg" style="display: none;">
        <h2 class="success-msg">
            <i class="fa fa-check-circle success-msg-icon">
            </i>Thank you for registering! Please keep an eye out in your inbox for additional event details.
        </h2>
    </div>
    <form id="SubForm" class="formContainer" method="POST" onsubmit="return validate()" autocomplete="off">
        <div class="container">
            <div class="row">
                <div class="column">
                    <input type="text" id="firstname" placeholder="First Name*" name="firstname">
                    <p class="errormsg" id="fnameerrormsg">First Name is required
                    </p>
                </div>
                <div class="column">
                    <input type="text" id="lastname" placeholder="Last Name*" name="lastname">
                    <p class="errormsg" id="lnameerrormsg">Last Name is required
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <input type="text" id="email" placeholder="Email Address*" name="email">
                    <p class="errormsg" id="emailerrormsg">Email Address is required
                    </p>
                    <p class="errormsg" id="invalidEmailMsg">Email Address is not valid
                    </p>
                    <p class="errormsg" id="corpEmailErrMsg">You can not submit your request here
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <script
                        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
                    <input type="tel" id="phone" placeholder="Phone Number*" name="phone">
                    <p class="errormsg" id="phnnoerrormsg">Phone Number is required
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <input type="text" id="company" placeholder="Company*" name="company">
                    <p class="errormsg" id="companyerrormsg">Company is required
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <input type="text" id="job" placeholder="Job Title*" name="job">
                    <p class="errormsg" id="jobtitleerrormsg">Job Title is required
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <select id="country" name="country" style="color:gray;">
                        <option value="" disabled="" selected="">Country</option>
                        <option id="canada" value="Canada">Canada</option>
                        <option id="us" value="United States">United States</option>
                        <option id="international" value="International">International</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <select id="has_guest" name="has_guest" style="color:gray;">
                        <option value="" disabled="" selected="">Will you be bringing a guest?</option>
                        <option id="no" value="no">No</option>
                        <option id="yes" value="yes">Yes, 1 Guest</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="custColumn">
                    <label for="optInCb">
                        <input type="checkbox" class="filled-in" name="optIn" id="optInCb" style="margin-bottom:15px; margin-left:0px">
                        I want to stay up to date with email communications from Rogers Sports &
                        Media on the latest news, events and more. I understand I can unsubscribe at any time. <a
                            href="https://www.rogers.com/consumer/privacy-crtc" target="_blank">View Privacy Policy.</a>
                    </label>
                </div>
            </div>

            <div class="column">
                <div class="clearfix">
                    <input id="submitted" name="submitted" type="hidden" value="false">
                    <input type="hidden" name="action" value="submit_single_event_form" />
                    <br>
                    <button type="submit" class="subscribebtn" value="Submit"><b>Submit
                        </b> </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
  $('#phone').mask('(999) 999-9999');
  
  $('.SubForm').on('submit', function(e) {
    $('#successMsg').animate({ 'scrollTop' : 0 }, 800);
  });

  $("select").change(function() {
    $(this).css('color','#333333');
  });

  function validate() {
    event.preventDefault();

    var fNameCheck = document.getElementById("firstname");
    var lNameCheck = document.getElementById("lastname");
    var emailCheck = document.getElementById("email");
    var companyCheck = document.getElementById("company");
    var industryCheck = document.getElementById("industry");   
    var jobTtileCheck = document.getElementById("job");
    var phnNoCheck = document.getElementById("phone");
    
    submitOK="true";
    var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    
    if(fNameCheck.value.trim() == "" || lNameCheck.value.trim() == "" || emailCheck.value.trim() == "" || emailreg.test(emailCheck.value.trim()) == false 
       //|| emailCheck.value.trim().split('@')[1].includes('rogers') == true 
     || companyCheck.value.trim() == "" || phnNoCheck.value.trim() == "" || phnNoCheck.value == "(___) ___-____" || jobTtileCheck.value.trim() == "")
    {
      if (fNameCheck.value.trim() == "") {
        document.getElementById("fnameerrormsg").style.display = "inline";
        document.getElementById("firstname").focus();
        document.getElementById("firstname").style.border="1px solid red";
        submitOK="false";
      }
      else{
        document.getElementById("fnameerrormsg").style.display = "none";
        document.getElementById("firstname").style.border="1px solid #ccc";
      }
      if (lNameCheck.value.trim() == "") {
        document.getElementById("lnameerrormsg").style.display = "inline";
        document.getElementById("lastname").focus();
        document.getElementById("lastname").style.border="1px solid red";
        submitOK="false";
      }
      else{
        document.getElementById("lnameerrormsg").style.display = "none";
        document.getElementById("lastname").style.border="1px solid #ccc";
      }
      if (emailCheck.value.trim() == "") {
        document.getElementById("invalidEmailMsg").style.display = "none";
        document.getElementById("corpEmailErrMsg").style.display = "none";
        document.getElementById("emailerrormsg").style.display = "inline";
        document.getElementById("email").focus();
        document.getElementById("email").style.border="1px solid red";
        submitOK="false";
      }
      else if(emailreg.test(emailCheck.value.trim()) == false){
        document.getElementById("emailerrormsg").style.display = "none";
        document.getElementById("corpEmailErrMsg").style.display = "none";
        document.getElementById("invalidEmailMsg").style.display = "inline";
        document.getElementById("email").focus();
        document.getElementById("email").style.border="1px solid red";
        submitOK="false";
      }
      else{
        document.getElementById("emailerrormsg").style.display = "none";
        document.getElementById("invalidEmailMsg").style.display = "none";
        document.getElementById("corpEmailErrMsg").style.display = "none";
        document.getElementById("email").style.border="1px solid #ccc";
      }
      if (companyCheck.value.trim() == "") {
        document.getElementById("companyerrormsg").style.display = "inline";
        document.getElementById("company").focus();
        document.getElementById("company").style.border="1px solid red";
        submitOK="false";
      }
      else{
        document.getElementById("companyerrormsg").style.display = "none";
        document.getElementById("company").style.border="1px solid #ccc";
      }
      if (phnNoCheck.value.trim() == "" || phnNoCheck.value == "(___) ___-____") {
        document.getElementById("phnnoerrormsg").style.display = "inline";
        document.getElementById("phone").focus();
        document.getElementById("phone").style.border="1px solid red";
        submitOK="false";
      }
      else{
        document.getElementById("phnnoerrormsg").style.display = "none";
        document.getElementById("phone").style.border="1px solid #ccc";
      }
      if (jobTtileCheck.value.trim() == "") {
        document.getElementById("jobtitleerrormsg").style.display = "inline";
        document.getElementById("job").focus();
        document.getElementById("job").style.border="1px solid red";
        submitOK="false";
      }
      else{
        document.getElementById("jobtitleerrormsg").style.display = "none";
        document.getElementById("job").style.border="1px solid #ccc";
      }     
    }
    if (submitOK=="false") {
        event.preventDefault();
        event.stopImmediatePropagation();
        return false;
    }
    else{
        document.getElementById("submitted").value = "true";
        const data = {
            'form_name': 'disney-launch',
            'firstname': fNameCheck.value,
            'lastname': lNameCheck.value,
            'emailaddress': emailCheck.value,
            'phonenumber': phnNoCheck.value,
            'company': companyCheck.value,
            'job_title': jobTtileCheck.value,
            'country': document.getElementById("country").value,
            "has_guest": document.getElementById("has_guest").value,
            "opt_in_cb": document.getElementById("optInCb").checked,
            'action': document.getElementsByName("action")[0].value
        }

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/wp-admin/admin-ajax.php",
            data: data,
            success: function(result) {
                if(result.hasOwnProperty('eventInstanceId')) {
                    document.getElementById("successMsg").style.display = "block";
                    document.getElementById("SubForm").reset();
                    $('#SubForm').hide();
                } else {
                    alert("An issue may have occurred. Kindly contact support.");
                }
            },
            error : function(xhr, status, error) {
                alert(status);
            }
        });
    }
  }
</script>