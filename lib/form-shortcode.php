<?php // The shortcode function
function form_shortcode()
{
    ob_start();
?>
    <form action="" id="package_form">


        <div class="row">
            <div class="form-field">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-field"><label class="form-label"><b>Name</b></label><input class="form-control" type="text" name="name" id="" required></div>
                    </div> <br>
                    <div class="col-sm-3">
                        <div class="form-field"><label class="form-label"><b>Email</b></label><input class="form-control" type="email" name="email" id="" required></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-field"><label class="form-label"><b>Contact Number</b></label><input class="form-control" type="tel" name="contact_num" id="contact_num" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-field"><label class="form-label">
                            <b>Whatsapp Number</b></label><input class="form-control" type="tel" name="whatsapp_num" id="whatsapp_num" required readonly>
                            <label><input type="checkbox" name="contactnumcheck" id="contactnumcheck" /> Same as Contact Number</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        

        <div class="row">
            <input type="hidden" name="number_of_days" id="number_of_days" value="<?php echo get_post_meta(get_the_ID(), 'number_of_days', true); ?>">
            <div class="form-field col-4">
                <label class="form-label"><b>Checkin date</b></label>
                <input class="form-control" type="date" name="check_in_date" id="check_in_date" required>
            </div>
            <div class="form-field col-4">
                <label class="form-label"><b>Checkout date</b></label>
                <input class="form-control" type="date" name="checkout_date" id="checkout_date" readonly>
            </div>
            <div class="form-field col-4"></div>

        </div> <br>

        <div class="row">
            <div class="form-field col-4">
                <label class="form-label"><b>Number of adults</b></label>
                <input class="form-control" required type="number" min="0" name="number_of_adults" id="number_of_adults" placeholder="Number of adults">
            </div>
            <div class="form-field col-4">
                <label class="form-label"><b>Number of Childrens</b></label>
                <input class="form-control" required min="0" type="number" name="number_of_childrens" id="number_of_childrens" placeholder="Number of children">
            </div>
            <div class="form-field col-4">
                <label class="form-label"><b>Number of rooms</b></label>
                <input class="form-control" type="number" readonly name="number_of_rooms" id="number_of_rooms" placeholder="Number of rooms">
                <div class="need-more-rooms" style="display: none;"><button class="btn btn-primary">need more rooms</button></div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-sm-4">
                <div class="">
                    <label for="" class="form-label"><b>Package name</b></label>
                    <input type="text" name="package_name" id="package_name" class="form-control" value=" <?php single_post_title(); ?> " readonly>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="">
                    <label for="" class="form-label"><b>Package type</b></label>
                    <select name="package_type" id="package_type" class="form-control" required>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'premium_pricing', true); ?>">Premium Packages - Best available Hotel</option>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'luxury_pricing', true); ?>">Luxury Packages - Equivalent 4* Hotel</option>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'deluxe_pricing', true); ?>">Deluxe Packages - Equivalent 3* Hotel</option>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'standard_pricing', true); ?>">Standard Packages - Equivalent 2* Hotel with Basic Facilities</option>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'economy_pricing', true); ?>">Economy Packages - Equivalent 1* Hotel with Basic Facilities</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="">
                    <label for="" class="form-label"><b>Meal plans</b></label>
                    <select name="meal_plans" id="meal_plan" class="form-control" required>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'cp', true); ?>">Breakfast only (CP)</option>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'map', true); ?>">Breakfast and Dinner (MAP)</option>
                        <option value="<?php echo get_post_meta(get_the_ID(), 'ap', true); ?>">Breakfast, Lunch and Dinner ( AP)</option>
                    </select>
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div class="col-sm-5">
                <div>
                    <label for="" class="form-label"><b>Other info</b></label>
                    <textarea name="other_info" id="" class="form-control" cols="25" rows="5"></textarea>
                </div>
            </div>
            <div class="col-sm-5">
                <div>
                    <label for="" class="form-label"><b>Any other details which you feel we should discuss</b></label>
                    <textarea name="other_details" id="" class="form-control" cols="15" rows="5"></textarea>
                </div>
            </div>
            <div class="col-sm-2">
                <div>
                    <h4>Total price:<p id="total_price"></p>
                    </h4>
                    <input type="hidden" name="grandTotal" id="total_field">
                </div>
            </div>
        </div> <br>

        <div class="row">
            <div>
                <input type="hidden" name="action" value="ajax_submit">
                <div id="success-message"></div>
                <input type="submit" class="btn btn-primary" value="submit">
            </div> <br>
        </div> <br>
    </form>

<?php
    $string = ob_get_contents();
    ob_end_clean();
    return $string;
}
// Register shortcode
add_shortcode('hotel_booking_form', 'form_shortcode');
