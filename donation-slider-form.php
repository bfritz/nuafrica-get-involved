<?php ?>

<a name="give"></a>

<form id="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_donations"/>
  <input type="hidden" name="business" value="info@nuafrica.org"/>
  <input type="hidden" name="lc" value="US"/>
  <input type="hidden" name="amount" value=""/>
  <input type="hidden" name="item_name" value="NuAfrica Donation"/>
  <input type="hidden" name="item_number" value="Get Involved"/>
  <input type="hidden" name="no_note" value="0"/>
  <input type="hidden" name="cn" value="Leave a comment (optional):"/>
  <input type="hidden" name="currency_code" value="USD"/>
  <input type="hidden" name="bn" value="PP-DonationsBF:Donate_button_R1.png:NonHostedGuest"/>
  <input type="hidden" name="return" value="http://nuafrica.org/get-involved/thank-you/"/>
  <input type="hidden" name="cbt" value="Return to NuAfrica Website"/>

 <p>Use slider to select gift amount:</p>

  <div id="slider"></div>

  <div id="donation_box">
    Give <input type="text" id="amount" />
  </div>

  <div id="donation_amounts">
    <a class="amount" style="margin-left: 10px">$10</a>
    <a class="amount" style="margin-left: 10px">$25</a>
    <a class="amount" style="margin-left: 10px">$50</a>
    <a class="amount" style="margin-left: 10px">$100</a>
    <a class="amount" style="margin-left: 15px">$1,000</a>
    <a class="amount" style="margin-left: 15px">$5,000</a>
    <a class="amount" style="margin-left: 15px">$10,000</a>
    <a class="amount" style="margin-left: 15px">$20,000</a>
  </div>
  <div id="impact">
    <h3>Your donation of <span id="donation_amount"></span>
    will:</h3>
    <h2>Give <span id="people_text"></span> clean drinking water for <span class="underline">25 years</span></h2>
  </div>

 
   <input type="image" src="/wp-content/uploads/2010/07/Donate_button_R1.png" border="0" name="submit" alt=Donate to NuAfrica with PayPal"">
    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
  </input>
  
   <h6>100% of contributions will be used to supply water, medicine, &amp; education in Mali<br />
  NuAfrica is a 501(c)(3) organization.  Donations are tax-deductible, as allowed by law.</h6>
  
</form>
<script type="text/javascript">
    jq(document).ready(function() {
        jq("a[name=give]").insertBefore("#donation_target");
        jq("#donation_target").replaceWith(jq("#paypal"));
    });
</script>
<?php ?>
