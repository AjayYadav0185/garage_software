/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

$(document).ready(function () {
    $(".order_filter").submit(function (event) {
        event.preventDefault();
        let post_url = "filter.php";
        let form_data = $(this).serialize();
        $.post(post_url, form_data, function (response) {
            var last = response.split("</tr>").pop();

            var res = response;
            var lastword = res.lastIndexOf(last);
            var result = res.substring(0, lastword);

            $("#" + last + " table")
                .find("tr:gt(0)")
                .remove();
            $("#" + last + " table .tbodyfiltr_data").html(result);
        });
    });
});
$(document).ready(function () {
    $(document).on("click", ".class_check", function () {
        var tab = $(this).attr("href");
        var filid = tab.substring(1, tab.length);
        $("#tab_text").val(filid);
        $("#custum_hid_id").val(filid);
    });
    $(document).on("click", ".shipment_custom", function () {
        var costum_val = $("#to_date").val();
        var costum_val2 = $("#from_date").val();
        var tabtext34 = $("#custum_hid_id").val();
        $.ajax({
            method: "POST",
            url: "filter.php",
            data: {
                costum_val: costum_val,
                costum_val2: costum_val2,
                tabtext34: tabtext34,
            },
            success: function (data) {
                var last = data.split("</tr>").pop();
                var res = data;
                var lastword = res.lastIndexOf(last);
                var result = res.substring(0, lastword);
                $("#" + last + "")
                    .find("tr:gt(0)")
                    .remove();
                $("#" + last + "")
                    .find(".tbodyfiltr_data")
                    .html(result);
                $("#msg").html(data);
            },
        });
    });
});

function checkbox(id, cla) {
    $("#" + id).on("click", function () {
        if (this.checked) {
            $("." + cla).each(function () {
                this.checked = true;
            });
        } else {
            $("." + cla).each(function () {
                this.checked = false;
            });
        }
    });

    singleCheckbox(id, cla);
}
function singleCheckbox(id, cla) {
    if ($(`.${cla}:checked`).length == $("." + cla).length) {
        $("#" + id).prop("checked", true);
    } else {
        $("#" + id).prop("checked", false);
    }
}

function manageOrder(ids, msg, url, comma = false) {
    var myCheckboxes = new Array();

    $(`#${ids} input:checked`).each(function () {
        var id = $(this).val();
        if (id != "on")
            comma == true
                ? myCheckboxes.push("'" + id + "'")
                : myCheckboxes.push(id);
        // myCheckboxes.push("'" + id + "'");
        // myCheckboxes.push(id);
    });
    if (myCheckboxes.length >= 1) {
        Swal.fire({
            title: "Are you sure?",
            text: `You are about to process ${myCheckboxes.length} orders.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, process them!",
            cancelButtonText: "No, cancel!",
            customClass: {
                popup: "small-swal-popup",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Please wait...",
                    html: `Processing ${myCheckboxes.length} orders...`,
                    customClass: {
                        popup: "small-swal-popup",
                    },
                });

                Swal.showLoading();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        status: 1,
                        myCheckboxes: myCheckboxes,
                    },
                    success: function (response) {
                        if (response.success == true) {
                            let msg = `✅ Success: ${response.success_count}\n❌ Failed: ${response.failed_count}`;
                            Swal.fire({
                                icon: "success",
                                title: "<h5 style='font-size:18px;margin:0;'>Order Cancellation Result</h5>",
                                text: msg,
                                customClass: {
                                    popup: "small-swal-popup",
                                },
                            }).then(function () {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: response.msg,
                                customClass: {
                                    popup: "small-swal-popup",
                                },
                            });
                        }
                    },
                });
            } else {
                Swal.fire({
                    icon: "info",
                    title: "Cancelled",
                    text: "Processing has been cancelled.",
                    customClass: {
                        popup: "small-swal-popup",
                    },
                });
            }
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Error!",
            text: msg,
            width: "400px",
            customClass: {
                popup: "small-swal-popup",
            },
        });

        //toastr.error(msg);
    }
}

const swalStyle = document.createElement("style");
swalStyle.type = "text/css";
swalStyle.innerHTML = `
    .swal-wide {
        width: 300px !important;
        height: auto !important;
    }
`;
document.head.appendChild(swalStyle);

function oripindetails(a) {
    var pinlen = a.length;

    if (pinlen == 6) {
        var pincode = a;

        // City
        $.ajax({
            type: "GET",
            url: "get-retailer-city",
            data: {
                pincode: pincode,
                pintype: "origin",
            },
            success: function (data) {
                document.getElementById("originpin-city").textContent = data;
                $("#originpin-city").val(data);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
        // State
        $.ajax({
            type: "GET",
            url: "get-retailer-state",
            data: {
                pincode: pincode,
                pintype: "origin",
            },
            success: function (data) {
                $("#originpin-state").val(data);
                $("#originpin-state-show").html(data);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
        // Country
        $.ajax({
            type: "GET",
            url: "get-retailer-country",
            data: {
                pincode: pincode,
                pintype: "origin",
            },
            success: function (data) {
                $("#originpin-country").val(data);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
        precheckcalculaterate();
    } else {
        return false;
    }
}

// create update bala function

function despindetails(a) {
    var pinlen = a.length;
    // alert(pinlen);
    if (pinlen == 6) {
        var pincode = a;
        // City
        $.ajax({
            type: "GET",
            url: "get-retailer-city",
            data: {
                pincode: pincode,
                pintype: "destin",
            },
            success: function (data) {
                // alert(data);
                // console.log(data);
                document.getElementById("destinationpin-city").textContent =
                    data;

                $("#destinationpin-city").val(data);
                $("#customer-city").val(data);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
        // State
        $.ajax({
            type: "GET",
            url: "get-retailer-state",
            data: {
                pincode: pincode,
                pintype: "destin",
            },
            success: function (data) {
                $("#destinationpin-state").val(data);
                $("#customer-state").val(data);
                document.getElementById("destinationpin-state").textContent =
                    data;
                $("#destinationpin-state-show").html(data);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
        // Country
        $.ajax({
            type: "GET",
            url: "get-retailer-country",
            data: {
                pincode: pincode,
                pintype: "destin",
            },
            success: function (data) {
                $("#demo-destinationpin-country").val(data);
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });

        $.ajax({
            type: "GET",
            url: "findPincode",
            data: {
                pincode: pincode,
            },
            success: function (data) {
                if (data.message == "Pincode not found") {
                    $("#destinationpincode").val("");
                    $("#destinationpincode").attr("placeholder", data.message);
                } else {
                }
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    }

    // Calculation Check
    precheckcalculaterate();

    calculaterateLen();
}

function precheckcalculaterate() {
    var oripin = $("#originpincode").val();
    var destinpin = $("#destinationpincode").val();

    // Distance Between

    $.ajax({
        type: "GET",
        url: "distance-calculator",
        data: {
            oripin: oripin,
            destinpin: destinpin,
        },
        success: function (data) {
            $("#distancebtwnkm").val(data);
            calculaterateLen();
        },
        error: function (data) {
            console.log("Error:", data);
        },
    });

    // Distance Between
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function ucWords(str) {
    str = str.toLowerCase().replace(/\b[a-z]/g, function (letter) {
        return letter.toUpperCase();
    });
    return str;
}

function calculaterateLen() {
    var distancebtwnkm0 = $("#distancebtwnkm").val();

    console.log(distancebtwnkm0);

    // alert(distancebtwnkm0);
    var oripin = $("#originpincode").val();
    var oripincity = $("#originpin-city").val();

    var oripinstate = $("#originpin-state").val();
    var oripincountry = $("#originpin-country").val();

    var destinpin = $("#destinationpincode").val();

    var destinpincity = $("#destinationpin-city").val();

    var destinpinstate = $("#destinationpin-state").val();

    var destinpincountry = $("#destinationpin-country").val();

    var distancebtwn = $("#distancebtwn").val();
    var actualweight = $("#actualweight").val();

    var lenghtcm = $("#lenghtcm").val();
    var heightcm = $("#heightcm").val();
    var breadthcm = $("#breadthcm").val();

    var valueininr = $("#valueininr").val();
    var paymentmode = $("#paymentmode").val();
    var servicestype = $("#servicestype").val();
    var productamount = $("#productamount").val();

    // Check Zone C
    const metrostates = [
        "New Delhi",
        "Delhi",
        "Lucknow",
        "Mumbai",
        "Kolkata",
        "Chennai",
        "Bangalore",
        "Hyderabad",
        "Ahmedabad",
        "Pune",
        "Visakhapatnam",
        "Surat",
        "Jaipur",
        "Coimbatore",
        "Kanpur",
        "Nagpur",
        "Raipur",
        "Kochi",
        "Kozhikode",
        "Nashik",
        "Salem",
        "Thiruvananthapuram",
        "Madurai",
        "Jodhpur",
    ];
    // console.log(metrostates);
    var pickmertocityis = metrostates.includes(oripincity);
    var destmertocityis = metrostates.includes(destinpincity);

    // Check Zone E
    const ezonestates = ["Kerala", "Himachal Pradesh", "Jammu And Kashmir"];
    // Check Zone F
    const fzonestates = ["Andaman and Nicobar Islands", "Manipur", "Kashmir"];
    oripincity = ucWords(oripincity);
    destinpincity = ucWords(destinpincity);
    destinpinstate = ucWords(destinpinstate);
    oripinstate = ucWords(oripinstate);
    if (oripincity === destinpincity) {
        $("#zonebtwn").html("A");
        $("#zonebtwn1").val("A");
        // Temp Code
    } else if (
        oripinstate === destinpinstate &&
        !metrostates.includes(destinpinstate) &&
        !ezonestates.includes(destinpinstate) &&
        !fzonestates.includes(destinpinstate) &&
        distancebtwnkm0 < 500
    ) {
        $("#zonebtwn").html("B");
        $("#zonebtwn1").val("B");
    } else if (
        fzonestates.includes(destinpinstate) ||
        fzonestates.includes(oripinstate)
    ) {
        if (oripincity === destinpincity) {
            $("#zonebtwn").html("A");
            $("#zonebtwn1").val("A");
        } else if (oripinstate === destinpinstate && distancebtwnkm0 < 500) {
            $("#zonebtwn").html("B");
            $("#zonebtwn1").val("B");
        } else {
            $("#zonebtwn").html("F");
            $("#zonebtwn1").val("F");
        }
        // Temp Code
    } else if (
        ezonestates.includes(destinpinstate) ||
        ezonestates.includes(oripinstate)
    ) {
        if (oripincity === destinpincity) {
            $("#zonebtwn").html("A");
            $("#zonebtwn1").val("A");
        } else if (oripinstate === destinpinstate && distancebtwnkm0 < 500) {
            $("#zonebtwn").html("B");
            $("#zonebtwn1").val("B");
        } else {
            $("#zonebtwn").html("E");
            $("#zonebtwn1").val("E");
        }
    } else if (
        metrostates.includes(oripincity) &&
        metrostates.includes(destinpincity)
    ) {
        if (oripincity === destinpincity) {
            $("#zonebtwn").html("A");
            $("#zonebtwn1").val("A");
        } else if (oripinstate === destinpinstate && distancebtwnkm0 < 500) {
            $("#zonebtwn").html("B");
            $("#zonebtwn1").val("B");
        } else {
            $("#zonebtwn").html("C");
            $("#zonebtwn1").val("C");
        }
    } else if (
        !metrostates.includes(oripincity) &&
        !metrostates.includes(destinpincity) &&
        !ezonestates.includes(destinpincity) &&
        !fzonestates.includes(destinpincity) &&
        distancebtwnkm0 > 500
    ) {
        $("#zonebtwn").html("D");
        $("#zonebtwn1").val("D");
    } else {
        $("#zonebtwn").html("D");
        $("#zonebtwn1").val("D");
    }
    $("#pikcuppinno").html(oripin);
    $("#destinpinno").html(destinpin);

    $("#chargingweight").html(actualweight + " KG");

    $("#servicebtwn").html(servicestype);
    $("#distncebtwn").html(distancebtwn);
}
function calculateraterefresh() {
    // Calculation Check
    precheckcalculaterate();
    // Estimate Amount
    checklaneandamt();
}

function freightWeight() {
    var actualweight = $("#actualweight").val();
    var VolumetricWeight = $("#VolumetricWeight").val();
    var Weightpick = actualweight;

    if (VolumetricWeight > actualweight) {
        var Weightpick = VolumetricWeight;
    }

    Weightpickshow = Weightpick + " KG";
    $("#FreightWeightare").val(Weightpick);
    $("#FreightWeightshow").val(Weightpickshow);
}

function VolumetricWeightCal(datachange, cateis) {
    // if(cateis == "length"){
    var vlength = $("#lenghtcm").val();
    // if(vlength == 0){  $("#vlength").val(1) }
    var vlengthlen = vlength.length;
    if (vlengthlen == 0) {
        vlength = 1;
    }
    // alert("Len" + vlengthlen);
    // }
    // if(cateis == "breadth"){
    var vbreadth = $("#breadthcm").val();
    // if(vbreadth == 0){  $("#vbreadth").val(1) }
    var vbreadthlen = vbreadth.length;
    if (vbreadthlen == 0) {
        vbreadth = 1;
    }
    // alert("Bre" + vbreadthlen);
    // }
    // if(cateis == "height"){
    var vheight = $("#heightcm").val();
    // if(vheight == 0){  $("#vheight").val(1) }
    var vheightlen = vheight.length;
    if (vheightlen == 0) {
        vheight = 1;
    }
    // alert("Hei" + vheightlen);
    // }
    var valumetricweight = (vlength * vbreadth * vheight) / 5000;
    // alert("Res" + valumetricweight);
    valumetricweightshow = valumetricweight + " KG";
    $("#VolumetricWeight").val(valumetricweight);
    $("#VolumetricWeightshow").val(valumetricweightshow);

    freightWeight();
}

function tablePrint() {
    var mode = "iframe"; //popup
    var close = mode == "popup";
    var options = {
        mode: mode,
        popClose: close,
    };

    $(".printableArea2").printArea(options);

    // setTimeout(function () {

    //     location.reload();
    // }, 5000);
}
//  let  order_id='';
let label_print = 0;
//  function downloadPDF2(pdf5) {
//     $.each(pdf5, function(key,val){
//             let dd= val;
//         $.each(dd, function(key,val){

//             if(key == 'data'){
//                 var pdf = val;
//             }
//             if(key == 'oid'){
//                  order_id = val;
//             }

//       const linkSource = `data:application/pdf;base64,${pdf}`;
//     const downloadLink = document.createElement("a");
//     const fileName = `amazon`+ order_id +`.pdf`;
//     downloadLink.href = linkSource;
//     downloadLink.download = fileName;
//      downloadLink.click();

//     });
//          label_print++;
//     });
//     return label_print;
//  }
function downloadPDF2(pdf5) {
    $.each(pdf5, function (index, item) {
        if (item.hasOwnProperty("data") && item.hasOwnProperty("oid")) {
            const pdf = item.data;
            const order_id = item.oid;
            const linkSource = `data:application/pdf;base64,${pdf}`;
            const downloadLink = document.createElement("a");
            const fileName = `amazon${order_id}.pdf`;
            downloadLink.href = linkSource;
            downloadLink.download = fileName;
            downloadLink.click();
            label_print++;
        }
    });
    return label_print;
}
