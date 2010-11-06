<?php ?>
<form id="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_donations"/>
  <input type="hidden" name="business" value="info@nuafrica.org"/>
  <input type="hidden" name="lc" value="US"/>
  <input type="hidden" name="amount" value=""/>
  <input type="hidden" name="item_name" value="NuAfrica Donation"/>
  <input type="hidden" name="item_number" value="Getting Involved"/>
  <input type="hidden" name="no_note" value="0"/>
  <input type="hidden" name="currency_code" value="USD"/>
  <input type="hidden" name="bn" value="PP-DonationsBF:Donate_button_R1.png:NonHostedGuest"/>

  <div id="donation_box">
    Donate
    <input type="text" id="amount" style="border: 1px solid black; color: #f6931f; font-weight: bold;" />
    to build solar powered wells.
  </div>

  <div id="slider" style="float: left;"></div>

  <input type="image" src="/wp-content/uploads/2010/07/Donate_button_R1.png" border="0" name="submit" alt=Donate to NuAfrica with PayPal"">
    <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
  </input>
  <div id="donation_amounts">
    <a class="amount" style="margin-left: 10px">$10</a>
    <a class="amount" style="margin-left: 10px">$25</a>
    <a class="amount" style="margin-left: 10px">$50</a>
    <a class="amount" style="margin-left: 10px">$100</a>
    <a class="amount" style="margin-left: 10px">$1,000</a>
    <a class="amount" style="margin-left: 10px">$5,000</a>
    <a class="amount" style="margin-left: 10px">$10,000</a>
    <a class="amount" style="margin-left: 10px">$20,000</a>
  </div>
  <div id="impact">
    Your donation of <span id="donation_amount"></span>
    will help <span id="people_text"></span>
    have clean drinking water for 25 years.
  </div>
</form>
<?php ?>
