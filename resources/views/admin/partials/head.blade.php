<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.dashboardpack.com/user-management-html/Layouts.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 13 Aug 2022 17:54:22 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('module', 'Trang chu') | @yield('action')</title>
    <link rel="icon" href="{{ asset('admin/img/mini_logo.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap1.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/themefy_icon/themify-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/niceselect/css/nice-select.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/owl_carousel/css/owl.carousel.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/gijgo/gijgo.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendors/tagsinput/tagsinput.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/datepicker/date-picker.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/scroll/scrollable.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/datatable/css/jquery.dataTables.min.css') }}" />


    <link rel="stylesheet" href="{{ asset('admin/vendors/datatable/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatable/css/buttons.dataTables.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/text_editor/summernote-bs4.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/vendors/morris/morris.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/material_icon/material-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/css/metisMenu.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/calender_js/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/calender_js/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/calender_js/timegrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/calender_js/list/main.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/style1.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/colors/default.css') }}" id="colorSkinCSS">
    <link rel="stylesheet" href="{{ asset('admin/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/jquery.dataTables.min.js') }}">
    <link rel="stylesheet" href="{{ asset('admin/js/myscript.js') }}">

    <script src="{{ asset('admin/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @if (Route::is('admin.quiz.*'))
        <script>
            $(document).ready(function() {
                var counter = {{ $counter }};
                var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $('#load-more-option').click(function() {

                    var label = labels[counter];
                    var newInput = '<div class="mb-3">' +
                        '<h4 class="card-subtitle mb-2">Đáp án ' + label + '</h4>' +
                        '<div>' +
                        '<textarea name="option[]" placeholder="Input ' + label +
                        '" class="form-control"></textarea>' +
                        '</div>' +
                        '</div>';
                    counter++;
                    $('#inputs').append(newInput);

                    var newOption = $('<option>', { // Create a new option element
                        value: label.toLowerCase(), // Set the value to lowercase label
                        text: label // Display the label
                    });

                    $('select[name="answers"]').append(
                        newOption); // Append the new option to the select element

                    updateCounts();
                });

                function updateCounts() {
                    var optionCount = $('#inputs').children().length;
                    var answerCount = $('select[name="answers"]').children().length;

                    $('#option-count').text(optionCount);
                    $('#answer-count').text(answerCount);
                }

                updateCounts();
            });
        </script>
    @endif
