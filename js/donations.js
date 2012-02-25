/*
    Functions to support donation slider.

    Written for NuAfrica by Brad Fritz, brad [at] fewerhassles.com,
    on Sat Nov  6 12:54:53 EDT 2010 during IndyGiveCamp.
*/

var jq = jQuery.noConflict();

function calculateImpact(amount) {
    // -0.01 offset prior to rounding so 1.5 rounds to 1 person instead of 2 people
    return Math.round(amount * 0.15 - 0.01);
}

function moveSlider(amount) {
    jq("#slider").slider("value", amount);
    // console.log('moved slider');
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
    // console.log('updated amount');
}

function updatePayPal(amount) {
    jq("#paypal input[name=amount]").val(amount);
}

function flashImpact(amount) {
    // jq.debounce(250, function() {
    var formattedDonationAmount = jq("#amount").val();
    jq("#donation_amount").text(formattedDonationAmount);

    var numPeopleHelped = calculateImpact(amount);
    var suffix = numPeopleHelped == 1 ? " person" : " people";

    // format the number of people helped
    var formattedPeople = jq.formatNumber(numPeopleHelped, {format: "#,###", locale: "us"})
        + suffix;

    jq("#people_text").text(formattedPeople);

    jq("#impact").effect('highlight', {}, 2000);
    // console.log('flashed impact message');
    // });
}
