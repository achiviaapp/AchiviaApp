"use strict";

// Class definition
var KTUserAdd = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_user_add_user', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function (wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })

        // Change event
        wizard.on('change', function (wizard) {

            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var project = $('#projectId').children("option:selected").html();
            var platform = $('#platform').children("option:selected").html();


            var title = $('#title').val();
            var note = $('#note').val();
            var campaign = $('#campaignId').children("option:selected").html();
            var campaignVal = $('#campaignId').children("option:selected").val();
            var marketer = $('#marketerId').children("option:selected").html();
            var marketerVal = $('#marketerId').children("option:selected").val();
            var sale = $('#saleId').children("option:selected").html();
            var saleVal = $('#saleId').children("option:selected").val();
            var projectOne = $('.projectOne').children("option:selected").html();
            var projectOneVal = $('.projectOne').children("option:selected").val();
            var projectTwo = $('.projectTwo').children("option:selected").html();
            var projectTwoVal = $('.projectTwo').children("option:selected").val();
            var interest = $('#projectId').children("option:selected").val();
            var property = $('#property').children("option:selected").html();
            var propertyVal = $('#property').children("option:selected").val();
            var propertyUtility = $('#propertyUtility').children("option:selected").html();
            var propertyUtilityVal = $('#propertyUtility').children("option:selected").val();
            var propertyLocation = $('#propertyLocation').val();
            var date = $('#date').children("option:selected").html();
            var dateVal = $('#date').children("option:selected").val();
            var from = $('#from').val();
            var to = $('#to').val();
            var budget = $('#budget').val();
            var area = from + ' - ' + to;

            $('#myName').text(name);
            $('#myPhone').text(phone);
            $('#myEmail').text(email);
            $('#myProject').text(project);
            $('#myPlatform').text(platform);
            $('#myTitle').text(title);
            $('#myNote').text(note);
            $('#myCampaign').text(campaign);
            $('#myMarketer').text(marketer);
            $('#mySale').text(sale);
            $('#interest').val(interest);
            $('#myProperty').text(property);
            $('#myPropertyLocation').text(propertyLocation);
            $('#myPropertyUtility').text(propertyUtility);
            $('#myArea').text(area);
            $('#myBudget').text(budget);
            $('#myDate').text(date);
            $('#myProjectOne').text(projectOne);
            $('#myProjectTwo').text(projectTwo);

            if (title !== '') {
                $('#myTitle').parent().removeClass('hidden');
                $('#myTitle').parent().show();
            } else {
                $('#myTitle').parent().addClass('hidden');
                $('#myTitle').parent('.hidden').hide();
            }
            if (note !== '') {
                $('#myNote').parent().removeClass('hidden');
                $('#myNote').parent().show()
            } else {
                $('#myNote').parent().addClass('hidden');
                $('#myNote').parent('.hidden').hide();
            }
            if (campaignVal == '') {
                $('#myCampaign').parent().addClass('hidden');
                $('#myCampaign').parent('.hidden').hide();
            } else {
                $('#myCampaign').parent().removeClass('hidden');
                $('#myCampaign').parent().show();
            }
            if (marketerVal == '') {
                $('#myMarketer').parent().addClass('hidden');
                $('#myMarketer').parent('.hidden').hide();
            } else {
                $('#myMarketer').parent().removeClass('hidden');
                $('#myMarketer').parent().show();
            }

            if (saleVal == '0') {
                $('#mySale').parent().addClass('hidden');
                $('#mySale').parent('.hidden').hide();
            } else {
                $('#mySale').parent().removeClass('hidden');
                $('#mySale').parent().show();
            }
            if (projectOneVal == '') {
                $('#myProjectOne').parent().addClass('hidden');
                $('#myProjectOne').parent('.hidden').hide();
            } else {
                $('#myProjectOne').parent().removeClass('hidden');
                $('#myProjectOne').parent().show();
            }
            if (projectTwoVal == '') {
                $('#myProjectTwo').parent().addClass('hidden');
                $('#myProjectTwo').parent('.hidden').hide();
            } else {
                $('#myProjectTwo').parent().removeClass('hidden');
                $('#myProjectTwo').parent().show();
            }
            if (propertyVal == '') {
                $('#myProperty').parent().addClass('hidden');
                $('#myProperty').parent('.hidden').hide();
            } else {
                $('#myProperty').parent().removeClass('hidden');
                $('#myProperty').parent().show();
            }
            if (propertyUtilityVal == '') {
                $('#myPropertyUtility').parent().addClass('hidden');
                $('#myPropertyUtility').parent('.hidden').hide();
            } else {
                $('#myPropertyUtility').parent().removeClass('hidden');
                $('#myPropertyUtility').parent().show();
            }
            if (dateVal == '') {
                $('#myDate').parent().addClass('hidden');
                $('#myDate').parent('.hidden').hide();
            } else {
                $('#myDate').parent().removeClass('hidden');
                $('#myDate').parent().show();
            }
            if (budget == '') {
                $('#myBudget').parent().addClass('hidden');
                $('#myBudget').parent('.hidden').hide();
            } else {
                $('#myBudget').parent().removeClass('hidden');
                $('#myBudget').parent().show();
            }
            if (propertyLocation == '') {
                $('#myPropertyLocation').parent().addClass('hidden');
                $('#myPropertyLocation').parent('.hidden').hide();
            } else {
                $('#myPropertyLocation').parent().removeClass('hidden');
                $('#myPropertyLocation').parent().show();
            }
            if (from == '' && to == '') {
                $('#myArea').parent().addClass('hidden');
                $('#myArea').parent('.hidden').hide();
            } else {
                $('#myArea').parent().removeClass('hidden');
                $('#myArea').parent().show();
            }


            KTUtil.scrollTop();

        });
    }

    var initValidation = function () {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                // Step 1
                profile_avatar: {
                    //required: true
                },
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                },
                email: {
                    required: true,
                    email: true
                },
                countryCode: {
                    required: true,
                },
                projectId: {
                    required: true,
                    number: true,
                },
                platform: {
                    required: true,
                    lettersonly: true,
                },
            },

            messages: {
                platform: {
                    lettersonly: "Select Platform",
                },
                projectId: {
                    number: "Select Project",
                },
            },

            // Display error
            invalidHandler: function (event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function () {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function (e) {
            e.preventDefault();

            if (validator.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn);
                //KTApp.block(formEl);

                // Get some values from elements on the page:
                var form = $(this);
                var url = form.attr('action');
                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function (data) {
                        console.log(data);
                        KTApp.unprogress(btn);
                        //KTApp.unblock(formEl);
                        swal.fire({
                            "title": "",
                            "text": "The application has been successfully submitted!",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        }).then((success) => {
                            if (success) {
                                window.location.href = window.HREF;
                            }
                        });
                    },

                    error: function (data) {
                        $('.alert-danger').empty();
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('.alert-danger').append('<p>' + value + '</p>');
                            $('.alert-danger').show();
                        });
                    }
                });
            }
        });
    };

    var initUserForm = function () {
        avatar = new KTAvatar('kt_user_add_avatar');
    };

    return {
        // public functions
        init: function () {
            formEl = $('#kt_user_add_form');

            initWizard();
            initValidation();
            initSubmit();
            initUserForm();
        }
    };
}();

jQuery(document).ready(function () {

    KTUserAdd.init();

});
