<!DOCTYPE html>
<html>
<head>
    <title>Load More</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Add a gray background color with some padding */
        body {
            font-family: Arial;
            padding: 20px;
            background: #f1f1f1;
        }

        /* Header/Blog Title */
        .header {
            padding: 30px;
            font-size: 40px;
            text-align: center;
            background: white;
        }

        /* Create two unequal columns that floats next to each other */
        /* Left column */
        .leftcolumn {
            float: left;
            width: 75%;
        }

        /* Right column */
        .rightcolumn {
            float: right;
            width: 25%;
            padding-left: 20px;
        }

        /* Fake image */
        .fakeimg {
            background-color: #aaa;
            width: 100%;
            /*padding: 20px;*/
        }

        /* Add a card effect for articles */
        .card {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Footer */
        .footer {
            padding: 20px;
            text-align: center;
            background: #ddd;
            margin-top: 20px;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 800px) {
            .leftcolumn, .rightcolumn {
                width: 100%;
                padding: 0;
            }
        }
    </style>
    <link rel="stylesheet" href="{{URL::to('css/lazy-load-images.min.css')}}">
</head>
<body>
<div class="container">
    <h2 align="center">Load More </h2>
    <br/>


    <div id="load_data"></div>
    <div style="text-align: center" id="load_data_message"></div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{URL::to('js/lazy-load-images.min.js')}}"></script>
<script>

    $(document).ready(function () {

        var limit = 7;
        var start = 0;
        var action = 'inactive';

        $('#load_data_message1').html("<div class='spinner-grow text-primary'></div>");

        function load_country_data(limit, start) {
            $.ajax({
                url: "{{route('PostController.getData')}}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    limit: limit,
                    start: start
                },
                cache: false,
                success: function (data) {
                    $('#load_data').append(data);
                    if (data == '') {
                        $('#load_data_message').html("No Data Found");
                        action = 'active';
                    } else {
                        $('#load_data_message').html("<div style='margin-top: 20px' class='spinner-border text-muted'></div>");
                        action = "inactive";
                    }
                }
            });
        }

        if (action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        }
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
                action = 'active';
                start = start + limit;
                load_country_data(limit, start);
            }
        });

    });
</script>


</body>
</html>

