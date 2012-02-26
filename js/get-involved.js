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
    jq("#amount").val(amount);
    // try/catch below is ugly hack to work around apparent bug in
    // locale/format initialization in jquery.numberformatter-1.2.1
    try {
        jq("#amount").formatNumber({format: "$#,###", locale: "us"});
    } catch(e) {
        jq("#amount").formatNumber({format: "$#,###", locale: "us"});
    }
    // log('updated amount');
}

function updatePayPal(amount) {
    jq("#paypal input[name=amount]").val(amount);
}

function _flashImpact(amount) {
    var formattedDonationAmount = jq("#amount").val();
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
