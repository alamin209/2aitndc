@extends('layouts.admin')

@section('content')
    <section class="wrapper site-min-height">
        <div class="row">

            <div class="col-lg-12">
                <section class="panel">

                    <button class="btn btn-info pull-right" onclick="print_details()">Print</button>

                    <div id="printarea" class="panel-body">

                        <table class="table">
                            @foreach($slips as $slip)
                                <tr>
                                    <td colspan="2" style="padding: 2px 2px 2px 2px;border: none;text-align: center;font-size: 25px;font-weight: bold">Dhaka School of Economics (DScE)</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 2px 2px 2px 2px;border: none;text-align: center;">(Constituent Institutin of the University of Dhaka)</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 2px 2px 2px 2px;border: none;text-align: center;">
                                        @if($copy == 1)
                                            Office Copy
                                        @elseif($copy == 2)
                                            Applicant's Copy
                                        @elseif($copy == 3)
                                            Candidate to submit with application form
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 2px 2px 2px 2px;border: none;text-align: center;font-size: 20px;font-weight: bold">{{ $slip->subject_names}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 2px 2px 2px 2px;border: none;text-align: center;">Session {{ $slip->sessions }}</td>
                                </tr>
                                <tr>
                                    <td style="border: none;" >SL No : {{ $slip->sl_no}}</td>
                                    <td style="border: none;">Date : {{ $slip->slip_date }}</td>
                                </tr>
                                <tr>
                                    <td style="border: none;" colspan="2">Name of Applicant : {{ $slip->name_of_applicant}}</td>
                                </tr>
                                <tr>
                                    <td style="border: none;" colspan="2">Purpose : Admission form and prospectus for {{ $slip->subject_names}}</td>
                                </tr>
                                <tr>
                                    <td style="border: none;" colspan="2">Amount (in words) <b id="word" style="margin-left: 10px;margin-right: 10px;font-size: 15px;"></b>TK. <input id="amounts" style=" text-align: center; margin-left: 10px;" readonly="" type="text" value="{{ $slip->amount}}"/></td>
                                </tr>
                                <tr><td style="padding: 20px 20px 20px 20px;border: none;"></td></tr>
                                <tr>
                                    <td style="padding: 2px 2px 2px 2px;border: none;">----------------------------------------</td>
                                    <td style="padding: 2px 2px 2px 2px;border: none;text-align: right">----------------------------------------</td>
                                </tr>
                                <tr>
                                    <td style="padding: 2px 2px 2px 2px;border: none;">Applicant's signature</td>
                                    <td style="padding: 2px 2px 2px 2px;border: none;text-align: right">Receiver's signature</td>
                                </tr>
                                <tr><td style="padding: 5px 5px 5px 5px;border: none;"></td></tr>
                                <tr style="background-color: #000">
                                    <td style="color: #ffffff;border: none;" colspan="2">4/C Eskaton Garden Road (Floors : 3rd, 4th &amp; 5th) Dhaka - 1000<br>Phone : 02 9359628-9, 8316028, 8316054</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!--dynamic table initialization -->
    <script src="public/js/dynamic_table_init_menu.js"></script>
    <script src="public/js/form-validation-script_add_menu.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>

        $(window).bind("load", function () {
            convertNumberToWords($("#amounts").val());
        });

        function convertNumberToWords(amount) {

            if (amount == 0) {
                $("#word").text("Zero only");
                return;
            } else
                var words = new Array();
            words[0] = '';
            words[1] = 'One';
            words[2] = 'Two';
            words[3] = 'Three';
            words[4] = 'Four';
            words[5] = 'Five';
            words[6] = 'Six';
            words[7] = 'Seven';
            words[8] = 'Eight';
            words[9] = 'Nine';
            words[10] = 'Ten';
            words[11] = 'Eleven';
            words[12] = 'Twelve';
            words[13] = 'Thirteen';
            words[14] = 'Fourteen';
            words[15] = 'Fifteen';
            words[16] = 'Sixteen';
            words[17] = 'Seventeen';
            words[18] = 'Eighteen';
            words[19] = 'Nineteen';
            words[20] = 'Twenty';
            words[30] = 'Thirty';
            words[40] = 'Forty';
            words[50] = 'Fifty';
            words[60] = 'Sixty';
            words[70] = 'Seventy';
            words[80] = 'Eighty';
            words[90] = 'Ninety';
            amount = amount.toString();
            var atemp = amount.split(".");
            var number = atemp[0].split(",").join("");
            var n_length = number.length;
            var words_string = "";
            if (n_length <= 9) {
                var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                var received_n_array = new Array();
                for (var i = 0; i < n_length; i++) {
                    received_n_array[i] = number.substr(i, 1);
                }
                for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                    n_array[i] = received_n_array[j];
                }
                for (var i = 0, j = 1; i < 9; i++, j++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        if (n_array[i] == 1) {
                            n_array[j] = 10 + parseInt(n_array[j]);
                            n_array[i] = 0;
                        }
                    }
                }
                value = "";
                for (var i = 0; i < 9; i++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        value = n_array[i] * 10;
                    } else {
                        value = n_array[i];
                    }
                    if (value != 0) {
                        words_string += words[value] + " ";
                    }
                    if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Crores ";
                    }
                    if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Lakhs ";
                    }
                    if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Thousand ";
                    }
                    if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                        words_string += "Hundred and ";
                    } else if (i == 6 && value != 0) {
                        words_string += "Hundred ";
                    }
                }
                words_string = words_string.split("  ").join(" ");
            }
            $("#word").text(words_string + " only");
            return words_string;
        }

        function print_details() {
            var text = $("#printarea").html();
            $('body').html(text);
            window.print();
            window.reload();
        }
    </script>

@endsection


<?php
