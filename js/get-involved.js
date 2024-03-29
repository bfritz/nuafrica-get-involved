/*
    Functions to support donation slider.

    Written for NuAfrica by Brad Fritz, brad [at] fewerhassles.com,
    on Sat Nov  6 12:54:53 EDT 2010 during IndyGiveCamp.

    Latest code and project history can be found at:
    https://github.com/bfritz/nuafrica-get-involved

    Inspired by Egor Khmelev's jslider:
    http://hmelyoff.github.com/jslider/
*/

var jq = jQuery.noConflict();

var flashImpact = _.debounce(_flashImpact, 300);

var PEOPLE_HELPED_PER_DOLLAR = 4/25;

var MIN = 10;
var MAX = 10000;
var DONATION_BY_SLIDER_PERCENT = ['0/10', '12/25', '24/50', '40/100', '60/1000', '100/10000']

function calculateImpact(amount) {
    return Math.floor(amount * PEOPLE_HELPED_PER_DOLLAR);
}

function generateScale() {
    var h = DONATION_BY_SLIDER_PERCENT;

    var percents = [h.length];
    var amounts = [h.length];
    var scaleStr = "";
    for ( var i = 0; i < h.length; i++ ) {
        v = h[i].split("/");
        percents[i] = v[0];
        amounts[i] = v[1];
    }

    for ( var i = 0; i < amounts.length; i++ ) {
        var formatted = jq.formatNumber(amounts[i], {format: "$#,###", locale: "us"});

        scaleStr += '<span style="left: ' + percents[i] + '%;"><ins class="amount">'
            + formatted
            + '</ins></span>';
    }
    return scaleStr;
}

function percentToValue(pct) {
    var h = DONATION_BY_SLIDER_PERCENT;

    var _start = 0;
    var _from = MIN;

    for ( var i = 0; i <= h.length; i++ ) {
        if ( ! h[i] ) break;

        var v = h[i].split("/");
        v[0] = new Number(v[0]);
        v[1] = new Number(v[1]);

        if ( pct >= _start && pct <= v[0] ) {
            var _num = (pct-_start) * (v[1]-_from);
            if (_num == 0 ) {
                return _from;
            } else {
                return _from + _num / (v[0]-_start);
            }
        }

        _start = v[0];
        _from = v[1];
    }
}

function valueToPercent(value) {
    var h = DONATION_BY_SLIDER_PERCENT;

    var _start = 0;
    var _from = MIN;

    for ( var i = 0; i <= h.length; i++ ) {
        if ( ! h[i] ) break;

        var v = h[i].split("/");
        v[0] = new Number(v[0]);
        v[1] = new Number(v[1]);

        if ( value >= _from && value <= v[1] ) {
            var _num = (value-_from) * (v[0]-_start);
            if ( _num == 0 ) {
                return _start;
            } else {
                return _start + _num / (v[1]-_from);
            }
        }

        _start = v[0];
        _from = v[1];
    }
}

function moveSlider(amount) {
    var pct = valueToPercent(amount) || 0;
    jq("#slider").slider("value", pct);
    // log('moved slider');
}

function updateAmountText(amount) {
    jq("#typed_amount").val(amount);
    // try/catch below is ugly hack to work around apparent bug in
    // locale/format initialization in jquery.numberformatter-1.2.1
    try {
        jq("#typed_amount").formatNumber({format: "$#,###", locale: "us"});
    } catch(e) {
        jq("#typed_amount").formatNumber({format: "$#,###", locale: "us"});
    }
    // log('updated amount');
}

function updatePayPal() {
    jq("#paypal input[name=amount]").val(
        jq("#typed_amount").parseNumber({format: "#,###", locale: "us"}, false));
}

function _flashImpact(amount) {
    var formattedDonationAmount = jq("#typed_amount").val();
    jq("#donation_amount").text(formattedDonationAmount);

    var numPeopleHelped = calculateImpact(amount);
    var suffix = numPeopleHelped == 1 ? " person" : " people";

    // format the number of people helped
    var formattedPeople = jq.formatNumber(numPeopleHelped, {format: "#,###", locale: "us"})
        + suffix;

    jq("#people_text").text(formattedPeople);

    jq("#impact").effect('highlight', {}, 2000);
    // log('flashed impact message');
}

jq(document).ready(function() {
    var initialDonation = 25;
    // add and initialize the slider
    jq("#slider").slider({
        value: valueToPercent(initialDonation),
        min: 0,
        max: 100,
        step: 1,
        slide: function(event, ui) {
            var amt = percentToValue(ui.value);
            updateAmountText(amt);
        },
        change: function(event, ui) {
            var amt = percentToValue(ui.value);
            flashImpact(amt);
        }
    });

    // add scale to slider
    jq("#donation_amounts").html(generateScale());

    // update donation amount when user clicks on links for specific dollar amounts
    jq(".amount").click(function(event) {
        var amt = jq(event.target).parseNumber({format: "#,###", locale: "us"}, false);
        updateAmountText(amt);
        moveSlider(amt);
        flashImpact(amt);
    });

    // format manually entered amounts and sync slider
    jq("#typed_amount").on("blur", function() {
        var amt = jq(this).parseNumber({format: "#,###", locale: "us"}, false);
        updateAmountText(amt);
        moveSlider(amt);
        flashImpact(amt);
    });

    // initialize amount text field and impact statement
    updateAmountText(initialDonation);
    flashImpact(initialDonation);
});

function prepareDonationForm() {
    jq("a[name=give]").insertBefore("#donation_target");
    jq("#donation_target").replaceWith(jq("#paypal"));
    jq("#paypal").show();
    jq("#paypal").submit(updatePayPal);
    // center scale values
    var w = jq("#donation_amounts").width();
    jq("#donation_amounts span ins").each(function(){
        var percentRight = jq(this).parent().position().left / w;
        var offset = percentRight * -1 * (30 + (jq(this).outerWidth() / 2));
        jq(this).css({marginLeft: offset});
    });
}
