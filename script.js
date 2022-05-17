jQuery(document).ready(function () {

    function countArray(arr, word) {
        let count = 0;
        arr.forEach(element => {
            if (element === word) {
                count += 1;
            }
        });
        return count;
    }

    jQuery('#package_form input').on('change', function () {
        // console.log('input change');
        var number_of_adults = 0;
        var number_of_childrens = 0;
        var numberofrooms = 0;
        number_of_adults = parseInt(jQuery('#number_of_adults').val() ? jQuery('#number_of_adults').val() : 0);
        number_of_childrens = parseInt(jQuery('#number_of_childrens').val() ? jQuery('#number_of_childrens').val() : 0);


        var room_allotment = [{

        }]

        room_count = 0;
        adults = [];
        threeAdultsRoom = ['A', 'A', 'A'];

        numberOfAdultsLoop = number_of_adults;

        for (var i = 0; i <= number_of_adults; i++) {
            if (numberOfAdultsLoop != 0) {
                if (numberOfAdultsLoop >= 3) {
                    room_allotment[room_count] = threeAdultsRoom;
                    numberOfAdultsLoop = numberOfAdultsLoop - 3;
                    room_count++;
                } else {
                    for (var j = 1; j <= numberOfAdultsLoop; j++) {
                        adults.push('A');
                    }
                    room_allotment[room_count] = adults;
                    numberOfAdultsLoop = 0;
                }
            }
        }


        function checkRoomsFull() {
            for (var roomNum = 0; roomNum < room_allotment.length; roomNum++) {
                numOfPeopleInTheRoom = room_allotment[roomNum].length;
                if (numOfPeopleInTheRoom < 4) {
                    return false;
                }
            }
            return true;
        }

        numOfChildrensSudo = number_of_childrens;

        for (var roomNum = 0; roomNum < room_allotment.length; roomNum++) {
            var childrenPush = [];
            for (var child = 1; child <= number_of_childrens; child++) {
                if (!checkRoomsFull()) {
                    if (numOfChildrensSudo != 0) {
                        numOfPeopleInTheRoom = room_allotment[roomNum].length;
                        if (numOfPeopleInTheRoom < 4) {
                            childrenPush = [...room_allotment[roomNum]];
                            childrenPush.push('c');
                            room_allotment[roomNum] = childrenPush;
                            numOfChildrensSudo = numOfChildrensSudo - 1;
                        } else {
                            continue;
                        }
                    }
                }
                else {
                    currentRoomNum = room_allotment.length;
                    extrachildrens = numOfChildrensSudo;
                    childrenPush = [];
                    for (var l = 1; l <= numOfChildrensSudo; l++) {
                        if (extrachildrens != 0) {
                            if (extrachildrens >= 4) {
                                childrenPush.push('c', 'c', 'c', 'c');
                                room_allotment[currentRoomNum] = childrenPush;
                                childrenPush = [];
                                currentRoomNum++;
                                extrachildrens = extrachildrens - 4;
                            } else {
                                extrachildrenPush = [];
                                console.log('extrachildren', extrachildrens);
                                for (var q = 0; q < extrachildrens; q++) {
                                    // console.log('push')
                                    extrachildrenPush.push('c');
                                }
                                console.log('currentRoomNum', currentRoomNum);
                                console.log(extrachildrenPush);
                                room_allotment[currentRoomNum] = [...extrachildrenPush];
                                extrachildrens = 0;
                            }
                        }
                    }
                }
            }
        }

        console.log(room_allotment);
        // loop end


        if (numberofrooms > 3) {
            // console.log('inside if contdiotion');
            jQuery(".need-more-rooms").css("display", "block")
            jQuery('input[type="submit"]').attr('disabled', 'disabled');
        } else {
            jQuery(".need-more-rooms").css("display", "none")
            jQuery('input[type="submit"]').removeAttr('disabled');
        }

        totalCalc();
        jQuery('#number_of_rooms').val(room_allotment.length);


    });

    function setDateFormat(date) {
        DateObj = new Date(date);
        var day = DateObj.getDate();
        var month = DateObj.getMonth() + 1;
        var fullYear = DateObj.getFullYear().toString();
        var setformattedDate = '';
        setformattedDate = fullYear + '-' + getDigitToFormat(month) + '-' + getDigitToFormat(day);
        return setformattedDate;
    }

    function getDigitToFormat(val) {

        if (val < 10) {
            val = '0' + val;
        }

        return val.toString();
    }

    jQuery('#check_in_date').change(function () {
        var addDays = $("#number_of_days").val() ? $("#number_of_days").val() : 0;
        var check_in_date = $("#check_in_date").val();
        var ModifyInDate = new Date(setDateFormat(check_in_date));
        var NewDate = ModifyInDate.setDate(ModifyInDate.getDate() + parseInt(addDays));
        NewDate = new Date(NewDate);
        if (NewDate != "Invalid Date") {
            console.log(setDateFormat(NewDate))
            $("#checkout_date").val(setDateFormat(NewDate));
        }
    })

    jQuery('#package_type, #meal_plan').change(function () {
        totalCalc();
    });

    function totalCalc() {
        var package_name = jQuery('#package_name').val();
        var package_type = parseInt(jQuery('#package_type').val() ? jQuery('#package_type').val() : 0);
        var meal_plans = parseInt(jQuery('#meal_plan').val() ? jQuery('#meal_plan').val() : 0);
        var number_of_rooms = parseInt(jQuery('#number_of_rooms').val() ? jQuery('#number_of_rooms').val() : 0);
        var grandTotal = (package_type + meal_plans) * number_of_rooms;
        jQuery('#total_price').text(grandTotal);
        jQuery('#total_field').val(grandTotal);
    };

    jQuery('#package_form').submit(function (e) {
        console.log('submit clicked')
        e.preventDefault();
        var number_of_adults = jQuery('#number_of_adults').val();
        var number_of_childrens = jQuery('#number_of_childrens').val();
        var package_name = jQuery('#package_name').val();
        var package_type = jQuery('#package_type option:selected').text();
        var meal_plans = jQuery('#meal_plan option:selected').text();
        var number_of_rooms = jQuery('#number_of_rooms').val();
        var grandTotal = (package_type + meal_plans) * number_of_rooms;
        var formData = jQuery('#package_form').serialize();
        // console.log(formData);
        jQuery.ajax({
            type: "post",
            url: myAjax.ajaxurl,
            data: formData,
            success: function (response) {
                console.log('response')
                console.log(response);

                jQuery("#success-message").html('Thank you, Email sent')

            }
        });
        console.log('ajax closed');

    })

    function contactNum() {
        if (jQuery("#contactnumcheck").is(":checked")) {
            jQuery('#whatsapp_num').val(jQuery('#contact_num').val());
            jQuery('#whatsapp_num').attr('readonly', 'readonly');
        } else {
            jQuery('#whatsapp_num').removeAttr('readonly');
        }
    }

    jQuery('#contactnumcheck').click(function () {
        contactNum();
    })
});